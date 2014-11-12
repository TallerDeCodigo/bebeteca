<nav id="main-menu-mb" class="si-mobile">
	<ul>
		<li class="bg-embarazo boton <?php nav_is('embarazo');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/embarazo/'); ?>">Embarazo</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'name', 'embarazo', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable; ?>
			</ul>

		</li>
		<li class="bg-nacimiento boton <?php nav_is('nacimiento');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/nacimiento/'); ?>">Nacimiento</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'name', 'nacimiento', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable;?>
			</ul>

		</li>
		<li class="bg-dia-a-dia boton <?php nav_is('dia-a-dia');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/dia-a-dia/'); ?>">Día a Día</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'slug', 'dia-a-dia', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable;?>
			</ul>

		</li>
		<li class="bg-estimulacion boton <?php nav_is('estimulacion');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/estimulacion/'); ?>">Estimulación</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'name', 'estimulacion', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable; ?>
			</ul>

		</li>


		<li class="bg-lactancia boton <?php nav_is('lactancia');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/lactancia/'); ?>">Lactancia</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'name', 'lactancia', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable; ?>
			</ul>

		</li>

		<li class="bg-entrevistas boton <?php nav_is('entrevistas');?>"><a class="mnu-a" href="<?php echo site_url('/categoria/entrevistas/'); ?>">Entrevistas</a>

			<ul class="subcategorias">
				<?php $term = get_term_by( 'name', 'entrevistas', 'category' );
				$variable = wp_list_categories( array('taxonomy' => 'category','child_of' => $term->term_id, 'title_li' => '', 'show_option_none'   => __( '' ), 'orderby'=> 'id') );
				$variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
				echo $variable;?>
			</ul>

		</li>

	</ul>
</nav>