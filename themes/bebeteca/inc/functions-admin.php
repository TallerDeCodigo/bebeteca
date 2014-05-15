<?php /**
 * save post
 * @return [string] [mail]
 */
function ajax_create_subpost(){
	global $current_user;
	extract($_POST);

	// Create post object
	global $current_user;

	$new_post = array(
		'post_title'   => $titulo,
		'post_content' => $contenido,
		'post_status'  => 'slide_post',
		'post_date'    => date('Y-m-d H:i:s'),
		'post_author'  => $current_user->ID,
		'post_parent'  => $post_id,
		'post_type'    => 'articulo-slider'
	);

	$post_id = wp_insert_post($new_post);

	wp_send_json(true);
}

add_action('wp_ajax_ajax_create_subpost', 'ajax_create_subpost');
add_action('wp_ajax_nopriv_ajax_create_subpost', 'ajax_create_subpost');