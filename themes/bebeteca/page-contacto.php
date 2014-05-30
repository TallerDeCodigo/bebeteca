<?php get_header(); the_post();?>

	<!-- Insert content here -->
	<div class="main single">
		<section>

			<span class="breadcrumbs">Home/<?php the_title(); ?></span>
			<h1><?php the_title(); ?></h1>

			<article class="entero no-padding p-bottom">
				<span class="titulo3">
					Queremos saber de ti
				</span>

				<form id="form_contacto">

					 <input id="form-contacto-nombre" name="nombre" placeholder="Nombre" >

					<input id="form-contacto-email" name="email" placeholder="email@mail.com" >

					<textarea id="form-contacto-mensaje" name="mensaje" placeholder="Mensaje"></textarea>

					<input class="enviar" type="submit" name="submit" value="Enviar">

            	</form>
			</article>
			<article class="entero siguenos-contacto">
				<p class="siguenos">Síguenos en redes</p>
				<ul class="redes-siguenos">
					<li class="fb active-red">facebook</li>
					<li class="tw">twitter</li>
					<li class="gm">goggle +</li>
				</ul>
				<div class="bt-siguenos fb">
					<span class="triangulo"></span>
					<div class="fb-like" data-href="<?php echo site_url('/') ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				</div>
				<div class="bt-siguenos tw">
					<span class="triangulo"></span>
					<a href="https://twitter.com/HacemosCodigo" class="twitter-follow-button" data-show-count="false">Follow @HacemosCodigo</a>
				</div>
				<div class="bt-siguenos gm">
					<span class="triangulo"></span>
					<!-- Place this tag where you want the share button to render. -->
					<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/u/0/118300723396545429987" data-rel="author"></div>
				</div>
			</article>
		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>