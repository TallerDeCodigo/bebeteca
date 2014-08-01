<?php
$status_slide_post = '';
$exclude = array();

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
		wp_localize_script( 'functions', 'is_search', (string)is_search() );
		wp_localize_script( 'functions', 'site_url', site_url('/') );

		if (is_search()) {
			wp_localize_script( 'functions', 'get', $_GET['s'] );
		}


		// styles
		wp_enqueue_style( 'styles', get_stylesheet_uri() );

	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	add_action( 'admin_enqueue_scripts', function(){
		global $status_slide_post;
		// scripts
		wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );

		// localize scripts
		wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );
		wp_localize_script( 'admin-js', 'is_slide_post', (string)$status_slide_post );

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

		add_image_size( 'slider-home', 620, 465, true );
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

	require_once('inc/functions-share.php');

	require_once('inc/functions-comments.php');

	require_once('inc/functions-newsletter.php');



// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		if ( $query->is_main_query() and ! is_admin() ) {

			if ( is_home() ) {
				$query->set( 'posts_per_page', 4 );
				$query->set( 'post_type', array('post', 'articulo-slider', 'promociones') );

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
				$query->set( 'posts_per_page', 10 );
			}

			if (is_search()) {
				$query->set( 'post_status', 'publish' );
				$query->set( 'posts_per_page', 10 );
				$query->set( 'post_type', array('post', 'articulo-slider', 'promociones') );
			}


			if(is_category() AND !is_category('entrevistas')){
				$query->set( 'posts_per_page', 10 );
				$query->set( 'post_type', array('post', 'articulo-slider') );
				$query->set( 'post_status', 'publish' );

				$term_id      = $query->queried_object->term_id;
				$posts_query  = query_categorias_slide($term_id);
				$no_post      = array();
				foreach ($posts_query->posts as $post) {
					$no_post[] = $post->ID;
				}

				$query->set('post__not_in', $no_post);
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
	 * Regresa la url del attachment especificado
	 * @param  int     $post_id
	 * @param  string  $size
	 * @return string  url de la imagen
	 */
	function attachment_image_url($post_id, $size){
		$image_id   = get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, $size, true);
		return isset($image_data[0]) ? $image_data[0] : '';
	}


