<?php

/**
 * Plugin Name:       Prime Users Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       This is the Prime Users Plugin. Its main functionality is to handle users.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tom Marto @MBM Prime
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       prime-users
 * Domain Path:       /languages
 */

defined('ABSPATH') or die('Hey dont fuck with my plugin! You dumb!');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

function mbmprime_pluginActivationCode()
{
    if (class_exists('\Inc\Pages\SignUp')) {
        $SignUpPage = new \Inc\Pages\SignUp();
    }

    if (class_exists('\Inc\Base\Roles')) {
        $Roles = new \Inc\Base\Roles();
    }

    if (class_exists('\Inc\Database\Db')) {
        $Db = new \Inc\Database\Db;
    }

    // Change by Senza add functions
    if (class_exists('\Inc\Api\User')) {
        $User = new \Inc\Api\User;
    }

    \Inc\Base\Activate::activate($SignUpPage, $Roles, $Db, $User);
}
register_activation_hook(__FILE__, 'mbmprime_pluginActivationCode');
function mbmprime_pluginDeactivationCode()
{
    \Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'mbmprime_pluginDeactivationCode');

if (class_exists('Inc\\Init')) {
    \Inc\Init::registerServices();
}
