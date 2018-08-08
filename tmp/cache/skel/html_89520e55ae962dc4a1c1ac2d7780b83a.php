<?php

/*
 * Squelette : squelettes/inclure/inc_entete.html
 * Date :      Tue, 07 Aug 2018 17:27:25 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:27 GMT
 * Boucles :   _sousnav, _nav
 */ 

function BOUCLE_sousnavhtml_89520e55ae962dc4a1c1ac2d7780b83a(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_sousnav';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("0+rubriques.id_rubrique AS num",
		"rubriques.id_rubrique",
		"rubriques.titre",
		"rubriques.lang");
		$command['orderby'] = array('num', 'rubriques.id_rubrique');
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_parent', sql_quote($Pile[$SP]['id_rubrique'], '','bigint(21) NOT NULL DEFAULT \'0\'')));
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/inclure/inc_entete.html','html_89520e55ae962dc4a1c1ac2d7780b83a','_sousnav',27,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
							<li class="menu__sous-rubrique" >
								<span class="menu__sous-rubrique-texte"><a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_rubrique'], 'rubrique', '', '', true))) .
'">' .
interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</a></span>
								<span class="menu__sous-rubrique-illustration">' .

((!is_array($l = quete_logo('id_article', 'ON', @$Pile[0]['id_article'],$Pile[$SP]['id_rubrique'], 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')) .
'</span>
								<!--img class="menu__sous-rubrique-illustration"
										src="../images/partenaires/AFDM_bg.jpg"
										width="100%" /-->
							</li>
						');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_sousnav @ squelettes/inclure/inc_entete.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}


function BOUCLE_navhtml_89520e55ae962dc4a1c1ac2d7780b83a(&$Cache, &$Pile, &$doublons, &$Numrows, $SP) {

	static $command = array();
	static $connect;
	$command['connect'] = $connect = '';
	if (!isset($command['table'])) {
		$command['table'] = 'rubriques';
		$command['id'] = '_nav';
		$command['from'] = array('rubriques' => 'spip_rubriques');
		$command['type'] = array();
		$command['groupby'] = array();
		$command['select'] = array("rubriques.id_rubrique",
		"0+rubriques.id_rubrique AS num",
		"rubriques.titre",
		"rubriques.lang");
		$command['orderby'] = array('num', 'rubriques.id_rubrique');
		$command['where'] = 
			array(
quete_condition_statut('rubriques.statut','!','publie',''), 
			array('=', 'rubriques.id_parent', 0), 
			array('NOT', 
			array('=', 'rubriques.id_rubrique', "6")), 
			array('NOT', 
			array('=', 'rubriques.id_rubrique', "7")));
		$command['join'] = array();
		$command['limit'] = '';
		$command['having'] = 
			array();
	}
	if (defined("_BOUCLE_PROFILER")) $timer = time()+(float)microtime();
	$t0 = "";
	// REQUETE
	$iter = IterFactory::create(
		"SQL",
		$command,
		array('squelettes/inclure/inc_entete.html','html_89520e55ae962dc4a1c1ac2d7780b83a','_nav',10,$GLOBALS['spip_lang'])
	);
	if (!$iter->err()) {
	lang_select($GLOBALS['spip_lang']);
	$SP++;
	// RESULTATS
	while ($Pile[$SP]=$iter->fetch()) {

		lang_select_public($Pile[$SP]['lang'], '', $Pile[$SP]['titre']);
		$t0 .= (
'
				<li class="menu__rubrique">
					<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
					<span class="menu__rubrique-texte">
						<a href="' .
vider_url(urlencode_1738(generer_url_entite($Pile[$SP]['id_rubrique'], 'rubrique', '', '', true))) .
'">' .
interdire_scripts(supprimer_numero(typo($Pile[$SP]['titre']), "TYPO", $connect, $Pile[0])) .
'</a>
					</span>
					<ul class="menu__liste-sous-liste">
						' .
BOUCLE_sousnavhtml_89520e55ae962dc4a1c1ac2d7780b83a($Cache, $Pile, $doublons, $Numrows, $SP) .
'
					</ul>
				</li>
			');
		lang_select();
	}
	lang_select();
	$iter->free();
	}
	if (defined("_BOUCLE_PROFILER")
	AND 1000*($timer = (time()+(float)microtime())-$timer) > _BOUCLE_PROFILER)
		spip_log(intval(1000*$timer)."ms BOUCLE_nav @ squelettes/inclure/inc_entete.html","profiler"._LOG_AVERTISSEMENT);
	return $t0;
}

//
// Fonction principale du squelette squelettes/inclure/inc_entete.html
// Temps de compilation total: 10.205 ms
//

function html_89520e55ae962dc4a1c1ac2d7780b83a($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'


<header class="header">

	<a href="spip.php">
		<div class="header__banniere">' .

((!is_array($l = quete_logo('id_syndic', 'ON', "'0'",'', 0))) ? '':
 ("<img class=\"spip_logo spip_logos\" alt=\"\" src=\"$l[0]\"" . $l[2] .  ($l[1] ? " onmouseover=\"this.src='$l[1]'\" onmouseout=\"this.src='$l[0]'\"" : "") . ' />')) .
'</div>
	</a>

	' .
(($t1 = BOUCLE_navhtml_89520e55ae962dc4a1c1ac2d7780b83a($Cache, $Pile, $doublons, $Numrows, $SP))!=='' ?
		('
	<nav class="menu">
		<input class="menu__bouton-mobile-declencheur" type="checkbox" />
		<div class="menu__bouton-mobile">
			<div class="menu__bouton-mobile-ligne"></div>
			<div class="menu__bouton-mobile-ligne"></div>
			<div class="menu__bouton-mobile-ligne"></div>
		</div>
		<input class="menu__bouton-neutre" type="radio" name="optionmenu" checked/>
		<ul class="menu__liste">
			' . $t1 . '
			<li class="menu__rubrique menu__rubrique--agenda">
				<a class="menu__rubrique--lien-remplacement" href="#"></a>
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<span class="menu__rubrique-texte">Agenda</span>
				<ul class="menu__liste-sous-liste">
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Evènement 1</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/AFDM_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Evènement 2</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/motomag_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Evènement 3</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/ffmcloisirs_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Evènement 4</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/mutuelle_bg.jpg"
								width="100%" />
					</li>
				</ul>
			</li>
			<li class="menu__rubrique menu__rubrique--contact">
				<a class="menu__rubrique--lien-remplacement" href="#"></a>
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<span class="menu__rubrique-texte">Contact</span>
				<ul class="menu__liste-sous-liste menu__liste-sous-liste--grand">
					<li class="menu__sous-rubrique">Formulaire intégré</li>
				</ul>
			</li>
			<li class="menu__rubrique menu__rubrique--recherche">
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<svg class="menu__rubrique-icone" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" width="100%" height="100%">
					<g><path d="M51.6,96.7c11,0,21-3.9,28.8-10.5l35,35c0.8,0.8,1.8,1.2,2.9,1.2s2.1-0.4,2.9-1.2c1.6-1.6,1.6-4.2,0-5.8l-35-35   c6.5-7.8,10.5-17.9,10.5-28.8c0-24.9-20.2-45.1-45.1-45.1C26.8,6.5,6.5,26.8,6.5,51.6C6.5,76.5,26.8,96.7,51.6,96.7z M51.6,14.7   c20.4,0,36.9,16.6,36.9,36.9C88.5,72,72,88.5,51.6,88.5c-20.4,0-36.9-16.6-36.9-36.9C14.7,31.3,31.3,14.7,51.6,14.7z"/></g></svg>
				<ul class="menu__liste-sous-liste menu__liste-sous-liste--petit">
					<li class="menu__sous-rubrique menu__sous-rubrique--petit">
						<input class="menu__barre-recherche" type="text" placeholder="Que cherchez-vous ?" />
					</li>
				</ul>
			</li>
			<!--<li class="menu__rubrique">
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<span class="menu__rubrique-texte">Actions</span>
				<ul class="menu__liste-sous-liste">

						<li class="menu__sous-rubrique">
							<span class="menu__sous-rubrique-texte">Lien A</span>
							<img class="menu__sous-rubrique-illustration"
									src="../images/partenaires/AFDM_bg.jpg"
									width="100%" />
						</li>
						<li class="menu__sous-rubrique">
							<span class="menu__sous-rubrique-texte">Lien A</span>
							<img class="menu__sous-rubrique-illustration"
									src="../images/partenaires/motomag_bg.jpg"
									width="100%" />
						</li>
						<li class="menu__sous-rubrique">
							<span class="menu__sous-rubrique-texte">Lien A</span>
							<img class="menu__sous-rubrique-illustration"
									src="../images/partenaires/ffmcloisirs_bg.jpg"
									width="100%" />
						</li>
						<li class="menu__sous-rubrique">
							<span class="menu__sous-rubrique-texte">Lien A</span>
							<img class="menu__sous-rubrique-illustration"
									src="../images/partenaires/mutuelle_bg.jpg"
									width="100%" />
						</li>
				</ul>
			</li>
			<li class="menu__rubrique">
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<span class="menu__rubrique-texte">La FFMC Savoie - 73</span>
				<ul class="menu__liste-sous-liste">
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Lien B</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/AFDM_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Lien B</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/motomag_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Lien B</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/ffmcloisirs_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Lien B</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/mutuelle_bg.jpg"
								width="100%" />
					</li>
				</ul>
			</li>
			<li class="menu__rubrique">
				<input class="menu__rubrique-bouton" type="radio" name="optionmenu" />
				<span class="menu__rubrique-texte">Partenaires</span>
				<ul class="menu__liste-sous-liste">
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">AFDM</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/AFDM_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Motomag</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/motomag_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">FFMC Loisirs</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/ffmcloisirs_bg.jpg"
								width="100%" />
					</li>
					<li class="menu__sous-rubrique">
						<span class="menu__sous-rubrique-texte">Mutuelle de motards</span>
						<img class="menu__sous-rubrique-illustration"
								src="../images/partenaires/mutuelle_bg.jpg"
								width="100%" />
					</li>
				</ul>
			</li>-->
		</ul>
	</nav>
	') :
		'') .
'

</header>

' .
interdire_scripts(@$Pile[0]['spip_cron']) .
'
');

	return analyse_resultat_skel('html_89520e55ae962dc4a1c1ac2d7780b83a', $Cache, $page, 'squelettes/inclure/inc_entete.html');
}
?>