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
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( 'articulo-slider', $args );

		// videos
		$labels = array(
			'name'          => 'Videos',
			'singular_name' => 'Video',
			'add_new'       => 'Nueva Video',
			'add_new_item'  => 'Nueva Video',
			'edit_item'     => 'Editar Video',
			'new_item'      => 'Nueva Video',
			'all_items'     => 'Todas',
			'view_item'     => 'Ver Video',
			'search_items'  => 'Buscar Video',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Videos'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'videos' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'taxonomies'         => array( 'category' ),
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type( 'videos', $args );

	});