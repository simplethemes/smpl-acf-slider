<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.simplethemes.com
 * @since      1.0.0
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/includes
 * @author     Casey Lee <casey@simplethemes.com>
 */
class Smpl_Acf_Slider_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-smpl-acf-slider-admin.php';
        Smpl_Acf_Slider_Admin::add_notice();
	}


}
