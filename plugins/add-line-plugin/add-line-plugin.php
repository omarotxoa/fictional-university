<?php 
/*
  Plugin Name: Add Line Plugin
  Description: An awesome custom plugin. 
  Version: 1.0
  Author: Omar
  Author URI: https://pluginlink.plugin
*/

add_filter('the_content', 'addToEndOfPost');

function addToEndOfPost($content) {
  if  (is_single() && is_main_query()) {
    return $content . '<p>This is a test</p>';
  }

  return $content;
}
?>