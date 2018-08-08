<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2016                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
} // securiser

# donner un exemple d'url pour le formulaire de choix
define('URLS_ARBO_EXEMPLE', '/article/titre');
# specifier le form de config utilise pour ces urls
define('URLS_ARBO_CONFIG', 'arbo');

// TODO: une interface permettant de verifier qu'on veut effectivment modifier
// une adresse existante
defined('CONFIRMER_MODIFIER_URL') || define('CONFIRMER_MODIFIER_URL', false);

/**
 * - Comment utiliser ce jeu d'URLs ?
 * Recopiez le fichier "htaccess.txt" du repertoire de base du site SPIP sous
 * le sous le nom ".htaccess" (attention a ne pas ecraser d'autres reglages
 * que vous pourriez avoir mis dans ce fichier) ; si votre site est en
 * "sous-repertoire", vous devrez aussi editer la ligne "RewriteBase" ce fichier.
 * Les URLs definies seront alors redirigees vers les fichiers de SPIP.
 *
 * Choisissez "arbo" dans les pages de configuration d'URL
 *
 * SPIP calculera alors ses liens sous la forme "Mon-titre-d-article".
 * Variantes :
 *
 * Terminaison :
 * les terminaisons ne *sont pas* stockees en base, elles servent juste
 * a rendre les url jolies ou conformes a un usage
 * pour avoir des url terminant par html
 * define ('_terminaison_urls_arbo', '.html');
 *
 * pour preciser des terminaisons particulieres pour certains types
 * $GLOBALS['url_arbo_terminaisons']=array(
 * 'rubrique' => '/',
 * 'mot' => '',
 * 'groupe' => '/',
 * 'defaut' => '.html');
 *
 * pour avoir des url numeriques (id) du type 12/5/4/article/23
 * define ('_URLS_ARBO_MIN',255);
 *
 *
 * pour conserver la casse des titres dans les url
 * define ('_url_arbo_minuscules',0);
 *
 * pour choisir le caractere de separation titre-id en cas de doublon
 * (ne pas utiliser '/')
 * define ('_url_arbo_sep_id','-');
 *
 * pour modifier la hierarchie apparente dans la constitution des urls
 * ex pour que les mots soient classes par groupes
 * $GLOBALS['url_arbo_parents']=array(
 *        'article'=>array('id_rubrique','rubrique'),
 *        'rubrique'=>array('id_parent','rubrique'),
 *        'breve'=>array('id_rubrique','rubrique'),
 *        'site'=>array('id_rubrique','rubrique'),
 *        'mot'=>array('id_groupe','groupes_mot'));
 *
 * pour personaliser les types
 * $GLOBALS['url_arbo_types']=array(
 * 'rubrique'=>'', // pas de type pour les rubriques
 * 'article'=>'a',
 * 'mot'=>'tags'
 * );
 *
 */

include_spip('inc/xcache');
if (!function_exists('Cache')) {
	function Cache() {
		return null;
	}
}

$config_urls_arbo = isset($GLOBALS['meta']['urls_arbo']) ? unserialize($GLOBALS['meta']['urls_arbo']) : array();
if (!defined('_debut_urls_arbo')) {
	define('_debut_urls_arbo', '');
}
if (!defined('_terminaison_urls_arbo')) {
	define('_terminaison_urls_arbo', '');
}
// pour choisir le caractere de separation titre-id en cas de doublon
// (ne pas utiliser '/')
if (!defined('_url_arbo_sep_id')) {
	define('_url_arbo_sep_id', isset($config_urls_arbo['url_arbo_sep_id']) ? $config_urls_arbo['url_arbo_sep_id'] : '-');
}
// option pour tout passer en minuscules
if (!defined('_url_arbo_minuscules')) {
	define('_url_arbo_minuscules', isset($config_urls_arbo['url_arbo_minuscules']) ? $config_urls_arbo['url_arbo_minuscules'] : 1);
}
if (!defined('_URLS_ARBO_MAX')) {
	define('_URLS_ARBO_MAX', isset($config_urls_arbo['URLS_ARBO_MAX']) ? $config_urls_arbo['URLS_ARBO_MAX'] : 80);
}
if (!defined('_URLS_ARBO_MIN')) {
	define('_URLS_ARBO_MIN', isset($config_urls_arbo['URLS_ARBO_MIN']) ? $config_urls_arbo['URLS_ARBO_MIN'] : 3);
}

