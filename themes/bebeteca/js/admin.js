(function($){

	"use strict";

	$(function(){

		$('#add_subtema').on('click', function (event) {
			event.preventDefault();
			var titulo     = $('#subtitulo').val();
			var contenido  = $('#contenido').val();
			var post_id    = $(this).data('post_id');
			var data_image = $('#contenedor-imagen img').attr('src');

			if ( data_image != '') {
				console.log(data_image);
				var image  = data_imagen_procesada(data_image);
			}else{
				var image = 'no-image';
				console.log(image);
			};


			if (titulo != '') {

				$.post(ajax_url, {
					titulo:    titulo,
					contenido: contenido,
					postid:   post_id,
					image: image,
					action: 'ajax_create_subpost'
				}, 'json').done(function (data) {
					location.reload();
				});

			}else{
				$('#subtitulo').attr('placeholder', 'Favor de llenar este campo para crear un subtema').focus();
			};

		});


		/**
		 * Procesa imagen para enviar por ajax
		 */
		function data_imagen_procesada(data_image){
				var data  = data_image.split(','),
					image = data[1];

				return image;
		}

		if (is_slide_post == '1') {
			$('#publishing-action #publish').attr('name', 'slide_post');
			$('#publishing-action #publish').attr('value', 'Actualizar');
		};



		// IMAGEN USER PIC ////////////////////////////////////////////////////////////////////////////////

		function guarda_imagen(data_image){
			var data    = data_image.split(','),
				image   = data[1];

			var user_id   = $('#bt-add-photo').data('user_id');
			var user_name = $('#bt-add-photo').data('user_name');
				console.log(user_id);
			$.post(ajax_url, {
	    		image: image,
	    		user_id: user_id,
	    		user_name: user_name,
	    		action: 'guardar_imagen'
	    	}, 'json').done(function (data){
	    		$('#bt-add-photo').empty().attr('style', 'height: auto; background: transparent; border: 0;').append('<img src="'+ data +'">');
			});
		}


		/**
		 * Despliega la imagen selecionada en el container indicado
		 */
		function display_file (input, container) {

			var reader = new FileReader();
			reader.onload = function(e){
				//$('#bt-add-photo').empty().attr('style', 'height: auto; background: transparent;').append('<img src="'+ e.target.result +'">');
				guarda_imagen(e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}


		$('#bt-add-photo').on('click', function () {
			$('#subir-foto-user').trigger('click');
		});

		$('#subir-foto-user').live('change', function (e) {

			display_file( this );

		});




		// GUARDAR IMAGEN SUB POST ////////////////////////////////////////////////////////////////


		/**
		 * Despliega la imagen selecionada en el container indicado
		 */
		function display_file_post (input, container) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#contenedor-imagen').empty().append('<img src="'+ e.target.result +'">');
			};
			reader.readAsDataURL(input.files[0]);
		}



		$('#add-image-post').on('click', function (event) {
			event.preventDefault();
			$('#subir-foto-subtema').trigger('click');
		});

		$('#subir-foto-subtema').live('change', function (e) {

			display_file_post (this);

		});

	});

})(jQuery);
