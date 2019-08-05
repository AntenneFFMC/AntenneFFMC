<?php
/**
 * Plugin Agenda 4 pour Spip 3.0
 * Licence GPL 3
 *
 * 2006-2011
 * Auteurs : cf paquet.xml
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/* pour que le pipeline ne rale pas ! */
function agenda_autoriser() {
}

function autoriser_evenementcreer_menu_dist($faire, $type = '', $id = 0, $qui = null, $opt = null) {
	return autoriser('creer', 'evenement', $id, $qui, $opt);
}

function autoriser_evenements_menu_dist($faire, $type = '', $id = 0, $qui = null, $opt = null) {
	return true;
}

/**
 * Autorisation d'ajout d'un evenement a un article
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_article_creerevenementdans_dist($faire, $quoi, $id, $qui, $options) {
	if (!$id) {
		return false; // interdit de creer un evenement sur un article vide !
	}
	// si on a le droit de modifier l'article alors on a peut-etre le droit d'y creer un evenement
	$afficher = false;
	if (autoriser('modifier', 'article', $id, $qui)) {
		$afficher = true;
		// un article avec des evenements a toujours le droit
		if (!sql_countsel('spip_evenements', array('id_article='.intval($id)), sql_in('statut', array('prop','publie')))) {
			// si au moins une rubrique a le flag agenda
			if (sql_countsel('spip_rubriques', 'agenda=1')) {
				// alors il faut le flag agenda dans cette branche !
				$afficher = false;
				include_spip('inc/rubriques');
				$id_rubrique = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article='.intval($id));
				if ($id_rubrique > 0) {
					// Rubriques classiques de SPIP
					$in = calcul_hierarchie_in($id_rubrique);
					$afficher = sql_countsel('spip_rubriques', sql_in('id_rubrique', $in).' AND agenda=1');
				} else {
					// Rubrique négative utilisee dans le plugin Page unique
					$afficher = true;
				}
			}
		}
	}
	return $afficher;
}

// Autorisation pour créer un événement n'importe où (article ou autre ou rien)
// Par défaut : comme pour créer dans un article si on l'a dans les options, sinon être admin complet
function autoriser_evenement_creer_dist($faire, $quoi, $id, $qui, $options) {
	if (isset($options['id_article']) and $options['id_article'] > 0) {
		return autoriser('creerevenementdans', 'article', $options['id_article'], $qui, $options);
	} else {
		return ($qui['statut'] == '0minirezo' and !$qui['restreint']);
	}
}

/**
 * Autorisation de modifier un evenement : autorisations de l'article parent
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_modifier_dist($faire, $quoi, $id, $qui, $options) {
	if (!isset($options['id_article']) or !$id_article = $options['id_article']) {
		$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id));
	}
	if (!$id_article) {
		return false;
	}
	return autoriser('modifier', 'article', $id_article, $qui);
}

/**
 * Autorisation d'instituer un evenement : voir si l'article est publie ou non
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_instituer_dist($faire, $quoi, $id, $qui, $options) {
	if (!isset($options['id_article']) or !$id_article=$options['id_article']) {
		$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id));
	}
	if (!$id_article) {
		return false;
	}
	$statut = sql_getfetsel('statut', 'spip_articles', 'id_article='.intval($id_article));
	// interdit de publier un evenement sur un article non publie
	if ($statut!=='publie'
		and isset($options['statut'])
		and $options['statut']=='publie') {
		return false;
	}
	$options['id_article'] = $id_article;
	return autoriser('modifier', 'evenement', $id, $qui, $options);
}

/**
 * Autorisation de voir un evenement : autorisations de l'article parent
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_voir_dist($faire, $quoi, $id, $qui, $options) {
	if (!isset($options['id_article']) or !$id_article=$options['id_article']) {
		$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id));
	}
	if (!$id_article) {
		return false;
	}
	return autoriser('voir', 'article', $id_article, $qui);
}


/**
 * Autorisation de supprimer un evenement : autorisations de l'article parent
 *
 * @param string $faire
 * @param string $quoi
 * @param int $id
 * @param int $qui
 * @param array $options
 * @return bool
 */
function autoriser_evenement_supprimer_dist($faire, $quoi, $id, $qui, $options) {
	if (!isset($options['id_article']) or !$id_article=$options['id_article']) {
		$id_article = sql_getfetsel('id_article', 'spip_evenements', 'id_evenement='.intval($id));
	}
	if (!$id_article) {
		if ($qui['statut']=='0minirezo') {
			return true;
		} else {
			return false;
		}
	}
	return autoriser('modifier', 'article', $id_article, $qui);
}
