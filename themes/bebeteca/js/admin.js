(function($){

	"use strict";

	$(function(){

		$('#add_subtema').on('click', function (event) {
			event.preventDefault();
			var titulo    = $('#subtitulo').val();
			var contenido = $('#contenido').val();
			var post_id   = $(this).data('post_id');
			console.log(titulo);
			if (titulo != '') {

				$.post(ajax_url, {
					titulo:    titulo,
					contenido: contenido,
					postid:   post_id,
					action: 'ajax_create_subpost'
				}, 'json').done(function (data) {
					location.reload();
				});

			}else{
				$('#subtitulo').attr('placeholder', 'Favor de llenar este campo para crear un subtema').focus();
			};

		});


		if (is_slide_post == '1') {
			$('#publishing-action #publish').attr('name', 'slide_post');
			$('#publishing-action #publish').attr('value', 'Actualizar');
		};


	});

})(jQuery);
