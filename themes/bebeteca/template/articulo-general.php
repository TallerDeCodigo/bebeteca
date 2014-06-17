<?php $terms  = wp_get_post_terms( get_the_ID(), 'category');
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
	}
?>

	<article class="entero article-gral">
		<a href="<?php the_permalink(); ?>">
			<?php $id_vimeo = get_post_meta( $post->ID, 'id_vimeo', true );
			$id_youtube = get_post_meta( $post->ID, 'id_youtube', true );
			if ($id_vimeo != '' OR $id_youtube != '' OR $term_slug == 'entrevistas') { ?>
				<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
			<?php }?>

			<?php if ($term_name != ''): ?><span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span><?php endif; ?>
			<?php the_post_thumbnail('articulos-gral'); ?>
			<h4><?php echo wp_trim_words( get_the_title(), 6, '...'); ?></h4>
			<p><?php echo wp_trim_words( get_the_excerpt(), 10 ) ?></p>
			<div class="extras">
				<span class="megusta"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
				<span class="compartir"></span><p><?php echo get_count_share(get_permalink()); ?></p>
			</div>
		</a>
	</article>
