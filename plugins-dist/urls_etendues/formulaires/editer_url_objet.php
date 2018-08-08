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
}

/**
 * Chargement des donnees du formulaire
 *
 * @param string $type
 * @param int $id
 * @return array
 */
function formulaires_editer_url_objet_charger_dist($type, $id) {
	$valeurs = array('url' => '', '_objet' => $type, '_id_objet' => $id);

	return $valeurs;
}

/**
 * Verifier la saisie de l'URL
 * on peut prefixer par une langue au format
 * fr:Mon-URL-fr
 * en:My-english-url
 * pour specifier la langue de l'URL (mais il faut que le module d'URL la prenne en charge)
 * @param $type
 * @param $id
 * @return array
 */
function formulaires_editer_url_objet_verifier_dist($type, $id) {
	$erreurs = array();
	include_spip('action/editer_url');
	$langue = '';
	if (!$url = _request('url')) {
		$erreurs['url'] = _T('info_obligatoire');
	} else {
		if (preg_match(";^([a-z_]{2,9}):;", $url, $m)
		  and url_verifier_langue($m[1])) {
			$langue = trim($m[1]);
			$url = substr($url, strlen($m[0]));
		}

		$type_urls = (isset($GLOBALS['type_urls']) ? $GLOBALS['type_urls'] : $GLOBALS['meta']['type_urls']);
		if ($type_urls == 'arbo' and strpos($url, '/') !== false) {
			$url = explode('/', $url);
			if (count($url) > 2) {
				$erreurs['url'] = _T('urls:erreur_arbo_2_segments_max');
			} else {
				foreach ($url as $u) {
					$url_clean[] = url_nettoyer($u, 255);
				}
				$url = implode('/', $url);
				$url_clean = implode('/', $url_clean);
			}
		} else {
			$url_clean = url_nettoyer($url, 255);
		}
		if (!isset($erreurs['url']) and $url != $url_clean) {
			set_request('url', ($langue?"$langue:":"") . $url_clean);
			$erreurs['url'] = _T('urls:verifier_url_nettoyee');
		}
	}

	return $erreurs;
}

/**
 * Traitement
 *
 * @param string $type
 * @param int $id
 * @return array
 */
function formulaires_editer_url_objet_traiter_dist($type, $id) {
	$valeurs = array('editable' => true);
	include_spip('action/editer_url');

	$url = _request('url');
	$langue = '';
	if (preg_match(";^([a-z_]{2,9}):;", $url, $m)
	  and url_verifier_langue($m[1])) {
		$langue = trim($m[1]);
		$url = substr($url, strlen($m[0]));
	}

	// les urls manuelles sont toujours permanentes
	$set = array('url' => $url, 'type' => $type, 'id_objet' => $id, 'perma' => 1, 'langue' => $langue);

	$type_urls = (isset($GLOBALS['type_urls']) ? $GLOBALS['type_urls'] : $GLOBALS['meta']['type_urls']);
	if (include_spip("urls/$type_urls")
		and function_exists($renseigner_url = "renseigner_url_$type_urls")
		and $r = $renseigner_url($type, $id)
		and isset($r['parent'])
	) {
		$set['id_parent'] = $r['parent'];
	}

	$separateur = "-";
	if (defined('_url_sep_id')) {
		$separateur = _url_sep_id;
	}

	if (url_insert($set, false, $separateur)) {
		set_request('url');
		$valeurs['message_ok'] = _T("urls:url_ajoutee");
	} else {
		$valeurs['message_erreur'] = _T("urls:url_ajout_impossible");
	}

	return $valeurs;
}
