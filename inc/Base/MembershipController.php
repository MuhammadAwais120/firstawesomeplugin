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
class MembershipController extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public $settings;

	public function register()
	{
		$option = get_option( 'awesome_plugin' );
        $activated = isset($option['membership_manager']) ? $option['membership_manager'] : false;
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
				'page_title' => 'Membership Manager', 
				'menu_title' => 'Membership Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_membership', 
				'callback' => array( $this->callbacks, 'adminMembership' )
			)
		);
	}
}