<?php

require_once('lanceur_spip.php');

class Test_nettoyer_raccourcis_typo extends SpipTest {

	public function __construct() {
		parent::__construct("Tests de nettoyer_raccourcis_typo()");
		include_spip('inc/lien');
		include_spip('inc/texte_mini');
	}

	/**
	 * @param array[] $data Collection of array with keys : [texte, couper, nettoyer]
	 */
	protected function _testData(array $data) {
		foreach ($data as $d) {
			$nettoyer = nettoyer_raccourcis_typo($d['texte']);
			$couper = couper($d['texte']);
			$this->_printTest($d, $nettoyer, $couper);
		}
	}


	protected function _printTest(array $data, $nettoyer, $couper) {
		$titre = isset($data['titre']) ? $data['titre'] : '';
		if (!$this->assertEqual($nettoyer, $data['nettoyer'])) {
			$this->reporter->paintFormattedMessage("Nettoyer_raccourcis_typo | $titre. Texte -> Attendu -> Reçu");
			$this->reporter->paintFormattedMessage($data['texte']);
			$this->reporter->paintFormattedMessage($data['nettoyer']);
			$this->reporter->paintFormattedMessage($nettoyer);
		}
		if (!$this->assertEqual($couper, $data['couper'])) {
			$this->reporter->paintFormattedMessage("Couper | $titre. Texte -> Attendu -> Reçu");
			$this->reporter->paintFormattedMessage($data['texte']);
			$this->reporter->paintFormattedMessage($data['couper']);
			$this->reporter->paintFormattedMessage($couper);
		}
	}

	function testNettoyerItalique(){
		$this->_testData([[
			'texte' => 'Un mot {italique}',
			'couper' => 'Un mot italique',
			'nettoyer' => 'Un mot italique',
		],[
			'texte' => '{Un texte italique}',
			'couper' => 'Un texte italique',
			'nettoyer' => 'Un texte italique',
		]]);
	}

	function testNettoyerGras(){
		$this->_testData([[
			'texte' => 'Un mot {{gras}}',
			'couper' => 'Un mot gras',
			'nettoyer' => 'Un mot gras',
		],[
			'texte' => '{{Un texte gras}}',
			'couper' => 'Un texte gras',
			'nettoyer' => 'Un texte gras',
		]]);
	}


	function testNettoyerIntertitre(){
		$this->_testData([[
			'texte' => '{{{Un intertitre}}}',
			'couper' => 'Un intertitre',
			'nettoyer' => 'Un intertitre',
		],[
			'texte' => "Ligne\n\n{{{Un intertitre}}}\n\nLigne",
			'couper' => "Ligne\n\nUn intertitre\n\nLigne",
			'nettoyer' => "Ligne\n\nUn intertitre\n\nLigne",
		]]);
	}

	function testNettoyerLiens(){
		$this->_testData([[
			'texte' => 'Un lien [interne->article1]',
			'couper' => 'Un lien interne',
			'nettoyer' => 'Un lien interne',
		],[
			'texte' => 'Un lien [externe->http://example.org]',
			'couper' => 'Un lien externe',
			'nettoyer' => 'Un lien externe',
		]]);
	}

	/**
	 * Les listes sont mises à plat
	 * 1 saut de ligne \n entre chaque, couper les réassemble en espace.
	 *
	 * @note
	 *    Avant SPIP 3.2, 1 saut de paragraphe \n\n entre chaque (couper le laissait).
	 */
	function testNettoyerListes(){
		$this->_testData([[
			'texte' =>
				"Une liste
-* un
-* deux
-* trois
",
			'couper' => "Une liste un deux trois",
			'nettoyer' => "Une liste\nun\ndeux\ntrois",
		],[
			'texte' =>
				"Une liste avec ligne

-* un
-* deux
-* trois

",
			'couper' => "Une liste avec ligne un deux trois",
			'nettoyer' => "Une liste avec ligne\nun\ndeux\ntrois",
		]]);
	}

	/**
	 * Les tableaux sont totalement supprimés.
	 * Enfin presque : remplacés par \n\n
	 * Le texte étant trimmé, \n en fins sont enlevés.
	 *
	 * @note
	 *     Avant SPIP 3.2, les tableaux n’étaient pas toujours correctement supprimés
	 */
	function testNettoyerTableaux(){
		$this->_testData([[
			// tableau sans sauts de ligne avant / après.
			'titre' => 'tableau sans sauts de ligne avant / après',
			'texte' =>
				"| {{colonneA}} | {{colonneB}} |
| ligneA1 | ligneB1 |
| ligneA2 | ligneB2 |",
			'couper' => "",
			'nettoyer' => "",
		],[
			'texte' =>
				"Un tableau sans ligne vide avant
| {{colonneA}} | {{colonneB}} |
| ligneA1 | ligneB1 |
| ligneA2 | ligneB2 |
",
			'couper' => "Un tableau sans ligne vide avant",
			'nettoyer' => "Un tableau sans ligne vide avant",
		],[
			'texte' =>
				"Un tableau avec ligne vide avant

| {{colonneA}} | {{colonneB}} |
| ligneA1 | ligneB1 |
| ligneA2 | ligneB2 |
",
			'couper' => "Un tableau avec ligne vide avant",
			'nettoyer' => "Un tableau avec ligne vide avant",
		],[
			'texte' =>
				"Un tableau avec ligne avant / après
| {{colonneA}} | {{colonneB}} |
| ligneA1 | ligneB1 |
| ligneA2 | ligneB2 |
Après
",
			'couper' => "Un tableau avec ligne avant / après\n\nAprès",
			'nettoyer' => "Un tableau avec ligne avant / après\n\nAprès",
		]]);
	}

	/**
	 * Les notes sont supprimées.
	 *
	 * @note
	 *     Avant 3.2 la regexp pouvait tuer pcre sur des textes longs
	 *     ayant des notes mal fermées.
	 */
	function testNettoyerNotes(){
		$this->_testData([[
			'texte' => 'Une note bien fermée [[note 1]]',
			'couper' => 'Une note bien fermée',
			'nettoyer' => 'Une note bien fermée',
		],[
			'texte' => 'Une note mal fermée [[note 1]',
			'couper' => 'Une note mal fermée [[note 1]',
			'nettoyer' => 'Une note mal fermée [[note 1]',
		],[
			'texte' => 'Un lien dans une note [[note [lien->article1]]]',
			'couper' => 'Un lien dans une note',
			'nettoyer' => 'Un lien dans une note',
		],[
			'texte' => 'Lien et note ratée [[note [lien->article1]] ]',
			'couper' => 'Lien et note ratée [[note lien] ]',
			'nettoyer' => 'Lien et note ratée [[note lien] ]',
		]]);
	}
}