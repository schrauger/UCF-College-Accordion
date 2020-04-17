<?php

class ucf_college_accordion_shortcode {
    const shortcode_slug                      = 'ucf_college_accordion'; // the shortcode text entered by the user (inside square brackets)
	const backwards_compatibility_shortcode_slug = 'ucf_college_accordion_deprecated'; // all [accordion] shortcodes were migrated to this shortcode and should eventually be replaced with the new accordion and block
	const shortcode_name                      = 'Accordion (deprecated - use blocks)'; // this plugin isn't deprecated, as it provides both the block and the shortcode. this is text to let the user know we have blocks.
    const shortcode_description               = 'Collapsible sections with headers';

    /**
     * Adds the shortcode to wordpress' index of shortcodes
     */
    static function add_shortcode() {
	    if ( ! ( shortcode_exists( self::shortcode_slug ) ) ) {
		    add_shortcode( self::shortcode_slug, array('ucf_college_accordion_shortcode', 'replacement' ));
	    }
	    if ( ! ( shortcode_exists( self::backwards_compatibility_shortcode_slug ) ) ) {
		    add_shortcode( self::backwards_compatibility_shortcode_slug, array('ucf_college_accordion_shortcode', 'replacement_deprecated' ));
	    }
    }

    /**
     * Adds the shortcode to the ckeditor dropdown menu
     */
    static function add_ckeditor_shortcode($shortcode_array){
        $shortcode_array[] = array(
            'slug' => self::shortcode_slug,
            'name' => self::shortcode_name,
            'description' => self::shortcode_description
        );
        return $shortcode_array;
    }

    /**
     * Tells wordpress to listen for the 'people_group' parameter in the url. Used to filter down to specific profiles.
     * @param $vars
     *
     * @return array
     */
    static function add_query_vars_filter($vars){
        //$vars[] = self::get_param_group;
        return $vars;
    }

    /**
     * Returns the replacement html that WordPress uses in place of the shortcode
     *
     * @return string
     */
    static function replacement(  ){
        $replacement_data = ''; //string of html to return
        if (have_rows('accordion_item')){
            $replacement_data .= "<div class='container accordion-container'>";

            while (have_rows('accordion_item')){
                the_row();
                $header = get_sub_field('header');
                $data = get_sub_field('text');
                $replacement_data .= "
                    <div class='accordion-title'>{$header}<i class=\"fa fa-angle-down\"></i>

</div>
                    <div class='accordion-panel collapse'>{$data}</div>
                ";
            }

            $replacement_data .= "</div>";
        } elseif (have_rows('accordion_repeater')){
        	// new shortcode is using old shortcode fields. this shouldn't happen, but still we should support bad migrations or people who manually changed the shortcode name
	        return self::replacement_deprecated();
        }

        return $replacement_data;
    }

	/**
	 * Replacement for deprecated (migrated) accordions. They had an extra feature to add a link button at the bottom of each accordion content section.
	 * @return string
	 */
    static function replacement_deprecated() {
	    $replacement_data = ''; //string of html to return
	    if (have_rows('accordion_repeater')){



		    $replacement_data .= "<div class='container accordion-container'>";

		    while (have_rows('accordion_repeater')){
			    the_row();
			    if (get_sub_field('post_manual_title')){
				    $link_title = get_sub_field( 'post_manual_title' );
			    } else {
				    $link_title = get_the_title(get_sub_field( 'post_id' ));
			    }

			    $header = get_sub_field('title');
			    $data = get_sub_field('description_paragraph');

			    $replacement_data .= "
                    <div class='accordion-title'>{$header}<i class=\"fa fa-angle-down\"></i>

</div>
                    <div class='accordion-panel collapse'><p>{$data}</p>"; // old accordions wrapped the data in a paragraph tag

			    // old accordions had this button option
			    if (get_sub_field( 'post_id' )) {
				    $replacement_data .= "<a class='button' href='" . get_permalink(get_sub_field( 'post_id' )) . "'>{$link_title}</a >";
			    }

			    $replacement_data .= "</div>";

		    }

		    $replacement_data .= "</div>";
	    }

	    return $replacement_data;
    }

	static function replacement_print() {
		echo self::replacement();
	}

    /**
     * Only run this on plugin activation, as it's stored in the database
     */
    /*static function insert_shortcode_term(){
        $taxonomy = new ucf_college_shortcode_taxonomy;
        $taxonomy->create_taxonomy();
        wp_insert_term(
            self::shortcode_name,
            ucf_college_shortcode_taxonomy::taxonomy_slug,
            array(
                'description' => self::shortcode_description,
                'slug' => self::shortcode_slug
            )
        );
    }*/

    /**
     * Run when plugin is disabled and/or uninstalled. This removes the shortcode from the list of shortcodes in the taxonomy.
     */
    /*static function delete_shortcode_term(){
        $taxonomy = new ucf_college_shortcode_taxonomy;
        $taxonomy->create_taxonomy();
        wp_delete_term(get_term_by('slug', self::shortcode_slug)->term_id, ucf_college_shortcode_taxonomy::taxonomy_slug);
    }*/

}

add_action( 'init', array( 'ucf_college_accordion_shortcode', 'add_shortcode' ) );
add_filter( 'query_vars', array( 'ucf_college_accordion_shortcode', 'add_query_vars_filter' ) ); // tell wordpress about new url parameters
//add_filter( 'ucf_college_shortcode_menu_item', array( 'ucf_college_accordion_shortcode', 'add_ckeditor_shortcode' ) );


//new ucf_college_accordion_shortcode();
