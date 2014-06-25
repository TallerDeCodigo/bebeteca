<?php get_header(); the_post();
// if (isset($_POST['email'])) $news_resp = save_mail_for_newsletter($_POST['email']);
$news_resp = isset($news_resp) ? $news_resp : '';
?>

	<!-- Insert content here -->
	<div class="main single">
		<section>

			<span class="breadcrumbs">Home/Newsletter</span>
			<h1>Newsletter</h1>
			<div class="header-category">
				<div class="extras-category">
					<div class="extras">
						<!-- <span class="megusta verde"></span><p><?php echo get_count_like($post->ID, 'post'); ?></p> -->
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
			<article class="entero news">
					<blockquote>¡Gracias por registrarte<br /> a nuestro newsletter!</blockquote>
				<img src="<?php echo THEMEPATH; ?>images/logo.png">

			</article>

			<article class="entero">

			</article>


		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>