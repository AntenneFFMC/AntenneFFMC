<?php

/*
 * Squelette : ../prive/formulaires/inc-choisir-objets.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:13 GMT
 * Boucles :   _objets, _par_traduction
 */ 

function BOUCLE_objetshtml_60ee6d92b6ba5378fe68751166cf7924(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'exclus', null), ''),true))))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(lister_tables_objets_sql(''));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_objets';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"editable",
		".cle",
		"texte_objets");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(sql_in('cle',sql_quote($in),'NOT'));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/formulaires/inc-choisir-objets.html','html_60ee6d92b6ba5378fe68751166cf7924','_objets',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (($t1 = strval(interdire_scripts(((safehtml((isset($Pile[$SP]['editable'])?$Pile[$SP]['editable']:(@$Pile[0]['editable'])))) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	vide($Pile['vars'][$_zzz=(string)'traductions'] = array_merge(table_valeur($Pile["vars"], (string)'traductions', null),array(interdire_scripts(safehtml($Pile[$SP]['cle'])) => interdire_scripts(_T(safehtml((isset($Pile[$SP]['texte_objets'])?$Pile[$SP]['texte_objets']:(@$Pile[0]['texte_objets'])))))))) .
	'
')) :
		'');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_objets @ ../prive/formulaires/inc-choisir-objets.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_par_traductionhtml_60ee6d92b6ba5378fe68751166cf7924(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'traductions', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_par_traduction';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle");
		$command['orderby'] = array('valeur');
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
		array('../prive/formulaires/inc-choisir-objets.html','html_60ee6d92b6ba5378fe68751166cf7924','_par_traduction',3,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
' .
vide($Pile['vars'][$_zzz=(string)'id'] = interdire_scripts(concat(replace(entites_html(table_valeur(@$Pile[0], (string)'name', null),true),'\\W','_'),'_',interdire_scripts(safehtml($Pile[$SP]['cle']))))) .
'<div class="choix choix_' .
interdire_scripts(safehtml($Pile[$SP]['cle'])) .
'">
	<input type="checkbox"  id="' .
table_valeur($Pile["vars"], (string)'id', null) .
'" name="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'name', null),true)) .
'[]" value="' .
interdire_scripts(safehtml($Pile[$SP]['cle'])) .
'"' .
(($t1 = strval(interdire_scripts(((((entites_html(table_valeur(@$Pile[0], (string)'selected', null),true) == 'all')) OR (interdire_scripts(in_any(safehtml($Pile[$SP]['cle']),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'selected', null),true)))))) ?' ' :''))))!=='' ?
		($t1 . 'checked="checked"') :
		'') .
' />
	<label for="' .
table_valeur($Pile["vars"], (string)'id', null) .
'">' .
interdire_scripts(safehtml($Pile[$SP]['valeur'])) .
'</label>
</div>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_par_traduction @ ../prive/formulaires/inc-choisir-objets.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/formulaires/inc-choisir-objets.html
// Temps de compilation total: 13.760 ms
//

function html_60ee6d92b6ba5378fe68751166cf7924($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
vide($Pile['vars'][$_zzz=(string)'traductions'] = array()) .
BOUCLE_objetshtml_60ee6d92b6ba5378fe68751166cf7924($Cache, $Pile, $doublons, $Numrows, $SP) .
BOUCLE_par_traductionhtml_60ee6d92b6ba5378fe68751166cf7924($Cache, $Pile, $doublons, $Numrows, $SP) .
'
<input type="hidden" name="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'name', null),true)) .
'[]" value="" />
');

	return analyse_resultat_skel('html_60ee6d92b6ba5378fe68751166cf7924', $Cache, $page, '../prive/formulaires/inc-choisir-objets.html');
}
?>