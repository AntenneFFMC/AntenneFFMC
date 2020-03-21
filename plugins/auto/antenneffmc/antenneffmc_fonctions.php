<?php

/**
 * Plugin AntenneFFMC
 * Licence GNU/GPL
 *
 *
 * 1. Paramétrage à l'installation & désinstallation d'AntenneFFMC
 * 2. DIVERS
 */



//////////////////////////////////////////////////////////////////////////////////////////////////////
// 1. Paramétrage à l'installation d'AntenneFFMC
////////////////////


////////////////////
// Teste et configure certaines options de spip pour AntenneFFMC
// Penser à incrementer la valeur de schema dans paquet.xml et celle de $maj dans antenneffmc_administrations.php en cas de mise à jour des mots-clés

function antenneffmc_configuration() {
    include_spip('inc/config');

    // active l'utilisation des mots-clés
    $articles_mots = lire_config('articles_mots');
    if($articles_mots == 'non')
        ecrire_meta('articles_mots','oui');

    // active l'utilisation des sites et syndications
    $sites = lire_config('activer_sites');
    if($sites == 'non')
        ecrire_meta('activer_sites','oui');

    // désactive les logos de survol
    $logos_survol = lire_config('activer_logos_survol');
    if($logos_survol == 'oui')
        ecrire_meta('activer_logos_survol','non');

    // active l'HTML5
    $html_vers = lire_config('version_html_max');
    if($html_vers == 'html4')
        ecrire_meta('version_html_max','html5');

    // désactive les forums publics
    $config_forums = lire_config('forums_publics');
    if($config_forums != 'non')
        ecrire_meta('forums_publics','non');

    // activation du descriptif sur les rubriques et article
    if(lire_config('rubriques_descriptif') == 'non')
        ecrire_meta('rubriques_descriptif','oui') ;
    if(lire_config('articles_descriptif') == 'non')
       ecrire_meta('articles_descriptif','oui') ;
}


////////////////////
// Description du schema de mots
function schema_antenneffmc() {
    $schema = [
        'mots' => [
            // A lire
            [
                'titre' => 'A la une',
                'descriptif' => _T('antenneffmc:mot_une_desc'),
                'type' => 'A lire'
            ],
            [
                'titre' => 'Agenda',
                'descriptif' => '',
                'type' => 'A lire'
            ]
        ],
        'sites' => [
            [
                'nom_site' => _T('antenneffmc:site_ffmcnat_nom'),
                'url_site' => '//www.ffmc.asso.fr',
                'url_syndic' => '//ffmc.fr/spip.php?page=backend',
                'descriptif' => _T('antenneffmc:site_ffmcnat_desc'),
                'syndication' => 'oui'
            ],
            [
                'nom_site' => _T('antenneffmc:site_motomag_nom'),
                'url_site' => '//www.motomag.com/',
                'url_syndic' => '//www.motomag.com/spip.php?page=backend',
                'descriptif' => _T('antenneffmc:site_motomag_desc'),
                'syndication' => 'oui'
            ]
        ]
    ];

    return $schema;
}


////////////////////
// Mise à jour du schema

