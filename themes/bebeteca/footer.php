</div><!-- container -->
		<footer>
			<div class="content-footer">
				<div class="footer-parte1">
					<img src="<?php echo THEMEPATH; ?>images/logo-footer.png">
					<ul class="redes-footer">
						<li class="fb"><a href="https://www.facebook.com/labbteca"></a></li>
						<li class="tw"><a href=""></a></li>
						<li class="gm"><a href=""></a></li>
					</ul>
					<p><a href="<?php echo site_url('/terminos-y-condiciones/'); ?>">Términos y condiciones</a></p>
					<p><a href="<?php echo site_url('/alianzas-y-colaboradores/'); ?>">Alianzas y colaboradores</a></p>
					<p><a href="<?php echo site_url('/contacto/'); ?>">Contáctanos</a></p>
				</div>
				<div class="footer-partesitas">
					<strong>Embarazo</strong>
					<ul>

						<?php $term = get_term_by( 'name', 'embarazo', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Nacimiento</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'nacimiento', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Día a Día</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'día a día', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Entrevistas</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'entrevistas', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Lactancia</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'lactancia', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Nutrición</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'nutricion', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Estimulación</strong>
					<ul>
						<?php $term = get_term_by( 'name', 'estimulacion', 'category' );
						$termchildren = get_term_children( $term->term_id, 'category' );
						foreach ( $termchildren as $child ) {
							$term = get_term_by( 'id', $child, 'category' );
							echo '<li><a href="' . get_term_link( $child, 'category' ) . '">' . $term->name . '</a></li>';
						}?>
					</ul>
				</div>
				<div class="footer-partesitas">
					<strong>Promociones</strong>
					<ul>
					<!-- 	<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li>
						<li><a href="">Subcategoria</a></li> -->
					</ul>
				</div>
				<p class="sueltos"><a href="<?php echo site_url('/aviso-privacidad/'); ?>">Aviso de privacidad</a></p>
				<p class="sueltos"><a href="<?php echo site_url('/derechos-reservados/'); ?>">La Bebeteca, algunos derechos reservados, 2014</a></p>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>

</html>
