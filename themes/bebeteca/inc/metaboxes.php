<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){

		add_meta_box( 'meta-box-video', 'Video', 'show_metabox_video', 'post', 'side', 'high' );
		add_meta_box( 'meta-box-video', 'Video', 'show_metabox_video', 'articulo-slider', 'side', 'high' );
		add_meta_box( 'meta-box-video', 'Video', 'show_metabox_video', 'videos', 'side', 'high' );

		add_meta_box( 'meta-box-slider_categoria', 'Colocar en Slider', 'show_metabox_slider_categoria', 'post', 'side', 'high' );
		add_meta_box( 'meta-box-slider_categoria', 'Colocar en Slider', 'show_metabox_slider_categoria', 'articulo-slider', 'side', 'high' );

	});



// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////



	function show_metabox_slider_categoria($post){
		global $post;
		    $slider_categoria = get_post_meta( $post->ID, 'slider_categoria', true );

			$checked = $slider_categoria ? 'checked' : '';?>
            <input type="checkbox" name="slider_categoria" id="slider_categoria" value="1"  <?php echo $checked; ?> /> Check slider categoria</label>
	<?php }

	// Callback function to show fields in meta box Opciones de video

	function show_metabox_video($post) {
		$id_vimeo   = get_post_meta($post->ID, 'id_vimeo', true);
		$id_youtube = get_post_meta($post->ID, 'id_youtube', true);
		wp_nonce_field(__FILE__, '_articulo_videos_nonce');
		echo <<< meta_box_post_video

			<label for="id_vimeo">ID de Vimeo</label>
			<input type="text" name="id_vimeo" id="id_vimeo" value="$id_vimeo" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">http://vimeo.com/<strong>45118430</strong></p>

			<label for="id_youtube">ID de Youtube</label>
			<input type="text" name="id_youtube" id="id_youtube" value="$id_youtube" class="widefat">
			<p class="howto" style="font-size:11px; margin: 0.2em 0 1.5em 0;">http://www.youtube.com/watch?v=<strong>rT_OmTMwvZI</strong></p>

meta_box_post_video;
	}



// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////



	add_action('save_post', function($post_id){

		global $post;
		if ( ! current_user_can('edit_page', $post_id))
			return $post_id;


		if ( defined('DOING_AUTOSAVE') and DOING_AUTOSAVE )
			return $post_id;


		if ( wp_is_post_revision($post_id) OR wp_is_post_autosave($post_id) )
			return $post_id;


		// Guardar correctamente los checkboxes
		if ( isset($_POST['slider_categoria'])){
			update_post_meta($post_id, 'slider_categoria', $_POST['slider_categoria']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, 'slider_categoria', $_POST['slider_categoria']);
		}

		/// VIDEOS
		if( isset($_POST['id_vimeo']) and check_admin_referer( __FILE__, '_articulo_videos_nonce' ) ){

			if (isset($_POST['id_vimeo']) ) {
				update_post_meta($post_id, 'id_vimeo', $_POST['id_vimeo']);
			}

			if (isset($_POST['id_youtube']) ) {
					update_post_meta($post_id, 'id_youtube', $_POST['id_youtube']);
			}
		}


	});
