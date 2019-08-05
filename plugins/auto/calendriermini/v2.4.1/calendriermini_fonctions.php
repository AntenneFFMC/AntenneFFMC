<?php

/**
 * Balises et critères du calendrier mini
 *
 * @package SPIP\CalendrierMini\Fonctions
**/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;	#securite
}

if (!defined('VAR_DATE')) {
	define('VAR_DATE', 'archives');
}

function balise_DATE_ARCHIVES($p) {
	$p->code = "_request('".VAR_DATE."')";

	#$p->interdire_scripts = true;
	return $p;
}

function critere_archives($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	$objet = objet_type($boucle->id_table);
	$date = objet_info($objet, 'date');
	$champ_date = "'" . $boucle->id_table .'.' .
	$date . "'";
	$boucle->where[] = array(
		"'REGEXP'",
		$champ_date,
		"sql_quote(('^' . interdire_scripts(entites_html(@\$Pile[0]['".VAR_DATE."']))))"
	);
}

/**
 * Crée un array d'un intervalle de jour entre la date de début $start et la date de fin $end
 *
 * $start datetime SQL - La date de début
 * $end datetime SQL La date de fin
 */
function calendriermini_intervalle($start, $end = false) {
	$jours = array();
	$starttime = strtotime($start);
	$startdate = date('Y-m-d', $starttime);
	$jours[] = $startdate;
	if (!$end) {
		return $jours;
	}
	$enddate = date('Y-m-d', strtotime($end));
	$starttime = $starttime + (3600*24);
	while (($date_test = date('Y-m-d', $starttime)) < $enddate) {
		$jours[] = $date_test;
		$starttime = $starttime + (3600*24);
	}
	$jours[] = $enddate;
	return array_unique($jours);
}
