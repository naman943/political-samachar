<?php 
/*
Plugin Name: Breaking News Ticker
Plugin URI: https://wordpress.org/plugins/breaking-news-ticker/
Description: Breaking News Ticker Lite is a Free, lightweight, stylish, easy to use and flexible breaking news ticker.
Version: 2.4.4
Author: WP Qastle
Author URI: http://wpqastle.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: breaking-nt

Copyright 2016  WP Qastle  (email : info@wpqastle.com)
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/* 
* GLOBAL PATHS & FOLDERS
*
* @since      2.0
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

define( 'BNT_PLUGIN_PATH'       ,  plugin_dir_url(  __FILE__  ) );                              // THE PLUGIN PATH
define( 'BNT_PLUGIN_DIR'        ,  dirname( __FILE__ ) . '/' );                                 // THE PLUGIN DIRECTORY
define( 'BNT_PLUGIN_MAIN_PATH' 	,  plugin_basename( __FILE__ ) );                               // THE PLUGIN MAIN PATH
define( 'BNT_ADMIN_FOLDER'      ,  BNT_PLUGIN_DIR		. 'admin/');                            // THE ADMIN FOLDER
define( 'BNT_INC_FOLDER'        ,  BNT_PLUGIN_DIR		. 'inc/');                              // THE INC FOLDER
define( 'BNT_ASSETS_FOLDER'     ,  BNT_PLUGIN_PATH		. 'assets/');                           // THE ASSETS FOLDER
define( 'BNT_CSS_FOLDER'        ,  BNT_ASSETS_FOLDER	. 'css/');                              // THE CSS FOLDER
define( 'BNT_JS_FOLDER'         ,  BNT_ASSETS_FOLDER	. 'js/');                               // THE JS FOLDER
define( 'BNT_IMG_FOLDER'        ,  BNT_ASSETS_FOLDER	. 'images/');                           // THE IMAGES FOLDER
define( 'BNT_THUMB_IMG'        	,  BNT_IMG_FOLDER		. 'no-thumb.jpg');                      // THE Thumb IMAGE
define( 'BNT_TICKER_CSS'        ,  BNT_CSS_FOLDER		. 'ticker-style.css');                  // THE TICKER CSS
define( 'BNT_ADMIN_CSS'        	,  BNT_CSS_FOLDER		. 'admin.css');                  		// THE ADMIN CSS
define( 'BNT_TICKER_JS'         ,  BNT_JS_FOLDER		. 'newsTicker.min.js');                 // THE TICKER JS
define( 'BNT_EASING_JS'         ,  BNT_JS_FOLDER		. 'jquery.easing.min.js');              // THE EASING JS
define( 'BNT_ACCORDION_JS'      ,  BNT_JS_FOLDER		. 'jquery.accordion.js');               // THE ACCORDION JS
define( 'BNT_ACCORDION_CSS'     ,  BNT_CSS_FOLDER		. 'jquery.accordion.css');              // THE ACCORDION CSS
	
/* 
* Load all the necessary PHP files.
*
* @since      2.0
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

// Admin Settings
if (is_admin()) {
	require(BNT_ADMIN_FOLDER . 'class.settings-api.php');
	require(BNT_ADMIN_FOLDER . 'amity-settings-api.php');
}

// Call All Functions
require(BNT_INC_FOLDER . 'functions.php');

// Call All Breaking News Ticker widget
require(BNT_INC_FOLDER . 'widget.php');

// Call All Shortcode
require(BNT_INC_FOLDER . 'shortcode.php');

// Call All Breaking News Ticker Main Function
require(BNT_INC_FOLDER . 'bnt.php');

/*  Aqua Resizer
*	Author: Syamil MJ
*/
function bnt_aq_resizer() {
    if ( !class_exists( 'bnt_aq_resizer_class' ) ) {
		require_once(BNT_INC_FOLDER . 'aq_resizer.php');
    }
}

/* 
* Hooks - Actions - Filters
*
* @since      2.0
* @package    Breaking News Ticker
* @author     WP Qastle <info@wpqastle.com>
*/

add_action('plugins_loaded', 'bnt_load_textdomain');

// Latest Jquery
add_action('init', 'breaking_nt_wp_latest_jQuery');

// Register Shortcode
add_shortcode('breaking_news_ticker', 'breaking_news_ticker_shortcode');

// Load Plugin links
add_filter( 'plugin_action_links_' . BNT_PLUGIN_MAIN_PATH , 'bnt_plugin_action_links' );

// Load all the necessary CSS & JS files.
add_action('init','breaking_nt_js_css');

// Load Widget Function
add_action( 'widgets_init', 'register_bnt_widget' );

// Load Main Function
add_action( 'show_bnt', 'breaking_news_ticker');

// Customize and defaults code load in the <head>.
add_action('wp_head', 'breaking_nt_style' );

// Init Main Function
add_action('wp_footer', 'init_ticker' );

// Load all the necessary CSS & JS files.
add_action('admin_enqueue_scripts','breaking_nt_admin_css');

// Load Context Media Buttons
add_action('media_buttons_context', 'bnt_shortcode_btn');

// Load Aq Resizer
add_action( 'init', 'bnt_aq_resizer', 9999 );

?>