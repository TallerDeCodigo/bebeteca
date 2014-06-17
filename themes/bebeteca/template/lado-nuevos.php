<div class="un-medio pb">
	<span class="titulo3 verde">
		Últimos artículos
	</span>
	<?php 
		global $exclude;
		$exclude[] = $post->ID;
		$post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $exclude) );
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