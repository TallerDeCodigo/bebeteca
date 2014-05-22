<?php get_header(); ?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a>/Colaboradores</span>
			<div class="header-category">
				<h4>Colaboradores</h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share('', 'cat'); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/colaboradores/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/colaboradores/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/colaboradores/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/colaboradores/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/colaboradores/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php $url_image = ''; ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/colaboradores/') ?>&media=<?php echo $url_image; ?>&description=Colaboradores (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/colaboradores/') ?>&media=<?php echo $url_image; ?>&description=Colaboradores (Bebeteca)" target="_blank" ></a>
						</li>

						<li class="mail">
							<a href=""></a>
						</li>
					</ul>
				</div>
			</div>
			<?php $user_query = new WP_User_Query(array('role' => 'colaborador','number' => 40));

			// User Loop
			if ( ! empty( $user_query->results ) ) {
				foreach ( $user_query->results as $user ) {?>
					<article class="entero autor-home">
						<?php echo vew_image_user($user->ID); ?>
						<div class="info-autor">
							<h4><?php echo $user->display_name; ?></h4>
							<p class="rol">Editor</p>
							<p><?php the_author_meta( 'description', $user->ID ); ?></p>
							<a href="<?php echo site_url('/author/'.$user->user_nicename.'/') ?>" class="boton">Más sobre el autor</a>
						</div>
						<div class="post-autor">
							<?php $post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'author' => $user->ID ) );
							if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post(); ?>

								<div>
									<a href="<?php the_permalink(); ?>"><span>></span><h4><?php the_title() ;?></h4></a>
								</div>

							<?php endwhile; endif; wp_reset_postdata(); ?>

						</div>
					</article>
				<?php }
			}

		  ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>