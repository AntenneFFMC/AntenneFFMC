<?php

function mes_champs_identite($champs){

    $champs = [
        'url_facebook',
        'pseudo_twitter'
    ];

    return $champs;
}




////////////////////
// Récupérer année en cours au 1er janvier

$annee = date('Y');
$datetimeAnnee = new DateTime($annee.'-01-01');
$anneeUnix = $datetimeAnnee->format('U');

define('_ANNEE_UNIX', $anneeUnix);

?>
