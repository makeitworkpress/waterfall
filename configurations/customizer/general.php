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
                ]                                                                                         
            ]              
        ],        
        'title_tagline' => [
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
                ],
                [
                    'default'       => '',
                    'id'            => 'footer_logo_url',
                    'title'         => __('Custom Footer Logo Link', 'waterfall'),
                    'description'   => __('Enter a custom link for the footer logo here. Defaults to the current site URL.', 'waterfall'),
                    'type'          => 'url',
                ]                                                
            ]              
        ],
        'background_image' => [
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
        'waterfall_social' => [
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
 * Additional Fields if the Events Calendar is active
 */
if( class_exists('Tribe__Events__Main') ) {

    $choices = [];
    $pages = get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'fields' => 'ids']);

    if( is_array($pages) ) {

        foreach( $pages as $page ) {
            $choices[$page] = get_the_title($page);
        }

        array_unshift( 
            $customizer['sections']['static_front_page']['fields'], 
            [
                'default'       => '',
                'id'            => 'tribe_events_page',
                'title'         => __('Events Page', 'waterfall'),
                'description'   => __('Changes the Tribe Events page for a custom events page.', 'waterfall'),
                'type'          => 'select',
                'choices'       => $choices             
            ]
        );
    }
}