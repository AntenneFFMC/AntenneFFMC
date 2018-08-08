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

if (!defined("_ECRIRE_INC_VERSION")) {
	return;
}

//
// <BOUCLE(FORUMS)>
//
// https://code.spip.net/@boucle_FORUMS_dist
function boucle_FORUMS_dist($id_boucle, &$boucles) {
	$boucle = &$boucles[$id_boucle];
	$id_table = $boucle->id_table;

	// Par defaut, selectionner uniquement les forums sans mere
	// Les criteres {tout} et {plat} inversent ce choix
	// de meme qu'un critere sur {id_forum} ou {id_parent}
	if (!isset($boucle->modificateur['tout'])
		and !isset($boucle->modificateur['plat'])
		and !isset($boucle->modificateur['criteres']['id_forum'])
		and !isset($boucle->modificateur['criteres']['id_parent'])
	) {
		array_unshift($boucle->where, array("'='", "'$id_table." . "id_parent'", 0));
	}

	return calculer_boucle($id_boucle, $boucles);
}

// {meme_parent}
// https://www.spip.net/@meme_parent
// https://code.spip.net/@critere_meme_parent_dist
function critere_FORUMS_meme_parent_dist($idb, &$boucles, $crit) {
	global $exceptions_des_tables;
	$boucle = &$boucles[$idb];
	$arg = kwote(calculer_argument_precedent($idb, 'id_parent', $boucles));
	$id_parent = isset($exceptions_des_tables[$boucle->id_table]['id_parent']) ?
		$exceptions_des_tables[$boucle->id_table]['id_parent'] :
		'id_parent';
	$mparent = $boucle->id_table . '.' . $id_parent;

	$boucle->where[] = array("'='", "'$mparent'", $arg);
	$boucle->where[] = array("'>'", "'$mparent'", 0);
	$boucle->modificateur['plat'] = true;
}


/**
 * Compile le critère `{compter_reponses}`
 *
 * Ce critère compte le nombre de messages en réponse à un message donné.
 * Il stocke l’information dans le champ `nombre_reponses`.
 * On peut le récupérer en squelette avec `#FORUM_NOMBRE_REPONSES`
 *
 * Le calcul se fait par une jointure LEFT :
 * les éléments avec aucune réponse sont retournés.
 *
 * On peut passer un opérateur optionnel tel que :
 * `{compter_reponses nombre_reponses = 0}`
 * Ce qui fera un test sur le résultat du calcul (HAVING).
 *
 * @example
 *     ```
 *     <BOUCLE_(FORUMS){!par date_thread}{compter_reponses}> #FORUM_NOMBRE_REPONSES ...
 *     <BOUCLE_(FORUMS){compter_reponses}{!par nombre_reponse}> les plus commentés ...
 *     <BOUCLE_(FORUMS){!par date_thread}{compter_reponses nombre_reponse = 0}> sans réponse ...
 *     <BOUCLE_(FORUMS){!par date_thread}{compter_reponses nombre_reponse > 10}> + de 10 réponses ...
 *     ```
 *
 * @param string $idb Identifiant de la boucle
 * @param array $boucles AST du squelette
 * @param Critere $crit Paramètres du critère dans cette boucle
 * @return void
 */
function critere_FORUMS_compter_reponses($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];

	$id_parent = isset($GLOBALS['exceptions_des_tables'][$boucle->id_table]['id_parent']) ?
		$GLOBALS['exceptions_des_tables'][$boucle->id_table]['id_parent'] :
		'id_parent';

	$id_table = $boucle->id_table;

	$boucle->from['fils'] = 'spip_forum';
	$boucle->from_type['fils'] = 'left';
	$boucle->join["fils"] = array("'$id_table'", "'$id_parent'", "'id_forum'", "'fils.statut='.sql_quote('publie')");

	$boucle->select[]= 'COUNT(fils.id_forum) AS nombre_reponses';

	// Gestion du having
	if (count($crit->param)) {
		$champ = $crit->param[0][0]->texte;
		if (preg_match(',^(\w+)\s*([<>=])\s*([0-9]+)$,', $champ, $r)) {
			$champ = $r[1];
			$op = $r[2];
			$op_val = $r[3];
			$boucle->having[]= array("'".$op."'", "'" . $champ . "'", $op_val);
		}
	}
}

