<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'awesome_plugin' ) ) {
			update_option( 'awesome_plugin', $default );
		}

		if ( ! get_option( 'awesome_plugin_cpt' ) ) {
			update_option( 'awesome_plugin_cpt', $default );
		}
	}
}