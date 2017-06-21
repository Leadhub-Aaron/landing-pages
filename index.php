<?php
/*
 * Plugin Name: LEADHUB Landing Page Utilities
 * Plugin URI: http://www.leadhub.net/
 * Description:  Common utilities used by LEADHUB landing pages.
 * Author: Leadhub
 * Author URI: http://www.leadhub.net/
 * License: GPLv2 or later
 */

include __DIR__ . "/vendor/autoload.php";

if(!class_exists('Leadhub\\Landing_Pages')) {
    include __DIR__ . '/class_landing_pages.php';
}
