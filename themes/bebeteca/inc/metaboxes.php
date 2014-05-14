<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){

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


	});
