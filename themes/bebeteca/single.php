<?php get_header(); the_post();
$terms  = wp_get_post_terms( get_the_ID(), 'category');
$term_name = $terms[0]->name;
$term_slug = $terms[0]->slug;
?>

	<!-- Insert content here -->
	<div class="main single">
		<section>

			<span class="breadcrumbs">Home/<?php echo $term_name; ?>/<?php the_title(); ?></span>
			<h1><?php the_title(); ?></h1>
			<span class="autor">Autor: <?php the_author_posts_link(); ?></span>

			<div class="header-category">
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p>
						<span class="compartir"></span><p><?php echo get_count_share($post->ID, 'post'); ?></p>
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
			<article class="entero">
				<?php the_post_thumbnail('slider-home'); ?>
				<h3>Subtitulo</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
				<blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</blockquote>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

				<div class="header-category">
					<div class="extras-category">
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
			</article>

			<article class="entero autor-home">
				<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
				<div class="info-autor">
					<h4>Nombre autor</h4>
					<p class="rol">Editora</p>
					<div class="boton">Más sobre el autor</div>
				</div>
				<div class="post-autor">
					<p>I am of the mindset that if you are creative enough you can make anything happen</p>
				</div>
			</article>

			<article class="entero">
				comentarios falta maquetar
			</article>

			<div class="entero divicion">
				<span class="line"></span>
				<h5>Artículos relacionados</h5>
				<span class="line"></span>
			</div>

			<?php get_template_part( 'template/articulo', 'general' ); ?>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>