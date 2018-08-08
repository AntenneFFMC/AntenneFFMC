/**
 * autosave plugin
 *
 * Copyright (c) 2009-2016 Fil (fil@rezo.net)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/*
 * Usage: $("form").autosave({options...});
 * to use with SPIP's action/session.php
 */

(function($){
	$.fn.autosave = function(opt) {
		opt = $.extend({
			url: window.location,
			confirm: false,
			confirmstring: 'Sauvegarder ?'
		},opt);
		var save_changed = function(){
			$('form.autosavechanged')
			.each(function(){
				if (!opt.confirm || confirm(opt.confirmstring)) {
					var contenu = $(this).serialize();
					// ajoutons un timestamp
					var d=new Date();
					contenu = contenu + "&__timestamp=" + Math.round(d.getTime()/1000);
					$.post(opt.url, {
						'action': 'session',
						'var': 'autosave_' + $('input[name=autosave]', this).val(),
						'val': contenu
					});
				}
			}).removeClass('autosavechanged');
		}
		$(window).on('unload', save_changed);
		return this
			.on('keyup', function() {
				$(this).addClass('autosavechanged');
			})
			.on('change', function() {
				$(this).addClass('autosavechanged');
				save_changed();
			})
			.on('submit',function() {
				save_changed();
				/* trop agressif : exemple du submit previsu forum, ou des submit suivant/precedent d'un cvt multipage
				on sauvegarde toujours, et le serveur videra quand il faudra */
				/*$(this).removeClass('autosavechanged')*/;
			});
	}
})(jQuery);

