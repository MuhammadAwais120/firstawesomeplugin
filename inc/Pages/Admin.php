<?php
/**
    * @package firstawesome-plugin
*/
namespace Inc\Pages;
use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
class Admin extends BaseController
{
    public $settings;

    public $pages = array();

    public $subpages = array();

    public function __construct(){
        $this->settings = new SettingsApi();
        $this->pages = array(
            [
                'page_title' => 'Awesome Plugin',
                'menu_title' => 'Awesome',
                'capability' => 'manage_options',
                'menu_slug' => 'awesome_plugin',
                'callback' => function(){ echo '<h1>Awesome Plugin</h1>' ; },
                'icon_url' => 'dashicons-store',
                'position' => 100
            ]
        );

        $this->subpages = array(
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_cpt', 
				'callback' => function() { echo '<h1>CPT Manager</h1>'; }
			),
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_taxonomies', 
				'callback' => function() { echo '<h1>Taxonomies Manager</h1>'; }
			),
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_widgets', 
				'callback' => function() { echo '<h1>Widgets Manager</h1>'; }
			)
		);

    }
    public function register() {
       
        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
    }
    
    // public function admin_plugin_menu(){
    //     add_menu_page( 'Awesome Plugin', 'Awesome', 'manage_options','awesome_plugin', array( $this, 'admin_index'), '', 100 );
    // }
    // public function admin_index(){
    //     require_once $this->plugin_path . 'templates/admin.php';  
    // }
}