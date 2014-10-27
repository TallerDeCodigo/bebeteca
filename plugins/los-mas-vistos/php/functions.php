<?php

/**
 * GUARDA OPCIONES ANALITYCS
 */
function save_options_analitycs($data){
	foreach ($data as $key => $value) {
		update_options_analitycs($key, $value);
	}

}




/**
 * GUARDA EL VALOR DE LA OPCION
 */
function update_options_analitycs($key, $value){

	$option_name = $key.'_GA';

	$new_value   = isset($value) ? $value : '';
	$imagen = get_option( $option_name );

	if ($imagen  !== false ) {

    	update_option( $option_name, $new_value );

	} else {

	    $deprecated = null;
	    $autoload = 'no';
	    add_option( $option_name, $new_value, $deprecated, $autoload );
	}
}




/**
 * REGRESA LOS MAS VISTOS ANALITYCS
 */
function masVisitados(){
	require_once 'analytics/Google_Client.php';
	require_once 'analytics/contrib/Google_AnalyticsService.php';

	$name_app     = get_option( 'name_app_GA' );
	$email_app    = get_option( 'email_app_GA' );
	$key_file     = PATH_PLUGINPATH.'php/analytics/'.get_option( 'keyfile_app_GA' );
	$client_id    = get_option( 'client_id_app_GA' );
	$id_analitics = get_option( 'analitics_id_app_GA' );

	// create client object and set app name
	$client = new Google_Client();
	$client -> setApplicationName($name_app); // name of your app

	// set assertion credentials
	$client->setAssertionCredentials(
	  new Google_AssertionCredentials(
	    $email_app, // email you added to GA
	    array('https://www.googleapis.com/auth/analytics.readonly'),
	    file_get_contents($key_file)  // keyfile you downloaded

	));


	$client->setClientId("$client_id");           // from API console
	$client->setAccessType('offline_access');  // this may be unnecessary?


	$analytics = new Google_AnalyticsService($client);

	$analytics_id   = 'ga:'.$id_analitics;
	$ayer      = date('Y-m-d', strtotime('-1 day'));
	$hoy          = date('Y-m-d');


	//se usa try catch para que devuelva errores de la api de google
	try {

		$results = $analytics->data_ga->get($analytics_id,$ayer,$hoy,'ga:uniquePageviews',
	                array(
	                    'dimensions' => 'ga:hostname, ga:pagePath, ga:pageTitle',
	                    'sort' => '-ga:uniquePageviews',
	                    'max-results' => '6'

	                )
	                );
		$resultados = $results['rows'];

		set_post_mas_leidos($resultados);


	} catch(Exception $e) {
		echo '<pre>';
		print_r($e);
		echo '</pre>';
	}


};


function set_post_mas_leidos($resultados){
	$postss = array();
	foreach ($resultados as $key => $post) {
		if ($post[1] != '/'):
			$cvar = pathinfo($post[1]);
			$slug = $cvar['filename'];
			$post = select_id_post_by_slug($slug);
			$postss[] = array('post_id' => $post, 'slug' => $slug);
		endif;

	}
	update_options_analitycs('los_post_mas_vistos', $postss);

}

/**
 * REGRESA EL ID DEL POST
 */
function select_id_post_by_slug($slug){
	global $wpdb;
	return $wpdb->get_var("SELECT ID FROM wp_posts WHERE post_name = '$slug'");
}


function lo_mas_visto_GA(){
	if ( $comentados = get_transient('posts_mas_vistos_transient_GA_dia') ){
		return get_option( 'los_post_mas_vistos_GA' );
	}else{
		masVisitados();
		set_transient( 'posts_mas_vistos_transient_GA_dia', 'tran', 3600 );
		return get_option( 'los_post_mas_vistos_GA' );
	}

}