<?php

/**
 *  SPIP, Systeme de publication pour l'internet
 *
 *  Copyright (c) 2001-2016
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James
 *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.
 */

namespace Spip\Archives;

/**
 * Point d'entrée de la gestion des archives compressées de SPIP
 */
class SpipArchives
{
	/** @var integer Dernier code d'erreur */
	private $codeErreur;

	/** @var string Dernier message d'erreur */
	private $messageErreur;

	/** @var array Mode de compression connus */
	private $compressionsConnues = array('zip');

	/** @var string Mode de compression si l'extension du fichier n'est pas explicite */
	private $modeCompression;

	/** @var string Chemin vers le fichier d'archives */
	private $fichierArchive;

	/** @var boolean true si l'archive est en lecture seule */
	private $lectureSeule = true;

	/** @var array Liste des erreurs possibles */
	private $erreurs = array(
		0 => 'OK',
		1 => 'erreur_inconnue',
		2 => 'extension_inconnue',
		3 => 'fichier_absent',
		4 => 'fichier_lecture_seule',
		5 => 'destination_inaccessible',
	);

	/**
	 * Renvoyer le dernier code d'erreur.
	 *
	 * @return integer Dernier code d'erreur
	 */
	public function erreur() {
		$code = in_array($this->codeErreur, array_keys($this->erreurs)) ? $this->codeErreur : 1;

		$this->codeErreur = $code;
		$this->messageErreur = 'archives:'.$this->erreurs[$code];

		return $code;
	}

	/**
	 * Renvoyer le dernier message d'erreur.
	 *
	 * @return string Dernier message d'erreur
	 */
	public function message() {
		return $this->messageErreur;
	}

	/**
	 * Indiquer le détail du contenu de l'archive.
	 *
	 * @return array détail du contenu de l'archive
	 */
	public function informer() {
		return array(
			'proprietes' => array(),
			'fichiers' => array()
		);
	}

	/**
	 * Extraire tout ou partie des fichiers de l'archive vers une destination.
	 *
	 * @param  string  $destination Chemin du répertoire d'extraction
	 * @param  array   $fichiers	Liste des fichiers à extraire
	 *
	 * @return boolean			  Succès de l'opération
	 */
	public function deballer($destination = '', array $fichiers = array()) {
		if ($this->codeErreur !== 0) {
			return false;
		}

		if (!(is_dir($destination) and is_writable($destination))) {
			$this->codeErreur = 5;
			return false;
		}

		$this->codeErreur = 0;
		return true;
	}

	/**
	 * Créer ou modifier des fichiers dans le fichier d'archive.
	 *
	 * @param  array   $fichiers Liste des fichiers à ajouter ou modifier
	 *
	 * @return boolean		   Succès de l'opération
	 */
	public function emballer(array $fichiers = array()) {
		if ($this->lectureSeule) {
			$this->codeErreur = 4;
			return false;
		}

		$this->codeErreur = 0;
		return true;
	}

	/**
	 * Retirer une liste de fichiers dans le fichier d'archive.
	 *
	 * @param  array   $fichiers Liste des fichiers à retirer
	 *
	 * @return boolean		   Succès de l'opération
	 */
	public function retirer(array $fichiers = array()) {
		if ($this->lectureSeule) {
			$this->codeErreur = 4;
			return false;
		}

		$this->codeErreur = 0;
		return true;
	}

	/**
	 * Constructeur de base.
	 *
	 * @param string $fichierArchive  Chemin vers le fichier d'archives
	 * @param string $modeCompression Mode de compression si l'extension du fichier n'est pas explicite
	 */
	public function __construct($fichierArchive, $modeCompression = '') {
		$this->codeErreur = 0;

		if ('' === $modeCompression) {
			$modeCompression = preg_replace(',.+\.([^.]+)$,', '$1', $fichierArchive);
		}

		$modeCompression = strtolower($modeCompression);
		if (!in_array($modeCompression, $this->compressionsConnues)) {
			$this->codeErreur = 2;
		} elseif (!file_exists($fichierArchive)) {
			$this->codeErreur = 3;

			$repertoireArchive = dirname($fichierArchive);
			$this->lectureSeule = !(is_dir($repertoireArchive) and is_writable($repertoireArchive));
		} else {
			$this->lectureSeule = !is_writable($fichierArchive);
		}

		$this->modeCompression = $modeCompression;
		$this->fichierArchive = $fichierArchive;
	}

	/**
	 * Indique si l'archive est accessible en ecriture ou pas.
	 *
	 * @return boolean true si l'archive est en lecture seule
	 */
	public function getLectureSeule() {
		return $this->lectureSeule;
	}
}
