<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2017                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Post-traitement des formulaires d'édition d'objets, lors d'une création d’une nouvelle traduction
 *
 * @package SPIP\Core\Objets
 **/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Compléter une nouvelle traduction avec des éléments utiles.
 *
 * @param string $objet Objet
 * @param int $id_objet Identifiant du nouvel objet
 * @param int $id_trad Identifiant de l’objet qu'on a traduit
 * @return string Erreur éventuelle
 */
function inc_completer_traduction_dist($objet, $id_objet, $id_trad) {
	// dupliquer tous les liens sauf les auteurs : le nouvel auteur est celui qui traduit
	// cf API editer_liens
	include_spip('action/editer_liens');
	objet_dupliquer_liens($objet, $id_trad, $id_objet, null, array('auteur'));
	$_id_table = id_table_objet($objet);

	// recuperer le logo
	$chercher_logo = charger_fonction('chercher_logo','inc');
	include_spip('action/editer_logo');
	foreach (array('on', 'off') as $etat) {
		$logo = $chercher_logo($id_trad, $_id_table, $etat);
		if ($logo AND $file = reset($logo)) {
			logo_modifier($objet, $id_objet, $etat, $file);
		}
	}

	// dupliquer certains champs
	$trouver_table = charger_fonction('trouver_table','base');
	$desc = $trouver_table(table_objet_sql($objet));
	$champs = $set = array();

	// un éventuel champ 'virtuel' (redirections)
	if (!empty($desc['field']['virtuel'])) {
		$champs[] = 'virtuel';
	}

	if ($champs) {
		$set = sql_fetsel($champs, $desc['table'], $_id_table . '=' . intval($id_trad));
	}

	/*
	 * Le pipeline 'pre_edition' sera appelé avec l'action 'completer_traduction'.
	 * Des plugins pourront ainsi compléter les champs d'un objet traduit lors d'une nouvelle traduction.
	 */
	$err = objet_modifier_champs(
		$objet,
		$id_objet,
		array(
			'data' => $set,
			'action' => 'completer_traduction',
		),
		$set
	);

	return $err;
}