<?php
/* Plugin name: Los mas vistos (analytics)
   Author: Alejandro cervantes
   Author URI: https://twitter.com/aCervantes_S
   Version: 1.0
   Description: Obtiene los articulos mas vistos, mediante google analytics.
   Text Domain: los-mas-vistos
*/

// DEFINIR LOS PATHS  ///////////////////////////

define( 'PATH_PLUGINURL', plugins_url(basename( dirname(__FILE__))) . "/");
define( 'PATH_PLUGINPATH', dirname(__FILE__) . "/");
define( 'PATH_VERSION', "1.0");

require_once('php/functions.php');


add_action( 'admin_menu', 'register_menu_mas_vistos' );

function register_menu_mas_vistos(){
  add_management_page('Los más vistos analytics', 'Los más vistos analytics', 'manage_options', 'los-mas-vistos', 'menu_losmas_vistos');
}

function menu_losmas_vistos(){
    require_once('settings.php');
}
