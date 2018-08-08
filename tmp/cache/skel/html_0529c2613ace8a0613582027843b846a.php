<?php

/*
 * Squelette : ../prive/objets/contenu/article.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   _afficher_contenu
 */ 

function BOUCLE_afficher_contenuhtml_0529c2613ace8a0613582027843b846a(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['statut']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_afficher_contenu';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.virtuel",
		"articles.lang",
		"articles.surtitre",
		"articles.titre",
		"articles.soustitre",
		"articles.descriptif",
		"articles.chapo",
		"articles.nom_site",
		"articles.url_site",
		"articles.texte",
		"articles.ps");
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
		array('../prive/objets/contenu/article.html','html_0529c2613ace8a0613582027843b846a','_afficher_contenu',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
(($t1 = strval(interdire_scripts((((((entites_html(sinon(table_valeur(@$Pile[0], (string)'virtuel', null), ''),true)) ?'' :' ')) OR (interdire_scripts(((lien_article_virtuel($Pile[$SP]['virtuel'])) ?'' :' ')))) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	changer_typo(spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang'])) .
	'
<div class="champ contenu_surtitre' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['surtitre']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:texte_sur_titre') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'surtitre\'>' .
	interdire_scripts(typo($Pile[$SP]['surtitre'], "TYPO", $connect, $Pile[0])) .
	'</div>
</div>
<div class="champ contenu_titre' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['titre']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:info_titre') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'titre\'>' .
	interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
	'</div>
</div>
<div class="champ contenu_soustitre' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['soustitre']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:texte_sous_titre') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'soustitre\'>' .
	interdire_scripts(typo($Pile[$SP]['soustitre'], "TYPO", $connect, $Pile[0])) .
	'</div>
</div>
<div class="champ contenu_descriptif' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['descriptif']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:info_descriptif') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'descriptif\'>' .
	interdire_scripts(filtrer('image_graver',filtrer('image_reduire',propre($Pile[$SP]['descriptif'], $connect, $Pile[0]),'500','0'))) .
	'</div>
</div>
<div class="champ contenu_chapo' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['chapo']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:info_chapeau') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'chapo\'>' .
	interdire_scripts(filtrer('image_graver',filtrer('image_reduire',propre($Pile[$SP]['chapo'], $connect, $Pile[0]),'500','0'))) .
	'</div>
</div>
<div class="champ contenu_nom_site' .
	(($t2 = strval(interdire_scripts((strlen(((($a = $Pile[$SP]['nom_site']) OR (is_string($a) AND strlen($a))) ? $a : $Pile[$SP]['url_site'])) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:lien_voir_en_ligne') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'nom_site\'>' .
	(($t2 = strval(calculer_url($Pile[$SP]['url_site'],'','url', $connect)))!=='' ?
			('<a href=\'' . $t2 . '\'>') :
			'') .
	interdire_scripts(typo(supprimer_numero(calculer_url($Pile[$SP]['url_site'],$Pile[$SP]['nom_site'], 'titre', $connect, false)), "TYPO", $connect, $Pile[0])) .
	((calculer_url($Pile[$SP]['url_site'],'','url', $connect))  ?
			(' ' . '</a>') :
			'') .
	'</div>
</div>
<div class="champ contenu_texte' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['texte']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:info_texte') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'texte\'>' .
	interdire_scripts(filtrer('image_graver',filtrer('image_reduire',propre($Pile[$SP]['texte'], $connect, $Pile[0]),'500','0'))) .
	'</div>
</div>
<div class="champ contenu_ps' .
	(($t2 = strval(interdire_scripts((strlen($Pile[$SP]['ps']) ? '':'vide'))))!=='' ?
			(' ' . $t2) :
			'') .
	'">
<div class=\'label\'>' .
	_T('public|spip|ecrire:info_ps') .
	'</div>
<div dir=\'' .
	lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
	'\' class=\'' .
	'ps\'>' .
	interdire_scripts(filtrer('image_graver',filtrer('image_reduire',propre($Pile[$SP]['ps'], $connect, $Pile[0]),'500','0'))) .
	'</div>
</div>
' .
	(($t2 = strval(interdire_scripts(calculer_notes())))!=='' ?
			((	'<div class="champ contenu_notes">
<div class=\'label\'>' .
		_T('public|spip|ecrire:info_notes') .
		'</div>
<div dir=\'' .
		lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
		'\' class=\'' .
		'notes\'>') . $t2 . '</div>
</div>') :
			'') .
	'
' .
	changer_typo('') .
	'
')) :
		'') .
(($t1 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'virtuel', null), ''),true)) ?' ' :''))))!=='' ?
		($t1 . (($t2 = strval(interdire_scripts(lien_article_virtuel($Pile[$SP]['virtuel']))))!=='' ?
			((	'
' .
		boite_ouvrir('', 'info center') .
		'<p>' .
		_T('public|spip|ecrire:info_renvoi_article') .
		'</p>
	') . $t2 . (	'
' .
		boite_fermer() .
		'
')) :
			'')) :
		''));
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_afficher_contenu @ ../prive/objets/contenu/article.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/objets/contenu/article.html
// Temps de compilation total: 13.458 ms
//

function html_0529c2613ace8a0613582027843b846a($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = BOUCLE_afficher_contenuhtml_0529c2613ace8a0613582027843b846a($Cache, $Pile, $doublons, $Numrows, $SP);

	return analyse_resultat_skel('html_0529c2613ace8a0613582027843b846a', $Cache, $page, '../prive/objets/contenu/article.html');
}
?>