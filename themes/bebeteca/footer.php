
</div><!-- container -->
		<div class="banner-bottom shadow">
				<!-- Bebeteca_Header_Leaderboard -->
				<div id='div-gpt-ad-1412961425093-1' style='width:728px; height:90px;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1412961425093-1'); });
					</script>
				</div>
			</div>
		<footer>
			<?php wp_footer(); ?>
			<div class="content-footer">
				<div class="footer-parte1">
					<img src="<?php echo THEMEPATH; ?>images/logo-footer.png">
					<ul class="redes-footer">
						<li class="fb"><a href="https://www.facebook.com/labbteca"></a></li>
						<li class="tw"><a href="https://twitter.com/la_bebeteca"></a></li>
						<li class="gm"><a href="https://plus.google.com/116499142736660749871/about"></a></li>
					</ul>
					<p><a href="<?php echo site_url('/terminos-y-condiciones/'); ?>">Términos y condiciones</a></p>
					<p><a href="<?php echo site_url('/responsabilidad-limitada/'); ?>">Responsabilidad Limitada</a></p>
					<p><a href="<?php echo site_url('/alianzas-y-colaboradores/'); ?>">Alianzas y colaboradores</a></p>
					<p><a href="<?php echo site_url('/contacto/'); ?>">Contáctanos</a></p>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/embarazo/'); ?>"><strong>Embarazo</strong></a>
					<ul>

						<?php $term = get_term_by( 'name', 'embarazo', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );

						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/nacimiento/'); ?>"><strong>Nacimiento</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'nacimiento', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/dia-a-dia/'); ?>"><strong>Día a Día</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'día a día', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/entrevistas/'); ?>"><strong>Entrevistas</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'entrevistas', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/lactancia/'); ?>"><strong>Lactancia</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'lactancia', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<!-- <div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/nutricion/'); ?>"><strong>Nutrición</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'nutricion', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div> -->
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/categoria/estimulacion/'); ?>"><strong>Estimulación</strong></a>
					<ul>
						<?php $term = get_term_by( 'name', 'estimulacion', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						if(!is_wp_error($termchildren))
							foreach ( $termchildren as $child ) {
								$term = get_term_by( 'id', $child, 'category' );
								echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
							}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<a href="<?php echo site_url('/promociones/'); ?>"><strong>Promociones</strong></a>
					<ul>
					<!-- 	<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li> -->
					</ul>
				</div>
				<p class="sueltos"><a href="<?php echo site_url('/aviso-privacidad/'); ?>">Aviso de privacidad</a></p>
				<p class="sueltos">La Bebeteca, algunos derechos reservados, 2014</p>
			</div>
		</footer>
		<script>
		  	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  	ga('create', 'UA-52466330-1', 'auto');
		  	ga('send', 'pageview');

		</script>

	</body>

</html>
