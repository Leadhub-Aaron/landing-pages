<?php
/*
 * Plugin Name: Landing Pages by LEADHUB - base files
 * Plugin URI: http://www.leadhub.net/
 * Description:  Common utilities used by LEADHUB landing pages.
 * Author: Leadhub
 * Author URI: http://www.leadhub.net/
 * License: GPLv2 or later
 */

namespace Leadhub;

add_action('plugins_loaded', function() {
    require __DIR__ . "/vendor/autoload.php";

    if(!class_exists('Leadhub\\Landing_Pages')) {
        include __DIR__ . '/class_landing_pages.php';
    }
});
