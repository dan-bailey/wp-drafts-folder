<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.danbailey.net
 * @since             1.0.0
 * @package           Wp_Drafts_Folder
 *
 * @wordpress-plugin
 * Plugin Name:       WP Drafts Folder
 * Plugin URI:        https://github.com/dan-bailey/wp-drafts-folder/blob/master/index.php
 * Description:       Adds a "Drafts" link to the Posts folder in the admin section.
 * Version:           1.0.0
 * Author:            Dan Bailey
 * Author URI:        https://www.danbailey.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-drafts-folder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_DRAFTS_FOLDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-drafts-folder-activator.php
 */
function activate_wp_drafts_folder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-drafts-folder-activator.php';
	Wp_Drafts_Folder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-drafts-folder-deactivator.php
 */
function deactivate_wp_drafts_folder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-drafts-folder-deactivator.php';
	Wp_Drafts_Folder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_drafts_folder' );
register_deactivation_hook( __FILE__, 'deactivate_wp_drafts_folder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-drafts-folder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */



/* here's the actual stuff that happens */
function add_drafts_admin_menu_item() {
	// adds "Drafts" to the Posts menu in the Admin view
	add_posts_page(__('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=post');	
}
add_action('admin_menu', 'add_drafts_admin_menu_item');


function run_wp_drafts_folder() {

	$plugin = new Wp_Drafts_Folder();
	$plugin->run();

}
