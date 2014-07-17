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
				<blockquote>Te hemos enviado un correo electrónico para confirmar tu registro.</blockquote>
				<a href="<?php echo site_url('/'); ?>"><img src="<?php echo THEMEPATH; ?>images/logo.png"></a>

			</article>

			<article class="entero news-sigue">
				<p class="siguenos">Síguenos en redes</p>
				<ul class="redes-siguenos">
					<li class="fb active-red">facebook</li>
					<li class="tw">twitter</li>
					<li class="gm">goggle +</li>
				</ul>
				<div class="bt-siguenos fb">
					<span class="triangulo"></span>
					<div class="fb-like" data-href="https://www.facebook.com/labbteca" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				</div>
				<div class="bt-siguenos tw">
					<span class="triangulo"></span>
					<a href="https://twitter.com/la_bebeteca" class="twitter-follow-button" data-show-count="false">Follow @HacemosCodigo</a>
				</div>
				<div class="bt-siguenos gm">
					<span class="triangulo"></span>
					<!-- Place this tag where you want the share button to render. -->
					<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/116499142736660749871/about" data-rel="author"></div>
				</div>
			</article>


		</section>

		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>