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


function action_activer_agenda_rubrique_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	// A-t-on vraiment le droit de modifier la rubrique en question ?
	if (!autoriser('modifier', 'rubrique', abs(intval($arg)))) {
		include_spip('inc/minipres');
		echo minipres(_T('info_acces_interdit'));
		exit;
	}

	if (intval($arg)!=0) {
		if (intval($arg) > 0) {
			sql_updateq('spip_rubriques', array('agenda'=>1), 'id_rubrique='.intval($arg));
		} else {
			sql_updateq('spip_rubriques', array('agenda'=>0), 'id_rubrique='.(-intval($arg)));
		}
	}
}
