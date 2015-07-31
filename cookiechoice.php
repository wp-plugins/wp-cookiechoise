<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   Wp Cookie Choice
 * @author    Marcus Franke <marcus@conversion-junkies.de>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Conversion Junkies
 *
 * @wordpress-plugin
 * Plugin Name: Wp Cookie Choice
 * Plugin URI:  http://www.conversion-junkies.de
 * Description: Integrate the www.cookiechoices.org scripts for Wordpress
 * Version:     1.1.0
 * Author:      Marcus Franke
 * Author URI:  http://www.conversion-junkies.de
 * Text Domain: wp_cookiechoice
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-cookiechoice.php' );

CookieChoice::get_instance();