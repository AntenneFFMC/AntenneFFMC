<?php

/*
 * Squelette : ../prive/formulaires/dater.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   _editable, _editable1, _editer_date_anterieure
 */ 

function BOUCLE_editablehtml_012f78f7ced961cbd7e72c794c845ae4(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_editable';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
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
		"CONDITION",
		$command,
		array('../prive/formulaires/dater.html','html_012f78f7ced961cbd7e72c794c845ae4','_editable',18,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:bouton_changer');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				<span class="toggle_box_link"' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>&#91;<button
					  class="link"
					  name="_saisie_en_cours" value="X"
						onclick="var f=jQuery(this).parents(\'form\').eq(0);f.find(\'.editer .input.editable\').show(\'fast\').siblings(\'span\').add(jQuery(this).parent()).hide(\'fast\');f.find(\'.boutons\').show(\'fast\');f.find(\'input.date\').eq(0).focus();' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'sans_redac', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'f.find(\'.editer_date_redac label[for=date_redac]\').hide();') :
		'') .
'return false;"
						>' .
$l1 .
'<i class="over"> (' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_label_date', null),true)) .
')</i></button>&#93;</span>
				<span class="input' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_editer_date', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'editable') :
		'') .
'"' .
(($t1 = strval(interdire_scripts((((((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) AND (interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_editer_date', null),true)))) ?' ' :'')) ?'' :' '))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>
					<input type="text" class="text date" name="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_jour" id="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_jour" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)(	table_valeur($Pile["vars"], (string)'name', null) .
	'_jour'), null),true)) .
'" size="10"/>
					<input type="text" class="text heure time" name="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_heure" id="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_heure" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)(	table_valeur($Pile["vars"], (string)'name', null) .
	'_heure'), null),true)) .
'" size="5"/>
				</span>
				');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_editable @ ../prive/formulaires/dater.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_editable1html_012f78f7ced961cbd7e72c794c845ae4(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_editable1';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
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
		"CONDITION",
		$command,
		array('../prive/formulaires/dater.html','html_012f78f7ced961cbd7e72c794c845ae4','_editable1',37,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:texte_date_publication_anterieure_nonaffichee');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
					<span class="input editable"' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) ?'' :' '))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>
						<span class="saisie_redac"' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'sans_redac', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>
							<input type="text" class="text date" name="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_jour" id="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_jour" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)(	table_valeur($Pile["vars"], (string)'name', null) .
	'_jour'), null),true)) .
'" size="10"/>
							<input type="text" class="text heure time" name="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_heure" id="' .
table_valeur($Pile["vars"], (string)'name', null) .
'_heure" value="' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)(	table_valeur($Pile["vars"], (string)'name', null) .
	'_heure'), null),true)) .
'" size="5"/>
							<br />
						</span>
						<span class="choix">
							<input type="checkbox" name="sans_redac" value="1"' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'sans_redac', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'checked="checked"') :
		'') .
' id="sans_redac"
								onclick="jQuery(this).blur();"
								onchange="if (jQuery(this).prop(\'checked\')) {jQuery(this).parent().siblings().hide(\'fast\');$(this).parents(\'form\').find(\'.editer_date_redac label[for=date_redac]\').hide(); } else { jQuery(this).parent().siblings().show(\'fast\'); ;$(this).parents(\'form\').find(\'.editer_date_redac label[for=date_redac]\').show(\'fast\'); }"
							/><label for="sans_redac">' .
interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'_texte_sans_date_redac', null), $l1),true)) .
'</label>
						</span>
					');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_editable1 @ ../prive/formulaires/dater.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_editer_date_anterieurehtml_012f78f7ced961cbd7e72c794c845ae4(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($si_init)) { $command['si'] = array(); $si_init = true; }
	$command['si'][] = interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_editer_date_anterieure', null),true)) ?' ' :''));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_editer_date_anterieure';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("1");
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
		"CONDITION",
		$command,
		array('../prive/formulaires/dater.html','html_012f78f7ced961cbd7e72c794c845ae4','_editer_date_anterieure',30,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	
	$l1 = _T('public|spip|ecrire:texte_date_publication_anterieure');
	$l2 = _T('public|spip|ecrire:jour_non_connu_nc');$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
				' .
vide($Pile['vars'][$_zzz=(string)'name'] = 'date_redac') .
vide($Pile['vars'][$_zzz=(string)'erreurs'] = table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),table_valeur($Pile["vars"], (string)'name', null))) .
'<div class="editer long_label editer_' .
table_valeur($Pile["vars"], (string)'name', null) .
(($t1 = strval(table_valeur($Pile["vars"], (string)'obli', null)))!=='' ?
		(' ' . $t1) :
		'') .
((table_valeur($Pile["vars"], (string)'erreurs', null))  ?
		(' ' . ' ' . 'erreur') :
		'') .
'">
					<label for="' .
