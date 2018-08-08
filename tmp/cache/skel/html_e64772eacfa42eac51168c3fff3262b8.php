<?php

/*
 * Squelette : ../plugins-dist/medias/formulaires/methodes_upload/mediatheque.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:58 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/formulaires/methodes_upload/mediatheque.html
// Temps de compilation total: 5.875 ms
//

function html_e64772eacfa42eac51168c3fff3262b8($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="editer-groupe">
    <div class=\'editer editer_refdoc_joindre' .
((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'refdoc_joindre'))  ?
		(' ' . ' ' . 'erreur') :
		'') .
'\'>
        <label for=\'refdoc_joindre' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'\'>' .
_T('medias:label_refdoc_joindre') .
'</label>' .
(($t1 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'refdoc_joindre')))!=='' ?
		('
        <span class=\'erreur_message\'>' . $t1 . '</span>
        ') :
		'') .
'<input class=\'text\' type="text" name="refdoc_joindre" value=\'' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'refdoc_joindre', null),true)) .
'\' id="refdoc_joindre' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'"/>
        <input class=\'submit\' type="button" name="parcourir" value="' .
_T('medias:bouton_parcourir') .
'"
            onclick="jQuery.modalboxload(\'' .
generer_url_ecrire('popin-choisir_document',(	'var_zajax=contenu&selectfunc=mediaselect' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)))) .
'\',{autoResize: true});"
        />
        <!--editer_refdoc_joindre-->
    </div>
</div>
<script type="text/javascript">/*<![CDATA[*/
function mediaselect' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'(id){jQuery.modalboxclose();jQuery("#refdoc_joindre' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'").attr(\'value\',\'doc\'+id).focus();jQuery(\'#joindre_mediatheque' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'domid', null),true)) .
'>.boutons input\').get(0).click();}
/*]]>*/</script>');

	return analyse_resultat_skel('html_e64772eacfa42eac51168c3fff3262b8', $Cache, $page, '../plugins-dist/medias/formulaires/methodes_upload/mediatheque.html');
}
?>