<?php
/**
 *  Adds general customizer settings
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$customizer = array(
    'description'   => __('Customizer settings for the Waterfall theme', 'waterfall'),
    'id'            => 'waterfall_customizer',
    'title'         => __('Waterfall', 'waterfall'),
    'sections'      => array(
        array(
            'id'            => 'static_front_page',
            'title'         => __('General', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => 'default',
                    'id'            => 'layout',
                    'title'         => __('Layout', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'default' => __('Default Layout', 'waterfall'),
                        'boxed'   => __('Boxed Layout', 'waterfall'),
                    )    
                ),
                array(
                    'selector'      => array('selector' => '.components-container, .elementor-section.elementor-section-boxed > .elementor-container', 'property' => 'max-width'),
                    'default'       => '',
                    'id'            => 'layout_width',
                    'title'         => __('Maximum Width of Content', 'waterfall'),
                    'description'   => __('Adapts the maximum width of content containers. Also overwrites the content width for elementor.', 'waterfall'),
                    'type'          => 'dimension'  
                ), 
                array(
                    'selector'           => array(
                        'selector' => '.atom-button, input[type=\'submit\'], input[type=\'submit\'].button, .elementor-button, .woocommerce input.button.alt, input.button, .woocommerce button.button, .woocommerce a.button', 
                        'property' => 'border-radius'
                    ),
                    'default'       => '',
                    'id'            => 'border_radius',
                    'title'         => __('Border radius for buttons', 'waterfall'),
                    'description'   => __('Adapts the border radius for all buttons on the site.', 'waterfall'),
                    'type'          => 'dimension'  
                ),                               
                array(
                    'default'       => '',
                    'id'            => 'lightbox',
                    'title'         => __('Enable Lightbox for Linked Images', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'lazyload',
                    'title'         => __('Lazyload Featured Images, Improving Performance', 'waterfall'),
                    'type'          => 'checkbox'
                )                  
            )              
        ),        
        array(
            'id'            => 'title_tagline',
            'priority'      => 2,
            'title'         => __('Site Identity', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => '',
                    'id'            => 'logo',
                    'title'         => __('Logo Image', 'waterfall'),
                    'type'          => 'media',
                ),
                array(
                    'default'       => '',
                    'id'            => 'logo_transparent',
                    'title'         => __('Transparent Logo Image', 'waterfall'),
                    'description'   => __('This logo is used if you have set up a transparent header.', 'waterfall'),
                    'type'          => 'media',
                ),
                array(
                    'default'       => '',
                    'id'            => 'logo_mobile',
                    'title'         => __('Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents', 'waterfall'),
                    'type'          => 'media',
                ), 
                array(
                    'default'       => '',
                    'id'            => 'logo_mobile_transparent',
                    'title'         => __('Transparent Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents and if you have a transparent header set up.', 'waterfall'),
                    'type'          => 'media',
                ),
                array(
                    'description'   => __('Choose a logo for use in the socket, preferably with height of 50px.', 'waterfall'),
                    'default'       => '',
                    'id'            => 'footer_logo',
                    'title'         => __('Footer Logo Image', 'waterfall'),
                    'type'          => 'media',
                )    
            )              
        ),
        array(
            'id'            => 'background_image',
            'title'         => __('Background', 'waterfall'),
            'fields'    => array(                   
                array(
                    'selector'           => array('selector' => 'body', 'property' => 'background-color'),
                    'default'       => '',
                    'id'            => 'background_color',
                    'title'         => __('Background Color', 'waterfall'),
                    'type'          => 'colorpicker',
                    'transport'     => 'postMessage'
                )                  
            )              
        ), 
        array(
            'id'            => 'waterfall_social',
            'title'         => __('Social Media', 'waterfall'),
            'description'   => __('Enter your Social Media channels, so they can appear in the website.', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => '',
                    'id'            => 'email',
                    'title'         => __('Email Address', 'waterfall'),
                    'type'          => 'email',
                ),
                array(
                    'default'       => '',
                    'id'            => 'telephone',
                    'title'         => __('Telephone Number', 'waterfall'),
                    'type'          => 'tel',
                ),      
                array(
                    'default'       => '',
                    'id'            => 'facebook',
                    'title'         => __('Facebook Profile Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'instagram',
                    'title'         => __('Instagram Profile Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'twitter',
                    'title'         => __('Twitter Profile Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'linkedin',
                    'title'         => __('LinkedIn Profile Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'google-plus',
                    'title'         => __('Google Plus Url', 'waterfall'),
                    'type'          => 'url',
                ), 
                array(
                    'default'       => '',
                    'id'            => 'youtube',
                    'title'         => __('Youtube Channel Url', 'waterfall'),
                    'type'          => 'url',
                ),                                
                array(
                    'default'       => '',
                    'id'            => 'pinterest',
                    'title'         => __('Pinterest Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'reddit',
                    'title'         => __('Reddit Url', 'waterfall'),
                    'type'          => 'url',
                ),                
                array(
                    'default'       => '',
                    'id'            => 'whatsapp',
                    'title'         => __('Whatsapp Number', 'waterfall'),
                    'type'          => 'tel',
                )               
            )              
        ),         
    )
);  