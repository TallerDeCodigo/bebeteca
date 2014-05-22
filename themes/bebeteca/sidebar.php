<aside id="main_sidebar">
	<div class="banner-aside">

	</div>

	<div class="un-medio">
		<span class="titulo3">
			Suscríbete al newsletter
		</span>
		<form action="http://www.us8.list-manage.com/subscribe/post?u=534e428797ba0f0ecd9f3ba5a&amp;id=f522eb0cdf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate forma-news" target="_blank" novalidate>
			<input type="email" name="EMAIL" id="mce-EMAIL" value="" placeholder="email@mail.com" >
			<input type="submit" value="Enviar">
		</form>
	</div>

	<div class="un-medio pb">
		<span class="titulo3 verde">
			Últimos Artículos
		</span>
		<?php $post_general = new WP_Query(array( 'posts_per_page' => 3, 'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider') ) );
			if ( $post_general->have_posts() ) : while( $post_general->have_posts() ) : $post_general->the_post(); ?>

				<div class="caja-ultimos">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('articulos-side'); ?>
						<h4><?php the_title(); ?></h4>
					</a>
				</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>

	</div>

	<div class="banner-aside">

	</div>

	<div class="un-medio">
		<p class="siguenos">Síguenos en redes</p>
		<ul class="redes-siguenos">
			<li class="fb active-red">facebook</li>
			<li class="tw">twitter</li>
			<li class="gm">goggle +</li>
		</ul>
		<div class="bt-siguenos fb">
			<span class="triangulo"></span>
			<div class="fb-like" data-href="<?php echo site_url('/') ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
		</div>
		<div class="bt-siguenos tw">
			<span class="triangulo"></span>
			<a href="https://twitter.com/HacemosCodigo" class="twitter-follow-button" data-show-count="false">Follow @HacemosCodigo</a>
		</div>
		<div class="bt-siguenos gm">
			<span class="triangulo"></span>
			<!-- Place this tag where you want the share button to render. -->
			<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/u/0/118300723396545429987" data-rel="author"></div>
		</div>
	</div>

	<div class="un-medio pb destacados">
		<span class="titulo4">
			Lo más visto
		</span>

		<div class="caja-ultimos">
			<img src="<?php echo THEMEPATH; ?>images/img1.jpg">
			<h4>Disappointing Pregnancy Announcement</h4>
		</div>
		<div class="caja-ultimos">
			<img src="<?php echo THEMEPATH; ?>images/img2.jpg">
			<h4>Disappointing Pregnancy Announcement</h4>
		</div>
		<div class="caja-ultimos">
			<img src="<?php echo THEMEPATH; ?>images/img3.jpg">
			<h4>Disappointing Pregnancy Announcement</h4>
		</div>
		<div class="caja-ultimos">
			<img src="<?php echo THEMEPATH; ?>images/img4.jpg">
			<h4>Disappointing Pregnancy Announcement</h4>
		</div>
	</div>

	<div class="un-medio pb destacados">
		<span class="titulo4">
			Lo más comentado
		</span>

		<?php $facebook = new Comments\Facebook();
			$comentados = $facebook->getComentados();

		if( $comentados ) : foreach (array_slice($comentados, 0, 5) as $post) : setup_postdata($post); ?>

			<div class="caja-ultimos">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('articulos-side'); ?>
					<h4><?php the_title(); ?></h4>
				</a>
			</div>

		<?php endforeach; endif; wp_reset_postdata(); ?>

	</div>
</aside><!-- main_sidebar -->