<?php get_header();?>

	<!-- Insert content here -->
	<div class="main">
		<section class="search">
			<span class="breadcrumbs">Resultados de busqueda</span>
			<div class="header-category">
				<h4>" <?php printf( __( '%s' ),  get_search_query()  ); ?> "</h4>
			</div>
			<div class="search-main">
				<?php if ( have_posts() ) : while( have_posts() ) : the_post();

					get_template_part( 'template/articulo', 'general' );

				endwhile; endif; wp_reset_postdata(); ?>
			</div>

			<?php if(has_previous_posts()): ?><div class="boton mas-entradas"><?php previous_posts_link( '< Anteriores' ); ?></div><?php endif;
			if(has_next_posts()): ?><div class="boton mas-entradas right"><?php next_posts_link( 'Más entradas >' ); ?></div> <?php endif; ?>
		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>