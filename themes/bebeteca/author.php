<?php get_header(); global $wp_query;
$user_id = $wp_query->queried_object->data->ID;
$display_name = $wp_query->queried_object->data->display_name;
$user_nicename = get_the_author_meta( 'user_displayname', $user_id);
?>

	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a>/<a href="<?php echo site_url('/alianzas-y-colaboradores/') ?>">Alianzas y colaboradores</a>/<?php echo $display_name; ?></span>
			<div class="header-category">
				<h4><?php echo $display_name; ?></h4>
				<span class="perfil-usuario"><?php the_author_meta('perfil', $user_id) ?></span>
			</div>

			<article class="entero autor-home clearfix single-autor">
				<div class="cont-image">
					<?php echo vew_image_user($user_id); ?>
				</div>
				<div class="sigue-colaborador">
					<span>Contacta a este colaborador</span>
					<ul>
						<?php $face = get_the_author_meta( 'facebook', $user_id );
						if ($face != ''):?>
							<li class="fb"><a href="<?php the_author_meta('facebook', $user_id) ?>" target="_blank"></a></li>
						<?php endif;
						$twitter = get_the_author_meta( 'twitter', $user_id );
						if ($twitter != ''): ?>
							<li class="tw"><a href="<?php the_author_meta('twitter', $user_id) ?>" target="_blank"></a></li>
						<?php endif;
						$google = get_the_author_meta( 'googleplus', $user_id );
						if ($google != ''):?>
							<li class="gm"><a href="<?php the_author_meta('googleplus', $user_id) ?>" target="_blank"	></a></li>
						<?php endif;
						$printerest = get_the_author_meta( 'printerest', $user_id );
						if ($printerest != ''): ?>
							<li class="pr"><a href="<?php the_author_meta('printerest', $user_id) ?>"></a></li>
						<?php endif;

						$email = get_the_author_meta( 'user_email', $user_id );
						$user_mail = get_the_author_meta( 'user_vew_mail', $user_id );

						if ($user_mail == 1): ?>
							<li class="mail"><a href="mailto:<?php echo $email; ?>"></a></li>
						<?php endif;
						$url = get_the_author_meta( 'user_url', $user_id );
						if ($url != ''): ?>
							<li class="url"><a href="<?php echo $url; ?>"></a></li>
						<?php endif; ?>
					</ul>
				</div>
				<blockquote>" <?php the_author_meta('quote', $user_id) ?> "</blockquote>
				<p><?php echo wpautop(get_the_author_meta( 'description', $user_id ) ); ?></p>

			</article>

			<div class="entero divicion autor">
				<span class="line"></span>
				<h5>Artículos del autor</h5>
				<span class="line"></span>
			</div>

			<?php $paged = isset($_GET['pag']) ? $_GET['pag'] : 1;
			$post_general = new WP_Query(array( 'posts_per_page' => 4, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'author' => $user_id, 'paged'=> $paged ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post();

				get_template_part( 'template/articulo', 'general' );

			endwhile; endif; wp_reset_postdata();

			if($post_general->max_num_pages > 1):
				$user_nicename = get_the_author_meta( 'user_nicename', $user_id);
				$url = site_url('/author/'.$user_nicename .'/');
				if ($paged == 1):?>
					<div class="boton mas-entradas right"><a href="<?php echo $url.'?pag=2'; ?>">Más entradas</a></div>
				<?php else: ?>
					<div class="pagination">
						<?php echo paginate_links_otro($post_general->max_num_pages, $url); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>