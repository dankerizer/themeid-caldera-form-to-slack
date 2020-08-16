<?php
/**
 * Main plugin's file.
 *
 * @package WP_Slack
 */

/**
 * Plugin Name: Theme.id's Caldera Form to Slack
 * Plugin URI: http://caladea.com
 * Description: Send notifications to Slack channels when certain on Caldera Form submission.
 * Version: 0.1.1
 * Author: Theme.id
 * Author URI: https://theme.id
 * Text Domain: caladea-slack
 * Domain Path: /languages
 * License: GPL v2 or later
 * Requires at least: 5.3
 * Tested up to: 5.3
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
require_once __DIR__ . '/includes/appsero/src/Client.php';

require_once __DIR__ . '/includes/autoloader.php';

define('CALADEA_SLACK_FILE', __FILE__);
define('CALADEA_SLACK_PATH', plugin_dir_path(CALADEA_SLACK_FILE));

define('CALADEA_SLACK_URL', plugins_url('/', CALADEA_SLACK_FILE));



Caladea_Slack_Autoloader::register( 'Caladea_Slack', trailingslashit( plugin_dir_path( __FILE__ ) ) . '/includes/' );

// Runs this plugin after all plugins are loaded.
add_action( 'plugins_loaded', 'caladea_slack_loaded');
function caladea_slack_loaded(){
    if (caladea_slack_check_caldera()){
        $GLOBALS['caladea_slack'] = new Caladea_Slack_Plugin();
        $GLOBALS['caladea_slack']->run( __FILE__ );
    }
}
 function caladea_slack_check_caldera()
{
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('caldera-forms/caldera-core.php') || defined('CFCORE_VER')) {
        return true;
    }
    return false;
}


add_action('admin_notices', 'caladea_slack_notification');
function caladea_slack_notification(){
    $message = '<div class="notice notice-error is-dismissible">';
    $message .= '<p>';
    $message .= '<strong>Caldera</strong> Forms not yet activated. Please install and activated <strong>Caldera</strong> Forms first.';
    $message .= '</p>';

    $message .= '<p><a href="' . admin_url('plugin-install.php?s=caldera+forms&tab=search&type=term') . '">Click here</a></p>';
    $message .= '</div>';

    if (!caladea_slack_check_caldera()){
        echo $message;
    }
}
/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_themeid_caldera_form_to_slack() {

    if ( ! class_exists( '\Appsero\Client' ) ) {
        require_once __DIR__ . '/includes/appsero/src/Client.php';
    }

    $client = new \Appsero\Client( '445d5189-b127-457b-adc0-64c22d5b632e', "Theme.id's Caldera Form to Slack", __FILE__ );

    // Active insights
    $client->insights()->init();

}

appsero_init_tracker_themeid_caldera_form_to_slack();
