<?php

/*
 * Squelette : ../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:58 GMT
 * Boucles :   _docslies
 */ 

function BOUCLE_docslieshtml_75175b43c271f99c838a9a0db7c70de7(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'documents_liens';
		$command['id'] = '_docslies';
		$command['from'] = array('documents_liens' => 'spip_documents_liens');
		$command['type'] = array();
		$command['groupby'] = array("id_document");
		$command['select'] = array("id_document",
		"documents_liens.id_document",
		"documents_liens.id_objet",
		"documents_liens.objet");
		$command['orderby'] = array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
			array('=', 'documents_liens.id_objet', sql_quote(@$Pile[0]['id_objet'], '','bigint(21) NOT NULL DEFAULT \'0\'')), 
			array('=', 'documents_liens.objet', sql_quote(@$Pile[0]['objet'], '','varchar(25) NOT NULL DEFAULT \'\'')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html','html_75175b43c271f99c838a9a0db7c70de7','_docslies',8,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	' .

	((($recurs=(isset($Pile[0]['recurs'])?$Pile[0]['recurs']:0))>=5)? '' :
	recuperer_fond('modeles/document_case', array('id_document' => $Pile[$SP]['id_document'] ,
	'id_objet' => $Pile[$SP]['id_objet'] ,
	'objet' => $Pile[$SP]['objet'] ,
	'lang' => $GLOBALS["spip_lang"] ,
	'recurs'=>(++$recurs)), array('compil'=>array('../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html','html_75175b43c271f99c838a9a0db7c70de7','_docslies',11,$GLOBALS['spip_lang']), 'trim'=>true, 'ajax' => ($v=( @$Pile[0]['ajax'] ))?$v:true), ''))
);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_docslies @ ../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html
// Temps de compilation total: 16.268 ms
//

function html_75175b43c271f99c838a9a0db7c70de7($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
(($t1 = BOUCLE_docslieshtml_75175b43c271f99c838a9a0db7c70de7($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
<div class="liste_items documents" id="documents_joints">
' . $t1 . '
</div>
') :
		'') .
'
<script type="text/javascript">/*<![CDATA[*/
var multifile=\'' .
texte_script(find_in_path('javascript/jquery.multifile.js')) .
'\';
' .
filtre_compacte_dist(charge_scripts('javascript/medias_edit.js',false),'js') .
'
/*]]>*/</script>
');

	return analyse_resultat_skel('html_75175b43c271f99c838a9a0db7c70de7', $Cache, $page, '../plugins-dist/medias/prive/squelettes/inclure/colonne-documents.html');
}
?>