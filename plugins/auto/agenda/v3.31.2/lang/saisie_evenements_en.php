<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de https://trad.spip.net/tradlang_module/saisie_evenements?lang_cible=en
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'afficher_annee_obligatoire_label_case' => 'Systematically display the year',

	// B
	'branche_explication' => 'Suggest the events of the articles in the following branches. A branch corresponds to a section and its sub-sections.',
	'branche_label' => 'Sector',

	// D
	'date_debut_max_fixe_explication' => 'Suggest only events that start BEFORE the next date (included).',
	'date_debut_max_fixe_label' => 'Maximum start date',
	'date_debut_max_mobile_explication' => 'Suggest only events that start before <i>x</i> days. For events that start tomorrow at the latest, put 1. for events that start yesterday at the latest, put -1.',
	'date_debut_max_mobile_label' => 'Maximum start date (mobile)',
	'date_debut_min_fixe_explication' => 'Only suggest events that start AFTER the next date (included).',
	'date_debut_min_fixe_label' => 'Minimum start date',
	'date_debut_min_mobile_explication' => 'Only suggest events that start from <i>x</i> days. For events that start tomorrow or later, put 1. for events that start yesterday or later, put -1.',
	'date_debut_min_mobile_label' => 'Minimum start date (mobile)',

	// I
	'id_article_explication' => 'Suggest the events of the following articles.',
	'id_article_label' => 'Articles',
	'id_evenement_explication' => 'Proposer les événements suivants.',
	'id_evenement_label' => 'Events',
	'id_mot_explication' => 'Suggest events with the following keyword(s).',
	'id_mot_label' => 'Keyword',
	'id_rubrique_explication' => 'Propose the events of the articles in the following sections.',
	'id_rubrique_label' => 'Section',
	'inscription_choix0' => 'Registration closed', # MODIF
	'inscription_choix1' => 'Registration open', # MODIF
	'inscription_explication' => 'Restrict to events whose registration criteria are as follows.',
	'inscription_label' => 'Registration', # MODIF

	// M
	'masquer_heure_label_case' => 'Hide the time',

	// O
	'option_type_affichage_date' => 'Only the event date',
	'option_type_affichage_label' => 'Events presentation', # MODIF
	'option_type_affichage_titre' => 'Only the event title',
	'option_type_affichage_titre_date' => 'The title and the event date',
	'option_type_choix_checkbox' => 'Multiple choices (checkbox)',
	'option_type_choix_label' => 'Type of choice',
	'option_type_choix_radio' => 'Single choice (radio buttons)',

	// S
	'saisie_evenements_chronologie_texte' => 'The date criteria for the choice of events are cumulative with the previous criterias for association with objects.',
	'saisie_evenements_explication' => 'A choice of one or more events',
	'saisie_evenements_id_texte' => 'The proposed events can be chosen by their identifiers, or by their association with articles, sections, words.<br />\\n
\\tTo do this, you must indicate an identifier, possibly several separated by commas, in the fields <emph>a hoc</emph>.<br />\\n
\\tIf several selection criteria are defined, a logical AND is used. Thus, if you put 4 in the article field and 2 in the word field, the events belonging to article 4 while having the keyword 2 will be proposed.',
	'saisie_evenements_titre' => 'Event selector'
);
