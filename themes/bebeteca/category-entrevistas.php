<?php get_header();
	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$cat_name = single_cat_title( '', false );
	$term     = get_term_by( 'name', $cat_name, 'category' );?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <a href="<?php echo site_url('/categoria/entrevistas/') ?>"><?php echo $cat_name; ?></a></span>
			<div class="header-category">
				<h4><?php echo $cat_name; ?></h4>
				<div class="extras-category">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p> -->
						<span class="compartir"></span><p><?php echo get_count_share(site_url('/categoria/entrevistas/')); ?></p>					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/entrevistas/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/entrevistas/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/categoria/entrevistas/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/categoria/entrevistas/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/categoria/entrevistas/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();
							if ($count = 1) {
								$url_image = attachment_image_url($post->ID, 'large');
							}
							$count++;
						endwhile; endif; wp_reset_postdata();  ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/entrevistas/') ?>&media=<?php echo $url_image; ?>&description=entrevistas (bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/entrevistas/') ?>&media=<?php echo $url_image; ?>&description=entrevistas (bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul><!-- SHARE BUTTON -->
				</div>
			</div>
			<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();

				if ($count == 1 AND $paged == 1) : ?>
					<article class="entero shadow">
						<a href="<?php the_permalink(); ?>">
							<div class="slider-principal videos">
								<img class="play_1" src="<?php echo THEMEPATH; ?>images/play_1.png">
								<?php the_post_thumbnail('slider-home'); ?>
							</div>

							<div class="footer-slide">
								<h4><?php the_title(); ?></h4>
								<p><?php echo wp_trim_words( get_the_excerpt(),12 ) ?></p>

								<div class="extras">
									<!-- <span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p> -->
								<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
								</div>
							</div>
						</a>
					</article><!-- SLIDE -->

				<?php else: ?>

					<article class="entero article-gral">
						<a href="<?php the_permalink(); ?>">
							<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
							<?php the_post_thumbnail('articulos-gral'); ?>
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 23 ) ?></p>
							<div class="extras">
								<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
								<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
							</div>
						</a>
					</article>

			<?php endif; $count++; endwhile;
				if(has_previous_posts()): ?><div class="boton mas-entradas"><?php previous_posts_link( '< Anterior' ); ?></div><?php endif;
				if(has_next_posts() && $paged == 1):?>
					<div class="boton mas-entradas right"><?php next_posts_link( 'Más entradas' ); ?></div>
				<?php elseif(has_next_posts()): ?>
					<div class="boton mas-entradas right"><?php next_posts_link( 'Siguiente >' ); ?></div>
				<?php endif;
			endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>