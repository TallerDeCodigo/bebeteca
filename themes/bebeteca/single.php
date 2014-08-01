<?php get_header(); the_post();
$terms  = get_the_terms( $post->ID, 'category');
$term_name = $terms[0]->name;
$term_id = $terms[0]->term_id;
$term_slug = $terms[0]->slug;
$terms_query = array();
foreach ($terms as $key => $term) {
	$cat_parents = get_category_parents($term->term_id, false);
	if( !empty($cat_parents) ) $terms_query[] = $term->term_id;
}

?>

	<!-- Insert content here -->
	<div class="main single">
		<section>

			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <?php echo cat_and_subcat();?> / <?php the_title(); ?></span>
			<h1><?php the_title(); ?></h1>
			<span class="autor">Autor: <?php the_author_posts_link(); ?></span>

			<div class="header-category">
				<div class="extras-category">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
						<span class="compartir"></span><p><?php echo get_count_share(get_permalink($post->ID)); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo get_permalink($post->ID) ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo get_permalink($post->ID) ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo get_permalink($post->ID) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php $url_image = attachment_image_url($post->ID, 'large'); ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID) ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID) ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>" target="_blank" ></a>
						</li>
						<li class="mail">
							<a rel="nofollow" class="share_post_by_mail" data-id="<?php $post->ID; ?>"></a>
							<form id="mail_pop" class="mail_pop">
								<label for="username">Tu nombre:</label>
								<input type="text" name="username">

								<label for="sender_email">Tu email:</label>
								<input type="email" name="sender_email">

								<label for="recipient">Email del receptor:</label>
								<input type="email" name="recipient">

								<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">

								<label for="message">Mensaje:</label>
								<textarea type="text" name="message"></textarea>

								<input type="submit">
							</form>
						</li>
					</ul>
				</div>
			</div>
			<article class="entero">
				<?php if (get_post_meta($post->ID, 'id_youtube', true) OR get_post_meta($post->ID, 'id_vimeo', true) ):

					if(get_post_meta($post->ID, 'id_vimeo', true)): ?>
						<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, 'id_vimeo', true); ?>?color=00a6ce" width="620" height="465" class="margin-botton-img" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					<?php elseif(get_post_meta($post->ID, 'id_youtube', true)): ?>
						<iframe width="620" height="465" class="margin-botton-img" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, 'id_youtube', true); ?>" frameborder="0" allowfullscreen></iframe>
					<?php endif;

				else:
					the_post_thumbnail('slider-home', array('class' => 'freatured-post'));?>

					<span class="leyenda-img"><?php echo get_post_thumbnail_caption(); ?></span>

				<?php endif;

				the_content();?>


				<div class="header-category">
					<div class="extras-category">
						<span>Comparte</span>
						<ul>
							<li claSS="fb">
								<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>" target="_blank"></a>
							</li>

							<li class="tw">
								<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo get_permalink($post->ID) ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo get_permalink($post->ID) ?>" target="_blank" ></a>
							</li>

							<li class="gm">
								<a href="https://plus.google.com/share?url=<?php echo get_permalink($post->ID) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
							</li>

							<?php $url_image = attachment_image_url($post->ID, 'large'); ?>
							<li class="pr">
								<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID) ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID) ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>" target="_blank" ></a>
							</li>
							<li class="mail">
								<a rel="nofollow" class="share_post_by_mail" data-id="<?php echo $post->ID; ?>"></a>
								<form id="mail_pop" class="mail_pop">
									<label for="username">Tu nombre:</label>
									<input type="text" name="username">

									<label for="sender_email">Tu email:</label>
									<input type="email" name="sender_email">

									<label for="recipient">Email del receptor:</label>
									<input type="email" name="recipient">

									<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">

									<label for="message">Mensaje:</label>
									<textarea type="text" name="message"></textarea>

									<input type="submit">
								</form>
							</li>
						</ul>
					</div>
				</div>
			</article>

			<article class="entero autor-home">
				<?php echo vew_image_user($post->post_author); ?>
				<div class="info-autor">
					<h4><?php the_author_meta( 'user_login'); ?></h4>
					<p class="rol"><?php the_author_meta('perfil') ?></p>
					<?php $user_nicename = get_the_author_meta( 'user_nicename'); ?>
					<a href="<?php echo site_url('/author/'.$user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
				</div>
				<div class="post-autor">
					<p><?php the_author_meta('quote') ?> </p>
				</div>
			</article>

			<article class="entero comentarios">
				<h5>DEJA TU COMENTARIO</h5>
				<div class="fb-comments" data-width="100%" data-href="<?php echo get_permalink($post->ID) ?>" data-numposts="5" data-colorscheme="light"></div>
			</article>

			<div class="entero divicion">
				<span class="line"></span>
				<h5>Artículos relacionados</h5>
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