<?php get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <a href="<?php echo site_url('/promociones/') ?>">Promociones</a></span>
			<div class="header-category">
				<h4>Promociones</h4>
				<div class="extras-category">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p> -->
						<span class="compartir"></span><p><?php echo get_count_share(site_url('/promociones/')); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/promociones/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/promociones/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/promociones/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/promociones/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/promociones/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();
							if ($count = 1) {
								$url_image = attachment_image_url($post->ID, 'large');
							}
							$count++;
						endwhile; endif; wp_reset_postdata();  ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/promociones/') ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/promociones/') ?>&media=<?php echo $url_image; ?>&description=<?php the_excerpt(); ?>" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>

					</ul>
				</div>
			</div>
			<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();

				if ($count == 1 AND $paged == 1) : ?>
					<article class="entero shadow">
						<a href="<?php the_permalink(); ?>">
							<div class="slider-principal videos">
								<?php the_post_thumbnail('slider-home'); ?>
							</div>

							<div class="footer-slide">
								<h4><?php the_title(); ?></h4>
								<p><?php echo wp_trim_words( get_the_excerpt(),12 ) ?></p>

								<div class="extras">
									<!-- <span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p> -->
								<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
								</div>
							</div>
						</a>
					</article><!-- SLIDE -->

				<?php else:

					get_template_part( 'template/articulo', 'general' );

			endif; $count++; endwhile;
				if(has_previous_posts()): ?><div class="boton mas-entradas"><?php previous_posts_link( '< Anteriores' ); ?></div><?php endif;
				if(has_next_posts()): ?><div class="boton mas-entradas right"><?php next_posts_link( 'Mas entradas >' ); ?></div> <?php endif;
			endif; wp_reset_postdata(); ?>
		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>