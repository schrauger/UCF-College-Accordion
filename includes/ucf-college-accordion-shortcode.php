<?php

class ucf_college_accordion_shortcode {
    const shortcode_slug = 'ucf_college_accordion'; // the shortcode text entered by the user (inside square brackets)
    const shortcode_name = 'Accordion';
    const shortcode_description = 'Collapsible sections with headers';
    //const get_param_group = 'people_group'; // group or category person is in

    function __construct() {
        add_action( 'init', array( $this, 'add_shortcode' ) );
        add_filter( 'query_vars', array($this, 'add_query_vars_filter' )); // tell wordpress about new url parameters
    }

    /**
     * Adds the shortcode to wordpress' index of shortcodes
     */
    function add_shortcode() {
        if ( ! ( shortcode_exists( self::shortcode_slug ) ) ) {
            add_shortcode( self::shortcode_slug, array($this, 'replacement' ));
        }
    }

    /**
     * Tells wordpress to listen for the 'people_group' parameter in the url. Used to filter down to specific profiles.
     * @param $vars
     *
     * @return array
     */
    function add_query_vars_filter($vars){
        //$vars[] = self::get_param_group;
        return $vars;
    }

    /**
     * Returns the replacement html that WordPress uses in place of the shortcode
     *
     * @return string
     */
    function replacement(  ){
        $replacement_data = ''; //string of html to return
        if (have_rows('accordion_item')){
            $replacement_data .= "<div class='container accordion-container'>";

            while (have_rows('accordion_item')){
                the_row();
                $header = get_sub_field('header');
                $data = get_sub_field('text');
                $replacement_data .= "
                    <div class='accordion'>
                        <div class='accordion-title'>{$header}</div>
                        <div class='collapse'>{$data}</div>
                    </div>            
                ";
            }

            $replacement_data .= "</div>";
        }

        return $replacement_data;
    }

    /**
     * Only run this on plugin activation, as it's stored in the database
     */
    static function insert_shortcode_term(){
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
    }

    /**
     * Run when plugin is disabled and/or uninstalled. This removes the shortcode from the list of shortcodes in the taxonomy.
     */
    static function delete_shortcode_term(){
        $taxonomy = new ucf_college_shortcode_taxonomy;
        $taxonomy->create_taxonomy();
        wp_delete_term(get_term_by('slug', self::shortcode_slug)->term_id, ucf_college_shortcode_taxonomy::taxonomy_slug);
    }




}

new ucf_college_accordion_shortcode();
