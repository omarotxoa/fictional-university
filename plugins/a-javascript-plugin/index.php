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
    add_action('init', array($this, 'admin_assets'));
  }

  function admin_assets() {
    wp_register_script('our_new_block_type', plugin_dir_url(__FILE__) . '/build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ajp/a-javascript-plugin', array(
      'editor_script' => 'our_new_block_type',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes) {
    ob_start(); ?>
    <h1>Today the sky is completely <?php echo $attributes['skyColor']; ?> and the grass is <?php echo $attributes['grassColor']; ?> !!!</h1>
    <?php return ob_get_clean();
  }
}

$aJavascriptPlugin = new AJavascriptPlugin();

