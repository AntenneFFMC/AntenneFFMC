<?php
/**
 * GetID3
 * Gestion des métadonnées de fichiers sonores et vidéos directement dans SPIP
 *
 * Auteurs :
 * kent1 (http://www.kent1.info - kent1@arscenic.info), BoOz
 * 2008-2016 - Distribué sous licence GNU/GPL
 *
 * @package SPIP\GetID3\Metadatas
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Fonction de récupération des métadonnées sur les fichiers audio
 * appelée à l'insertion en base dans le plugin medias (inc/renseigner_document)
 *
 * @param string $file
 *    Le chemin du fichier à analyser
 * @return array $metas
 *    Le tableau comprenant les différentes metas à mettre en base
 */
function metadata_audio($file) {
	$meta = array();

	include_spip('lib/getid3/getid3');
	$getID3 = new getID3;
	$getID3->setOption(array('tempdir' => _DIR_TMP));

	// Scan file - should parse correctly if file is not corrupted
	$file_info = $getID3->analyze($file);

	header('Content-Type: text/plain');
	if (isset($file_info['id3v2']['comments']['title'])) {
		$meta['titre'] = ucfirst(trim(implode(' ',$file_info['id3v2']['comments']['title'])));
	}
	if (isset($file_info['id3v2']['comments']['artist'])) {
		$meta['credits'] = implode(', ',$file_info['id3v2']['comments']['artist']);
		if (isset($file_info['id3v2']['comments']['album'])) {
			$meta['credits'] .= '/'.trim(implode(' ',$file_info['id3v2']['comments']['album']));
		}
		if (isset($file_info['id3v2']['comments']['year'])) {
			$meta['credits'] .= ' ('.trim(implode(' ',$file_info['id3v2']['comments']['year'])).')';
		}
	}
	if (isset($file_info['playtime_seconds'])) {
		$meta['duree'] = round($file_info['playtime_seconds'], 0);
	}

	return $meta;
}
