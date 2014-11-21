(function($){

	"use strict";

			$(function(){
		/*
			888                                 888                        888
			888                                 888                        888
			888                                 888                        888
			888  8888b.  88888888 888  888      888  .d88b.   8888b.   .d88888
			888     "88b    d88P  888  888      888 d88""88b     "88b d88" 888
			888 .d888888   d88P   888  888      888 888  888 .d888888 888  888
			888 888  888  d88P    Y88b 888      888 Y88..88P 888  888 Y88b 888
			888 "Y888888 88888888  "Y88888      888  "Y88P"  "Y888888  "Y88888
									   888
								  Y8b d88P
								   "Y88P"
		*/


		window.Eventos = {};

		/**
		 * DOM Element (div) que contiene todos los posts (eventos)
		 *
		 * @type DOM Element
		 */
		Eventos.container_actividad = $('.lazy-container');

		/**
		 * Esta variable contiene el ofsset que se debe renderear.
		 *
		 * @type integer
		 */
		Eventos.offset = 0;


		Eventos.estatus = true;



		/**
		 * Trae los elementos siguientes
		 */
		Eventos.ajax_category = function (offset, term_id)
		{

			Eventos.offset = Eventos.offset + offset;

			$.post(ajax_url, {
				offset: Eventos.offset,
				term_id: term_id,
				exclude: excluir,
				action: 'ajax_lazy_category'
			}, 'json').done(function (data){

				if ( data == 'nada') Eventos.unbind();

				if ( data != 'nada') {

					Eventos.displayLoader();

					for (var i = 0; i < data.length; i++) {

						Eventos.render_posts(data[i]);
						$('.loading-eventos').remove();

					};
				};

			});

			Eventos.reloadScripts();

		}


		/**
		 * Trae los elementos siguientes
		 */
		Eventos.ajax_home = function (offset)
		{
			Eventos.offset = Eventos.offset + offset;

			$.post(ajax_url, {
				offset: Eventos.offset,
				exclude: excluir,
				action: 'ajax_lazy_home'
			}, 'json').done(function (data){

				if ( data == 'nada') Eventos.unbind();

				if ( data != 'nada') {

					Eventos.displayLoader();

					for (var i = 0; i < data.length; i++) {

						Eventos.render_posts(data[i]);
						$('.loading-eventos').remove();

					};
				};


			});

			Eventos.reloadScripts();

		}


		/**
		 * Trae los elementos siguientes de cupones
		 */
		Eventos.ajax_cupones = function (offset)
		{
			Eventos.offset = Eventos.offset + offset;

			$.post(ajax_url, {
				offset: Eventos.offset,
				exclude: excluir,
				action: 'ajax_lazy_cupones'
			}, 'json').done(function (data){

				if ( data == 'nada') Eventos.unbind();

				if ( data != 'nada') {

					Eventos.displayLoader();

					for (var i = 0; i < data.length; i++) {

						Eventos.render_posts(data[i]);
						$('.loading-eventos').remove();

					};
				};


			});

			Eventos.reloadScripts();

		}


		/**
		 * Coloca los siguientes eventos
		 *
		 * @return Object
		 */
		Eventos.loadMoreContent = function (ancho)
		{
			var page = $('.lazy-container').data('page');
			var offset = $('.lazy-container').data('offset');
		 	if (page == 'home') {
		 		Eventos.ajax_home(offset);
		 	}else if(page == 'category'){
		 		var term_id = $('.lazy-container').data('term_id');
		 		Eventos.ajax_category(offset, term_id);
		 	}else if(page == 'cupones'){
		 		Eventos.ajax_cupones(offset);
		 	}

		};




		/**
		 * Despliega el tema del usuario dentro del contenedor
		 * @return {[type]} [description]
		 */
		Eventos.render_posts = function (post)
		{
			var style = '';
			if( $(window).width() < 728 ){
				var tamano = $('.img-medida').height();
				style = 'style="min-height: '+tamano+'px;"';
			}

			var categoria = $('.lazy-container').data('cat');
			var span_cat = '<span class="titulo1 no-mobile pleca-'+post.slug_cat+'">'+post.name_cat+'</span>';
			var franja = post.slug_cat;
			if (categoria == 'entrevistas') {
				span_cat = '';
				franja = 'entrevistas';
			};
			var content = '<article class="entero article-gral">'+
							'<a href="'+post.url+'">'+
								span_cat+
								'<img src="'+post.img1+'" class="img-gral1">'+
								'<img src="'+post.img2+'" class="img-gral2 img-resp">'+
								'<div class="cont-info-gral" '+style+'>'+
									'<span class="franja si-mobile franja-'+franja+'"></span>'+
									'<h4>'+post.titulo+'</h4>'+
									'<p class="no-tablet">'+post.contenido+'</p>'+
								'</div>'+
								'<div class="extras">'+
									'<span class="compartir"></span><p>'+post.shares+'</p>'+
								'</div>'+
							'</a>'+
							'</article>';
			Eventos.container_actividad.append( content );

		};


		/**
		 * Despliega el tema del agendado dentro del contenedor
		 * @return {[type]} [description]
		 */
		Eventos.render_actividad_agendo = function (user_id, post_id)
		{
			$.post(ajax_url, {
				user_id : user_id,
				post_id : post_id,
				action: 'ajax_render_agendo'
			}, 'json').done(function (content){
				Eventos.container_actividad.append( content );
			});
		};


		/**
		 * Muestra un loader para informar al usuario que se esta cargando el contenido.
		 * Tambien evita que se disparen multiples eventos el mismo tiempo.
		 */
		Eventos.displayLoader = function ()
		{
			var imageLoader = $('<img />', {
				src : image_url+'loading.gif'
			});

			this.container_actividad
				.last('.evento')
				.append( $('<div></div>', {
					'class'  : 'loading-eventos',
					'html'   : imageLoader,
					'height' : '200px'
				})
			);

		};

		/**
		 * Vuelve a cargar los scripts necesarios.
		 */
		Eventos.reloadScripts = function ()
		{



		};

		/**
		 * Unbind window scroll event.
		 * Evita que se sigan haciendo peticiones al servidor
		 */
		Eventos.unbind = function ()
		{
			$(window).unbind('scroll');
		};

		/**
		 * Bind the scroll event to the window.
		 * and trigger loadMoreEvents when user reaches bottom of the page.
		 */
		 var elements = document.getElementsByClassName('lazy-container');
		 if (elements.length != 0 && is_device == 'phone') {
		 	$(window).on('scroll', function(){

				var win = $(window);

				if (win.height() + win.scrollTop() == $(document).height()) {
					var ancho = $(window).width();

					Eventos.loadMoreContent(ancho);

				}else{

				}

			});
		};



	});

})(jQuery);
