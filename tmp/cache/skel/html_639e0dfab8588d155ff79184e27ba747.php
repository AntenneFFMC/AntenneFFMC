<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/methodes_upload/distant.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:58 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/methodes_upload/distant.html
// Temps de compilation total: 5.195 ms
//

function html_639e0dfab8588d155ff79184e27ba747($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="editer-groupe">
    <div class=\'editer editer_url' .
((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'url'))  ?
		(' ' . ' ' . 'erreur') :
		'') .
'\'>
        <label for=\'url' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'\'>' .
_T('medias:info_referencer_doc_distant') .
'</label>' .
(($t1 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'url')))!=='' ?
		('
        <span class=\'erreur_message\'>' . $t1 . '</span>
        ') :
		'') .
'<input class=\'text\' type="text" name="url" value=\'' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'url', null),true)) .
'\' id="url' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'"/>
        <!--editer_url-->
    </div>
</div>');

	return analyse_resultat_skel('html_639e0dfab8588d155ff79184e27ba747', $Cache, $page, '../plugins-dist/medias/formulaires/methodes_upload/distant.html');
}
?>