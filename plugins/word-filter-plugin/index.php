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

  function handleForm() {
    if (wp_verify_nonce($_POST['ourNonce'], 'saveFilterWords') AND current_user_can('manage_options')) {
      update_option('plugin_words_to_filter', $_POST['plugin_words_to_filter']); ?>
      <div class="updated">Settings Saved</div>
    <?php } else { ?>
      <div class="error">
        <p>Sorry, you do not have permission to perform that action.</p>
      </div>
    <?php }
  }

  function wfp_settings_page() { ?>
    <div class="wrap">
      <h1>Word Filter Settings</h1>
      <?php if ($_POST['justsubmitted'] == "true") $this->handleForm() ?>
      <form method="POST">
        <input type="hidden" name="justsubmitted" value="true">
        <?php wp_nonce_field('saveFilterWords', 'ourNonce'); ?>
        <label for="plugin_words_to_filter"><p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p></label>
        <div class="word-filter__flex-container">
          <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible, words"><?php echo esc_textarea(get_option('plugin_words_to_filter')); ?></textarea>
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