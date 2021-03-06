(function($){

	"use strict";

	$(function(){

		$('.flexslider').flexslider({
			 animation: "slide"
		});


		$(".cont-single").fitVids();

		/**
		 * Regresa todos los valores de un formulario como un associative array
		 */
		window.getFormData = function (selector) {
			var result = [],
				data   = $(selector).serializeArray();

			$.map(data, function (attr) {
				result[attr.name] = attr.value;
			});
			return result;
		}


		/**
		* SLIDE HOME
		**/
		$("#slider-principal").tinycarousel({
			bullets : true,
			interval: true,
			intervalTime : 5000
		});



		// ENVIA INFORMACION DEL FORMULARIO DE CONTACTO ////////////////////////////////////////////////////////////


		/*
		* SUBIT FORM CONTACTO
		*/
		$('#form_contacto').on('submit', function (event) {
			event.preventDefault();
			var nombre  = $('#form-contacto-nombre').val();
			var email   = $('#form-contacto-email').val();
			var mensaje = $('#form-contacto-mensaje').val();

			if( ! validateEmail(email)){
				alert('El campo de mail no es valido');
				$('#form-contacto-email').focus();
			}else{
				$.post(ajax_url,{
					nombre   : nombre,
					email    : email,
					mensaje  : mensaje,
					action   : 'ajax_resive_info_contacto'
				}, 'json')
				.done(function (data){
					window.location.reload();
				});
			}

		});


		/*
		* SUBIT NEWSLETTER
		*/
		$('#form-newsletter').on('submit', function (event) {
			event.preventDefault();
			var email = $('#news-email').val();

			if( ! validateEmail(email)){
				alert('El mail '+email+' no es valido');
				$('#news-email').focus();
			}else{
				$.post(ajax_url,{
					email    : email,
					action   : 'ajax_resive_mail_newsletter'
				}, 'json')
				.done(function (data){
					if (data == 1){
						 window.location.replace(site_url+'newsletter');
					}else{
						alert(data);
					};
				});
			}

		});



		/*
		* SUBIT NEWSLETTER
		*/
		$('#form-newsletter-footer').on('submit', function (event) {
			event.preventDefault();
			var email = $('#news-email-fo').val();

			if( ! validateEmail(email)){
				alert('El mail '+email+' no es valido');
				$('#news-email-fo').focus();
			}else{
				$.post(ajax_url,{
					email    : email,
					action   : 'ajax_resive_mail_newsletter'
				}, 'json')
				.done(function (data){
					if (data == 1){
						 window.location.replace(site_url+'newsletter');
					}else{
						alert(data);
					};
				});
			}

		});


		function ajax_mail_newsletter(email){
			$.post(ajax_url,{
				email    : email,
				action   : 'ajax_resive_mail_newsletter'
			}, 'json')
			.done(function (data){
				if (data == 1){
					 // window.location.replace(site_url+'newsletter');

					alert('Te hemos enviado un correo electrónico para confirmar tu registro.')
				}else{
					alert(data);
				};
			});
		}

		/**
		 * VALIDA QUE EL EMAIL SEA CORRECTO
		 */
		function validateEmail (email) {
			var regExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return regExp.test(email);
		}


		/**
		 * SIGUIENDO SIDEBAR
		 */
		$('.redes-siguenos li.fb').on('click', function (event) {
			event.preventDefault();
			$('.bt-siguenos.fb').fadeIn(0);
			$('.bt-siguenos.tw').fadeOut(0);
			$('.bt-siguenos.gm').fadeOut(0);
			$('.redes-siguenos li').removeClass('active-red');
			$(this).addClass('active-red');
		});

		$('.redes-siguenos li.tw').on('click', function (event) {
			event.preventDefault();
			$('.bt-siguenos.fb').fadeOut(0);
			$('.bt-siguenos.tw').fadeIn(0);
			$('.bt-siguenos.gm').fadeOut(0);
			$('.redes-siguenos li').removeClass('active-red');
			$(this).addClass('active-red');
		});

		$('.redes-siguenos li.gm').on('click', function (event) {
			event.preventDefault();
			$('.bt-siguenos.fb').fadeOut(0);
			$('.bt-siguenos.tw').fadeOut(0);
			$('.bt-siguenos.gm').fadeIn(0);
			$('.redes-siguenos li').removeClass('active-red');
			$(this).addClass('active-red');
		});




		/**
		 * CODIGO SHARE FACEBOOK
		 */
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s);
		  js.id = id;
		  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=692635144113519&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));


		/**
		 * CODIGO SHARE TWEET
		 */
		!function(d,s,id){
			var js,
				fjs=d.getElementsByTagName(s)[0],
				p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){
				js=d.createElement(s);
				js.id=id;
				js.src=p+'://platform.twitter.com/widgets.js';
				fjs.parentNode.insertBefore(js,fjs);
			}
		}(document, 'script', 'twitter-wjs');


		/**
		 * CODIGO SHARE GOGGLE +
		 */
		window.___gcfg = {lang: 'es-419'};

		(function() {
			var po = document.createElement('script');
			po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/platform.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(po, s);
		  })();

		$('.abre-pop-registro').on('click', function (event) {
			event.preventDefault();
			$('.fondo-pop').fadeIn(750);
			$('.pop-registrarse').fadeIn(750);
		});

		$('.fondo-pop').on('click', function () {
			$('.fondo-pop').fadeOut(750);
			$('.pop-registrarse').fadeOut(750);
		});


		/**
		 * RESALTAR PALABRA BUSCADA
		 */

		$.fn.extend({
			resaltar: function(busqueda, claseCSSbusqueda){
				var regex = new RegExp("(<[^>]*>)|("+ busqueda.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', 'ig');
				var nuevoHtml=this.html(this.html().replace(regex, function(a, b, c){
					return (a.charAt(0) == "<") ? a : "<span class=\""+ claseCSSbusqueda +"\">" + c + "</span>";
				}));
				return nuevoHtml;
			}
		});

		if (is_search == 1) {
			$(".search-main").resaltar(get,"resaltarTexto");
		};

		$('.share_post_by_mail').on('click', function(e){
			console.log('lol catz');
			e.preventDefault();

			$(this).parent().find('.mail_pop').fadeIn('fast');
		});

		$('.mail_pop').on('submit', function(e){
			e.preventDefault();

			$(this).parent().find('#mail_pop').fadeIn('fast');
			var form_data =  getFormData($(this));

			$.post(ajax_url,{
				username  	  : form_data.username,
				sender_email  : form_data.sender_email,
				recipient     : form_data.recipient,
				post_id  	  : form_data.post_id,
				message  	  : form_data.message,
				action   	  : 'ajax_send_post_by_mail'
			}, 'json')
			.done(function (data){
				console.log(data);
				$('.mail_pop').fadeOut('fast');
			})
			.fail(function (a,b,c){
				console.log(a);
				console.log(b);
				console.log(c);
			});
		});


		/***	RESPONSIVE ***/

		$('.bt-search-responsive').on('click', function (event) {
			event.preventDefault();

			if( $(this).hasClass('active') ){
				$('header .top-header').fadeOut(750);
				$(this).removeClass('active');
			}else{
				$('header .top-header').fadeIn(750);
				$(this).addClass('active');
				$('.bt-mnu-responsive').removeClass('mb-mnu-active', 750, "easeOutBounce");
				$('#main-menu').removeClass('visible', 750, "easeOutBounce");
				$('.content-header').removeClass('fix-head');
				$('body').css({'overflow': 'auto'});
			}


		});

		$( window ).load(function() {
			$('.cont-info-gral').not( '.primer_content' ).removeAttr('style');

		 	if( $(window).width() < 728 ){
				$('.article-gral').not( '.primer_post' ).each(function( index ) {
					var tam_papa = $(this).children('a').children('.img-resp').height();

					$(this).children('a').children('.cont-info-gral').css({'min-height':tam_papa });
					$('.primer_content' ).removeAttr('style');


				});

				/* BANNERS */

				$('.banner-aside-1').children('div').appendTo('.banner5-resp');
				googletag.cmd.push(googletag.pubads().refresh());

				$('.banner-aside-2').children('div').appendTo('.banner9-resp');
				googletag.cmd.push(googletag.pubads().refresh());
			}else{
				$('#main-menu').removeClass('visible');
				$('.content-header').removeClass('fix-head');
				$('.cont-info-gral, .submenu').not( '.primer_content' ).removeAttr('style');

				/* BANNERS */
				$('.banner5-resp').children('div').appendTo('.banner-aside-1');
				googletag.cmd.push(googletag.pubads().refresh());

				$('.banner9-resp').children('div').appendTo('.banner-aside-2');
				googletag.cmd.push(googletag.pubads().refresh());
			}

		});



		$(window).resize(function(){
			$('.cont-info-gral').not( '.primer_content' ).removeAttr('style');
			if( $(window).width() < 728 ){
				$('.article-gral').not( '.primer_post' ).each(function( index ) {
					var tam_papa = $(this).children('a').children('.img-resp').height();

					$(this).children('a').children('.cont-info-gral').css({'height':tam_papa });
					$('.primer_content' ).removeAttr('style');

				});

				/* BANNERS */
				$('.banner-aside-1').children('div').appendTo('.banner5-resp');
				googletag.cmd.push(googletag.pubads().refresh());

				$('.banner-aside-2').children('div').appendTo('.banner9-resp');
				googletag.cmd.push(googletag.pubads().refresh());
			}else{
				$('#main-menu').removeClass('visible');
				$('.content-header').removeClass('fix-head');
				$('.cont-info-gral, .submenu').not( '.primer_content' ).removeAttr('style');

				/* BANNERS */
				$('.banner5-resp').children('div').appendTo('.banner-aside-1');
				googletag.cmd.push(googletag.pubads().refresh());

				$('.banner9-resp').children('div').appendTo('.banner-aside-2');
				googletag.cmd.push(googletag.pubads().refresh());
			}

		});


		/**
		 * ABRE MENU RESPONSIVE
		 */
		$('.bt-mnu-responsive').on('click', function (event) {
			event.preventDefault();
			if($(this).hasClass('mb-mnu-active')){
				$(this).removeClass('mb-mnu-active', 750, "easeOutBounce");
				$('#main-menu').removeClass('visible', 750, "easeOutBounce");
				$('.content-header').removeClass('fix-head');
				$('body').css({'overflow': 'auto'});
			}else{
				$(this).addClass('mb-mnu-active', 750, "easeOutBounce");
				$('.content-header').addClass('fix-head');
				$('#main-menu').addClass('visible', 750, "easeOutBounce");
				$('body').css({'overflow': 'hidden'});
				$('header .top-header').fadeOut(750);
				$('.bt-search-responsive').removeClass('active');
			}
		});

		$(document).on('click','#main-menu.visible ul li a.mnu-a', function (event) {
			event.preventDefault();
			var submnu = $(this).data('mnu');
			$('.submenu').fadeOut(0);
			$('.sub-'+submnu).toggle(750);
		});



		if (is_device == 'tablet' || is_device == 'phone' ) {
			$(document).on('click','#main-menu ul li .mnu-a', function (event) {
				event.preventDefault();
			});
		};


	});

})(jQuery);
