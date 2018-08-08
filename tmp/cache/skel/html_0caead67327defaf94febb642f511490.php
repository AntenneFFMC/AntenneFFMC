<?php

/*
 * Squelette : squelettes/rubrique.html
 * Date :      Sat, 04 Aug 2018 15:08:33 GMT
 * Compile :   Tue, 07 Aug 2018 17:28:27 GMT
 * Boucles :   _ariane, _articles, _documents_joints, _principale
 */ 

function BOUCLE_arianehtml_0caead67327defaf94febb642f511490(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!($id_rubrique = intval($Pile[$SP]['id_rubrique'])))
		return '';
	include_spip('inc/rubriques');
	$hierarchie = calcul_hierarchie_in($id_rubrique,false);
	if (!$hierarchie) return "";
	
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_ariane';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.titre",
		"rubriques.lang");
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['orderby'] = array("FIELD(rubriques.id_rubrique, $hierarchie)");
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('IN', 'rubriques.id_rubrique', "($hierarchie)"));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_ariane',36,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
' &gt; <a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_rubrique'], 'rubrique', '', '', true))) .
'">' .
interdire_scripts(couper(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])),'80')) .
'</a>');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_ariane @ squelettes/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_articleshtml_0caead67327defaf94febb642f511490(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['pagination'] = array((isset($Pile[0]['debut_articles']) ? $Pile[0]['debut_articles'] : null), 5);
	if (!isset($command['table'])) {
		$command['table'] = 'articles';
		$command['id'] = '_articles';
		$command['from'] = array('articles' => 'spip_articles');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("articles.date",
		"articles.id_article",
		"articles.id_rubrique",
		"articles.titre",
		"articles.texte",
		"articles.lang");
		$command['orderby'] = array('articles.date DESC');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('articles.statut','publie,prop,prepa/auteur','publie',''), 
quete_condition_postdates('articles.date',''), 
			array('=', 'articles.id_rubrique', sql_quote($Pile[$SP]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT \'0\'')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_articles',51,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_articles']['compteur_boucle'] = 0;
	$Numrows['_articles']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_articles']) ? $Pile[0]['debut_articles'] : _request('debut_articles');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_articles'] = quete_debut_pagination('id_article',$Pile[0]['@id_article'] = substr($debut_boucle,1),5,$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_articles']['total']-1)/(5))*(5)));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_articles']['total'] : $debut_boucle + 4), $Numrows['_articles']['total'] - 1);
	$Numrows['_articles']['grand_total'] = $Numrows['_articles']['total'];
	$Numrows['_articles']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_articles']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_articles']['compteur_boucle'] = $debut_boucle;
	
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_articles']['compteur_boucle']++;
		if ($Numrows['_articles']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_articles']['compteur_boucle']-1 > $fin_boucle) break;
		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
                     <li>
                        <strong><a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_article'], 'article', '', '', true))) .
'">' .
(($t1 = strval(filtrer('image_graver',filtrer('image_reduire',
((!is_array($l = quete_logo('id_article', 'ON', $Pile[$SP]['id_article'],$Pile[$SP]['id_rubrique'], 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')),'30','*'))))!=='' ?
		($t1 . ' ') :
		'') .
interdire_scripts(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))) .
'</a></strong>
                        <small class="liste-articles-rubrique-dates">' .
interdire_scripts(affdate_jourcourt(normaliser_date($Pile[$SP]['date']))) .
'</small> ' .
(($t1 = strval(interdire_scripts(couper(traiter_doublons_documents($doublons, propre($Pile[$SP]['texte'], $connect, $Pile[0])),'120'))))!=='' ?
		((	'
                        <div class="">') . $t1 . '</div>') :
		'') .
'
                     </li>
                     ');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_articles @ squelettes/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_documents_jointshtml_0caead67327defaf94febb642f511490(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$doublons_index = array();

	// Initialise le(s) critère(s) doublons
	if (!isset($doublons[$d = 'documents'])) { $doublons[$d] = ''; }

	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_documents_joints';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_documents_liens','L2' => 'spip_types_documents');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("0+documents.titre AS num",
		"documents.date",
		"documents.id_document",
		"L2.mime_type",
		"documents.extension",
		"documents.titre",
		"documents.fichier",
		"L2.titre AS type_document",
		"documents.taille",
		"documents.descriptif");
		$command['orderby'] = array('num', 'documents.date');
		$command['join'] = array('L1' => array('documents','id_document'), 'L2' => array('documents','extension'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('documents.statut','publie,prop,prepa','publie',''), 
quete_condition_postdates('documents.date_publication',''), 
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'L1.id_objet', sql_quote($Pile[$SP]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT \'0\'')), 
			array('=', 'L1.objet', sql_quote('rubrique')), 
			array('=', 'documents.mode', "'document'"), 
			array(sql_in('documents.id_document', $doublons[$doublons_index[]= ('documents')], 'NOT')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_documents_joints',69,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:info_document');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

			foreach($doublons_index as $k) $doublons[$k] .= "," . $Pile[$SP]['id_document']; // doublons

		$t0 .= (
'
                     <li>
                        <a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_document'], 'document', '', '', true))) .
'" type="' .
interdire_scripts($Pile[$SP]['mime_type']) .
'" class="spip_doc' .
(($t1 = strval(interdire_scripts(attribut_html($Pile[$SP]['extension']))))!=='' ?
		(' ' . $t1) :
		'') .
'"><strong class="titre">' .
interdire_scripts(((($a = traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(couper(basename(get_spip_doc($Pile[$SP]['fichier'])),'80')))) .
'</strong>
                                                    <small class="info_document">(' .
(($t1 = strval(interdire_scripts(strtoupper($Pile[$SP]['extension']))))!=='' ?
		((	'<abbr title="' .
	$l1 .
	' ' .
	interdire_scripts($Pile[$SP]['type_document']) .
	'" class="ext">') . $t1 . '</abbr> - ') :
		'') .
(($t1 = strval(interdire_scripts(taille_en_octets($Pile[$SP]['taille']))))!=='' ?
		('<span>' . $t1 . '</span>') :
		'') .
')</small></a>                        ' .
(($t1 = strval(interdire_scripts(traiter_doublons_documents($doublons, propre($Pile[$SP]['descriptif'], $connect, $Pile[0])))))!=='' ?
		((	'
                        <div class="descriptif">') . $t1 . '</div>') :
		'') .
'
                     </li>
                     ');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_documents_joints @ squelettes/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_principalehtml_0caead67327defaf94febb642f511490(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_principale';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"rubriques.lang",
		"rubriques.titre",
		"rubriques.texte");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_rubrique', sql_quote(@$Pile[0]['id_rubrique'], '','bigint(21) NOT NULL AUTO_INCREMENT')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',1,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
<!--[if lt IE 7 ]> <html dir="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
'" lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" class="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
(($t1 = strval(spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie6"> <![endif]-->
<!--[if IE 7 ]> <html dir="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
'" lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" class="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
(($t1 = strval(spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html dir="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
'" lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" class="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
(($t1 = strval(spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html dir="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
'" lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" xmlns="http://www.w3.org/1999/xhtml" xml:lang="' .
spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang']) .
'" class="' .
lang_dir($Pile[$SP]['lang'], 'ltr','rtl') .
(($t1 = strval(spip_htmlentities($Pile[$SP]['lang'] ? $Pile[$SP]['lang'] : $GLOBALS['spip_lang'])))!=='' ?
		(' ' . $t1) :
		'') .
' no-js ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Entête -->
	<meta charset="utf-8" />
	' .
recuperer_fond( 'inclure/inc_styles' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',11,$GLOBALS['spip_lang'])), _request('connect')) .
'
	' .
recuperer_fond( 'inclure/inc_fonts' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',3,$GLOBALS['spip_lang'])), _request('connect')) .
'
	' .
recuperer_fond( 'inclure/inc_robots-do' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',3,$GLOBALS['spip_lang'])), _request('connect')) .
'
	' .
recuperer_fond( 'inclure/inc_desc' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',3,$GLOBALS['spip_lang'])), _request('connect')) .
'
	<title>' .
interdire_scripts(traiter_doublons_documents($doublons, typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0]))) .
'</title>
</head>



<body class="page-rubrique">

    <!-- Header -->
   ' .
recuperer_fond( 'inclure/inc_entete' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',11,$GLOBALS['spip_lang'])), _request('connect')) .
'


   <!-- Corps de la page -->
   <div class="conteneur rubrique">
      <p class="arbo">
         <a href="' .
spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
'/">
            ' .
_T('public|spip|ecrire:accueil_site') .
'
         </a>
         ' .
BOUCLE_arianehtml_0caead67327defaf94febb642f511490($Cache, $Pile, $doublons, $Numrows, $SP) .
(($t1 = strval(interdire_scripts(couper(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])),'80'))))!=='' ?
		(' &gt; <strong class="on">' . $t1 . '</strong>') :
		'') .
'</p>
      <!--.arbo-->

      <header class="rubrique__entete">
			<div class="rubrique__entete-logo">' .

((!is_array($l = quete_logo('id_rubrique', 'ON', $Pile[$SP]['id_rubrique'],quete_parent($Pile[$SP]['id_rubrique']), 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')) .
'</div>
         <h4 class="rubrique__entete-titre">' .
interdire_scripts(traiter_doublons_documents($doublons, supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0]))) .
'</h4>
      </header>

      <div class="rubrique__description">
			<p class="rubrique__description-texte">' .
interdire_scripts(traiter_doublons_documents($doublons, propre($Pile[$SP]['texte'], $connect, $Pile[0]))) .
'</p>
      </div>
      <hr/>

      <div class="texte-rubrique sans-style-liste">
         
         ' .
(($t1 = BOUCLE_articleshtml_0caead67327defaf94febb642f511490($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
            <div class="menu_articles">
               ' .
		filtre_pagination_dist($Numrows["_articles"]["grand_total"],
 		'_articles',
		isset($Pile[0]['debut_articles'])?$Pile[0]['debut_articles']:intval(_request('debut_articles')),
		5, false, '', '', array()) .
		'
               <ul class="sans-style-liste liste-articles-rubrique">
                  ') . $t1 . (	'
               </ul>
               ' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_articles"]["grand_total"],
 		'_articles',
		isset($Pile[0]['debut_articles'])?$Pile[0]['debut_articles']:intval(_request('debut_articles')),
		5, true, '', '', array())))!=='' ?
				('
               <p class="pagination" style="text-align:center;">' . $t3 . '</p>') :
				'') .
		'
            </div>
         ')) :
		'') .
'

         
         ' .
(($t1 = BOUCLE_documents_jointshtml_0caead67327defaf94febb642f511490($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
            <div class="menu" id="documents_joints">
               <h2>' .
		_T('medias:titre_documents_joints') .
		'</h2>
               <ul class="spip">
                  ') . $t1 . '
               </ul>
            </div>
            <!--#documents_joints-->
         ') :
		'') .
'

         ' .
(($t1 = strval(interdire_scripts(calculer_notes())))!=='' ?
		('
         <div class="notes">
            <hr />' . $t1 . '</div>') :
		'') .
'
      </div>

   </div>

   <!-- Footer -->
   ' .
recuperer_fond( 'inclure/inc_pied' , array(), array('compil'=>array('squelettes/rubrique.html','html_0caead67327defaf94febb642f511490','_principale',93,$GLOBALS['spip_lang'])), _request('connect')) .
'

</body>



</html>
');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_principale @ squelettes/rubrique.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes/rubrique.html
// Temps de compilation total: 43.389 ms
//

function html_0caead67327defaf94febb642f511490($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
BOUCLE_principalehtml_0caead67327defaf94febb642f511490($Cache, $Pile, $doublons, $Numrows, $SP) .
'
');

	return analyse_resultat_skel('html_0caead67327defaf94febb642f511490', $Cache, $page, 'squelettes/rubrique.html');
}
?>