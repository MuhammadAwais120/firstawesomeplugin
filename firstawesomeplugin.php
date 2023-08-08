<?php
/**
* @package firstawesome-plugin
*/
    /**
    * Plugin Name: FirstAwesome Plugin
    * Plugin URI: https://example.com
    * Description: This is my first plugin.
    * Version: 1.0.0
    * Author: Awais Mustafa
    * Author URI: https://example.com
    * Text Domain: firstawesome-plugin
*/

defined( 'ABSPATH' ) or die( 'Sorry! Access Denied.' );
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}
use Inc\Base\Activate;
use Inc\Base\Deactivate;

function activate(){
    Activate::activate();
}
function deactivate(){
    Deactivate::deactivate();
}
// for activation of Plugin
register_activation_hook( __FILE__, 'activate' ) ;


// for activation of Plugin
register_deactivation_hook( __FILE__, 'deactivate' );