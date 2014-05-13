<!doctype html>
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>images/favicon.ico">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<?php wp_head(); ?>
	</head>

	<body>
		<!--[if lt IE 9]>
			<p class="chromeframe">Estás usando una versión <strong>vieja</strong> de tu explorador. Por favor <a href="http://browsehappy.com/" target="_blank"> actualiza tu explorador</a> para tener una experiencia completa.</p>
		<![endif]-->
		<div class="content-header">
			<header class="border-radius">
				<h1 class="logo"><a href="<?php echo site_url('/') ?>">La Bebeteca</a></h1>
				<div class="top-header">
					<span>Visítanos</span>
					<ul class="redes-sociales">
						<li class="b-fb"><a href="">faceboock</a></li>
						<li class="b-tw"><a href="">twitter</a></li>
						<li class="b-gm"><a href="">google +</a></li>
					</ul>
					<div class="boton">Registrate</div>
					<div class="boton">Inicia Sesión</div>
					<form class="forma-buscar" method="GET" action="<?php echo site_url('/') ?>">
						<input type="text" name="s" value="" placeholder="Buscar" >
						<input type="submit" value="">
					</form>
				</div>
				<nav id="main-menu">
					<ul>
						<li class="bg-embarazo boton">Embarazo
							<div class="submenu border-radius">
								<div class="subcategorias">

								</div>
								<div class="post-rel">

								</div>
								<div class="post-rel">

								</div>
							</div>
						</li>
						<li class="bg-nacimiento boton">Nacimiento</li>
						<li class="bg-dia-a-dia boton">Día a Día</li>
						<li class="bg-estimulacion boton">Estimulación</li>
						<li class="bg-nutricion boton">Nutrición</li>
						<li class="bg-lactancia boton">Lactancia</li>
						<li class="bg-entrevistas boton">Entrevistas</li>
						<li class="bg-promociones boton ultimo-fila">Promociones</li>
					</ul>
				</nav>
			</header>
		</div><!-- FIN HEADER -->

		<div class="container">
			<div class="banner-top">

			</div>
