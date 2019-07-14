<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_plugins_/agenda/trunk/lang/
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'afficher_annee_obligatoire_label_case' => 'Afficher systématiquement l’année',

	// B
	'branche_explication' => 'Proposer les événements des articles dans les branches suivantes. Une branche correspond à une rubrique et ses sous-rubriques.',
	'branche_label' => 'Branche',

	// D
	'date_debut_max_fixe_explication' => 'Proposer uniquement les événements qui commencent AVANT la date suivante (incluse).',
	'date_debut_max_fixe_label' => 'Date de début maximale',
	'date_debut_max_mobile_explication' => 'Proposer uniquement les événements qui commencent avant <i>x</i> jours. Pour les événements qui commencent demain au plus tard, mettre 1. Pour les événements qui commencent au plus tard hier, mettre -1.',
	'date_debut_max_mobile_label' => 'Date de début maximale (mobile)',
	'date_debut_min_fixe_explication' => 'Proposer uniquement les événements qui commencent APRÈS la date suivante (incluse).',
	'date_debut_min_fixe_label' => 'Date de début minimale',
	'date_debut_min_mobile_explication' => 'Proposer uniquement les événements qui commencent  à partir de <i>x</i> jours. Pour les événements qui commencent demain ou plus tard, mettre 1. Pour les événements qui commencent  hier ou plus tard, mettre -1.',
	'date_debut_min_mobile_label' => 'Date de début minimale (mobile)',
	'disable_complet_label_case' => 'Empêcher de choisir les évènements où les inscriptions sont complètes',

	// I
	'id_article_explication' => 'Proposer les événements des articles suivants.',
	'id_article_label' => 'Articles',
	'id_evenement_explication' => 'Proposer les événements suivants.',
	'id_evenement_label' => 'Événements',
	'id_mot_explication' => 'Proposer les événements ayant le(s) mot(s) clé suivant.',
	'id_mot_label' => 'Mot clé',
	'id_rubrique_explication' => 'Proposer les événements des articles dans les rubriques suivantes.',
	'id_rubrique_label' => 'Rubrique',
	'inscription_choix0' => 'Inscriptions closes',
	'inscription_choix1' => 'Inscriptions ouvertes',
	'inscription_explication' => 'Restreindre aux événements dont le critère inscription est le suivant.',
	'inscription_label' => 'Ouverture des inscriptions',

	// L
	'liste_attente' => 'Liste d’attente',
	'liste_attente_1' => 'Liste d’attente (une inscription avant vous sur la liste)',
	'liste_attente_explication' => 'Si le nombre de place disponible est inférieur à un, indiquer qu’il y a une liste, et, le cas échéant, combien de personnes sont sur liste d’attente. <br />Par ailleurs, un champ masqué <champ>_liste_attente sera automatiquement mis à ’on’ si une personne sélectionne un évènement en liste d’attente. Dans le cas d’utilisation avec Formidable, ce champ ne sera pas posté, mais pourra être utilisé dans des test conditionnels d’affichage de champ.',
	'liste_attente_label' => 'Gérer la liste d’attente',
	'liste_attente_label_case' => 'Indiquer qu’il y a une liste d’attente',
	'liste_attente_nb' => 'Liste d’attente (@nb@ inscriptions avant vous sur la liste)',

	// M
	'masquer_heure_label_case' => 'Masquer l’heure',

	// O
	'option_groupe_inscriptions' => 'Gestion des inscriptions',
	'option_groupe_presentation' => 'Présentation des évènements',
	'option_groupe_selection' => 'Choix des évènements proposés',
	'option_type_affichage_date' => 'Uniquement la date de l’événement',
	'option_type_affichage_label' => 'Libellé',
	'option_type_affichage_titre' => 'Uniquement le titre de l’événement',
	'option_type_affichage_titre_date' => 'Le titre et la date de l’événement',
	'option_type_choix_checkbox' => 'Choix multiples (case à cocher)',
	'option_type_choix_label' => 'Type de choix',
	'option_type_choix_radio' => 'Choix unique (boutons radios)',
	'option_type_choix_selection' => 'Choix unique (liste déroulante)',

	// P
	'places_dispo_label_case' => 'Afficher le nombre de places restantes',

	// S
	'saisie_evenements_chronologie_texte' => 'Les critères de date pour les choix des événements sont cumulatifs avec les critères précédents d’association à des objets.',
	'saisie_evenements_explication' => 'Un choix d’un ou plusieurs événements',
	'saisie_evenements_id_texte' => 'Les événements proposés peuvent être choisis par leurs identifiants, ou bien par leur association à des articles, des rubriques, des mots.<br />
	Pour ce faire, il faut indiquer un identifiant, éventuellement plusieurs séparés par des virgules, dans les champs <emph>a hoc</emph>.<br />
	Si plusieurs critères de sélections sont définis, un ET logique est utilisé. Ainsi, si vous mettez 4 dans le champ article et 2 dans le champ mot, les évènements appartennant à l’article 4 tout en ayant le mot-clé 2 seront proposés.',
	'saisie_evenements_titre' => 'Sélecteur d’événements'
);
