<?php get_header(); ?>
	<!-- Insert content here -->
	<div class="main">
		<section>
			<span class="breadcrumbs">Home/Embrazo</span>
			<div class="header-category">
				<h4>Embarazo</h4>
				<div class="extras-category">
					<div class="extras">
						<span class="megusta verde"></span><p>190</p>
						<span class="compartir"></span><p>340</p>
					</div>
					<span>Comparte</span>
					<ul>
						<li class="fb">
							<a rel="nofollow" onclick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('/videos/') ?>&t=Promociones', '_blank', 'height=365,width=660'); return false;" href="http://www.facebook.com/share.php?u=<?php echo site_url('/videos/') ?>" target="_blank"></a>
						</li>

						<li class="tw">
							<a rel="nofollow" onclick="window.open('http://twitter.com/home?status=<?php echo site_url('/videos/') ?>', '_blank', 'height=365,width=660'); return false;" href="http://twitter.com/home?status=<?php echo site_url('/videos/') ?>" target="_blank" ></a>
						</li>

						<li class="gm">
							<a href="https://plus.google.com/share?url=<?php echo site_url('/videos/') ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
						</li>

						<?php $url_image = ''; ?>
						<li class="pr">
							<a rel="nofollow" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo site_url('/videos/') ?>&media=<?php echo $url_image; ?>&description=Videos (Bebeteca)', '_blank', 'height=365,width=660'); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo site_url('/videos/') ?>&media=<?php echo $url_image; ?>&description=Videos (Bebeteca)" target="_blank" ></a>
						</li>
						<li class="mail">
							<a href=""></a>
						</li>
					</ul>
				</div>
			</div>
			<article class="entero">
				<span class="titulo1">Entrevistas</span>

				<div class="slider-principal videos">
					<img class="play_1" src="<?php echo THEMEPATH; ?>images/play_1.png">
					<img src="<?php echo THEMEPATH; ?>images/img1.jpg">
				</div>

				<div class="footer-slide">
					<h4>9 Last-Minute Ways to Prep for Baby</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>

					<div class="extras">
						<span class="megusta verde"></span><p>190</p>
						<span class="compartir"></span><p>340</p>
					</div>
				</div>
			</article><!-- SLIDE -->

			<article class="entero article-gral">
				<a href="">
					<span class="titulo1 pleca-embarazo">Embarazo</span>
					<img class="play_2" src="<?php echo THEMEPATH; ?>images/play_2.png">
					<img src=" <?php echo THEMEPATH; ?>images/img3.jpg">
					<h4>9 Last-Minute Ways to Prep for Baby</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>
					<div class="extras">
						<span class="megusta"></span><p>190</p>
						<span class="compartir"></span><p>340</p>
					</div>
				</a>
			</article>

			<article class="entero article-gral">
				<a href="">
					<span class="titulo1 pleca-nacimiento">Nacimiento</span>
					<img src="<?php echo THEMEPATH; ?>images/img4.jpg">
					<h4>9 Last-Minute Ways to Prep for Baby</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>
					<div class="extras">
						<span class="megusta"></span><p>190</p>
						<span class="compartir"></span><p>340</p>
					</div>
				</a>
			</article>

			<article class="entero article-gral">
				<a href="">
					<span class="titulo1 pleca-nutricion">Nutrición</span>
					<img src="<?php echo THEMEPATH; ?>images/img3.jpg">
					<h4>9 Last-Minute Ways to Prep for Baby</h4>
					<p>Everything you need to check off your list before that D-day dawns.</p>
					<div class="extras">
						<span class="megusta"></span><p>190</p>
						<span class="compartir"></span><p>340</p>
					</div>
				</a>
			</article>

			<article class="entero article-gral">
				<span class="titulo1 pleca-lactancia">Lactancia</span>
				<img src="<?php echo THEMEPATH; ?>images/img4.jpg">
				<h4>9 Last-Minute Ways to Prep for Baby</h4>
				<p>Everything you need to check off your list before that D-day dawns.</p>
				<div class="extras">
					<span class="megusta"></span><p>190</p>
					<span class="compartir"></span><p>340</p>
				</div>
			</article>

			<div class="boton mas-entradas">Mas entradas ></div>

		</section>
		<?php get_sidebar(); ?>
	</div>


	<?php get_footer(); ?>