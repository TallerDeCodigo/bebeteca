<?php global $destacados_home; ?>
<section class="si-mobile">
	<article class="entero">
		<h4 class="tit_principal">Artículos Destacados</h4>
		<?php if (have_posts() ) : $count = 1; while( have_posts() ) : the_post();
			$destacados_home = $count;
			get_template_part( 'template/articulo', 'general' );

		$count++; endwhile; endif; wp_reset_postdata(); ?>

		<!-- MAS VISTOS RESPONSIVE -->

		<h4 class="tit_principal">Artículos más vistos</h4>
		<?php if (function_exists('lo_mas_visto_GA')):
			$posts = lo_mas_visto_GA();
			if (!empty($posts)) :
				foreach ($posts as $key => $visto) :
					if (isset($visto['post_id']) AND $visto['post_id'] != ''):

						$post = get_posts( array('post__in' => array($visto['post_id']) ) );
						global $destacados_home;

						$terms  = wp_get_post_terms( $post[0]->ID, 'category');
							if (!empty($terms)) {
								foreach ($terms as $term) {
									if($term->parent == 0){
										$term_name = $term->name;
										$term_slug = $term->slug;
									}
								}
							}else{
								$term_name = '';
								$term_slug = '';
							}

							$postype = get_post_type(get_the_ID());
							if ($postype == 'promociones') {
								$term_name = 'Promociones';
								$term_slug = 'promociones';
							}

							$class_primero = ($destacados_home == 1) ? 'primer_post' : '';
							$class_content = ($destacados_home == 1) ? 'primer_content' : '';?>

						<article class="entero article-gral clearfix <?php echo $class_primero; ?>">
							<a href="<?php echo get_permalink($post[0]->ID); ?>">
								<?php $id_vimeo = get_post_meta( $post[0]->ID, 'id_vimeo', true );
								$id_youtube = get_post_meta( $post[0]->ID, 'id_youtube', true );
								if ($id_vimeo != '' OR $id_youtube != '' OR $term_slug == 'entrevistas') { ?>
									<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
								<?php }?>

								<?php if ($term_name != ''): ?><span class="titulo1 no-mobile pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span><?php endif; ?>
								<?php echo get_the_post_thumbnail($post[0]->ID, 'articulos-gral', array( 'class' => 'img-gral1' ));
								if ($destacados_home == 1) {
									echo get_the_post_thumbnail($post[0]->ID, 'slider-home', array( 'class' => 'img-gral2' ));
								}else{
									echo get_the_post_thumbnail($post[0]->ID, 'thumbnail', array( 'class' => 'img-gral2 img-resp' ));
								} ?>
								<div class="cont-info-gral <?php echo $class_content; ?>">
									<span class="franja si-mobile franja-<?php echo $term_slug; ?>"></span>
									<h4><?php echo $post[0]->post_title; ?></h4>
								</div>

							</a>
						</article>

					<?php endif;
				endforeach;
			endif;
		endif;?>


	</article><!-- SLIDE -->

</section>