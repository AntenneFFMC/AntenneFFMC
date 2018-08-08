<?php

/*
 * Squelette : ../prive/squelettes/navigation/article.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:47 GMT
 * Boucles :   _nav
 */ 

function BOUCLE_navhtml_a6793cb8d94ae2ca965242bb92a206ea(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'exec', null),true) == 'article'));

	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_nav';
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
			array('=', 'articles.id_article', sql_quote(@$Pile[0]['id_article'], '','bigint(21) NOT NULL AUTO_INCREMENT')), 
			array('REGEXP', 'articles.statut', "'.*'"));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../prive/squelettes/navigation/article.html','html_a6793cb8d94ae2ca965242bb92a206ea','_nav',1,$GLOBALS['spip_lang'])
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
boite_ouvrir('', 'info') .
pipeline( 'boite_infos' , array('data' => '', 'args' => array('type' => 'article', 'id' => interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true)))) ) .
boite_fermer() .
'

<div class="ajax">
' .
executer_balise_dynamique('FORMULAIRE_EDITER_LOGO',
	array('article',$Pile[$SP]['id_article'],'',@serialize($Pile[0])),
	array('../prive/squelettes/navigation/article.html','html_a6793cb8d94ae2ca965242bb92a206ea','_nav',5,$GLOBALS['spip_lang'])) .
'</div>

' .
pipeline( 'afficher_config_objet' , array('args' => array('type' => 'article', 'id' => $Pile[$SP]['id_article']), 'data' => '') ) .
'<div class="ajax">
' .
executer_balise_dynamique('FORMULAIRE_REDIRIGER_ARTICLE',
	array(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true))),
	array('../prive/squelettes/navigation/article.html','html_a6793cb8d94ae2ca965242bb92a206ea','_nav',8,$GLOBALS['spip_lang'])) .
'</div>

');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_nav @ ../prive/squelettes/navigation/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/squelettes/navigation/article.html
// Temps de compilation total: 20.553 ms
//

function html_a6793cb8d94ae2ca965242bb92a206ea($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (($t1 = BOUCLE_navhtml_a6793cb8d94ae2ca965242bb92a206ea($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		$t1 :
		((	'
' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'exec', null),true) == 'article_edit')) ?' ' :''))))!=='' ?
			($t2 . 
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/squelettes/navigation/article_edit') . ', array_merge('.var_export($Pile[0],1).',array(\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/squelettes/navigation/article.html\',\'html_a6793cb8d94ae2ca965242bb92a206ea\',\'\',17,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>') :
			'') .
	'
')));

	return analyse_resultat_skel('html_a6793cb8d94ae2ca965242bb92a206ea', $Cache, $page, '../prive/squelettes/navigation/article.html');
}
?>