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
				<?php $etiqueta = is_single() ? 'h2' : 'h1'; ?>
				<<?php echo $etiqueta; ?> class="logo"><a href="<?php echo site_url('/') ?>">La Bebeteca</a></h1>
				<div class="top-header">
					<span>Visítanos</span>
					<ul class="redes-sociales">
						<li class="b-fb"><a href="">faceboock</a></li>
						<li class="b-tw"><a href="">twitter</a></li>
						<li class="b-gm"><a href="">google +</a></li>
					</ul>
					<div class="boton abre-pop-registro">Registrate</div>
					<div class="boton abre-pop-registro">Inicia Sesión</div>
					<form class="forma-buscar" method="GET" action="<?php echo site_url('/') ?>">
						<input type="text" name="s" value="" placeholder="Buscar" >
						<input type="submit" value="">
					</form>
				</div>
				<nav id="main-menu">
					<ul>
						<li class="bg-embarazo boton"><a href="<?php echo site_url('/categoria/embarazo/'); ?>">Embarazo</a>
							<div class="submenu border-radius">
								<div class="subcategorias">

								</div>
								<div class="post-rel">

								</div>
								<div class="post-rel">

								</div>
							</div>
						</li>
						<li class="bg-nacimiento boton"><a href="<?php echo site_url('/categoria/nacimiento/'); ?>">Nacimiento</a></li>
						<li class="bg-dia-a-dia boton"><a href="<?php echo site_url('/categoria/dia-a-dia/'); ?>">Día a Día</a></li>
						<li class="bg-estimulacion boton"><a href="<?php echo site_url('/categoria/estimulacion/'); ?>">Estimulación</a></li>
						<li class="bg-nutricion boton"><a href="<?php echo site_url('/categoria/nutricion/'); ?>">Nutrición</a></li>
						<li class="bg-lactancia boton"><a href="<?php echo site_url('/categoria/lactancia/'); ?>">Lactancia</a></li>
						<li class="bg-entrevistas boton"><a href="<?php echo site_url('/categoria/entrevistas/'); ?>">Entrevistas</a></li>
						<li class="bg-promociones boton ultimo-fila"><a href="<?php echo site_url('/promociones/'); ?>">Promociones</a></li>
					</ul>
				</nav>
			</header>
		</div><!-- FIN HEADER -->

		<div class="container">

			<div class="banner-top">

			</div>
