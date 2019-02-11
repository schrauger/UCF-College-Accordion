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
        if ( function_exists( 'acf_add_local_field_group' ) ) {
            acf_add_local_field_group(
                array(
                    'key'                   => 'group_5c54a4e6e3503',
                    'title'                 => 'Accordion',
                    'fields'                => array(
                        array(
                            'key'               => 'field_5c54a58f7d56e',
                            'label'             => 'Accordion start',
                            'name'              => '',
                            'type'              => 'accordion',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'open'              => 1,
                            'multi_expand'      => 0,
                            'endpoint'          => 0,
                        ),
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
                            'layout'            => 'table',
                            'button_label'      => '',
                            'sub_fields'        => array(
                                array(
                                    'key'               => 'field_5c54a6147d571',
                                    'label'             => 'Header',
                                    'name'              => 'header',
                                    'type'              => 'text',
                                    'instructions'      => '',
                                    'required'          => 0,
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
                                    'type'              => 'text',
                                    'instructions'      => '',
                                    'required'          => 0,
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
                        array(
                            'key'               => 'field_5c54a6217d573',
                            'label'             => 'Accordion end',
                            'name'              => '',
                            'type'              => 'accordion',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'open'              => 0,
                            'multi_expand'      => 0,
                            'endpoint'          => 1,
                        ),
                    ),
                    'location'              => array(
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
    }
}

new ucf_college_accordion_acf_pro_fields();