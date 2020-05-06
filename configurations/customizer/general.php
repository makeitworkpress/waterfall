<?php
/**
 *  Adds general customizer settings
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$customizer = [
    'description'   => __('Customizer settings for the Waterfall theme', 'waterfall'),
    'id'            => 'waterfall_customizer',
    'title'         => __('Waterfall', 'waterfall'),
    'sections'      => [
        'static_front_page' => [
            'id'            => 'static_front_page',
            'title'         => __('General', 'waterfall'),
            'fields'    => [ 
                [
                    'id'            => 'excerpt_length',
                    'title'         => __('Excerpt Length', 'waterfall'),
                    'description'   => __('The maximum number of words for excerpts in post archives.', 'waterfall'),
                    'type'          => 'number'  
                ],                                              
                [
                    'default'       => '',
                    'id'            => 'lightbox',
                    'title'         => __('Enable Lightbox for Linked Images', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => 'general_layout_heading',
                    'title'         => __('Global Layout Settings', 'waterfall'),
                    'type'          => 'heading'          
                ],                                                   
                [
                    'default'       => 'default',
                    'id'            => 'layout',
                    'title'         => __('Layout', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => [
                        'default' => __('Default Layout', 'waterfall'),
                        'boxed'   => __('Boxed Layout', 'waterfall'),
                    ]    
                ],
                [
                    'selector'      => ['selector' => '.components-container, .elementor-section.elementor-section-boxed > .elementor-container', 'property' => 'max-width'],
                    'default'       => '',
                    'id'            => 'layout_width',
                    'title'         => __('Maximum Width of Content', 'waterfall'),
                    'description'   => __('Adapts the maximum width of content containers. Also overwrites the content width for Elementor.', 'waterfall'),
                    'type'          => 'dimension'  
                ], 
                [
                    'selector'      => ['selector' => '.waterfall-boxed-layout .header, .waterfall-boxed-layout .main, .waterfall-boxed-layout .footer', 'property' => 'max-width'],
                    'default'       => '',
                    'id'            => 'layout_boxed_width',
                    'title'         => __('Maximum Width of Boxed Layout', 'waterfall'),
                    'description'   => __('Adapts the maximum width of the boxed layout.', 'waterfall'),
                    'type'          => 'dimension'  
                ],                 
                [
                    'selector'     => [
                        'selector' => '.atom-button, input[type=\'submit\'], input[type=\'submit\'].button, input[type=\'reset\'], input[type=\'button\'], button, .elementor-element .elementor-button, .woocommerce input.button.alt, input.button, .woocommerce button.button, .woocommerce a.button, .wp-block-file .wp-block-file__button, .wp-block-button__link, .elementor-field-type-submit button', 
                        'property' => 'border-radius'
                    ],
                    'default'       => '',
                    'id'            => 'border_radius',
                    'title'         => __('Border radius for buttons', 'waterfall'),
                    'description'   => __('Adapts the border radius for all buttons on the site.', 'waterfall'),
                    'type'          => 'dimension'  
                ]                
            ]              
        ],        
        [
            'id'            => 'title_tagline',
            'priority'      => 2,
            'title'         => __('Identity', 'waterfall'),
            'fields'        => [
                [
                    'default'       => '',
                    'id'            => 'logo_transparent',
                    'title'         => __('Transparent Logo Image', 'waterfall'),
                    'description'   => __('This logo is used if you have set up a transparent header.', 'waterfall'),
                    'type'          => 'media',
                ],
                [
                    'default'       => '',
                    'id'            => 'logo_mobile',
                    'title'         => __('Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents', 'waterfall'),
                    'type'          => 'media',
                ], 
                [
                    'default'       => '',
                    'id'            => 'logo_mobile_transparent',
                    'title'         => __('Transparent Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents and if you have a transparent header set up.', 'waterfall'),
                    'type'          => 'media',
                ],
                [
                    'description'   => __('Choose a logo for use in the socket, preferably with height of 50px.', 'waterfall'),
                    'default'       => '',
                    'id'            => 'footer_logo',
                    'title'         => __('Footer Logo Image', 'waterfall'),
                    'type'          => 'media',
                ]    
            ]              
        ],
        [
            'id'            => 'background_image',
            'title'         => __('Background', 'waterfall'),
            'fields'    => [                   
                [
                    'selector'      => ['selector' => 'body', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'background_color',
                    'title'         => __('Background Color', 'waterfall'),
                    'type'          => 'colorpicker',
                    'transport'     => 'postMessage'
                ]                  
            ]              
        ], 
        [
            'id'            => 'waterfall_social',
            'title'         => __('Social Media', 'waterfall'),
            'description'   => __('Enter your Social Media channels, so they can appear in the website.', 'waterfall'),
            'fields'        => [                  
                [
                    'default'       => '',
                    'id'            => 'email',
                    'title'         => __('Email Address', 'waterfall'),
                    'type'          => 'email',
                ],
                [
                    'default'       => '',
                    'id'            => 'telephone',
                    'title'         => __('Telephone Number', 'waterfall'),
                    'type'          => 'tel',
                ],      
                [
                    'default'       => '',
                    'id'            => 'facebook',
                    'title'         => __('Facebook Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'instagram',
                    'title'         => __('Instagram Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'twitter',
                    'title'         => __('Twitter Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'linkedin',
                    'title'         => __('LinkedIn Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'youtube',
                    'title'         => __('Youtube Channel Url', 'waterfall'),
                    'type'          => 'url',
                ],                                
                [
                    'default'       => '',
                    'id'            => 'pinterest',
                    'title'         => __('Pinterest Url', 'waterfall'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'reddit',
                    'title'         => __('Reddit Url', 'waterfall'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'github',
                    'title'         => __('Github Url', 'waterfall'),
                    'type'          => 'url',
                ],                
                [
                    'default'       => '',
                    'id'            => 'behance',
                    'title'         => __('Behance Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],
                [
                    'default'       => '',
                    'id'            => 'dribbble',
                    'title'         => __('Dribble Profile Url', 'waterfall'),
                    'type'          => 'url',
                ],                                                  
                [
                    'default'       => '',
                    'id'            => 'whatsapp',
                    'title'         => __('Whatsapp Number', 'waterfall'),
                    'type'          => 'tel',
                ]              
            ]              
        ]         
    ]
];  

/**
 * Additional fields if the Elementor plugin is active
 */
if( did_action('elementor/loaded') ) {
    $customizer['sections']['static_front_page']['fields'][] = [
        'selector'      => ['selector' => '.elementor-section-wrap > .elementor-section', 'property' => 'padding-top'],
        'default'       => '',
        'id'            => 'layout_elementor_padding_top',
        'title'         => __('Elementor Section Top Padding', 'waterfall'),
        'description'   => __('The default top padding for primary elementor sections.', 'waterfall'),
        'type'          => 'dimension'  
    ];
    $customizer['sections']['static_front_page']['fields'][] = [
        'selector'      => ['selector' => '.elementor-section-wrap > .elementor-section', 'property' => 'padding-bottom'],
        'default'       => '',
        'id'            => 'layout_elementor_padding_bottom',
        'title'         => __('Elementor Section Bottom Padding', 'waterfall'),
        'description'   => __('The default bottom padding for primary elementor sections.', 'waterfall'),
        'type'          => 'dimension'  
    ];    
}