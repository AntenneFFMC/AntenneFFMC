<?php
/**
 * Plugin Agenda 4 pour Spip 3.0
 * Licence GPL 3
 *
 * 2006-2011
 * Auteurs : cf paquet.xml
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Edition d'un evenement
 * @param string $arg
 * @return array
 */
function action_editer_evenement_dist($arg = null) {
	if (is_null($arg)) {
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	// si id_evenement n'est pas un nombre, c'est une creation
	// mais on verifie qu'on a toutes les donnees qu'il faut.
	if (!$id_evenement = intval($arg)) {
		$id_parent = _request('id_parent');
		if (!$id_evenement = agenda_action_insert_evenement($id_parent)) {
			return array(false,_L('echec'));
		}
	}

	$err = action_evenement_set($id_evenement);
	return array($id_evenement,$err);
}

/**
 * Creer un nouvel evenement
 *
 * @param int $id_article
 * @param int $id_evenement_source
 * @return int
 */
function evenement_inserer($id_article, $id_evenement_source = 0) {
	include_spip('inc/autoriser');
	if (!autoriser('creerevenementdans', 'article', $id_article)) {
		spip_log('agenda action formulaire article : auteur '.$GLOBALS['visiteur_session']['id_auteur']." n'a pas le droit de creer un evenement dans article $id_article", 'agenda');
		return false;
	}

	$champs = array(
		'id_evenement_source' => intval($id_evenement_source),
		'id_article'=>intval($id_article),
		'statut' => 'prop',
	);

	// Envoyer aux plugins
	$champs = pipeline(
		'pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_evenements',
			),
			'data' => $champs
		)
	);

	// nouvel evenement
	$id_evenement = sql_insertq('spip_evenements', $champs);

	pipeline(
		'post_insertion',
		array(
			'args' => array(
				'table' => 'spip_evenements',
				'id_objet' => $id_evenement
			),
			'data' => $champs
		)
	);

	if (!$id_evenement) {
		spip_log("agenda action formulaire evenement : impossible d'ajouter un evenement", 'agenda');
		return false;
	}
	return $id_evenement;
}

/**
 * Modifier un evenement existant
 *
 * @param int $id_evenement
 * @param array $set
 * @return bool|string
 */
function evenement_modifier($id_evenement, $set = null) {

	include_spip('inc/modifier');
	include_spip('inc/filtres');
	$c = collecter_requests(
		// white list
		objet_info('evenement', 'champs_editables'),
		// black list
		array('statut', 'id_article'),
		// donnees eventuellement fournies
		$set
	);

	// Si l'evenement est publie, invalider les caches et demander sa reindexation
	$t = sql_getfetsel('statut', 'spip_evenements', 'id_evenement='.intval($id_evenement));
	$invalideur = $indexation = false;
	if ($t == 'publie') {
		$invalideur = "id='evenement/$id_evenement'";
		$indexation = true;
	}

	if ($err = objet_modifier_champs(
		'evenement',
		$id_evenement,
		array(
			'data' => $set,
			'nonvide' => array('titre' => _T('info_nouvel_evenement').' '._T('info_numero_abbreviation').$id_evenement),
			'invalideur' => $invalideur,
			'indexation' => $indexation,
		),
		$c
	)) {
		return $err;
	}

	if (!is_null($repetitions = _request('repetitions', $set))) {
		agenda_action_revision_evenement_repetitions($id_evenement, $repetitions);
	}
	// Modification de statut, changement de parent ?
	$c = collecter_requests(array('statut', 'id_parent'), array(), $set);
	$err = evenement_instituer($id_evenement, $c);

	return $err;
}

function agenda_action_revision_evenement_repetitions($id_evenement, $repetitions = '') {
	include_spip('inc/filtres');
	$repetitions = preg_split(',[^0-9\-\/],', $repetitions);
	// gestion des repetitions
	$rep = array();
	foreach ($repetitions as $date) {
		if (strlen($date)) {
			$date = recup_date($date);
			if ($date = mktime(0, 0, 0, $date[1], $date[2], $date[0])) {
				$rep[] = $date;
			}
		}
	}
	agenda_action_update_repetitions($id_evenement, $rep);
}

