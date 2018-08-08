<?php

/**
 * Tests unitaires de l'API d'Archives
 * Production, mise à jour de fichiers
 */

use Spip\Archives\SpipArchives;

$test = 'retirer archives';
$remonte = '../';
while (!is_dir($remonte . 'ecrire')) {
	$remonte = "../$remonte";
}
require $remonte . 'tests/test.inc';
$ok = true;

require __DIR__ . '/TestCase.inc';
nettoyer_environnement_test();

include_spip('inc/archives');

//TODO
$ok = false;

if ($ok) {
	echo 'OK';
}
