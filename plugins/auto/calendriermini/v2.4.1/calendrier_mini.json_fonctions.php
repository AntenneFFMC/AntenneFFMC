<?php
/**
 * Fichier de fonction du json du calendrier mini
 *
 * @package SPIP\CalendrierMini\Fonctions
**/
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

include_spip('inc/json');

/**
 * Transforme un timestamp en date au format SQL
 *
 * @param int $t Timestamp
 * @return string Date au format SQL
**/
function todate($t) {
	return date('Y-m-d H:i:s', $t);
}
