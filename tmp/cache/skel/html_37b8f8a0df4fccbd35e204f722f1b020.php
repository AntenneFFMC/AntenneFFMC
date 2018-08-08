<?php

/*
 * Squelette : ../prive/objets/liste/articles-memerubrique.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:47 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/objets/liste/articles-memerubrique.html
// Temps de compilation total: 1.178 ms
//

function html_37b8f8a0df4fccbd35e204f722f1b020($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = 
'<'.'?php echo recuperer_fond( ' . argumenter_squelette('prive/objets/liste/articles') . ', array_merge('.var_export($Pile[0],1).',array(\'id_article\' => ' . argumenter_squelette('') . ',
	\'pagination\' => ' . argumenter_squelette('page') . ',
	\'titre\' => ' . argumenter_squelette(_T('public|spip|ecrire:info_meme_rubrique')) . ',
	\'lang\' => ' . argumenter_squelette($GLOBALS["spip_lang"]) . ')), array("compil"=>array(\'../prive/objets/liste/articles-memerubrique.html\',\'html_37b8f8a0df4fccbd35e204f722f1b020\',\'\',1,$GLOBALS[\'spip_lang\'])), _request("connect"));
?'.'>';

	return analyse_resultat_skel('html_37b8f8a0df4fccbd35e204f722f1b020', $Cache, $page, '../prive/objets/liste/articles-memerubrique.html');
}
?>