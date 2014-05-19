<?php get_header(); $no_posts = array();
	$cat_name = single_cat_title( '', false );
	$term = get_term_by( 'name', $cat_name, 'category' );?>

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
						<li class="fb"><a href=""></a></li>
						<li class="tw"><a href=""></a></li>
						<li class="gm"><a href=""></a></li>
						<li class="pr"><a href=""></a></li>
						<li class="mail"><a href=""></a></li>
					</ul>
				</div>
			</div>
			<?php if ( have_posts() ) : ?>
				<article class="entero">
					<span class="titulo1 pleca-<?php echo $term->slug; ?>"><?php echo $cat_name; ?></span>

					<div id="slider-principal" class="slider-principal">
						<a class="flecha_carrusel prev" href="#"></a>
						<div class="viewport">
							<ul class="overview">
								<?php while( have_posts() ) : the_post(); ?>
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
							<?php if (have_posts() ) : while( have_posts() ) : the_post(); ?>
								<li><a href="#" class="bullet"></a></li>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</ul>

					</div>

				</article><!-- SLIDE -->
			<?php endif; wp_reset_postdata(); ?>

			<?php $post_general = new WP_Query(array( 'posts_per_page' => 7, 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $no_posts, 'cat' => $term->term_id) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; ?>

				<div class="boton mas-entradas">Mas entradas ></div>

			<?php endif; wp_reset_postdata(); ?>



		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>