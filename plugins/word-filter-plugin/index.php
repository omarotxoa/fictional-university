<?php 
/*
  Plugin Name: Word Filter Plugin
  Description: An awesome custom plugin. 
  Version: 1.0
  Author: Omar
  Author URI: https://pluginlink.plugin
*/

// A security measure
// exit if accessed directly
if( !defined('ABSPATH')) exit; 

class WordFilterPlugin {
  function __construct() {
    add_action('admin_menu', array($this, 'wordFilterMenu'));
  }

  function wordFilterMenu() {
    add_menu_page('Words to Filter', 'Word Filter', 'manage_options', 'wordfilter', array($this, 'wfp_settings_page'), plugin_dir_url(__FILE__) . 'custom.svg', 100);
    add_submenu_page('wordfilter', 'Words to Filter', 'Words List', 'manage_options', 'wordfilter', array($this, 'wfp_settings_page'));
    add_submenu_page('wordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'wfp_options_page'));
  }

  function wfp_settings_page() { ?>
    Hello World
  <?php }

  function wfp_options_page() { ?>
    Hello World from the options page
  <?php }

}

$wordFilterPlugin = new WordFilterPlugin();