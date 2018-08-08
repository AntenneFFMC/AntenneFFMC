<?php

/*
 * Squelette : ../prive/modeles/pagination_prive.html
 * Date :      Wed, 14 Mar 2018 16:27:18 GMT
 * Compile :   Tue, 07 Aug 2018 17:18:47 GMT
 * Boucles :   _pages
 */ 

function BOUCLE_pageshtml_117fca5fb679e1c976a6619df51c06b6(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	$command['source'] = array(table_valeur($Pile["vars"], (string)'pages', null));
	$command['sourcemode'] = 'table';
	if (!isset($command['table'])) {
		$command['table'] = '';
		$command['id'] = '_pages';
		$command['from'] = array();
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array(".valeur");
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
		array('../prive/modeles/pagination_prive.html','html_117fca5fb679e1c976a6619df51c06b6','_pages',7,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		$t0 .= (
(($t1 = strval(vide($Pile['vars'][$_zzz=(string)'item'] = interdire_scripts(mult(moins($Pile[$SP]['valeur'],'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true)))))))!=='' ?
		('
		' . $t1 . '
		') :
		'') .
interdire_scripts(lien_ou_expose(ancre_url(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),(table_valeur($Pile["vars"], (string)'item', null) ? table_valeur($Pile["vars"], (string)'item', null):'')),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true))),table_valeur($Pile["vars"], (string)'item', null),interdire_scripts(($Pile[$SP]['valeur'] == interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true)))),'lien_pagination','','nofollow')) .
(($t1 = strval(interdire_scripts((($Pile[$SP]['valeur'] < table_valeur($Pile["vars"], (string)'derniere', null)) ? table_valeur($Pile["vars"], (string)'sep', null):''))))!=='' ?
		('<span
		class=\'sep\'>' . $t1 . '</span
		>') :
		''));
	}
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_pages @ ../prive/modeles/pagination_prive.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette ../prive/modeles/pagination_prive.html
// Temps de compilation total: 39.000 ms
//

function html_117fca5fb679e1c976a6619df51c06b6($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
interdire_scripts(table_valeur(@$Pile[0], (string)'bloc_ancre', null)) .
vide($Pile['vars'][$_zzz=(string)'bornes'] = interdire_scripts(filtre_bornes_pagination_dist(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true)),'10'))) .
vide($Pile['vars'][$_zzz=(string)'premiere'] = filtre_reset(table_valeur($Pile["vars"], (string)'bornes', null))) .
vide($Pile['vars'][$_zzz=(string)'derniere'] = filtre_end(table_valeur($Pile["vars"], (string)'bornes', null))) .
vide($Pile['vars'][$_zzz=(string)'pages'] = range(table_valeur($Pile["vars"], (string)'premiere', null),table_valeur($Pile["vars"], (string)'derniere', null))) .
vide($Pile['vars'][$_zzz=(string)'sep'] = interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'separateur', null), ' | '),true))) .
(($t1 = BOUCLE_pageshtml_117fca5fb679e1c976a6619df51c06b6($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		((	'
	' .
		(($t3 = strval(interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'label', null), ''),true))))!=='' ?
				('<span
  class=\'label\'>' . $t3 . '</span>') :
				'') .
		(($t3 = strval(vide($Pile['vars'][$_zzz=(string)'item'] = interdire_scripts(mult(moins(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true),'2'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true)))))))!=='' ?
				('

	' . $t3 . '

	') :
				'') .
		'<span
	class="pages">' .
		((table_valeur($Pile["vars"], (string)'premiere', null) > '1')  ?
				((	'<a
	href=\'' .
			interdire_scripts(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),'')) .
			'#' .
			interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true)) .
			'\'
	class=\'lien_pagination\'
	rel=\'nofollow\'>') . '0' . (	'</a><span
	class="tbc">' .
			(($t4 = strval(table_valeur($Pile["vars"], (string)'sep', null)))!=='' ?
					('<span
	class=\'sep\'>' . $t4 . '</span>') :
					'') .
			'...' .
			(($t4 = strval(table_valeur($Pile["vars"], (string)'sep', null)))!=='' ?
					('<span
	class=\'sep\'>' . $t4 . '</span>') :
					'') .
			'</span

		>')) :
				'')) . $t1 . (	(($t3 = strval(((table_valeur($Pile["vars"], (string)'derniere', null) < interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true))) ? interdire_scripts(mult(moins(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true),'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true)))):'')))!=='' ?
				((	'<span

	class="tbc">' .
			(($t4 = strval(table_valeur($Pile["vars"], (string)'sep', null)))!=='' ?
					('<span
	class=\'sep\'>' . $t4 . '</span>') :
					'') .
			'...' .
			(($t4 = strval(table_valeur($Pile["vars"], (string)'sep', null)))!=='' ?
					('<span
	class=\'sep\'>' . $t4 . '</span>') :
					'') .
			'</span><a
	href=\'' .
			interdire_scripts(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),interdire_scripts(mult(moins(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true),'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true)))))) .
			'#' .
			interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true)) .
			'\'
	class=\'lien_pagination\'
	rel=\'nofollow\'>') . $t3 . '</a>') :
				'') .
		'</span>' .
		(($t3 = strval(interdire_scripts((((mult(moins(entites_html(table_valeur(@$Pile[0], (string)'nombre_pages', null),true),'1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true))) < '1000')) ?' ' :''))))!=='' ?
				('
	' . $t3 . (	(($t4 = strval(vide($Pile['vars'][$_zzz=(string)'item'] = interdire_scripts(mult(entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'pas', null),true)))))))!=='' ?
					('
	' . $t4 . '
	') :
					'') .
			(($t4 = strval(interdire_scripts(lien_ou_expose(ancre_url(parametre_url(entites_html(table_valeur(@$Pile[0], (string)'url', null),true),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'debut', null),true)),'-1'),interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'ancre', null),true))),_T('public|spip|ecrire:lien_tout_afficher'),interdire_scripts((entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true) == '0')),'lien_pagination','','nofollow'))))!=='' ?
					((	'<span
	class="all' .
				(($t5 = strval(interdire_scripts((((entites_html(table_valeur(@$Pile[0], (string)'page_courante', null),true) == '0')) ?' ' :''))))!=='' ?
						($t5 . 'disabled') :
						'') .
				'">' .
				(($t5 = strval(table_valeur($Pile["vars"], (string)'sep', null)))!=='' ?
						('<span
	class=\'sep\'>' . $t5 . '</span>') :
						'')) . $t4 . '</span>') :
					''))) :
				'') .
		'
')) :
		''));

	return analyse_resultat_skel('html_117fca5fb679e1c976a6619df51c06b6', $Cache, $page, '../prive/modeles/pagination_prive.html');
}
?>