/**
 * Retourne le nombre de vote sur un objet de SPIP.
 *
 * Nécessite le critere `{compter_reponses}` sur la boucle FORUMS
 *
 * `<BOUCLE_(FORUMS){compter_reponses}>#FORUM_NOMBRE_REPONSES ...`
 *
 * @param Champ $p
 * @return Champ
 */
function balise_FORUM_NOMBRE_REPONSES_dist($p) {
	return rindex_pile($p, 'nombre_reponses', 'compter_reponses');
}



/**
 * Faute de copie du champ id_secteur dans la table des forums,
 * faut le retrouver par jointure
 * Pour chaque Row il faudrait tester si le forum est
 * d'article, de breve, de rubrique, ou de syndication.
 * Pour le moment on ne traite que les articles,
 * les 3 autres cas ne marcheront donc pas: ca ferait 4 jointures
 * qu'il faut traiter optimalement ou alors pas du tout.
 *
 * @param string $idb
 * @param object $boucles
 * @param  $val
 * @param  $crit
 * @return mixed|string
 */
function public_critere_secteur_forums_dist($idb, &$boucles, $val, $crit) {
	return calculer_critere_externe_init($boucles[$idb], array('spip_articles'), 'id_secteur', $boucles[$idb]->show,
		$crit->cond, true);
}


//
// Parametres de reponse a un forum
//
// Cette balise peut etre executee en dehors de toute boucle,
// par exemple en tete de inc-forums.html ; impossible donc de
// savoir a quel objet elle va s'appliquer, ca dependra du contexte
//
// https://code.spip.net/@balise_PARAMETRES_FORUM_dist
function balise_PARAMETRES_FORUM_dist($p) {

	// s'il y a un id_article dans le contexte, regarder le statut
	// accepter_forum de cet article
	$_id_article = champ_sql('id_article', $p);
	$p->code = '
		// refus des forums ?
		(quete_accepter_forum(' . $_id_article . ')=="non" OR
		($GLOBALS["meta"]["forums_publics"] == "non"
		AND quete_accepter_forum(' . $_id_article . ') == ""))
		? "" : // sinon:
		';

	// pas de calculs superflus si le site est monolingue
	$lang = strpos($GLOBALS['meta']['langues_utilisees'], ',');

	// si on est dans une boucle de forums, c'est une reponse
	if ($p->type_requete == 'forums') {
		$_id_reponse = champ_sql('id_forum', $p);
	} else {
		$_id_reponse = "null";
	}

	// objet et id_objet principaux sont a determiner
	// dans le contexte ; on demande en tout etat de cause
	// a la boucle mere de reserver son id_primary
	if ($p->id_boucle
		and isset($p->boucles[$p->id_boucle])
		and $primary = $p->boucles[$p->id_boucle]->primary
	) {
		$_type = _q($p->boucles[$p->id_boucle]->type_requete);
		$_primary = champ_sql($primary, $p);
	} else {
		$_type = "null";
		$_primary = "null";
	}

	// le code de base des parametres
	$c = 'calcul_parametres_forum($Pile[0],'
		. $_id_reponse . ',' . $_type . ',' . $_primary . ')';

	// ajouter la lang, eventuellement donnee par le contexte
	if ($lang) {
		$_lang = champ_sql('lang', $p);
		$c = "lang_parametres_forum($c,$_lang)";
	}

	// Syntaxe [(#PARAMETRES_FORUM{#SELF})] pour fixer le retour du forum
	# note : ce bloc qui sert a recuperer des arguments calcules pourrait
	# porter un nom et faire partie de l'API.
	$retour = interprete_argument_balise(1, $p);
	if ($retour === null) {
		$retour = "''";
	}

	// Attention un eventuel &retour=xxx dans l'URL est prioritaire
	$c .= '.
	(($lien = (_request("retour") ? _request("retour") : str_replace("&amp;", "&", ' . $retour . '))) ? "&retour=".rawurlencode($lien) : "")';

	$c = '(' . $c . ')';
	// Ajouter le code d'invalideur specifique a cette balise
	include_spip('inc/invalideur');
	if ($i = charger_fonction('code_invalideur_forums', '', true)) {
		$p->code .= $i($p, $c);
	} else {
		$p->code .= $c;
	}

	$p->interdire_scripts = false;

	return $p;
}

