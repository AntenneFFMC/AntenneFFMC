<?php

/*
 * Squelette : squelettes/inclure/inc_desc.html
 * Date :      Wed, 01 Aug 2018 17:03:56 GMT
 * Compile :   Wed, 08 Aug 2018 10:18:24 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette squelettes/inclure/inc_desc.html
// Temps de compilation total: 0.408 ms
//

function html_67cfe49a05ad461c115ab5ebd91fcbfc($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<!-- DESCRIPTION -->

<meta name="author" content="' .
interdire_scripts(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0])) .
'" />
<meta name="Description" content="la FFMC agit pour développer la pratique des deux-roues motorisés ou engins assimilés. Elle défend, sans corporatisme, leurs utilisateurs en tant qu\'usagers de la route et en tant que consommateurs. Elle agit pour la sécurité et le partage de la route sur la base du développement de l\'information, de la prévention, et de la formation, et pour faire prévaloir la connaissance et la prise de conscience plutôt que les mesures répressives" />
<meta name="Keywords" content="moto, motard, colère, motard en colère, colere, motards en colère, ffmc69, ffmc, rhône, rhone, Rhone, Rhône, sécurité routière, route, partage, rails, guillotine, infrastructures, feux de jour, pollution, controle technique, contrôle, motostra, amdm, mutuelle, stop vol, motomag, afdm, formation" />
');

	return analyse_resultat_skel('html_67cfe49a05ad461c115ab5ebd91fcbfc', $Cache, $page, 'squelettes/inclure/inc_desc.html');
}
?>