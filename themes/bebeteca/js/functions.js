(function($){

	"use strict";

	$(function(){


		/**
		* SLIDE HOME
		**/
		$("#slider-principal").tinycarousel({
			bullets : true,
			interval: true,
			intervalTime : 3000
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




	});

})(jQuery);
