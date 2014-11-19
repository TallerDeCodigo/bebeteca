<aside id="main_sidebar">
	<div class="banner-aside">
		<!-- BoxBanner_Top_Home -->
		<div id='div-gpt-ad-1413996590367-3' style='width:100%; height:auto;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1413996590367-3'); });
			</script>
		</div>
	</div>

	<div class="un-medio">
		<span class="titulo3">
			Suscríbete al newsletter
		</span>
		<form id="form-newsletter" class="forma-news">
			<input type="email" name="news-email" id="news-email" value="" placeholder="email@mail.com" >
			<input type="submit" value="Enviar">
		</form>
	</div>
	<?php
		if( is_single() OR is_singular() ){

			get_template_part('template/lado', 'relacionados' );
		}else{

			get_template_part('template/lado', 'nuevos' );
		}

	?>

	<div class="banner-aside">
		<!-- BoxBanner_Bottom_Home -->
		<div id='div-gpt-ad-1413996590367-2' style='width:300px; height:250px;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1413996590367-2'); });
			</script>
		</div>
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
	</div>

	<div class="un-medio pb destacados">
		<span class="titulo4">
			Lo más visto
		</span>

		<!-- Showing latest, Analytics API thing -->

		<?php if (function_exists('lo_mas_visto_GA')):
			$posts = lo_mas_visto_GA();
			if (!empty($posts)) :
				foreach ($posts as $key => $visto) :
					if (isset($visto['post_id']) AND $visto['post_id'] != ''):
						$post = get_posts( array('post__in' => array($visto['post_id']) ) ); ?>

						<div class="caja-ultimos">
							<a href="<?php echo get_permalink($post[0]->ID); ?>">
								<?php  echo get_the_post_thumbnail( $post[0]->ID, 'articulos-side' ); ?>
								<h4><?php echo $post[0]->post_title; ?></h4>
							</a>
						</div>

					<?php endif;
				endforeach;
			endif;
		endif;?>

	</div>

	<!-- <div class="un-medio pb destacados">
		<span class="titulo4">
			Lo más comentado
		</span>

		<?php
			$facebook = new Comments\Facebook();
			$comentados = $facebook->getComentados();


		if( $comentados ) : foreach (array_slice($comentados, 0, 5) as $post) : setup_postdata($post); ?>

			<div class="caja-ultimos">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('articulos-side'); ?>
					<h4><?php the_title(); ?></h4>
				</a>
			</div>

		<?php endforeach; endif; wp_reset_postdata(); ?>

	</div> -->
</aside><!-- main_sidebar -->