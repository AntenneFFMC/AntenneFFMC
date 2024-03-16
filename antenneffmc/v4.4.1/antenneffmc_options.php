<?php

/**
 * Plugin AntenneFFMC
 * Licence GNU/GPL
 */

date_default_timezone_set('Europe/Paris');

$_SERVER['HTTPS'] = "on";
$_SERVER['SERVER_PORT'] ='443';

$GLOBALS['spip_pipeline']['identite_extra_champs'] .= "|mes_champs_identite";

if (stripos($_SERVER['SERVER_NAME'], 'preprod.ffmc73.org') !== FALSE) {
    define('_PREPROD', true);
} else {
    define('_PREPROD', false);
}

if (_PREPROD) {
    define('_NO_CACHE', -1);
    define('_INTERDIRE_COMPACTE_HEAD_ECRIRE', true);
    // error_reporting(E_ALL);
    // ini_set ('display_errors', 'On');
    $GLOBALS['taille_des_logs'] = 500;
    define('_LOG_FILELINE',true);
    define('_LOG_FILTRE_GRAVITE',8);
    define('_DEBUG_SLOW_QUERIES', true);
    define('_BOUCLE_PROFILER', 5000);
}

if (!defined('_ANTENNEFFMC_PAGES_CONFIG')) define('_ANTENNEFFMC_PAGES_CONFIG',
    'accueil|apparence!header:sommaire:contact|documentation!doc_rubriques:doc_widgets:doc_mots'
);

if (!defined('_ANTENNEFFMC_CARTE_REGIONS')) define('_ANTENNEFFMC_CARTE_REGIONS',
    'ARA|BFC|BRE|CVL|COR|GES|HDF|IDF|NOR|NAQ|OCC|PDL|PAC|GF|RE'
);

?>
