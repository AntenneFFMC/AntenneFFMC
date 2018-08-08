<?php

/*
 * Squelette : ../plugins-dist/urls_etendues/formulaires/editer_url_objet.html
 * Date :      Wed, 14 Mar 2018 16:28:02 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/urls_etendues/formulaires/editer_url_objet.html
// Temps de compilation total: 4.681 ms
//

function html_aaaf8b2c86752968b29b71727d3cd858($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
recuperer_fond( 'prive/objets/liste/urls' , array('type' => interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_objet', null),true)) ,
	'id_objet' => interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'_id_objet', null),true)) ), array('ajax' => ($v=( @$Pile[0]['ajax'] ))?$v:true,'compil'=>array('../plugins-dist/urls_etendues/formulaires/editer_url_objet.html','html_aaaf8b2c86752968b29b71727d3cd858','',1,$GLOBALS['spip_lang'])), _request('connect')) .
(($t1 = strval(interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'editable', null),true))))!=='' ?
		((	'<div class="formulaire_spip formulaire_editer formulaire_' .
	interdire_scripts(@$Pile[0]['form']) .
	' formulaire_' .
	interdire_scripts(@$Pile[0]['form']) .
	'-' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id', null), 'nouveau'),true)) .
	'">
	' .
	(($t2 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_ok', null))))!=='' ?
			('<p class="reponse_formulaire reponse_formulaire_ok">' . $t2 . '</p>') :
			'') .
	'
	' .
	(($t2 = strval(interdire_scripts(table_valeur(@$Pile[0], (string)'message_erreur', null))))!=='' ?
			('<p class="reponse_formulaire reponse_formulaire_erreur">' . $t2 . '</p>') :
			'') .
	'
	') . $t1 . (	'
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
		' .
	vide($Pile['vars'][$_zzz=(string)'fl'] = 'urls') .
	'<div class="editer-groupe">
	  	' .
	vide($Pile['vars'][$_zzz=(string)'name'] = 'url') .
	vide($Pile['vars'][$_zzz=(string)'erreurs'] = table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),table_valeur($Pile["vars"], (string)'name', null))) .
	vide($Pile['vars'][$_zzz=(string)'obli'] = 'obligatoire') .
	'<div class="editer editer_' .
	table_valeur($Pile["vars"], (string)'name', null) .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'obli', null)))!=='' ?
			(' ' . $t2) :
			'') .
	((table_valeur($Pile["vars"], (string)'erreurs', null))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'">
	    	<label for="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'">' .
	_T('urls:label_url') .
	'</label>
				' .
	(($t2 = strval(table_valeur($Pile["vars"], (string)'erreurs', null)))!=='' ?
			('<span class=\'erreur_message\'>' . $t2 . '</span>') :
			'') .
	'
				<input type="text" class="text" name="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'" id="' .
	table_valeur($Pile["vars"], (string)'name', null) .
	'" size="40" value="' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)table_valeur($Pile["vars"], (string)'name', null), null),true)) .
	'" />
			</div>
	  </div>
	  ' .
	'
	  <!--extra-->
	  <p class=\'boutons\'><span class=\'image_loading\'></span><input type=\'submit\' class=\'submit\' value=\'' .
	_T('public|spip|ecrire:bouton_enregistrer') .
	'\' /></p>
	</div></form>
</div>')) :
		''));

	return analyse_resultat_skel('html_aaaf8b2c86752968b29b71727d3cd858', $Cache, $page, '../plugins-dist/urls_etendues/formulaires/editer_url_objet.html');
}
?>