if (!defined('_url_sep_id')) {
	define('_url_sep_id', _url_arbo_sep_id);
}

// peut prendre plusieurs valeurs :
// - false pour ne pas gerer le multilinguisme => fonctionnement historique
//    define('_url_arbo_multilang',false);
// - la valeur d'une langue pour forcer le calcul des URLs dans une langue donnee
//    define('_url_arbo_multilang','en');
// - true pour forcer la gestion complete du multilinguisme :
//   calcul des URLs dans toutes les langues possibles,
//   ajout d'un premier segment fr/ dans les URLs pour definir la langue
//   prise en compte de l'argument lang=xx dans $args au moment de generer l'URL
//    define('_url_arbo_multilang',true);

if (!defined('_url_arbo_multilang')) {
	define('_url_arbo_multilang',false);
}


// Ces chaines servaient de marqueurs a l'epoque ou les URL propres devaient
// indiquer la table ou les chercher (articles, auteurs etc),
// et elles etaient retirees par les preg_match dans la fonction ci-dessous.
// Elles sont a present definies a "" pour avoir des URL plus jolies
// mais les preg_match restent necessaires pour gerer les anciens signets.

#define('_MARQUEUR_URL', serialize(array('rubrique1' => '-', 'rubrique2' => '-', 'breve1' => '+', 'breve2' => '+', 'site1' => '@', 'site2' => '@', 'auteur1' => '_', 'auteur2' => '_', 'mot1' => '+-', 'mot2' => '-+')));
if (!defined('_MARQUEUR_URL')) {
	define('_MARQUEUR_URL', false);
}

/**
 * Definir les parentees utilisees pour construire des urls arborescentes
 *
 * @param string $type
 * @return string
 */
function url_arbo_parent($type) {
	static $parents = null;
	if (is_null($parents)) {
		$parents = array(
			'article' => array('id_rubrique', 'rubrique'),
			'rubrique' => array('id_parent', 'rubrique'),
			'breve' => array('id_rubrique', 'rubrique'),
			'site' => array('id_rubrique', 'rubrique')
		);
		if (isset($GLOBALS['url_arbo_parents']) and !isset($_REQUEST['url_arbo_parents'])) {
			$parents = array_merge($parents, $GLOBALS['url_arbo_parents']);
		}
	}

	return (isset($parents[$type]) ? $parents[$type] : '');
}

/**
 * Definir les terminaisons des urls :
 * / pour une rubrique
 * .html pour une page etc..
 *
 * @param string $type
 * @return string
 */
function url_arbo_terminaison($type) {
	static $terminaison_types = null;
	if ($terminaison_types == null) {
		$terminaison_types = array(
			'rubrique' => '/',
			'mot' => '',
			'defaut' => defined('_terminaison_urls_arbo') ? _terminaison_urls_arbo : '.html'
		);
		if (isset($GLOBALS['url_arbo_terminaisons'])) {
			$terminaison_types = array_merge($terminaison_types, $GLOBALS['url_arbo_terminaisons']);
		}
	}
	// si c'est un appel avec type='' c'est pour avoir la liste des terminaisons
	if (!$type) {
		return array_unique(array_values($terminaison_types));
	}
	if (isset($terminaison_types[$type])) {
		return $terminaison_types[$type];
	} elseif (isset($terminaison_types['defaut'])) {
		return $terminaison_types['defaut'];
	}

	return '';
}

/**
 * Definir le prefixe qui designe le type et qu'on utilise pour chaque objet
 * ex : "article"/truc
 * par defaut les rubriques ne sont pas typees, mais le reste oui
 *
 * @param string $type
 * @return array|string
 */
function url_arbo_type($type) {
	static $synonymes_types = null;
	if (!$synonymes_types) {
		$synonymes_types = array('rubrique' => '');
		if (isset($GLOBALS['url_arbo_types']) and is_array($GLOBALS['url_arbo_types'])) {
			$synonymes_types = array_merge($synonymes_types, $GLOBALS['url_arbo_types']);
		}
	}
	// si c'est un appel avec type='' c'est pour avoir la liste inversee des synonymes
	if (!$type) {
		return array_flip($synonymes_types);
	}

	return
		($t = (isset($synonymes_types[$type]) ? $synonymes_types[$type] : $type))  // le type ou son synonyme
		. ($t ? '/' : ''); // le / eventuel pour separer, si le synonyme n'est pas vide
}

