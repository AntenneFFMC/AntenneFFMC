<?php

/**
 * Balise #CALENDRIER_MINI
 * Auteur James (c) 2006-2012
 * Plugin pour SPIP 3.0.0
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;	#securite
}

include_spip('calendriermini_fonctions');

function balise_CALENDRIER_MINI($p) {
	return calculer_balise_dynamique($p, 'CALENDRIER_MINI', array(VAR_DATE, 'id_rubrique','id_article', 'id_mot'));
}

function balise_CALENDRIER_MINI_stat($args, $filtres) {
	//les parametres passe en {...}, les filtres sont des vraiss filtres
	return $args;
}

/**
 * Syntaxe raccourcie du plugin
 * #CALENDRIER_MINI
 * #CALENDRIER_MINI{#SELF}
 * #CALENDRIER_MINI{#SELF,#URL_PAGE{calendrier_mini.json}}
 *
 * Syntaxe ancienne (ou plugin agenda)
 * #CALENDRIER_MINI{#ENV{date}}
 * #CALENDRIER_MINI{#ENV{date},date}
 * #CALENDRIER_MINI{#ENV{date},date,#SELF}
 * #CALENDRIER_MINI{#ENV{date},date,#SELF,#URL_PAGE{calendrier_mini.json}}
 *
 * Quand l'url json est explicitee dans les arguments, la collecte automatisee de id_rubrique, id_article et id_mot est desactivee
 * car dans ce cas il suffit simplement de les expliciter sur l'url json pour les prendre en compte
 *
 * @param string $date
 *   date automatique collectee par VAR_DATE
 * @param int $id_rubrique
 * @param int $id_article
 * @param int $id_mot
 * @param null $self_or_date_or_nothing
 * @param null $urljson_or_var_date_or_nothing
 * @param null $self_or_nothing
 * @param null $urljson_or_nothing
 * @return array
 */
function balise_CALENDRIER_MINI_dyn(
	$date,
	$id_rubrique = 0,
	$id_article = 0,
	$id_mot = 0,
	$self_or_date_or_nothing = null,
	$urljson_or_var_date_or_nothing = null,
	$self_or_nothing = null,
	$urljson_or_nothing = null
) {
	$var_date = VAR_DATE;
	$url = null;
	$url_json = null;

	if (!is_null($self_or_date_or_nothing)) {
		// est-ce une date ou une url ?
		if (!function_exists('recup_date')) {
			include_spip('inc/filtres');
		}
		if (!strlen($self_or_date_or_nothing) or
			(preg_match(',^[\d\s:-]+$,', $self_or_date_or_nothing))
			and list($annee, $mois, $jour, $heures, $minutes, $secondes) = recup_date($self_or_date_or_nothing)
			and $annee) {
			// si c'est une date on est dans l'ancienne syntaxe
			$date = $self_or_date_or_nothing;
			$var_date = $urljson_or_var_date_or_nothing;
			$url = $self_or_nothing;
			$url_json = $urljson_or_nothing;
		} else {
			// sinon on est sur la nouvelle syntaxe
			$url = $self_or_date_or_nothing;
			$url_json = $urljson_or_var_date_or_nothing;
		}
	}

	$args = array(
		'date' => $date?$date:date('Y-m'),
		'var_date' => $var_date,
		'self' => $url?$url:self(),
	);

	// si pas de url_json explicite, la renseigner et peupler automatiquement les
	if (is_null($url_json)) {
		$url_json = generer_url_public('calendrier_mini.json');
		if (!is_null($id_rubrique)) {
			$args['id_rubrique'] = $id_rubrique;
		}
		if (!is_null($id_article)) {
			$args['id_article'] = $id_article;
		}
		if (!is_null($id_mot)) {
			$args['id_mot'] = $id_mot;
		}
	}

	if (defined('_VAR_MODE') and _VAR_MODE == 'recalcul') {
		$url_json = parametre_url($url_json, 'var_mode', 'recalcul');
	}

	$args['urljson'] = $url_json;

	/* tenir compte de la langue, c'est pas de la tarte */
	return array('formulaires/calendrier_mini', 3600, $args);
}
