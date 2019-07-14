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
 * Inserer la CSS de l'agenda si config cochee
 * forcee par define('_AGENDA_INSERT_HEAD_CSS',false|true) par le squelette si besoin
 *
 * @param $flux
 * @return mixed
 */
function agenda_insert_head_css($flux) {
	if (!defined('_AGENDA_INSERT_HEAD_CSS')
		or !_AGENDA_INSERT_HEAD_CSS) {
		include_spip('inc/config');
		$cfg = (defined('_AGENDA_INSERT_HEAD_CSS') ? _AGENDA_INSERT_HEAD_CSS : lire_config('agenda/insert_head_css'));
		if ($cfg) {
			$flux .= '<link rel="stylesheet" type="text/css" href="'.find_in_path('css/spip.agenda.css').'" />';
		}
	}
	return $flux;
}

function agenda_formulaire_fond($flux) {
	if ($flux['args']['form'] == 'editer_rubrique') {
		$contexte = $flux['args']['contexte'];
		$form = recuperer_fond('prive/objets/editer/rubrique-agenda', $contexte);
		if ($p = strpos($flux['data'], '<!--extra-->')) {
			$flux['data'] = substr_replace($flux['data'], $form, $p, 0);
		}
	}
	return $flux;
}

/**
 * Inserer les infos d'agenda sur les articles et rubriques
 *
 * @param array $flux
 * @return array
 */
function agenda_affiche_milieu($flux) {

	$e = trouver_objet_exec($flux['args']['exec']);
	$out = '';
	$rubrique_agenda_presente = NULL;
	if ($e['type']=='rubrique'
		and $e['edition']==false
		and $id_rubrique = intval($flux['args']['id_rubrique'])
		and $rubrique_agenda_presente = sql_countsel('spip_rubriques', 'agenda=1')) {

		$actif = sql_getfetsel('agenda', 'spip_rubriques', 'id_rubrique='.intval($id_rubrique));
		$statut = '-32';
		$alt = '';
		$voir = '';
		include_spip('inc/rubriques');
		if ($actif or sql_countsel('spip_rubriques', sql_in('id_rubrique', calcul_hierarchie_in($id_rubrique)).' AND agenda=1 AND id_rubrique<>'.intval($id_rubrique))) {
			$alt = ($actif ? _T('agenda:rubrique_mode_agenda') : _T('agenda:rubrique_dans_une_rubrique_mode_agenda'));
			$statut = '-ok-32';
			$voir = _T('agenda:voir_evenements_rubrique');
		}

		if ($voir) {
			$res = _T('agenda:agenda')
				. " <small>| <a href='".generer_url_ecrire('evenements', "id_rubrique=$id_rubrique")."'>$voir</a></small>"
				. http_img_pack("agenda$statut.png", $alt, "class='statut'", $alt);
			$out .= boite_ouvrir($res, 'simple agenda-statut')
				. boite_fermer();
		}
	}
	elseif ($e['type']=='article'
		and $e['edition']==false) {
		$id_article = $flux['args']['id_article'];
		$out .= recuperer_fond('prive/objets/contenu/article-evenements', $flux['args']);
	}

	if ($out) {
		if ($p = strpos($flux['data'], '<!--affiche_milieu-->')) {
			$flux['data'] = substr_replace($flux['data'], $out, $p, 0);
		} else {
			$flux['data'] .= $out;
		}
	}
	return $flux;
}

/**
 * Optimiser la base
 * (evenements a la poubelle, lies a des articles disparus, ou liens mots sur evenements disparus)
 *
 * @param array $flux
 * @return array
 */
function agenda_optimiser_base_disparus($flux) {

	# passer a la poubelle
	# les evenements lies a un article inexistant
	$res = sql_select(
		'DISTINCT evenements.id_article',
		'spip_evenements AS evenements LEFT JOIN spip_articles AS articles ON evenements.id_article=articles.id_article',
		'articles.id_article IS NULL'
	);
	while ($row = sql_fetch($res)) {
		sql_updateq('spip_evenements', array('statut'=>'poubelle'), 'id_article='.$row['id_article']);
	}

	// Evenements a la poubelle
	sql_delete('spip_evenements', "statut='poubelle' AND maj < ".$flux['args']['date']);

	include_spip('action/editer_liens');
	// optimiser les liens de tous les mots vers des objets effaces
	// et depuis des mots effaces
	$flux['data'] += objet_optimiser_liens(array('mot'=>'*'), array('evenement' => '*'));

	return $flux;
}


/**
 * Lister les evenements dans le calendrier de l'espace prive (extension organiseur)
 *
 * @param array $flux
 * @return array
 */
function agenda_quete_calendrier_prive($flux) {
	$quoi = $flux['args']['quoi'];
	if (!$quoi or $quoi == 'evenements') {
		$start = sql_quote($flux['args']['start']);
		$end = sql_quote($flux['args']['end']);
		$res = sql_select('*', 'spip_evenements AS E', "((E.date_fin >= $start OR E.date_debut >= $start) AND E.date_debut <= $end)");
		while ($row = sql_fetch($res)) {
			$flux['data'][] = array(
				'id' => $row['id_evenement'],
				'title' => $row['titre'],
				'allDay' => false,
				'start' => $row['date_debut'],
				'end' => $row['date_fin'],
				'url' => str_replace('&amp;', '&', generer_url_entite($row['id_evenement'], 'evenement')),
				'className' => 'calendrier-event evenement calendrier-couleur5',
				'description' => $row['descriptif'],
			);
		}
	}
	return $flux;
}

/**
 * Synchroniser le statut des evenements lorsqu'on publie/depublie un article,
 * si le plugin est configuré pour (par défaut)
 * @param array $flux
 * @return array
 */
