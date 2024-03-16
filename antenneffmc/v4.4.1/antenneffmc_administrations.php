<?php

/**
 * Plugin AntenneFFMC
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;



////////////////////
// Fonction d'installation du plugin et de mise a jour.

function antenneffmc_upgrade($nom_meta_base_version, $version_cible) {
    $maj = array();
    include_spip('antenneffmc_fonctions');
    include_spip('inc/config');
    include_spip('action/editer_objet');

    $maj['create'] = [
        ['install_mots_sites'],
        ['antenneffmc_configuration'],
        ['ecrire_config', 'antenneffmc', []]
    ];

    // $maj['0.2.0'] = [
    //     ['update_mots_sites']
    // ];

    include_spip('base/upgrade');
    maj_plugin($nom_meta_base_version, $version_cible, $maj);
}



////////////////////
// Fonction de desinstallation du plugin.

function antenneffmc_vider_tables($nom_meta_base_version) {
    include_spip('antenneffmc_fonctions');

    uninstall_antenneffmc();

    effacer_config('antenneffmc');
    effacer_config($nom_meta_base_version);
}
