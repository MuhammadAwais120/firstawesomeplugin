<?php
/**
    * @package firstawesome-plugin
*/
namespace Inc\Pages;
use \Inc\Base\BaseController;
class Admin extends BaseController
{
    public function register() {
        add_action( 'admin_menu',array( $this, 'admin_plugin_menu' ) );
    }
    
    public function admin_plugin_menu(){
        add_menu_page( 'Awesome Plugin', 'Awesome', 'manage_options','awesome_plugin', array( $this, 'admin_index'), '', 100 );
    }
    public function admin_index(){
        require_once $this->plugin_path . 'templates/admin.php';  
    }
}