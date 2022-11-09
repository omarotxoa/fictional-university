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
    $mainPageHook = add_menu_page('Words to Filter', 'Word Filter', 'manage_options', 'wordfilter', array($this, 'wfp_settings_page'), plugin_dir_url(__FILE__) . 'custom.svg', 100);
    add_submenu_page('wordfilter', 'Words to Filter', 'Words List', 'manage_options', 'wordfilter', array($this, 'wfp_settings_page'));
    add_submenu_page('wordfilter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'wfp_options_page'));
    add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
  }

  function mainPageAssets() {
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'styles.css');
  }

  function wfp_settings_page() { ?>
    <div class="wrap">
      <h1>Word Filter Settings</h1>
      <form method="POST">
        <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p></label>
        <div class="word-filter__flex-container">
          <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible, words"></textarea>
        </div>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
      </form>
    </div>
  <?php }

  function wfp_options_page() { ?>
    Hello World from the options page
  <?php }

}

$wordFilterPlugin = new WordFilterPlugin();