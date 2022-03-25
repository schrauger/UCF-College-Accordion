<?php

namespace ucf_college_accordion\block;

const shortcode_slug = 'ucf_college_accordion'; // the shortcode text entered by the user (inside square brackets)


/**
 * Adds the shortcode to wordpress' index of shortcodes
 */
function add_shortcode() {
	if ( ! ( shortcode_exists( shortcode_slug ) ) ) {
		\add_shortcode( shortcode_slug, __NAMESPACE__ . '\\replacement' );
	}
}
add_action( 'init', __NAMESPACE__ . '\\add_shortcode' );

/**
 * Returns the replacement html that WordPress uses in place of the block
 *
 * @return string
 */
function replacement() {
	$replacement_data = ''; //string of html to return
	if ( have_rows( 'accordion_item' ) ) {
		$inner_divs = '';
		while ( have_rows( 'accordion_item' ) ) {
			the_row();
			$header           = get_sub_field( 'header' );
			$data             = get_sub_field( 'text' );
			$inner_divs .= "
                <div class='accordion-title'>{$header}<i class=\"fa fa-angle-down\"></i></div>
                <div class='accordion-panel collapse'>{$data}<InnerBlocks /></div>
            ";
		}

		$replacement_data .= "
			<div class='container accordion-container'>
				{$inner_divs}
			</div>
		";
	} elseif ( have_rows( 'accordion_repeater' ) ) {
		// new shortcode is using old shortcode fields. this shouldn't happen, but still we should support bad migrations or people who manually changed the shortcode name
		return replacement_deprecated();
	}

	return $replacement_data;
}

/**
 * Replacement for deprecated (migrated) accordions. They had an extra feature to add a link button at the bottom of
 * each accordion content section.
 * @return string
 */
function replacement_deprecated() {
	$replacement_data = ''; //string of html to return
	if ( have_rows( 'accordion_repeater' ) ) {

		$inner_divs = '';

		while ( have_rows( 'accordion_repeater' ) ) {
			the_row();
			if ( get_sub_field( 'post_manual_title' ) ) {
				$link_title = get_sub_field( 'post_manual_title' );
			} else {
				$link_title = get_the_title( get_sub_field( 'post_id' ) );
			}

			$header = get_sub_field( 'title' );
			$data   = get_sub_field( 'description_paragraph' );

			$inner_link = '';
			// old accordions had this button option
			if ( get_sub_field( 'post_id' ) ) {
				$inner_link = "<a class='button' href='" . get_permalink( get_sub_field( 'post_id' ) ) . "'>{$link_title}</a >";
			}

			$inner_divs .= "
	            <div class='accordion-title'>{$header}<i class=\"fa fa-angle-down\"></i></div>
	            <div class='accordion-panel collapse'><p>{$data}</p>{$inner_link}</div>
            "; // old accordions wrapped the data in a paragraph tag


		}
		$replacement_data .= "
			<div class='container accordion-container'>
				{$inner_divs}
			</div>
		";
	}

	return $replacement_data;
}

function replacement_print() {
	echo replacement();
}