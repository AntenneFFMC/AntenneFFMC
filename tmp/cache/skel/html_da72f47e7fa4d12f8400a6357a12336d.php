<?php

/*
 * Squelette : ../prive/squelettes/inclure/menu-navigation.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:12 GMT
 * Boucles :   _menusous, _menu
 */ 

function BOUCLE_menusoushtml_da72f47e7fa4d12f8400a6357a12336d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(interdire_scripts(safehtml((isset($Pile[$SP]['sousmenu'])?$Pile[$SP]['sousmenu']:(@$Pile[0]['sousmenu'])))));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_menusous';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"favori",
		".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/menu-navigation.html','html_da72f47e7fa4d12f8400a6357a12336d','_menusous',9,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
		' .
(($t1 = strval(interdire_scripts(((safehtml((isset($Pile[$SP]['favori'])?$Pile[$SP]['favori']:((isset($Pile[$SP-1]['favori'])?$Pile[$SP-1]['favori']:(@$Pile[0]['favori'])))))) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'has_favoris'] = '1')) :
		'') .
'
		' .
(($t1 = strval(interdire_scripts(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle'))))))!=='' ?
		((	'<li class="item' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'exec', null),true) == interdire_scripts(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle'])))))) ?' ' :''))))!=='' ?
			($t2 . 'on execfound') :
			'') .
	(($t2 = strval(interdire_scripts((safehtml((isset($Pile[$SP]['favori'])?$Pile[$SP]['favori']:((isset($Pile[$SP-1]['favori'])?$Pile[$SP-1]['favori']:(@$Pile[0]['favori']))))) ? 'favori':(table_valeur($Pile["vars"], (string)'has_favoris', null) ? 'non_favori':'')))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
			<a href="' .
	interdire_scripts(bandeau_creer_url(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle']))),interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'urlArg'))),@serialize($Pile[0]))) .
	'" class="bando2_' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'">
				') . $t1 . '
			</a>
		</li>') :
		'') .
'
	');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_menusous @ ../prive/squelettes/inclure/menu-navigation.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_menuhtml_da72f47e7fa4d12f8400a6357a12336d(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'boutons', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_menu';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"sousmenu",
		"favori");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('=', 'cle', sql_quote(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'menu', null),true)), '', 'STRING')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/menu-navigation.html','html_da72f47e7fa4d12f8400a6357a12336d','_menu',3,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
' .
interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'bloc', null),true) == 'contenu') ? (	'<h1 class="grostitre">' .
	interdire_scripts(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle')))) .
	'</h1>'):'<div class="navigation">')) .
'

	<ul class=\'liste_items sous_navigation\'>
	' .
BOUCLE_menusoushtml_da72f47e7fa4d12f8400a6357a12336d($Cache, $Pile, $doublons, $Numrows, $SP) .
'
	</ul>

' .
(($t1 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'bloc', null),true) != 'contenu')) ?' ' :''))))!=='' ?
		($t1 . '</div>') :
		'') .
'
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_menu @ ../prive/squelettes/inclure/menu-navigation.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/squelettes/inclure/menu-navigation.html
// Temps de compilation total: 12.640 ms
//

function html_da72f47e7fa4d12f8400a6357a12336d($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
vide($Pile['vars'][$_zzz=(string)'boutons'] = trier_boutons_enfants_par_favoris_alpha(definir_barre_boutons(definir_barre_contexte(@serialize($Pile[0])),'0'))) .
BOUCLE_menuhtml_da72f47e7fa4d12f8400a6357a12336d($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_da72f47e7fa4d12f8400a6357a12336d', $Cache, $page, '../prive/squelettes/inclure/menu-navigation.html');
}
?>