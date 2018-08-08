<?php

/*
 * Squelette : squelettes/inclure/inc_robots-do.html
 * Date :      Wed, 01 Aug 2018 17:03:56 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:27 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/inc_robots-do.html
// Temps de compilation total: 0.195 ms
//

function html_6d7b171c432f1021a17d3c5a999a3709($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '<meta name="robots" content="doindex, dofollow" />
<meta name="Googlebot" content="doindex, dofollow" />
<meta name="Slurp" content="doindex, dofollow" />
<meta name="msnbot" content="doindex, dofollow" />
';

	return analyse_resultat_skel('html_6d7b171c432f1021a17d3c5a999a3709', $Cache, $page, 'squelettes/inclure/inc_robots-do.html');
}
?>