function update_mots_sites() {
    include_spip('action/editer_objet');

    // chargement du array des mots
    $schema = schema_antenneffmc();

    // en qu'elle version de antenneffmc est on ?
    // si on a une meta antenneffmc_base_version, c'est qu'on est sur une version avec instalation auto
    $meta = lire_config('antenneffmc_base_version');

    // si la meta est présente
    if($meta !== ''){
        // Maj des mots : on boucle sur le tableau mots
        for ($i= 0 , $nbr_mot = count($schema['mots']) ; $i < $nbr_mot ; ++$i){
            // test la présence du mot sur le champ titre
            $titre = $schema['mots'][$i]['titre'];
            $id_mot = sql_getfetsel("id_mot","spip_mots","titre='$titre'");
            // le titre du mot est déjà présent
            if ($id_mot !== '') {
                $test = sql_updateq('spip_mots', $schema['mots'][$i], "titre='$titre'");
                objet_modifier('mot',$id_mot,$schema['mots'][$i]);
            } else {
                // on extrait du array le groupe dont dépend le mot
                $grp_titre = $schema['mots'][$i]['type'];
                $id_grp = sql_getfetsel("id_groupe","spip_groupes_mots","titre='$grp_titre'");
                $id_mot = objet_inserer('mot',$id_grp);
                objet_modifier('mot',$id_mot,$schema['mots'][$i]);
            }
        }

        // Maj des sites : on boucle sur le tableau sites
        for ($i= 0 , $nbr_site = count($schema['sites']) ; $i < $nbr_site ; ++$i){
            // test la présence du site sur le champ url_site
            $url_site = $schema['sites'][$i]['url_site'];
            $id_site = sql_getfetsel("id_syndic","spip_syndic","url_site='$url_site'");
            // le champ url_site est déjà présent
            if ($id_site !== '') {
                $test = sql_updateq('spip_syndic', $schema['sites'][$i], "url_site='$url_site'");
                objet_modifier('site',$id_site,$schema['sites'][$i]);
            } else {
                $id_site = objet_inserer('site');
                objet_modifier('site', $id_site, $schema['sites'][$i]);
            }
        }
    }//si pas de meta_base on est sur une install plus ancienne
}


////////////////////
// Installe les mots clés et les sites

function install_mots_sites() {
    include_spip('action/editer_objet');
    // chargement du array des mots
    $schema = schema_antenneffmc();

    // installation des mots
    for ($i= 0 , $nbr_mot = count($schema['mots']) ; $i < $nbr_mot ; ++$i){
        // on extrait du array le groupe dont dépend le mot
        $grp_titre = $schema['mots'][$i]['type'];
        $id_grp = sql_getfetsel("id_groupe","spip_groupes_mots","titre='$grp_titre'");
        if($id_grp !== ''){
           $id_mot = objet_inserer('mot',$id_grp);
            objet_modifier('mot', $id_mot, $schema['mots'][$i]);
        }
    }

    // installation des sites
    for ($i= 0 , $nbr_site = count($schema['sites']) ; $i < $nbr_site ; ++$i){
        $id_site = objet_inserer('site');
        objet_modifier('site', $id_site, $schema['sites'][$i]);
    }
}


////////////////////
// Fonction de désinstallation des mots d'AntenneFFMC
function uninstall_antenneffmc(){
    // chargement du array des groupe et mots
    $schema = schema_antenneffmc();
    $id_grp = [];

    // recuperer les id des groupes
    for ($i= 0 , $nbr_mot = count($schema['groupes']) ; $i < $nbr_mot ; ++$i){
        $grp_titre = $schema['groupes'][$i]['titre'];
        $id_grp = sql_getfetsel("id_groupe","spip_groupes_mots","titre='$grp_titre'");
        // désinstaller les mots correspondant a ce groupe
        sql_delete("spip_mots","id_groupe='$id_grp'");
        sql_delete("spip_groupes_mots","id_groupe='$id_grp'");
    }
}





//////////////////////////////////////////////////////////////////////////////////////////////////////
// 2. DIVERS
////////////////////


////////////////////
// Ajouter des champs personnalisés à l'identité du site
// (plugin: identite_extra)

function mes_champs_identite($champs) {
    $champs = [
        'webmestre',
        'directeur_de_publication',
        'adresse_email_antenne',
        'code_postal',
        'ville',
        'voie',
        'telephone',
        'frequence_reunions',
        'url_facebook',
        'pseudo_twitter',
        'mentions_nom_long',
        'mentions_nom_court',
        'hebergement',
    ];

    return $champs;
}


////////////////////
// Récupérer année en cours au 1er janvier

annee_en_cours();
function annee_en_cours() {
    $annee = date('Y');
    $datetimeAnnee = new DateTime($annee.'-01-01');
    $anneeUnix = $datetimeAnnee->format('U');

    define('_ANNEE_UNIX', $anneeUnix);
}

?>
