<?php

/**
 * Tests unitaires de l'API d'Archives
 * Initialisation
 */

use Spip\Archives\SpipArchives;

$test = 'initialiser archives';
$remonte = '../';
while (!is_dir($remonte . 'ecrire')) {
	$remonte = '../' . $remonte;
}
require $remonte . 'tests/test.inc';
$ok = true;

require __DIR__ . '/TestCase.inc';
nettoyer_environnement_test();

include_spip('inc/archives');

//extensions inconnues
foreach (array('sans_extension', 'extension_inconnue', 'faux_amis') as $cas) {
	$archive = new SpipArchives(fichier_de_test($cas));
	$ok &= ($archive->erreur() === 2);
}

//presence fichier
$fichier = fichier_de_test('zip');
$repertoire = repertoire_de_test();

//fichier absent
$archive = new SpipArchives($fichier);
$ok &= ($archive->erreur() === 3);
$ok &= !$archive->getLectureSeule(); //repertoire accessible en ecriture
$ok &= !$archive->deballer(); //on ne peut decompresser un fichier qui n'existe pas

//fichier present
touch($fichier);
$archive = new SpipArchives($fichier);
$ok &= ($archive->erreur() === 0);
$ok &= !$archive->getLectureSeule();
$ok &= !$archive->deballer($repertoire); //on ne peut pas décompresser dans un répertoire qui n'existe pas
$ok &= ($archive->erreur() === 5);

// destination en lecture seule
mkdir($repertoire);
chmod($repertoire, 0500);
$ok &= !$archive->deballer($repertoire); //on ne peut pa décompresser dans un répertoire en lecture seule
$ok &= ($archive->erreur() === 5);
chmod($repertoire, 0700);

//fichier en lecteure seule
chmod($fichier, 0400);
$archive = new SpipArchives($fichier);
$ok &= ($archive->erreur() === 0);
$ok &= $archive->getLectureSeule();
chmod($fichier, 0600);

//forcer le mode de compression
$fichier = fichier_de_test('sans_extension');
touch($fichier);
$archive = new SpipArchives($fichier, 'zip');
$ok &= ($archive->erreur() === 0);

nettoyer_environnement_test();
if ($ok) {
	echo 'OK';
}
