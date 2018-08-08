<?php

/*
 * Squelette : ../plugins-dist/medias/prive/style_prive_plugin_medias.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:17:04 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/prive/style_prive_plugin_medias.html
// Temps de compilation total: 22.273 ms
//

function html_795cf87c462b98c5cbb065c8f5729cee($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'
' .
'<'.'?php header("X-Spip-Cache: 360000"); ?'.'>'.'<'.'?php header("Cache-Control: max-age=360000"); ?'.'>'.'<'.'?php header("X-Spip-Statique: oui"); ?'.'>' .
'<'.'?php header(' . _q('Content-Type: text/css; charset=iso-8859-15') . '); ?'.'>' .
'<'.'?php header(' . _q('Vary: Accept-Encoding') . '); ?'.'>' .
vide($Pile['vars'][$_zzz=(string)'claire'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_claire', null), 'edf3fe'),true)))) .
vide($Pile['vars'][$_zzz=(string)'foncee'] = (	'#' .
	interdire_scripts(entites_html(sinon(table_valeur(@$Pile[0], (string)'couleur_foncee', null), '3874b0'),true)))) .
vide($Pile['vars'][$_zzz=(string)'left'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','left','right'))) .
vide($Pile['vars'][$_zzz=(string)'right'] = interdire_scripts(choixsiegal(entites_html(table_valeur(@$Pile[0], (string)'ltr', null),true),'left','right','left'))) .
'.formulaire_editer_document {margin-bottom: 0;}
.formulaire_editer_document .editer_dimensions input {width:7em;}
.formulaire_editer_document .editer_parent {padding-' .
table_valeur($Pile["vars"], (string)'left', null) .
':10px;}
.formulaire_editer_document .editer_parent label {margin-' .
table_valeur($Pile["vars"], (string)'left', null) .
':0;display:block;float:left;padding:2px 0;}

.formulaire_editer_document .taille_modifiee {display:block;color: red;}

.formulaire_editer_document .editer_apercu .tourner {display:block;float:' .
table_valeur($Pile["vars"], (string)'right', null) .
';}
.formulaire_editer_document .editer_apercu .tourner input.image {padding:5px;border:1px solid #eee;}

.formulaire_joindre_document {margin-top: 0}
.formulaire_joindre_document .sourceup {}
.formulaire_joindre_document .infos {}
.formulaire_joindre_document .deballer_zip ul {font-size:0.9em;}
.formulaire_joindre_document .deballer_zip ul ul {font-size:1em;}
.formulaire_joindre_document .deballer_zip ol {padding-' .
table_valeur($Pile["vars"], (string)'left', null) .
':0;margin:0;word-wrap:break-word;}
.lat .formulaire_joindre_document { margin-top: ' .
(($t1 = strval(interdire_scripts(strmult(entites_html(table_valeur(@$Pile[0], (string)'margin-bottom', null),true),'1.5'))))!=='' ?
		($t1 . 'em') :
		'') .
'; }
.lat .formulaire_joindre_document .deballer_zip ol {max-width: 185px;}

.formulaire_joindre_document .deballer_zip .editer_options_upload_zip li {padding:0;}
.formulaire_joindre_document .deballer_zip .editer_options_upload_zip .erreur_message {margin-bottom:1em;}
#navigation .formulaire_joindre_document .sourceup, #extra .formulaire_joindre_document .sourceup {font-size:0.85em;}
#navigation .formulaire_joindre_document .deballer_zip .editer_options_upload_zip > label,
#extra .formulaire_joindre_document .deballer_zip .editer_options_upload_zip > label {float:none;}
#navigation .formulaire_joindre_document .deballer_zip .editer_options_upload_zip .choix input,
#extra .formulaire_joindre_document .deballer_zip .editer_options_upload_zip .choix input {vertical-align:top;}

.formulaire_joindre_document .editer_fichier input.file {display:block;}
.formulaire_joindre_document .editer_refdoc_joindre input.text {width:50%;}

.onglets_simple .medias .image a,.onglets_simple .medias .image strong {padding-left:27px;background: url(' .
interdire_scripts(chemin_image('media-image-16.png')) .
') no-repeat 5px center;}
.onglets_simple .medias .audio a,.onglets_simple .medias .audio strong {padding-left:27px;background: url(' .
interdire_scripts(chemin_image('media-audio-16.png')) .
') no-repeat 5px center;}
.onglets_simple .medias .video a,.onglets_simple .medias .video strong {padding-left:27px;background: url(' .
interdire_scripts(chemin_image('media-video-16.png')) .
') no-repeat 5px center;}

.onglets_simple.second ul.distant li.first,.onglets_simple.second ul.brises li.first,.onglets_simple.second ul.sanstitre li.first {margin-' .
table_valeur($Pile["vars"], (string)'left', null) .
':30px;}

.choix-type, .choix-type li {display:inline;list-style:none;margin:0;padding:0;}
.choix-type {margin:1em 0;padding:0;}


a.bouton_fermer {display:block;text-align:' .
table_valeur($Pile["vars"], (string)'right', null) .
';}

.galerie { float: none; width: 100%; padding:0;margin-bottom: ' .
interdire_scripts(entites_html(table_valeur(@$Pile[0], (string)'margin-bottom', null),true)) .
';}
.galerie .pagination {clear:both;font-size:0.95em;}
.galerie .pagination + .pagination {border-top: 0;margin-top:-1px;}
.galerie table { width: 100%; border: none; margin-bottom: 0}
.galerie table thead,.galerie table thead th  { background: #e5e5e5;background: -webkit-gradient(linear, left top, left bottom, from(#f0f0f0), to(#e0e0e0));background-image: -webkit-linear-gradient(top, #f0f0f0, #e0e0e0);background-image: -moz-linear-gradient(top, #f0f0f0, #e0e0e0);background-image: -ms-linear-gradient(top, #f0f0f0, #e0e0e0);background-image: -o-linear-gradient(top, #f0f0f0, #e0e0e0);background-image: linear-gradient(top, #f0f0f0, #e0e0e0);filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=\'#f0f0f0\', endColorstr=\'#e0e0e0\');}
.galerie table tbody tr:hover { background: ' .
(($t1 = strval(filtrer('couleur_eclaircir',filtrer('couleur_eclaircir',table_valeur($Pile["vars"], (string)'claire', null)))))!=='' ?
		('#' . $t1) :
		'') .
'; }
.galerie table td { min-height: 100px; vertical-align: top; }
.galerie table th, .galerie table td { padding: 0.5em .3em; border-bottom: 1px solid #ccc; }
.galerie table th.id { text-align: right; }
.galerie table td.id { width: 80px; text-align: right; vertical-align: top; line-height: normal; }
.galerie table td.id strong { font-size: 1.6em; color: #666; font-weight: normal; }
.galerie table td.statut { width: 9px; }
.galerie table td.logo { width: 250px; overflow: hidden; }
.galerie table td.logo img { /*border: 1px solid #666;*/ }
.galerie table .fichier {font-size:0.8em;width:250px;overflow:hidden;font-style:italic;}

