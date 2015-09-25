<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also includes all of the dependencies used by
 * the plugin, and creates a instance of the core plugin class.
 * 
 * @link       https://github.com/jelofsson/somc-subpages-jelofsson
 * @package    WordPress
 * @subpackage Component
 * @since      1.0.0
 * @copyright  Copyright (c) 2015 Jimmi Elofsson <contact@jimmi.eu>
 * @license    http://opensource.org/licenses/MIT   MIT License
 *
 * @wordpress-plugin
 * Plugin Name: SOMC Subpages
 * Description: Display subpages of current page/post with widget or shortcode
 * Version: 1.0.0
 * Author: Jimmi Elofsson
 * Author URI: http://www.jimmi.eu/
 * License: MIT
 */

// if this file is called directly, abort.
if ( ! defined( 'WPINC' )) {
	die;
}

/**
 * Loading the core class of our plugin, and its dependencies.
 * TODO: fix a __autoload function
 */
require plugin_dir_path( __FILE__ ) . '/includes/classes/class-plugin-widget.php';
require plugin_dir_path( __FILE__ ) . '/includes/classes/class-helper-text.php';

// creating an instance of our plugin
$plugin = new Plugin_Widget();