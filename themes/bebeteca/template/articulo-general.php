<?php $terms  = wp_get_post_terms( get_the_ID(), 'category');
			$term_name = $terms[0]->name;
			$term_slug = $terms[0]->slug;?>

	<article class="entero article-gral">
		<a href="<?php the_permalink(); ?>">
			<span class="titulo1 pleca-<?php echo $term_slug; ?>"><?php echo $term_name; ?></span>
			<?php the_post_thumbnail('articulos-gral'); ?>
			<h4><?php the_title(); ?></h4>
			<p><?php echo wp_trim_words( get_the_excerpt(), 23 ) ?></p>
			<div class="extras">
				<span class="megusta"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
				<span class="compartir"></span><p><?php echo get_count_share($post->ID, 'post'); ?></p>
			</div>
		</a>
	</article>