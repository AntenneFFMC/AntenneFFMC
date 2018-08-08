<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/inc-upload_document.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:58 GMT
 * Boucles :   _methodes_liens, _methodes
 */ 

function BOUCLE_methodes_lienshtml_c835e3b9ad1cc6f8167b52613c216d44(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'methodes_upload', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_methodes_liens';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
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
		array('../plugins-dist/medias/formulaires/inc-upload_document.html','html_c835e3b9ad1cc6f8167b52613c216d44','_methodes_liens',20,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				' .
(((table_valeur($Pile["vars"], (string)'cpt', null) > '1'))  ?
		(' ' . (	'
					|
				')) :
		'') .
'
				' .
(((table_valeur($Pile["vars"], (string)'methode_upload', null) == interdire_scripts(safehtml($Pile[$SP]['cle']))))  ?
		(' ' . (	'
					' .
	interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'label_lien'))))) :
		'') .
'
				' .
(!((table_valeur($Pile["vars"], (string)'methode_upload', null) == interdire_scripts(safehtml($Pile[$SP]['cle']))))  ?
		(' ' . (	'
					<a href=\'#\' onclick="change_methode(\'' .
	table_valeur($Pile["vars"], (string)'domid', null) .
	'\',\'' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'\');return false;">' .
	interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'label_lien'))) .
	'</a>
				')) :
		'') .
'
				' .
vide($Pile['vars'][$_zzz=(string)'cpt'] = plus(table_valeur($Pile["vars"], (string)'cpt', null),'1')) .
'
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_methodes_liens @ ../plugins-dist/medias/formulaires/inc-upload_document.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_methodeshtml_c835e3b9ad1cc6f8167b52613c216d44(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'methodes_upload', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_methodes';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle",
		"env");
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
		array('../plugins-dist/medias/formulaires/inc-upload_document.html','html_c835e3b9ad1cc6f8167b52613c216d44','_methodes',11,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
	' .
vide($Pile['vars'][$_zzz=(string)'methode_upload'] = interdire_scripts(safehtml($Pile[$SP]['cle']))) .
'<div class=\'joindre_mode' .
table_valeur($Pile["vars"], (string)'domid', null) .
(!((table_valeur($Pile["vars"], (string)'methode', null) == interdire_scripts(safehtml($Pile[$SP]['cle']))))  ?
		(' ' . 'none-js') :
		'') .
'\' id=\'joindre_' .
interdire_scripts(safehtml($Pile[$SP]['cle'])) .
table_valeur($Pile["vars"], (string)'domid', null) .
'\'>

		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'formulaires/methodes_upload/' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])))) . ', array_merge('.var_export($Pile[0],1).',array(\'domid\' => ' . argumenter_squelette(table_valeur($Pile["vars"], (string)'domid', null)) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../plugins-dist/medias/formulaires/inc-upload_document.html\',\'html_c835e3b9ad1cc6f8167b52613c216d44\',\'\',15,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>' .
'

		<div class=\'sourceup\'>
			' .
vide($Pile['vars'][$_zzz=(string)'cpt'] = '1') .
'
			' .
_T('medias:bouton_download_depuis') .
'
			' .
BOUCLE_methodes_lienshtml_c835e3b9ad1cc6f8167b52613c216d44($Cache, $Pile, $doublons, $Numrows, $SP) .
'
		</div>
		<p class=\'boutons\'><input class=\'submit\' type="submit" name="joindre_' .
interdire_scripts(safehtml($Pile[$SP]['cle'])) .
'" value="' .
interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'label_bouton'))) .
'"/></p>
	</div>
');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_methodes @ ../plugins-dist/medias/formulaires/inc-upload_document.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/inc-upload_document.html
// Temps de compilation total: 17.939 ms
//

function html_c835e3b9ad1cc6f8167b52613c216d44($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
vide($Pile['vars'][$_zzz=(string)'domid'] = (	'_' .
	interdire_scripts(concat(entites_html(table_valeur(@$Pile[0], (string)'mode', null),true),'_',interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)))))) .
vide($Pile['vars'][$_zzz=(string)'methode'] = 'upload') .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'joindre_mediatheque', null),true)) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'methode'] = 'mediatheque')) :
		'') .
'
' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'joindre_distant', null),true)) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'methode'] = 'distant')) :
		'') .
'
' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'joindre_ftp', null),true)) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'methode'] = 'ftp')) :
		'') .
'

' .
vide($Pile['vars'][$_zzz=(string)'methodes_upload'] = medias_lister_methodes_upload(@serialize($Pile[0]))) .
(($t1 = strval(interdire_scripts(((((((((entites_html(table_valeur(@$Pile[0], (string)'methode_focus', null),true)) AND (is_array(table_valeur($Pile["vars"], (string)'methodes_upload', null)))) ?' ' :'')) AND (interdire_scripts(array_key_exists(entites_html(table_valeur(@$Pile[0], (string)'methode_focus', null),true),table_valeur($Pile["vars"], (string)'methodes_upload', null))))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'methode'] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'methode_focus', null),true)))) :
		'') .
'

<div id="defaultsubmit' .
table_valeur($Pile["vars"], (string)'domid', null) .
'" class="none"></div>
' .
BOUCLE_methodeshtml_c835e3b9ad1cc6f8167b52613c216d44($Cache, $Pile, $doublons, $Numrows, $SP) .
'


' .
(($t1 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'lister_contenu_archive')))!=='' ?
		('<div class="editer-groupe"><div class=\'fieldset deballer_zip\'>' . $t1 . '</div></div>') :
		'') .
'

<script type=\'text/javascript\'>/*<![CDATA[*/
if (window.jQuery){
function change_methode(domid,methode){
	var id = "#joindre_"+methode+domid;
	if (jQuery(id).is(\':hidden\')) {
		jQuery(\'div.joindre_mode\'+domid+\':visible\').slideUp(\'fast\');
		jQuery(id).slideDown(\'fast\');
	}
	// placer en haut du formulaire les boutons submit par defaut correspondant a la methode active
	jQuery("#defaultsubmit"+domid).html(\'\').append(jQuery(id).find(\'.boutons\').eq(-1).find(\'input\').clone(true));
	var joindre = jQuery(id).find(\'.boutons\').eq(-1).find(\'input\').prop(\'name\').replace(\'joindre_\', \'\');
	jQuery("#defaultsubmit"+domid).append($(\'<input>\').attr({type: \'hidden\', id: \'methode_focus\', name: \'methode_focus\', value: joindre}));
}
jQuery(function(){change_methode(\'' .
table_valeur($Pile["vars"], (string)'domid', null) .
'\',\'' .
table_valeur($Pile["vars"], (string)'methode', null) .
'\');});
}
/*]]>*/</script>');

	return analyse_resultat_skel('html_c835e3b9ad1cc6f8167b52613c216d44', $Cache, $page, '../plugins-dist/medias/formulaires/inc-upload_document.html');
}
?>