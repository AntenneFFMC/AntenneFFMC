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

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/autoriser');

function formulaires_editer_evenement_charger_dist($id_evenement = 'new', $id_article = 0, $retour = '', $lier_trad = 0, $config_fonc = 'evenements_edit_config', $row = array(), $hidden = '') {

	$valeurs = formulaires_editer_objet_charger('evenement', $id_evenement, $id_article, 0, $retour, $config_fonc, $row, $hidden);

	if (!$valeurs['id_article']) {
		$valeurs['id_article'] = $id_article;
	}
	if (!$valeurs['titre']) {
		$valeurs['titre'] = sql_getfetsel('titre', 'spip_articles', 'id_article='.intval($valeurs['id_article']));
	}
	$valeurs['id_parent'] = $valeurs['id_article'];
	unset($valeurs['id_article']);
	// pour le selecteur d'article(s) optionnel
	$valeurs['parents_id'] = array('article|'.$valeurs['id_parent']);

	// fixer la date par defaut en cas de creation d'evenement
	if (!intval($id_evenement)) {
		$t=time();
		$valeurs['date_debut'] = date('Y-m-d H:i:00', $t);
		$valeurs['date_fin'] = date('Y-m-d H:i:00', $t+3600);
		$valeurs['horaire'] = 'oui';
	}

	// les repetitions
	$valeurs['repetitions'] = array();
	if (intval($id_evenement)) {
		$repetitons = sql_allfetsel('date_debut', 'spip_evenements', 'id_evenement_source='.intval($id_evenement), '', 'date_debut');
		foreach ($repetitons as $d) {
			$valeurs['repetitions'][] = date('d/m/Y', strtotime($d['date_debut']));
		}
	}
	$valeurs['repetitions'] = implode(',', $valeurs['repetitions']);

	// dispatcher date et heure
	list($valeurs['date_debut'], $valeurs['heure_debut']) = explode(' ', date('d/m/Y H:i', strtotime($valeurs['date_debut'])));
	list($valeurs['date_fin'], $valeurs['heure_fin']) = explode(' ', date('d/m/Y H:i', strtotime($valeurs['date_fin'])));

	// traiter specifiquement l'horaire qui est une checkbox
	if (_request('date_debut') and !_request('horaire')) {
		$valeurs['horaire'] = 'oui';
	}

	// Pouvoir interdire l'affichage de l'inscription (puisque ce n'est pas traite' par le plugin)
	$valeurs['affiche_inscription'] = isset($GLOBALS['agenda_affiche_inscription']) ? $GLOBALS['agenda_affiche_inscription'] : false;

	$valeurs['places'] = intval($valeurs['places']);

	return $valeurs;
}

/**
 * Identifier le formulaire en faisant abstraction des parametres qui
 * ne representent pas l'objet edite
 */
function formulaires_editer_evenement_identifier_dist($id_evenement = 'new', $id_article = 0, $retour = '', $lier_trad = 0, $config_fonc = 'evenements_edit_config', $row = array(), $hidden = '') {
	return serialize(array(intval($id_evenement),$lier_trad));
}


function evenements_edit_config() {
	return array();
}

function formulaires_editer_evenement_verifier_dist($id_evenement = 'new', $id_article = 0, $retour = '', $lier_trad = 0, $config_fonc = 'evenements_edit_config', $row = array(), $hidden = '') {
	$erreurs = formulaires_editer_objet_verifier('evenement', $id_evenement, array('titre', 'date_debut', 'date_fin'));
	include_spip('inc/date_gestion');

	$horaire = _request('horaire') == 'non' ? false : true;
	if (empty($erreurs['date_debut'])) {
		$date_debut = verifier_corriger_date_saisie('debut', $horaire, $erreurs);
	}
	if (empty($erreurs['date_fin'])) {
		$date_fin = verifier_corriger_date_saisie('fin', $horaire, $erreurs);
	}

	if ($date_debut and $date_fin and $date_fin < $date_debut) {
		$erreurs['date_fin'] = _T('agenda:erreur_date_avant_apres');
	}

	include_spip('formulaires/selecteur/selecteur_fonctions');
	if (count($id = picker_selected(_request('parents_id'), 'article'))
		and $id = reset($id)
		and $id = sql_getfetsel('id_article', 'spip_articles', 'id_article='.intval($id))) {
		// reinjecter dans id_parent
		set_request('id_parent', $id);
	}

	if (!$id_parent = intval(_request('id_parent'))) {
		$erreurs['id_parent'] = _T('agenda:erreur_article_manquant');
	} else {
		if (!autoriser('creerevenementdans', 'article', $id_parent)) {
			$erreurs['id_parent'] = _T('agenda:erreur_article_interdit');
		}
	}

	#if (!count($erreurs))
	#	$erreurs['message_erreur'] = 'ok?';
	return $erreurs;
}

function formulaires_editer_evenement_traiter_dist($id_evenement = 'new', $id_article = 0, $retour = '', $lier_trad = 0, $config_fonc = 'evenements_edit_config', $row = array(), $hidden = '') {
	set_request('horaire', _request('horaire') == 'non' ? 'non' : 'oui');
	set_request('inscription', _request('inscription') ? 1 : 0);
	include_spip('inc/date_gestion');
	$erreurs = array();
	$date_debut = verifier_corriger_date_saisie('debut', _request('horaire') == 'oui', $erreurs);
	$date_fin = verifier_corriger_date_saisie('fin', _request('horaire') == 'oui', $erreurs);
	set_request('date_debut', date('Y-m-d H:i:s', $date_debut));
	set_request('date_fin', date('Y-m-d H:i:s', $date_fin));

	$res = formulaires_editer_objet_traiter('evenement', $id_evenement, $id_article, 0, $retour, $config_fonc, $row, $hidden);
	// si c'est une creation dans un article publie, passer l'evenement en publie, si le plugin est configuré pour
	// l'article peut être renseigné/modifié par l'utilisateur dans le formulaire. On le retrouve.
	if (!intval($id_evenement)
		and $id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.$res['id_evenement'])
		and objet_test_si_publie('article', $id_article)
		and lire_config('agenda/synchro_statut')
	) {
		// sera refuse si auteur pas autorise
		evenement_modifier($res['id_evenement'], array('statut' => 'publie'));
	}
	// a la creation, documenter la date de creation
	if (!intval($id_evenement)) {
		evenement_modifier($res['id_evenement'], array('date_creation' => date('Y-m-d H:i:s')));
	}

	$id_evenement = $res['id_evenement'];
	if ($res['redirect']) {
		if (strpos($res['redirect'], 'article') !== false) {
			$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id_evenement));
			$res['redirect'] = parametre_url($res['redirect'], 'id_article', $id_article);
		}
	}
	return $res;
}
