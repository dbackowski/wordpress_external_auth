<?php
/*
Plugin Name: External Authentication
Description:  Wordpress external authentication.
Version: 1.0
Author: Damian Baćkowski
Author URI: https://github.com/dbackowski/wordpress_external_auth
License: MIT
*/

add_filter('authenticate', 'external_auth', 10, 3);
add_action('admin_menu', 'external_auth_menu');

function external_auth_menu() {
  add_options_page('External Auth Options', 'External Authentication', 'manage_options', 'external-auth-menu', 'external_auth_settings');
  add_action('admin_init', 'register_external_auth_settings');
}

function external_auth_settings() {
  include('settings.php');
}

function register_external_auth_settings() {
  register_setting( 'external-auth-settings', 'authentication_url' );
  register_setting( 'external-auth-settings', 'login_param_name' );
  register_setting( 'external-auth-settings', 'password_param_name' );
}

function external_auth($user, $username, $password) {
  if ($username == '' || $password == '') return;

  $data = array('body' => array(get_option('login_param_name') => $username, get_option('password_param_name') => $password));
  $response = wp_remote_post(get_option('authentication_url'), $data);
  $auth_response = json_decode($response['body'], true);

  if($auth_response['status'] == 1) {
    $userobj = new WP_User();
    $user = $userobj->get_data_by('email', $auth_response['email']);
    $user = new WP_User($user->ID);

    if ($user->ID == 0) {
       $user_data = array('user_email' => $auth_response['email'],
                         'user_login' => $auth_response['login'],
                         'first_name' => $auth_response['first_name'],
                         'last_name' => $auth_response['last_name']);

      $new_user_id = wp_insert_user($user_data);
      $user = new WP_User ($new_user_id);
    }
  } else {
    $user = new WP_Error('denied', __("Bad user/password"));
  }

  return $user;
}

?>
