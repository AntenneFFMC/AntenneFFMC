<?php

/*
 * Squelette : ../prive/formulaires/editer_article.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:50 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/formulaires/editer_article.html
// Temps de compilation total: 27.644 ms
//

function html_47eb23f5de0253d8c25fa8a872c61977($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<div class="formulaire_spip formulaire_editer formulaire_editer_article formulaire_editer_article-' .
interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'id_article', null), 'nouveau'),true)) .
'">
	' .
(($t1 = strval(table_valeur(@$Pile[0], (string)'message_ok', null)))!=='' ?
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
	'</div>' .
	'
		<input type=\'hidden\' name=\'id_article\' value=\'' .
	interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true)) .
	'\' />
		<div class="editer-groupe">
			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_surtitre') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'surtitre', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_surtitre' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'surtitre'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="surtitre">' .
		_T('public|spip|ecrire:texte_sur_titre') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('surtitre','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'surtitre')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'<input type=\'text\' class=\'text\' name=\'surtitre\' id=\'surtitre\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' value="' .
		table_valeur(@$Pile[0], (string)'surtitre', null) .
		'" />
			</div>')) :
			'') .
	'
			<div class="editer editer_titre obligatoire' .
	((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'titre'))  ?
			(' ' . ' ' . 'erreur') :
			'') .
	'">
				<label for="titre">' .
	_T('public|spip|ecrire:info_titre') .
	'<em class="aide">' .
	interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('titre','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
	'</em></label>' .
	(($t2 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'titre')))!=='' ?
			('
				<span class=\'erreur_message\'>' . $t2 . '</span>
				') :
			'') .
	'<input type=\'text\' class=\'text\' name=\'titre\' id=\'titre\'' .
	(($t2 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
			(' lang=\'' . $t2 . '\'') :
			'') .
	' value="' .
	sinon(table_valeur(@$Pile[0], (string)'titre', null), '') .
	'"
				placeholder="' .
	attribut_html(_T('public|spip|ecrire:info_nouvel_article')) .
	'" />
			</div>
			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_soustitre') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'soustitre', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_soustitre' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'soustitre'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="soustitre">' .
		_T('public|spip|ecrire:texte_sous_titre') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('soustitre','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'soustitre')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'<input type=\'text\' class=\'text\' name=\'soustitre\' id=\'soustitre\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' value="' .
		table_valeur(@$Pile[0], (string)'soustitre', null) .
		'" />
			</div>')) :
			'') .
	'
			' .
	(($t2 = strval(filtre_chercher_rubrique_dist('',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_article', null),true)),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_parent', null),true)),'article',interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'id_secteur', null),true)),table_valeur(table_valeur(@$Pile[0], (string)'config', null),'restreint'),'0','form_simple')))!=='' ?
			((	'<div class="editer editer_parent' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'id_parent'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="id_parent">' .
		_T('public|spip|ecrire:titre_cadre_interieur_rubrique') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('id_parent','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'id_parent')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'
				') . $t2 . '
			</div>') :
			'') .
	'
		
			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_descriptif') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'descriptif', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_descriptif' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'descriptif'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="descriptif">' .
		_T('public|spip|ecrire:texte_descriptif_rapide') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('descriptif','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'descriptif')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'<textarea name=\'descriptif\' id=\'descriptif\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' rows=\'2\' cols=\'40\'>' .
		table_valeur(@$Pile[0], (string)'descriptif', null) .
		'</textarea>
			</div>')) :
			'') .
	'
			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_chapeau') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'chapo', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_chapo' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'chapo'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="chapo">' .
		_T('public|spip|ecrire:info_chapeau') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('chapo','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'chapo')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'<textarea name=\'chapo\' id=\'chapo\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'config', null),'lignes')))!=='' ?
				(' rows=\'' . $t3 . '\'') :
				'') .
		' cols=\'40\'>' .
		table_valeur(@$Pile[0], (string)'chapo', null) .
		'</textarea>
			</div>')) :
			'') .
	'

			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_urlref') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'url_site', null), sinon(table_valeur(@$Pile[0], (string)'nom_site', null), '')):' '))  ?
			(' ' . (	'
			<div class="editer editer_liens_sites fieldset">
				<fieldset>
					<h3 class="legend">' .
		_T('public|spip|ecrire:entree_liens_sites') .
		'</h3>
					<div class="editer-groupe">
						<div class="editer editer_nom_site' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'nom_site'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
							<label for="nom_site">' .
		_T('public|spip|ecrire:info_titre') .
		'</label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'nom_site')))!=='' ?
				('
							<span class=\'erreur_message\'>' . $t3 . '</span>
							') :
				'') .
		'<input type=\'text\' class=\'text\' name=\'nom_site\' id=\'nom_site\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' value="' .
		table_valeur(@$Pile[0], (string)'nom_site', null) .
		'" />
						</div>
						<div class="editer editer_url_site' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'url_site'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
							<label for="url_site">' .
		_T('public|spip|ecrire:info_url') .
		'</label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'url_site')))!=='' ?
				('
							<span class=\'erreur_message\'>' . $t3 . '</span>
							') :
				'') .
		'<input type=\'text\' class=\'text\' name=\'url_site\' id=\'url_site\' value="' .
		table_valeur(@$Pile[0], (string)'url_site', null) .
		'" />
						</div>
					</div>
				</fieldset>
			</div>')) :
			'') .
	'

			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_texte') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'texte', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_texte obligatoire' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'texte'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="text_area">' .
		_T('public|spip|ecrire:info_texte') .
		'<em class="aide">' .
		interdire_scripts((($aider=charger_fonction('aide','inc',true))?$aider('text_area','../prive/formulaires/editer_article.html', $Pile[0]):'')) .
		'</em></label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'texte')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		sinon(table_valeur(@$Pile[0], (string)'_texte_trop_long', null), '') .
		'
				<textarea name=\'texte\' id=\'text_area\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' rows=\'' .
		plus(table_valeur(table_valeur(@$Pile[0], (string)'config', null),'lignes'),'2') .
		'\' cols=\'40\'>' .
		table_valeur(@$Pile[0], (string)'texte', null) .
		'</textarea>
			</div>')) :
			'') .
	'
			' .
	((((table_valeur(table_valeur(@$Pile[0], (string)'config', null),'articles_ps') == 'non') ? sinon(table_valeur(@$Pile[0], (string)'ps', null), ''):' '))  ?
			(' ' . (	'
			<div class="editer editer_ps' .
		((table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'ps'))  ?
				(' ' . ' ' . 'erreur') :
				'') .
		'">
				<label for="ps">' .
		_T('public|spip|ecrire:info_post_scriptum') .
		'</label>' .
		(($t3 = strval(table_valeur(table_valeur(@$Pile[0], (string)'erreurs', null),'ps')))!=='' ?
				('
				<span class=\'erreur_message\'>' . $t3 . '</span>
				') :
				'') .
		'<textarea name=\'ps\' id=\'ps\'' .
		(($t3 = strval(interdire_scripts(@$Pile[0]['langue'])))!=='' ?
				(' lang=\'' . $t3 . '\'') :
				'') .
		' rows=\'5\' cols=\'40\'>' .
		table_valeur(@$Pile[0], (string)'ps', null) .
		'</textarea>
			</div>')) :
			'') .
	'
		</div>

		' .
	'
		<!--extra-->
		<p class=\'boutons\'><input type=\'submit\' name="save" class=\'submit\' value=\'' .
	_T('public|spip|ecrire:bouton_enregistrer') .
	'\' /></p>
	</div></form>
	')) :
		'') .
'
</div>
');

	return analyse_resultat_skel('html_47eb23f5de0253d8c25fa8a872c61977', $Cache, $page, '../prive/formulaires/editer_article.html');
}
?>