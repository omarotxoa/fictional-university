<?php 
/*
  Plugin Name: A Javascript Plugin
  Description: An awesome custom Gutenberg Block plugin test. 
  Version: 1.0
  Author: Omar
  Author URI: https://pluginlink.plugin
*/

if( !defined('ABSPATH')) exit; 

class AJavascriptPlugin {
  function __construct() {
    add_action('enqueue_block_editor_assets', array($this, 'admin_assets'));
  }

  function admin_assets() {
    wp_enqueue_script('our_new_block_type', plugin_dir_url(__FILE__) . '/build/index.js', array('wp-blocks', 'wp-element'));
  }
}

$aJavascriptPlugin = new AJavascriptPlugin();

