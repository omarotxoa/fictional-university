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
  
  function settingsPageHTML() { ?>
    <h2>Hello</h2>
  <?php } 
} 

$timeToReadPlugin = new TimeToReadPlugin(); 

?>