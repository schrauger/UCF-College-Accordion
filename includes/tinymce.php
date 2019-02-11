<?php
/**
 * Created by PhpStorm.
 * User: stephen
 * Date: 2019-02-01
 * Time: 4:01 PM
 */
if (!class_exists('ucf_college_tinymce')) {
    class  ucf_college_tinymce {
        function __construct() {
            add_filter( 'mce_external_plugins', array( $this, 'plugin' ) );
            add_filter( 'mce_buttons', array( $this, 'button' ) );
        }

        function plugin( $plugin_array ) {
            /**
             * Include plugin.js in the tinymce way (which doesn't use wp_register_script but rather uses its own function)
             */
            $plugin_array[ 'ucf_college_shortcodes_key' ] = plugin_dir_url( __FILE__ ) . 'tinymce.js'; // include the javascript for the button, located inside the current plugin folder
            return $plugin_array;
        }

        function button( $buttons ) {
            array_push( $buttons, 'separator', 'ucf_college_shortcodes_key' );

            return $buttons;
        }
    }

    new ucf_college_tinymce();
}