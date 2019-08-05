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

include_spip('public/agenda');
include_spip('inc/agenda_filtres'); // deprecies mais encore supportes pour le moment

/**
 * Ajout d'un offset a une date
 *
 * @param string $date
 * @param int $secondes
 *   peut etre une expression math : 24*60*60
 * @param string $format
 *   format de sortie de la date
 * @return string
 */
function agenda_dateplus($date, $secondes, $format = 'Y-m-d H:i:s') {
	$date = strtotime($date)+eval("return $secondes;"); // permet de passer une expression
	return date($format, $date);
}

/**
 * decale les mois de la date.
 * cette fonction peut raboter le jour si le nouveau mois ne les contient pas
 * exemple 31/01/2007 + 1 mois => 28/02/2007
 *
 * @param string $date
 * @param int $decalage
 * @param string $format
 * @return string
 */
function agenda_moisdecal($date, $decalage, $format = 'Y-m-d H:i:s') {
	include_spip('inc/filtres');
	$date_array = recup_date($date);
	if ($date_array) {
		list($annee, $mois, $jour) = $date_array;
	}
	if (!$jour) {
		$jour = 1;
	}
	if (!$mois) {
		$mois = 1;
	}
	$mois2 = $mois + $decalage;
	$date2 = mktime(1, 1, 1, $mois2, $jour, $annee);
	// mois normalement attendu
	$mois3 = date('m', mktime(1, 1, 1, $mois2, 1, $annee));
	// et si le mois de la nouvelle date a moins de jours...
	$mois2 = date('m', $date2);
	if ($mois2 - $mois3) {
		$date2 = mktime(1, 1, 1, $mois2, 0, $annee);
	}
	return date($format, $date2);
}


/**
 * decale les jours de la date.
 *
 * @param string $date
 * @param int $decalage
 * @param string $format
 * @return string
 */
function agenda_jourdecal($date, $decalage, $format = 'Y-m-d H:i:s') {
	include_spip('inc/filtres');
	$date_array = recup_date($date);
	if ($date_array) {
		list($annee, $mois, $jour) = $date_array;
	}
	if (!$jour) {
		$jour = 1;
	}
	if (!$mois) {
		$mois = 1;
	}
	$jour2 = $jour + $decalage;
	$date2 = mktime(1, 1, 1, $mois, $jour2, $annee);
	return date($format, $date2);
}

/**
 * Filtre pour tester si une date est dans le futur
 * [(#DATE|agenda_date_a_venir) Dans le futur...]
 *
 * @param string $date_test
 * @param string $date_ref
 *   date de reference, par defaut celle du serveur (argument utile pour les tests unitaires)
 * @return string
 */
function agenda_date_a_venir($date_test, $date_ref = null) {
	if (is_null($date_ref)) {
		$date_ref = $_SERVER['REQUEST_TIME'];
	} else {
		$date_ref = strtotime($date_ref);
	}

	return (strtotime($date_test)>$date_ref)?' ':'';
}


/**
 * Filtre pour tester si une date est dans le passe
 * [(#DATE|agenda_date_passee) Dans le passe...]
 *
 * @param string $date_test
 * @param string $date_ref
 *   date de reference, par defaut celle du serveur (argument utile pour les tests unitaires)
 * @return string
 */
function agenda_date_passee($date_test, $date_ref = null) {
	if (is_null($date_ref)) {
		$date_ref = $_SERVER['REQUEST_TIME'];
	} else {
		$date_ref = strtotime($date_ref);
	}

	return (strtotime($date_test) < $date_ref) ? ' ' : '';
}

/**
 * Determiner la date de debut de l'affichage de la liste des evenements
 * en fonction du mode demande et de la date courante
 * @param string $date
 * @param string $affichage_debut
 * @return string
 */
