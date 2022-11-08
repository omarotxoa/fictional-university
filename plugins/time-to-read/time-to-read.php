<?php 
/*
  Plugin Name: Time to Read
  Description: Adds word count and time to read for content
  Version: 1.0
  Author: Omar
  Author URI: https://pluginlink.plugin
*/
?>

<?php

class TimeToReadPlugin {
  function __construct() {
    add_action('admin_menu', array($this, 'adminPage'));
    add_action('admin_init', array($this, 'settings'));
  }

  function adminPage() {
    // add_options_page(1,2,3,4,5)
    // 1: The Title 
    // 2: Title Text used in Settings Menu
    // 3: User role required to view page. 'manage_options' means only users who can change options can see the page
    // 4: Slug
    // 5: Function to output the HTML content
    add_options_page('Time To Read Settings', 'Time to Read Plugin', 'manage_options', 'time-to-read-settings', array($this, 'settingsPageHTML'));
  }

  function settings() {
    // add_settings_section(1,2,3,4)
    // 1. The name of the section we're creating
    // 2. The Title of the section (null for no title)
    // 3. Extra content after title
    // 4. Page slug for the settings page we want to add this section to
    add_settings_section('ttr_first_section', null, null, 'time-to-read-settings');


    // Display Location

    // register_setting(1,2,3)
    // 1. Name of the Group this setting belongs to
    // 2. Name for this specific setting
    // 3. An array with a sanitized callback and a default value
    register_setting('timetoreadplugin', 'ttr_location', array(
      'sanitize_callback' => array($this, 'sanitizeLocation'), 
      'default' => '0'
    ));

    // add_settings_field(1,2,3,4,5);
    // 1. The name of a registered setting we want to tie this to
    // 2. The HTML Label Text - What users see on the frontend
    // 3. Outputs html
    // 4. The page slug for the settings page we're working with
    // 5. The section we want to add this field to
    add_settings_field('ttr_location', 'Display Location', array($this, 'locationHTML'), 'time-to-read-settings', 'ttr_first_section');

    // Headline 

    register_setting('timetoreadplugin', 'ttr_headline', array(
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => 'Post Statistics'
    ));
    add_settings_field('ttr_headline', 'Headline Text', array($this, 'headlineHTML'), 'time-to-read-settings', 'ttr_first_section');


    // Word Count
    // Default set to 1 here because we need true/false for the checkmark
    register_setting('timetoreadplugin', 'ttr_wordcount', array(
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1'
    ));
    add_settings_field('ttr_wordcount', 'Word Count', array($this, 'wordcountHTML'), 'time-to-read-settings', 'ttr_first_section');

    // Character Count
    register_setting('timetoreadplugin', 'ttr_charcount', array(
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1'
    ));
    add_settings_field('ttr_charcount', 'Character Count', array($this, 'charcountHTML'), 'time-to-read-settings', 'ttr_first_section');

    // Read Time 
    register_setting('timetoreadplugin', 'ttr_readtime', array(
      'sanitize_callback' => 'sanitize_text_field', 
      'default' => '1'
    ));
    add_settings_field('ttr_readtime', 'Read Time', array($this, 'readtimeHTML'), 'time-to-read-settings', 'ttr_first_section');
  }

  // Custom Sanitize / Error function
  function sanitizeLocation($input) {
    if ($input != '0' AND $input != '1') {
      add_settings_error('ttr_location', 'ttr_location_error', 'Display Location must be either Beginning or End');
      return get_option('ttr_location');
    }
    return $input;
  }
  
  function locationHTML() { ?>
    <select name="ttr_location">
      <option value="0" <?php selected(get_option('ttr_location'), '0'); ?>>Beginning of post</option>
      <option value="1" <?php selected(get_option('ttr_location'), '1'); ?>>End of post</option>
    </select>
  <?php }

  function wordcountHTML() { ?>
    <input type="checkbox" name="ttr_wordcount" value="1" <?php checked(get_option('ttr_wordcount'), '1')?>>
  <?php }

  function charcountHTML() { ?>
    <input type="checkbox" name="ttr_charcount" value="1" <?php checked(get_option('ttr_charcount'), '1')?>>
  <?php }

  function readtimeHTML() { ?>
    <input type="checkbox" name="ttr_readtime" value="1" <?php checked(get_option('ttr_readtime'), '1')?>>
  <?php }

  //dry checkbox function
  // requires to set a sixth argument with an array of our own value containing the checkbox settings name. couldn't get it to work
  /*
  function checkboxHTML() { ?>
    <input type="checkbox" name="<?php echo $args['theName']?> " value="1" <?php checked(get_option($args['theName']), '1'); ?>>
  <?php }
  */

  // The Value in this input field is prepopulated with the default set above in the register_setting function
  function headlineHTML() { ?>
    <input type="text" name="ttr_headline" value="<?php echo esc_attr(get_option('ttr_headline')); ?>">
  <?php }

  function settingsPageHTML() { ?>
    <h1>Time to Read Plugin Settings</h1>
    <form action="options.php" method="POST">
      <?php 
        // handles a lot of the permissions and security
        settings_fields('timetoreadplugin');
        // adds the settings sections
        do_settings_sections('time-to-read-settings');
        submit_button();
      ?>
    </form>
  <?php } 
} 

$timeToReadPlugin = new TimeToReadPlugin(); 

?>