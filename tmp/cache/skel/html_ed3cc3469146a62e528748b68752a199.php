<?php

/*
 * Squelette : ../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   _illustrations, _portfolio, _documents
 */ 

function BOUCLE_illustrationshtml_ed3cc3469146a62e528748b68752a199(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['statut']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$command['pagination'] = array((isset($Pile[0]['debut_illustrations']) ? $Pile[0]['debut_illustrations'] : null), 50);
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_illustrations';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_types_documents','L2' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("documents.id_document");
		$command['select'] = array("L2.rang_lien",
		"0+documents.titre AS num1",
		"documents.date",
		"documents.id_document",
		"L2.id_objet",
		"L2.objet");
		$command['orderby'] = array('L2.rang_lien', 'num1', 'documents.date', 'documents.id_document');
		$command['join'] = array('L1' => array('documents','extension'), 'L2' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'L1.inclus', "'image'"), 
			array('=', 'documents.mode', "'image'"), 
			array('=', 'L2.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT \'0\'')), 
			array('=', 'L2.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')), (!(is_array(@$Pile[0]['statut'])?count(@$Pile[0]['statut']):strlen(@$Pile[0]['statut'])) ? '' : ((is_array(@$Pile[0]['statut'])) ? sql_in('documents.statut',sql_quote($in)) : 
			array('=', 'documents.statut', sql_quote(@$Pile[0]['statut'], '','varchar(10) NOT NULL DEFAULT \'0\'')))));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_illustrations',13,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_illustrations']['compteur_boucle'] = 0;
	$Numrows['_illustrations']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_illustrations']) ? $Pile[0]['debut_illustrations'] : _request('debut_illustrations');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_illustrations'] = quete_debut_pagination('id_document',$Pile[0]['@id_document'] = substr($debut_boucle,1),50,$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_illustrations']['total']-1)/(50))*(50)));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_illustrations']['total'] : $debut_boucle + 49), $Numrows['_illustrations']['total'] - 1);
	$Numrows['_illustrations']['grand_total'] = $Numrows['_illustrations']['total'];
	$Numrows['_illustrations']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_illustrations']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_illustrations']['compteur_boucle'] = $debut_boucle;
	
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_illustrations']['compteur_boucle']++;
		if ($Numrows['_illustrations']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_illustrations']['compteur_boucle']-1 > $fin_boucle) break;
		$t0 .= (
'
	' .

	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/document_desc', array('id_document' => $Pile[$SP]['id_document'] ,
	'id_objet' => $Pile[$SP]['id_objet'] ,
	'objet' => $Pile[$SP]['objet'] ,
	'lang' => $GLOBALS["spip_lang"] ,
	'id_document'=>$Pile[$SP]['id_document'],
	'id'=>$Pile[$SP]['id_document'],
	'recurs'=>(++$recurs)), array('compil'=>array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_illustrations',19,$GLOBALS['spip_lang']), 'trim'=>true), ''))
);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_illustrations @ ../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_portfoliohtml_ed3cc3469146a62e528748b68752a199(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['statut']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$command['pagination'] = array((isset($Pile[0]['debut_portfolio']) ? $Pile[0]['debut_portfolio'] : null), 50);
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_portfolio';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_types_documents','L2' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("documents.id_document");
		$command['select'] = array("L2.rang_lien",
		"0+documents.titre AS num1",
		"documents.date",
		"documents.id_document",
		"L2.id_objet",
		"L2.objet");
		$command['orderby'] = array('L2.rang_lien', 'num1', 'documents.date', 'documents.id_document');
		$command['join'] = array('L1' => array('documents','extension'), 'L2' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('=', 'L1.inclus', "'image'"), 
			array('=', 'documents.mode', "'document'"), 
			array('=', 'L2.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT \'0\'')), 
			array('=', 'L2.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')), (!(is_array(@$Pile[0]['statut'])?count(@$Pile[0]['statut']):strlen(@$Pile[0]['statut'])) ? '' : ((is_array(@$Pile[0]['statut'])) ? sql_in('documents.statut',sql_quote($in)) : 
			array('=', 'documents.statut', sql_quote(@$Pile[0]['statut'], '','varchar(10) NOT NULL DEFAULT \'0\'')))));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_portfolio',34,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_portfolio']['compteur_boucle'] = 0;
	$Numrows['_portfolio']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_portfolio']) ? $Pile[0]['debut_portfolio'] : _request('debut_portfolio');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_portfolio'] = quete_debut_pagination('id_document',$Pile[0]['@id_document'] = substr($debut_boucle,1),50,$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_portfolio']['total']-1)/(50))*(50)));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_portfolio']['total'] : $debut_boucle + 49), $Numrows['_portfolio']['total'] - 1);
	$Numrows['_portfolio']['grand_total'] = $Numrows['_portfolio']['total'];
	$Numrows['_portfolio']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_portfolio']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_portfolio']['compteur_boucle'] = $debut_boucle;
	
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_portfolio']['compteur_boucle']++;
		if ($Numrows['_portfolio']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_portfolio']['compteur_boucle']-1 > $fin_boucle) break;
		$t0 .= (
'
	' .

	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/document_desc', array('id_document' => $Pile[$SP]['id_document'] ,
	'id_objet' => $Pile[$SP]['id_objet'] ,
	'objet' => $Pile[$SP]['objet'] ,
	'lang' => $GLOBALS["spip_lang"] ,
	'id_document'=>$Pile[$SP]['id_document'],
	'id'=>$Pile[$SP]['id_document'],
	'recurs'=>(++$recurs)), array('compil'=>array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_portfolio',40,$GLOBALS['spip_lang']), 'trim'=>true), ''))
);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_portfolio @ ../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_documentshtml_ed3cc3469146a62e528748b68752a199(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$in = array();
	if (!(is_array($a = (@$Pile[0]['statut']))))
		$in[]= $a;
	else $in = array_merge($in, $a);
	$command['pagination'] = array((isset($Pile[0]['debut_documents']) ? $Pile[0]['debut_documents'] : null), 50);
	if (!isset($command['table'])) {
		$command['table'] = 'documents';
		$command['id'] = '_documents';
		$command['from'] = array('documents' => 'spip_documents','L1' => 'spip_types_documents','L2' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("documents.id_document");
		$command['select'] = array("L2.rang_lien",
		"0+documents.titre AS num1",
		"documents.date",
		"documents.id_document",
		"L2.id_objet",
		"L2.objet");
		$command['orderby'] = array('L2.rang_lien', 'num1', 'documents.date', 'documents.id_document');
		$command['join'] = array('L1' => array('documents','extension'), 'L2' => array('documents','id_document'));
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('(documents.taille > 0 OR documents.distant=\'oui\')'), 
			array('NOT', 
			array('=', 'L1.inclus', "'image'")), 
			array('NOT', 
			array('=', 'documents.mode', "'vignette'")), 
			array('=', 'L2.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT \'0\'')), 
			array('=', 'L2.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')), (!(is_array(@$Pile[0]['statut'])?count(@$Pile[0]['statut']):strlen(@$Pile[0]['statut'])) ? '' : ((is_array(@$Pile[0]['statut'])) ? sql_in('documents.statut',sql_quote($in)) : 
			array('=', 'documents.statut', sql_quote(@$Pile[0]['statut'], '','varchar(10) NOT NULL DEFAULT \'0\'')))));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_documents',55,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	// COMPTEUR
	$Numrows['_documents']['compteur_boucle'] = 0;
	$Numrows['_documents']['total'] = @intval($iter->count());
	$debut_boucle = isset($Pile[0]['debut_documents']) ? $Pile[0]['debut_documents'] : _request('debut_documents');
	if(substr($debut_boucle,0,1)=='@'){
		$debut_boucle = $Pile[0]['debut_documents'] = quete_debut_pagination('id_document',$Pile[0]['@id_document'] = substr($debut_boucle,1),50,$iter);
		$iter->seek(0);
	}
	$debut_boucle = intval($debut_boucle);
	$debut_boucle = (($tout=($debut_boucle == -1))?0:($debut_boucle));
	$debut_boucle = max(0,min($debut_boucle,floor(($Numrows['_documents']['total']-1)/(50))*(50)));
	$debut_boucle = intval($debut_boucle);
	$fin_boucle = min(($tout ? $Numrows['_documents']['total'] : $debut_boucle + 49), $Numrows['_documents']['total'] - 1);
	$Numrows['_documents']['grand_total'] = $Numrows['_documents']['total'];
	$Numrows['_documents']["total"] = max(0,$fin_boucle - $debut_boucle + 1);
	if ($debut_boucle>0 AND $debut_boucle < $Numrows['_documents']['grand_total'] AND $iter->seek($debut_boucle,'continue'))
		$Numrows['_documents']['compteur_boucle'] = $debut_boucle;
	
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$Numrows['_documents']['compteur_boucle']++;
		if ($Numrows['_documents']['compteur_boucle'] <= $debut_boucle) continue;
		if ($Numrows['_documents']['compteur_boucle']-1 > $fin_boucle) break;
		$t0 .= (
'
	' .

	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/document_desc', array('id_document' => $Pile[$SP]['id_document'] ,
	'id_objet' => $Pile[$SP]['id_objet'] ,
	'objet' => $Pile[$SP]['objet'] ,
	'lang' => $GLOBALS["spip_lang"] ,
	'id_document'=>$Pile[$SP]['id_document'],
	'id'=>$Pile[$SP]['id_document'],
	'recurs'=>(++$recurs)), array('compil'=>array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','_documents',61,$GLOBALS['spip_lang']), 'trim'=>true), ''))
);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_documents @ ../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html
// Temps de compilation total: 36.007 ms
//

function html_ed3cc3469146a62e528748b68752a199($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'


' .
vide($Pile['vars'][$_zzz=(string)'nbdocs'] = '0') .
'<div id="portfolios' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_unique', null),true)) .
'" class="portfolios">

' .
(($t1 = BOUCLE_illustrationshtml_ed3cc3469146a62e528748b68752a199($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<h3><span class="image_loading"></span>' .
		_T('medias:info_illustrations') .
		'</h3>
<div class="liste_items documents ordonner_rang_lien" id="illustrations' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_unique', null),true)) .
		'"  data-cookie-affichage="illustrations" data-lien="' .
		interdire_scripts(attribut_html(concat(@$Pile[0]['objet'],'/',@$Pile[0]['id_objet']))) .
		'">
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_illustrations"]["grand_total"],
 		'_illustrations',
		isset($Pile[0]['debut_illustrations'])?$Pile[0]['debut_illustrations']:intval(_request('debut_illustrations')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
<div class="sortable">
') . $t1 . (	'
</div>
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_illustrations"]["grand_total"],
 		'_illustrations',
		isset($Pile[0]['debut_illustrations'])?$Pile[0]['debut_illustrations']:intval(_request('debut_illustrations')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
' .
		(($t3 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('dissocierdocuments', interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])), invalideur_session($Cache, @$Pile[0]['id_objet']))?" ":""))))!=='' ?
				($t3 . (	'
	<div class="actions-liste">
	' .
			bouton_action(_T('medias:lien_tout_enlever'),invalideur_session($Cache, generer_action_auteur('dissocier_document',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-I/image'),invalideur_session($Cache, ancre_url(self(),'illustrations')))),'ajax tout_supprimer',(	_T('ecrire:lien_tout_supprimer') .
				' ?')) .
			'
	' .
			bouton_action(_T('medias:lien_tout_desordonner'),invalideur_session($Cache, generer_action_auteur('desordonner_liens_documents',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-I/image'),invalideur_session($Cache, ancre_url(self(),'illustrations')))),'ajax tout_desordonner',_T('medias:lien_tout_desordonner_verif')) .
			'
	</div>
')) :
				'') .
		'
</div>
' .
		vide($Pile['vars'][$_zzz=(string)'nbdocs'] = plus(table_valeur($Pile["vars"], (string)'nbdocs', null),(isset($Numrows['_illustrations']['grand_total'])
			? $Numrows['_illustrations']['grand_total'] : $Numrows['_illustrations']['total']))))) :
		'') .
'


' .
(($t1 = BOUCLE_portfoliohtml_ed3cc3469146a62e528748b68752a199($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<h3>' .
		_T('medias:info_portfolio') .
		'</h3>
<div class="liste_items documents ordonner_rang_lien" id="portfolio' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_unique', null),true)) .
		'" data-cookie-affichage="portfolio" data-lien="' .
		interdire_scripts(attribut_html(concat(@$Pile[0]['objet'],'/',@$Pile[0]['id_objet']))) .
		'">
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_portfolio"]["grand_total"],
 		'_portfolio',
		isset($Pile[0]['debut_portfolio'])?$Pile[0]['debut_portfolio']:intval(_request('debut_portfolio')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
<div class="sortable">
') . $t1 . (	'
</div>
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_portfolio"]["grand_total"],
 		'_portfolio',
		isset($Pile[0]['debut_portfolio'])?$Pile[0]['debut_portfolio']:intval(_request('debut_portfolio')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
' .
		(($t3 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('dissocierdocuments', interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])), invalideur_session($Cache, @$Pile[0]['id_objet']))?" ":""))))!=='' ?
				($t3 . (	'
	<div class="actions-liste">
		' .
			bouton_action(_T('medias:lien_tout_enlever'),invalideur_session($Cache, generer_action_auteur('dissocier_document',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-I/document'),invalideur_session($Cache, ancre_url(self(),'portfolio')))),'ajax tout_supprimer',(	_T('ecrire:lien_tout_supprimer') .
				' ?')) .
			'
		' .
			bouton_action(_T('medias:lien_tout_desordonner'),invalideur_session($Cache, generer_action_auteur('desordonner_liens_documents',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-I/document'),invalideur_session($Cache, ancre_url(self(),'illustrations')))),'ajax tout_desordonner',_T('medias:lien_tout_desordonner_verif')) .
			'
	</div>
')) :
				'') .
		'
</div>
' .
		vide($Pile['vars'][$_zzz=(string)'nbdocs'] = plus(table_valeur($Pile["vars"], (string)'nbdocs', null),(isset($Numrows['_portfolio']['grand_total'])
			? $Numrows['_portfolio']['grand_total'] : $Numrows['_portfolio']['total']))))) :
		'') .
'


' .
(($t1 = BOUCLE_documentshtml_ed3cc3469146a62e528748b68752a199($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
<h3>' .
		_T('medias:info_documents') .
		'</h3>
<div class="liste_items documents ordonner_rang_lien" id="documents' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_unique', null),true)) .
		'" data-cookie-affichage="documents" data-lien="' .
		interdire_scripts(attribut_html(concat(@$Pile[0]['objet'],'/',@$Pile[0]['id_objet']))) .
		'">
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_documents"]["grand_total"],
 		'_documents',
		isset($Pile[0]['debut_documents'])?$Pile[0]['debut_documents']:intval(_request('debut_documents')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
<div class="sortable">
') . $t1 . (	'
</div>
' .
		(($t3 = strval(filtre_pagination_dist($Numrows["_documents"]["grand_total"],
 		'_documents',
		isset($Pile[0]['debut_documents'])?$Pile[0]['debut_documents']:intval(_request('debut_documents')),
		50, true, 'prive', '', array())))!=='' ?
				('<p class="pagination">' . $t3 . '</p>') :
				'') .
		'
' .
		(($t3 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('dissocierdocuments', interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])), invalideur_session($Cache, @$Pile[0]['id_objet']))?" ":""))))!=='' ?
				($t3 . (	'
	<div class="actions-liste">
		' .
			bouton_action(_T('medias:lien_tout_enlever'),invalideur_session($Cache, generer_action_auteur('dissocier_document',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-D/document'),invalideur_session($Cache, ancre_url(self(),'documents')))),'ajax tout_supprimer',(	_T('ecrire:lien_tout_supprimer') .
				' ?')) .
			'
		' .
			bouton_action(_T('medias:lien_tout_desordonner'),invalideur_session($Cache, generer_action_auteur('desordonner_liens_documents',(	invalideur_session($Cache, @$Pile[0]['id_objet']) .
					'-' .
					interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])) .
					'-D/document'),invalideur_session($Cache, ancre_url(self(),'documents')))),'ajax tout_desordonner',_T('medias:lien_tout_desordonner_verif')) .
			'
	</div>
')) :
				'') .
		'
</div>
' .
		vide($Pile['vars'][$_zzz=(string)'nbdocs'] = plus(table_valeur($Pile["vars"], (string)'nbdocs', null),(isset($Numrows['_documents']['grand_total'])
			? $Numrows['_documents']['grand_total'] : $Numrows['_documents']['total']))))) :
		'') .
'

<script type="text/javascript">/*<![CDATA[*/
/* Plugin multifile et gestion de la modale */
var multifile=\'' .
texte_script(find_in_path('javascript/jquery.multifile.js')) .
'\';
' .
filtre_compacte_dist(charge_scripts('javascript/medias_edit.js',false),'js') .
'

/* Sur la page d\'une rubrique, recharger la boîte d\'info en cas de rechargement ajax */
' .
(($t1 = strval(interdire_scripts((((((((((@$Pile[0]['objet'] == 'rubrique')) AND ((defined('_AJAX')?constant('_AJAX'):''))) ?' ' :'')) AND ((table_valeur($Pile["vars"], (string)'nbdocs', null) == '1'))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . '
if (window.jQuery) jQuery(\'#navigation .box.info\').ajaxReload();') :
		'') .
'

/* Gestion des différents modes d\'affichages, du tri des documents, et des rechargements ajax */
' .
filtre_compacte_dist(recuperer_fond( 'javascript/gestion_listes_documents.js' , array(), array('compil'=>array('../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html','html_ed3cc3469146a62e528748b68752a199','',79,$GLOBALS['spip_lang'])), _request('connect')),'js') .
'
/*]]>*/</script>
</div>
');

	return analyse_resultat_skel('html_ed3cc3469146a62e528748b68752a199', $Cache, $page, '../plugins-dist/medias/prive/squelettes/inclure/portfolio-documents.html');
}
?>