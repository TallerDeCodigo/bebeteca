<?php


// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


	add_action('init', function(){

		// articulo slider
		$labels = array(
			'name'          => 'Articulos Slider',
			'singular_name' => 'Articulo Slider',
			'add_new'       => 'Nueva Articulo Slider',
			'add_new_item'  => 'Nueva Articulo Slider',
			'edit_item'     => 'Editar Articulo Slider',
			'new_item'      => 'Nueva Articulo Slider',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver Articulo Slider',
			'search_items'  => 'Buscar Articulo Slider',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Articulos Slider'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'articulo-slider' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'taxonomies'         => array( 'category' ),
			'supports'           => array( 'title', 'editor', 'thumbnail', 'author' )
		);
		register_post_type( 'articulo-slider', $args );

		// videos
		$labels = array(
			'name'          => 'Cupones',
			'singular_name' => 'promocion',
			'add_new'       => 'Nueva cupón',
			'add_new_item'  => 'Nueva cupón',
			'edit_item'     => 'Editar cupón',
			'new_item'      => 'Nueva cupón',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver cupón',
			'search_items'  => 'Buscar cupón',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Cupones'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'promociones' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( 'promociones', $args );


		$labels = array(
			'name'          => 'Contactos',
			'singular_name' => 'contacto',
			'add_new'       => 'Nueva contacto',
			'add_new_item'  => 'Nueva contacto',
			'edit_item'     => 'Editar contacto',
			'new_item'      => 'Nueva contacto',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver contacto',
			'search_items'  => 'Buscar contacto',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Contactos'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'contactos' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor' )
		);
		register_post_type( 'contactos', $args );

	});