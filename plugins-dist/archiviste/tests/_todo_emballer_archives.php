<?php

/**
 * Tests unitaires de l'API d'Archives
 * Production de fichiers
 */

use Spip\Archives\SpipArchives;

$test = 'emballer archives';
$remonte = '../';
while (!is_dir($remonte . 'ecrire')) {
	$remonte = "../$remonte";
}
require $remonte . 'tests/test.inc';
$ok = true;

require __DIR__ . '/TestCase.inc';
nettoyer_environnement_test();

include_spip('inc/archives');

$ok = false;

if ($ok) {
	echo 'OK';
}
