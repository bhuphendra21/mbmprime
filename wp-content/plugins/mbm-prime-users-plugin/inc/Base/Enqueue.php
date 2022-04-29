<?php

namespace Inc\Base;

class Enqueue
{
    public function register()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('mbm-prime-user-plugin-styles', PLUGIN_URL . 'assets/css/style.css');
        if (is_page('sign-up')) {
            wp_enqueue_style('mbm-prime-user-plugin-intlTelInput', PLUGIN_URL . 'assets/css/intlTelInput.css');

            wp_enqueue_script('mbm-prime-user-plugin-intelinput-scripts', PLUGIN_URL . 'assets/js/intlTelInput.js', '', '1.0', true);
            wp_enqueue_script('mbm-prime-user-plugin-signup-page-scripts', PLUGIN_URL . 'assets/js/signup.js', '', '1.0', true);
            wp_enqueue_media();
            wp_enqueue_script('mbm-prime-user-plugin-uploadimage-scripts', PLUGIN_URL . 'assets/js/uploadimage.js', array('jquery'), '1.0', true);
        }
    }
}
