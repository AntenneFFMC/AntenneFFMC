<?php

/*
 * Squelette : squelettes/inclure/inc_fonts.html
 * Date :      Wed, 01 Aug 2018 17:03:56 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:27 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/inc_fonts.html
// Temps de compilation total: 0.173 ms
//

function html_47b2ac6323ee15c87e00ec4d5f360b5e($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '<!-- POLICES D\'ECRITURE -->

<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet" />
';

	return analyse_resultat_skel('html_47b2ac6323ee15c87e00ec4d5f360b5e', $Cache, $page, 'squelettes/inclure/inc_fonts.html');
}
?>