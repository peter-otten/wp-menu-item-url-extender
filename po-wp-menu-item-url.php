<?php
defined( 'ABSPATH' ) OR exit;
/*
Plugin Name: Wordpress menu item url extender
Plugin URI:  https://github.com/rexxnar/wp-menu-item-url
Description: Plugin voor het tonen van de url bij menu items in wordpress
Version:     0.0.1
Author:      Peter Otten
Author URI:  https://www.peterotten.com
*/

function PO_wp_menu_item_url_on_activation()
{
	//activate
}

function PO_wp_menu_item_url_on_deactivation()
{
	//deactivate
}

register_activation_hook(   __FILE__, 'PO_wp_menu_item_url_on_activation' );
register_deactivation_hook( __FILE__, 'PO_wp_menu_item_url_on_deactivation' );

$adminMenu = new AdminMenu();

class AdminMenu {

	public function __construct()
	{
		add_action('admin_init', [$this, 'enqueue_script']);
	}

	public function enqueue_script() {
		$scriptSource =  plugin_dir_url(__FILE__) . 'js/po-wp-menu-item-url.js';
		$distPath = sprintf('%s/js/', __DIR__);
		wp_enqueue_script('PO_wp_menu_item_url',  $scriptSource, ['jquery'], filemtime($distPath . $scriptSource), 'all' );
	}
}

// Init the class on priority 0 to avoid adding priority inside the class as default = 10
add_action('admin_init', array ( 'AdminMenu', 'init' ), 0);