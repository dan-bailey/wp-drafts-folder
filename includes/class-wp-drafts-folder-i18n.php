<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.danbailey.net
 * @since      1.0.0
 *
 * @package    Wp_Drafts_Folder
 * @subpackage Wp_Drafts_Folder/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Drafts_Folder
 * @subpackage Wp_Drafts_Folder/includes
 * @author     Dan Bailey <dbailey@danbailey.net>
 */
class Wp_Drafts_Folder_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-drafts-folder',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