table_valeur($Pile["vars"], (string)'name', null) .
'">' .
interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'_label_date_redac', null), $l1),true)) .
' ' .
interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('artdate_redac','../prive/formulaires/dater.html', $Pile[0]):'')) .
'</label>' .
(($t1 = strval(table_valeur($Pile["vars"], (string)'erreurs', null)))!=='' ?
		('
					<span class=\'erreur_message\'>' . $t1 . '</span>
					') :
		'') .
'
					<span class="affiche"' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) ?' ' :''))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>' .
interdire_scripts(((($a = affdate(table_valeur(@$Pile[0], (string)(	'afficher_' .
	table_valeur($Pile["vars"], (string)'name', null)), null))) OR (is_string($a) AND strlen($a))) ? $a : $l2)) .
'</span>
					' .
BOUCLE_editable1html_012f78f7ced961cbd7e72c794c845ae4($Cache, $Pile, $doublons, $Numrows, $SP) .
'
					</span>
				</div>
			');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_editer_date_anterieure @ ../prive/formulaires/dater.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/formulaires/dater.html
// Temps de compilation total: 22.485 ms
//

function html_012f78f7ced961cbd7e72c794c845ae4($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="formulaire_spip formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
' formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
'-' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'objet', null),true)) .
'-' .
interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'nouveau'),true)) .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_class', null),true))))!=='' ?
		(' ' . $t1) :
		'') .
'">
	' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_ok', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_ok">' . $t1 . '</p>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_erreur', null))))!=='' ?
		('<p class="reponse_formulaire reponse_formulaire_erreur">' . $t1 . '</p>') :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		($t1 . (	'
	<form method=\'post\' action=\'' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true)) .
	'\'><div>
		<input type=\'submit\' class=\'over\' name=\'changer\' value=\'' .
	_T('public|spip|ecrire:bouton_changer') .
	'\' />
		
		' .
		'<div>' .
	form_hidden(@$Pile[0]['action']) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>
	')) :
		'') .
'
		<div class="editer-groupe">
			' .
vide($Pile['vars'][$_zzz=(string)'name'] = 'date') .
vide($Pile['vars'][$_zzz=(string)'erreurs'] = table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),table_valeur($Pile["vars"], (string)'name', null))) .
'<div class="editer long_label editer_' .
table_valeur($Pile["vars"], (string)'name', null) .
(($t1 = strval(table_valeur($Pile["vars"], (string)'obli', null)))!=='' ?
		(' ' . $t1) :
		'') .
((table_valeur($Pile["vars"], (string)'erreurs', null))  ?
		(' ' . ' ' . 'erreur') :
		'') .
'">
				<label for="' .
table_valeur($Pile["vars"], (string)'name', null) .
'">' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_label_date', null),true)) .
' ' .
interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('artdate','../prive/formulaires/dater.html', $Pile[0]):'')) .
'</label>' .
(($t1 = strval(table_valeur($Pile["vars"], (string)'erreurs', null)))!=='' ?
		('
				<span class=\'erreur_message\'>' . $t1 . '</span>
				') :
		'') .
'
				<span class="affiche"' .
(($t1 = strval(interdire_scripts((((((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) AND (interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_editer_date', null),true)))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . 'style="display:none;"') :
		'') .
'>' .
interdire_scripts(affdate(table_valeur(@$Pile[0], (string)(	'afficher_' .
	table_valeur($Pile["vars"], (string)'name', null)), null))) .
'</span>
				' .
BOUCLE_editablehtml_012f78f7ced961cbd7e72c794c845ae4($Cache, $Pile, $doublons, $Numrows, $SP) .
'
			</div>
			' .
BOUCLE_editer_date_anterieurehtml_012f78f7ced961cbd7e72c794c845ae4($Cache, $Pile, $doublons, $Numrows, $SP) .
'
		</div>
	
	<!--extra-->
	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		($t1 . (	'
		<p class=\'boutons\'' .
	(($t2 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_saisie_en_cours', null),true)) ?'' :' '))))!=='' ?
			($t2 . 'style="display:none;"') :
			'') .
	'>
			<span class=\'image_loading\'>&nbsp;</span>
			<input type=\'submit\' class=\'submit\' name=\'annuler\' value=\'' .
	_T('public|spip|ecrire:bouton_annuler') .
	'\' />
			<input type=\'submit\' class=\'submit\' name=\'changer\' value=\'' .
	_T('public|spip|ecrire:bouton_changer') .
	'\' />
		</p>
	</div></form>
	')) :
		'') .
'
</div>
' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette('formulaires/dateur/inc-dateur') . ', array(\'heure_pas\' => ' . argumenter_squelette(@$Pile[0]['heure_pas']) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . '), array("compil"=>array(\'../prive/formulaires/dater.html\',\'html_012f78f7ced961cbd7e72c794c845ae4\',\'\',59,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>
');

	return analyse_resultat_skel('html_012f78f7ced961cbd7e72c794c845ae4', $Cache, $page, '../prive/formulaires/dater.html');
}
?>