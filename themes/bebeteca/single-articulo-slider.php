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
	$terms_query = array();
	foreach ($terms as $key => $term) {
		$cat_terms = get_category_parents($term->term_id, false);
		if( !empty($cat_terms) ) $terms_query[] = $term->term_id;
	}

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

	$terms_query = array();
	foreach ($terms as $key => $term) {
		$cat_eterms = get_category_parents($term->term_id, false);
		if( !empty($cat_terms) ) $terms_query[] = $term->term_id;
	}

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

			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <?php echo cat_and_subcat($parent_id);?> / <a href="<?php echo $permalink; ?>"><?php echo $titulo; ?></a></span>
			<h1><?php echo $titulo; ?></h1>
			<span class="autor">Autor: <?php the_author_posts_link(); ?></span>

			<div class="header-category clearfix">
				<div class="extras-category" style="overflow:visible;">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
						<span class="compartir"></span><p><?php echo get_count_share($permalink); ?></p>
					</div>
					<span>Comparte:</span>
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
							<a rel="nofollow" class="share_post_by_mail" data-id="<?php echo $post->ID; ?>"></a>
							<form class="mail_pop">
								<label for="username">Tu nombre:</label>
								<input type="text" name="username">

								<label for="sender_email">Tu email:</label>
								<input type="email" name="sender_email">

								<label for="recipient">Email del receptor:</label>
								<input type="email" name="recipient">

								<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">

								<label for="message">Mensaje:</label>
								<textarea type="text" name="message"></textarea>

								<input type="submit" value="Enviar">
							</form>
						</li>
					</ul>
				</div>
			</div>
			<div class="texto-slide-mobile si-mobile">
				<a href="<?php echo $link_prev;?>" class="boton">
					< Anterior
				</a>
				<span class="paginacion"><?php echo $estoy; ?> de <?php echo $de; ?></span>
				<a href="<?php echo $link_next;?>" class="boton ultimo-fila">
					Siguiente >
				</a>

			</div>
			<article class="entero slide clearfix">
				<div class="slide_header">
					<?php echo get_the_post_thumbnail( $post_slide_ID, 'medio-home'); ?>
					<span><?php echo get_post_meta($post_slide_ID, 'tagline', true); ?></span>
				</div>
				<h3 class="si-mobile"><?php echo get_the_title($post_slide_ID); ?></h3>
				<div class="texto-slide no-mobile">
					<a href="<?php echo $link_prev;?>" class="boton">
						<span class="no-tablet">< Anterior</span>
						<span class="si-tablet"><</span>
					</a>
					<span class="paginacion"><?php echo $estoy; ?> de <?php echo $de; ?></span>
					<a href="<?php echo $link_next;?>" class="boton ultimo-fila">
						<span class="no-tablet">Siguiente ></span>
						<span class="si-tablet">></span>
					</a>

					<h3><?php echo get_the_title($post_slide_ID); ?></h3>

				</div>
				<p><?php echo get_post_field('post_content', $post_slide_ID); ?></p>

				<div class="header-category post-slide">
					<div class="extras-category">
						<span>Comparte:</span>
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

			</article>
			<article class="entero autor-home clearfix">
				<?php echo vew_image_user($post->post_author); ?>
				<div class="info-autor">
					<h4><?php echo get_the_author_meta( 'display_name'); ?></h4>
					<p class="rol"><?php the_author_meta('perfil') ?></p>
					<?php $user_nicename = get_the_author_meta( 'user_nicename' ); ?>
					<a href="<?php echo site_url('/author/'.$user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
				</div>
				<div class="post-autor">
					<p><?php echo get_the_author_meta( 'quote' ) ?></p>
				</div>
			</article>

			<article class="entero comentarios">
				<h5>DEJA TU COMENTARIO</h5>
				<div class="fb-comments" data-width="100%" data-href="<?php echo $permalink; ?>" data-numposts="5" data-colorscheme="light"></div>
			</article>

			<div class="entero divicion">
				<span class="line"></span><br />
				<h5>Artículos relacionados</h5><br />
				<span class="line"></span>
			</div>
			<?php

			$args = array(
						'posts_per_page' => 4,
						'post_status'	=>'publish',
						'post_type' 	=> array('post', 'articulo-slider'),
						'post__not_in' 	=> array($post->ID),
						'category__in' 	=> $terms_query,
						'orderby'		=> 'rand'
					);

			$post_general = new WP_Query($args);

			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>