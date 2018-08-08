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

function action_editer_url_dist() {

	// Rien a faire ici pour le moment
	#$securiser_action = charger_fonction('securiser_action', 'inc');
	#$arg = $securiser_action();

}

/**
 * Verifier si une langue presumee est valide
 * - utile pour l'edition manuelle d'une URL ou pour le decodage
 * @param string $langue
 * @return bool
 */
function url_verifier_langue($langue) {
	include_spip('inc/lang');
	if (!match_langue($langue)) {
		return false;
	}

	include_spip('inc/lang_liste');
	$all_langs = array_keys($GLOBALS['codes_langues']);
	if (!in_array($langue, $all_langs)) {
		return false;
	}

	return true;
}

/**
 * Nettoyer une URL :
 * supprimer le html, le rang, extraire les multi, translitterer
 * @param string $titre
 * @param int $longueur_maxi
 * @param int $longueur_min
 * @param string $separateur
 * @param string $filtre
 * @return string
 */
function url_nettoyer($titre, $longueur_maxi, $longueur_min = 0, $separateur = '-', $filtre = '') {

	$titre = supprimer_tags(supprimer_numero(extraire_multi($titre)));
	$url = translitteration($titre);

	if ($filtre) {
		$url = $filtre($url);
	}

	// on va convertir tous les caracteres de ponctuation et espaces
	// a l'exception de l'underscore (_), car on veut le conserver dans l'url
	$url = str_replace('_', chr(7), $url);
	$url = @preg_replace(',[[:punct:][:space:]]+,u', ' ', $url);
	$url = str_replace(chr(7), '_', $url);

	// S'il reste trop de caracteres non latins, les gerer comme wikipedia
	// avec rawurlencode :
	if (preg_match_all(",[^a-zA-Z0-9 _]+,", $url, $r, PREG_SET_ORDER)) {
		foreach ($r as $regs) {
			$url = substr_replace($url, rawurlencode($regs[0]),
				strpos($url, $regs[0]), strlen($regs[0]));
		}
	}

	// S'il reste trop peu, renvoyer vide
	if (strlen($url) < $longueur_min) {
		return '';
	}

	// Sinon couper les mots et les relier par des $separateur
	$mots = preg_split(",[^a-zA-Z0-9_%]+,", $url);
	$url = '';
	foreach ($mots as $mot) {
		if (!strlen($mot)) {
			continue;
		}
		$url2 = $url . $separateur . $mot;

		// Si on depasse $longueur_maxi caracteres, s'arreter
		// ne pas compter 3 caracteres pour %E9 mais un seul
		$long = preg_replace(',%.,', '', $url2);
		if (strlen($long) > $longueur_maxi) {
			break;
		}

		$url = $url2;
	}
	$url = substr($url, 1);

	// On enregistre en utf-8 dans la base
	$url = rawurldecode($url);

	if (strlen($url) < $longueur_min) {
		return '';
	}

	return $url;
}

/**
 * Inserer une URL en base avec multiples controles et gestion des collisions
 * en essayant d'eviter des problemes de race condition
 * @param array $set
 * @param bool $confirmer
 * @param string $separateur
 * @return bool
 */
