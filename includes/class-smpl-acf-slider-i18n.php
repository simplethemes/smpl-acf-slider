<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.simplethemes.com
 * @since      1.0.0
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/includes
 * @author     Casey Lee <casey@simplethemes.com>
 */
class Smpl_Acf_Slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'smpl-acf-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
