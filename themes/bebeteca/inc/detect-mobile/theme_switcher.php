<?php

/*
	Plugin Name: Theme Switcher
	Version: 1.0
	Author URI: http://julietacampos.com
	Plugin URI: -
	Description:  Cambia la plantilla de Wordpress de acuerdo al user agent encontrado. 
	Author: Julieta Campos @ Hacemos Código para Grupo Medios.
	License: GPL2
*/


add_filter('template', 'theme_switcher');
add_filter('stylesheet', 'theme_switcher');

function theme_switcher($theme){

	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if(isset($_GET['useragent'])) echo '<div style="background:#fff; padding:10px">'.$useragent.'</div>';

	// if (preg_match('/ipad/',strtolower($useragent))) $theme = 'futbol_total_2013';
	// elseif (preg_match('/iphone/',strtolower($useragent))) $theme = 'futbol_total_2013_movil';
	// elseif (preg_match('/blackberry/',strtolower($useragent))) $theme = 'futbol_total_2013_movil';
	// elseif (preg_match('/android/',strtolower($useragent))) $theme = 'futbol_total_2013_movil';
	
	if (wp_is_mobile()) $theme = 'futbol_total_2013_movil';
	if (preg_match('/ipad/',strtolower($useragent))) $theme = 'futbol_total_2013';

	return $theme;
}