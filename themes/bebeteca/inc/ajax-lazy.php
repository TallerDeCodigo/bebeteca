<?php
/**
 * RESIVE INFORMACION PARA EL LAZYLOAD DEL HOME
 */
function ajax_lazy_home(){

	$offset = isset($_POST['offset']) ? $_POST['offset'] : '';
	$exclude = isset($_POST['exclude']) ? $_POST['exclude'] : '';

	$elementos = get_posts_home_lazyload($offset, $exclude);

	$posts = get_agrega_lo_necesario($elementos);

	$posts = !empty($posts) ? $posts : 'nada';

	wp_send_json($posts);

}

add_action('wp_ajax_ajax_lazy_home', 'ajax_lazy_home');
add_action('wp_ajax_nopriv_ajax_lazy_home', 'ajax_lazy_home');



/**
 * RESIVE INFORMACION PARA EL LAZYLOAD DE CUPONES
 */
function ajax_lazy_cupones(){

	$offset = isset($_POST['offset']) ? $_POST['offset'] : '';

	$elementos = get_posts_cupones_lazyload($offset);

	$posts = get_agrega_lo_necesario($elementos);

	$posts = !empty($posts) ? $posts : 'nada';

	wp_send_json($posts);

}

add_action('wp_ajax_ajax_lazy_cupones', 'ajax_lazy_cupones');
add_action('wp_ajax_nopriv_ajax_lazy_cupones', 'ajax_lazy_cupones');




/**
 * RESIVE INFORMACION PARA EL LAZYLOAD DE LAS CATEGORIAS
 */
function ajax_lazy_category(){

	$offset = isset($_POST['offset']) ? $_POST['offset'] : '';
	$term_id = isset($_POST['term_id']) ? $_POST['term_id'] : '';
	$exclude = isset($_POST['exclude']) ? $_POST['exclude'] : '';

	$elementos = get_posts_category_lazyload($offset, $term_id, $exclude);

	$posts = get_agrega_lo_necesario($elementos);

	$posts = !empty($posts) ? $posts : 'nada';

	wp_send_json($posts);

}

add_action('wp_ajax_ajax_lazy_category', 'ajax_lazy_category');
add_action('wp_ajax_nopriv_ajax_lazy_category', 'ajax_lazy_category');


/**
 * REGRESA LOS POSTS QUE SIGUEN EN EL HOME
 */
function get_posts_home_lazyload($offset, $exclude){
	$cat_no = get_term_by( 'slug', 'entrevistas', 'category' );
	$post_general = new WP_Query(array( 'posts_per_page' => 11, 'offset' => $offset,  'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'), 'post__not_in' => $exclude, 'category__not_in' => array($cat_no->term_id) ) );
	return $post_general->posts;
}



/**
 * REGRESA LOS POSTS QUE SIGUEN EN CUPONES
 */
function get_posts_cupones_lazyload($offset, $exclude){
	$post_general = new WP_Query(array( 'posts_per_page' => 10, 'offset' => $offset,  'post_status'=>'publish', 'post_type' => array('promociones') ) );
	return $post_general->posts;
}



/**
 * REGRESA LOS POSTS QUE SIGUEN EN LA CATEGORIA
 */
function get_posts_category_lazyload($offset, $term_id, $exclude){
	$post_general = new WP_Query(array( 'posts_per_page' => 10, 'offset' => $offset,  'post_status'=>'publish', 'post_type' => array('post', 'articulo-slider'),'category__in' => array($term_id), 'post__not_in' => $exclude ) );
	return $post_general->posts;
}


function get_agrega_lo_necesario($elementos){
	$posts = array();
	if (!empty($elementos)) :
		foreach ($elementos as $key => $post):

			$thumb1 = attachment_image_url($post->ID, 'articulos-gral');
			$thumb2 = attachment_image_url($post->ID, 'thumbnail');
			$cat = get_category_post($post->ID);
			$posts[$key]['ID'] = $post->ID;
			$posts[$key]['titulo'] = excerpt(50, $post->post_title);
			$posts[$key]['contenido'] = wp_trim_words( $post->post_content, 10 );
			$posts[$key]['img1'] = $thumb1;
			$posts[$key]['img2'] = $thumb2;
			$posts[$key]['slug_cat'] = $cat[1];
			$posts[$key]['name_cat'] = $cat[0];
			$posts[$key]['url'] = get_permalink( $post->ID );
			$posts[$key]['shares'] = get_count_share(get_permalink( $post->ID ));

		endforeach;
	endif;

	return $posts;
}


function get_category_post($post_id){
	$terms  = wp_get_post_terms( $post_id, 'category');
	if (!empty($terms)) {
		foreach ($terms as $term) {
			if($term->parent == 0){
				$term_name = $term->name;
				$term_slug = $term->slug;
			}
		}
	}else{
		$term_name = '';
		$term_slug = '';
	}

	$postype = get_post_type($post_id);
	if ($postype == 'promociones') {
		$term_name = 'Promociones';
		$term_slug = 'promociones';
	}

	return array($term_name, $term_slug);
}