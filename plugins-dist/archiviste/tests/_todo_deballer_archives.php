<?php

/**
 * Tests unitaires de l'API d'Archives
 * Extraction de fichiers
 */

use Spip\Archives\SpipArchives;

$test = 'deballer archives';
$remonte = '../';
while (!is_dir($remonte . 'ecrire')) {
	$remonte = "../$remonte";
}
require $remonte . 'tests/test.inc';
$ok = true;

require __DIR__ . '/TestCase.inc';
nettoyer_environnement_test();

include_spip('inc/archives');

//Faire un zip valide pour tester les cas nominaux
// `cd local/ && touch test.txt && mkdir sousrep && touch sousrep/fichier && \
// zip test.zip test.txt sousrep/fichier && cd ..`

$fichier = fichier_de_test('zip');
$repertoire = repertoire_de_test();
$destination = _NOM_TEMPORAIRES_INACCESSIBLES . 'archives';

$archive = new SpipArchives($fichier);

$ok &= $archive->deballer($destination, array('test.txt'));
$ok &= file_exists($destination . '/test.txt');
$ok &= !file_exists($destination . '/sousrep/fichier');

$ok &= $archive->deballer($destination);
$ok &= file_exists($destination . '/test.txt');
$ok &= file_exists($destination . '/sousrep/fichier');

nettoyer_contenu_de_test(contenu_de_test(), $destination);
nettoyer_environnement_test();
if ($ok) {
	echo 'OK';
}
