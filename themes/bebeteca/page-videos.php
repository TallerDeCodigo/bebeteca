<?php get_header();
	$videos = new WP_Query(array( 'posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => array('post', 'articulo-slider'), 'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'id_vimeo',
				'value' => '',
				'compare' => '!='
			),
			array(
				'key' => 'id_youtube',
				'value' => '',
				'compare' => '!='
			)
	) ) );
	?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a>/<a href="<?php echo site_url('/videos/') ?>">Videos</a></span>
			<div class="header-category">
				<h4>Videos</h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share('', 'cat'); ?></p>					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/videos/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/videos/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/videos/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/videos/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/videos/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php if ( $videos->have_posts() ) : $count = 1; while( $videos->have_posts() ) : $videos->the_post();
							if ($count = 1) {
								$url_image = attachment_image_url($post->ID, 'large');
							}
							$count++;
						endwhile; endif; wp_reset_postdata();  ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/videos/') ?>&media=<?php echo $url_image; ?>&description=videos (bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/videos/') ?>&media=<?php echo $url_image; ?>&description=videos (bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul><!-- SHARE BUTTON -->
				</div>
			</div>
			<?php if ( $videos->have_posts() ) : $count = 1; while( $videos->have_posts() ) : $videos->the_post();

				if ($count == 1 AND $paged == 1) : ?>
					<article class="entero">
						<a href="<?php the_permalink(); ?>">
							<div class="slider-principal videos">
								<img class="play_1" src="<?php echo THEMEPATH; ?>images/play_1.png">
								<?php the_post_thumbnail('slider-home'); ?>
							</div>

							<div class="footer-slide">
								<h4><?php the_title(); ?></h4>
								<p><?php echo wp_trim_words( get_the_excerpt(),12 ) ?></p>

								<div class="extras">
									<span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p>
								<span class="compartir"></span><p><?php echo get_count_share($term->term_id, 'cat'); ?></p>
								</div>
							</div>
						</a>
					</article><!-- SLIDE -->

				<?php else:
					$terms  = wp_get_post_terms( get_the_ID(), 'category');
					if (!empty($terms)) {
						$term_name = $terms[0]->name;
						$term_slug = $terms[0]->slug;
					}else{
						$term_name = 'Promociones';
						$term_slug = 'promociones';
					}?>

					<article class="entero article-gral">
						<a href="<?php the_permalink(); ?>">
							<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
							<span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span>
							<?php the_post_thumbnail('articulos-gral'); ?>
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p>
							<div class="extras">
								<span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
								<span class="compartir"></span><p><?php echo get_count_share($post->ID, 'post'); ?></p>
							</div>
						</a>
					</article>

			<?php endif; $count++; endwhile; endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>