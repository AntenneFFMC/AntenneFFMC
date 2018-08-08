<?php
require_once('lanceur_spip.php');

class AllTests_barre_outil_markitup extends SpipTestSuite {
	function __construct() {
		parent::__construct('Barre MarkitUp');
		$this->addDir(__FILE__);
	}
}