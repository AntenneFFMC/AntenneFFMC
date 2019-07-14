<?php
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Return le text conditionnel js pour les évènements sur liste d'attente
 * @param array $liste_attente les évènements sur liste d'attent
 * @param string $type_choix radio|checkbox|selection
 * @param string $nom name de la saisie
 * @return string le test js
**/
function evenements_liste_attente_genererer_test_js($liste_attente, $type_choix, $nom) {
	$if = '';
	if ($type_choix == 'radio') {
		$if = "[".implode($liste_attente, ',')."].includes(parseInt($(\"[name='$nom']:checked\").val()))";
	} elseif ($type_choix == 'selection') {
		$if = "[".implode($liste_attente, ',')."].includes(parseInt($(\"[name='$nom']\").val()))";
	} elseif ($type_choix == 'checkbox') {
		$if = "[".implode($liste_attente, ',')."].includes(parseInt($(\"[name='".$nom."[]']:checked\").val()))";
	}
	return $if;
}
