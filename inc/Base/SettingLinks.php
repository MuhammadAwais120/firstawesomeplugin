<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Base;
use \Inc\Base\BaseController;
class SettingLinks extends BaseController
{
    public function register() {
        add_filter( "plugin_action_links_". $this->plugin , array($this, 'settings_links') );
    }
    public function settings_links( $links ){
        $setting_links = '<a href="admin.php?page=awesome_plugin">Settings</a>';
        array_push( $links,$setting_links );
        return $links;
    }
}