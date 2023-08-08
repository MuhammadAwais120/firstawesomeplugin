<?php
/**
* @package firstawesome-plugin
*/
namespace Inc;

final class Init{

    /**
     * Store all the classes inside an array
     * @return array full list of classes
    */

    public static function get_services(){
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingLinks::class,
        ];
    }

    /**
     * Loop through the classes and intialize them,
     * and call register method if exists
     * @return
    */

    public static function register_services() {
        foreach (self::get_services() as $class) {
            $services = self::instentiate( $class );
            if ( method_exists( $services, 'register' ) ) {
                $services->register();
            }
        }
    }

    /**
     * Intialize the class
     * @param class $class  Class from the services array
     * @return class instance   new instance of the class
    */

    private static function instentiate( $class ){
        return new $class;
    }
}




// use Inc\Base\Activate;
// use Inc\Base\Deactivate;


// class AwesomePlugin{

//     public $plugin;
    
//     function __construct(){
//         $this->create_post_type();
//         $this->plugin = plugin_basename( __FILE__ );
//     }

//     protected function create_post_type() {
//         add_action( 'init', array( $this, 'custom_post_type' ) );
//     }
//     function register(){
        
//         add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

//         add_action( 'admin_menu',array( $this, 'admin_plugin_menu' ) );

//         add_filter( "plugin_action_links_$this->plugin", array($this, 'settings_links') );
//     }

//     public function settings_links( $links ){
//         $setting_links = '<a href="admin.php?page=awesome_plugin">Settings</a>';
//         array_push( $links,$setting_links );
//         return $links;
//     }

//     public function admin_plugin_menu(){
//         add_menu_page( 'Awesome Plugin', 'Awesome', 'manage_options','awesome_plugin', array( $this, 'admin_index'), '', 100 );
//     }
//     public function admin_index(){
//         require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';  
//     }

//     function uninstall(){

//     }
//     function custom_post_type() {
//         register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
//     }
//     function enqueue(){
//         wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
//         wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
//     }
//     function activate(){
//         // require_once plugin_dir_path( __FILE__ ) . 'inc/awesome-plugin-activate.php';
//         Activate::activate();
//     }
//     function deactivate(){
//         // require_once plugin_dir_path( __FILE__ ) . 'inc/awesome-plugin-deactivate.php';
//         Deactivate::deactivate();
//     }
// }

// if ( class_exists( 'AwesomePlugin' ) ) {
//     $awesomePlugin = new AwesomePlugin();
//     $awesomePlugin->register();
// }

// register_activation_hook( __FILE__, array( $awesomePlugin , 'activate' ) );


// register_deactivation_hook( __FILE__, array( $awesomePlugin , 'deactivate' ) );