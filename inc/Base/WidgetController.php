<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class WidgetController extends BaseController
{
	public $callbacks;

	public $settings;

	public $subpages = array();

	public function register()
	{
		$option = get_option( 'awesome_plugin' );
        $activated = isset($option['chat_manager']) ? $option['chat_manager'] : false;
        
        if ( ! $activated ) {
            return;
        }
		

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Chat Manager', 
				'menu_title' => 'Chat Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_chat', 
				'callback' => array( $this->callbacks, 'adminChat' )
			)
		);
	}
}