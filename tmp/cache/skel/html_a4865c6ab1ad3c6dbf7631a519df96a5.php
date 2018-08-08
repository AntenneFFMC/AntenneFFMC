<?php

/*
 * Squelette : ../plugins-dist/urls_etendues/prive/style_prive_plugin_urls.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:04 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/urls_etendues/prive/style_prive_plugin_urls.html
// Temps de compilation total: 6.195 ms
//

function html_a4865c6ab1ad3c6dbf7631a519df96a5($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=iso-8859-15') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>.fiche_objet .editer_urls .link {color:#999;display: block;margin-' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'right', null),true)) .
': 100px;padding-' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'left', null),true)) .
': 20px;background: url(' .
interdire_scripts(chemin_image('url-16.png')) .
') no-repeat top ' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'left', null),true)) .
';}
.fiche_objet .editer_urls .link .url {color: #999;text-decoration: none;}
.fiche_objet .editer_urls .link .edit {visibility: hidden;float: ' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'right', null),true)) .
';}
.fiche_objet .editer_urls .edition {display:none;}
.fiche_objet .editer_urls.open .edition {display:block;}
.fiche_objet .editer_urls .link:hover,
.fiche_objet .editer_urls.open .link {color: inherit;}
.fiche_objet .editer_urls .link:hover .edit,
.fiche_objet .editer_urls.open .link .edit {visibility: visible;}
.fiche_objet .editer_urls .liste-objets .objet {display: none;}
.fiche_objet .editer_urls .liste-objets {margin-bottom: 0; overflow:auto; width:100%; }
.fiche_objet .editer_urls .formulaire_spip {margin-top:0;border:0;border-top: 1px solid #EEE;}');

	return analyse_resultat_skel('html_a4865c6ab1ad3c6dbf7631a519df96a5', $Cache, $page, '../plugins-dist/urls_etendues/prive/style_prive_plugin_urls.html');
}
?>