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


function formulaires_migrer_agenda_charger_dist() {
	$valeurs = array(
		'id_parent'=>'',
		'toute_la_branche' => '',
		'champ_date_debut' => 'date',
		'champ_date_fin' => 'date_redac',
		'horaire' => 'oui',
		'groupes_mots' => array(),
	);

	return $valeurs;
}

function formulaires_migrer_agenda_verifier_dist() {

	$erreurs = array();
	$oblis = array('id_parent','champ_date_debut','champ_date_fin','horaire');

	foreach ($oblis as $obli) {
		if (!_request($obli)) {
			$erreurs[$obli] = _T('info_obligatoire');
		}
	}

	if (!isset($erreurs['champ_date_debut'])
		and !in_array(_request('champ_date_debut'), array('date','date_redac'))) {
		$erreurs['champ_date_debut'] = _T('migreragenda:erreur_choix_incorrect');
	}

	if (!isset($erreurs['champ_date_fin'])
		and !in_array(_request('champ_date_fin'), array('date','date_redac'))) {
		$erreurs['champ_date_fin'] = _T('migreragenda:erreur_choix_incorrect');
	}

	if (!isset($erreurs['horaire'])
		and !in_array(_request('horaire'), array('oui','non'))) {
		$erreurs['horaire'] = _T('migreragenda:erreur_choix_incorrect');
	}

	if (!isset($erreurs['groupes_mots'])
		and $groupes = _request('groupes_mots')) {
		if (!is_array($groupes)) {
			$erreurs['groupes_mots'] = _T('migreragenda:erreur_choix_incorrect');
		} else {
			$groupes = array_map('intval', $groupes);
			if (sql_countsel('spip_groupes_mots', sql_in('id_groupe', $groupes)) != count($groupes)) {
				$erreurs['groupes_mots'] = _T('migreragenda:erreur_choix_incorrect');
			}
		}
	}

	// pas d'erreurs ? verifier ce qui va etre fait et l'annoncer
	if (!count($erreurs) and !_request('confirm')) {
		$where = migrer_agenda_where_articles(_request('id_parent'), _request('toute_la_branche'));
		$nba = sql_countsel('spip_articles', $where);

		$message = _T('migreragenda:info_migration_articles').' ';
		$message .= sinon(singulier_ou_pluriel($nba, 'info_1_article', 'info_nb_articles'), _T('info_aucun_article'));

		$erreurs['confirmer'] = $message;
		$erreurs['message_erreur'] = ''; // pas de message automatique
	}

	return $erreurs;
}


function formulaires_migrer_agenda_traiter_dist() {
	$id_rubrique = _request('id_parent');
	$where_articles = migrer_agenda_where_articles($id_rubrique, _request('toute_la_branche'));
	$groupes = _request('groupes_mots');
	if (!$groupes) {
		$groupes = array();
	}
	$where_mots = migrer_agenda_where_mots($groupes);

	$horaire = (_request('horaire')=='oui'?true:false);
	$champ_date_debut = _request('champ_date_debut');
	$champ_date_fin = _request('champ_date_fin');

	// poser le flag agenda sur la rubrique !
	sql_updateq('spip_rubriques', array('agenda'=>1), 'id_rubrique='.intval($id_rubrique));
	// et migrer les articles
	$nb = migrer_articles($where_articles, $champ_date_debut, $champ_date_fin, $horaire, $where_mots);

	$message = _T('migreragenda:info_migration_articles_reussi').' ';
	$message .= sinon(singulier_ou_pluriel($nb, 'info_1_article', 'info_nb_articles'), _T('info_aucun_article'));

	return array('message_ok'=>$message);
}

function migrer_articles($where_articles, $champ_date_debut, $champ_date_fin, $horaire, $where_mots) {
	include_spip('action/editer_evenement');

	$where_mots = implode(' AND ', $where_mots);

	$nb = 0;
	$res = sql_select('*', 'spip_articles', $where_articles);
	while ($row = sql_fetch($res)) {
		$id_evenement = evenement_inserer($row['id_article']);
		// mettre les champs
		$set = array(
			'date_debut' => $row[$champ_date_debut],
			'date_fin' => $row[$champ_date_fin],
			'titre' => $row['titre'],
			'horaire' => ($horaire?'oui':'non')
		);
		evenement_modifier($id_evenement, $set);

		// associer les mots : en sql pour ne pas exploser si plein de mots en base
		$mots = sql_allfetsel(
			'M.id_mot',
			'spip_mots AS M JOIN spip_mots_liens AS L ON (M.id_mot=L.id_mot AND L.objet='.sql_quote('article').')',
			'id_objet='.intval($row['id_article']).' AND ('.$where_mots.')'
		);
		if (count($mots)) {
			$insert = array();
			foreach ($mots as $mot) {
				$insert[] = array('id_mot'=>$mot['id_mot'],'objet'=>'evenement','id_objet'=>$id_evenement);
			}
			sql_insertq_multi('spip_mots_liens', $insert);
		}

		// publier l'evenement
		evenement_modifier($id_evenement, array('statut' => 'publie'));
		$nb++;
	}
	return $nb;
}

function migrer_agenda_where_articles($id_rubrique, $branche = false) {

	$where = array();
	$where[] = 'statut='.sql_quote('publie');
	if ($branche) {
		include_spip('inc/rubriques');
		$where[] = sql_in('id_rubrique', calcul_branche_in($id_rubrique));
	} else {
		$where[] = 'id_rubrique='.intval($id_rubrique);
	}

	// exclure les articles qui ont deja un evenement
	$where[] = 'id_article NOT IN ('.sql_get_select('id_article', 'spip_evenements').')';

	return $where;
}

function migrer_agenda_where_mots($groupes) {
	$id_groupe = array();

	$rows = sql_allfetsel('*', 'spip_groupes_mots', sql_in('id_groupe', $groupes));
	foreach ($rows as $row) {
		$id_groupe[] = $row['id_groupe'];
		$tables_liees = explode(',', $row['tables_liees']);
		$tables_liees = array_filter($tables_liees);
		// ajouter les evenements a ce groupe de mot
		if (!in_array('evenements', $tables_liees)) {
			include_spip('action/editer_groupe_mots');
			$tables_liees[] = 'evenements';
			$tables_liees = implode(',', $tables_liees);
			groupemots_modifier($row['id_groupe'], array('tables_liees' => $tables_liees));
		}
	}

	$where = array(sql_in('id_groupe', $id_groupe));
	return $where;
}
