<?php

/*
 * Squelette : ../plugins-dist/urls_etendues/prive/objets/editer/url.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/urls_etendues/prive/objets/editer/url.html
// Temps de compilation total: 5.700 ms
//

function html_04fb47427ca2142d87f8faf29fc128b3($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (($t1 = strval(interdire_scripts((((generer_info_entite(@$Pile[0]['id_objet'], interdire_scripts(@$Pile[0]['objet']), 'statut') != 'prepa')) ?' ' :''))))!=='' ?
		($t1 . (	'
<div class="editer_urls">
	' .
	(($t2 = strval(url_absolue(generer_url_entite(@$Pile[0]['id_objet'],interdire_scripts(@$Pile[0]['objet']),'','',interdire_scripts(eval('return '.'true'.';'))))))!=='' ?
			((	'<span class=\'link\'>
		' .
		vide($Pile['vars'][$_zzz=(string)'auth'] = invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('modifierurl', interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])), invalideur_session($Cache, @$Pile[0]['id_objet']))?" ":""))) .
		(($t3 = strval(table_valeur($Pile["vars"], (string)'auth', null)))!=='' ?
				($t3 . '
		<a href="#"
		title="Modifier l\'URL"
		onclick="jQuery(this).closest(\'.editer_urls\').find(\'.edition\').toggle(\'fast\').closest(\'.editer_urls\').delay(300).toggleClass(\'open\');return false;"
						>') :
				'') .
		'<span class="edit">' .
		_T('public|spip|ecrire:bouton_modifier') .
		'</span><span class="url" id="url-' .
		interdire_scripts(@$Pile[0]['objet']) .
		'-' .
		@$Pile[0]['id_objet'] .
		'">') . $t2 . (	'</span>' .
		(($t3 = strval(table_valeur($Pile["vars"], (string)'auth', null)))!=='' ?
				($t3 . '</a>') :
				'') .
		'</span>')) :
			'') .
	'
	' .
	(($t2 = strval(invalideur_session($Cache, ((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('modifier', interdire_scripts(invalideur_session($Cache, @$Pile[0]['objet'])), invalideur_session($Cache, @$Pile[0]['id_objet']))?" ":""))))!=='' ?
			($t2 . (	'
	<div class="edition">
		<div class="ajax">
			' .
		executer_balise_dynamique('FORMULAIRE_EDITER_URL_OBJET',
	array(interdire_scripts(@$Pile[0]['objet']),@$Pile[0]['id_objet']),
	array('../plugins-dist/urls_etendues/prive/objets/editer/url.html','html_04fb47427ca2142d87f8faf29fc128b3','',9,$GLOBALS['spip_lang'])) .
		'</div>
	</div>
	')) :
			'') .
	'
</div>
')) :
		'');

	return analyse_resultat_skel('html_04fb47427ca2142d87f8faf29fc128b3', $Cache, $page, '../plugins-dist/urls_etendues/prive/objets/editer/url.html');
}
?>