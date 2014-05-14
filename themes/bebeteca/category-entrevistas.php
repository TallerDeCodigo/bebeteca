	<?php get_header();
	$cat_name = single_cat_title( '', false );
	$term = get_term_by( 'name', $cat_name, 'category' );?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs">Home/<?php echo $cat_name; ?></span>
			<div class="header-category">
				<h4><?php echo $cat_name; ?></h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share($term->term_id, 'cat'); ?></p>					</div>
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
			<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();

				if ($count == 1) : ?>
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

				<?php else: ?>

					<article class="entero article-gral">
						<a href="<?php the_permalink(); ?>">
							<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
							<?php the_post_thumbnail('articulos-gral'); ?>
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 23 ) ?></p>
							<div class="extras">
								<span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
								<span class="compartir"></span><p><?php echo get_count_share($post->ID, 'post'); ?></p>
							</div>
						</a>
					</article>

			<?php endif; $count++; endwhile; endif; wp_reset_postdata(); ?>
			<div class="boton mas-entradas">Mas entradas ></div>
		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>