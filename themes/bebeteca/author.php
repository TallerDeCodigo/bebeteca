<?php get_header(); global $wp_query;
$user_id = $wp_query->queried_object->data->ID;
$display_name = $wp_query->queried_object->data->display_name;?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a>/<a href="<?php echo site_url('/') ?>">Colaboradores</a>/<?php echo $display_name; ?></span>
			<div class="header-category">
				<h4><?php echo $display_name; ?></h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like('', 'cat'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share('', 'cat'); ?></p>
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

			<article class="entero autor-home single-autor">
				<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
				<div class="sigue-colaborador">
					<span>Sigue a este colaborador</span>
					<ul>
						<li class="fb"><a href="https://www.facebook.com/<?php the_author_meta('facebook', $user_id) ?>" target="_blank"></a></li>
						<li class="tw"><a href="https://twitter.com/<?php the_author_meta('twitter', $user_id) ?>" target="_blank"></a></li>
						<li class="gm"><a href="https://plus.google.com/<?php the_author_meta('google', $user_id) ?>" target="_blank"	></a></li>
						<li class="pr"><a href="http://es.pinterest.com/<?php the_author_meta('printerest', $user_id) ?>"></a></li>
						<li class="mail"><a href=""></a></li>
					</ul>
				</div>
				<div class="info-autor">
					<blockquote>"Lorem ipsum dolor"</blockquote>
					<p><?php echo get_the_author_meta( 'description', $user_id ); ?></p>
				</div>
			</article>

			<div class="entero divicion autor">
				<span class="line"></span>
				<h5>Artículos del autor</h5>
				<span class="line"></span>
			</div>

			<?php $post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'author' => $user_id ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata(); ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>