<?php

/*
 * Squelette : ../prive/objets/infos/article.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:47 GMT
 * Boucles :   _publie, _art
 */ 

function BOUCLE_publiehtml_8560a1219b55c54ae80f73ada788a180(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_publie';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.lang",
		"articles.titre");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_article', sql_quote($Pile[$SP]['id_article'], '','bigint(21) NOT NULL AUTO_INCREMENT')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../prive/objets/infos/article.html','html_8560a1219b55c54ae80f73ada788a180','_publie',12,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
	' .
filtre_icone_horizontale_dist(parametre_url(generer_url_action('redirect',(	'type=article&id=' .
	$Pile[$SP]['id_article'])),'var_mode','calcul'),_T('public|spip|ecrire:icone_voir_en_ligne'),'racine') .
'
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_publie @ ../prive/objets/infos/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_arthtml_8560a1219b55c54ae80f73ada788a180(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['statut']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_art';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.id_article",
		"articles.statut");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('=', 'articles.id_article', sql_quote(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)), '', 'bigint(21) NOT NULL AUTO_INCREMENT')), (!(is_array(@$Pile[0]['statut'])?count(@$Pile[0]['statut']):strlen(@$Pile[0]['statut'])) ? '' : ((is_array(@$Pile[0]['statut'])) ? sql_in('articles.statut',sql_quote($in)) : 
			array('=', 'articles.statut', sql_quote(@$Pile[0]['statut'], '','varchar(10) NOT NULL DEFAULT \'0\'')))));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../prive/objets/infos/article.html','html_8560a1219b55c54ae80f73ada788a180','_art',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:info_numero_article');
	$l2 = _T('public|spip|ecrire:previsualiser');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
<div class=\'infos\'>
<div class=\'numero\'>' .
$l1 .
'<p>' .
$Pile[$SP]['id_article'] .
'</p></div>

' .
executer_balise_dynamique('FORMULAIRE_INSTITUER_OBJET',
	array('article',$Pile[$SP]['id_article']),
	array('../prive/objets/infos/article.html','html_8560a1219b55c54ae80f73ada788a180','_art',5,$GLOBALS['spip_lang'])) .
'


' .
(($t1 = BOUCLE_publiehtml_8560a1219b55c54ae80f73ada788a180($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		$t1 :
		((	'
	' .
	(($t2 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('previsualiser', 'article', invalideur_session($Cache, $Pile[$SP]['id_article']), '', invalideur_session($Cache, array('statut' => interdire_scripts(invalideur_session($Cache, $Pile[$SP]['statut'])))))?" ":""))))!=='' ?
			($t2 . (	'
		' .
		filtre_icone_horizontale_dist(parametre_url(generer_url_action('redirect',(	'type=article&id=' .
			$Pile[$SP]['id_article'])),'var_mode','preview'),$l2,'preview') .
		'
	')) :
			'') .
	'
'))) .
'


</div>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_art @ ../prive/objets/infos/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/objets/infos/article.html
// Temps de compilation total: 8.721 ms
//

function html_8560a1219b55c54ae80f73ada788a180($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = BOUCLE_arthtml_8560a1219b55c54ae80f73ada788a180($Cache, $Pile, $doublons, $Numrows, $SP);

	return analyse_resultat_skel('html_8560a1219b55c54ae80f73ada788a180', $Cache, $page, '../prive/objets/infos/article.html');
}
?>