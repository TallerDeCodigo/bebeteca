(function($){

	"use strict";

	$(function(){

		$('#add_subtema').on('click', function (event) {
			event.preventDefault();
			var titulo    = $('#subtitulo').val();
			var contenido = $('#contenido').val();
			var post_id   = $(this).data('post_id');

			$.post(ajax_url, {
				titulo:    titulo,
				contenido: contenido,
				post_id:   post_id,
				action: 'ajax_create_subpost'
			}, 'json').done(function (data) {
				location.reload();
			});

		});

	});

})(jQuery);
