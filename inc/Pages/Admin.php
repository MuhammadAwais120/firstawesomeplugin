<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Pages;
class Admin
{
    public function register() {
        add_action( 'admin_menu',array( $this, 'admin_plugin_menu' ) );
    }
    
    public function admin_plugin_menu(){
        add_menu_page( 'Awesome Plugin', 'Awesome', 'manage_options','awesome_plugin', array( $this, 'admin_index'), '', 100 );
    }
    public function admin_index(){
        require_once PLUGIN_PATH . 'templates/admin.php';  
    }
}