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
class GalleryController extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public function register()
	{
		$option = get_option( 'awesome_plugin' );
        $activated = isset($option['gallery_manager']) ? $option['gallery_manager'] : false;
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
				'page_title' => 'Gallery Manager', 
				'menu_title' => 'Gallery Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_gallery', 
				'callback' => array( $this->callbacks, 'adminGallery' )
			)
		);
	}
}