// QUERY CATEGORIAS /////////////////////////////////////////////////////////////////////

	function query_categorias_slide($term_id){
		return new WP_Query(array( 'posts_per_page' => 4, 'post_type' => array('post', 'articulo-slider'), 'cat' => $term_id, 'meta_key' => 'slider_categoria', 'meta_query' => array( array( 'key' => 'slider_categoria', 'value'   => true, 'compare' => '=' ) ) ) );
	}


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
	 * DEVUELVE LOS POST HIJOS DE LOS SLIDE
	 */
	function return_posts_slide($post_parent_id){
		return new WP_Query(array( 'posts_per_page' => -1, 'post_type' => array('articulo-slider'), 'post_parent' => $post_parent_id, 'post_status'=>'slide_post', 'orderby' => 'ID', 'order' => 'ASC' ) );

	}



	/**
	 * RESIVE INFORMACION DEL FORMULARIO DE CONTACTO
	 */
	function ajax_resive_info_contacto(){

		$nombre   = isset($_POST['nombre']) ? $_POST['nombre'] : '';
		$email   = isset($_POST['email']) ? $_POST['email'] : '';
		$mensaje   = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

		// Create post object
		global $user_ID;
		$new_post = array(
			'post_title'   => $nombre,
			'post_content' => $mensaje,
			'post_status'  => 'draft',
			'post_date'    => date('Y-m-d H:i:s'),
			'post_type'    => 'contactos'
		);

		$post_id = wp_insert_post($new_post);

		if ($post_id) {
			update_post_meta($post_id, 'email_contactos', $email);
		}

		$fecha = date('Y-m-d');
		$mensaje_mail = "Se a agregado un nuevo contacto \n\rNombre: $nombre \n\rEmail: $email \n\rFecha: $fecha \n\rMensaje: $mensaje";

    	$headers[] = 'From: Bebeteca <labebeteca@labebeteca.com>';
        wp_mail( 'labebeteca@labebeteca.com', 'Bebeteca', $mensaje_mail, $headers );

		wp_send_json('bien');

	}

	add_action('wp_ajax_ajax_resive_info_contacto', 'ajax_resive_info_contacto');
	add_action('wp_ajax_nopriv_ajax_resive_info_contacto', 'ajax_resive_info_contacto');


	// PAGINACION ///////////////////////////////////////////////////////////////////////////////

	/**
	 * CHECA SI EXISTE UNA PAGINA ANTERIOR
	 */
	function has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}


	/**
	 * CHECA SI EXISTE UNA PAGINA SIGUIENTE
	 */
	function has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}


	// LYENDA IMAGEN ///////////////////////////////////////////////////

	function get_post_thumbnail_caption() {
		if ( $thumb = get_post_thumbnail_id() )
			return get_post( $thumb )->post_excerpt;
	}


	// REGRESA LA SUBCATEGORIA  Y LA CATEGORIA PAPA ////////////////////
	function cat_and_subcat($post_id = ''){
		$categoria = get_the_category();
		$categoria0 = isset($categoria[0]->category_parent) ? $categoria[0]->category_parent : '';
		$categoria1 = isset($categoria[1]->category_parent) ? $categoria[1]->category_parent : '';
		$parent1 = get_cat_name($categoria0);
		$parent2 = get_cat_name($categoria1);

		if (!empty($parent1) OR !empty($parent2)) {

			if (!empty($parent1)) {
				return get_category_parents( $categoria[0]->category_parent, true, ' / <a href="'.site_url('/categoria/'.$categoria[1]->slug.'/'.$categoria[0]->slug.'/ ').'">'.$categoria[0]->name .'</a>');

			}else{
				return get_category_parents( $categoria[1]->category_parent, true, ' / <a href="'.site_url('/categoria/'.$categoria[0]->slug.'/'.$categoria[1]->slug.'/ ').'">'.$categoria[1]->name .'</a>');
			}

		} elseif(!empty($categoria[0])) {
			return get_category_parents( $categoria[0]->term_id, true, '' );

		}else{
			$categoria_s = get_the_category($post_id);
			return get_category_parents( $categoria_s[0]->term_id, true, '' );

		}
	}


	// REGRESA LA CATEGORIA PAPA ////////////////////
	function categoria_papa_post($post_id = ''){
		$categorias = get_the_category();
		foreach ($categorias as $key => $categoria) {
			if ($categoria->category_parent == 0 || $categoria->category_parent == '') {
				return $categoria;
			}
		}
	}


	/**
	 * EXCERTP POR LETRAS
	 */
	function excerpt($limit, $text) {
	  	$excerpt = strlen($text);
	  	if ($excerpt>$limit) {
		  	$excerpt = substr($text, 0,$limit).'...';
	  	} else {
	    	$excerpt = $text;
	  	}
	  	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	  	return $excerpt;
	}

	/**
	 * SHARE POST BY MAIL
	 */
	function ajax_send_post_by_mail(){

		$username   	= isset($_POST['username']) ? $_POST['username'] : '';
		$sender_email   = isset($_POST['sender_email']) ? $_POST['sender_email'] : '';
		$recipient  = isset($_POST['recipient']) ? $_POST['recipient'] : '';
		$post_id   	= isset($_POST['post_id']) ? $_POST['post_id'] : '';
		$message   	= isset($_POST['message']) ? $_POST['message'] : '';

		$this_post = get_post($post_id);
		setup_postdata($this_post);
		$excerpt =	get_the_excerpt();

		$mensaje_mail  = "$username te ha compartido el siguiente artículo: \n\r";
		$mensaje_mail .= "<h1>$this_post->post_title</h1> \n\r";
		$mensaje_mail .= "<p>$excerpt</p> \n\r";

    	$headers[]  = "From: $username <$sender_email>";
    	$headers[] 	= "MIME-Version: 1.0 \r\n";
		$headers[] 	= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
		wp_reset_postdata();
		
        if($response = wp_mail( $recipient, 'Te han compartido un artículo en Bebeteca', $mensaje_mail, $headers ))
        	wp_send_json_success($response);

        wp_send_json_error($response);
	
	}

	add_action('wp_ajax_ajax_send_post_by_mail', 'ajax_send_post_by_mail');
	add_action('wp_ajax_nopriv_ajax_send_post_by_mail', 'ajax_send_post_by_mail');
