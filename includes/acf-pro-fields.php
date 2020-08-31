<?php

/**
 * Created by PhpStorm.
 * User: stephen
 * Date: 2019-02-01
 * Time: 1:47 PM
 */
class ucf_college_accordion_acf_pro_fields {

    const shortcode = 'ucf_college_accordion';
    
    function __construct() {
        add_action('acf/init', array('ucf_college_accordion_acf_pro_fields','create_fields'));
    }

    static function create_fields() {
	    // check function exists
	    if( function_exists('acf_register_block') ) {
		    // register a testimonial block
		    acf_register_block(array(
			                       'name'				=> 'ucf_college_accordion',
			                       'title'				=> __('Accordion'),
			                       'description'		=> __('Accordion. Collapsible sections with headers'),
			                       'render_callback'	=> array('ucf_college_accordion_shortcode','replacement_print'),
			                       'category'			=> 'layout',
			                       'icon'				=> 'align-wide',
			                       'keywords'			=> array( 'ucf', 'accordion','section','college' ),
		                       ));
	    }

        if ( function_exists( 'acf_add_local_field_group' ) ) {
            acf_add_local_field_group(
                array(
                    'key'                   => 'group_5c54a4e6e3503',
                    'title'                 => 'Accordion',
                    'fields'                => array(

                        array(
                            'key'               => 'field_5c54a5ff7d570',
                            'label'             => 'Accordion item',
                            'name'              => 'accordion_item',
                            'type'              => 'repeater',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'collapsed'         => '',
                            'min'               => 1,
                            'max'               => 0,
                            'layout'            => 'row',
                            'button_label'      => '',
                            'sub_fields'        => array(
                                array(
                                    'key'               => 'field_5c54a6147d571',
                                    'label'             => 'Header',
                                    'name'              => 'header',
                                    'type'              => 'text',
                                    'instructions'      => '',
                                    'required'          => 1,
                                    'conditional_logic' => 0,
                                    'wrapper'           => array(
                                        'width' => '',
                                        'class' => '',
                                        'id'    => '',
                                    ),
                                    'default_value'     => '',
                                    'placeholder'       => '',
                                    'prepend'           => '',
                                    'append'            => '',
                                    'maxlength'         => '',
                                ),
                                array(
                                    'key'               => 'field_5c54a6187d572',
                                    'label'             => 'Text',
                                    'name'              => 'text',
                                    'type'              => 'wysiwyg',
                                    'instructions'      => '',
                                    'required'          => 1,
                                    'conditional_logic' => 0,
                                    'wrapper'           => array(
                                        'width' => '',
                                        'class' => '',
                                        'id'    => '',
                                    ),
                                    'default_value'     => '',
                                    'placeholder'       => '',
                                    'prepend'           => '',
                                    'append'            => '',
                                    'maxlength'         => '',
                                ),
                            ),
                        ),

                    ),
                    'location'              => array(
	                    array(
		                    array(
			                    'param'    => 'block',
			                    'operator' => '==',
			                    'value'    => 'acf/ucf-college-accordion',
		                    ),
	                    ),
                        array(
                            array(
                                'param'    => 'post_taxonomy',
                                'operator' => '==',
                                'value'    => 'ucf_college_shortcode_category:' . self::shortcode,
                            ),
                        ),
                    ),
                    'menu_order'            => 0,
                    'position'              => 'normal',
                    'style'                 => 'default',
                    'label_placement'       => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen'        => '',
                    'active'                => 1,
                    'description'           => '',
                ) );

        }

        // old accordion fields. backwards compatibility.
	    // even though these don't actually show up, the definition MUST exist
	    // in order for ACF to know about them and ask the database for the data.
	    // Even if the data exists in the DB, ACF will return null and not query the DB
	    // if you ask ACF to get a field or check for rows of a field that you haven't
	    // defined somewhere in code (even though that data does actually exist in the DB).
	    acf_add_local_field_group(
		    array(
			    'key'                   => 'ucf_accordion',
			    'title'                 => 'Accordion',
			    'fields'                => array(
				    array(
					    'key'        => 'field_accordion_repeater',
					    'label'      => 'Accordion Repeater',
					    'name'       => 'accordion_repeater',
					    'type'       => 'repeater',
					    'collapsed'  => 'field_accordion_title',
					    'min'        => 1,
					    'layout'     => 'block',
					    'sub_fields' => array(
						    array(
							    'key'   => 'field_accordion_title',
							    'label' => 'Title',
							    'name'  => 'title',
							    'type'  => 'text',
						    ),
						    array(
							    'key'           => 'field_accordion_description',
							    'label'         => 'Description Paragraph',
							    'name'          => 'description_paragraph',
							    'type'          => 'wysiwyg',
						    ),
						    array(
							    'key'   => 'field_accordion_url',
							    'label' => 'URL',
							    'name'  => 'post_id',
							    'type'  => 'url',
							    'required' => 0,
							    'post_type' => array (
								    0 => 'page',
							    ),
							    'allow_null' => 1,
							    'allow_archives' => 0,
						    ),
						    array(
							    'key'   => 'field_accordion_url_title',
							    'label' => 'URL Title',
							    'name'  => 'post_manual_title',
							    'type'  => 'text',
						    ),
					    ),
				    ),
			    ),
			    'location'              => array(
				    array(
					    array(
						    'param'    => 'post_taxonomy',
						    'operator' => '==',
						    'value'    => 'page_shortcode_taxonomy:ucf_college_accordion_deprecated',
					    ),
				    ),
			    ),
			    'menu_order'            => 0,
			    'position'              => 'normal',
			    'style'                 => 'default',
			    'label_placement'       => 'top',
			    'instruction_placement' => 'label',
			    'active'                => 1,
		    )
	    );
    }
}

new ucf_college_accordion_acf_pro_fields();