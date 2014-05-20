<?php get_header();
	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$cat_name = single_cat_title( '', false );
	$term     = get_term_by( 'name', $cat_name, 'category' );?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a>/<a href="<?php echo site_url('/categoria/'.$term->slug.'/'); ?>"><?php echo $cat_name; ?></a></span>
			<div class="header-category">
				<h4><?php echo $cat_name; ?></h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share($term->term_id, 'cat'); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/categoria/'.$term->slug.'/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();
							if ($count = 1) {
								$url_image = attachment_image_url($post->ID, 'large');
							}
							$count++;
						endwhile; endif; wp_reset_postdata();  ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&media=<?php echo $url_image; ?>&description=<?php echo $cat_name; ?> (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&media=<?php echo $url_image; ?>&description=<?php echo $cat_name; ?> (Bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul>
				</div>
			</div>
			<?php $post_general = query_categorias_slide($term->term_id);
			if ( $post_general->have_posts() AND $paged == 1 ) :?>
				<article class="entero">
					<span class="titulo1 pleca-<?php echo $term->slug; ?>"><?php echo $cat_name; ?></span>

					<div id="slider-principal" class="slider-principal">
						<a class="flecha_carrusel prev" href="#"></a>
						<div class="viewport">
							<ul class="overview">
								<?php while( $post_general->have_posts() ) : $post_general->the_post(); ?>
									<li>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('slider-home'); ?>
											<div class="footer-slide">
												<h4><?php the_title(); ?></h4>
												<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>

												<div class="extras">
													<span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
													<span class="compartir"></span><p><?php echo get_count_share($post->ID, 'post'); ?></p>
												</div>
											</div>
										</a>
									</li>

								<?php $no_posts[] = $post->ID;
								endwhile; ?>
							</ul>
						</div>
						<a class="flecha_carrusel next" href="#"></a>
						<ul class="bullets clearfix">
							<?php if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post(); ?>
								<li><a href="#" class="bullet"></a></li>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</ul>

					</div>

				</article><!-- SLIDE -->
			<?php endif; wp_reset_postdata(); ?>

			<?php if ( have_posts() ) :  while( have_posts() ) : the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile;

				if(has_previous_posts()): ?><div class="boton mas-entradas"><?php previous_posts_link( '< Anteriores' ); ?></div><?php endif;
				if(has_next_posts()): ?><div class="boton mas-entradas right"><?php next_posts_link( 'Mas entradas >' ); ?></div> <?php endif;

			endif; wp_reset_postdata(); ?>



		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>


