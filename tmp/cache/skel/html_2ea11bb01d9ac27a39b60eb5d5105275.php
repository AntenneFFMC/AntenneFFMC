<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/methodes_upload/ftp.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:58 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/methodes_upload/ftp.html
// Temps de compilation total: 3.112 ms
//

function html_2ea11bb01d9ac27a39b60eb5d5105275($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="editer-groupe">
    ' .
(($t1 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'_options_upload_ftp', null))))!=='' ?
		((	'<div class=\'editer editer_cheminftp' .
	((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'cheminftp'))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'\'>
        <label for=\'cheminftp' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
	'\'>' .
	_T('info_selectionner_fichier',array('upload' => interdire_scripts(table_valeur(@$Pile[0], (string)'_dir_upload_ftp', null)))) .
	'</label>' .
	(($t2 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'cheminftp')))!=='' ?
			('
        <span class=\'erreur_message\'>' . $t2 . '</span>
        ') :
			'') .
	'<select name=\'cheminftp\' id=\'cheminftp' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
	'\' size=\'1\'>
        <option value=\'\'>&gt;&gt;</option>
        ') . $t1 . '
        </select>
        <!--editer_cheminftp-->
    </div>') :
		'') .
'
</div>
' .
(($t1 = strval(interdire_scripts((((((entites_html(table_valeur(@$Pile[0], (string)'_dir_upload_ftp', null),true)) AND (interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_options_upload_ftp', null),true)) ?'' :' ')))) ?' ' :'')) ?' ' :''))))!=='' ?
		($t1 . (	'
<p class="infos">
' .
	_T('info_installer_ftp',array('upload' => interdire_scripts(table_valeur(@$Pile[0], (string)'_dir_upload_ftp', null)))) .
	' ' .
	interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('ins_upload','../plugins-dist/medias/formulaires/methodes_upload/ftp.html', $Pile[0]):'')) .
	'</p>
')) :
		''));

	return analyse_resultat_skel('html_2ea11bb01d9ac27a39b60eb5d5105275', $Cache, $page, '../plugins-dist/medias/formulaires/methodes_upload/ftp.html');
}
?>