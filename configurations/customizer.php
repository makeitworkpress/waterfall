<?php
/**
 * Loads our customizer configurations
 */

// Adds general settings
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
                    'type'          => 'image',
                ),
                array(
                    'default'       => '',
                    'id'            => 'logo_mobile',
                    'title'         => __('Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents', 'waterfall'),
                    'type'          => 'image',
                ), 
                array(
                    'default'       => '',
                    'id'            => 'logo_mobile_transparent',
                    'title'         => __('Transparent Mobile Logo Image', 'waterfall'),
                    'description'   => __('This logo is loaded by mobile agents and if you have a transparent header set up.', 'waterfall'),
                    'type'          => 'image',
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
                    'css'           => array('selector' => 'body', 'property' => 'background-color'),
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

// Adds color panels
$colors = array(
    'description'   => __('Adjust the colors of all of the theme sections.', 'waterfall'),
    'id'            => 'waterfall_colors',
    'title'         => __('Theme Colors', 'waterfall'),
    'panel'         => true,
    'priority'      => 10,
    'sections'      => array(
       array(
            'id'            => 'colors_general',
            'title'         => __('General Colors', 'waterfall'),
            'fields'    => array(        
                array(
                    'default'       => '',
                    'css'           => 'body',
                    'id'            => 'body_typography_color',
                    'title'         => __('General Font Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'a',
                    'id'            => 'body_link_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'a:hover',
                    'id'            => 'body_link_hover_color',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'default'       => '',
                    'css'           => 'blockquote',
                    'id'            => 'blockquote_typography_color',
                    'title'         => __('Blockquotes Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
            )
       ),
       array(
            'id'            => 'colors_header',
            'title'         => __('Header Colors', 'waterfall'),
            'fields'    => array(
                array(
                    'css'           => array( 'selector' => '.header', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'header_background',
                    'title'         => __('Header Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.header',
                    'default'       => '',
                    'id'            => 'header_background_image',
                    'title'         => __('Header Background Image', 'waterfall'),
                    'type'          => 'image'
                ),
                array(
                    'css'           => array( 'selector' => '.header .menu', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'navigation_background',
                    'title'         => __('Menu Background Color', 'waterfall'),
                    'description'   => __('This color also applies to the default mobile menu.', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'css'           => '.header .menu > li > a, .atom-search-expand',
                    'default'       => '',
                    'id'            => 'navigation_link_color',
                    'title'         => __('Navigation Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => '.header .menu > li > a:hover, .atom-search-expand:hover',
                    'default'       => '',
                    'id'            => 'navigation_link_hover_color',
                    'title'         => __('Navigation Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => array( 
                        'selector' => '.header .menu > li > a:hover', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'navigation_link_hover_background',
                    'title'         => __('Navigation Link Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.header .menu > li.current-menu-item > a, .header .menu > li.current-menu-ancestor > a',
                    'default'       => '',
                    'id'            => 'navigation_link_active_color',
                    'title'         => __('Navigation Link Active Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                 
                array(
                    'css'           => array( 
                        'selector' => '.header .menu > li.current-menu-item > a, .header .menu > li.current-menu-ancestor > a', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'navigation_link_active_background',
                    'title'         => __('Navigation Link Active Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'css'           => '.molecule-header-top.molecule-header-transparent .menu > li > a, .molecule-header-top.molecule-header-transparent .atom-search-expand',
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_color',
                    'title'         => __('Navigation Link Color Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.molecule-header-top.molecule-header-transparent .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .atom-search-expand:hover',
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_hover_color',
                    'title'         => __('Navigation Link Hover Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array(
                        'selector' => '.atom-menu-hamburger span',
                        'property' => 'background-color'
                    ),
                    'default'       => '',
                    'id'            => 'navigation_hamburger_normal_color',
                    'title'         => __('Hamburger Menu Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array(
                        'selector' => '.atom-menu-hamburger:hover span',
                        'property' => 'background-color'
                    ),
                    'default'       => '',
                    'id'            => 'navigation_hamburger_normal_hover_color',
                    'title'         => __('Hamburger Menu Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                     
                array(
                    'css'           => array(
                        'selector' => '.molecule-header-top.molecule-header-transparent .atom-menu-hamburger span',
                        'property' => 'background-color'
                    ),
                    'default'       => '',
                    'id'            => 'navigation_hamburger_transparent_color',
                    'title'         => __('Hamburger Menu Color Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array(
                        'selector' => '.molecule-header-top.molecule-header-transparent .atom-menu-hamburger:hover span',
                        'property' => 'background-color'
                    ),
                    'default'       => '',
                    'id'            => 'navigation_hamburger_transparent_hover_color',
                    'title'         => __('Hamburger Menu Hover Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
                array(
                    'css'           => array('selector' => '.header .sub-menu', 'property' => 'background-color'),
                    'default'       => '',
                    'id'            => 'navigation_submenu_background',
                    'title'         => __('Drop-down Menu Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.header .sub-menu a',
                    'default'       => '',
                    'id'            => 'navigation_submenu_color',
                    'title'         => __('Drop-down Menu Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => '.header .sub-menu a:hover',
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_color',
                    'title'         => __('Drop-down Menu Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array('selector' => '.header .sub-menu a:hover', 'property' => 'background-color'),
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_background',
                    'title'         => __('Drop-down Menu Link Hover Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                )
            )              
        ),   
        array(
            'id'            => 'colors_main_content',
            'title'         => __('Content Colors', 'waterfall'),
            'fields'    => array(                    
                array(
                    'css'           => array( 'selector' => '.main-header', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'title_section',
                    'title'         => __('Title Section Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6',
                    'default'       => '',
                    'id'            => 'title_section_title',
                    'title'         => __('Title Section Title Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-header',
                    'default'       => '',
                    'id'            => 'title_section_text',
                    'title'         => __('Title Section Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),     
                array(
                    'css'           => '.main-header a',
                    'default'       => '',
                    'id'            => 'title_section_link',
                    'title'         => __('Title Section Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-header a:hover',
                    'default'       => '',
                    'id'            => 'title_section_link_hover',
                    'title'         => __('Title Section Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
                array(
                    'css'           => '.main-header .entry-meta a, .main-header .entry-time',
                    'default'       => '',
                    'id'            => 'title_section_meta',
                    'title'         => __('Title Section Meta Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                     
                array(
                    'css'           => array( 'selector' => '.main-content', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'content_main',
                    'title'         => __('Main Content Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content h1, .main-content h2, .main-content h3, .main-content h4, .main-content h5, .main-content h6',
                    'default'       => '',
                    'id'            => 'content_main_title',
                    'title'         => __('Main Content Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content',
                    'default'       => '',
                    'id'            => 'content_main_text',
                    'title'         => __('Main Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),     
                array(
                    'css'           => '.main-content a',
                    'default'       => '',
                    'id'            => 'content_main_link',
                    'title'         => __('Main Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content a:hover',
                    'default'       => '',
                    'id'            => 'content_main_link_hover',
                    'title'         => __('Main Content Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content h1, .main-content h2, .main-content h3, .main-content h4, .main-content h5, .main-content h6',
                    'default'       => '',
                    'id'            => 'content_main_title',
                    'title'         => __('Main Content Title Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content',
                    'default'       => '',
                    'id'            => 'content_main_text',
                    'title'         => __('Main Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),     
                array(
                    'css'           => '.main-content a',
                    'default'       => '',
                    'id'            => 'content_main_link',
                    'title'         => __('Main Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-content a:hover',
                    'default'       => '',
                    'id'            => 'content_main_link_hover',
                    'title'         => __('Main Content Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-sidebar',
                    'default'       => '',
                    'id'            => 'content_sidebar_color',
                    'title'         => __('Main Sidebar Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-sidebar h1, .main-sidebar h2, .main-sidebar h3, .main-sidebar h4, .main-sidebar h5, .main-sidebar h6',
                    'default'       => '',
                    'id'            => 'content_sidebar_title_color',
                    'title'         => __('Main Sidebar Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'css'           => array( 'selector' => '.main-sidebar', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'content_sidebar_background',
                    'title'         => __('Main Sidebar Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'css'           => array( 'selector' => '.main-related', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'content_related',
                    'title'         => __('Related Content Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-related h1, .main-related h2, .main-related h3, .main-related h4, .main-related h5, .main-related h6',
                    'default'       => '',
                    'id'            => 'content_related_title',
                    'title'         => __('Related Content Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-related',
                    'default'       => '',
                    'id'            => 'content_related_text',
                    'title'         => __('Related Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),     
                array(
                    'css'           => '.main-related a',
                    'default'       => '',
                    'id'            => 'content_related_link',
                    'title'         => __('Related Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-related a:hover',
                    'default'       => '',
                    'id'            => 'content_related_link_hover',
                    'title'         => __('Related Content Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-related .molecule-post:not(.has-post-thumbnail) a',
                    'default'       => '',
                    'id'            => 'content_related_posts_link',
                    'title'         => __('Related Posts Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => '.main-related .molecule-post:not(.has-post-thumbnail) a:hover',
                    'default'       => '',
                    'id'            => 'content_related_posts_link_hover',
                    'title'         => __('Related Posts Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-related .has-post-thumbnail a',
                    'default'       => '',
                    'id'            => 'content_related_posts_featured_link',
                    'title'         => __('Related Posts Featured Image Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => '.main-related .has-post-thumbnail a:hover',
                    'default'       => '',
                    'id'            => 'content_related_posts_featured_link_hover',
                    'title'         => __('Related Posts Featured Image Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                   
                array(
                    'css'           => array( 'selector' => '.main-footer', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'content_footer',
                    'title'         => __('Content Footer Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                      
                array(
                    'css'           => '.main-footer h1, .main-footer h2, .main-footer h3, .main-footer h4, .main-footer h5, .main-footer h6',
                    'default'       => '',
                    'id'            => 'content_footer_title',
                    'title'         => __('Content Footer Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-footer',
                    'default'       => '',
                    'id'            => 'content_footer_text',
                    'title'         => __('Content Footer Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),     
                array(
                    'css'           => '.main-footer a',
                    'default'       => '',
                    'id'            => 'content_footer_link',
                    'title'         => __('Content Footer Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.main-footer a:hover',
                    'default'       => '',
                    'id'            => 'content_footer_link_hover',
                    'title'         => __('Content Footer Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
            )              
        ),   
        array(
            'id'            => 'colors_footer',
            'title'         => __('Footer Colors', 'waterfall'),
            'fields'    => array(                    
                array(
                    'css'           => array( 'selector' => '.molecule-footer-sidebars', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'footer_background',
                    'title'         => __('Footer Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_background_image',
                    'title'         => __('Footer Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ),
                array(
                    'css'           => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_text_color',
                    'title'         => __('Footer Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6',
                    'default'       => '',
                    'id'            => 'footer_title_color',
                    'title'         => __('Footer Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                 
                array(
                    'css'           => '.molecule-footer-sidebars a',
                    'default'       => '',
                    'id'            => 'footer_link_color',
                    'title'         => __('Footer Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ), 
                array(
                    'css'           => '.molecule-footer-sidebars a:hover',
                    'default'       => '',
                    'id'            => 'footer_link_hover_color',
                    'title'         => __('Footer Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),      
                array(
                    'css'           => array( 'selector' => '.molecule-footer-socket', 'property' => 'background-color' ),
                    'default'       => '',
                    'id'            => 'socket_background',
                    'title'         => __('Socket Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_background_image',
                    'title'         => __('Socket Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ),
                array(
                    'css'           => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_text_color',
                    'title'         => __('Socket Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),                
                array(
                    'css'           => '.molecule-footer-socket a',
                    'default'       => '',
                    'id'            => 'socket_link_color',
                    'title'         => __('Socket Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.molecule-footer-socket a:hover',
                    'default'       => '',
                    'id'            => 'socket_link_hover_color',
                    'title'         => __('Socket Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
            )              
        ),   
        array(
            'id'            => 'colors_buttons',
            'title'         => __('Button Colors', 'waterfall'),
            'fields'    => array(                      
                array(
                    'css'           => array( 
                        'selector' => 'input[type=\'submit\'], input[type=\'submit\'].button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .header .atom-menu-item-cart input.button.alt, .woocommerce button.button.alt, .header .atom-menu-item-cart button.button.alt, .woocommerce a.button.alt, .header .atom-menu-item-cart a.button.alt, .header .atom-menu-item-cart a.button.checkout', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'primary_button_background',
                    'title'         => __('Primary Button Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array( 
                        'selector' => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .header .atom-menu-item-cart input.button.alt:hover, .woocommerce button.button.alt:hover, .header .atom-menu-item-cart button.button.alt:hover, .woocommerce a.button.alt:hover, .header .atom-menu-item-cart a.button.alt:hover, .header .atom-menu-item-cart a.button.checkout:hover', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'primary_button_background_hover',
                    'title'         => __('Primary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
                array(
                    'css'           => 'input[type=\'submit\'], input[type=\'submit\'].button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .header .atom-menu-item-cart input.button.alt, .woocommerce button.button.alt, .header .atom-menu-item-cart button.button.alt, .woocommerce a.button.alt, .header .atom-menu-item-cart a.button.alt, , .header .atom-menu-item-cart a.button.checkout',
                    'default'       => '',
                    'id'            => 'primary_button_color',
                    'title'         => __('Primary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .header .atom-menu-item-cart input.button.alt:hover, .woocommerce button.button.alt:hover, .header .atom-menu-item-cart button.button.alt:hover, .woocommerce a.button.alt:hover, .header .atom-menu-item-cart a.button.alt:hover, , .header .atom-menu-item-cart a.button.checkout:hover',
                    'default'       => '',
                    'id'            => 'primary_button_color_hover',
                    'title'         => __('Primary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
                array(
                    'css'           => array( 
                        'selector' => '.elementor-button, .woocommerce input.button, .woocommerce input[type=\'submit\'].button, .header .atom-menu-item-cart input.button, .woocommerce button.button, .header .atom-menu-item-cart button.button, .woocommerce a.button, .header .atom-menu-item-cart a.button, .header .atom-menu-item-cart a.button', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'secondary_button_background',
                    'title'         => __('Secondary Button Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => array( 
                        'selector' => '.elementor-button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover .header .atom-menu-item-cart input.button:hover, .woocommerce button.button:hover, .header .atom-menu-item-cart button.button:hover, .woocommerce a.button:hover, .header .atom-menu-item-cart a.button:hover, .header .atom-menu-item-cart a.button:hover', 
                        'property' => 'background-color' 
                    ),
                    'default'       => '',
                    'id'            => 'secondary_button_background_hover',
                    'title'         => __('Secondary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
                array(
                    'css'           => '.elementor-button, .woocommerce input.button, .woocommerce input[type=\'submit\'].button, .header .atom-menu-item-cart input.button, .woocommerce button.button, .header .atom-menu-item-cart button.button, .woocommerce a.button, .header .atom-menu-item-cart a.button, .header .atom-menu-item-cart a.button',
                    'default'       => '',
                    'id'            => 'secondary_button_color',
                    'title'         => __('Secondary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),
                array(
                    'css'           => '.elementor-button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover, .header .atom-menu-item-cart input.button:hover, .woocommerce button.button:hover, .header .atom-menu-item-cart button.button:hover, .woocommerce a.button:hover, .header .atom-menu-item-cart a.button:hover, .header .atom-menu-item-cart a.button:hover',
                    'default'       => '',
                    'id'            => 'secondary_button_color_hover',
                    'title'         => __('Secondary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ),    
            )
        ),     
    )
);

// Adds settings for the layout
$layout = array(
    'description'   => __('Adjust extensive settings and elements for various parts of the website here.', 'waterfall'),
    'id'            => 'waterfall_layout',
    'title'         => __('Theme Elements', 'waterfall'),
    'panel'         => true,
    'sections'      => array(
        array(
            'id'            => 'style_header',
            'title'         => __('Header', 'waterfall'),
            'fields'    => array( 
                array(
                    'default'       => '',
                    'id'            => 'header_disable',
                    'title'         => __('Disable Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'full',
                    'id'            => 'header_width',
                    'title'         => __('Header Width', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_container_options()
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_fixed',
                    'title'         => __('Fixed Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_border',
                    'title'         => __('Disable Header Bottom Border', 'waterfall'),
                    'type'          => 'checkbox'
                ),                 
                array(
                    'default'       => '',
                    'id'            => 'header_headroom',
                    'title'         => __('Collapse Header when Scrolling', 'waterfall'),
                    'type'          => 'checkbox'
                ), 
                array(
                    'default'       => '',
                    'id'            => 'header_transparent',
                    'title'         => __('Transparent Header', 'waterfall'),
                    'type'          => 'checkbox'
                ), 
                array(
                    'default'       => 'left',
                    'id'            => 'header_logo_float',
                    'title'         => __('Logo Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_disable_logo',
                    'title'         => __('Disable Header Logo', 'waterfall'),
                    'type'          => 'checkbox'
                ),        
                array(
                    'default'       => 'right',
                    'id'            => 'header_menu_float',
                    'title'         => __('Menu Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_menu_search',
                    'title'         => __('Add a Search Icon to the Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => __('Nothing found!', 'waterfall'),
                    'id'            => 'header_menu_none',
                    'title'         => __('Nothing Found Search Text', 'waterfall'),
                    'description'   => __('Text when nothing is found in search', 'waterfall'),
                    'type'          => 'input'
                ),
                array(
                    'default'       => __('View All Results', 'waterfall'),
                    'id'            => 'header_menu_all',
                    'title'         => __('All Results Search Text', 'waterfall'),
                    'description'   => __('Text for link to all the results', 'waterfall'),
                    'type'          => 'input'
                ),                
                array(
                    'default'       => '',
                    'id'            => 'header_menu_social',
                    'title'         => __('Add Social Icons to the Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ),     
                array(
                    'default'       => '',
                    'id'            => 'header_disable_menu',
                    'title'         => __('Disable Header Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ),               
                array(
                    'default'       => 'mobile',
                    'id'            => 'header_menu_hamburger',
                    'title'         => __('Display of Mobile Menu', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'always'    => __('Always Display', 'waterfall'),
                        'tablet'    => __('Display on Tablets', 'waterfall'),
                        'mobile'    => __('Display on Mobile', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => 'default',
                    'id'            => 'header_menu_style',
                    'title'         => __('Header Menu Style', 'waterfall'),
                    'description'   => __('Some styles always show a hamburger menu, while others are only visible in the mobile menu.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'default'   => __('Default', 'waterfall'),
                        'dark'      => __('Dark (Mobile)', 'waterfall'),
                        'fixed'     => __('Fixed (Hamburger)', 'waterfall'),
                        'left'      => __('Left (Hamburger)', 'waterfall'),
                        'right'     => __('Right (Hamburger)', 'waterfall'),
                    ),
                )  
            )              
        ),    
        array(
            'id'            => 'page_content',
            'title'         => __('Pages', 'waterfall'),
            'fields'    => array(
                array(
                    'default'       => '',
                    'id'            => 'page_header_disable',
                    'title'         => __('Disable Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'after',
                    'id'            => 'page_header_featured',
                    'title'         => __('Featured Image Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_background_options()
                ),
                array(
                    'default'       => 'half-hd',
                    'id'            => 'page_header_size',
                    'title'         => __('Size Featured Image', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_image_sizes()
                ),    
                array(
                    'default'       => 'quarter',
                    'id'            => 'page_header_height',
                    'title'         => __('Title Section Minimum Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page does not have a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_height_options()
                ),
                array(
                    'default'       => 'half',
                    'id'            => 'page_header_height_image',
                    'title'         => __('Title Section with Featured Image Minimum Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page has a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_height_options()
                ),    
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the header of the content.', 'waterfall'),
                    'id'            => 'page_header_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Title Section Width', 'waterfall'),
                    'type'          => 'select'
                ),      
                array(
                    'default'       => 'left',
                    'id'            => 'page_header_align',
                    'title'         => __('Title Section Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the Title Section?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_align_options()
                ),   
                array(
                    'default'       => '',
                    'id'            => 'page_header_parallax',
                    'title'         => __('Enable the parallax effect to page Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ), 
                array(
                    'default'       => '',
                    'id'            => 'page_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'none',
                    'id'            => 'page_header_scroll',
                    'title'         => __('Enable the scroll button in Title Sections', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_button_options()
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the the main content.', 'waterfall'),
                    'id'            => 'page_content_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Main Content Width', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'id'            => 'page_content_readable',
                    'title'         => __('Limit content to readable width', 'waterfall'),
                    'description'   => __('Limits paragraphs, lists and smaller titles to a readable width and centers them.', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'choices'       => get_sidebar_options(),
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for pages.', 'waterfall'),
                    'id'            => 'page_layout',
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                )   
            )              
        ),
        array(
            'id'            => 'single_content',
            'title'         => __('Posts', 'waterfall'),
            'fields'    => array(
                array(
                    'default'       => '',
                    'id'            => 'single_header_disable',
                    'title'         => __('Disable Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ),     
                array(
                    'default'       => 'after',
                    'id'            => 'single_header_featured',
                    'title'         => __('Posts Featured Image Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_background_options()
                ),   
                array(
                    'default'       => 'half-hd',
                    'id'            => 'single_header_size',
                    'title'         => __('Size Featured Image', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_image_sizes()
                ),    
                array(
                    'default'       => 'quarter',
                    'id'            => 'single_header_height',
                    'title'         => __('Title Section Minimum Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page does not have a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_height_options()
                ),
                array(
                    'default'       => 'half',
                    'id'            => 'single_header_height_image',
                    'title'         => __('Title Section with Featured Image Minimum Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page has a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_height_options()
                ), 
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the header of the content.', 'waterfall'),
                    'id'            => 'single_header_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Title Section Width', 'waterfall'),
                    'type'          => 'select'
                ),     
                array(
                    'default'       => 'left',
                    'id'            => 'single_header_align',
                    'title'         => __('Title Section Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the Title Section?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_align_options()
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_header_parallax',
                    'title'         => __('Enable the parallax effect to Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_header_date',
                    'title'         => __('Show a date in post Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_header_terms',
                    'title'         => __('Show tags and categories in post Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => false,
                    'id'            => 'single_header_author',
                    'title'         => __('Show the author in post Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'none',
                    'id'            => 'single_header_scroll',
                    'title'         => __('Enable the scroll button in Title Sections', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_button_options()
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the main content section.', 'waterfall'),
                    'id'            => 'single_content_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Main Content Width', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_content_readable',
                    'title'         => __('Limit content to readable width', 'waterfall'),
                    'description'   => __('Limits paragraphs, lists and smaller titles to a readable width and centers them.', 'waterfall'),
                    'type'          => 'checkbox'
                ),     
                array(
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for posts.', 'waterfall'),
                    'id'            => 'single_layout',
                    'choices'       => get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_related_disable',
                    'title'         => __('Disable related posts section', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the related section.', 'waterfall'),
                    'id'            => 'single_related_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Related Section Width', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_related_posts',
                    'title'         => __('Show related posts', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => __('You also might like', 'waterfall'),
                    'id'            => 'single_related_text',
                    'title'         => __('Title above Related Posts', 'waterfall'),
                    'type'          => 'input'
                ),
                array(
                    'default'       => __('View Post', 'waterfall'),
                    'id'            => 'single_related_button',
                    'title'         => __('Title of Related Posts Button', 'waterfall'),
                    'description'   => __('The title inside the buttons. Leave empty to remove the button.', 'waterfall'),    
                    'type'          => 'input'
                ),    
                array(
                    'default'       => 'third',
                    'description'   => __('Amount of grid columns for posts.', 'waterfall'),
                    'id'            => 'single_related_grid',
                    'choices'       => get_column_options(),
                    'title'         => __('Related Posts Columns', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'description'   => __('Minimum height of related posts.', 'waterfall'),
                    'id'            => 'single_related_height',
                    'title'         => __('Related Posts Height', 'waterfall'),
                    'type'          => 'number'
                ),     
                array(
                    'default'       => 3,
                    'description'   => __('Number of related posts to show', 'waterfall'),
                    'id'            => 'single_related_number',
                    'title'         => __('Related Posts Amount', 'waterfall'),
                    'type'          => 'number'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_related_pagination',
                    'title'         => __('Show post pagination', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => __('&lsaquo; Previous Article', 'waterfall'),
                    'id'            => 'single_related_pagination_prev',
                    'title'         => __('Pagination Previous Article Title', 'waterfall'),
                    'type'          => 'input'
                ),
                array(
                    'default'       => __('Next Article &rsaquo; ', 'waterfall'),
                    'id'            => 'single_related_pagination_next',
                    'title'         => __('Pagination Next Article Title', 'waterfall'),
                    'type'          => 'input'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_footer_disable',
                    'title'         => __('Disable content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ),     
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the content footer.', 'waterfall'),
                    'id'            => 'single_footer_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Content Footer Width', 'waterfall'),
                    'type'          => 'select'
                ),     
                array(
                    'default'       => '',
                    'id'            => 'single_footer_author',
                    'title'         => __('Show the author in the post content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_footer_comments',
                    'title'         => __('Show comments in the post content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'single_footer_share',
                    'title'         => __('Show sharing buttons in posts', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'single_share_facebook',
                    'title'         => __('Show Facebook sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_twitter',
                    'title'         => __('Show Twitter sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_linkedin',
                    'title'         => __('Show LinkedIn sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_google-plus',
                    'title'         => __('Show Google Plus sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_pinterest',
                    'title'         => __('Show Pinterest sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_reddit',
                    'title'         => __('Show Reddit sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_stumbleupon',
                    'title'         => __('Show StumbleUpon sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                     
                array(
                    'default'       => '',
                    'id'            => 'single_share_pocket',
                    'title'         => __('Show Pocket sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ),                      
                array(
                    'default'       => '',
                    'id'            => 'single_share_whatsapp',
                    'title'         => __('Show Whatsapp sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                )   
            )
        ),
        array(
            'id'        => 'archives',
            'title'     => __('Archives', 'waterfall'),
            'fields'    => array(
                array(
                    'default'       => '',
                    'id'            => 'archive_header_disable',
                    'title'         => __('Disable Archive Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'archive_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of header in posts archives.', 'waterfall'),
                    'id'            => 'archive_header_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Archives Header Width', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of header in posts archives.', 'waterfall'),
                    'id'            => 'archive_header_height',
                    'choices'       => get_height_options(),
                    'title'         => __('Archives Header Height', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'left',
                    'id'            => 'archive_header_align',
                    'title'         => __('Archive Header Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the archive header?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_align_options()
                ),    
                array(
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for archives.', 'waterfall'),
                    'id'            => 'archive_layout',
                    'choices'       => get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of grid in posts archives.', 'waterfall'),
                    'id'            => 'archive_grid_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Archives Width', 'waterfall'),
                    'type'          => 'select'
                ),   
                array(
                    'default'       => 'grid',
                    'description'   => __('Style of posts in archives.', 'waterfall'),
                    'id'            => 'archive_grid_style',
                    'choices'       => array(
                        'grid'      => __('Grid', 'waterfall'),
                        'list'      => __('List', 'waterfall'),
                    ),
                    'title'         => __('Archives Style', 'waterfall'),
                    'type'          => 'select'
                ),   
                array(
                    'default'       => 'third',
                    'description'   => __('Amount of grid columns for posts archives.', 'waterfall'),
                    'id'            => 'archive_grid_columns',
                    'choices'       => get_column_options(),
                    'title'         => __('Archives Columns', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'none',
                    'description'   => __('Excerpt within archive posts.', 'waterfall'),
                    'id'            => 'archive_grid_content',
                    'choices'       => array(
                        'excerpt'   => __('Excerpt', 'waterfall'),
                        'none'      => __('No excerpt', 'waterfall'),
                    ),
                    'title'         => __('Archives Excerpt', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'description'   => __('Shows the post type under the title of each post.', 'waterfall'),
                    'id'            => 'archive_grid_type',
                    'title'         => __('Archive Post Type in Posts', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => '',
                    'description'   => __('Shows a button within posts.', 'waterfall'),
                    'id'            => 'archive_grid_button',
                    'title'         => __('Archive Posts Button', 'waterfall'),
                    'type'          => 'number'
                ),
                array(
                    'default'       => __('View Post', 'waterfall'),
                    'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
                    'id'            => 'archive_grid_button_label',
                    'title'         => __('Archive Posts Button Label', 'waterfall'),
                    'type'          => 'input'
                ),    
                array(
                    'default'       => '',
                    'description'   => __('Minimum height of posts in the archive.', 'waterfall'),
                    'id'            => 'archive_grid_height',
                    'title'         => __('Archive Posts Height', 'waterfall'),
                    'type'          => 'number'
                ),    
                array(
                    'default'       => 'square-ld',
                    'description'   => __('Featured Image size within archive posts.', 'waterfall'),
                    'id'            => 'archive_grid_image',
                    'choices'       => get_image_sizes(),
                    'title'         => __('Archives Featured Image Size', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'none',
                    'description'   => __('Float of featured image within the posts.', 'waterfall'),
                    'id'            => 'archive_grid_image_float',
                    'choices'       => get_float_options(),
                    'title'         => __('Archive Featured Image Float', 'waterfall'),
                    'type'          => 'select'
                )     
            )              
        ),
        array(
            'id'        => 'search_page',
            'title'     => __('Search Page', 'waterfall'),
            'fields'    => array(
                array(
                    'default'       => '',
                    'id'            => 'search_header_disable',
                    'title'         => __('Disable Search Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'search_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of header in search archives.', 'waterfall'),
                    'id'            => 'search_header_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Search Page Header Width', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Height of header in search archives.', 'waterfall'),
                    'id'            => 'search_header_height',
                    'choices'       => get_height_options(),
                    'title'         => __('Search Page Header Height', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'left',
                    'id'            => 'search_header_align',
                    'title'         => __('Search Page Header Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the search page header?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_align_options()
                ),    
                array(
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for the search page.', 'waterfall'),
                    'id'            => 'search_layout',
                    'choices'       => get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ), 
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the grid for search results.', 'waterfall'),
                    'id'            => 'search_grid_width',
                    'choices'       => get_container_options(),
                    'title'         => __('Search Page Width', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'list',
                    'description'   => __('Style of posts in the search page.', 'waterfall'),
                    'id'            => 'search_grid_style',
                    'choices'       => array(
                        'grid'      => __('Grid', 'waterfall'),
                        'list'      => __('List', 'waterfall'),
                    ),
                    'title'         => __('Search Page Results Style', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'full',
                    'description'   => __('Amount of grid columns for search page posts.', 'waterfall'),
                    'id'            => 'search_grid_columns',
                    'choices'       => get_column_options(),
                    'title'         => __('Search Page Columns', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'excerpt',
                    'description'   => __('Excerpt within search page results.', 'waterfall'),
                    'id'            => 'search_grid_content',
                    'choices'       => array(
                        'excerpt'   => __('Excerpt', 'waterfall'),
                        'none'      => __('No excerpt', 'waterfall'),
                    ),
                    'title'         => __('Search Page Results Excerpt', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => '',
                    'description'   => __('Shows the post type under the title of each result.', 'waterfall'),
                    'id'            => 'search_grid_type',
                    'title'         => __('Search Post Type in Results', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => __('View Post', 'waterfall'),
                    'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
                    'id'            => 'search_grid_button_label',
                    'title'         => __('Search Page Results Button Label', 'waterfall'),
                    'type'          => 'input'
                ),     
                array(
                    'default'       => '',
                    'description'   => __('Minimum height of results in the search page.', 'waterfall'),
                    'id'            => 'search_grid_height',
                    'title'         => __('Search Page Results Height', 'waterfall'),
                    'type'          => 'number'
                ),    
                array(
                    'default'       => 'thumbnail',
                    'description'   => __('Featured Image size within search page results.', 'waterfall'),
                    'id'            => 'search_grid_image',
                    'choices'       => get_image_sizes(),
                    'title'         => __('Search Page Results Image Size', 'waterfall'),
                    'type'          => 'select'
                ),    
                array(
                    'default'       => 'left',
                    'description'   => __('Float of featured image within the results.', 'waterfall'),
                    'id'            => 'search_grid_image_float',
                    'choices'       => get_float_options(),
                    'title'         => __('Search Page Featured Image Float', 'waterfall'),
                    'type'          => 'select'
                )  
            )              
        ),
        array(
            'id'            => '404_page',
            'title'         => __('404 Page', 'waterfall'),
            'fields'    => array(       
                array(
                    'default'       => 'half',
                    'id'            => '404_header_height',
                    'title'         => __('404 Header Minimum Height', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_height_options()
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the 404 Header', 'waterfall'),
                    'id'            => '404_header_width',
                    'choices'       => get_container_options(),
                    'title'         => __('404 Header Width', 'waterfall'),
                    'type'          => 'select'
                ),      
                array(
                    'default'       => 'left',
                    'id'            => '404_header_align',
                    'title'         => __('Header Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the 404 header?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_align_options()
                ),
                array(
                    'default'       => __('Woops! Nothing found here...', 'waterfall'),
                    'id'            => '404_header_title',
                    'title'         => __('Default 404 Title', 'waterfall'),
                    'type'          => 'input'
                ),
                array(
                    'default'       => __('Try visiting another page or searching.', 'waterfall'),
                    'id'            => '404_header_description',
                    'title'         => __('Default 404 Description', 'waterfall'),
                    'type'          => 'input'
                ),     
                array(
                    'default'       => '',
                    'id'            => '404_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => '404_header_search',
                    'title'         => __('Display Searchform', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
            )              
        ),    
        array(
            'id'            => 'styling_footer',
            'title'         => __('Footer', 'waterfall'),
            'fields'    => array(
                array(
                    'default'       => 'default',
                    'id'            => 'footer_width',
                    'title'         => __('Footer Width', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => get_container_options(),
                ),
                array(
                    'default'       => '',
                    'id'            => 'footer_display_sidebars',
                    'title'         => __('Display Sidebars', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'third',
                    'description'   => __('Amount of sidebars in the footer.', 'waterfall'),
                    'id'            => 'footer_sidebars',
                    'choices'       => array(
                        'full'      => __('One sidebar', 'waterfall'),
                        'half'      => __('Two sidebars', 'waterfall'),
                        'third'     => __('Three sidebars', 'waterfall'),
                        'fourth'    => __('Four sidebars', 'waterfall'),
                        'fifth'     => __('Five sidebars', 'waterfall')
                    ),
                    'title'         => __('Footer Sidebars', 'waterfall'),
                    'type'          => 'select'
                ), 
                array(
                    'default'       => '',
                    'id'            => 'footer_display_socket',
                    'title'         => __('Display Socket', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => '',
                    'id'            => 'footer_copyright',
                    'title'         => __('Display Copyright', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => get_bloginfo('name'),
                    'id'            => 'footer_copyright_name',
                    'title'         => __('Copyright Message', 'waterfall'),
                    'type'          => 'text'
                ),    
                array(
                    'choices'       => array(
                        'http://schema.org/Organization'    => __('Organization', 'waterfall'),
                        'http://schema.org/Person'          => __('Person', 'waterfall')
                    ),    
                    'default'       => 'http://schema.org/Organization',
                    'id'            => 'footer_copyright_schema',
                    'title'         => __('Copyright Type', 'waterfall'),
                    'type'          => 'select'
                ), 
                array(
                    'default'       => '',
                    'id'            => 'footer_menu',
                    'title'         => __('Display Footer Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'footer_social',
                    'title'         => __('Display Social Icons', 'waterfall'),
                    'type'          => 'checkbox'
                ) 
            )              
        )
    )
); 
    
// We add additional settings if Woocommerce is active
if( class_exists( 'WooCommerce' ) ) {
    $layout['sections'][] = array(
        'id'            => 'woocommerce_header',
        'title'         => __('WooCommerce Header', 'waterfall'),
        'fields'        => array(
            array(
                'default'       => '',
                'id'            => 'header_menu_cart',
                'title'         => __('Add a Shopping Cart to the Menu', 'waterfall'),
                'description'   => __('Requires the WooCommerce plugin.', 'waterfall'),
                'type'          => 'checkbox'
            )           
        )
    );
    $layout['sections'][] = array(
        'id'            => 'woocommerce_archive',
        'title'         => __('WooCommerce Archives', 'waterfall'),
        'fields'    => array(     
            array(
                'default'       => '',
                'id'            => 'product_archive_header_disable',
                'title'         => __('Disable Product Archive Header', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => 'product_archive_header_breadcrumbs',
                'title'         => __('Display Breadcrumbs in Product Archive', 'waterfall'),
                'type'          => 'checkbox'
            ),       
            array(
                'default'       => 'default',
                'description'   => __('Width of header in product archives.', 'waterfall'),
                'id'            => 'product_archive_header_width',
                'choices'       => get_container_options(),
                'title'         => __('Product Archive Header Width', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => 'default',
                'description'   => __('Height of header in product archives.', 'waterfall'),
                'id'            => 'product_archive_header_height',
                'choices'       => get_height_options(),
                'title'         => __('Product Archive Header Height', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => 'left',
                'id'            => 'product_archive_header_align',
                'title'         => __('Product Archive Header Text Align', 'waterfall'),
                'description'   => __('How should text be aligned within the product archive header?', 'waterfall'),
                'type'          => 'select',
                'choices'       => get_align_options()
            ),
            array(
                'default'       => 'left',
                'description'   => __('Choose the sidebar lay-out for the product archives.', 'waterfall'),
                'id'            => 'product_archive_layout',
                'choices'       => get_sidebar_options(),
                'title'         => __('Sidebar Lay-Out', 'waterfall'),
                'type'          => 'select'
            ), 
            array(
                'default'       => 'default',
                'description'   => __('Width of the grid with the products and sidebar.', 'waterfall'),
                'id'            => 'product_archive_width',
                'choices'       => get_container_options(),
                'title'         => __('Product Archive Width', 'waterfall'),
                'type'          => 'select'
            )        
        )         
    );
    $layout['sections'][] = array(
        'id'            => 'woocommerce_product',
        'title'         => __('WooCommerce Product', 'waterfall'),
        'fields'    => array(             
            array(
                'default'       => 'full',
                'description'   => __('Choose the sidebar lay-out for a single product.', 'waterfall'),
                'id'            => 'product_layout',
                'choices'       => get_sidebar_options(),
                'title'         => __('Sidebar Lay-Out', 'waterfall'),
                'type'          => 'select'
            ), 
            array(
                'default'       => 'default',
                'description'   => __('Width of the product Display.', 'waterfall'),
                'id'            => 'product_width',
                'choices'       => get_container_options(),
                'title'         => __('Single Product Width', 'waterfall'),
                'type'          => 'select'
            ),        
            array(
                'default'       => '',
                'id'            => 'product_breadcrumbs',
                'title'         => __('Display Breadcrumbs in Single Products', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => 'product_zoom',
                'title'         => __('Enable product image zoom', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => 'product_slider',
                'title'         => __('Enable product images slider', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => 'product_lightbox',
                'title'         => __('Enable product images lightbox', 'waterfall'),
                'type'          => 'checkbox'
            )          
        )         
    );
}

// Adds typography
$typography = array(
    'description'   => __('Adjust the typography at various locations here.', 'waterfall'),
    'id'            => 'waterfall_typography',
    'title'         => __('Typography', 'waterfall'),
    'panel'         => true,
    'priority'      => 20,
    'sections'      => array(
        array(
            'id'            => 'general_typography',
            'title'         => __('General', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => '',
                    'css'           => 'body',
                    'id'            => 'body_typography',
                    'title'         => __('General Font', 'waterfall'),
                    'type'          => 'typography'
                ),               
                array(
                    'default'       => '',
                    'css'           => '.header',
                    'id'            => 'header_menu_typography',
                    'title'         => __('Header Navigation Menu', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => '.atom-breadcrumbs',
                    'id'            => 'breadcrumbs_typography',
                    'title'         => __('Breadcrumbs', 'waterfall'),
                    'type'          => 'typography'
                ),               
                array(
                    'default'       => '',
                    'css'           => '.main-content',
                    'id'            => 'content_typography',
                    'title'         => __('Main Content', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => '.entry-meta',
                    'id'            => 'meta_typography',
                    'title'         => __('Meta', 'waterfall'),
                    'description'   => __('Meta are secondary text blocks such as the date and category of a post.', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'blockquote',
                    'id'            => 'blockquote_typography',
                    'title'         => __('Blockquotes', 'waterfall'),
                    'type'          => 'typography'
                )                
            )              
        ),         
        array(
            'id'            => 'headings_typography',
            'title'         => __('Headings', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => '',
                    'css'           => 'h1.page-title, .page h1.entry-title',
                    'id'            => 'page_heading_typography',
                    'title'         => __('Page Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in pages, 404 pages and archives.', 'waterfall'),
                    'type'          => 'typography'
                ),               
                array(
                    'default'       => '',
                    'css'           => '.single h1.entry-title',
                    'id'            => 'post_heading_typography',
                    'title'         => __('Post Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in post articles.', 'waterfall'),
                    'type'          => 'typography'
                ),
                array(
                    'default'       => '',
                    'css'           => '.single-product h1.product_title',
                    'id'            => 'product_heading_typography',
                    'title'         => __('Product Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in products.', 'waterfall'),
                    'type'          => 'typography'
                ),
                array(
                    'default'       => '',
                    'css'           => '.widget-title',
                    'id'            => 'widget_title_typography',
                    'title'         => __('Widget Titles', 'waterfall'),
                    'description'   => __('Determines the typography for widget headings.', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'h1',
                    'columns'       => 'third',
                    'id'            => 'heading1_typography',
                    'title'         => __('Heading 1', 'waterfall'),
                    'type'          => 'typography'
                ),               
                array(
                    'default'       => '',
                    'css'           => 'h2',
                    'columns'        => 'third',
                    'id'            => 'heading2_typography',
                    'title'         => __('Heading 2', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'h3',
                    'columns'        => 'third',
                    'id'            => 'heading3_typography',
                    'title'         => __('Heading 3', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'h4',
                    'columns'        => 'third',
                    'id'            => 'heading4_typography',
                    'title'         => __('Heading 4', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'h5',
                    'columns'        => 'third',
                    'id'            => 'heading5_typography',
                    'title'         => __('Heading 5', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => 'h6',
                    'columns'       => 'third',
                    'id'            => 'heading6_typography',
                    'title'         => __('Heading 6', 'waterfall'),
                    'type'          => 'typography'
                )               
            )              
        ),        
        array(
            'id'            => 'footer_typography',
            'title'         => __('Footer', 'waterfall'),
            'fields'    => array(                   
                array(
                    'default'       => '',
                    'css'           => '.footer',
                    'id'            => 'footer_typography',
                    'title'         => __('Footer Content', 'waterfall'),
                    'type'          => 'typography'
                ),                
                array(
                    'default'       => '',
                    'css'           => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6',
                    'id'            => 'footer_titles',
                    'title'         => __('Footer Titles', 'waterfall'),
                    'type'          => 'typography'
                ),              
                array(
                    'default'       => '',
                    'css'           => '.molecule-footer-socket',
                    'id'            => 'socket_typography',
                    'title'         => __('Socket Content', 'waterfall'),
                    'type'          => 'typography'
                ),              
                array(
                    'default'       => '',
                    'css'           => '.molecule-footer-socket .atom-menu',
                    'id'            => 'socket_menu_typography',
                    'title'         => __('Socket Navigation Menu', 'waterfall'),
                    'type'          => 'typography'
                )               
            )              
        )
    )
);