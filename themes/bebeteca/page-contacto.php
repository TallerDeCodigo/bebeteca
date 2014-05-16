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

					 <label for="edit-name"><?php _e('NOMBRE', 'fashion'); ?>:</label>
					 <input id="form-escribenos-name" name="nombre" >

					<label for="edit-correo"><?php _e('CORREO', 'fashion'); ?>:</label>
					<input id="form-escribenos-email" name="email" >

					<label for="edit-mensaje"><?php _e('MENSAJE', 'fashion'); ?>:</label>
					<textarea id="form-escribenos-mensaje" name="mensaje"></textarea>

					<input class="enviar" type="submit" name="submit" value="<?php _e('ENVIAR', 'fashion'); ?>">

            	</form>
			</article>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>