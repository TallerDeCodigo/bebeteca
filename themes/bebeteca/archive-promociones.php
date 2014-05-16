	<?php get_header();?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs">Home/Promociones</span>
			<div class="header-category">
				<h4>Promociones</h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share('', 'cat'); ?></p>					</div>
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
								<?php the_post_thumbnail('slider-home'); ?>
							</div>

							<div class="footer-slide">
								<h4><?php the_title(); ?></h4>
								<p><?php echo wp_trim_words( get_the_excerpt(),12 ) ?></p>

								<div class="extras">
									<span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p>
								<span class="compartir"></span><p><?php echo get_count_share('', 'cat'); ?></p>
								</div>
							</div>
						</a>
					</article><!-- SLIDE -->

				<?php else:

					get_template_part( 'template/articulo', 'general' );

			endif; $count++; endwhile; endif; wp_reset_postdata(); ?>
			<div class="boton mas-entradas">Mas entradas ></div>
		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>