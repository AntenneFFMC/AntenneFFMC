<?php

/*
 * Squelette : ../plugins-dist/forum/prive/objets/configurer/moderation.html
 * Date :      Wed, 14 Mar 2018 16:27:58 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/forum/prive/objets/configurer/moderation.html
// Temps de compilation total: 3.834 ms
//

function html_38c0af2cc44a9747a452b95bd6f2d81f($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class=\'ajax\'>
' .
executer_balise_dynamique('FORMULAIRE_ACTIVER_FORUMS_OBJET',
	array(@$Pile[0]['id_objet'],interdire_scripts(@$Pile[0]['objet'])),
	array('../plugins-dist/forum/prive/objets/configurer/moderation.html','html_38c0af2cc44a9747a452b95bd6f2d81f','',2,$GLOBALS['spip_lang'])) .
'</div>');

	return analyse_resultat_skel('html_38c0af2cc44a9747a452b95bd6f2d81f', $Cache, $page, '../plugins-dist/forum/prive/objets/configurer/moderation.html');
}
?>