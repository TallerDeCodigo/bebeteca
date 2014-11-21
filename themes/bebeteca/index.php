<?php get_header();
$no_posts = array();
global $exclude;
global $count_m_home;?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<?php get_template_part( 'template/home', 'slide' ); ?>

			<article class="un-medio no-tablet">
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

			<article class="un-medio ultimo-fila no-tablet">
				<span class="titulo2 color-rosa">Cupones</span>
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

			<article class="entero autor-home clearfix index-au no-tablet">
				<?php $user_query = new WP_User_Query(array('role' => 'colaborador','number' => 40));
				$users  = $user_query->results;
				$total  = count($users) - 1;
				$select = rand(0, $total);
				$user_id =  $users[$select]->ID;?>

				<?php echo vew_image_user($user_id);?>


				<div class="info-autor">
					<h4><?php echo $users[$select]->display_name; ?></h4>
					<p class="rol"><?php the_author_meta('perfil', $user_id) ?></p>
					<p><?php echo wp_trim_words( get_the_author_meta( 'quote', $user_id ), 12 ) ?></p>
					<?php
						$user_nicename = get_the_author_meta( 'user_nicename', $user_id);
					?>
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
			<div class="entero lazy-container" data-page="home" data-offset="11">
				<?php $cat_no = get_term_by( 'slug', 'entrevistas', 'category' );
				wp_localize_script( 'functions', 'excluir', $exclude );

				$post_general = new WP_Query(array( 'posts_per_page' => 11, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $exclude, 'category__not_in' => array($cat_no->term_id) ) );
				if ( $post_general->have_posts() ) : $count = 1; while( $post_general->have_posts() ) : $post_general->the_post();
					$exclude[] = $post->ID;
					$count_m_home = $count;
					get_template_part( 'template/articulo', 'general' );
					$count++;
				endwhile; endif; wp_reset_postdata(); ?>
			</div>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>