.galerie table td.exif { width: 140px;  }
.galerie table td.exif small { display: inline; }
.galerie table td.exif .extension {}
.galerie table td.exif .dimensions { font-size: .9em; }
.galerie table td.exif .taille { font-size: .9em; font-weight: bold; color: #666; }
.galerie table td.exif .date { font-size: .9em; }
.galerie table td.descriptif { }

.galerie table .supprimer {display:block;font-size:0.8em;margin-top:1em;}

.galerie.media-image h2 { background: url(' .
interdire_scripts(chemin_image('media-image-32.png')) .
') no-repeat center left; padding: 6px;padding-left: 40px;}
.galerie.media-audio h2 { background: url(' .
interdire_scripts(chemin_image('media-audio-32.png')) .
') no-repeat center left; padding: 6px;padding-left: 40px;}
.galerie.media-video h2 { background: url(' .
interdire_scripts(chemin_image('media-video-32.png')) .
') no-repeat center left; padding: 6px;padding-left: 40px;}

.galerie table td.exif { background-repeat: no-repeat; background-position: top right; }

.popin-choisir_document {}
.popin-choisir_document .onglets_simple.second {display:none;}
.popin-choisir_document .galerie table td.id  {width:40px;}
.popin-choisir_document .galerie table td.logo  {width:200px;}
.popin-choisir_document .galerie table td.exif {width:120px;}
.popin-choisir_document .galerie table td.descriptif {max-width:150px;}
.popin-choisir_document .galerie table td {word-wrap: break-word;}

.spip_documents_legende {border:1px solid ' .
table_valeur($Pile["vars"], (string)'foncee', null) .
';text-align:center;font-size:0.9em;margin:0 0 1em;}
.spip_documents_legende dt {background:' .
table_valeur($Pile["vars"], (string)'foncee', null) .
';color:#fff;padding:5px 3px;font-weight:bold;}
.spip_documents_legende dd {padding:3px 0;margin:0;}
.spip_documents_legende dd.vignette {margin:5px 0;} 

.document_utilisations li.item {position:relative;padding-' .
table_valeur($Pile["vars"], (string)'right', null) .
':24px;}
.document_utilisations li.item .vu {position:absolute;top:0;right:0;}


.pagination .tris {float:left;}

p.actions {clear:both;}

#documents_joints {margin-top:25px;}
#documents_joints .item {text-align:center;margin-bottom:25px;padding:0;border:1px solid ' .
table_valeur($Pile["vars"], (string)'foncee', null) .
';overflow:visible;}
#documents_joints .item.image {background:#fff;}
#documents_joints .item.document {background:#ddd;}
#documents_joints .item .infos {padding:6px;}
#documents_joints .item .titrem {margin-top:0px;text-align:left;background:' .
table_valeur($Pile["vars"], (string)'foncee', null) .
';padding:5px;padding-left:16px;font-weight:bold;margin-bottom:5px;position:relative;font-size:x-small;word-wrap:break-word;}
#documents_joints .item .titrem .fichier {display:block;color:#fff;overflow:hidden;}
#documents_joints .item .titrem .titre {display:block;color:#000;}
#documents_joints .item .titrem .image_loading {position:absolute;bottom:-20px;right:0;}
#documents_joints .item .type {font-size:x-small;}
#documents_joints .item .raccourcis {font-size:x-small;padding:2px;}
#documents_joints .item .raccourcis span {display:block;font-weight:bold;text-align:left;}
#documents_joints .item div.mode {text-align:right;font-size:x-small;}
#documents_joints .item .actions {display:block;text-align:right;font-size:x-small;}
.lte7 #documents_joints .item div.mode button,.lte7 #documents_joints .item .actions button {font-size: 11px;}
#documents_joints .item .tourner {display:block;float:' .
table_valeur($Pile["vars"], (string)'right', null) .
';}
#documents_joints .item .tourner button {padding:1px;border:1px solid #eee;display:block;}
#documents_joints .item .tourner button img {margin:0px;}

#documents_joints .item .actions > *,
#documents_joints .item .tourner,
#documents_joints .item .mode {opacity:0.4;}
#documents_joints .item .actions .deplacer-modifier {visibility:visible;opacity:1;font-weight:bold;}
#documents_joints .item:hover .actions > *,
#documents_joints .item:hover .tourner,
#documents_joints .item:hover .mode,
#documents_joints .item.hover .actions > *,
#documents_joints .item.hover .tourner,
#documents_joints .item.hover .mode {visibility:visible;opacity:1;}

.portfolios {}
.portfolios h3 {background-color:' .
table_valeur($Pile["vars"], (string)'claire', null) .
';padding:2px 10px;color:#000;margin-bottom:0;}
.portfolios .liste_items {margin-top:0;}
.portfolios .liste_items .pagination { clear:both; width:100%; }
.portfolios .liste_items > .pagination:first-child {  margin-top:0; margin-bottom:.6925em; }
.portfolios .item { clear:both; }
.portfolios .item .presentation { display:-webkit-box; display:-ms-flexbox; display:flex; -webkit-box-orient:horizontal; -webkit-box-direction:normal; -ms-flex-direction:row; flex-direction:row; width:100%; }
.portfolios .item .vignette { width: 150px; min-width:150px; text-align: center; }
.portfolios .item .descriptions {  display:-webkit-box;  display:-ms-flexbox;  display:flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column; flex-direction: column; padding-' .
table_valeur($Pile["vars"], (string)'right', null) .
': 0.6925em; margin-' .
table_valeur($Pile["vars"], (string)'left', null) .
':1em; width: 100%; -webkit-box-flex:1; -ms-flex-positive:1; flex-grow:1; }
.portfolios .item .titrem .vu { float:left; margin-' .
table_valeur($Pile["vars"], (string)'right', null) .
':4px; }
.portfolios .item .titrem {margin:0 0 5px;font-size:1em;}
.portfolios .item .titrem .fichier {font-weight:normal;font-size:0.9em; font-style:italic; display:block; }
.portfolios .item .titrem .titre {display:block;font-size:1.1em;}
.portfolios .item .descriptif { color:#444; margin-bottom:.6925em; -webkit-box-flex: 1; -ms-flex-positive: 1; flex-grow: 1; }
.portfolios .item .infos .permanentes {
	display: block;
	padding:2px 4px; margin-top:.5em; color:rgba(0,0,0,.8);
	border-top:1px solid rgba(100, 100, 100, .1);
	border-bottom:1px solid rgba(100, 100, 100, .1);
}
.portfolios .item .infos .lien_details { float:' .
table_valeur($Pile["vars"], (string)'right', null) .
'; cursor:pointer; }
.portfolios .item .infos .detaillees { display:none; }
.portfolios .item .infos .detaillees table.compact:first-child tr { border-top:0; }
.portfolios .item table.compact { background-color:rgba(255,255,255,.6); }
.portfolios .item table.compact th,
.portfolios .item table.compact td { padding:.3em .3em; }
.portfolios .item table.compact tr { border-top:1px solid rgba(100, 100, 100, .1); border-bottom:1px solid rgba(100, 100, 100, .1);  }
.portfolios .item table.compact tr:nth-child(2n) td,
.portfolios .item table.compact tr:nth-child(2n) th { background:none; }
.portfolios .item .infos .credits .vide {  font-style:italic; opacity:.5; }
.portfolios .item div.mode {display:inline-block; clear:' .
table_valeur($Pile["vars"], (string)'right', null) .
';}
.portfolios .item .actions { clear:both; overflow:visible; margin-top:.6925em; padding-' .
table_valeur($Pile["vars"], (string)'right', null) .
': .6925em; margin-bottom:-3px; }
.portfolios .item div.mode,
.portfolios .item .actions,
.portfolios .item div.mode button,
.portfolios .item .actions button {text-align: ' .
table_valeur($Pile["vars"], (string)'left', null) .
'; clear: none;}
.portfolios .item div.mode button,
.portfolios .item .actions button {display: inline;}

.portfolios .item .actions > *,
.portfolios .item .mode {opacity:0.4;}
.portfolios .item .actions .deplacer-modifier { visibility: visible; opacity: 1; float: ' .
table_valeur($Pile["vars"], (string)'right', null) .
'; font-weight: bold; }
.portfolios .item:hover .actions > *,
.portfolios .item:hover .mode,
.portfolios .item.hover .actions > *,
.portfolios .item.hover .mode {visibility:visible;opacity:1;z-index:1000;}

.portfolios .item .titre > .sanstitre,
.portfolios .item .titre > .sanstitre + .fichier {opacity:0.4;}

.portfolios .actions-liste { clear:both; margin-top:.6925em; display:block; }
.portfolios .actions-liste > * {display:inline; }
.portfolios .tout_supprimer span {display:block; text-align:' .
table_valeur($Pile["vars"], (string)'right', null) .
';}

.item.vu_oui {background:#f9f9f9;}

.deplacer-document-placeholder { height:130px; }
.deplacer-document { margin-' .
table_valeur($Pile["vars"], (string)'right', null) .
':0.5em; float: ' .
table_valeur($Pile["vars"], (string)'left', null) .
'; margin-top:1px; cursor:move; }
.document-en-mouvement { cursor:move; }


/* Types d\'affichages des listes de douments */
h3 .affichages {
	float:' .
table_valeur($Pile["vars"], (string)'right', null) .
';
}

.affichages .icone {
	width:16px;
	height:16px;
	margin:0;
	padding:2px;
	display:inline-block;
	background:rgba(255, 255, 255, 0.5) center center no-repeat;
	border-radius:3px;
	cursor:pointer;
}
.affichages .icone + .icone {
	margin-' .
table_valeur($Pile["vars"], (string)'left', null) .
':5px;
}
.affichages .icone.grand {
	background-image: url(' .
interdire_scripts(chemin_image('documents-liste-16.png')) .
');
}
.affichages .icone.liste {
	background-image: url(' .
interdire_scripts(chemin_image('documents-liste-courte-16.png')) .
');
}
.affichages .icone.cases {
	background-image: url(' .
interdire_scripts(chemin_image('documents-cases-16.png')) .
');
}
.affichages .icone.on {
	background-color:rgba(255, 255, 255, 0.9);
}
.affichages .icone.on:hover,
.affichages .icone:hover {
	background-color:rgba(255, 255, 255, 1);
}

/* Liste courte de documents */
.portfolios .documents_liste .item  {
	position:relative;
	padding:7px;
	display:flex;
}
.portfolios .documents_liste .item .vignette {
	width:65px;
	min-width: 65px;
}
.portfolios .documents_liste .item .vignette img {
	max-height: 36px;
	max-width:65px;
	height:auto;
	width:auto;
}
.portfolios .documents_liste .item .presentation {
	-webkit-box-align:center;
	    -ms-flex-align:center;
	        align-items:center;
	-webkit-box-flex:1;
	    -ms-flex-positive:1;
	        flex-grow:1;
	overflow:hidden;
}
.portfolios .item .descriptions {  overflow: hidden; }
.portfolios .documents_liste .item .infos,
.portfolios .documents_liste .item .descriptif,
.portfolios .documents_liste .item .mode,
.portfolios .documents_liste .item .actions > * {
	display:none;
}
.portfolios .documents_liste .item .titrem {
	margin-bottom:0;
}
.portfolios .documents_liste .item .titrem .fichier,
.portfolios .documents_liste .item .titrem .titre {
	max-height:2.4em;
	line-height:1.2em;
	overflow:hidden;
	white-space: nowrap;
	display:block;
	text-overflow:ellipsis; /* necessite des overflow:hidden; sur les parents */
}
.portfolios .documents_liste .item .actions {
	align-items:center;
	text-align:' .
table_valeur($Pile["vars"], (string)'right', null) .
';
	padding-' .
table_valeur($Pile["vars"], (string)'right', null) .
':0;
	min-width:80px;
}
.portfolios .documents_liste .item .actions .deplacer-modifier {
	display:inline-block;
	float:none;
	margin-' .
table_valeur($Pile["vars"], (string)'right', null) .
':0;
}
.documents_liste .deplacer-document-placeholder { height:40px; }


/* Grille en cases des documents. */
.portfolios .documents_cases .sortable {
	display:-webkit-box;
	display:-ms-flexbox;
	display:flex;
	-ms-flex-wrap: wrap;
	    flex-wrap: wrap;
}
.portfolios .documents_cases .item {
	padding: 2px;
	margin: 2px;
	border:1px solid #eee;
	border-radius:5px;
	width:113px;
	height:130px;
	display:-webkit-box;
	display:-ms-flexbox;
	display:flex;
	-webkit-box-orient:vertical;
	-webkit-box-direction:normal;
	    -ms-flex-direction:column;
	        flex-direction:column;
	-webkit-box-align:center;
	    -ms-flex-align:center;
	        align-items:center;
}
.portfolios .documents_cases .item .presentation { -webkit-box-flex:1; -ms-flex-positive:1; flex-grow:1; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; }
.portfolios .documents_cases .item .descriptions,
.portfolios .documents_cases .item .mode,
.portfolios .documents_cases .item .actions > * {
	display:none;
}
.portfolios .documents_cases .item .actions .deplacer-modifier  { display:block; width:100%;}
.portfolios .documents_cases .item .actions .editbox  { float:right; }
.documents_cases .deplacer-document-placeholder { height:130px; width:113px; padding: 2px; margin: 2px;}

.portfolios .documents_cases .item .vignette {
	width:auto;
	height:auto;
	min-width:auto;
}
.portfolios .documents_cases .item .vignette img {
	max-height: 95px;
	max-width:110px;
	width: auto;
	height: auto;
}

.portfolios .documents_cases .item .actions {
	display:block;
	width:100%;
	margin-bottom:0;
	box-sizing:border-box;
	padding: 2px 5px 1px 5px;
}
.portfolios .documents_cases .tout_supprimer {
	-ms-flex-preferred-size: 100%;
	    flex-basis: 100%;
}');

	return analyse_resultat_skel('html_795cf87c462b98c5cbb065c8f5729cee', $Cache, $page, '../plugins-dist/medias/prive/style_prive_plugin_medias.html');
}
?>