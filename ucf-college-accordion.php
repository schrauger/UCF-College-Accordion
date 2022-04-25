<?php
/*
Plugin Name: UCF College Accordion
Description: Provides a shortcode for an accordion, to be used in the UCF Colleges Theme
Version: 1.6.0
Author: Stephen Schrauger
Plugin URI: https://github.com/schrauger/UCF-College-Accordion
Github Plugin URI: schrauger/UCF-College-Accordion
*/

namespace ucf_college_accordion;

if ( ! defined( 'WPINC' ) ) {
    die;
}

include plugin_dir_path( __FILE__ ) . 'includes/shortcode-taxonomy.php';
include plugin_dir_path( __FILE__ ) . 'includes/acf-pro-fields.php';
include plugin_dir_path( __FILE__ ) . 'includes/block.php';

// plugin css/js
add_action('enqueue_block_assets', __NAMESPACE__ .  '\\add_css');
add_action('enqueue_block_assets', __NAMESPACE__ .  '\\add_js');

// backwards compatibility
add_action('init', __NAMESPACE__ . '\\register_taxonomy');

// plugin activation hooks
register_activation_hook( __FILE__, __NAMESPACE__ .  '\\activation');
register_deactivation_hook( __FILE__, __NAMESPACE__ .  '\\deactivation');
register_uninstall_hook( __FILE__, __NAMESPACE__ .  '\\deactivation');


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

   /* if (file_exists(plugin_dir_path(__FILE__).'/includes/plugin.js')) {
	    wp_enqueue_script(
		    'ucf-college-accordion-script',
		    plugin_dir_url( __FILE__ ) . 'includes/plugin.js',
		    array( 'jquery', 'jquery-ui-accordion' ),
		    filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.js' ),
		    true
	    );
    }*/
	if (is_admin()) {
		// only load this js on editor pages


		if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor.js' ) ) {
			wp_enqueue_script(
				'ucf-college-accordion-script-editor',
				plugin_dir_url( __FILE__ ) . 'includes/plugin-editor.js',
				array( 'jquery' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor.js' ),
				true
			);
		}

		if ( file_exists( plugin_dir_path( __FILE__ ) . 'includes/arrive.min.js' ) ) {
			wp_enqueue_script(
				'arrive',
				plugin_dir_url( __FILE__ ) . 'includes/arrive.min.js',
				array( 'jquery' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/includes/arrive.min.js' ),
				false
			);
		}
		if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor-hide-taxonomy-if-unused.js' ) ) {
			wp_enqueue_script(
				'ucf-college-accordion-script-editor-hide-taxonomy-if-unused',
				plugin_dir_url( __FILE__ ) . 'includes/plugin-editor-hide-taxonomy-if-unused.js',
				array( 'jquery', 'arrive' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin-editor-hide-taxonomy-if-unused.js' ),
				true
			);
		}
	}


}

function register_taxonomy() {
	\ucf_college_shortcode_taxonomy\create_taxonomy(acf_pro_fields\shortcode);
}
    
    


// run on plugin activation
function activation(){
    // insert the shortcode for this plugin as a term in the taxonomy
    //ucf_college_accordion_shortcode::insert_shortcode_term();
}

// run on plugin deactivation
function deactivation(){
    //ucf_college_accordion_shortcode::delete_shortcode_term();
}

// run on plugin complete uninstall
function uninstall(){
    //ucf_college_accordion_shortcode::delete_shortcode_term();
}



