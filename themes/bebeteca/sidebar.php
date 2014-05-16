<aside id="main_sidebar">
	<div class="banner-aside">

	</div>

	<div class="un-medio">
		<span class="titulo3">
			Suscríbete al newsletter
		</span>
		<form class="forma-news" method="POST" action="<?php echo site_url('/newsletter/') ?>">
			<input type="email" name="email" value="" placeholder="email@mail.com" >
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
					<?php the_post_thumbnail('articulos-side'); ?>
					<h4><?php the_title(); ?></h4>
				</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>

	</div>

	<div class="banner-aside">

	</div>

	<div class="un-medio">
		<p class="siguenos">Síguenos en redes</p>

		<p>falta maquetar</p>
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
</aside><!-- main_sidebar -->