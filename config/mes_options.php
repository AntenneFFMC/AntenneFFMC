<?php

date_default_timezone_set('Europe/Paris');

$_SERVER['HTTPS'] = "on";
$_SERVER['SERVER_PORT'] ='443';

$GLOBALS['spip_pipeline']['identite_extra_champs'] .= "|mes_champs_identite";

// TODO: Supprimer en prod (setup de debug)
define('_NO_CACHE', -1);
// define('_INTERDIRE_COMPACTE_HEAD_ECRIRE', true);
// error_reporting(E_ALL^E_NOTICE);
// ini_set ("display_errors", "On");
// define('SPIP_ERREUR_REPORT',E_ALL);
// $GLOBALS['taille_des_logs'] = 500;
// define('_MAX_LOG', 500000);
// define('_LOG_FILELINE',true);
// define('_LOG_FILTRE_GRAVITE',8);
// define('_DEBUG_SLOW_QUERIES', true);
// define('_BOUCLE_PROFILER', 5000);

?>
