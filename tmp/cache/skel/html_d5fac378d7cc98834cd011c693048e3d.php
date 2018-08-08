<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/joindre_document.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:57 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/joindre_document.html
// Temps de compilation total: 12.958 ms
//

function html_d5fac378d7cc98834cd011c693048e3d($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		($t1 . (	'
<div class=\'formulaire_spip formulaire_joindre formulaire_joindre_document\' id=\'formulaire_joindre_document-' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)) .
	'\'>
	' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'_mode', null),true) == 'image')) ?' ' :''))))!=='' ?
			($t2 . (	'
	<h3 class=\'titrem\'>' .
		interdire_scripts(filtre_balise_img_dist(chemin_image('image-24.png'),'','cadre-icone')) .
		(($t3 = strval(interdire_scripts((intval(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)) ? _T('medias:bouton_remplacer_image'):_T('medias:bouton_ajouter_image')))))!=='' ?
				($t3 . (	' ' .
			interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('ins_img','../plugins-dist/medias/formulaires/joindre_document.html', $Pile[0]):'')))) :
				'') .
		'</h3>
	')) :
			'') .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'_mode', null),true) == 'document')) ?' ' :''))))!=='' ?
			($t2 . (	'
	<h3 class=\'titrem\'>' .
		interdire_scripts(filtre_balise_img_dist(chemin_image('doc-24.png'),'','cadre-icone')) .
		(($t3 = strval(interdire_scripts((intval(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)) ? _T('medias:bouton_remplacer_document'):_T('medias:bouton_ajouter_document')))))!=='' ?
				($t3 . (	' ' .
			interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('ins_doc','../plugins-dist/medias/formulaires/joindre_document.html', $Pile[0]):'')))) :
				'') .
		'</h3>
	')) :
			'') .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'_mode', null),true) == 'choix')) ?' ' :''))))!=='' ?
			($t2 . (	'
	<h3 class=\'titrem\'>' .
		interdire_scripts(filtre_balise_img_dist(chemin_image('doc-24.png'),'','cadre-icone')) .
		(($t3 = strval(interdire_scripts((intval(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)) ? _T('medias:bouton_remplacer_image_document'):_T('medias:bouton_ajouter_image_document')))))!=='' ?
				($t3 . (	' ' .
			interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('ins_doc','../plugins-dist/medias/formulaires/joindre_document.html', $Pile[0]):'')))) :
				'') .
		'</h3>
	')) :
			'') .
	'
	<span class="image_loading"></span>
	' .
	(($t2 = strval(table_valeur(@$Pile[0], (string)'message_ok', null)))!=='' ?
			('<div class="reponse_formulaire reponse_formulaire_ok">' . $t2 . '</div>') :
			'') .
	'
	' .
	(($t2 = strval(table_valeur(@$Pile[0], (string)'message_erreur', null)))!=='' ?
			('<p class="reponse_formulaire reponse_formulaire_erreur">' . $t2 . '</p>') :
			'') .
	'
	
	<form action="' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true)) .
	'#formulaire_joindre_document-' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'new'),true)) .
	'" method="post" enctype=\'multipart/form-data\'><div>
		' .
		'<div>' .
	form_hidden(@$Pile[0]['action']) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>
		
		' .
	recuperer_fond( 'formulaires/inc-upload_document' , array_merge($Pile[0],array('mediatheque' => interdire_scripts(((((((entites_html(sinon(table_valeur(@$Pile[0], (string)'objet', null), ''),true)) AND (interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id_objet', null), ''),true)))) ?' ' :'')) AND (interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'proposer_media', null),true)))) ?' ' :'')) )), array('compil'=>array('../plugins-dist/medias/formulaires/joindre_document.html','html_d5fac378d7cc98834cd011c693048e3d','',10,$GLOBALS['spip_lang'])), _request('connect')) .
	'
		
	</div></form>
</div>')) :
		'') .
'
' .
(($t1 = strval(interdire_scripts(((entites_html(sinon(table_valeur(@$Pile[0], (string)'_galerie', null), ''),true)) ?' ' :''))))!=='' ?
		($t1 . (	'
		' .
	recuperer_fond( interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_galerie', null),true)) , array_merge($Pile[0],array()), array('ajax' => ($v=( @$Pile[0]['ajax'] ))?$v:true,'compil'=>array('../plugins-dist/medias/formulaires/joindre_document.html','html_d5fac378d7cc98834cd011c693048e3d','',10,$GLOBALS['spip_lang'])), _request('connect')) .
	'
')) :
		'') .
'
');

	return analyse_resultat_skel('html_d5fac378d7cc98834cd011c693048e3d', $Cache, $page, '../plugins-dist/medias/formulaires/joindre_document.html');
}
?>