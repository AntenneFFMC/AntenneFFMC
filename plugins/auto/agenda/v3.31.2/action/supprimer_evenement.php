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

function action_supprimer_evenement_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	list($id_evenement, $id_article) = preg_split(',[^0-9],', $arg);
	include_spip('inc/autoriser');
	if (intval($id_article)
		and intval($id_evenement)
		and autoriser('supprimer', 'evenement', $id_evenement, null, array('id_article'=>$id_article))) {
		include_spip('action/editer_evenement');
		evenement_modifier($id_evenement, array('statut'=>'poubelle'));
	}
}
