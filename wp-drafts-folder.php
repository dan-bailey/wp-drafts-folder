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


function wp_drafts_folder_register_dashboard_widget() {
	wp_add_dashboard_widget(
		'wp_drafts_folder_dashboard_widget',
		__( 'Draft Content', 'wp-drafts-folder' ),
		'wp_drafts_folder_dashboard_widget_content'
	);
}
add_action( 'wp_dashboard_setup', 'wp_drafts_folder_register_dashboard_widget' );

function wp_drafts_folder_dashboard_widget_content() {
	$post_types       = get_post_types( [ 'public' => true ], 'objects' );
	$post_type_names  = array_keys( $post_types );

	$drafts = get_posts( [
		'post_status'    => 'draft',
		'post_type'      => $post_type_names,
		'posts_per_page' => 50,
		'orderby'        => 'modified',
		'order'          => 'DESC',
	] );

	if ( empty( $drafts ) ) {
		echo '<p>' . esc_html__( 'No drafts found.', 'wp-drafts-folder' ) . '</p>';
		return;
	}

	$types_in_results = [];
	foreach ( $drafts as $draft ) {
		if ( ! isset( $types_in_results[ $draft->post_type ] ) ) {
			$types_in_results[ $draft->post_type ] = $post_types[ $draft->post_type ]->labels->singular_name;
		}
	}

	echo '<div class="wpdf-filter">';
	echo '<label for="wpdf-type-filter">' . esc_html__( 'Filter by type:', 'wp-drafts-folder' ) . '</label>';
	echo '<select id="wpdf-type-filter">';
	echo '<option value="all">' . esc_html__( 'All Types', 'wp-drafts-folder' ) . '</option>';
	foreach ( $types_in_results as $type => $label ) {
		echo '<option value="' . esc_attr( $type ) . '">' . esc_html( $label ) . '</option>';
	}
	echo '</select>';
	echo '</div>';

	echo '<ul class="wpdf-draft-list">';
	foreach ( $drafts as $draft ) {
		$edit_link  = get_edit_post_link( $draft->ID );
		$type_label = $post_types[ $draft->post_type ]->labels->singular_name;
		$modified   = get_the_modified_date( 'M j, Y', $draft );
		$title      = $draft->post_title ?: __( '(no title)', 'wp-drafts-folder' );
		echo '<li class="wpdf-draft-item" data-post-type="' . esc_attr( $draft->post_type ) . '">';
		echo '<div class="wpdf-draft-title"><a href="' . esc_url( $edit_link ) . '">' . esc_html( $title ) . '</a></div>';
		echo '<div class="wpdf-draft-meta">';
		echo '<span class="wpdf-type-badge">' . esc_html( $type_label ) . '</span>';
		echo '<span class="wpdf-date">' . esc_html__( 'Last edited', 'wp-drafts-folder' ) . ' ' . esc_html( $modified ) . '</span>';
		echo '</div>';
		echo '</li>';
	}
	echo '</ul>';
}


function run_wp_drafts_folder() {

	$plugin = new Wp_Drafts_Folder();
	$plugin->run();

}
