<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.simplethemes.com
 * @since             1.0.0
 * @package           Smpl_Acf_Slider
 *
 * @wordpress-plugin

Plugin Name:       ACF Slider
Plugin URI:        https://github.com/simplethemes/smpl-acf-slider
Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
Version:           1.0.0
Author:            Simple Themes
Author URI:        https://www.simplethemes.com
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:       smpl-acf-slider
Domain Path:       /languages
GitHub Plugin URI: https://github.com/simplethemes/smpl-acf-slider
GitHub Branch:     master

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smpl-acf-slider-activator.php
 */
function activate_smpl_acf_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smpl-acf-slider-activator.php';
	Smpl_Acf_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smpl-acf-slider-deactivator.php
 */
function deactivate_smpl_acf_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smpl-acf-slider-deactivator.php';
	Smpl_Acf_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smpl_acf_slider' );
register_deactivation_hook( __FILE__, 'deactivate_smpl_acf_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smpl-acf-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_smpl_acf_slider() {

	$plugin = new Smpl_Acf_Slider();
	$plugin->run();

}
run_smpl_acf_slider();
