<?php

// require_once 'mandrill-api-php/src/Mandrill.php'; //Not required with Composer
// $mandrill = new Mandrill('C7vH5WTDJLnbPOBuK7Dvmw');

function send_email_to_user_with_token($subject, $from, $from_name, $content, $email){
	$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';

	$api_key = get_option('C7vH5WTDJLnbPOBuK7Dvmw');

	$content = stripslashes($content);
	$message = str_replace(array('*|USER:EMAIL|*'), array($email), $content);
	$content_text = strip_tags($message);
	$params = array(
    "key" => $api_key,
    "message" => array(
        "html" => $message,
        "text" => $content_text,
        "to" => array(
            array("name" => $email, "email" => $email)
        ),
        "from_email" => $from,
        "from_name" => $from_name,
        "subject" => $subject,
        "track_opens" => true,
        "track_clicks" => true
    ),
    "async" => false
	);

	$postString = json_encode($params);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
	$sent = curl_exec($ch);
}

send_email_to_user_with_token('sfadadsf a', 'alex@hacemoscodigo.com', 'alex', 'hola alex', 'alex@losmaquiladores.com');