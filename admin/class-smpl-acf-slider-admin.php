<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.simplethemes.com
 * @since      1.0.0
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/admin
 * @author     Casey Lee <casey@simplethemes.com>
 */
class Smpl_Acf_Slider_Admin {

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
		 * defined in Smpl_Acf_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Smpl_Acf_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/smpl-acf-slider-admin.css', array(), $this->version, 'all' );

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
		 * defined in Smpl_Acf_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Smpl_Acf_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/smpl-acf-slider-admin.js', array( 'jquery' ), $this->version, false );

	}


		/**
		 *
		 * Print the admin notice to the screen.
		 *
		 */
		public function admin_notice()
		{
			if ($notices = get_option('smpl_acf_slider_deferred_admin_notices')) {
				$notice = '<div class="error notice is-dismissible"><p>'.$notices[0].'</p></div>';
				echo $notice;
				delete_option('smpl_acf_slider_deferred_admin_notices');
			}
		}

		/**
		 *
		 * Fire admin notices
		 *
		 */

		public static function add_notice($active = array())
		{
			$notices   = get_option('smpl_acf_slider_deferred_admin_notices', array());
			if (in_array('acf_notice', $active)) {
				$notices[] = "ACF Slider requires Advanced Custom Fields Pro!";
		    	update_option('smpl_acf_slider_deferred_admin_notices', $notices);
		    }
		}

		/**
		 *
		 * Initialize admin notices
		 *
		 */

		public function admin_init()
		{
			$acf_installed = class_exists('acf');
			if (!$acf_installed) {
				$this->add_notice(array('acf_notice'));
			}
		}

}
