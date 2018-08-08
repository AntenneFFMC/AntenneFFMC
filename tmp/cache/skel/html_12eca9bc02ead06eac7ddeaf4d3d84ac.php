<?php

/*
 * Squelette : ../prive/squelettes/inclure/barre-nav.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Wed, 08 Aug 2018 10:18:35 GMT
 * Boucles :   _sous, _boutons, _creersous, _creer, _collaborersous, _collaborer
 */ 

function BOUCLE_soushtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(interdire_scripts(safehtml((isset($Pile[$SP]['sousmenu'])?$Pile[$SP]['sousmenu']:(@$Pile[0]['sousmenu'])))));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_sous';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"favori",
		"libelle",
		".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_sous',48,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$Numrows['_sous']['total'] = @intval($iter->count());
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
							' .
(($t1 = strval(interdire_scripts(((safehtml((isset($Pile[$SP]['favori'])?$Pile[$SP]['favori']:((isset($Pile[$SP-1]['favori'])?$Pile[$SP-1]['favori']:(@$Pile[0]['favori'])))))) ?' ' :''))))!=='' ?
		($t1 . vide($Pile['vars'][$_zzz=(string)'has_favoris'] = '1')) :
		'') .
'
							' .
(($t1 = strval(interdire_scripts(_T(safehtml((isset($Pile[$SP]['libelle'])?$Pile[$SP]['libelle']:((isset($Pile[$SP-1]['libelle'])?$Pile[$SP-1]['libelle']:(@$Pile[0]['libelle'])))))))))!=='' ?
		((	'<li' .
	(($t2 = strval(interdire_scripts((safehtml((isset($Pile[$SP]['favori'])?$Pile[$SP]['favori']:((isset($Pile[$SP-1]['favori'])?$Pile[$SP-1]['favori']:(@$Pile[0]['favori']))))) ? 'favori':(table_valeur($Pile["vars"], (string)'has_favoris', null) ? 'non_favori':'')))))!=='' ?
			(' class="' . $t2 . '"') :
			'') .
	'>
							<a href="' .
	interdire_scripts(bandeau_creer_url(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle']))),interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'urlArg'))),table_valeur($Pile["vars"], (string)'contexte', null))) .
	'" class="bando2_' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'">
								') . $t1 . '
							</a>
							</li>') :
		'') .
'
							');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_sous @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_boutonshtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'boutons', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_boutons';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"sousmenu",
		"favori",
		"libelle",
		".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array(
			array('NOT', 
			array('=', 'cle', "'outils_rapides'")), 
			array('NOT', 
			array('=', 'cle', "'outils_collaboratifs'")));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_boutons',37,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
'
					' .
(($t1 = strval(interdire_scripts((((((safehtml($Pile[$SP]['cle']) == 'menu_accueil')) OR (interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'sousmenu'))))) ?' ' :'') ? ' ':vide($Pile['vars'][$_zzz=(string)'li'] = '')))))!=='' ?
		('<li ' . $t1 . (	' ' .
	vide($Pile['vars'][$_zzz=(string)'li'] = '</li>') .
	(($t2 = strval(unique('first')))!=='' ?
			('class="' . $t2 . '"') :
			'') .
	'>
					<a href="' .
	interdire_scripts(bandeau_creer_url(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle']))),interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'urlArg'))),table_valeur($Pile["vars"], (string)'contexte', null))) .
	'" id="bando1_' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'">
						' .
	interdire_scripts(_T(safehtml((isset($Pile[$SP]['libelle'])?$Pile[$SP]['libelle']:(@$Pile[0]['libelle']))))) .
	'
					</a>
					')) :
		'') .
vide($Pile['vars'][$_zzz=(string)'has_favoris'] = '0') .
'
					' .
(($t1 = BOUCLE_soushtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
						<ul' .
		((($Numrows['_sous']['total'] > '20'))  ?
				(' ' . ' ' . 'class="menu-2col"') :
				'') .
		'>
							') . $t1 . '
						</ul>
					') :
		'') .
'
					' .
table_valeur($Pile["vars"], (string)'li', null));
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_boutons @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_creersoushtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(interdire_scripts(safehtml((isset($Pile[$SP]['sousmenu'])?$Pile[$SP]['sousmenu']:(@$Pile[0]['sousmenu'])))));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_creersous';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle");
		$command['orderby'] = array('position');
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_creersous',79,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
(($t1 = strval(interdire_scripts(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle'))))))!=='' ?
		((	'<li class="bouton"><a
						href="' .
	interdire_scripts(bandeau_creer_url(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle']))),interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'urlArg'))),table_valeur($Pile["vars"], (string)'contexte', null))) .
	'"
						title="' .
	interdire_scripts(attribut_html(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle'))))) .
	'"
						class="bando2_' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'"><span>') . $t1 . '</span></a></li>') :
		'') .
'
					');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_creersous @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_creerhtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'boutons', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_creer';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"sousmenu");
		$command['orderby'] = array();
		$command['where'] = 
			array(
			array('=', 'cle', "'outils_rapides'"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_creer',77,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= BOUCLE_creersoushtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_creer @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_collaborersoushtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(interdire_scripts(safehtml((isset($Pile[$SP]['sousmenu'])?$Pile[$SP]['sousmenu']:(@$Pile[0]['sousmenu'])))));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_collaborersous';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		".cle");
		$command['orderby'] = array();
		$command['where'] = 
			array();
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_collaborersous',91,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (($t1 = strval(interdire_scripts(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle'))))))!=='' ?
		((	'<li class="bouton"><a
							href="' .
	interdire_scripts(bandeau_creer_url(((($a = safehtml(table_valeur($Pile[$SP]['valeur'], 'url'))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(safehtml($Pile[$SP]['cle']))),interdire_scripts(safehtml(table_valeur($Pile[$SP]['valeur'], 'urlArg'))),table_valeur($Pile["vars"], (string)'contexte', null))) .
	'"
							title="' .
	interdire_scripts(attribut_html(_T(safehtml(table_valeur($Pile[$SP]['valeur'], 'libelle'))))) .
	'"
							class="bando2_' .
	interdire_scripts(safehtml($Pile[$SP]['cle'])) .
	'"><span>') . $t1 . '</span></a></li>') :
		'');
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_collaborersous @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_collaborerhtml_12eca9bc02ead06eac7ddeaf4d3d84ac(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['sourcemode'] = 'tableau';

	$command['source'] = array(table_valeur($Pile["vars"], (string)'boutons', null));

	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_collaborer';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur",
		"sousmenu");
		$command['orderby'] = array();
		$command['where'] = 
			array(
			array('=', 'cle', "'outils_collaboratifs'"));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"DATA",
		$command,
		array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','_collaborer',89,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= BOUCLE_collaborersoushtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP);
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_collaborer @ ../prive/squelettes/inclure/barre-nav.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/squelettes/inclure/barre-nav.html
// Temps de compilation total: 77.837 ms
//

function html_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
vide($Pile['vars'][$_zzz=(string)'contexte'] = interdire_scripts(eval('return '.'definir_barre_contexte()'.';'))) .
vide($Pile['vars'][$_zzz=(string)'boutons'] = trier_boutons_enfants_par_favoris_alpha(definir_barre_boutons(table_valeur($Pile["vars"], (string)'contexte', null),'0'))) .
'<div id="bando_haut" role="navigation">
	<div id="bando_liens_rapides">
		<div class="largeur clearfix">
			<a href="#conteneur" onclick="return focus_zone(\'#conteneur\')">Aller au contenu</a> |
			<a href="#bando_navigation" onclick="return focus_zone(\'#bando_navigation\')">Aller &agrave; la navigation</a> |
			<a href="#recherche" onclick="return focus_zone(\'#rapides .formulaire_recherche\')">Aller &agrave; la recherche</a>
		</div>
	</div>

	<div id="bando_identite">
		<div class="largeur clearfix">
			<p class="session"><a
					title="' .
attribut_html(_T('public|spip|ecrire:icone_informations_personnelles')) .
' (' .
attribut_html(_T('public|spip|ecrire:auteur')) .
' #' .
interdire_scripts(invalideur_session($Cache, table_valeur($GLOBALS["visiteur_session"], (string)'id_auteur', null))) .
')"
					href="' .
generer_url_ecrire('infos_perso') .
'"><strong class="nom">' .
interdire_scripts(invalideur_session($Cache, couper(typo(((($a = trim(table_valeur($GLOBALS["visiteur_session"], (string)'nom', null))) OR (is_string($a) AND strlen($a))) ? $a : interdire_scripts(invalideur_session($Cache, table_valeur($GLOBALS["visiteur_session"], (string)'login', null))))),'30'))) .
'</strong></a> |
				<a class="menu_lang"
					href="' .
generer_url_ecrire('configurer_langage') .
'"
					title="' .
_T('public|spip|ecrire:titre_config_langage') .
'">' .
interdire_scripts(filtre_balise_img_dist(chemin_image('langues.png'),_T('public|spip|ecrire:titre_config_langage'))) .
traduire_nom_langue(spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang'])) .
'</a> |
				' .
(($t1 = strval(interdire_scripts(((filtre_info_plugin_dist("aide", "est_actif")) ?' ' :''))))!=='' ?
		($t1 . (	'<a class="aide popin" target="_blank"
					href="' .
	generer_url_ecrire('aide',(	'var_lang=' .
		spip_htmlentities(@$Pile[0]['lang'] ? @$Pile[0]['lang'] : $GLOBALS['spip_lang']))) .
	'">' .
	_T('public|spip|ecrire:icone_aide_ligne') .
	'</a> |')) :
		'') .
'
				<a href="' .
generer_url_action('logout','logout=prive') .
'">' .
_T('public|spip|ecrire:icone_deconnecter') .
'</a>
			</p>
			<p class="nom_site_spip">' .
vide($Pile['vars'][$_zzz=(string)'configurer'] = invalideur_session($Cache, (((function_exists("autoriser")||include_spip("inc/autoriser"))&&autoriser('configurer')?" ":"") ? 'oui':''))) .
((table_valeur($Pile["vars"], (string)'configurer', null))  ?
		(' ' . (	'<a
					class="info"
					title="' .
	attribut_html(_T('public|spip|ecrire:titre_identite_site')) .
	'"
					href="' .
	generer_url_ecrire('configurer_identite') .
	'">')) :
		'') .
'<strong
					class="nom">' .
(($t1 = strval(interdire_scripts(couper(typo($GLOBALS['meta']['nom_site'], "TYPO", $connect, $Pile[0]),'35'))))!=='' ?
		(' ' . $t1 . ' ') :
		'') .
'</strong>' .
((table_valeur($Pile["vars"], (string)'configurer', null))  ?
		('</a>' . ' ') :
		'') .
'|
				<a class="voir"
					href="' .
spip_htmlspecialchars(sinon($GLOBALS['meta']['adresse_site'],'.')) .
'">' .
_T('public|spip|ecrire:icone_visiter_site') .
'</a>
			</p>
		</div>
	</div>

	<div id="bando_navigation">
		<div class="largeur clearfix">
			' .
(($t1 = BOUCLE_boutonshtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
				<ul class="deroulant">
					' . $t1 . '
				</ul>
			') :
		'') .
'
		</div>
	</div>

	<div id="bando_outils">
		<div class="largeur clearfix">
			<ul class="bandeau_rubriques deroulant">
				<li class="plan_site"><a
					href="' .
generer_url_ecrire('plan') .
'"
					id="boutonbandeautoutsite">' .
interdire_scripts(filtre_balise_img_dist(chemin_image('plan_site-24.png'))) .
'</a>
					' .
menu_rubriques('') .
'</li></ul>
			' .
(($t1 = BOUCLE_creerhtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
				<ul class="rapides creer">
					' . $t1 . '
				</ul>
			') :
		'') .
'
			<div id="rapides">
				' .
(($t1 = BOUCLE_collaborerhtml_12eca9bc02ead06eac7ddeaf4d3d84ac($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
					<ul class="rapides collaborer">
					' . $t1 . '
					</ul>
				') :
		'') .
'

				' .
executer_balise_dynamique('FORMULAIRE_RECHERCHE_ECRIRE',
	array(),
	array('../prive/squelettes/inclure/barre-nav.html','html_12eca9bc02ead06eac7ddeaf4d3d84ac','',100,$GLOBALS['spip_lang'])) .
'
			</div>
		</div>
	</div>

</div>
');

	return analyse_resultat_skel('html_12eca9bc02ead06eac7ddeaf4d3d84ac', $Cache, $page, '../prive/squelettes/inclure/barre-nav.html');
}
?>