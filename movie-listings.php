<?php
/*
*	Plugin name: Movie Listings
*	Plugin URI: http://www.iodevllc.com
*	Description: Add movie listings
* 	Version: 0.1 beta
*	Author:	Mher Margaryan
*	Author URI: iodevllc.com
*/

if (!defined('ABSPATH')) {
  exit('You are not allowed to be here.');
}

// Require scripts
require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-scripts.php');

// Require shortcodes
require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-shortcodes.php');


  // Require settings
  require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-settings.php');
  // Require custom post type file
  require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-cpt.php');
  // Require fileds
  require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-fields.php');
  // Require reorder
  require_once(plugin_dir_path(__FILE__).'/includes/movie-listings-reorder.php');
