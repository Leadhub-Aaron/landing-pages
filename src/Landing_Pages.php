<?php

namespace Leadhub;

if(!class_exists('Landing_Pages')):

$templates = array();

$plugins = dirname(__DIR__);

define('LLP_MENU_PAGE', 'lh-landing-pages.php');

class Landing_Pages {

    public static function init() {
        Common::register_post_type('landing page', 'landing pages', array(
            'rewrite' => array( 'slug' => 'lp', 'with_front' => false ),
        ), "lh_");
    }

    public static function add_all_page_templates($post_type_templates, $object, $post, $post_type) {
        global $templates;
        global $plugins;

        foreach($templates as $path => $name) {
            $full = $plugins . '/' . $path;

            if(file_exists($full)) {
                $post_type_templates[$path] = $name;
            }
        }

        return $post_type_templates;
    }

    public static function get_lp_post_type() {
        return 'lh_landing_page';
    }

    public static function register_template($path, $name) {
        global $templates;
        global $plugins;

        $path = Landing_Pages::get_template_fields_path($path);

        $templates[$path] = $name;

        return $path;
    }

    public static function get_template_fields_path($path) {
        global $plugins;

        return trim(str_replace($plugins, "", $path), '/');
    }

    public static function include_template($template) {
        global $templates;
        global $plugins;

        $meta = get_post_meta(get_the_ID(), '_wp_page_template');

        $proceed = get_post_type() == Landing_Pages::get_lp_post_type() 
            && is_single()
            && is_array($meta)
            && sizeof($meta) > 0;

        if($proceed) {
            foreach($templates as $path => $name) {
                $full = $plugins . '/' . $path;

                if($path === $meta[0]) {
                    $template = $full;
                }
            }
        }

        return $template;
    }

    public static function main() {
        add_action('init', array('Leadhub\\Landing_Pages', 'init'));
        add_filter('theme_lh_landing_page_templates', array('Leadhub\\Landing_Pages', 'add_all_page_templates'), 10, 4);
        add_action('admin_head', array('Leadhub\\Common', 'fix_carbon_wysiwyg'));
        add_filter('template_include', array('Leadhub\\Landing_Pages', 'include_template'));
    }
}

Landing_Pages::main();

endif;