/**
 * Pipeline pour creation d'une adresse : il recoit l'url propose par le
 * precedent, un tableau indiquant le titre de l'objet, son type, son id,
 * et doit donner en retour une chaine d'url, sans se soucier de la
 * duplication eventuelle, qui sera geree apres
 * https://code.spip.net/@creer_chaine_url
 *
 * @param array $x
 * @return array
 */
function urls_arbo_creer_chaine_url($x) {
	// NB: ici url_old ne sert pas, mais un plugin qui ajouterait une date
	// pourrait l'utiliser pour juste ajouter la
	$url_old = $x['data'];
	$objet = $x['objet'];
	include_spip('inc/filtres');

	include_spip('action/editer_url');
	if (!$url = url_nettoyer(
		$objet['titre'],
		_URLS_ARBO_MAX,
		_URLS_ARBO_MIN,
		'-',
		_url_arbo_minuscules ? 'spip_strtolower' : ''
	)) {
		$url = $objet['id_objet'];
	}

	// le type ou son synonyme
	$prefixe = url_arbo_type($objet['type']);
	if (strpos($prefixe, '<') !== false) {
		$prefixe = extraire_multi($prefixe);
		$prefixe = textebrut($prefixe);
	}
	$x['data'] = $prefixe . $url; // le titre

	return $x;
}

/**
 * Boucler sur le parent pour construire l'url complete a partir des segments
 * https://code.spip.net/@declarer_url_arbo_rec
 *
 * @param string $url
 * @param string $type
 * @param string $parent
 * @param string $type_parent
 * @param array $contexte
 * @return string
 */
function declarer_url_arbo_rec($url, $type, $parent, $type_parent, $contexte = array()) {
	if (is_null($parent)) {
		return $url;
	}
	// le contexte parent ne se transmet pas
	if (isset($contexte['id_parent'])) {
		unset($contexte['id_parent']);
	}
	// Si pas de parent ou si son URL est vide, on ne renvoit que l'URL de l'objet en court
	if ($parent == 0 or !($url_parent = declarer_url_arbo($type_parent ? $type_parent : 'rubrique', $parent, $contexte))) {
		return rtrim($url, '/');
	} // Sinon on renvoit l'URL de l'objet concaténée avec celle du parent
	else {
		return rtrim($url_parent, '/') . '/' . rtrim($url, '/');
	}
}

/**
 * Renseigner les infos les plus recentes de l'url d'un objet
 * et de quoi la (re)construire si besoin
 *
 * @param string $type
 * @param int $id_objet
 * @param array $contexte
 *   id_parent : rubrique parent
 * @return bool|null|array
 */
function renseigner_url_arbo($type, $id_objet, $contexte = array()) {
	$urls = array();
	$trouver_table = charger_fonction('trouver_table', 'base');
	$desc = $trouver_table(table_objet($type));
	$table = $desc['table'];
	$col_id = @$desc['key']['PRIMARY KEY'];
	if (!$col_id) {
		return false;
	} // Quand $type ne reference pas une table
	$id_objet = intval($id_objet);

	$id_parent = (isset($contexte['id_parent'])?$contexte['id_parent']:null);
	$langue = (isset($contexte['langue'])?$contexte['langue']:'');

	$champ_titre = $desc['titre'] ? $desc['titre'] : 'titre';

	// parent
	$champ_parent = url_arbo_parent($type);
	$sel_parent = ', 0 as parent';
	$order_by_parent = '';
	if ($champ_parent) {
		// si un parent est fourni est qu'il est legitime, on recherche une URL pour ce parent
		if ($id_parent
			and $type_parent = end($champ_parent)
			and $url_verifier_parent_objet = charger_fonction('url_verifier_parent_objet', 'inc', true)
			and $url_verifier_parent_objet($type, $id_objet, $type_parent, $id_parent)) {
			$sel_parent = ', '.intval($id_parent) . ' as parent';
			// trouver l'url qui matche le parent en premier
			$order_by_parent = 'U.id_parent='.intval($id_parent).' DESC, ';
		} else {
			// sinon on prend son parent direct fourni par $champ_parent
			$sel_parent = ', O.' . reset($champ_parent) . ' as parent';
			// trouver l'url qui matche le parent en premier
			$order_by_parent = 'O.' . reset($champ_parent) . '=U.id_parent DESC, ';
		}
	}
	$order_by_langue = "U.langue='' DESC, ";
	if ($langue) {
		$order_by_langue = 'U.langue='.sql_quote($langue).' DESC, ' . $order_by_langue;
	}

	//  Recuperer une URL propre correspondant a l'objet.
	$row = sql_fetsel(
		"U.url, U.date, U.id_parent, U.perma, U.langue, $champ_titre $sel_parent",
		"$table AS O LEFT JOIN spip_urls AS U ON (U.type='$type' AND U.id_objet=O.$col_id)",
		"O.$col_id=$id_objet",
		'',
		$order_by_parent . 'U.perma DESC, ' . $order_by_langue . 'U.date DESC',
		1
	);
	if ($row) {
		$urls[$type][$id_objet] = $row;
		$urls[$type][$id_objet]['type_parent'] = $champ_parent ? end($champ_parent) : '';
	}

	return isset($urls[$type][$id_objet]) ? $urls[$type][$id_objet] : null;
}