function url_insert(&$set, $confirmer, $separateur) {
	$has_parent = true;
	# assurer la coherence des champs techniques si non fournis
	if (!isset($set['id_parent'])) {
		$has_parent = false;
		$set['id_parent'] = 0;
	}
	if (!isset($set['segments'])) {
		$set['segments'] = count(explode('/', $set['url']));
	}
	if (!isset($set['langue'])) {
		$set['langue'] = '';
	}
	$perma = false;
	if (isset($set['perma']) and $set['perma']) {
		unset($set['perma']);
		$perma = true;
	}
	$redate = true;

	# le separateur ne peut pas contenir de /
	if (strpos($separateur, '/') !== false) {
		$separateur = "-";
	}

	// Si l'insertion echoue, c'est une violation d'unicite.
	$where_urllike = 'url LIKE ' . url_sql_quote_like($set['url']) . " AND NOT(type=" . sql_quote($set['type']) . " AND id_objet=" . intval($set['id_objet']) . ")";
	$where_thisurl = $where_urllike . ($has_parent ? " AND id_parent=" . intval($set['id_parent']) : "");
	if (
		// si pas de parent defini, il faut que cette url soit unique, independamment de id_parent
		// il faut utiliser un LIKE pour etre case unsensitive en sqlite
		(!$has_parent and sql_countsel("spip_urls", $where_urllike))
		or @sql_insertq('spip_urls', $set) <= 0
	) {

		// On veut chiper une ancienne adresse ou prendre celle d'un repertoire deja present?
		if (
			(!is_dir(_DIR_RACINE . $set['url']) and !file_exists(_DIR_RACINE . $set['url']))
			// un vieux url
			and $vieux = sql_fetsel('*', 'spip_urls', $where_thisurl, '', 'perma DESC')
			// qui n'est pas permanente
			and !$vieux['perma']
			// et dont l'objet a une url plus recente
			and $courant = sql_fetsel('*', 'spip_urls',
				'type=' . sql_quote($vieux['type']) . ' AND id_objet=' . sql_quote($vieux['id_objet'])
				. ' AND url<>' . sql_quote($set['url'])
				. ' AND date>' . sql_quote($vieux['date']), '', 'date DESC', 1)
		) {
			if ($confirmer and !_request('ok2')) {
				die("Vous voulez chiper l'URL de l'objet " . $courant['type'] . " "
					. $courant['id_objet'] . " qui a maintenant l'url "
					. $courant['url']);
			}
			$where_thisurl = "url=" . sql_quote($vieux['url']) . " AND id_parent=" . intval($vieux['id_parent']);
			// si oui on le chipe
			sql_updateq('spip_urls', $set, $where_thisurl);
			sql_updateq('spip_urls', array('date' => date('Y-m-d H:i:s')), $where_thisurl);
			spip_log("reattribue url " . $vieux['url']
				. " de " . $vieux['type'] . "#" . $vieux['id_objet'] . " (parent " . $vieux['id_parent'] . ")"
				. " A " . $set['type'] . "#" . $set['id_objet'] . " (parent " . $set['id_parent'] . ")",
				"urls" . _LOG_INFO_IMPORTANTE);
		} // Sinon
		else {

			// Soit c'est un Come Back d'une ancienne url propre de l'objet
			// Soit c'est un vrai conflit. Rajouter l'ID jusqu'a ce que ca passe,
			// mais se casser avant que ca ne casse.

			// il peut etre du a un changement de casse de l'url simplement
			// pour ce cas, on reecrit systematiquement l'url en plus d'actualiser la date
			$where = "type=" . sql_quote($set['type'])
				. " AND id_objet=" . intval($set['id_objet'])
				. " AND id_parent=" . intval($set['id_parent'])
				. " AND url LIKE ";
			if (
				!is_dir(_DIR_RACINE . $set['url']) and !file_exists(_DIR_RACINE . $set['url'])
				and $existing = sql_fetsel('*','spip_urls', $where . url_sql_quote_like($set['url']))
			) {
				$refresh = array(
					'url' => $set['url'],
					'date' => date('Y-m-d H:i:s'),
				);
				// si c'est une URL avec langue est qu'ici on a pas de langue, on ecrase
				if ($existing['langue']) {
					if (!$set['langue']){
						$refresh['langue'] = '';
					}
					elseif($set['langue'] !== $existing['langue']) {
						$set['url'] .= $separateur . $set['langue'];
						return url_insert_replay($set, $confirmer, $separateur, $has_parent, $perma);
					}
				}
				// sinon c'est une URL sans langue (generique)
				else {
					// si c'est pas une URL perma manuelle,
					// on ignore la langue de cette URL, l'URL generique s'appliquera
					if (!$perma) {
						unset($set['langue']);
					}
					else {
						$refresh['langue'] = $set['langue'];
					}
				}
				sql_updateq('spip_urls', $refresh, $where . url_sql_quote_like($set['url']));
				spip_log("refresh " . $set['type'] . " " . $set['id_objet'].' refresh:'.serialize($refresh), "urls");
				$redate = false;
			} else {
				$set['url'] .= $separateur . $set['id_objet'];
				return url_insert_replay($set, $confirmer, $separateur, $has_parent, $perma);
			}
		}
	}

	$reset = array();
	// si on a fixe une langue pour cette URL mais qu'il n'y a pas d'URL generique pour cet objet (avec langue='')
	// on retire la langue car c'est l'URL generique par defaut
	if (!empty($set['langue'])) {
		if (!sql_countsel('spip_urls',
			"type=" . sql_quote($set['type'])
			. " AND id_objet=" . intval($set['id_objet'])
			. " AND id_parent=" . intval($set['id_parent'])
			. " AND langue=" . sql_quote(''))){
			$set['langue'] = $reset['langue'] = '';
		}
	} else {
		$set['langue'] = '';
	}
	if ($redate) {
		$reset['date'] = date('Y-m-d H:i:s');
	}

	$where_thisurl = 'url=' . sql_quote($set['url']) . " AND id_parent=" . intval($set['id_parent']); // maj
	if ($reset) {
		sql_updateq('spip_urls', $reset, $where_thisurl);
	}

	// si url perma, poser le flag sur la seule url qu'on vient de mettre (au sein de celles qui ont la meme langue)
	if ($perma) {
		sql_update('spip_urls', array('perma' => "($where_thisurl)"),
			"type=" . sql_quote($set['type']) . " AND id_objet=" . intval($set['id_objet'])." AND langue=" . sql_quote($set['langue']));
	}

	spip_log("Creation de l'url propre '" . $set['url'] . "' pour "
		. $set['type'] . " " . $set['id_objet']
		. " (parent [" . $set['id_parent'] . "] langue [" . $set['langue'] . "] perma [" . ($perma ? "1" : "0") . "])", "urls");

	return true;
}

