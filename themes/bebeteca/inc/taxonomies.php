<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////


	add_action( 'init', 'custom_taxonomies_callback', 0 );

	function custom_taxonomies_callback(){

		// AUTORES
		/*if( ! taxonomy_exists('autores')){

			$labels = array(
				'name'              => 'Autores',
				'singular_name'     => 'Autor',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todos',
				'edit_item'         => 'Editar Autor',
				'update_item'       => 'Actualizar Autor',
				'add_new_item'      => 'Nuevo Autor',
				'new_item_name'     => 'Nombre Nuevo Autor',
				'menu_name'         => 'Autores'
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'autores' ),
			);

			register_taxonomy( 'autor', 'libro', $args );
		}*/
		
		
		// TERMS
		if ( ! term_exists( 'Embarazo', 'category' ) ){
			wp_insert_term( 'Embarazo', 'category' );
		}

		if ( ! term_exists( 'Nacimiento', 'category' ) ){
			wp_insert_term( 'Nacimiento', 'category' );
		}

		if ( ! term_exists( 'Día a Día', 'category' ) ){
			wp_insert_term( 'Día a Día', 'category' );
		}

		if ( ! term_exists( 'Estimulación', 'category' ) ){
			wp_insert_term( 'Estimulación', 'category' );
		}

		if ( ! term_exists( 'Nutrición', 'category' ) ){
			wp_insert_term( 'Nutrición', 'category' );
		}

		if ( ! term_exists( 'Lactancia', 'category' ) ){
			wp_insert_term( 'Lactancia', 'category' );
		}

		if ( ! term_exists( 'Entrevistas', 'category' ) ){
			wp_insert_term( 'Entrevistas', 'category' );
		}
	}
