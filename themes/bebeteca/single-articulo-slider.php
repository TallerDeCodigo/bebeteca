<?php get_header(); the_post();

$post_child = return_posts_slide($post->ID);

if(empty($post_child->posts) ){
	$terms     = wp_get_post_terms( $post->post_parent, 'category');
	$term_name = $terms[0]->name;
	$term_slug = $terms[0]->slug;
	$titulo    = get_the_title($post->post_parent);
	$parent_id = $post->post_parent;
	$permalink =  get_permalink($post->post_parent);
	$post_child2 = return_posts_slide($post->post_parent);
	$de = count($post_child2->posts);
	$post_slide_ID = $post->ID;

	foreach ($post_child2->posts as $key => $value) {
		if ($value->ID == $post->ID) {
			$estoy = $key + 1;
			$post_anterior = $key - 1;
			$post_sig = $key + 1;

			if ($post_sig == $de){
				$link_next = get_permalink($post_child2->posts[0]->ID);
			}else{
				$link_next = get_permalink($post_child2->posts[$post_sig]->ID);
			}

			if ($estoy == 1){
				$post_anterior = $de - 1;
				$link_prev = get_permalink($post_child2->posts[$post_anterior]->ID);
			}else{
				$link_prev = get_permalink($post_child2->posts[$post_anterior]->ID);
			}

		}
	}

}else{
	$terms  = wp_get_post_terms( get_the_ID(), 'category');
	$term_name = $terms[0]->name;
	$term_slug = $terms[0]->slug;
	$titulo = get_the_title();
	$de = count($post_child->posts);
	$estoy = 1;
	$post_anterior = $de - 1;
	$link_prev = get_permalink($post_child->posts[$post_anterior]->ID);


	if ($de == 1){
		$link_next = get_permalink($post_child->posts[0]->ID);
	}else{
		$link_next = get_permalink($post_child->posts[1]->ID);
	}
	$permalink =  get_permalink($post->ID);

	$post_slide_ID = $post_child->posts[0]->ID;
	$parent_id = $post->ID;
}




?>

	<!-- Insert content here -->

	<div class="main single">
		<section>

			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <?php echo cat_and_subcat();?> / <a href="<?php echo $permalink; ?>"><?php echo $titulo; ?></a></span>
			<h1><?php echo $titulo; ?></h1>
			<span class="autor">Autor: <?php the_author_posts_link(); ?></span>

			<div class="header-category">
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share($permalink); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo $permalink; ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo $permalink; ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo $permalink; ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo $permalink; ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo $permalink; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php $url_image = attachment_image_url($parent_id, 'large'); ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&media=<?php echo $url_image; ?>&description=<?php echo $titulo; ?> (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&media=<?php echo $url_image; ?>&description=<?php echo $titulo; ?> (Bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul>
				</div>
			</div>
			<article class="entero slide">
				<div class="slide_header">
					<?php echo get_the_post_thumbnail( $post_slide_ID, 'medio-home'); ?>
					<span><?php echo get_post_meta($post_slide_ID, 'tagline', true); ?></span>
				</div>

				<div class="texto-slide">
					<a href="<?php echo $link_prev;?>" class="boton">< Anterior</a>
					<span class="paginacion"><?php echo $estoy; ?> de <?php echo $de; ?></span>
					<a href="<?php echo $link_next;?>" class="boton ultimo-fila">Siguiente ></a>

					<h3><?php echo get_the_title($post_slide_ID); ?></h3>
					<p><?php echo get_post_field('post_content', $post_slide_ID); ?></p>

					<div class="header-category">
						<div class="extras-category">
							<span>Comparte</span>
							<ul>
								<li class="fb">
									<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo get_permalink($post_slide_ID); ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($post_slide_ID); ?>" target="_blank"></a>
								</li>

								<li class="tw">
									<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo get_permalink($post_slide_ID); ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo get_permalink($post_slide_ID); ?>" target="_blank" ></a>
								</li>

								<li class="gm">
									<a href="https://plus.google.com/share?url=<?php echo get_permalink($post_slide_ID); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
								</li>

								<?php $url_image = attachment_image_url($post_slide_ID, 'large'); ?>
								<li class="pr">
									<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post_slide_ID); ?>&media=<?php echo $url_image; ?>&description=<?php echo get_post_field('post_content', $post_slide_ID); ?> (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post_slide_ID); ?>&media=<?php echo $url_image; ?>&description=<?php echo get_post_field('post_content', $post_slide_ID); ?> (Bebeteca)" target="_blank" ></a>
								</li>
								<li class="mail">
									<a href=""></a>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</article>
			<article class="entero autor-home">
				<?php echo vew_image_user($post->post_author); ?>
				<div class="info-autor">
					<h4><?php echo get_the_author_meta( 'user_login'); ?></h4>
					<p class="rol"><?php the_author_meta('perfil') ?></p>
					<?php $user_nicename = get_the_author_meta( 'user_nicename' ); ?>
					<a href="<?php echo site_url('/author/'.$user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
				</div>
				<div class="post-autor">
					<p><?php echo wp_trim_words( get_the_author_meta( 'description' ), 12 ) ?></p>
				</div>
			</article>

			<article class="entero comentarios">
				<h5>DEJA TU COMENTARIO</h5>
				<div class="fb-comments" data-width="100%" data-href="<?php echo $permalink; ?>" data-numposts="5" data-colorscheme="light"></div>
			</article>

			<div class="entero divicion">
				<span class="line"></span>
				<h5>Artículos relacionados</h5>
				<span class="line"></span>
			</div>
			<?php
			$post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => array($parent_id), 'category_name' => $term_slug ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>