/**
 * Rejouer une insertion qui a echoue avec une url modifiee (rallongee)
 * on s'assure que la longueur de l'URL n'est pas problematique, et on remet le $set comme il faut
 * @param array $set
 * @param bool $confirmer
 * @param string $separateur
 * @param bool $has_parent
 * @param bool $perma
 * @return bool
 */
function url_insert_replay($set, $confirmer, $separateur, $has_parent, $perma) {
	//var_dump('url_insert_replay');
	if (strlen($set['url']) > 200) //serveur out ? retourner au mieux
	{
		return false;
	}
	else {
		// remettre id_parent et perma comme il faut si besoin
		if (!$has_parent) {
			unset($set['id_parent']);
		}
		if ($perma) {
			$set['perma'] = true;
		}
		//var_dump($set);
		return url_insert($set, $confirmer, $separateur);
	}
}

/**
 * Faire un quote de l'URL pour une condition LIKE, donc en echapant les caracteres specifiques aux like
 * @param $url
 * @return string
 */
function url_sql_quote_like($url) {
	return sql_quote(str_replace(array("%", "_"), array("\\%", "\\_"), $url)) . " ESCAPE " . sql_quote('\\');
}

/**
 * Verrouiller une URL
 * poser le flag sur une unique url d'un objet
 * (au sein de celles qui ont la meme langue : on peut avoir plusieurs URLs perma, une par langue)
 *
 * @param string $url
 * @param int $id_parent
 * @param $url
 */
function url_verrouiller($url, $id_parent=0) {
	$where_thisurl = 'url=' . sql_quote($url) . " AND id_parent=" . intval($id_parent);
	$row = sql_fetsel('*','spip_urls',$where_thisurl);

	// on fait un update unique pour changer toutes les URLs concernees d'un coup
	if ($row) {
		sql_update('spip_urls', array('perma' => "($where_thisurl)"),
			"type=" . sql_quote($row['type']) . " AND id_objet=" . intval($row['id_objet'])." AND langue=" . sql_quote($row['langue']));
	}
}

/**
 * Supprimer une URL
 * @param $objet
 * @param $id_objet
 * @param string $url
 * @param int $id_parent
 */
function url_delete($objet, $id_objet, $url = "", $id_parent=0) {
	$where = "id_objet=" . intval($id_objet) . " AND type=" . sql_quote($objet);
	if (strlen($url)) {
		$where .= " AND url=" . sql_quote($url) . " AND id_parent=" . intval($id_parent);
	}

	sql_delete("spip_urls", $where);

	// si on a supprime une seule URL, s'assurer qu'on a toujours au moins une URL avec lang=''
	$where = "id_objet=" . intval($id_objet) . " AND type=" . sql_quote($objet);
	if (!$nb = sql_countsel('spip_urls',$where .' AND langue=\'\'')) {
		if ($last = sql_fetsel('*','spip_urls',$where,'','perma=1 DESC, langue=\'\' DESC, id_parent=0 DESC, date DESC','0,1')) {
			sql_updateq('spip_urls',array('langue'=>''),'url='.sql_quote($last['url']) . ' AND id_parent='.intval($last['id_parent']));
		}
	}
}
