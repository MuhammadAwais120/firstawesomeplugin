<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Base;
class SettingLinks
{
    public function register() {
        add_filter( "plugin_action_links_". PLUGIN, array($this, 'settings_links') );
    }
    public function settings_links( $links ){
        $setting_links = '<a href="admin.php?page=awesome_plugin">Settings</a>';
        array_push( $links,$setting_links );
        return $links;
    }
}