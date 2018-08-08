<?php

/*
 * Squelette : ../prive/squelettes/navigation/article_edit.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:57 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/navigation/article_edit.html
// Temps de compilation total: 0.142 ms
//

function html_dd0db58b6a04aeb208bca3e769d2c442($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = '';

	return analyse_resultat_skel('html_dd0db58b6a04aeb208bca3e769d2c442', $Cache, $page, '../prive/squelettes/navigation/article_edit.html');
}
?>