/**
 * Retrouver/Calculer l'ensemble des segments d'url d'un objet
 *
 * https://code.spip.net/@declarer_url_arbo
 *
 * @param string $type
 * @param int $id_objet
 * @param array $contexte
 *   id_parent : rubrique parent
 *   langue : langue courante pour laquelle on veut l'URL
 * @return string
 */
function declarer_url_arbo($type, $id_objet, $contexte = array()) {
	static $urls = array();
	// utiliser un cache memoire pour aller plus vite
	if (!is_null($C = Cache())) {
		return $C;
	}
	// contexte de langue si pas defini, en fonction de la configuration
	if (!isset($contexte['langue'])) {
		if (!_url_arbo_multilang) {
			$contexte['langue'] = '';
		} elseif (_url_arbo_multilang === true) {
			$contexte['langue'] = $GLOBALS['spip_lang'];
		} else {
			$contexte['langue'] = _url_arbo_multilang;
		}
	}
	ksort($contexte);
	$hash = json_encode($contexte);

	// Se contenter de cette URL si elle existe ;
	// sauf si on invoque par "voir en ligne" avec droit de modifier l'url

	// l'autorisation est verifiee apres avoir calcule la nouvelle url propre
	// car si elle ne change pas, cela ne sert a rien de verifier les autorisations
	// qui requetent en base
	$modifier_url = (defined('_VAR_URLS') and _VAR_URLS);

	if (!isset($urls[$type][$id_objet][$hash]) or $modifier_url) {
		$r = renseigner_url_arbo($type, $id_objet, $contexte);
		// Quand $type ne reference pas une table
		if ($r === false) {
			return false;
		}

		if (!is_null($r)) {
			$urls[$type][$id_objet][$hash] = $r;
		}
	}

	if (!isset($urls[$type][$id_objet][$hash])) {
		return '';
	} # objet inexistant

	$u = &$urls[$type][$id_objet][$hash];
	$url_propre = $u['url'];

	// si on a trouve l'url
	// et que le parent est bon
	// et (permanente ou pas de demande de modif)
	if (!is_null($url_propre)
		and $u['id_parent'] == $u['parent']
		and ($u['perma'] or !$modifier_url)
	) {
		return declarer_url_arbo_rec(
			$url_propre,
			$type,
			isset($u['parent']) ? $u['parent'] : 0,
			isset($u['type_parent']) ? $u['type_parent'] : null,
			$contexte
		);
	}

	// Si URL inconnue ou maj forcee sur une url non permanente, recreer une url
	$url = $url_propre;
	$urls_langues = array();
	if (is_null($url_propre) or ($modifier_url and !$u['perma'])) {
		$langues = array();
		if (_url_arbo_multilang === true) {
			include_spip('inc/lang');
			$langues = (isset($GLOBALS['meta']['langues_multilingue']) ? $GLOBALS['meta']['langues_multilingue'] : '');
			$langues = explode(',', $langues);
			if ($k = array_search(_LANGUE_PAR_DEFAUT, $langues)) {
				unset($langues[$k]);
				array_unshift($langues, _LANGUE_PAR_DEFAUT);
			}
		}
		if (!in_array($contexte['langue'], $langues)) {
			$langues[] = $contexte['langue'];
		}

		// on calcule l'URL de chaque langue utile (langue courante, langue forcee ou toutes les langues utilises)
		$langue_courante = $GLOBALS['spip_lang'];

		include_spip('inc/urls');
		$objets = urls_liste_objets();

		foreach ($langues as $l) {
			if ($l) {
				changer_langue($l);
			}
			$urls_langues[$l] = pipeline(
				'arbo_creer_chaine_url',
				array(
					'data' => $url_propre,  // le vieux url_propre
					'objet' => array_merge($u, array('type' => $type, 'id_objet' => $id_objet))
				)
			);

			// Eviter de tamponner les URLs a l'ancienne (cas d'un article
			// intitule "auteur2")
			if (preg_match(',^(' . $objets . ')[0-9]*$,', $urls_langues[$l], $r)
				and $r[1] != $type
			) {
				$urls_langues[$l] = $urls_langues[$l] . _url_arbo_sep_id . $id_objet;
			}
		}
		// retablir la $langue_courante par securite, au cas ou on a change de langue
		changer_langue($langue_courante);

		$url = $urls_langues[$contexte['langue']];
	}


	// Pas de changement d'url ni de parent
	if ($url == $url_propre
		and $u['id_parent'] == $u['parent']
	) {
		return declarer_url_arbo_rec($url_propre, $type, $u['parent'], $u['type_parent'], $contexte);
	}

	// verifier l'autorisation, maintenant qu'on est sur qu'on va agir
	if ($modifier_url) {
		include_spip('inc/autoriser');
		$modifier_url = autoriser('modifierurl', $type, $id_objet);
	}
	// Verifier si l'utilisateur veut effectivement changer l'URL
	if ($modifier_url
		and CONFIRMER_MODIFIER_URL
		and $url_propre
		// on essaye pas de regenerer une url en -xxx (suffixe id anti collision)
		and $url != preg_replace('/' . preg_quote(_url_propres_sep_id, '/') . '.*/', '', $url_propre)
	) {
		$confirmer = true;
	} else {
		$confirmer = false;
	}

	if ($confirmer and !_request('ok')) {
		die("vous changez d'url ? $url_propre -&gt; $url");
	}

	// on enregistre toutes les langues
	include_spip('action/editer_url');
	foreach ($urls_langues as $langue => $url) {
		$set = array(
			'url' => $url,
			'type' => $type,
			'id_objet' => $id_objet,
			'id_parent' => $u['parent'],
			'langue' => $langue,
			'perma' => intval($u['perma'])
		);
		$res = url_insert($set, $confirmer, _url_arbo_sep_id);
		if ($langue == $contexte['langue']) {
			if ($res) {
				$u['url'] = $set['url'];
				$u['id_parent'] = $set['id_parent'];
			} else {
				// l'insertion a echoue,
				//serveur out ? retourner au mieux
				$u['url'] = $url_propre;
			}
		}
	}

	return declarer_url_arbo_rec($u['url'], $type, $u['parent'], $u['type_parent'], $contexte);
}

