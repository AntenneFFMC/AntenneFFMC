<?php

/**
 * Action ordonnant un lien sur une table de liens
 *
 * @plugin     Medias
 * @copyright  2017
 * @author     Matthieu Marcillaud
 * @licence    GNU/GPL
 * @package    SPIP\Ordoc\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function action_ordonner_liens_documents_dist() {
	action_ordonner_liens_dist();
}


function action_ordonner_liens_dist() {
	include_spip('inc/autoriser');
	include_spip('base/objets');
	include_spip('action/editer_liens');

	// source (table spip_xx_liens)
	$objet = objet_type(_request('objet_source'));

	// objet lié
	$objet_lie = _request('objet_lie');
	$id_objet_lie = intval(_request('id_objet_lie'));

	// ordre des éléments
	$ordre = _request('ordre');

	if (!$objet or !$objet_lie or !$id_objet_lie OR !$ordre or !objet_associable($objet)) {
		return envoyer_json_erreur(_T('medias:erreur_objet_absent') . ' ' . _T('medias:erreur_deplacement_impossible'));
	}

	if (!autoriser('modifier', $objet_lie, $id_objet_lie)) {
		return envoyer_json_erreur(_T('medias:erreur_autorisation') . ' ' . _T('medias:erreur_deplacement_impossible'));
	}

	list($_id_objet, $table_liens) = objet_associable($objet);

	$success = $errors = array();

	$actuels = sql_allfetsel(
		array($_id_objet . ' AS id', 'rang_lien'),
		$table_liens,
		array(
			sql_in($_id_objet, $ordre),
			'objet = ' . sql_quote($objet_lie),
			'id_objet = ' . sql_quote($id_objet_lie)
		)
	);

	$futurs = array_flip($ordre);
	// ordre de 1 à n (pas de 0 à n).
	array_walk($futurs, function(&$v) { $v++; });

	$updates = array();

	foreach ($actuels as $l) {
		if ($futurs[$l['id']] !== $l['rang_lien']) {
			$updates[$l['id']] = $futurs[$l['id']];
		}
	}

	if ($updates) {
		foreach ($updates as $id => $ordre) {
			sql_updateq(
				$table_liens,
				array('rang_lien' => $ordre),
				array(
					$_id_objet . ' = ' . $id,
					'objet = ' . sql_quote($objet_lie),
					'id_objet = ' . sql_quote($id_objet_lie)
				)
			);
		}
	}

	return envoyer_json_envoi(array(
		'done' => true,
		'success' => $success,
		'errors' => $errors,
	));
}

function envoyer_json_envoi($data) {
	header('Content-Type: application/json; charset=' . $GLOBALS['meta']['charset']);
	echo json_encode($data);
}

function envoyer_json_erreur($msg) {
	return envoyer_json_envoi(array(
		'done' => false,
		'success' => array(),
		'errors' => array($msg)
	));
}
