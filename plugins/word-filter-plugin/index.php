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
    add_menu_page('Words to Filter', 'Word Filter', 'manage_options', 'wordfilter', array($this, 'wordFilterPage'), 'dashicons-smiley', 100);
    add_submenu_page('wordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
  }

  function wordFilterPage() { ?>
    Hello World
  <?php }

  function optionsSubPage() { ?>
    Hello World from the options page
  <?php }

}

$wordFilterPlugin = new WordFilterPlugin();