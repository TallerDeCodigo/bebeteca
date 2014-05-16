<?php


// DEFINIR LOS PATHS A LOS DIRECTORIOS DE JAVASCRIPT Y CSS ///////////////////////////



	define( 'JSPATH', get_template_directory_uri() . '/js/' );

	define( 'CSSPATH', get_template_directory_uri() . '/css/' );

	define( 'THEMEPATH', get_template_directory_uri() . '/' );

	define( 'SITEURL', site_url('/') );



// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////



	add_action( 'wp_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );

		// localize scripts
		wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );

		// styles
		wp_enqueue_style( 'styles', get_stylesheet_uri() );

	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );

		// localize scripts
		wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );

		// styles
		wp_enqueue_style( 'admin-css', CSSPATH.'admin.css' );

	});



// FRONT PAGE DISPLAYS A STATIC PAGE /////////////////////////////////////////////////



	/*add_action( 'after_setup_theme', function () {

		$frontPage = get_page_by_path('home', OBJECT);
		$blogPage  = get_page_by_path('blog', OBJECT);

		if ( $frontPage AND $blogPage ){
			update_option('show_on_front', 'page');
			update_option('page_on_front', $frontPage->ID);
			update_option('page_for_posts', $blogPage->ID);
		}
	});*/



// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////



	add_filter( 'show_admin_bar', function($content){
		return ( current_user_can('administrator') ) ? $content : false;
	});



// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////



	add_filter( 'admin_footer_text', function() {
		echo 'Creado por <a href="http://hacemoscodigo.com">Los Maquiladores</a>. ';
		echo 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});



// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////



	if ( function_exists('add_theme_support') ){
		add_theme_support('post-thumbnails');
	}

	if ( function_exists('add_image_size') ){

		add_image_size( 'slider-home', 620, 356, true );
		add_image_size( 'medio-home', 300, 224, true );
		add_image_size( 'articulos-gral', 219, 165, true );
		add_image_size( 'articulos-side', 81, 61, true );



		/**
		 * Remove standard image sizes so that these sizes are not
		 */
		function sgr_filter_image_sizes( $sizes) {

		    unset( $sizes['medium']);
		    unset( $sizes['large']);

		    return $sizes;
		}
		add_filter('intermediate_image_sizes_advanced', 'sgr_filter_image_sizes');
	}



// POST TYPES, METABOXES, TAXONOMIES AND CUSTOM PAGES ////////////////////////////////



	require_once('inc/post-types.php');


	require_once('inc/metaboxes.php');


	require_once('inc/taxonomies.php');


	require_once('inc/pages.php');


	require_once('inc/users.php');

	require_once('inc/functions-admin.php');



// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		if ( $query->is_main_query() and ! is_admin() ) {

			if ((is_category() || is_home() ) AND !is_category('entrevistas')) {
				$query->set( 'posts_per_page', 4 );
				$query->set( 'post_type', array('post', 'articulo-slider') );

				$meta_query = array(
								array(
									'key'     => 'slider_categoria',
									'value'   => true,
									'compare' => '='
								)
							);
				$query->set( 'meta_query', $meta_query );
				$query->set( 'meta_key', 'slider_categoria' );
			}

			if(is_category('entrevistas')){
				$query->set( 'posts_per_page', 8 );
			}


		}
		return $query;

	});


// REGISTER POST STATUS //////////////////////////////////////////////////////////////

function my_custom_post_status(){
	register_post_status( 'slide_post', array(
		'label'                     => _x( 'slide_post', 'articulo-slider' ),
		'public'                    => true,
		'exclude_from_search'       => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'slide_post <span class="count">(%s)</span>', 'slide_post <span class="count">(%s)</span>' ),
	) );
}
add_action( 'init', 'my_custom_post_status' );

add_action('admin_footer-post.php', 'jc_append_post_status_list');
function jc_append_post_status_list(){
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'articulo-slider'){
          if($post->post_status == 'slide_post'){
               $complete = ' selected=\"selected\"';
               $label = '<span id=\"post-status-display\"> slide_post</span>';
          }
          echo '
          <script>
          jQuery(document).ready(function($){
               $("select#post_status").append("<option value=\"slide_post\" '.$complete.'>slide_post</option>");
               $(".misc-pub-section label").append("'.$label.'");
          });
          </script>
          ';
     }
}


