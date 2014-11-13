<?php global $exclude;
global $wp_query;

$cat_name = single_cat_title( '', false );
$term     = get_term_by( 'name', $cat_name, 'category' );
$post_general = query_categorias_slide($term->term_id);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if ( $post_general->have_posts() AND $paged == 1) :?>
	<article class="entero shadow entero-slide">

		<div id="slider-principal" class="slider-principal no-tablet">
			<ul class="bullets clearfix pleca">
				<?php if ($post_general->have_posts() ) : $contador=0; while( $post_general->have_posts() ) : $post_general->the_post(); $exclude[] = $post->ID;
					$terms  = categoria_papa_post();
					if (!empty($terms)) {
						$term_name = $terms->name;
						$term_slug = $terms->slug;
					}else{
						$term_name = '';
						$term_slug = '';
					}

					$postype = get_post_type(get_the_ID());
					if ($postype == 'promociones') {
						$term_name = 'Promociones';
						$term_slug = 'promociones';
					}
					if ($term_name != ''): ?>
							<li class="bullet" data-slide="<?php echo $contador; ?>">
								<span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span>
								<a href="#" ></a>
							</li>
					<?php endif;
				$contador++; endwhile; endif; wp_reset_postdata(); ?>
			</ul>
			<a class="flecha_carrusel prev" href="#"></a>
			<div class="viewport">
				<ul class="overview">
					<?php while( $post_general->have_posts() ) : $post_general->the_post(); ?>
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

					<?php $exclude[] = $post->ID;
					endwhile; ?>
				</ul>
			</div>
			<a class="flecha_carrusel next" href="#"></a>

		</div>


		<div class='slider-container si-tablet'>
		 	<div class='slider'>
		 		<div class='flexslider'>
		 			<ol class="flex-control-nav flex-control-paging bullets2">
		 				<?php if ($post_general->have_posts() ) : $contador=0; while( $post_general->have_posts() ) : $post_general->the_post();
							$terms  = categoria_papa_post();
							if (!empty($terms)) {
								$term_name = $terms->name;
								$term_slug = $terms->slug;
							}else{
								$term_name = '';
								$term_slug = '';
							}

							$postype = get_post_type(get_the_ID());
							if ($postype == 'promociones') {
								$term_name = 'Promociones';
								$term_slug = 'promociones';
							}
							if ($term_name != ''): ?>
									<li>

										<a href="#" >
											<span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span>
											<span class="bola"></span>
										</a>
									</li>
							<?php endif;
						$contador++; endwhile; endif; wp_reset_postdata(); ?>
		 			</ol>


		 			<ul class='slides'>
						<?php while( $post_general->have_posts() ) : $post_general->the_post(); ?>
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
									<p class="excertp-p"><?php echo wp_trim_words( get_the_excerpt(), 12 ) ?></p>

									<div class="extras">
										<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
										<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
									</div>
								</div>
							</a>
						</li>

					<?php
					endwhile; ?>
					</ul>
				</div>
			</div>
		</div>

	</article><!-- SLIDE -->


<?php endif; wp_reset_postdata(); ?>