function agenda_action_update_repetitions($id_evenement, $repetitions) {
	// evenement source
	if ($row = sql_fetsel('*', 'spip_evenements', 'id_evenement='.intval($id_evenement))) {
		// Si ce n'est pas un événement source, on n'a rien à faire ici
		if ($row['id_evenement_source'] != 0) {
			return;
		}

		// On ne garde que les données correctes pour une modification
		$c = collecter_requests(
			// white list
			objet_info('evenement', 'champs_editables'),
			// black list
			array('id_evenement', 'id_evenement_source'),
			// donnees fournies
			$row
		);

		// Savoir si la source était publiée ou pas
		$publie = ($row['statut'] == 'publie');

		// On calcule la durée en secondes de l'événement source pour la reporter telle quelle aux répétitions
		$date_debut = strtotime($row['date_debut']);
		$date_fin = strtotime($row['date_fin']);
		$duree = $date_fin - $date_debut;

		$repetitions_updated = array();
		// mettre a jour toutes les repetitions deja existantes ou les supprimer si plus lieu
		$res = sql_select('id_evenement,date_debut', 'spip_evenements', 'id_evenement_source='.intval($id_evenement));
		while ($row = sql_fetch($res)) {
			$date = strtotime(date('Y-m-d', strtotime($row['date_debut'])));
			if (in_array($date, $repetitions)) {
				// Cette répétition existe déjà, on la met à jour
				$repetitions_updated[] = $date;

				// On calcule les nouvelles dates/heures en reportant la durée de la source
				$update_date_debut = date('Y-m-d', $date).' '.date('H:i:s', $date_debut);
				$update_date_fin = date('Y-m-d H:i:s', strtotime($update_date_debut)+$duree);

				// Seules les dates sont changées dans les champs de la source
				// TODO : prendre en charge la mise a jour uniquement si conforme a l'original
				$c['date_debut'] = $update_date_debut;
				$c['date_fin'] = $update_date_fin;

				// mettre a jour l'evenement
				sql_updateq(
					'spip_evenements',
					$c,
					'id_evenement = '.$row['id_evenement']
				);
			} else {
				// il est supprime
				sql_delete('spip_evenements', 'id_evenement='.$row['id_evenement']);
			}
		}

		// regarder les repetitions a ajouter
		foreach ($repetitions as $date) {
			if (!in_array($date, $repetitions_updated)) {
				// On calcule les dates/heures en reportant la durée de la source
				$update_date_debut = date('Y-m-d', $date).' '.date('H:i:s', $date_debut);
				$update_date_fin = date('Y-m-d H:i:s', strtotime($update_date_debut)+$duree);

				// Seules les dates sont changées dans les champs de la source
				$c['date_debut'] = $update_date_debut;
				$c['date_fin'] = $update_date_fin;

				// On crée la nouvelle répétition
				if ($id_evenement_new = agenda_action_insert_evenement($c['id_article'], $id_evenement)) {
					// Si c'est bon, on ajoute tous les champs
					sql_updateq(
						'spip_evenements',
						$c,
						'id_evenement = '.$id_evenement_new
					);

					// Pour les créations il ne faut pas oublier de dupliquer les liens
					// En effet, sinon les documents insérés avant la création (0-id_auteur) ne seront pas dupliqués
					include_spip('action/editer_liens');
					objet_dupliquer_liens('evenement', $id_evenement, $id_evenement_new);
				}
			}
		}
	}
}

/**
 * Instituer un evenement
 *
 * @param int $id_evenement
 * @param array $c
 * @return bool|string
 */