/**
 * Generer l'url arbo complete constituee des segments + debut + fin
 *
 * https://code.spip.net/@_generer_url_arbo
 *
 * @param string $type
 * @param int $id
 * @param string $args
 * @param string $ancre
 * @return string
 */
function _generer_url_arbo($type, $id, $args = '', $ancre = '') {
	if ($generer_url_externe = charger_fonction("generer_url_$type", 'urls', true)) {
		$url = $generer_url_externe($id, $args, $ancre);
		if (null != $url) {
			return $url;
		}
	}

	$debut_langue = '';

	// Mode propre
	$c = array();

	parse_str($args, $contexte);
	// choisir le contexte de langue en fonction de la configuration
	$c['langue'] = '';
	if (_url_arbo_multilang === true) {
		if (isset($contexte['lang']) and $contexte['lang']) {
			$c['langue'] = $contexte['lang'];
			$debut_langue = $c['langue'] .'/';
			unset($contexte['lang']);
			$args = http_build_query($contexte);
		} elseif (isset($GLOBALS['spip_lang']) and $GLOBALS['spip_lang']) {
			$c['langue'] = $GLOBALS['spip_lang'];
			$debut_langue = $c['langue'] .'/';
		}
	} elseif (_url_arbo_multilang) {
		$c['langue'] = _url_arbo_multilang;
	}
	$propre = declarer_url_arbo($type, $id, $c);

	// si le parent est fourni en contexte dans le $args, verifier si l'URL relative a ce parent est la meme ou non
	$champ_parent = url_arbo_parent($type);
	if ($champ_parent
	  and $champ_parent = reset($champ_parent)
	  and isset($contexte[$champ_parent]) and $contexte[$champ_parent]) {
		$c['id_parent'] = $contexte[$champ_parent];
		$propre_contexte = declarer_url_arbo($type, $id, $c);
		// si l'URL est differente on la prend et on enleve l'argument de l'URL (redondance puisque parent defini par l'URL elle meme)
		if ($propre_contexte !== $propre) {
			$propre = $propre_contexte;
			unset($contexte[$champ_parent]);
			$args = http_build_query($contexte);
		}
	}


	if ($propre === false) {
		return '';
	} // objet inconnu. raccourci ?

	if ($propre) {
		$url = _debut_urls_arbo
			. $debut_langue
			. rtrim($propre, '/')
			. url_arbo_terminaison($type);
	} else {
		// objet connu mais sans possibilite d'URL lisible, revenir au defaut
		include_spip('base/connect_sql');
		$id_type = id_table_objet($type);
		$url = get_spip_script('./') . '?' . _SPIP_PAGE . "=$type&$id_type=$id";
	}

	// Ajouter les args
	if ($args) {
		$url .= ((strpos($url, '?') === false) ? '?' : '&') . $args;
	}

	// Ajouter l'ancre
	if ($ancre) {
		$url .= "#$ancre";
	}

	return _DIR_RACINE . $url;
}


