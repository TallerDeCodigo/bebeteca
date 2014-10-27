<?php


// CUSTOM USER CONFIGURATIONS /////////////////////////////////////////////////////////



	$administrator = get_role('administrator');
	$author = get_role('author');
	
	remove_role( 'contributor' );
	remove_role( 'colaborador' );
	add_role( 'developer', 'Developer', $administrator->capabilities );
	add_role( 'colaborador', 'Colaborador', $author->capabilities );

	$colaborador = get_role('colaborador');
	
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

	add_filter('user_contactmethods', function ( $contactmethods ) {
		// unset($contactmethods['url']);

		unset($contactmethods['aim']);
		unset($contactmethods['yim']);
		unset($contactmethods['jabber']);

		$contactmethods['quote'] = 'Quote';
		$contactmethods['perfil'] = 'Puesto';
		$contactmethods['twitter']  = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		// $contactmethods['google'] = 'Google +';
		$contactmethods['printerest'] = 'Printerest';

		return $contactmethods;
	});


	add_action('admin_menu', function() use (&$current_user){
		if ( in_array('developer', $current_user->roles) ){
			add_options_page(__('All Settings'), __('All Settings'), 'developer', 'options.php');
		}
	});



	function user_vew_mail_fields( $user ) {
	    // get product categories
	    $user_mail = get_the_author_meta( 'user_vew_mail', $user->ID );
	    $checked = $user_mail == 1 ? 'checked' : '';
	    ?>
	    <table class="form-table">
	        <tr>
	            <th>Mostrar correo electrónico:</th>
	            <td>
	            <p><label for="user_vew_mail">
	                <input
	                    id="user_vew_mail"
	                    name="user_vew_mail"
	                    type="checkbox"
	                    value="1"
						<?php echo $checked; ?>
	                    >
	            </label></p>
	            </td>
	        </tr>
	    </table>
	    <?php
	}
	add_action( 'show_user_profile', 'user_vew_mail_fields' );
	add_action( 'edit_user_profile', 'user_vew_mail_fields' );

    // store interests
    function user_vew_mail_fields_save( $user_id ) {
        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;
        update_user_meta( $user_id, 'user_vew_mail', $_POST['user_vew_mail'] );
    }
    add_action( 'personal_options_update', 'user_vew_mail_fields_save' );
    add_action( 'edit_user_profile_update', 'user_vew_mail_fields_save' );
