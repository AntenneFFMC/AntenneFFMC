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


function action_supprimer_evenement_participant_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();
	list($id_evenement, $id_evenement_participant) = explode('-', $arg);
	include_spip('inc/autoriser');
	if (intval($id_evenement) and autoriser('modifier', 'evenement', $id_evenement)) {
		if (intval($id_evenement_participant)) {
			sql_delete('spip_evenements_participants', 'id_evenement='.intval($id_evenement).' AND id_evenement_participant='.intval($id_evenement_participant));
		} else if ($id_evenement_participant == 'tous') {
			sql_delete('spip_evenements_participants', 'id_evenement='.intval($id_evenement));
		}
	}
	return true;
}
