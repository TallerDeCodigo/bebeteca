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

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>