<div class="un-medio pb">
	<span class="titulo3 verde">
		Artículos relacionados
	</span>
	<?php
		global $exclude;
		$exclude[] = $post->ID;
		$terms  = get_the_terms( $post->ID, 'category');
		$terms_query = array();
		foreach ($terms as $key => $term) {
			$cat_parents = get_category_parents($term->term_id, false);
			if( !empty($cat_parents) ) $terms_query[] = $term->term_id;
		}
		$post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'category__in' 	=> $terms_query, 'post__not_in' => $exclude, 'orderby' => 'rand') );
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