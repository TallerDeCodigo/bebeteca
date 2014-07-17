<?php

require_once('MCAPI.class.php');

/**
 * RESIVE INFORMACION DEL FORMULARIO DE CONTACTO
 */
function ajax_resive_mail_newsletter(){

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$apikey = '0498df364d41ea421f2dc12536a253a4-us8';
	$listId = 'd020d6abfe';

	$apiUrl = 'http://api.mailchimp.com/1.3/';
	$api = new MCAPI($apikey);

	$retval = $api->listSubscribe( $listId, $email, array());

	if ($api->errorCode){
		wp_send_json("Hubo un error con la solicitud, intentalo de nuevo.");
	} else {
	    wp_send_json(1);
	}


}

add_action('wp_ajax_ajax_resive_mail_newsletter', 'ajax_resive_mail_newsletter');
add_action('wp_ajax_nopriv_ajax_resive_mail_newsletter', 'ajax_resive_mail_newsletter');

