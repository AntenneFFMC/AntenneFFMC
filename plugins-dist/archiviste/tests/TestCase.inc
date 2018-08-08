<?php

/**
 * Cas de tests pour SpipArchives
 */

function inconnu()
{
    static $inconnu = '';

    if ('' === $inconnu) {
        $inconnu = md5(rand());
    }

    return $inconnu;
}

function repertoire_de_test()
{
    return _NOM_TEMPORAIRES_INACCESSIBLES . 'archive_dir_test' . inconnu();
}

function definir_fichiers_de_test()
{
    $fichiers_de_test = array(
        'sans_extension' => 'archives_test',
        'extension_inconnue' => 'archives_test.' . inconnu(),
        'zip' => 'archives_test' . inconnu() . '.zip',
        'faux_amis' => 'fichier_test_zip',
    );

    return $fichiers_de_test;
}

function fichier_de_test($case)
{
    $fichiers = definir_fichiers_de_test();

    return _NOM_TEMPORAIRES_INACCESSIBLES . $fichiers[$case];
}

function contenu_de_test()
{
    return array(
        'test.txt' => 'contenu de test',
        'sousrep' => array(
            'fichier' => '',
        ),
    );
}

function nettoyer_environnement_test()
{
    foreach (definir_fichiers_de_test() as $case => $nom_fichier) {
        if (is_file(fichier_de_test($case))) {
            unlink(fichier_de_test($case));
        }
    }

    nettoyer_contenu_de_test(contenu_de_test());
    @rmdir(repertoire_de_test());
}

function nettoyer_contenu_de_test(array $fichiers = array(), $arborescence = '')
{
    if ($arborescence == '') {
        $arborescence = repertoire_de_test();
    }

    foreach ($fichiers as $fichier => $contenu) {
        if (is_array($contenu)) {
            nettoyer_contenu_de_test($contenu, $arborescence . ' /' . $fichier);
            if (is_dir($arborescence . ' /' . $fichier)) {
                rmdir($arborescence . ' /' . $fichier);
            }
        } elseif (file_exists($arborescence . '/' . $fichier)) {
            unlink($arborescence . '/' . $fichier);
        }
    }
}
