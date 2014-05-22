<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////

	add_action( 'load-post.php', function(){
		add_action('add_meta_boxes', function(){
			global $post;
			if ( get_post_status ( $post->ID ) != 'slide_post' ) {

				add_meta_box( 'meta-box-subtema', 'Agregar Subtema', 'show_metabox_subtema', 'articulo-slider' );

				add_meta_box( 'meta-box-vew_subtemas', 'Subtemas', 'show_metabox_vew_subtemas', 'articulo-slider', 'side', 'high');

			}
		});
	});

	add_action('add_meta_boxes', function(){
		global $post;
		global $status_slide_post;
		if ( get_post_status ( $post->ID ) != 'slide_post' ) {

			add_meta_box( 'meta-box-video', 'Video', 'show_metabox_video', 'post', 'side', 'high' );
			add_meta_box( 'meta-box-video', 'Video', 'show_metabox_video', 'videos', 'side', 'high' );

			add_meta_box( 'meta-box-slider_categoria', 'Colocar en Slider', 'show_metabox_slider_categoria', 'post', 'side', 'high' );
			add_meta_box( 'meta-box-slider_categoria', 'Colocar en Slider', 'show_metabox_slider_categoria', 'articulo-slider', 'side', 'high' );

			add_meta_box( 'meta-box-email_contacto', 'Email contacto', 'show_metabox_email_contacto', 'contactos', 'side', 'high' );

			$status_slide_post = false;
		}else{
			add_meta_box( 'meta-box-tagline', 'Tagline', 'show_metabox_tagline', 'articulo-slider', 'side', 'high' );
			$status_slide_post = true;
		}
	});



// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////



	function show_metabox_slider_categoria($post){
		global $post;
		    $slider_categoria = get_post_meta( $post->ID, 'slider_categoria', true );

			$checked = $slider_categoria ? 'checked' : '';?>
            <input type="checkbox" name="slider_categoria" id="slider_categoria" value=""  <?php echo $checked; ?> /> Check slider categoria</label>
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


	function show_metabox_tagline($post) {
		$tagline   = get_post_meta($post->ID, 'tagline', true);
		wp_nonce_field(__FILE__, '_articulo_tagline_nonce');
		echo <<< meta_box_tagline

			<input type="text" name="tagline" id="tagline" value="$tagline" class="widefat">


meta_box_tagline;
	}


	function show_metabox_email_contacto($post) {
		$email_contactos   = get_post_meta($post->ID, 'email_contactos', true);
		wp_nonce_field(__FILE__, '_articulo_email_contactos_nonce');
		echo <<< meta_box_email_contactos

			<input type="text" name="email_contactos" id="email_contactos" value="$email_contactos" class="widefat">


meta_box_email_contactos;
	}


	function show_metabox_subtema($post) {
		$post_id = $post->ID;
		wp_nonce_field(__FILE__, '_articulo_genear_subtema_nonce');
		echo <<< meta_box_subpost

			<label for="subtitulo" class="prin">Subtitulo</label>
			<input type="text" name="subtitulo" id="subtitulo" value="" size="30" class="subtitulos" placeholder="Subtitulo">

			<div class="columna-1-subtema">
				<label for="contenido" class="prin">Contenido</label>
				<textarea name="contenido" id="contenido" placeholder="Contenido" class="contenido"></textarea>
			</div>
			<div class="columna-2-subtema">
				<div class="contenedor-imagen">
				</div>

				<input type="submit" class="button-primary" id="add_image" value="Imagen Subtema">
				<input type="file" name="foto-subtema" id="subir-foto-subtema"  multiple accept="image/*">

			</div>

			<input type="submit" class="button-primary" id="add_subtema" data-post_id="$post_id"  value="Guardar Subtema">

meta_box_subpost;
	}

	function show_metabox_vew_subtemas($post) {

		wp_nonce_field(__FILE__, '_articulo_genear_subtema_nonce');
		$post_id = $post->ID;

		$post_child = new WP_Query(array( 'posts_per_page' => -1, 'post_type' => array('articulo-slider'), 'post_parent' => $post_id, 'post_status'=>'slide_post', 'orderby' => 'ID', 'order' => 'ASC' ) );

		foreach ($post_child->posts as $key => $value) { ?>

			<div class="caja_post">
				<?php if( has_post_thumbnail($value->ID) ):
					echo get_the_post_thumbnail( $value->ID, 'thumbnail', array('class' => 'img_s') );
				else: ?>
					<img src="" class="img_s">
				<?php endif;?>
				<h5><?php echo $value->post_title; ?></h5>
				<?php $link_edit =  get_edit_post_link( $value->ID ); ?>
				<a href="<?php echo $link_edit; ?>">Editar subtema</a>
			</div>
		<?php }
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

		if( isset($_POST['tagline']) and check_admin_referer( __FILE__, '_articulo_tagline_nonce' ) ){

			update_post_meta($post_id, 'tagline', $_POST['tagline']);
		}

		if( isset($_POST['email_contactos']) and check_admin_referer( __FILE__, '_articulo_email_contactos_nonce' ) ){

			update_post_meta($post_id, 'email_contactos', $_POST['email_contactos']);
		}




	});


