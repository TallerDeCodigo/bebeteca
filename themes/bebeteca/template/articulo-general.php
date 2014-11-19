<?php
global $count_m_home;

$terms  = wp_get_post_terms( get_the_ID(), 'category');
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

	// $class_ultimos = ($count_m_home >= 5) ? 'posts-tablet' : '';
	$class_ultimos = '';

	$class_medida  = ($count_m_home == 1) ? 'img-medida' : '';
	if ($count_m_home%3==1 AND $count_m_home > 1) : ?>

	<?php endif; ?>

	<article class="entero article-gral <?php echo $class_ultimos; ?>">
		<a href="<?php the_permalink(); ?>">
			<?php $id_vimeo = get_post_meta( $post->ID, 'id_vimeo', true );
			$id_youtube = get_post_meta( $post->ID, 'id_youtube', true );
			if ($id_vimeo != '' OR $id_youtube != '' OR $term_slug == 'entrevistas') { ?>
				<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
			<?php }?>

			<?php if ($term_name != ''): ?><span class="titulo1 no-mobile pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span><?php endif; ?>
			<?php the_post_thumbnail('articulos-gral', array( 'class' => 'img-gral1' ));

			the_post_thumbnail('thumbnail', array( 'class' => 'img-gral2 img-resp '.$class_medida ));?>
			<div class="cont-info-gral">
				<span class="franja si-mobile franja-<?php echo $term_slug; ?>"></span>
				<h4><?php echo excerpt(50, get_the_title()); ?></h4>
				<p class="no-tablet"><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p>
			</div>
			<div class="extras">
				<!-- <span class="megusta"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
				<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
			</div>

		</a>
	</article>

