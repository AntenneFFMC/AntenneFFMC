<?php

/*
 * Squelette : ../prive/formulaires/editer_liens.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/formulaires/editer_liens.html
// Temps de compilation total: 13.039 ms
//

function html_3c93d82eaf4a6a21bd5dfbd56b502f9a($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="formulaire_spip formulaire_editer formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
' ' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'table_source', null),true))))!=='' ?
		((	'formulaire_' .
	interdire_scripts(@$Pile[0]['form']) .
	'-') . $t1) :
		'') .
' formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
'-' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)) .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'editable', null),true)) ?'' :' '))))!=='' ?
		($t1 . 'non_editable') :
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
		
		' .
		'<div>' .
	form_hidden(@$Pile[0]['action']) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>
		<input type="hidden" name="visible" value="' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'visible', null), '0'),true)) .
	'" id="visible-' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)) .
	'"/>
	  <div class="over"><span class=\'image_loading\'>&nbsp;</span><input type=\'submit\' class=\'submit\' value=\'' .
	_T('public|spip|ecrire:bouton_changer') .
	'\' /></div>
	')) :
		'') .
'

		' .

'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/objets/liste/' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_vue_liee', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'action\' => ' . argumenter_squelette('') . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/formulaires/editer_liens.html\',\'html_3c93d82eaf4a6a21bd5dfbd56b502f9a\',\'\',6,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
		' .
(($t1 = strval(table_valeur(@$Pile[0], (string)'_oups', null)))!=='' ?
		('<div class="action"><input type="hidden" name="_oups" value=\'' . $t1 . '\' /><input type="submit" name="annuler_oups" value="Ooops" /></div>') :
		'') .
'

		' .
(($t1 = strval(interdire_scripts((((((entites_html(sinon(table_valeur(@$Pile[0], (string)'visible', null), '0'),true)) AND (interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true)))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . (	'
			<div class="selecteur' .
	(($t2 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'recherche', null),true)) ?' ' :''))))!=='' ?
			($t2 . 'filtre') :
			'') .
	'">
				<h3 class="titrem">' .
	interdire_scripts(_T(objet_info(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true),'texte_ajouter'))) .
	'</h3>
				' .
	
'<'.'?php echo recuperer_fond( ' . argumenter_squelette((	'prive/objets/liste/' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_vue_ajout', null),true)))) . ', array_merge('.var_export($Pile[0],1).',array(\'action\' => ' . argumenter_squelette('') . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/formulaires/editer_liens.html\',\'html_3c93d82eaf4a6a21bd5dfbd56b502f9a\',\'\',12,$GLOBALS[\'spip_lang\']),\'ajax\' => ($v=( ' . argumenter_squelette(@$Pile[0]['ajax']) . '))?$v:true), _request("connect"));
?'.'>
				' .
	(($t2 = strval(invalideur_session($Cache, ((((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('creer', interdire_scripts(invalideur_session($Cache, entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true))))?" ":"")) ?' ' :''))))!=='' ?
			($t2 . (	'
				' .
		filtre_icone_horizontale_dist(parametre_url(parametre_url(generer_url_ecrire_entite_edit('',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true))),'associer_objet',interdire_scripts(concat(entites_html(table_valeur(@$Pile[0], (string)'objet', null),true),'|',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_objet', null),true))))),'redirect',parametre_url(self(),'dummy','','&')),interdire_scripts(_T(objet_info(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true),'texte_creer_associer'))),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true)),'new') .
		'
				')) :
			'') .
	'
				<div class="toggle_box_link">
					&#91;<a href="#"
						onclick="jQuery(this).parents(\'div.selecteur\').hide(\'fast\').siblings(\'.toggle_box_link\').show();jQuery(\'#visible-' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)) .
	'\').attr(\'value\',0);return false;"
						>' .
	_T('public|spip|ecrire:bouton_fermer') .
	'</a>&#93;
				</div>
				<p class="boutons">
					<input type="submit" class="submit" name="fermer" value="' .
	_T('public|spip|ecrire:bouton_fermer') .
	'"	onclick="jQuery(this).parents(\'div.selecteur\').hide(\'fast\').siblings(\'.toggle_box_link\').show();jQuery(\'#visible-' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)) .
	'\').attr(\'value\',0);return false;" />
				</p>
			</div>
			<div class="toggle_box_link" style="display:none;">
					&#91;<a href="#"
						onclick="jQuery(this).parents(\'div.toggle_box_link\').hide(\'fast\').siblings(\'.selecteur\').show(\'fast\');jQuery(\'#visible-' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id', null),true)) .
	'\').attr(\'value\',1);return false;"
						>' .
	interdire_scripts(_T(objet_info(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true),'texte_ajouter'))) .
	'</a>&#93;
			</div>
		')) :
		'') .
'
	' .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		($t1 . (	'
		' .
	(($t2 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'visible', null), '0'),true)) ?'' :' '))))!=='' ?
			($t2 . (	'
		<div class="toggle_box_link">
			&#91;<button type="submit" class="link" name="visible" value="1">' .
		interdire_scripts(_T(objet_info(entites_html(table_valeur(@$Pile[0], (string)'objet_source', null),true),'texte_ajouter'))) .
		'</button>&#93;
		</div>
		')) :
			'') .
	'
	  
	  <!--extra-->
	</div></form>
	')) :
		'') .
'
</div>
<script type="text/javascript">/*<![CDATA[*/
jQuery(\'.formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
' .action .delete\').click(function(){jQuery(this).parents(\'tr\').eq(0).animateRemove();});
jQuery(\'.formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
' .append\').animateAppend();
/*]]>*/</script>
');

	return analyse_resultat_skel('html_3c93d82eaf4a6a21bd5dfbd56b502f9a', $Cache, $page, '../prive/formulaires/editer_liens.html');
}
?>