<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/configurer_documents.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:13 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/configurer_documents.html
// Temps de compilation total: 9.698 ms
//

function html_faa46a46f55b23506fe261ebd788e539($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="formulaire_spip formulaire_configurer formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
' formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
'-' .
interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'nouveau'),true)) .
'">
<h3 class=\'titrem\'><img src="' .
interdire_scripts(chemin_image('document-24.png')) .
'" class="cadre-icone" />' .
_T('medias:titre_documents_joints') .
'</h3>
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
	<p>' .
	_T('medias:texte_documents_joints') .
	'</p>
	<p class="explication">' .
	_T('medias:texte_documents_joints_2') .
	'</p>
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
		<div class="editer-groupe">
			' .
	vide($Pile['vars'][$_zzz=(string)'name'] = 'documents_objets') .
	vide($Pile['vars'][$_zzz=(string)'erreurs'] = table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),table_valeur($Pile["vars"], (string)'name', null))) .
	'<div class="editer long_label editer_' .
	table_valeur($Pile["vars"], (string)'name', null) .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'obli', null)))!=='' ?
			(' ' . $t2) :
			'') .
	((table_valeur($Pile["vars"], (string)'erreurs', null))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'">
				<label>' .
	_T('medias:label_activer_document_objets') .
	'</label>' .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'erreurs', null)))!=='' ?
			('
				<span class=\'erreur_message\'>' . $t2 . '</span>
				') :
			'') .
	recuperer_fond( 'formulaires/inc-choisir-objets' , array('name' => table_valeur($Pile["vars"], (string)'name', null) ,
	'selected' => table_valeur(@$Pile[0], (string)table_valeur($Pile["vars"], (string)'name', null), null) ,
	'exclus' => 'spip_documents' ), array('compil'=>array('../plugins-dist/medias/formulaires/configurer_documents.html','html_faa46a46f55b23506fe261ebd788e539','',14,$GLOBALS['spip_lang'])), _request('connect')) .
	'</div>
			' .
	vide($Pile['vars'][$_zzz=(string)'name'] = 'documents_date') .
	vide($Pile['vars'][$_zzz=(string)'erreurs'] = table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),table_valeur($Pile["vars"], (string)'name', null))) .
	'<div class="editer pleine_largeur editer_' .
	table_valeur($Pile["vars"], (string)'name', null) .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'obli', null)))!=='' ?
			(' ' . $t2) :
			'') .
	((table_valeur($Pile["vars"], (string)'erreurs', null))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'">
				' .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'erreurs', null)))!=='' ?
			('
				<span class=\'erreur_message\'>' . $t2 . '</span>
				') :
			'') .
	'<div class="choix">
						<input type="radio" name="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'" id="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'_oui" value="oui"
						' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)table_valeur($Pile["vars"], (string)'name', null), null),true) == 'oui')) ?' ' :''))))!=='' ?
			($t2 . 'checked="checked"') :
			'') .
	' /><label for="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'_oui">' .
	_T('medias:item_autoriser_selectionner_date_en_ligne') .
	'</label>
					</div>
					<div class="choix">
						<input type="radio" name="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'" id="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'_non" value="non"
						' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)table_valeur($Pile["vars"], (string)'name', null), null),true) == 'oui')) ?'' :' '))))!=='' ?
			($t2 . 'checked="checked"') :
			'') .
	' /><label for="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'_non">' .
	_T('medias:item_non_autoriser_selectionner_date_en_ligne') .
	'</label>
					</div>
			</div>
		</div>
	  ' .
	'
	  <!--extra-->
	  <p class=\'boutons\'><span class=\'image_loading\'>&nbsp;</span><input type=\'submit\' class=\'submit\' value=\'' .
	_T('public|spip|ecrire:bouton_enregistrer') .
	'\' /></p>
	</div></form>
	')) :
		'') .
'
</div>');

	return analyse_resultat_skel('html_faa46a46f55b23506fe261ebd788e539', $Cache, $page, '../plugins-dist/medias/formulaires/configurer_documents.html');
}
?>