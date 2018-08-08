<?php

/*
 * Squelette : ../plugins-dist/medias/javascript/gestion_listes_documents.js.html
 * Date :      Wed, 14 Mar 2018 16:28:00 GMT
 * Compile :   Tue, 07 Aug 2018 17:27:48 GMT
 * Boucles :   
 */ 
//
// Fonction principale du squelette ../plugins-dist/medias/javascript/gestion_listes_documents.js.html
// Temps de compilation total: 0.938 ms
//

function html_3c9dd12da9d5bb200afdd8a96a09efdf($Cache, $Pile, $doublons = array(), $Numrows = array(), $SP = 0) {

	if (isset($Pile[0]["doublons"]) AND is_array($Pile[0]["doublons"]))
		$doublons = nettoyer_env_doublons($Pile[0]["doublons"]);

	$connect = '';
	$page = (
'<'.'?php header(' . _q((	'Content-Type: text/javascript; charset=' .
	interdire_scripts($GLOBALS['meta']['charset']))) . '); ?'.'>' .
'

/* Choix du mode affichage des documents (grand, en case, en liste courte) */
function choix_affichages_documents() {
	$(\'.portfolios h3:not(:has(.affichages))\').each(function () {
		var titre = $(this);
		var liste = titre.next(\'.liste_items.documents\');
		var identifiant = liste.data(\'cookie-affichage\');

		titre.append(
			"<div class=\'affichages\'>"
			+ "<span class=\'icone grand on\' title=\'' .
attribut_html(_T('medias:affichage_documents_en_grand')) .
'\'></span>"
			+ "<span class=\'icone cases\' title=\'' .
attribut_html(_T('medias:affichage_documents_en_cases')) .
'\'></span>"
			+ "<span class=\'icone liste\' title=\'' .
attribut_html(_T('medias:affichage_documents_en_liste_compacte')) .
'\'></span>"
			+ "</div>"
		);

		var changer_affichage_documents = function (me, bouton, classe) {
			$(me).parent().find(\'.icone\').removeClass(\'on\').end().end().addClass(\'on\');
			var liste = $(me).parents(\'h3\').next(\'.liste_items.documents\');
			liste.removeClass(\'documents_cases\').removeClass(\'documents_liste\');
			if (classe) {
				liste.addClass(classe);
			}
			if (identifiant) {
				Cookies.set(\'affichage-\' + identifiant, bouton);
			}

			liste.trigger(\'affichage.documents.change\', {
				\'liste\': liste,
				\'icone\': me,
				\'bouton\': bouton,
				\'classe\': classe,
				\'identifiant\': identifiant
			});

		};

		titre.find(\'.affichages > .grand\').click(function () {
			changer_affichage_documents(this, \'grand\', null);
		});

		titre.find(\'.affichages > .cases\').click(function () {
			changer_affichage_documents(this, \'cases\', \'documents_cases\');
		});

		titre.find(\'.affichages > .liste\').click(function () {
			changer_affichage_documents(this, \'liste\', \'documents_liste\');
		});

		if (identifiant) {
			var defaut = Cookies.get(\'affichage-\' + identifiant);
			if (defaut) {
				titre.find(\'.affichages > .\' + defaut).trigger(\'click\');
			}
			liste.trigger(\'affichage.documents.charge\', {
				\'liste\': liste,
				\'identifiant\': identifiant,
				\'defaut\': defaut
			});
		}
	});
}

/* Gestion du tri des listes de documents et de leur enregistrement */
function ordonner_listes_documents() {
	if ($.fn.sortable) {
		$(".liste_items.documents.ordonner_rang_lien[data-lien]").find(\'> .sortable\').each(function () {
			// détruire / recréer le sortable à chaque appel ajax
			if ($(this).has(\'.ui-sortable\').length) {
				$(this).sortable(\'destroy\');
			}
			// pas de tri possible s\'il n\'y a qu\'un seul élément.
			if ($(this).find(\'> .item\').length < 2) {
				$(this).find(\'.deplacer-document\').hide();
				return true; // continue
			} else {
				$(this).find(\'.deplacer-document\').show();
			}
			$(this).sortable({
				/*axis: "y",*/ /* minidoc a un affichage en case */
				handle: "",
				placeholder: "ui-state-highlight deplacer-document-placeholder",
				cancel: \'img.croix_centre_image\',
				start: function(event, ui) {
					ui.item.addClass(\'document-en-mouvement\');
				},
				stop: function(event, ui) {
					ui.item.removeClass(\'document-en-mouvement\');
				},
				update: function (event, ui) {
					var items = $(this);
					var item = ui.item;
					var liste = items.sortable(\'toArray\');
					var ordre = [];

					$.each(liste, function(i, id) {
						if (id) {
							ordre.push( id.substring(3) ); // doc123 => 123
						}
					});
					
					// l\'objet lié est indiqué dans l\'attribut data-lien sur la liste
					var lien = items.parents(".liste_items.documents").data("lien").split("/");
					var objet_lie = lien[0];
					var id_objet_lie = lien[1];
					var action = \'' .
generer_url_action('ordonner_liens_documents','','1') .
'\';
					var params = {
						objet_source: \'document\',
						objet_lie: objet_lie,
						id_objet_lie: id_objet_lie,
						ordre: ordre,
					};

					item.animateLoading();

					$.ajax({
						url: action,
						data: params,
						dataType: \'json\',
						cache: false,
					}).done(function(data) {

						var couleur_origine = item.css(\'background-color\');
						var couleur_erreur = $("<div class=\'remove\'></div>").css(\'background-color\');
						var couleur_succes = $("<div class=\'append\'></div>").css(\'background-color\');
						item.endLoading(true);

						if (data.errors.length) {
							items.sortable(\'cancel\');
							item.css({backgroundColor: couleur_erreur}).animate({backgroundColor: couleur_origine}, \'normal\', function(){
								item.css({backgroundColor: \'\'});
							});
						} else {
							item.css({backgroundColor: couleur_succes}).animate({backgroundColor: couleur_origine}, \'normal\', function(){
								item.css({backgroundColor: \'\'});
							});
							items.parent().find(\'.tout_desordonner\').show();
						}
					});
				}
			});
			// bouton "désordonner"
			if ($(this).parent().find(\'.deplacer-document[data-rang!=0]\').length) {
				$(this).parent().find(\'.tout_desordonner\').show();
			} else {
				$(this).parent().find(\'.tout_desordonner\').hide();
			}
		});
	}
}

/* Recharger le conteneur des listes de documents si l\'une d\'elle est vide */
function check_reload_page(){
	var reload = false;
	$(\'.portfolios\').each(function(){
		$(this).find(\'.liste-items.documents\').each(function() {
			if ($(this).length && !$(this).find(\'.item\').length) {
				$(this).parents(\'.portfolios\').ajaxReload();
				reload = true;
				return false; // break each
			}
		});
	});
	if (reload) {
		jQuery(\'#navigation .box.info\').ajaxReload();
	}
}

/* Initialisation et relance en cas de chargement ajax */
if (window.jQuery) {
	jQuery(function($){
		if (!$.js_portfolio_documents_charge) {
			$.js_portfolio_documents_charge = true;
			onAjaxLoad(check_reload_page);
			choix_affichages_documents();
			onAjaxLoad(choix_affichages_documents);
			ordonner_listes_documents();
			onAjaxLoad(ordonner_listes_documents);
		}
	});
}');

	return analyse_resultat_skel('html_3c9dd12da9d5bb200afdd8a96a09efdf', $Cache, $page, '../plugins-dist/medias/javascript/gestion_listes_documents.js.html');
}
?>