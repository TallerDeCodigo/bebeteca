<?php get_header(); the_post();?>

	<!-- Insert content here -->
	<div class="main single">
		<section>

			<span class="breadcrumbs">Home/<?php the_title(); ?></span>
			<h1><?php the_title(); ?></h1>

			<article class="entero">
				<?php the_content(); ?>
			</article>

		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>