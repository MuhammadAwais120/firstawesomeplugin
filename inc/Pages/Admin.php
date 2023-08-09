<?php
/**
* @package firstawesome-plugin
*/

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;


class Admin extends BaseController
{
    public $settings;

	public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register() {
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();
       
		$this->setPages();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();

    }
	public function setPages(){
		$this->pages = array(
            [
                'page_title' => 'Awesome Plugin',
                'menu_title' => 'Awesome',
                'capability' => 'manage_options',
                'menu_slug' => 'awesome_plugin',
                'callback' => array( $this->callbacks, 'adminDashboard' ), 
                'icon_url' => 'dashicons-store',
                'position' => 100
            ]
        );
	}
	public function setSubpages(){
		$this->subpages = array(
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'awesome_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'awesome_widgets', 
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'awesome_options_group',
				'option_name' => 'text_example',
				'callback' => array( $this->callbacks, 'awesomeOptionsGroup' )
			),
			array(
				'option_group' => 'awesome_options_group',
				'option_name' => 'first_name'
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'awesome_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callbacks, 'awesomeAdminSection' ),
				'page' => 'awesome_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'text_example',
				'title' => 'Text Example',
				'callback' => array( $this->callbacks, 'awesomeTextExample' ),
				'page' => 'awesome_plugin',
				'section' => 'awesome_admin_index',
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => array( $this->callbacks, 'awesomeFirstName' ),
				'page' => 'awesome_plugin',
				'section' => 'awesome_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => 'example-class'
				)
			)
		);

		$this->settings->setFields( $args );
	}
	

}