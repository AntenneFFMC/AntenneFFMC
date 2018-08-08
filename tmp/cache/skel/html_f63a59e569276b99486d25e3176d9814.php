<?php

/*
 * Squelette : squelettes/inclure/inc_styles.html
 * Date :      Wed, 01 Aug 2018 21:54:00 GMT
 * Compile :   Wed, 08 Aug 2018 10:18:24 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/inc_styles.html
// Temps de compilation total: 1.197 ms
//

function html_f63a59e569276b99486d25e3176d9814($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<!-- MISE EN FORME -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="' .
find_in_path('styles/global.min.css') .
'" />
');

	return analyse_resultat_skel('html_f63a59e569276b99486d25e3176d9814', $Cache, $page, 'squelettes/inclure/inc_styles.html');
}
?>