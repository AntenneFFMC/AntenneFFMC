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

function formulaires_participer_evenement_charger_dist($id_evenement, $mode = '') {
	$valeurs = array(
		'nom' => isset($GLOBALS['visiteur_session']['id_auteur']) ? $GLOBALS['visiteur_session']['nom'] : _request('nom'),
		'email' => isset($GLOBALS['visiteur_session']['id_auteur']) ? $GLOBALS['visiteur_session']['email'] : _request('email'),
		'reponse' => _request('reponse'),
	);
	// si pas d'evenement ou d'inscription, on echoue silencieusement
	if (!$row = sql_fetsel('inscription,places', 'spip_evenements', 'id_evenement='.intval($id_evenement).' AND date_fin>NOW()')
		or !$row['inscription']) {
		return false;
	}

	// si anonyme, on echoue avec avertissement
	if ($mode!='public'
		&& (!isset($GLOBALS['visiteur_session']['id_auteur'])
		|| !$GLOBALS['visiteur_session']['id_auteur'])) {
		return array(
			'message_erreur'=>_T('agenda:connexion_necessaire_pour_inscription'),
			'editable'=>false
		);
	}

	// valeurs d'initialisation
	$valeurs['id'] = $id_evenement;
	if (isset($GLOBALS['visiteur_session']['id_auteur'])) {
		$valeurs['reponse'] = sql_getfetsel('reponse', 'spip_evenements_participants', 'id_evenement='.intval($id_evenement).' AND id_auteur='.intval($GLOBALS['visiteur_session']['id_auteur']));
	}

	// si les places sont comptees, regarder si il en reste
	if ($places = $row['places']) {
		$ok = sql_countsel('spip_evenements_participants', 'id_evenement='.intval($id_evenement)." AND reponse='oui'");
		$peutetre = sql_countsel('spip_evenements_participants', 'id_evenement='.intval($id_evenement)." AND reponse='?'");
		// Les reponses PEUT-ETRE sont ponderees a 0,5 donc
		// on multiplie tout par 2 pour eviter les troncatures ($total ne sert de toute facon que dans les tests)
		$total = 2*$ok+$peutetre;
		if ($total >= 2*$places) {
			// dans ce cas, le formulaire est editable seulement si l'auteur a deja repondu oui ou peut-etre, et peut changer d'avis !
			if (!($valeurs['reponse']=='oui' or $valeurs['reponse']=='?')) {
				$valeurs['editable'] = false;
				$valeurs['message_ok'] = _T('agenda:evenement_complet');
			}
		}
	}

	return $valeurs;
}

function formulaires_participer_evenement_verifier_dist($id_evenement, $mode = '') {
	$erreurs = array();
	$reponse = _request('reponse');
	$nom = _request('nom');
	$email = _request('email');
	// Le test de la ligne suivante sert a savoir si la reponse est vide, non?
	// On vient juste de la recuperer ci-dessus, pas la peine de la reaffecter...
	if (!($reponse) or !in_array($reponse, array('oui', 'non', '?'))) {
		$erreurs['reponse'] = _T('agenda:indiquez_votre_choix');
	} elseif ($mode == 'public' and !isset($GLOBALS['visiteur_session']['id_auteur'])) {
		// nom et email sont obligatoires
		if (!$nom) {
			$erreurs['nom'] = _T('info_obligatoire');
		}
		if (!$email) {
			$erreurs['email'] = _T('info_obligatoire');
		}
		// pas de double inscription avec le même email
		if (sql_fetsel('reponse', 'spip_evenements_participants', 'id_evenement='.intval($id_evenement).' AND email='.sql_quote($email))) {
			$erreurs['email'] = _T('erreur_email_deja_existant');
		}
	} elseif ($reponse!=='non' && isset($GLOBALS['visiteur_session']['id_auteur'])) {
		$row = sql_fetsel('places', 'spip_evenements', 'id_evenement='.intval($id_evenement));
		$valeurs['reponse'] = sql_getfetsel('reponse', 'spip_evenements_participants', 'id_evenement='.intval($id_evenement).' AND id_auteur='.intval($GLOBALS['visiteur_session']['id_auteur']));
		if ($places = $row['places'] and $valeurs['reponse']!==$reponse) {
			$ok = sql_countsel('spip_evenements_participants', 'id_evenement='.intval($id_evenement)." AND reponse='oui'");
			$peutetre = sql_countsel('spip_evenements_participants', 'id_evenement='.intval($id_evenement)." AND reponse='?'");
			// Les reponses PEUT-ETRE sont ponderees a 0,5 donc
			// on multiplie tout par 2 pour eviter les troncatures ($total ne sert de toute facon que dans les tests)
			$total = 2*$ok+$peutetre;
			if (// Si on est au taquet, le seul cas autorise restant (la reponse NON et la reponse identique sont prises
				// en compte dans les tests ci-dessus) est: transformation d'un OUI en PEUT-ETRE (-0,5)
				($total>=2*$places and !($valeurs['reponse'] == 'oui' and $reponse=='?'))
				or
				// Si il reste un siege PEUT-ETRE, le seul cas interdit restant est: transformation d'un NON en OUI (+1)
				($total==2*$places-1 and ($valeurs['reponse']=='non' and $reponse=='oui'))) {
					$erreurs['reponse'] = _T('agenda:plus_de_place');
			}
		}
	}
	return $erreurs;
}

function formulaires_participer_evenement_traiter_dist($id_evenement) {

	$reponse = _request('reponse');
	$nom = _request('nom');
	$email = _request('email');

	// 1) Visiteur connecté
	if (isset($GLOBALS['visiteur_session']['id_auteur'])) {
		$editable = true;
		// mise à jour d'une réponse existante
		if ($id_evenement_participant = sql_getfetsel(
			'id_evenement_participant',
			'spip_evenements_participants',
			array(
				'id_evenement='.intval($id_evenement),
				'id_auteur='.intval($GLOBALS['visiteur_session']['id_auteur'])
			)
		)) {
			sql_updateq('spip_evenements_participants', array('reponse' => $reponse, 'date' => 'NOW()'), 'id_evenement_participant='.intval($id_evenement_participant));
		// nouvelle réponse
		} else {
			$id_evenement_participant = sql_insertq('spip_evenements_participants', array('id_evenement' => $id_evenement, 'id_auteur' => $GLOBALS['visiteur_session']['id_auteur'], 'reponse' => $reponse, 'date'=>'NOW()'));
		}
	// 2) Visiteur anonyme : nouvelle réponse
	} else {
			$editable = false;
			$id_evenement_participant = sql_insertq('spip_evenements_participants', array('id_evenement' => $id_evenement, 'nom' => $nom, 'email' => $email,'reponse' => $reponse, 'date' => 'NOW()'));
	}
	if ($reponse == 'oui') {
		$message = _T('agenda:participation_prise_en_compte');
	} elseif ($reponse == '?') {
		$message = _T('agenda:participation_incertaine_prise_en_compte');
	} else {
		$message = _T('agenda:absence_prise_en_compte');
	}

	include_spip('inc/invalideur');
	suivre_invalideur("id='evenement/$id_evenement'");

	return array('message_ok'=>$message,'editable'=>$editable, 'id_evenement_participant'=>$id_evenement_participant);
}
