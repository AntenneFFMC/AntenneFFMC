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

/**
 * Installation/maj des tables evenements et participants...
 *
 * @param string $nom_meta_base_version
 * @param string $version_cible
 */
function agenda_upgrade($nom_meta_base_version, $version_cible) {
	$maj = array();
	$maj['create'] = array(
		array('maj_tables', array('spip_evenements','spip_evenements_participants')),
		array('sql_alter', 'TABLE spip_rubriques ADD agenda tinyint(1) DEFAULT 0 NOT NULL'),
		array('ecrire_config','agenda/synchro_statut','1')
	);
	$maj['0.11'] = array(
		array('sql_alter', "TABLE spip_evenements ADD `horaire` ENUM('oui','non') DEFAULT 'oui' NOT NULL AFTER `lieu`"),
	);
	$maj['0.12'] = array(
		array('sql_alter', "TABLE spip_evenements ADD `id_article`  bigint(21) DEFAULT '0' NOT NULL AFTER `id_evenement`"),
		array('sql_alter', 'TABLE spip_evenements ADD ADD INDEX ( `id_article` )'),
		array('upgrade_evenements_articles_012'),
		array('sql_drop_table', 'spip_evenements_articles'),
	);

	$maj['0.13'] = array(
		array('maj_tables', array('spip_evenements', 'spip_evenements_participants')),
	);
	$maj['0.18'] = array(
		array('maj_tables', array('spip_evenements','spip_evenements_participants')),
		array('sql_update','spip_groupes_mots', array('tables_liees'=>"concat(tables_liees,'evenements,')"), "evenements='oui'"),
		array('sql_alter','TABLE spip_groupes_mots DROP evenements'),
	);

	$maj['0.20'] = array(
		array('sql_alter', 'TABLE spip_rubriques ADD agenda tinyint(1) DEFAULT 0 NOT NULL'),
	);

	$maj['0.21'] = array(
		array('sql_alter', 'TABLE spip_evenements ADD adresse text NOT NULL'),
		array('sql_alter', 'TABLE spip_evenements ADD inscription text NOT NULL'),
		array('sql_alter', 'TABLE spip_evenements ADD places text NOT NULL'),
	);

	$maj['0.22'] = array(
		array('maj_tables',array('spip_evenements_participants')),
	);

	$maj['0.23'] = array(
		array('sql_alter',"TABLE spip_evenements CHANGE titre titre text NOT NULL DEFAULT ''"),
		array('sql_alter',"TABLE spip_evenements CHANGE descriptif descriptif text NOT NULL DEFAULT ''"),
		array('sql_alter',"TABLE spip_evenements CHANGE lieu lieu text NOT NULL DEFAULT ''"),
		array('sql_alter',"TABLE spip_evenements CHANGE adresse adresse text NOT NULL DEFAULT ''"),
	);
	include_spip('maj/svn10000');
	$maj['0.24.0'] = array(
		array('maj_liens', 'mot', 'evenement'),
		array('sql_drop_table', 'spip_mots_evenements'),
		array('sql_alter', 'TABLE spip_evenements ADD statut varchar(10) DEFAULT 0 NOT NULL'),
	);

	$maj['0.25.0'] = array(
		array('upgrade_evenements_statut_025'),
	);

	$maj['0.26.0'] = array(
		array('maj_tables',array('spip_evenements')),
		array('sql_update', 'spip_evenements', array('date_creation' => 'maj')),
	);

	$maj['0.27.0'] = array(
		// modification de la cle primaire (id_evenement,id_auteur) : les participants peuvent ne pas être des auteurs
		// ajout d'une clé primaire "neutre" auto-incrémentée
		array('sql_alter', 'TABLE spip_evenements_participants DROP PRIMARY KEY'),
		array('sql_alter', 'TABLE spip_evenements_participants ADD id_evenement_participant BIGINT(21) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST'),
		array('maj_tables', array('spip_evenements_participants')),
	);
	$maj['0.28.0'] = array(
		array('ecrire_config','agenda/synchro_statut','1')
	);
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function agenda_vider_tables($nom_meta_base_version) {
	sql_drop_table('spip_evenements');
	#sql_drop_table("spip_mots_evenements"); // au cas ou ?
	sql_alter('TABLE spip_rubriques DROP COLUMN agenda');
	effacer_meta($nom_meta_base_version);
}

function upgrade_evenements_articles_012() {
	$res = sql_select('*', 'spip_evenements_articles');
	while ($row = sql_fetch($res)) {
		$id_article = $row['id_article'];
		$id_evenement = $row['id_evenement'];
		sql_update('spip_evenements', array('id_article'=>$id_article), 'id_evenement='.intval($id_evenement));
	}
}

function upgrade_evenements_statut_025() {
	include_spip('action/editer_evenement');
	$res = sql_select('id_evenement', 'spip_evenements', "statut='0'");
	while ($row = sql_fetch($res)) {
		evenement_modifier($row['id_evenement'], array());
	}
}
