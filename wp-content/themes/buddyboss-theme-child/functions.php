<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css', '', '1.0.0' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js', '', '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here

function redirect_to_profile( $redirect_to_calculated, $redirect_url_specified, $user ) {
    if ( ! $user || is_wp_error( $user ) ) {
        return $redirect_to_calculated;
    }
    // If the redirect is not specified, assume it to be dashboard.
    if ( empty( $redirect_to_calculated ) ) {
        $redirect_to_calculated = admin_url();
    }
    // if the user is not site admin, redirect to his/her profile.
    if ( function_exists( 'bp_core_get_user_domain' ) && ! is_super_admin( $user->ID ) ) {
        return $redirect_to_calculated = home_url();
    }
    // if site admin or not logged in, do not do anything much.
    return $redirect_to_calculated;
}
add_filter( 'login_redirect', 'redirect_to_profile', 100, 3 );

function remove_admin_bar()
{
    $array = get_post(255);
    $array = json_encode($array,true);
    $array = json_decode($array,true);

    if($array['post_content'] == "Your subscription has been set up successfully.") {
        header("Location: https://mbmprime.com/");
    }
    else if(current_user_can('administrator')) {
        return true;
    }
    return false;
}

add_filter('show_admin_bar', 'remove_admin_bar', PHP_INT_MAX);

?>