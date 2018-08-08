<?php

/*
 * Squelette : ../prive/squelettes/navigation/rubriques.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:28:01 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/navigation/rubriques.html
// Temps de compilation total: 1.926 ms
//

function html_c5d0f1a27245daf917221ac4c36d3834($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="ajax">
' .
executer_balise_dynamique('FORMULAIRE_EDITER_LOGO',
	array('rubrique','0','',@serialize($Pile[0])),
	array('../prive/squelettes/navigation/rubriques.html','html_c5d0f1a27245daf917221ac4c36d3834','',2,$GLOBALS['spip_lang'])) .
'</div>
');

	return analyse_resultat_skel('html_c5d0f1a27245daf917221ac4c36d3834', $Cache, $page, '../prive/squelettes/navigation/rubriques.html');
}
?>