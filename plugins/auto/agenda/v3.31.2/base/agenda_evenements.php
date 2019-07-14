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
 * Interfaces du compilateur
 *
 * @param array $interface
 * @return array
 */
function agenda_declarer_tables_interfaces($interface) {
	// 'spip_' dans l'index de $tables_principales
	$interface['table_des_tables']['evenements']='evenements';

	$interface['table_des_traitements']['LIEU'][]= 'expanser_liens('._TRAITEMENT_TYPO.')';
	$interface['table_des_traitements']['ADRESSE'][]= _TRAITEMENT_RACCOURCIS;

	// permet d'utiliser les criteres racine, meme_parent, id_parent
	$interface['exceptions_des_tables']['evenements']['id_parent']='id_evenement_source';
	$interface['exceptions_des_tables']['evenements']['id_rubrique']=array('spip_articles', 'id_rubrique');

	return $interface;
}

/**
 * Tables auxiliaires de liens
 * @param array $tables_auxiliaires
 * @return array
 */
function agenda_declarer_tables_auxiliaires($tables_auxiliaires) {

	//-- Table des participants ----------------------
	$spip_evenements_participants = array(
		'id_evenement_participant' => 'BIGINT(21) NOT NULL AUTO_INCREMENT',
		'id_evenement'	=> "BIGINT (21) DEFAULT '0' NOT NULL",
		'id_auteur'	=> "BIGINT (21) DEFAULT '0' NOT NULL",
		'nom'	=> "text NOT NULL DEFAULT ''",
		'email'	=> "tinytext NOT NULL DEFAULT ''",
		'date' => "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
		'reponse' => "char(3) default '?' NOT NULL", // oui, non, ?
	);

	$spip_evenements_participants_key = array(
			'PRIMARY KEY'	=> 'id_evenement_participant',
			'KEY id_evenement'	=> 'id_evenement',
			'KEY id_auteur'	=> 'id_auteur');

	$tables_auxiliaires['spip_evenements_participants'] = array(
		'field' => &$spip_evenements_participants,
		'key' => &$spip_evenements_participants_key);

	return $tables_auxiliaires;
}

/**
 * Declarer la table objet evenement
 *
 * @param array $tables
 * @return array
 */
function agenda_declarer_tables_objets_sql($tables) {
	$tables['spip_evenements'] = array(
		'page'=>'evenement',
		'texte_retour' => 'icone_retour',
		'texte_objets' => 'agenda:info_evenements',
		'texte_objet' => 'agenda:info_evenement',
		'texte_modifier' => 'agenda:icone_modifier_evenement',
		'texte_creer' => 'agenda:titre_cadre_ajouter_evenement',
		'texte_logo_objet' => 'agenda:texte_logo_objet',
		'info_aucun_objet'=> 'agenda:info_aucun_evenement',
		'info_1_objet' => 'agenda:info_un_evenement',
		'info_nb_objets' => 'agenda:info_nombre_evenements',
		'titre' => 'titre, "" AS lang',
		'date' => 'date_debut',
		'principale' => 'oui',
		'champs_editables' => array('date_debut', 'date_fin', 'titre', 'descriptif','lieu', 'adresse', 'inscription', 'places', 'horaire'),
		'field'=> array(
			'id_evenement'	=> 'bigint(21) NOT NULL',
			'id_article'	=> "bigint(21) DEFAULT '0' NOT NULL",
			'date_debut'	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			'date_fin'	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL",
			'titre'	=> "text NOT NULL DEFAULT ''",
			'descriptif'	=> "text NOT NULL DEFAULT ''",
			'lieu'	=> "text NOT NULL DEFAULT ''",
			'adresse'	=> "text NOT NULL DEFAULT ''",
			'inscription' => 'tinyint(1) DEFAULT 0 NOT NULL',
			'places' => 'int(11) DEFAULT 0 NOT NULL',
			'horaire' => "varchar(3) DEFAULT 'oui' NOT NULL",
			'id_evenement_source'	=> 'bigint(21) NOT NULL',
			'statut'	=> "varchar(10) DEFAULT '0' NOT NULL",
			'maj'	=> 'TIMESTAMP',
			'date_creation'	=> "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL"
		),
		'key' => array(
			'PRIMARY KEY'	=> 'id_evenement',
			'KEY date_debut'	=> 'date_debut',
			'KEY date_fin'	=> 'date_fin',
			'KEY id_article'	=> 'id_article'
		),
		'join' => array(
			'id_evenement' => 'id_evenement',
			'id_article' => 'id_article'
		),
		'tables_jointures' => array(
			'articles',
			'evenements_participants',
		),
		'rechercher_champs' => array(
		  'titre' => 8, 'descriptif' => 5, 'lieu' => 5, 'adresse' => 3
		),
		'rechercher_jointures' => array(
			'document' => array('titre' => 2, 'descriptif' => 1)
		),
		'statut' => array(
			array(
				'champ' => 'statut',
				'publie' => 'publie',
				'previsu' => '!',
				'exception' => array('statut','tout')
			),
		),
		'statut_titres' => array(
			'prop'=>'agenda:info_evenement_propose',
			'publie'=>'agenda:info_evenement_publie',
			'poubelle'=>'agenda:info_evenement_supprime'
		),
		'statut_textes_instituer' => 	array(
			'prop' => 'texte_statut_propose_evaluation',
			'publie' => 'texte_statut_publie',
			'poubelle' => 'texte_statut_poubelle',
		),
		'texte_changer_statut' => 'agenda:texte_evenement_statut',
		'champs_versionnes' => array('id_article', 'titre', 'descriptif', 'lieu', 'adresse', 'date_debut', 'date_fin', 'horaire'),

	);

	//-- Jointures ----------------------------------------------------
	$tables['spip_articles']['tables_jointures'][] = 'evenements';
	$tables['spip_auteurs']['tables_jointures'][] = 'evenements_participants';
	$tables['spip_rubriques']['field']['agenda'] = 'tinyint(1) DEFAULT 0 NOT NULL';
	$tables['spip_rubriques']['champs_editables'][] = 'agenda';
	$tables['spip_rubriques']['champs_versionnes'][] = 'agenda';

	return $tables;
}
