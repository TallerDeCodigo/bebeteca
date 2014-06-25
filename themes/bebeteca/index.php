<?php get_header(); $no_posts = array(); global $exclude; ?>
	<!-- Insert content here -->
	<div class="main">
		<section>
			<?php if ( have_posts() ) : ?>
				<article class="entero shadow">

					<div id="slider-principal" class="slider-principal">
						<ul class="bullets clearfix pleca">
							<?php if (have_posts() ) : while( have_posts() ) : the_post(); $exclude[] = $post->ID;
							$terms  = wp_get_post_terms( get_the_ID(), 'category');
							if (!empty($terms)) {
								$term_name = $terms[0]->name;
								$term_slug = $terms[0]->slug;
							}else{
								$term_name = '';
								$term_slug = '';
							}

							$postype = get_post_type(get_the_ID());
							if ($postype == 'promociones') {
								$term_name = 'Promociones';
								$term_slug = 'promociones';
							}?>
								<?php if ($term_name != ''): ?>
									<li class="bullet">
										<span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span>
										<a href="#" ></a>
									</li><?php endif; ?>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</ul>
						<a class="flecha_carrusel prev" href="#"></a>
						<div class="viewport">
							<ul class="overview">
								<?php while( have_posts() ) : the_post(); ?>
									<li>
										<a href="<?php the_permalink(); ?>">
											<?php $id_vimeo = get_post_meta( $post->ID, 'id_vimeo', true );
											$id_youtube = get_post_meta( $post->ID, 'id_youtube', true );
											if ($id_vimeo != '' OR $id_youtube != '') { ?>
												<img class="play_1" src="<?php echo THEMEPATH; ?>images/play_1.png">
											<?php }
											the_post_thumbnail('slider-home'); ?>
											<div class="footer-slide">
												<h4><?php the_title(); ?></h4>
												<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>

												<div class="extras">
													<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
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

				$post_video = new WP_Query(array( 'posts_per_page' => 1, 'post_type' => array('post', 'articulo-slider'), 'meta_query' => $meta_query, 'post__not_in' => $exclude) );

				if ( $post_video->have_posts() ) : while( $post_video->have_posts() ) : $post_video->the_post(); $exclude[] = $post->ID; ?>
					<a href="<?php the_permalink(); ?>">
						<img class="play_2 home_vid" src="<?php echo THEMEPATH; ?>images/play_2.png">
						<?php the_post_thumbnail('medio-home'); ?>
						<div class="footer-un-medio">
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>
							<div class="extras">
								<!-- <span class="megusta azul"></span><p class="azul"><?php echo get_count_like($post->ID, 'post'); ?></p> -->
								<span class="compartir azul"></span><p class="azul"><?php echo get_count_share(get_permalink()); ?></p>
							</div>
						</div>
						<a class="boton mas-videos" href="<?php echo site_url('/videos/') ?>">ver más ></a
					</a>

				<?php endwhile; endif; wp_reset_postdata(); ?>
			</article><!-- VIDEOS -->

			<article class="un-medio ultimo-fila">
				<span class="titulo2 color-rosa">Promociones</span>
					<?php $post_video = new WP_Query(array( 'posts_per_page' => 1, 'post_type' => array('promociones'), 'post__not_in' => $exclude ) );

					if ( $post_video->have_posts() ) : while( $post_video->have_posts() ) : $post_video->the_post(); $exclude[] = $post->ID; ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('medio-home'); ?>
						<div class="footer-un-medio color-rosa">
							<h4><?php the_title(); ?></h4>
							<p><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>
							<div class="extras">
								<!-- <span class="megusta rosa"></span><p class="rosa"><?php echo get_count_like($post->ID, 'post'); ?></p> -->
								<span class="compartir rosa"></span><p class="rosa"><?php echo get_count_share(get_permalink()); ?></p>
							</div>
						</div>
					</a>

				<?php endwhile; endif; wp_reset_postdata(); ?>
			</article><!-- VIDEOS -->

			<article class="entero autor-home index-au">
				<?php $user_query = new WP_User_Query(array('role' => 'colaborador','number' => 40));
				$users  = $user_query->results;
				$total  = count($users) - 1;
				$select = rand(0, $total);
				$user_id =  $users[$select]->ID;?>

				<?php echo vew_image_user($user_id);?>


				<div class="info-autor">
					<h4><?php echo $users[$select]->user_login; ?></h4>
					<p class="rol"><?php the_author_meta('perfil', $user_id) ?></p>
					<p><?php echo wp_trim_words( get_the_author_meta( 'quote', $user_id ), 12 ) ?></p>
					<?php $user_nicename = get_the_author_meta( 'user_nicename', $user_id); ?>
					<a href="<?php echo site_url('/author/'.$user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
				</div>
				<div class="post-autor">
					<?php $post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'author' => $user_id) );
					if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post(); $exclude[] = $post->ID; ?>

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

			$post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $exclude, 'category__not_in' => array($cat_no->term_id) ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();
				$exclude[] = $post->ID;
				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>