// Cette fonction est appellee avec le contexte + trois parametres optionnels :
// 1. $reponse = l'id_forum auquel on repond
// 2. $type = le type de boucle dans lequel on se trouve, le cas echeant
// 3. $primary = l'id_objet de la boucle dans laquelle on se trouve
// elle doit renvoyer '', 'id_article=5' ou 'id_article=5&id_forum=12'
// selon les cas
function calcul_parametres_forum(&$env, $reponse, $type, $primary) {

	// si c'est une reponse, on peut esperer que (objet,id_objet) sont dans
	// la boucle mere, mais il est possible que non (forums imbriques etc)
	// dans ce cas on va chercher dans la base.
	if ($id_parent = intval($reponse)) {
		if ($type
			and $type != 'forums'
			and $primary
		) {
			$forum = array('objet' => $type, 'id_objet' => $primary);
		} else {
			$forum = sql_fetsel('objet, id_objet', 'spip_forum', 'id_forum=' . $id_parent);
		}

		if ($forum) {
			return id_table_objet($forum['objet']) . '=' . $forum['id_objet']
			. '&id_forum=' . $id_parent;
		} else {
			return '';
		}
	}

	// Ce n'est pas une reponse, on prend la boucle mere
	if ($type and $primary) {
		return id_table_objet($type) . '=' . intval($primary);
	}

	// dernier recours, on regarde pour chacun des objets forumables
	// ce que nous propose le contexte #ENV
	foreach ($env as $k => $v) {
		if (preg_match(',^id_([a-z_]+)$,S', $k)
			and $id = intval($v)
		) {
			return id_table_objet($k) . '=' . $v;
		}
	}

	return '';
}

# retourne le champ 'accepter_forum' d'un article
function quete_accepter_forum($id_article) {
	// si la fonction est appelee en dehors d'une boucle
	// article (forum de breves), $id_article est nul
	// mais il faut neanmoins accepter l'affichage du forum
	// d'ou le 0=>'' (et pas 0=>'non').
	static $cache = array(0 => '');

	$id_article = intval($id_article);

	if (isset($cache[$id_article])) {
		return $cache[$id_article];
	}

	return $cache[$id_article] = sql_getfetsel('accepter_forum', 'spip_articles', "id_article=$id_article");
}

// Ajouter "&lang=..." si la langue du forum n'est pas celle du site.
// Si le 2e parametre n'est pas une chaine, c'est qu'on n'a pas pu
// determiner la table a la compil, on le fait maintenant.
// Il faudrait encore completer: on ne connait pas la langue
// pour une boucle forum sans id_article ou id_rubrique donne par le contexte
// et c'est signale par un message d'erreur abscons: "table inconnue forum".
//
// https://code.spip.net/@lang_parametres_forum
function lang_parametres_forum($qs, $lang) {
	if (is_array($lang) and preg_match(',id_([a-z_]+)=([0-9]+),', $qs, $r)) {
		$id = 'id_' . $r[1];
		if ($t = $lang[$id]) {
			$lang = sql_getfetsel('lang', $t, "$id=" . $r[2]);
		}
	}
	// Si ce n'est pas la meme que celle du site, l'ajouter aux parametres

	if ($lang and $lang <> $GLOBALS['meta']['langue_site']) {
		return $qs . "&lang=" . $lang;
	}

	return $qs;
}

// Pour que le compilo ajoute un invalideur a la balise #PARAMETRES_FORUM
// Noter l'invalideur de la page contenant ces parametres,
// en cas de premier post sur le forum
// https://code.spip.net/@code_invalideur_forums
function code_invalideur_forums_dist($p, $code) {
	return $code;
}
