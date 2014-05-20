<?php get_header(); $no_posts = array();?>
	<!-- Insert content here -->
	<div class="main">
		<section>
			<?php if ( have_posts() ) : ?>
				<article class="entero">
						<!-- <span class="titulo1 pleca-"></span> -->

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
													<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
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
				<?php $meta_query = array(
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
									);

				$post_video = new WP_Query(array( 'posts_per_page' => 1, 'post_type' => array('post', 'articulo-slider'), 'meta_query' => $meta_query) );

				if ( $post_video->have_posts() ) : while( $post_video->have_posts() ) : $post_video->the_post(); ?>
					<a href="<?php the_permalink(); ?>">
						<img class="play_2 home_vid" src="<?php echo THEMEPATH; ?>images/play_2.png">
						<?php the_post_thumbnail('medio-home'); ?>
						<div class="footer-un-medio">
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>
							<div class="extras">
								<span class="megusta azul"></span><p class="azul"><?php echo get_count_like($post->ID, 'post'); ?></p>
								<span class="compartir azul"></span><p class="azul"><?php echo get_count_share(get_permalink()); ?></p>
							</div>
						</div>
						<a class="boton mas-videos" href="<?php echo site_url('/videos/') ?>">ver mas ></a
					</a>

				<?php endwhile; endif; wp_reset_postdata(); ?>
			</article><!-- VIDEOS -->

			<article class="un-medio ultimo-fila">
				<span class="titulo2 color-rosa">Promociones</span>
					<?php $post_video = new WP_Query(array( 'posts_per_page' => 1, 'post_type' => array('promociones') ) );

					if ( $post_video->have_posts() ) : while( $post_video->have_posts() ) : $post_video->the_post(); ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('medio-home'); ?>
						<div class="footer-un-medio color-rosa">
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>
							<div class="extras">
								<span class="megusta rosa"></span><p class="rosa"><?php echo get_count_like($post->ID, 'post'); ?></p>
								<span class="compartir rosa"></span><p class="rosa"><?php echo get_count_share(get_permalink()); ?></p>
							</div>
						</div>
					</a>

				<?php endwhile; endif; wp_reset_postdata(); ?>
			</article><!-- VIDEOS -->

			<article class="entero autor-home">
				<?php $user_query = new WP_User_Query(array('role' => 'colaborador','number' => 40));
				$users  = $user_query->results;
				$total  = count($users) - 1;
				$select = rand(0, $total);
				$user_id =  $users[$select]->ID;
				?>
				<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
				<div class="info-autor">
					<h4><?php echo $users[$select]->user_login; ?></h4>
					<p class="rol">Editora</p>
					<p><?php echo wp_trim_words( get_the_author_meta( 'description', $user_id ), 12 ) ?></p>
					<?php $user_nicename = get_the_author_meta( 'user_nicename', $user_id); ?>
					<a href="<?php echo site_url('/author/'.$user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
				</div>
				<div class="post-autor">
					<?php $post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'author' => $user_id) );
					if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post(); ?>

						<div>
							<a href="<?php the_permalink(); ?>"><span>></span><h4><?php the_title() ;?></h4></a>
						</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</article>

			<div class="entero divicion">
				<span class="line"></span>
				<h5>Más artículos</h5>
				<span class="line"></span>
			</div>

			<?php $cat_no = get_term_by( 'slug', 'entrevistas', 'category' );

			$post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $no_posts, 'category__not_in' => array($cat_no->term_id) ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>