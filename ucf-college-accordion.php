<?php
/*
Plugin Name: UCF College Accordion
Description: Provides a shortcode for an accordion, to be used in the UCF Colleges Theme
Version: 1.0.5
Author: Stephen Schrauger
Plugin URI: https://github.com/schrauger/UCF-College-Accordion
Github Plugin URI: schrauger/UCF-College-Accordion
*/
if ( ! defined( 'WPINC' ) ) {
    die;
}

include plugin_dir_path( __FILE__ ) . 'includes/common/tinymce.php';
include plugin_dir_path( __FILE__ ) . 'includes/common/shortcode-taxonomy.php';
include plugin_dir_path( __FILE__ ) . 'includes/acf-pro-fields.php';
include plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';

class ucf_college_accordion {
    function __construct() {
        // plugin css/js
        add_action('wp_enqueue_scripts', array($this, 'add_css'));
        add_action('wp_enqueue_scripts', array($this, 'add_js'));

        // plugin activation hooks
        register_activation_hook( __FILE__, array($this,'activation'));
        register_deactivation_hook( __FILE__, array($this,'deactivation'));
        register_uninstall_hook( __FILE__, array($this,'deactivation'));
    }

    function add_css(){
	    if (file_exists(plugin_dir_path(__FILE__).'/includes/plugin.css')) {
		    wp_enqueue_style(
			    'ucf-college-accordion-style',
			    plugin_dir_url( __FILE__ ) . '/includes/plugin.css',
			    false,
			    filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.css' ),
			    false
		    );
	    }
    }

    function add_js(){
        wp_enqueue_script('jquery-ui-accordion');

	    if (file_exists(plugin_dir_path(__FILE__).'/includes/plugin.js')) {
		    wp_enqueue_script(
			    'ucf-college-accordion-script',
			    plugin_dir_url( __FILE__ ) . 'includes/plugin.js',
			    array( 'jquery', 'jquery-ui-accordion' ),
			    filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.js' ),
			    false
		    );
	    }
    }
    
    


    // run on plugin activation
    function activation(){
        // insert the shortcode for this plugin as a term in the taxonomy
        ucf_college_accordion_shortcode::insert_shortcode_term();
    }

    // run on plugin deactivation
    function deactivation(){
        ucf_college_accordion_shortcode::delete_shortcode_term();
    }

    // run on plugin complete uninstall
    function uninstall(){
        ucf_college_accordion_shortcode::delete_shortcode_term();
    }
}

new ucf_college_accordion();