function evenement_instituer($id_evenement, $c) {

	include_spip('inc/autoriser');
	include_spip('inc/modifier');

	$row = sql_fetsel('id_article, statut', 'spip_evenements', 'id_evenement='.intval($id_evenement));
	$id_parent  = $id_parent_ancien = $row['id_article'];
	$statut = $statut_ancien = $row['statut'];

	$champs = array();

	if (!autoriser('modifier', 'article', $id_parent)
		or (isset($c['id_parent'])
		and !autoriser('modifier', 'article', $c['id_parent']))) {
		spip_log("editer_evenement $id_evenement refus " . join(' ', $c));
		return false;
	}

	// Verifier que l'article demande existe et est different
	// de l'article actuel
	if (isset($c['id_parent'])
		and $c['id_parent'] != $id_parent
		and (sql_countsel('spip_articles', 'id_article='.intval($c['id_parent'])))) {
		$id_parent = $champs['id_article'] = $c['id_parent'];
	}

	$sa = sql_getfetsel('statut', 'spip_articles', 'id_article='.intval($id_parent));
	if ($id_parent
		and (
			$id_parent !== $id_parent_ancien
			or $statut == '0'
		)) {
		switch ($sa) {
			case 'publie':
				// statut par defaut si besoin
				if ($statut == '0') {
					$champs['statut'] = $statut = 'publie';
				}
				break;
			case 'poubelle':
				// si article a la poubelle, evenement aussi
				$champs['statut'] = $statut = 'poubelle';
				break;
			default:
				// pas de publie ni 0 si article pas publie
				if (in_array($statut, array('publie','0'))) {
					$champs['statut'] = $statut = 'prop';
				}
				break;
		}
	}

	// si pas d'article lie, et statut par defaut
	// on met en propose
	if ($statut=='0') {
		$champs['statut'] = $statut = 'prop';
	}

	if (isset($c['statut'])
		and $s = $c['statut']
		and $s != $statut) {
		// pour instituer un evenement il faut avoir le droit d'instituer l'article associe avec le meme statut
		if (autoriser('instituer', 'article', $id_parent, null, array('statut'=>$s))
			and ($sa=='publie' or $s!=='publie')) {
			$champs['statut'] = $statut = $s;
		} else {
			spip_log("editer_evenement $id_evenement refus " . join(' ', $c));
		}
	}

	// Envoyer aux plugins
	$champs = pipeline(
		'pre_edition',
		array(
			'args' => array(
				'table' => 'spip_evenements',
				'action'=>'instituer',
				'id_objet' => $id_evenement,
				'id_parent_ancien' => $id_parent_ancien,
				'statut_ancien' => $statut_ancien,
			),
			'data' => $champs
		)
	);

	if (!count($champs)) {
		return;
	}

	// Envoyer les modifs sur l'evenement et toutes ses repetitons
	$ids = array_map('reset', sql_allfetsel('id_evenement', 'spip_evenements', 'id_evenement_source='.intval($id_evenement)));
	$ids[] = intval($id_evenement);
	sql_updateq('spip_evenements', $champs, sql_in('id_evenement', $ids));

	// Invalider les caches
	include_spip('inc/invalideur');
	suivre_invalideur("id='id_article/$id_parent_ancien'");
	suivre_invalideur("id='id_article/$id_parent'");

	// Pipeline
	pipeline(
		'post_edition',
		array(
			'args' => array(
				'table' => 'spip_evenements',
				'action'=>'instituer',
				'id_objet' => $id_evenement,
				'id_parent_ancien' => $id_parent_ancien,
				'statut_ancien' => $statut_ancien,
			),
			'data' => $champs
		)
	);

	// Notifications
	if ($notifications = charger_fonction('notifications', 'inc')) {
		$notifications('instituerevenement', $id_evenement,
			array('id_parent' => $id_parent, 'statut' => $statut, 'id_parent_ancien' => $id_parent, 'statut_ancien' => $statut_ancien)
		);
	}

	return ''; // pas d'erreur
}

/*
function agenda_action_supprime_repetitions($supp_evenement){
	$res = sql_select("id_evenement", "spip_evenements", "id_evenement_source=".intval($supp_evenement));
	while ($row = sql_fetch($res)){
		$id_evenement = $row['id_evenement'];
		sql_delete("spip_evenements", "id_evenement=".intval($id_evenement));
	}
}
*/
/*
function agenda_action_supprime_evenement($id_article,$supp_evenement){
	$id_evenement = sql_getfetsel("id_evenement", "spip_evenements", array(
		"id_article=" . intval($id_article),
		"id_evenement=" . intval($supp_evenement)));
	if (intval($id_evenement) AND $id_evenement == $supp_evenement){
		sql_delete("spip_evenements", "id_evenement=".intval($id_evenement));
		agenda_action_supprime_repetitions($id_evenement);
	}
	include_spip('inc/invalideur');
	suivre_invalideur("article/$id_article");
	$id_evenement = 0;
	return $id_evenement;
}*/


function agenda_action_insert_evenement($id_article, $id_evenement_source = 0) {
	return evenement_inserer($id_article, $id_evenement_source);
}
function action_evenement_set($id_evenement, $set = null) {
	return evenement_modifier($id_evenement, $set);
}
function agenda_action_instituer_evenement($id_evenement, $c) {
	return evenement_instituer($id_evenement, $c);
}
