<?php

namespace ucf_college_shortcode_taxonomy;
//------------------------------------------------------------Custom taxonomies

//add_action( 'init', __NAMESPACE__ . '\\create_taxonomy' );

const taxonomy_slug        = 'ucf_college_shortcode_category';
const taxonomy_name        = 'UCF College Shortcodes';
const taxonomy_name_single = 'UCF College Shortcode';


if (!function_exists(__NAMESPACE__ . '\\create_taxonomy')) {
	function create_taxonomy($shortcode_slug) {
		/**
		 * The UCF Shortcodes taxonomy is solely used to dynamically show/hide ACF fields on the page.
		 * This allows you to add a shortcode that requires extra fields without having to manually
		 * add that page to the ACF conditional statement. Fields will show up on the page as soon
		 * as the checkbox is checked for the various shortcode the user wants.
		 */
		$labels = array(
			'name'          => _x( taxonomy_name, 'taxonomy general name' ),
			'singular_name' => _x( taxonomy_name_single, 'taxonomy singular name' ),
			'all_items'     => __( 'All ' . taxonomy_name ),
			'edit_item'     => __( 'Edit ' . taxonomy_name_single ),
			'update_item'   => __( 'Update ' . taxonomy_name_single ),
			'add_new_item'  => __( 'Add New ' . taxonomy_name_single ),
			'new_item_name' => __( 'New ' . taxonomy_name_single ),
			'menu_name'     => __( taxonomy_name )
		);

		if ( ! ( taxonomy_exists( taxonomy_slug ) ) ) {



			//global $post;
			//$postID = $_GET["post"];
			//$postID = url_to_postid( "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
			//var_dump($postID);

			//if ( has_shortcode( get_post($postID)->post_content, $shortcode_slug ) ) {
			//if (has_shortcode($post->post_content, $shortcode_slug)) {
				// for pages that have the shortcode already, go ahead and show the taxonomy checkboxes that let you show and hide the deprecated shortcode details

				register_taxonomy(
					taxonomy_slug,
					array( // @TODO add to all existing post types, and have site setting to (en/dis)able for specific
					       'page',
					       'person',
					       'post'
					),
					array(
						'hierarchical' => true,
						'labels'       => $labels,
						'query_var'    => false,
						// don't allow url queries for this shortcode
						'manage_terms' => false,
						'show_in_rest' => true,	// show in side menu. this taxonomy is deprecated and should not be visible, unless the pages already have the taxonomy (so they can remove it as needed)
					)
				);
			//}
		}
	}
}