function agenda_post_edition($flux) {
	if (isset($flux['args']['table'])
		and $flux['args']['table']=='spip_articles'
		and $flux['args']['action'] == 'instituer'
		and $id_article = $flux['args']['id_objet']
		and isset($flux['data']['statut'])
		and $statut = $flux['data']['statut']
		and $statut_ancien = $flux['args']['statut_ancien']
		and $statut != $statut_ancien
		and lire_config('agenda/synchro_statut')) {
		$set = array();
		// les evenements principaux, associes a cet article
		$where = array('id_article='.intval($id_article),'id_evenement_source=0');
		switch ($statut) {
			case 'poubelle':
				// on passe aussi tous les evenements associes a la poubelle, sans distinction
				$set['statut'] = 'poubelle';
				break;
			case 'publie':
				// on passe aussi tous les evenements prop en publie
				$set['statut'] = 'publie';
				$where[] = "statut='prop'";
				break;
			default:
				if ($statut_ancien=='publie') {
					// on depublie aussi tous les evenements publie
					$set['statut'] = 'prop';
					$where[] = "statut='publie'";
				}
				break;
		}
		if (count($set)) {
			include_spip('action/editer_evenement');
			$res = sql_select('id_evenement', 'spip_evenements', $where);
			// et on applique a tous les evenements lies a l'article
			while ($row = sql_fetch($res)) {
				evenement_modifier($row['id_evenement'], $set);
			}
		}
	}
	return $flux;
}

/*
 * Synchroniser les liaisons (mots, docs, gis, etc) de l'événement édité avec ses répétitions s'il en a
 * @param array $flux
 * @param array
 */
function agenda_post_edition_lien($flux) {
	// Si on est en train de lier ou délier quelque chose a un événement
	if ($flux['args']['objet'] == 'evenement') {
		// On cherche si cet événement a des répétitions
		if ($id_evenement = $flux['args']['id_objet']
			and $id_evenement > 0
			and $repetitions = sql_allfetsel('id_evenement', 'spip_evenements', 'id_evenement_source = '.$id_evenement)
			and is_array($repetitions)
		) {
			include_spip('action/editer_liens');

			// On a la liste des ids des répétitions
			$repetitions = array_map('reset', $repetitions);

			// Si c'est un ajout de lien, on l'ajoute à toutes les répétitions
			if ($flux['args']['action'] == 'insert') {
				objet_associer(
					array($flux['args']['objet_source'] => $flux['args']['id_objet_source']),
					array('evenement' => $repetitions)
				);
			} elseif ($flux['args']['action'] == 'delete') {
				// Si c'est une suppression de lien, on le supprime à toutes les répétitions
				objet_dissocier(
					array($flux['args']['objet_source'] => $flux['args']['id_objet_source']),
					array('evenement' => $repetitions)
				);
			}
		}
	}

	return $flux;
}

/**
 * Les evenements peuvent heriter des compositions des articles
 * @param array $heritages
 * @return array
 */
function agenda_compositions_declarer_heritage($heritages) {
	$heritages['evenement'] = 'article';
	return $heritages;
}

/**
 * Insertion dans le pipeline revisions_chercher_label (Plugin révisions)
 * Trouver le bon label à afficher sur les champs dans les listes de révisions
 *
 * Si un champ est un champ extra, son label correspond au label défini du champs extra
 *
 * @pipeline revisions_chercher_label
 * @param array $flux Données du pipeline
 * @return array      Données du pipeline
**/
function agenda_revisions_chercher_label($flux) {
	foreach (array('date_debut', 'date_fin','horaire','lieu') as $champ) {
		if ($flux['args']['champ'] == $champ) {
			$flux['data'] = _T('agenda:evenement_'.$champ);
			return $flux;
		}
	}

	if ($flux['args']['champ'] == 'id_article') {
		$flux['data'] = _T('agenda:evenement_article');
	}

	return $flux;
}

/**
 * Insertion dans le pipeline accueil_encours (SPIP)
 *
 * Afficher les événements en attente de validation sur la page d'acceuil de l'espace privé
 *
 * @param array $flux Le contexte d'environnement du pipeline
 * @return array $flux Le contexte d'environnement modifié
 */
function agenda_accueil_encours($flux){
	$flux .= recuperer_fond('prive/objets/liste/evenements',
		array(
			'statut' => array('prop'),
			'nb' => 5
		),
		array('ajax' => true)
	);
	return $flux;
}

/** Déclarer les évènements
 * au plugin corbeille
 * @param array $flux;
 * @return array $flux;
**/
function agenda_corbeille_table_infos($flux){
	$flux['evenements']= array(
		'statut'=>'poubelle',
		'table'=>'evenements',
		'tableliee'=>array('spip_evenements_participants')
	);
	return $flux;
}

/**
 * Si on dit qu'il n'y pas de page spécifique pour un évènement, mais qu'on doit utiliser la page d'article,
 * alors il n'y a pas lieu de générer une url propre pour un évènement
 * qui pourrait prendre la place d'une url propre pour un autre objet.
 * @param array $flux
 * @return array $lux
**/
function agenda_propres_creer_chaine_url($flux) {
	if ($flux['objet']['type'] == 'evenement' and lire_config('agenda/url_evenement_evenement') == 'article') {
		$flux['data'] = 'evenement'.$flux['objet']['id_objet'];
	}
	return $flux;
}

/**
 * Pour la saisie de type événement, indique si les données renvoyées sont tabulaire ou pas
 * @param $flux
 * @return $flux
**/
function agenda_saisie_est_tabulaire($flux) {
	$args = $flux['args'];
	if ($args['saisie'] != 'evenements') {
		return $flux;
	}
	if ($args['options']['type_choix'] == 'checkbox') {
		$flux['data'] = true;
	}
	return $flux;
}