/**
 * API : retourner l'url d'un objet si i est numerique
 * ou decoder cette url si c'est une chaine
 * array([contexte],[type],[url_redirect],[fond]) : url decodee
 *
 * https://code.spip.net/@urls_arbo_dist
 *
 * @param string|int $i
 * @param string $entite
 * @param string|array $args
 * @param string $ancre
 * @return array|string
 */
function urls_arbo_dist($i, $entite, $args = '', $ancre = '') {
	if (is_numeric($i)) {
		return _generer_url_arbo($entite, $i, $args, $ancre);
	}

	// traiter les injections du type domaine.org/spip.php/cestnimportequoi/ou/encore/plus/rubrique23
	if ($GLOBALS['profondeur_url'] > 0 and $entite == 'sommaire') {
		$entite = 'type_urls';
	}

	// recuperer les &debut_xx;
	if (is_array($args)) {
		$contexte = $args;
		$args = http_build_query($contexte);
	} else {
		parse_str($args, $contexte);
	}

	$url = $i;
	$id_objet = $type = 0;
	$url_redirect = null;

	// Migration depuis anciennes URLs ?
	// traiter les injections domain.tld/spip.php/n/importe/quoi/rubrique23
	if ($GLOBALS['profondeur_url'] <= 0
		and $_SERVER['REQUEST_METHOD'] != 'POST'
	) {
		include_spip('inc/urls');
		$r = nettoyer_url_page($i, $contexte);
		if ($r) {
			list($contexte, $type, , , $suite) = $r;
			$_id = id_table_objet($type);
			$id_objet = $contexte[$_id];
			$url_propre = generer_url_entite($id_objet, $type);
			if (strlen($url_propre)
				and !strstr($url, $url_propre)
				and (
					objet_test_si_publie($type, $id_objet)
					OR (defined('_VAR_PREVIEW') and _VAR_PREVIEW and autoriser('voir', $type, $id_objet))
				)
			) {
				list(, $hash) = array_pad(explode('#', $url_propre), 2, null);
				$args = array();
				foreach (array_filter(explode('&', $suite)) as $fragment) {
					if ($fragment != "$_id=$id_objet") {
						$args[] = $fragment;
					}
				}
				$url_redirect = generer_url_entite($id_objet, $type, join('&', array_filter($args)), $hash);

				return array($contexte, $type, $url_redirect, $type);
			}
		}
	}
	/* Fin compatibilite anciennes urls */

	// Chercher les valeurs d'environnement qui indiquent l'url-propre
	$url_propre = preg_replace(',[?].*,', '', $url);

	// Mode Query-String ?
	if (!$url_propre
		and preg_match(',[?]([^=/?&]+)(&.*)?$,', $url, $r)
	) {
		$url_propre = $r[1];
	}

	if (!$url_propre
		or $url_propre == _DIR_RESTREINT_ABS
		or $url_propre == _SPIP_SCRIPT
	) {
		return;
	} // qu'est-ce qu'il veut ???


	include_spip('base/abstract_sql'); // chercher dans la table des URLS

	// Revenir en utf-8 si encodage type %D8%A7 (farsi)
	$url_propre = rawurldecode($url_propre);

	// Compatibilite avec .htm/.html et autres terminaisons
	$t = array_diff(array_unique(array_merge(array('.html', '.htm', '/'), url_arbo_terminaison(''))), array(''));
	if (count($t)) {
		$url_propre = preg_replace('{('
			. implode('|', array_map('preg_quote', $t)) . ')$}i', '', $url_propre);
	}

	if (strlen($url_propre) and !preg_match(',^[^/]*[.]php,', $url_propre)) {
		$parents_vus = array();

		// recuperer tous les objets de larbo xxx/article/yyy/mot/zzzz
		// on parcourt les segments de gauche a droite
		// pour pouvoir contextualiser un segment par son parent
		$url_arbo = explode('/', $url_propre);
		$url_arbo_new = array();
		$dernier_parent_vu = false;
		$objet_segments = 0;

		$langue = '';
		if (_url_arbo_multilang === true) {
			// la langue : si fourni en QS prioritaire car vient du skel ou de forcer_lang
			if (isset($contexte['lang'])) {
				$langue = $contexte['lang'];
			}
			// le premier segment peut etre la langue : l'extraire
			// on le prend en compte si lang non fournie par la QS sinon on l'ignore
			include_spip('action/editer_url'); // pour url_verifier_langue
			if (count($url_arbo) > 1
				and $first = reset($url_arbo)
			  and url_verifier_langue($first)) {
				array_shift($url_arbo);
				if (!$langue) {
					$contexte['lang'] = $langue = $first;
				}
			}
		} elseif (_url_arbo_multilang) {
			$langue = _url_arbo_multilang;
		}

		while (count($url_arbo) > 0) {
			$type = null;
			if (count($url_arbo) > 1) {
				$type = array_shift($url_arbo);
			}
			$url_segment = array_shift($url_arbo);
			// Rechercher le segment de candidat
			// si on est dans un contexte de parent, donne par le segment precedent,
			// prefixer le segment recherche avec ce contexte
			$cp = '0'; // par defaut : parent racine, id=0
			if ($dernier_parent_vu) {
				$cp = $parents_vus[$dernier_parent_vu];
			}
			// d'abord recherche avec prefixe parent, en une requete car aucun risque de colision
			$row = sql_fetsel(
				'id_objet, type, url',
				'spip_urls',
				is_null($type)
					? 'url=' . sql_quote($url_segment, '', 'TEXT')
					: sql_in('url', array("$type/$url_segment", $type)),
				'',
				// en priorite celui qui a le bon parent
				// puis la bonne langue puis la langue ''
				// puis les deux segments puis 1 seul segment
				//
				// si parent indefini on privilegie id_parent=0 avec la derniere clause du order
				(intval($cp) ? 'id_parent=' . intval($cp) . ' DESC, ' : 'id_parent>=0 DESC, ')
				. ($langue?'langue='.sql_quote($langue).' DESC, ':'') ."langue='' DESC,"
				. 'segments DESC, id_parent'
			);
			if ($row) {
				if (!is_null($type) and $row['url'] == $type) {
					array_unshift($url_arbo, $url_segment);
					$url_segment = $type;
					$type = null;
				}
				$type = $row['type'];
				$col_id = id_table_objet($type);

				// le plus a droite l'emporte pour des objets presents plusieurs fois dans l'url (ie rubrique)
				$contexte[$col_id] = $row['id_objet'];

				$type_parent = '';
				if ($p = url_arbo_parent($type)) {
					$type_parent = end($p);
				}
				// l'entite la plus a droite l'emporte, si le type de son parent a ete vu
				// sinon c'est un segment contextuel supplementaire a ignorer
				// ex : rub1/article/art1/mot1 : il faut ignorer le mot1, la vrai url est celle de l'article
				if (!$entite
					or $dernier_parent_vu == $type_parent
				) {
					if ($objet_segments == 0) {
						$entite = $type;
					}
				} // sinon on change d'objet concerne
				else {
					$objet_segments++;
				}

				$url_arbo_new[$objet_segments]['id_objet'] = $row['id_objet'];
				$url_arbo_new[$objet_segments]['objet'] = $type;
				$url_arbo_new[$objet_segments]['segment'][] = $row['url'];

				// on note le dernier parent vu de chaque type
				$parents_vus[$dernier_parent_vu = $type] = $row['id_objet'];
			} else {
				// un segment est inconnu
				if ($entite == '' or $entite == 'type_urls') {
					// on genere une 404 comme il faut si on ne sait pas ou aller
					return array(array(), '404');
				}
				// ici on a bien reconnu un segment en amont, mais le segment en cours est inconnu
				// on pourrait renvoyer sur le dernier segment identifie
				// mais de fait l'url entiere est inconnu : 404 aussi
				// mais conserver le contexte qui peut contenir un fond d'ou venait peut etre $entite (reecriture urls)
				return array($contexte, '404');
			}
		}

		if (count($url_arbo_new)) {
			$caller = debug_backtrace();
			$caller = $caller[1]['function'];
			// si on est appele par un autre module d'url c'est du decodage d'une ancienne URL
			// ne pas regenerer des segments arbo, mais rediriger vers la nouvelle URL
			// dans la nouvelle forme
			if (strncmp($caller, 'urls_', 5) == 0 and $caller !== 'urls_decoder_url') {
				// en absolue, car assembler ne gere pas ce cas particulier
				include_spip('inc/filtres_mini');
				$col_id = id_table_objet($entite);
				$url_new = generer_url_entite($contexte[$col_id], $entite, $args);
				// securite contre redirection infinie
				if ($url_new !== $url_propre
					and rtrim($url_new, '/') !== rtrim($url_propre, '/')
				) {
					$url_redirect = url_absolue($url_new);
				}
			} else {
				foreach ($url_arbo_new as $k => $o) {
					$c = array( 'langue' => $langue );
					if (isset($parents_vus['rubrique'])) {
						$c['id_parent'] = $parents_vus['rubrique'];
					}
					if ($s = declarer_url_arbo($o['objet'], $o['id_objet'], $c)) {
						$url_arbo_new[$k] = $s;
					} else {
						$url_arbo_new[$k] = implode('/', $o['segment']);
					}
				}
				$url_arbo_new = ltrim(implode('/', $url_arbo_new), '/');
				if ($langue and _url_arbo_multilang === true) {
					$url_arbo_new = "$langue/" . $url_arbo_new;
					if (strpos($args, 'lang=') !== false) {
						parse_str($args, $cl);
						unset($cl['lang']);
						$args = http_build_query($cl);
					}
				}
				if ($url_arbo_new !== $url_propre) {
					//var_dump($url_arbo_new,$url_propre);
					$url_redirect = _debut_urls_arbo
						. $url_arbo_new
						. url_arbo_terminaison($entite)
						. ($args?"?$args":'');
					// en absolue, car assembler ne gere pas ce cas particulier
					include_spip('inc/filtres_mini');
					$url_redirect = url_absolue($url_redirect);
				}
			}
		}

		// gerer le retour depuis des urls propres
		if (($entite == '' or $entite == 'type_urls')
			and $GLOBALS['profondeur_url'] <= 0
		) {
			$urls_anciennes = charger_fonction('propres', 'urls');

			return $urls_anciennes($url_propre, $entite, $contexte);
		}
	}
	if ($entite == '' or $entite == 'type_urls' /* compat .htaccess 2.0 */) {
		if ($type) {
			$entite = objet_type($type);
		} else {
			// Si ca ressemble a une URL d'objet, ce n'est pas la home
			// et on provoque un 404
			if (preg_match(',^[^\.]+(\.html)?$,', $url)) {
				$entite = '404';
				$contexte['erreur'] = ''; // qu'afficher ici ?  l'url n'existe pas... on ne sait plus dire de quel type d'objet il s'agit
			}
		}
	}
	if (!defined('_SET_HTML_BASE')) {
		define('_SET_HTML_BASE', 1);
	}

	return array($contexte, $entite, $url_redirect, null);
}
