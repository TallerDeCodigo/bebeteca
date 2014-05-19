<?php get_header();?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs">Resultados de busqueda</span>
			<div class="header-category">
				<h4>" <?php printf( __( '%s' ),  get_search_query()  ); ?> "</h4>
			</div>
			<?php if ( have_posts() ) : while( have_posts() ) : the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>
			<div class="boton mas-entradas">Mas entradas ></div>
		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>