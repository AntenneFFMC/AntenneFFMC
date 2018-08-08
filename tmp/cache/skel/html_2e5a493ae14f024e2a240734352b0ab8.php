<?php

/*
 * Squelette : ../plugins-dist/forum/formulaires/activer_forums_objet.html
 * Date :      Wed, 14 Mar 2018 16:27:58 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/forum/formulaires/activer_forums_objet.html
// Temps de compilation total: 5.387 ms
//

function html_2e5a493ae14f024e2a240734352b0ab8($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class=\'formulaire_spip formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
'\' id=\'formulaire_' .
interdire_scripts(@$Pile[0]['form']) .
'-' .
interdire_scripts(@$Pile[0]['id']) .
'\'>
' .
(($t1 = strval(interdire_scripts(((entites_html(table_valeur(@$Pile[0], (string)'_suivi_forums', null),true)) ?' ' :''))))!=='' ?
		($t1 . (	'
' .
	filtre_icone_horizontale_dist(generer_url_ecrire('controler_forum',(	'objet=' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'objet', null),true)) .
		'&id_objet=' .
		interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_objet', null),true)))),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_suivi_forums', null),true)),'forum-24.png','','') .
	'
')) :
		'') .
'

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
	<form action="' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'action', null),true)) .
	'#formulaire_configurer_forums_article_moderation" method="post"><div>
		' .
		'<div>' .
	form_hidden(@$Pile[0]['action']) .
	'<input name=\'formulaire_action\' type=\'hidden\'
		value=\'' . @$Pile[0]['form'] . '\' />' .
	'<input name=\'formulaire_action_args\' type=\'hidden\'
		value=\'' . @$Pile[0]['formulaire_args']. '\' />' .
	(!empty($Pile[0]['_hidden']) ? @$Pile[0]['_hidden'] : '') .
	'</div>' .
	'
		<div class="editer-groupe">
			<div class=\'editer configurer_accepter_forum' .
	((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'accepter_forum'))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'\'>
				<label for=\'accepter_forum\'>' .
	_T('forum:info_fonctionnement_forum') .
	'</label>' .
	(($t2 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'accepter_forum')))!=='' ?
			('
				<span class=\'erreur_message\'>' . $t2 . '</span>
				') :
			'') .
	'<select name=\'accepter_forum\' id=\'accepter_forum\'>
					<option value=\'pos\'' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'accepter_forum', null),true) == 'pos')) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'selected=\'selected\'') :
			'') .
	'>' .
	_T('forum:bouton_radio_modere_posteriori') .
	'</option>
					<option value=\'pri\'' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'accepter_forum', null),true) == 'pri')) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'selected=\'selected\'') :
			'') .
	'>' .
	_T('forum:bouton_radio_modere_priori') .
	'</option>
					<option value=\'abo\'' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'accepter_forum', null),true) == 'abo')) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'selected=\'selected\'') :
			'') .
	'>' .
	_T('forum:bouton_radio_modere_abonnement') .
	'</option>
					<option value=\'non\'' .
	(($t2 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'accepter_forum', null),true) == 'non')) ?' ' :''))))!=='' ?
			(' ' . $t2 . 'selected=\'selected\'') :
			'') .
	'>' .
	_T('forum:info_pas_de_forum') .
	'</option>
				</select>
			</div>
		</div>
		<p class=\'boutons\'><input class=\'submit\' type="submit" name="ok" value="' .
	_T('public|spip|ecrire:bouton_enregistrer') .
	'"/></p>
	</div></form>
')) :
		'') .
'
</div>');

	return analyse_resultat_skel('html_2e5a493ae14f024e2a240734352b0ab8', $Cache, $page, '../plugins-dist/forum/formulaires/activer_forums_objet.html');
}
?>