<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Birtix_Lead
 * @subpackage Birtix_Lead/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Birtix_Lead
 * @subpackage Birtix_Lead/admin
 * @author     Your Name <email@example.com>
 */
class Birtix_Lead_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cf7_birtix_lead    The ID of this plugin.
	 */
	private $cf7_birtix_lead;

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
	 * @param      string    $cf7_birtix_lead       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cf7_birtix_lead, $version ) {

		$this->cf7_birtix_lead = $cf7_birtix_lead;
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
		 * defined in Birtix_Lead_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Birtix_Lead_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->cf7_birtix_lead, plugin_dir_url( __FILE__ ) . 'css/cf7-birtix-lead-admin.css', array(), $this->version, 'all' );

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
		 * defined in Birtix_Lead_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Birtix_Lead_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->cf7_birtix_lead, plugin_dir_url( __FILE__ ) . 'js/cf7-birtix-lead-admin.js', array( 'jquery' ), $this->version, false );

	}

}
