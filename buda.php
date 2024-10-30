<?php
/*
Plugin Name:   BUDA - Block User Dashboard Access
Plugin URI:    https://wordpress.org/plugins/buda-block-user-dashboard-access/
Description:   BUDA completely blocks users who are not administrators from accessing the dashboard, as well as removing the toolbar for non-administrators
Version:       1.0.1
Author:        chrisb10
Author URI:    https://profiles.wordpress.org/chrisb10
*/

// Add a custom function to check if the user is allowed to access the dashboard
add_action( 'init', 'buda_block_user_admin_access' );
function buda_block_user_admin_access() {
  if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
// Redirect to the home page if a non-admin user tries to access the dashboard 
    wp_redirect( home_url() );
    exit;
  }
}

// Hide toolbar for all users except admin
add_action('after_setup_theme', 'buda_remove_admin_bar');
function buda_remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}