function jc_display_archive_state( $states ) {
     global $post;
     $arg = get_query_var( 'post_status' );
     if($arg != 'slide_post'){
          if($post->post_status == 'slide_post'){
               return array('slide_post');
          }
     }
    return $states;
}
add_filter( 'display_post_states', 'jc_display_archive_state' );


// THE EXECRPT FORMAT AND LENGTH /////////////////////////////////////////////////////



	/*add_filter('excerpt_length', function($length){
		return 20;
	});*/


	/*add_filter('excerpt_more', function(){
		return ' &raquo;';
	});*/



// REMOVE ACCENTS AND THE LETTER Ñ FROM FILE NAMES ///////////////////////////////////



	add_filter( 'sanitize_file_name', function ($filename) {
		$filename = str_replace('ñ', 'n', $filename);
		return remove_accents($filename);
	});



// HELPER METHODS AND FUNCTIONS //////////////////////////////////////////////////////



	/**
	 * Print the <title> tag based on what is being viewed.
	 * @return string
	 */
	function print_title(){
		global $page, $paged;

		wp_title( '|', true, 'right' );
		bloginfo( 'name' );

		// Add a page number if necessary
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( __( 'Página %s' ), max( $paged, $page ) );
		}
	}



	/**
	 * Imprime una lista separada por commas de todos los terms asociados al post id especificado
	 * los terms pertenecen a la taxonomia especificada. Default: Category
	 *
	 * @param  int     $post_id
	 * @param  string  $taxonomy
	 * @return string
	 */
	function print_the_terms($post_id, $taxonomy = 'category'){
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms and ! is_wp_error($terms) ){
			$names = wp_list_pluck($terms ,'name');
			echo implode(', ', $names);
		}
	}



	/**
	 * Regresa la url del attachment especificado
	 * @param  int     $post_id
	 * @param  string  $size
	 * @return string  url de la imagen
	 */
	function attachment_image_url($post_id, $size){
		$image_id   = get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, $size, true);
		echo isset($image_data[0]) ? $image_data[0] : '';
	}



	/**
	 * Imprime active si el string coincide con la pagina que se esta mostrando
	 * @param  string $string
	 * @return string
	 */
	function nav_is($string = ''){
		$query = get_queried_object();

		if( isset($query->slug) AND preg_match("/$string/i", $query->slug)
			OR isset($query->name) AND preg_match("/$string/i", $query->name)
			OR isset($query->rewrite) AND preg_match("/$string/i", $query->rewrite['slug'])
			OR isset($query->post_title) AND preg_match("/$string/i", remove_accents(str_replace(' ', '-', $query->post_title) ) ) )
			echo 'active';
	}


	/**
	 * CUENTA LOS MEGUSTA
	 */
	function get_count_like($id, $tipo){
		return '290';
	}

	/**
	 * CUENTA LAS VECES QUE SE COMPARTIO
	 */
	function get_count_share($id, $tipo){
		return '150';
	}


	function return_posts_slide($post_parent_id){
		return new WP_Query(array( 'posts_per_page' => -1, 'post_type' => array('articulo-slider'), 'post_parent' => $post_parent_id, 'post_status'=>'slide_post', 'orderby' => 'ID', 'order' => 'ASC' ) );

	}

	// CREAR TABLA PARA GUARDAR EL MAIL PARA NEWSLETTER //////////////////////////////////////////////////////

	add_action('init', function(){
		global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}newsletter (
				news_id bigint(20) NOT NULL AUTO_INCREMENT,
				email VARCHAR(40) NOT NULL DEFAULT '',
				PRIMARY KEY (email),
				UNIQUE KEY `news_id` (`news_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);

	});

	/**
	 * GUARDA MAIL PARA ENVIO DE NEWSLETTER
	 */
	function save_mail_for_newsletter($email){
		global $wpdb;
		$table_name = $wpdb->prefix . "newsletter";
		return $wpdb->insert(
				$table_name,
				array(
					'email' => $email,
				),
				array(
					'%s',
				)
			);
}