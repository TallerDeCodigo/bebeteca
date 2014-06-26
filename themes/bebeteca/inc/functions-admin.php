<?php /**
 * save post
 * @return [string] [mail]
 */
function ajax_create_subpost(){
	global $current_user;
	extract($_POST);

	// Create post object
	global $current_user;
	
	$post_parent = get_post($postid);
	
	$new_post = array(
		'post_title'   => $titulo,
		'post_content' => $contenido,
		'post_status'  => 'slide_post',
		'post_date'    => date('Y-m-d H:i:s'),
		'post_author'  => $post_parent->post_author,
		'post_parent'  => $postid,
		'post_type'    => 'articulo-slider'
	);

	$post_id = wp_insert_post($new_post);

	$terms = get_the_terms( $postid, 'category' );
	$terms_id = array();
	foreach ($terms as $term) {
		$terms_id[] = $term->term_id;
	}
	wp_set_object_terms( $post_id, $terms_id, 'category');

	if ($post_id AND $image != 'no-image') {
		guardar_imagen_subtema($post_id, $image, $titulo);
	}

	wp_send_json($post_id);
}
add_action('wp_ajax_ajax_create_subpost', 'ajax_create_subpost');
add_action('wp_ajax_nopriv_ajax_create_subpost', 'ajax_create_subpost');


// IMAGEN USER//////////////////////////////////////////////////////////////////////////////

// Imagen en editar perfil del admin ////////////////////////////////////////////////////////
add_action( 'edit_user_profile', 'imagen_en_admin' );
add_action( 'show_user_profile', 'imagen_en_admin' );

function imagen_en_admin($user) {
	?>
		<input type="file" name="foto-paso-uno" id="subir-foto-user"  multiple accept="image/*">
		<div class="image-user" id="bt-add-photo" data-user_id='<?php echo $user->ID; ?>' data-user_name="<?php echo $user->user_login; ?>">
			<?php echo vew_image_user($user->ID); ?>
		</div>
	<?php
}


// SAVE IMAGE USER /////////////////////////////////////////////////////////////////
function save_image_user($image, $user_id){
	update_user_meta( $user_id , 'imagen_user', $image);
}


// RESIVE VALORES PARA GUARDAR EL GRAVATAR DEL USUARIO ////////////////////////////////////

function guardar_imagen() {
	global $current_user;
	global $wpdb;

	$user_id    = isset($_POST['user_id']) ? $_POST['user_id'] : $current_user->ID;
	$image_name = isset($_POST['user_name']) ? $_POST['user_name'] : $current_user->user_login;
	$file       = saveAttachmentData($_POST['image'], $image_name);
	$imagen     = pathinfo($file);

	$wp_upload_dir = wp_upload_dir();

	$attachment = array(
		'post_status'    => 'inherit',
		'post_mime_type' => "image/{$imagen['extension']}",
		'post_type'      => 'attachment',
		'post_title'     => preg_replace('/\.[^.]+$/', '', $imagen['basename']),

	);

	$dir = substr($wp_upload_dir['subdir'], 1);
	$img = $dir .'/'. $imagen['basename'];

	$attach_id = wp_insert_attachment( $attachment, $img);

	if($attach_id){
		// you must first include the image.php file for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$image_file = $wp_upload_dir['path'] .'/'. $imagen['basename'];
		$attach_data = wp_generate_attachment_metadata( $attach_id, $image_file );
		$_POST['attach_id'] = $attach_id;
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( '', $attach_id );

		 $img_url2 = wp_get_attachment_image_src($attach_id, 'thumbnail');
		 $pat_img    = pathinfo($img_url2[0]);
		 $img2 = $dir .'/'. $pat_img['basename'];
		 save_image_user($img2, $user_id);


	}
	echo $img_url2[0];
	exit;
}

add_action('wp_ajax_guardar_imagen', 'guardar_imagen');
add_action('wp_ajax_nopriv_guardar_imagen', 'guardar_imagen');



// RESIVE VALORES PARA GUARDAR LA IMAGEN DEL SUBTEMA ////////////////////////////////////

function guardar_imagen_subtema($post_id, $image, $image_name) {
	global $wpdb;

	$file       = saveAttachmentData($image, $image_name);
	$imagen     = pathinfo($file);

	$wp_upload_dir = wp_upload_dir();

	$attachment = array(
		'post_status'    => 'inherit',
		'post_mime_type' => "image/{$imagen['extension']}",
		'post_type'      => 'attachment',
		'post_parent'    => $post_id,
		'post_title'     => preg_replace('/\.[^.]+$/', '', $imagen['basename']),

	);

	$dir = substr($wp_upload_dir['subdir'], 1);
	$img = $dir .'/'. $imagen['basename'];

	$attach_id = wp_insert_attachment( $attachment, $img);

	if($attach_id){
		// you must first include the image.php file for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$image_file = $wp_upload_dir['path'] .'/'. $imagen['basename'];
		$attach_data = wp_generate_attachment_metadata( $attach_id, $image_file );
		$_POST['attach_id'] = $attach_id;
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( $post_id, $attach_id );

	}

}


// SAVE ATTACHMENT DATA //////////////////////////////////////////////////////////////

function saveAttachmentData($data, $image_name){

	$imagen      = imagecreatefromstring( base64_decode($data) );
	$upload_dir  = wp_upload_dir();
	$path        = $upload_dir['path']. '/'. "$image_name.jpg";
	$upload      = imagejpeg( $imagen, $path, 100 );

	return $upload ? $upload_dir['path'].'/'.$image_name.'.jpg' : false;
}


// MUESTRA IMAGEN DEL USUARIO //////////////////////////////////////////////////////////////

function vew_image_user($user_id){

	$imagen =  get_user_meta($user_id, 'imagen_user', true);
	$upload_dir = wp_upload_dir();
	$email = get_the_author_meta( 'user_email', $user_id);

	if ($imagen == 'none' OR $imagen == '') return get_avatar( $email , '250' );

	return '<img src="'. $upload_dir['baseurl'].'/'.$imagen.'" />';
}
