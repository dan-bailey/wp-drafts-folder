<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.danbailey.net
 * @since      1.0.0
 *
 * @package    Wp_Drafts_Folder
 * @subpackage Wp_Drafts_Folder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Drafts_Folder
 * @subpackage Wp_Drafts_Folder/admin
 * @author     Dan Bailey <dbailey@danbailey.net>
 */
class Wp_Drafts_Folder_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Drafts_Folder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Drafts_Folder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-drafts-folder-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Drafts_Folder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Drafts_Folder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-drafts-folder-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_drafts_admin_menu_item() {
		// adds "Drafts" to the Posts menu in the Admin view
		add_posts_page(__('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=post');
	}

	add_action('admin_menu', 'add_drafts_admin_menu_item');

}