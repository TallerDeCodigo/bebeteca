	<?php get_header(); $no_posts = array();?>
	<!-- Insert content here -->
	<div class="main">
		<section>
			<?php if ( have_posts() ) : ?>
				<article class="entero">
					<span class="titulo1 pleca-"></span>

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

			<article class="un-medio">
				<span class="titulo2">Videos</span>
				<img src="<?php echo THEMEPATH; ?>images/img1.jpg">
				<div class="footer-un-medio">
					<h4>Doctora nos dice 10 tips importantes para tu bebé</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>
					<div class="extras">
						<span class="megusta azul"></span><p class="azul">190</p>
						<span class="compartir azul"></span><p class="azul">340</p>
					</div>
				</div>
			</article><!-- VIDEOS -->

			<article class="un-medio ultimo-fila">
				<span class="titulo2 color-rosa">Promociones</span>
				<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
				<div class="footer-un-medio color-rosa">
					<h4>Doctora nos dice 10 tips importantes para tu bebé</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>
					<div class="extras">
						<span class="megusta rosa"></span><p class="rosa">190</p>
						<span class="compartir rosa"></span><p class="rosa">340</p>
					</div>
				</div>
			</article><!-- VIDEOS -->

			<article class="entero autor-home">
				<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
				<div class="info-autor">
					<h4>Nombre autor</h4>
					<p class="rol">Editora</p>
					<p>I am of the mindset that if you are creative enough you can make anything happen</p>
					<div class="boton">Más sobre el autor</div>
				</div>
				<div class="post-autor">
					<div>
						<a href=""><span>></span><h4>Disappointing Pregnancy Announcements</h4></a>
					</div>
					<div>
						<a href=""><span>></span><h4>Why Kids Need Their Dads</h4></a>
					</div>
					<div>
						<a href=""><span>></span><h4>10 Things I Regret Not Enjoying More During...</h4></a>
					</div>
					<div class="ultimo-bottom" >
						<a href=""><span>></span><h4>7 Things Parents Need to Know</h4></a>
					</div>
				</div>
			</article>

			<div class="entero divicion">
				<span class="line"></span>
				<h5>Más artículos</h5>
				<span class="line"></span>
			</div>

			<?php $post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $no_posts) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; ?>

			<div class="boton mas-entradas">Mas entradas ></div>

			<?php endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>