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
            Base\Enqueue::class
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
