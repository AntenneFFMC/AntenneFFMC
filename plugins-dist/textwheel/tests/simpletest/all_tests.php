<?php
require_once('lanceur_spip.php');

class AllTests_textwheel extends SpipTestSuite {
	function __construct() {
		parent::__construct('Tests Textwheel');
		$this->addDir(__FILE__);
	}
}