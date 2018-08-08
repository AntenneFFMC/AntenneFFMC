<?php

/*
 * Squelette : ../prive/squelettes/contenu/rubriques.html
 * Date :      Wed, 14 Mar 2018 16:27:20 GMT
 * Compile :   Tue, 07 Aug 2018 17:28:01 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../prive/squelettes/contenu/rubriques.html
// Temps de compilation total: 1.790 ms
//

function html_05baa28e9e1dc0a146c5beeee517e763($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<h1 class="grostitre">' .
_T('public|spip|ecrire:info_rubriques') .
'</h1>
<!--affiche_milieu-->
' .
pipeline( 'affiche_enfants' , array('args' => array('exec' => 'rubriques'), 'data' => recuperer_fond( 'prive/objets/contenu/rubrique-enfants' , array_merge($Pile[0],array('id_rubrique' => '0' )), array('compil'=>array('../prive/squelettes/contenu/rubriques.html','html_05baa28e9e1dc0a146c5beeee517e763','',0,$GLOBALS['spip_lang'])), _request('connect'))) ) .
'

' .
pipeline( 'afficher_complement_objet' , array('args' => array('type' => 'rubrique', 'id' => '0'), 'data' => '<div class="nettoyeur"></div>') ));

	return analyse_resultat_skel('html_05baa28e9e1dc0a146c5beeee517e763', $Cache, $page, '../prive/squelettes/contenu/rubriques.html');
}
?>