<div class="un-medio pb">
	<span class="titulo3 verde">
		<?php if (is_post_type_archive('promociones')) echo 'Más Promociones';
		if (!is_post_type_archive('promociones')) echo 'Más Artículos'; ?>
	</span>
	<?php
		global $exclude;

		if (is_post_type_archive('promociones')):

			$post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('promociones') ) );

		elseif (!is_home()):
			$cat_name = single_cat_title( '', false );
			$term     = get_term_by( 'name', $cat_name, 'category' );

			if ($term->parent != 0) {
				$term = get_term_by('id', $term->parent, 'category');
			}

			$post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $exclude, 'category__in' => $term->term_id) );
		else:
			$post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'orderby' => 'rand', 'post__not_in' => $exclude) );
		endif;

		if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();
			$exclude[] = $post->ID;
		?>
			<div class="caja-ultimos">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('articulos-side'); ?>
					<h4><?php the_title(); ?></h4>
				</a>
			</div>
		<?php endwhile; endif; wp_reset_postdata(); ?>

</div>