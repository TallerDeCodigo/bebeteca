<?php get_header();
	global $count_m_home;
	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$cat_name = single_cat_title( '', false );
	$term     = get_term_by( 'name', $cat_name, 'category' ); ?>

	<!-- Insert content here -->
	<div class="main">
		<section class="lazy-container" data-page="category" data-offset="10" data-term_id="<?php echo $term->term_id; ?>">
			<span class="breadcrumbs"><a href="<?php echo site_url('/') ?>">Home</a> / <a href="<?php echo site_url('/categoria/'.$term->slug.'/'); ?>"><?php echo get_category_parents( $term->term_id, true, ' / ' ); ?></a></span>
			<div class="header-category clearfix">
				<h4><?php echo $cat_name; ?></h4>
				<div class="extras-category">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like($term->term_id, 'cat'); ?></p> -->
						<span class="compartir"></span><p><?php echo get_count_share(site_url('/categoria/'.$term->slug.'/')); ?></p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/categoria/'.$term->slug.'/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php if ( have_posts() ) : $count = 1; while( have_posts() ) : the_post();
							if ($count = 1) {
								$url_image = attachment_image_url($post->ID, 'large');
							}
							$count++;
						endwhile; endif; wp_reset_postdata();  ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&media=<?php echo $url_image; ?>&description=<?php echo $cat_name; ?> (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/categoria/'.$term->slug.'/') ?>&media=<?php echo $url_image; ?>&description=<?php echo $cat_name; ?> (Bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul>
				</div>
			</div>
			<?php get_template_part( 'template/cat', 'slide' ); ?>

			<?php if ( have_posts() ) : $count = 1;  while( have_posts() ) : the_post();
				$count_m_home = $count;

				get_template_part( 'template/articulo', 'general' );
				$count++;

			endwhile;

				if(has_previous_posts()): ?><div class="boton mas-entradas"><?php previous_posts_link( '< Anterior' ); ?></div><?php endif;
				if(has_next_posts() && $paged == 1):?>
					<div class="boton mas-entradas right"><?php next_posts_link( 'Más entradas' ); ?></div>
				<?php elseif(has_next_posts()): ?>
					<div class="boton mas-entradas right"><?php next_posts_link( 'Siguiente >' ); ?></div>
				<?php endif;

			endif; wp_reset_postdata(); ?>



		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>


