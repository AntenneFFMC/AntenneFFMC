<?php

/*
 * Squelette : ../prive/squelettes/inclure/favicon-head.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:01 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/inclure/favicon-head.html
// Temps de compilation total: 4.439 ms
//

function html_dad475ceba8bd3cce1e09dd9831b8c50($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
(($t1 = strval(interdire_scripts((((include_spip('inc/config')?lire_config('image_process',null,false):'')) ?' ' :''))))!=='' ?
		($t1 . (	'
	' .
	vide($Pile['vars'][$_zzz=(string)'fichier'] = interdire_scripts(((($a = table_valeur(@$Pile[0], (string)'favicon', null)) OR (is_string($a) AND strlen($a))) ? $a : find_in_path('images/favicon-spip.png')))) .
	'

	
	' .
	(($t2 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true)) ?' ' :''))))!=='' ?
			($t2 . vide($Pile['vars'][$_zzz=(string)'fichier'] = appliquer_filtre(table_valeur($Pile["vars"], (string)'fichier', null),'image_sepia',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'couleur', null),true))))) :
			'') .
	'

	
	' .
	vide($Pile['vars'][$_zzz=(string)'fichier-32'] = filtrer('image_graver',filtrer('image_recadre',filtrer('image_passe_partout',table_valeur($Pile["vars"], (string)'fichier', null),'32','32'),'32','32','center'))) .
	'

	' .
	(($t2 = strval(url_absolue(extraire_attribut(timestamp(filtrer('image_graver', filtrer('image_format',table_valeur($Pile["vars"], (string)'fichier-32', null),'ico'))),'src'))))!=='' ?
			('<link rel="shortcut icon" href="' . $t2 . '" type="image/x-icon" />') :
			'') .
	'
')) :
		'') .
'
' .
(($t1 = strval(interdire_scripts((((include_spip('inc/config')?lire_config('image_process',null,false):'')) ?'' :' '))))!=='' ?
		($t1 . (	'
	' .
	(($t2 = strval(url_absolue(timestamp(find_in_path('spip.ico')))))!=='' ?
			('<link rel="shortcut icon" href="' . $t2 . '" type="image/x-icon" />') :
			'') .
	'
')) :
		'') .
'
' .
'<' . '?php header("X-Spip-Filtre: '.'trim' . '"); ?'.'>');

	return analyse_resultat_skel('html_dad475ceba8bd3cce1e09dd9831b8c50', $Cache, $page, '../prive/squelettes/inclure/favicon-head.html');
}
?>