function agenda_date_debut_liste($date, $affichage_debut = 'date_jour') {
	switch ($affichage_debut) {
		case 'date_jour':
			break;
		case 'date_veille':
			$date = agenda_jourdecal($date, -1);
			break;
		case 'debut_semaine':
			$t = strtotime($date);
			$date = agenda_jourdecal($date, -(date('N', $t)-1));
			break;
		case 'debut_semaine_prec':
			$t = strtotime($date);
			$date = agenda_jourdecal($date, -(date('N', $t)-1+7));
			break;
		case 'debut_mois':
			$t = strtotime($date);
			$date = agenda_jourdecal($date, -(date('j', $t)-1));
			break;
		case 'debut_mois_prec':
			$t = strtotime($date);
			$date = agenda_jourdecal($date, -(date('j', $t)-1)); // debut de mois
			$date = agenda_moisdecal($date, -1); // precedent
			break;
		case 'debut_mois_1':
		case 'debut_mois_2':
		case 'debut_mois_3':
		case 'debut_mois_4':
		case 'debut_mois_5':
		case 'debut_mois_6':
		case 'debut_mois_7':
		case 'debut_mois_8':
		case 'debut_mois_9':
		case 'debut_mois_10':
		case 'debut_mois_11':
		case 'debut_mois_12':
			$t = strtotime($date);
			$mdebut = intval(substr($affichage_debut, strlen('debut_mois_')));
			$mcourant = date('n', $t);
			$offset = ($mcourant-$mdebut+12)%12;
			$date = agenda_jourdecal($date, -(date('j', $t)-1)); // debut de mois
			$date = agenda_moisdecal($date, -$offset);
			break;
	}
	return $date;
}
/**
 * Afficher la periode de l'agenda :
 * Le nom du mois si nb_mois = 1
 * L'annee si nb_mois=12 et debut du mois = janvier
 * sinon : mois annee - mois annee (xxx 12 - yyy 13)
 * si le debut de la periode est fixe (debut d'un mois donnee), on precede de
 * "Annee" ou "Saison" la periode
 *
 * @param string $date
 * @param int $nb_mois
 * @param string $affichage_debut
 * @return string
 */
function affdate_periode($date, $nb_mois, $affichage_debut = 'date_jour') {
	$fixe = in_array($affichage_debut, array('debut_mois_1', 'debut_mois_2', 'debut_mois_3', 'debut_mois_4', 'debut_mois_5', 'debut_mois_6', 'debut_mois_7', 'debut_mois_8', 'debut_mois_9', 'debut_mois_10', 'debut_mois_11', 'debut_mois_12'));
	if ($nb_mois == 1) {
		return affdate_mois_annee($date);
	}
	if ($nb_mois == 12 and mois($date) == 1) {
		return ($fixe?_T('agenda:label_annee').' ':'').annee($date);
	}

	return ($fixe?_T('agenda:label_periode_saison').' ':'').affdate_mois_annee($date).' - '.affdate_mois_annee(agenda_moisdecal($date, $nb_mois-1));
}


/**
 * Retrouver le id_rubrique parent agenda d'une rubrique
 * (elle-meme inclue)
 *
 * @param $id_rubrique
 * @return int
 */
function agenda_rubrique_actif_explicite($id_rubrique) {

	if ($id_rubrique > 0) {

		// est-elle de type agenda elle-meme ?
		if (sql_countsel('spip_rubriques', 'agenda=1 and id_rubrique=' .intval($id_rubrique))) {
			return $id_rubrique;
		}
		// Sinon on remonte la hierarchie
		if (!function_exists('calcul_hierarchie_in')) {
			include_spip('inc/rubriques');
		}
		$in = calcul_hierarchie_in($id_rubrique);
		$parents_agenda = sql_allfetsel('id_rubrique','spip_rubriques', sql_in('id_rubrique', $in).' AND agenda=1');
		if ($parents_agenda) {
			$parents_agenda = array_map('reset', $parents_agenda);

			$in = explode(',', $in);
			$parents_agenda = array_intersect($in, $parents_agenda);
			if ($parents_agenda) {
				return reset($parents_agenda);
			}
		}

	}

	// Rubrique négative utilisee dans le plugin Page unique
	if ($id_rubrique == -1) {
		return $id_rubrique;
	}

	return false;

}
