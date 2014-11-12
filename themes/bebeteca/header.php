<!doctype html>
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<link rel="icon" href="<?php echo THEMEPATH; ?>images/favicon.ico" sizes="32x32">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="cleartype" content="on">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


		<script type='text/javascript'>
			var googletag = googletag || {};
			googletag.cmd = googletag.cmd || [];
			(function() {
			var gads = document.createElement('script');
			gads.async = true;
			gads.type = 'text/javascript';
			var useSSL = 'https:' == document.location.protocol;
			gads.src = (useSSL ? 'https:' : 'http:') +
			'//www.googletagservices.com/tag/js/gpt.js';
			var node = document.getElementsByTagName('script')[0];
			node.parentNode.insertBefore(gads, node);
			})();
		</script>

		<script type='text/javascript'>
			googletag.cmd.push(function() {
				googletag.defineSlot('/38946695/Bebeteca_Footer_Leaderboard', [728, 90], 'div-gpt-ad-1413996590367-0').addService(googletag.pubads());
				googletag.defineSlot('/38946695/Bebeteca_Header_Leaderboard', [728, 90], 'div-gpt-ad-1413996590367-1').addService(googletag.pubads());
				googletag.defineSlot('/38946695/LaBebeteca_Home_BoxBanner_Bottom', [300, 250], 'div-gpt-ad-1413996590367-2').addService(googletag.pubads());
				googletag.defineSlot('/38946695/LaBebeteca_Home_BoxBanner_Top', [300, 250], 'div-gpt-ad-1413996590367-3').addService(googletag.pubads());
				googletag.pubads().enableSingleRequest();
				googletag.enableServices();
			});
		</script>
		<?php wp_head(); ?>
	</head>

	<body>
		<!--[if lt IE 9]>
			<p class="chromeframe">Estás usando una versión <strong>vieja</strong> de tu explorador. Por favor <a href="http://browsehappy.com/" target="_blank"> actualiza tu explorador</a> para tener una experiencia completa.</p>
		<![endif]-->

		<div id="fb-root"></div>

		<div class="fondo-pop"></div>
		<div class="pop-registrarse">
			<form id="form-registrate">
				<h5>Regístrate</h5>
				<input id="form-registrate-nombre" name="registrate-nombre" placeholder="Nombre" >
				<input id="form-registrate-email" name="registrate-email" placeholder="email" >
				<input type="password" id="form-registrate-password" name="registrate-password" placeholder="Contraseña" >
				<input type="password" id="form-registrate-password" name="registrate-password" placeholder="Repetir contraseña" >
				<input class="enviar" type="submit" name="submit" value="Registrar">

			</form>

			<form id="form-login">
				<h5>Iniciar sesión</h5>
				<input id="form-login-nombre" name="login-usuario" placeholder="email / número de socio" >
				<input type="password" id="form-login-password" name="login-password" placeholder="contraseña" >
				<a href="">Olvide mi contraseña</a>
				<input class="enviar" type="submit" name="submit" value="Iniciar sesión">

			</form>
		</div>

		<div class="content-header">
			<header class="border-radius">
				<img src="<?php echo THEMEPATH; ?>images/bt_mnu.png" class="bt-mnu-responsive">

				<?php $etiqueta = is_single() ? 'h2' : 'h1'; ?>
				<<?php echo $etiqueta; ?> class="logo"><a href="<?php echo site_url('/') ?>">La Bebeteca</a></h1>

				<span class="bt-search-responsive"></span>

				<div class="top-header">
					<span>Visítanos</span>
					<ul class="redes-sociales">
						<li class="b-fb"><a href="https://www.facebook.com/labbteca">faceboock</a></li>
						<li class="b-tw"><a href="https://twitter.com/la_bebeteca">twitter</a></li>
						<li class="b-gm"><a href="https://plus.google.com/116499142736660749871/about">google +</a></li>
					</ul>

					<div class="boton abre-pop-registro non-visible">Registrate</div>
					<div class="boton abre-pop-registro non-visible">Inicia Sesión</div>
					<form class="forma-buscar" method="GET" action="<?php echo site_url('/') ?>">
						<input type="text" name="s" value="" placeholder="Buscar" >
						<input type="submit" value="Buscar">
					</form>
				</div>

				<nav id="main-menu">
					<ul>
						<li class="bg-embarazo boton <?php nav_is('embarazo');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/embarazo/'); ?>" data-mnu="embarazo">Embarazo</a>
							<div class="submenu border-radius sub-embarazo">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'name', 'embarazo', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable; ?>
								</ul>
								<?php $cat_embarazo = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'embarazo') );

								if ( $cat_embarazo->have_posts() ) : while( $cat_embarazo->have_posts() ) : $cat_embarazo->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>
						<li class="bg-nacimiento boton <?php nav_is('nacimiento');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/nacimiento/'); ?>" data-mnu="nacimiento">Nacimiento</a>
							<div class="submenu border-radius sub-nacimiento">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'name', 'nacimiento', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable;?>
								</ul>
								<?php $cat_nacimiento = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'nacimiento') );

								if ( $cat_nacimiento->have_posts() ) : while( $cat_nacimiento->have_posts() ) : $cat_nacimiento->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>
						<li class="bg-dia-a-dia boton <?php nav_is('dia-a-dia');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/dia-a-dia/'); ?>" data-mnu="dia-a-dia">Día a Día</a>
							<div class="submenu border-radius sub-dia-a-dia">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'slug', 'dia-a-dia', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable;?>
								</ul>
								<?php $cat_dia_a_dia = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'dia-a-dia') );

								if ( $cat_dia_a_dia->have_posts() ) : while( $cat_dia_a_dia->have_posts() ) : $cat_dia_a_dia->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>
						<li class="bg-estimulacion boton <?php nav_is('estimulacion');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/estimulacion/'); ?>" data-mnu="estimulacion">Estimulación</a>
							<div class="submenu border-radius sub-estimulacion">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'name', 'estimulacion', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable; ?>
								</ul>
								<?php $cat_estimulacion = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'estimulacion') );

								if ( $cat_estimulacion->have_posts() ) : while( $cat_estimulacion->have_posts() ) : $cat_estimulacion->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>


						<li class="bg-lactancia boton <?php nav_is('lactancia');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/lactancia/'); ?>" data-mnu="lactancia">Lactancia</a>
							<div class="submenu border-radius sub-lactancia">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'name', 'lactancia', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable; ?>
								</ul>
								<?php $cat_lactancia = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'lactancia') );

								if ( $cat_lactancia->have_posts() ) : while( $cat_lactancia->have_posts() ) : $cat_lactancia->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>

						<li class="bg-entrevistas boton <?php nav_is('entrevistas');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/entrevistas/'); ?>" data-mnu="entrevistas">Entrevistas</a>
							<div class="submenu border-radius sub-entrevistas">
								<ul class="subcategorias">
									<?php $term = get_term_by( 'name', 'entrevistas', 'category' );
									$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
									$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
									echo $variable;?>
								</ul>
								<?php $cat_entrevistas = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post_status' => 'publish', 'category_name' => 'entrevistas') );

								if ( $cat_entrevistas->have_posts() ) : while( $cat_entrevistas->have_posts() ) : $cat_entrevistas->the_post(); ?>
									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>
						<li class="bg-promociones boton ultimo-fila <?php nav_is('promociones');?>"><a class="mnu-a" href="<?php echo site_url('/promociones/'); ?>">Cupones</a>
							<div class="submenu border-radius">
								<ul class="subcategorias">

								</ul>
								<?php $promociones = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('promociones'), 'post_status' => 'publish') );

								if ( $promociones->have_posts() ) : while( $promociones->have_posts() ) : $promociones->the_post(); ?>

									<div class="post-rel">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('articulos-gral'); ?>
											<h4><?php the_title(); ?></h4>
											<!-- <p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p> -->
										</a>
									</div>

								<?php endwhile; endif; wp_reset_postdata(); ?>

							</div>
						</li>
					</ul>
				</nav>
			</header>
		</div><!-- FIN HEADER -->

		<div class="container clearfix">

			<div class="banner-top">
				<!-- Bebeteca_Header_Leaderboard -->
				<div id='div-gpt-ad-1413996590367-1' style='width:728px; height:90px;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1413996590367-1'); });
					</script>
				</div>
			</div>
