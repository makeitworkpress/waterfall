<?php
/**
 * Adds customizer color panels
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$menu   = wf_get_theme_option('layout', 'header_menu_hamburger');

$colors = [
    'description'   => __('Adjust the colors of all of the theme sections.', 'waterfall'),
    'id'            => 'waterfall_colors',
    'title'         => __('Colors', 'waterfall'),
    'panel'         => true,
    'priority'      => 10,
    'sections'      => [
       [
            'id'            => 'colors_general',
            'title'         => __('General Colors', 'waterfall'),
            'fields'    => [        
                [
                    'default'       => '',
                    'selector'      => 'body',
                    'id'            => 'body_typography_color',
                    'title'         => __('General Font Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => 'h1, h2, h3, h4, h5, h6',
                    'id'            => 'body_heading_color',
                    'title'         => __('General Heading Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                 
                [
                    'default'       => '',
                    'selector'      => 'a',
                    'id'            => 'body_link_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'default'       => '',
                    'selector'      => 'a:hover',
                    'id'            => 'body_link_hover_color',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => 'blockquote',
                    'id'            => 'blockquote_typography_color',
                    'title'         => __('Blockquotes Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
            ]
        ],
        [
            'id'            => 'colors_header',
            'title'         => __('Header Colors', 'waterfall'),
            'fields'    => [
                [
                    'selector'      => ['selector' => '.header', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'header_background',
                    'title'         => __('Header Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.header',
                    'default'       => '',
                    'id'            => 'header_background_image',
                    'title'         => __('Header Background Image', 'waterfall'),
                    'type'          => 'image'
                ],
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .menu', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_background',
                    'title'         => __('Mobile Menu Background Color', 'waterfall'),
                    'description'   => __('This color applies to the default mobile menu.', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => '.molecule-header-atoms .menu > li > a, .atom-search-expand',
                    'default'       => '',
                    'id'            => 'navigation_link_color',
                    'title'         => __('Navigation Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-header-atoms .menu > li > a:hover, .atom-search-expand:hover',
                    'default'       => '',
                    'id'            => 'navigation_link_hover_color',
                    'title'         => __('Navigation Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'     => [ 
                        'selector' => '.molecule-header-atoms .menu > li > a:hover, .molecule-header-atoms .menu > li.current-menu-item > a:hover, .molecule-header-atoms .menu > li.current-menu-ancestor > a:hover', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_hover_background',
                    'title'         => __('Navigation Link Hover Background', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-header-atoms .menu > li.current-menu-item > a, .molecule-header-atoms .menu > li.current-menu-ancestor > a',
                    'default'       => '',
                    'id'            => 'navigation_link_active_color',
                    'title'         => __('Navigation Link Active Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                 
                [
                    'selector'      => [ 
                        'selector' => '.molecule-header-atoms .menu > li.current-menu-item > a, .molecule-header-atoms .menu > li.current-menu-ancestor > a', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_active_background',
                    'title'         => __('Navigation Link Active Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => [
                        'min-width' => $menu == 'tablet' ? '1025px' : '768px',
                        'selector'  => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-default .menu > li > a, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-dark .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-search-expand',
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_color',
                    'title'         => __('Navigation Link Color Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [
                        'min-width' => $menu == 'tablet' ? '1025px' : '768px',
                        'selector'  => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-default .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-dark .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-search-expand:hover',
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_hover_color',
                    'title'         => __('Navigation Link Hover Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [
                        'max-width' => $menu == 'tablet' ? '1024px' : '767px',
                        'selector'  => '.molecule-header-atoms .menu > li > a, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .menu > li > a, .atom-menu-mobile-hamburger.atom-menu-dark .molecule-header-atoms .menu .menu-item > a, .molecule-header-atoms .sub-menu a'
                    ],
                    'default'       => '',
                    'id'            => 'navigation_mobile_link_color',
                    'title'         => __('Mobile Menu Navigation Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => [
                        'max-width' => $menu == 'tablet' ? '1024px' : '767px',
                        'selector'  => '.molecule-header-atoms .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .menu > li > a:hover, .atom-menu-mobile-hamburger.atom-menu-dark .molecule-header-atoms .menu .menu-item > a:hover, .molecule-header-atoms .sub-menu a:hover',
                    ],
                    'default'       => '',
                    'id'            => 'navigation_mobile_link_hover_color',
                    'title'         => __('Mobile Menu Navigation Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => [
                        'selector' => '.molecule-header-atoms .atom-menu-hamburger span',
                        'property' => 'background-color'
                    ],
                    'default'       => '',
                    'id'            => 'navigation_hamburger_normal_color',
                    'title'         => __('Hamburger Menu Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [
                        'selector' => '.molecule-header-atoms .atom-menu-hamburger:hover span',
                        'property' => 'background-color'
                    ],
                    'default'       => '',
                    'id'            => 'navigation_hamburger_normal_hover_color',
                    'title'         => __('Hamburger Menu Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                     
                [
                    'selector'      => [
                        'selector' => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-hamburger span',
                        'property' => 'background-color'
                    ],
                    'default'       => '',
                    'id'            => 'navigation_hamburger_transparent_color',
                    'title'         => __('Hamburger Menu Color Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [
                        'selector' => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu-hamburger:hover span',
                        'property' => 'background-color'
                    ],
                    'default'       => '',
                    'id'            => 'navigation_hamburger_transparent_hover_color',
                    'title'         => __('Hamburger Menu Hover Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .sub-menu', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_submenu_background',
                    'title'         => __('Drop-down Menu Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-header-atoms .sub-menu a',
                    'default'       => '',
                    'id'            => 'navigation_submenu_color',
                    'title'         => __('Drop-down Menu Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-header-atoms .sub-menu a:hover',
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_color',
                    'title'         => __('Drop-down Menu Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .sub-menu a:hover', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_background',
                    'title'         => __('Drop-down Menu Link Hover Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]
            ]              
        ],   
        [
            'id'            => 'colors_main_content',
            'title'         => __('Content Colors', 'waterfall'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_title_header',
                    'title'         => __('Title Section', 'waterfall'),
                    'type'          => 'heading'
                ],                                    
                [
                    'selector'      => ['selector' => '.main-header', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'title_section',
                    'title'         => __('Title Section Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6',
                    'default'       => '',
                    'id'            => 'title_section_title',
                    'title'         => __('Title Section Title Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header',
                    'default'       => '',
                    'id'            => 'title_section_text',
                    'title'         => __('Title Section Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-header a',
                    'default'       => '',
                    'id'            => 'title_section_link',
                    'title'         => __('Title Section Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header a:hover',
                    'default'       => '',
                    'id'            => 'title_section_link_hover',
                    'title'         => __('Title Section Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => '.main-header .entry-meta a, .main-header .entry-time, .main-header .entry-meta i, .main-header .entry-meta ',
                    'default'       => '',
                    'id'            => 'title_section_meta',
                    'title'         => __('Title Section Meta Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-header.components-image-background .entry-meta, .main-header.components-image-background .entry-meta a, .main-header.components-image-background .entry-meta i, .main-header.components-image-background .entry-time, .main-header.components-image-background a, .main-header.components-image-background a:hover, .main-header.components-image-background, .main-header.components-image-background h1, .main-header.components-image-background h2, .main-header.components-image-background h3, .main-header.components-image-background h4, .main-header.components-image-background h5, .main-header.components-image-background h6',
                    'default'       => '',
                    'id'            => 'title_section_featured_background_color',
                    'title'         => __('Title Section Text Color with Image Background', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_content_header',
                    'title'         => __('Main Content', 'waterfall'),
                    'type'          => 'heading'
                ],                                       
                [
                    'selector'      => ['selector' => '.main-content', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_main',
                    'title'         => __('Main Content Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content h1, .main-content h2, .main-content h3, .main-content h4, .main-content h5, .main-content h6',
                    'default'       => '',
                    'id'            => 'content_main_title',
                    'title'         => __('Main Content Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content',
                    'default'       => '',
                    'id'            => 'content_main_text',
                    'title'         => __('Main Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-content a',
                    'default'       => '',
                    'id'            => 'content_main_link',
                    'title'         => __('Main Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content a:hover',
                    'default'       => '',
                    'id'            => 'content_main_link_hover',
                    'title'         => __('Main Content Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content h1, .main-content h2, .main-content h3, .main-content h4, .main-content h5, .main-content h6',
                    'default'       => '',
                    'id'            => 'content_main_title',
                    'title'         => __('Main Content Title Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content',
                    'default'       => '',
                    'id'            => 'content_main_text',
                    'title'         => __('Main Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-content a',
                    'default'       => '',
                    'id'            => 'content_main_link',
                    'title'         => __('Main Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'     => '.main-content a:hover',
                    'default'       => '',
                    'id'            => 'content_main_link_hover',
                    'title'         => __('Main Content Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-sidebar',
                    'default'       => '',
                    'id'            => 'content_sidebar_color',
                    'title'         => __('Main Sidebar Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-sidebar h1, .main-sidebar h2, .main-sidebar h3, .main-sidebar h4, .main-sidebar h5, .main-sidebar h6',
                    'default'       => '',
                    'id'            => 'content_sidebar_title_color',
                    'title'         => __('Main Sidebar Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => ['selector' => '.main-sidebar', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_sidebar_background',
                    'title'         => __('Main Sidebar Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-sidebar a',
                    'default'       => '',
                    'id'            => 'content_sidebar_link_color',
                    'title'         => __('Main Sidebar Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-sidebar a:hover',
                    'default'       => '',
                    'id'            => 'content_sidebar_link_color',
                    'title'         => __('Main Sidebar Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_related_header',
                    'title'         => __('Related Section', 'waterfall'),
                    'type'          => 'heading'
                ],                                
                [
                    'selector'      => ['selector' => '.main-related', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_related',
                    'title'         => __('Related Content Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related h1, .main-related h2, .main-related h3, .main-related h4, .main-related h5, .main-related h6',
                    'default'       => '',
                    'id'            => 'content_related_title',
                    'title'         => __('Related Content Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related',
                    'default'       => '',
                    'id'            => 'content_related_text',
                    'title'         => __('Related Content Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-related a',
                    'default'       => '',
                    'id'            => 'content_related_link',
                    'title'         => __('Related Content Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related a:hover',
                    'default'       => '',
                    'id'            => 'content_related_link_hover',
                    'title'         => __('Related Content Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related .molecule-post:not(.has-post-thumbnail) a',
                    'default'       => '',
                    'id'            => 'content_related_posts_link',
                    'title'         => __('Related Posts Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-related .molecule-post:not(.has-post-thumbnail) a:hover',
                    'default'       => '',
                    'id'            => 'content_related_posts_link_hover',
                    'title'         => __('Related Posts Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related .has-post-thumbnail a',
                    'default'       => '',
                    'id'            => 'content_related_posts_featured_link',
                    'title'         => __('Related Posts Featured Image Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-related .has-post-thumbnail a:hover',
                    'default'       => '',
                    'id'            => 'content_related_posts_featured_link_hover',
                    'title'         => __('Related Posts Featured Image Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_footer_header',
                    'title'         => __('Content Footer Section', 'waterfall'),
                    'type'          => 'heading'
                ],                                   
                [
                    'selector'     => ['selector' => '.main-footer', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_footer',
                    'title'         => __('Content Footer Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                      
                [
                    'selector'      => '.main-footer h1, .main-footer h2, .main-footer h3, .main-footer h4, .main-footer h5, .main-footer h6',
                    'default'       => '',
                    'id'            => 'content_footer_title',
                    'title'         => __('Content Footer Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-footer',
                    'default'       => '',
                    'id'            => 'content_footer_text',
                    'title'         => __('Content Footer Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-footer a',
                    'default'       => '',
                    'id'            => 'content_footer_link',
                    'title'         => __('Content Footer Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-footer a:hover',
                    'default'       => '',
                    'id'            => 'content_footer_link_hover',
                    'title'         => __('Content Footer Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]
            ]              
        ],   
        [
            'id'            => 'colors_footer',
            'title'         => __('Footer Colors', 'waterfall'),
            'fields'    => [                    
                [
                    'selector'      => ['selector' => '.molecule-footer-sidebars', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'footer_background',
                    'title'         => __('Footer Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_background_image',
                    'title'         => __('Footer Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ],
                [
                    'selector'      => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_text_color',
                    'title'         => __('Footer Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6',
                    'default'       => '',
                    'id'            => 'footer_title_color',
                    'title'         => __('Footer Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                 
                [
                    'selector'      => '.molecule-footer-sidebars a',
                    'default'       => '',
                    'id'            => 'footer_link_color',
                    'title'         => __('Footer Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-footer-sidebars a:hover',
                    'default'       => '',
                    'id'            => 'footer_link_hover_color',
                    'title'         => __('Footer Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],      
                [
                    'selector'      => ['selector' => '.molecule-footer-socket', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'socket_background',
                    'title'         => __('Socket Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_background_image',
                    'title'         => __('Socket Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ],
                [
                    'selector'      => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_text_color',
                    'title'         => __('Socket Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => '.molecule-footer-socket a',
                    'default'       => '',
                    'id'            => 'socket_link_color',
                    'title'         => __('Socket Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-socket a:hover',
                    'default'       => '',
                    'id'            => 'socket_link_hover_color',
                    'title'         => __('Socket Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.atom-scroll.waterfall-scroll-top',
                    'default'       => '',
                    'id'            => 'scroll_top_color',
                    'title'         => __('Scroll to Top Arrow Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.atom-scroll.waterfall-scroll-top:hover',
                    'default'       => '',
                    'id'            => 'scroll_top_hover_color',
                    'title'         => __('Scroll to Top Arrow Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => ['selector' => '.atom-scroll.waterfall-scroll-top', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'scroll_top_background',
                    'title'         => __('Scroll to Top Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => ['selector' => '.atom-scroll.waterfall-scroll-top:hover', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'scroll_top_background_hover',
                    'title'         => __('Scroll to Top Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]                                                                
            ]              
        ],   
        [
            'id'            => 'colors_buttons',
            'title'         => __('Button Colors', 'waterfall'),
            'fields'    => [                      
                [
                    'selector'     => [ 
                        'selector' => 'input[type=\'submit\'], input[type=\'submit\'].button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .header .atom-cart input.button.alt, .woocommerce button.button.alt, .header .atom-cart button.button.alt, .woocommerce a.button.alt, .header .atom-cart a.button.alt, .header .atom-cart a.button.checkout, .atom-button.components-default-background, .wp-block-file .wp-block-file__button, .wp-block-button__link, .atom-cart-count, .woocommerce button.button.alt.disabled, .elementor-field-type-submit button', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'primary_button_background',
                    'title'         => __('Primary Button Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [ 
                        'selector' => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .header .atom-cart input.button.alt:hover, .woocommerce button.button.alt:hover, .header .atom-cart button.button.alt:hover, .woocommerce a.button.alt:hover, .header .atom-cart a.button.alt:hover, .header .atom-cart a.button.checkout:hover, .atom-button.components-default-background:hover, .wp-block-file .wp-block-file__button:hover, .wp-block-button__link:hover, .atom-cart-count:hover, .woocommerce button.button.alt.disabled:hover, .elementor-field-type-submit button:hover', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'primary_button_background_hover',
                    'title'         => __('Primary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => 'input[type=\'submit\'], input[type=\'submit\'].button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .header .atom-cart input.button.alt, .woocommerce button.button.alt, .header .atom-cart button.button.alt, .woocommerce a.button.alt, .header .atom-cart a.button.alt, .header .atom-cart a.button.checkout, .atom-button.components-default-background, .wp-block-file .wp-block-file__button, .wp-block-button__link, .atom-cart-count, .woocommerce button.button.alt.disabled, .elementor-field-type-submit button',
                    'default'       => '',
                    'id'            => 'primary_button_color',
                    'title'         => __('Primary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .header .atom-cart input.button.alt:hover, .woocommerce button.button.alt:hover, .header .atom-cart button.button.alt:hover, .woocommerce a.button.alt:hover, .header .atom-cart a.button.alt:hover, .header .atom-cart a.button.checkout:hover, .atom-button.components-default-background:hover, .wp-block-file .wp-block-file__button:hover, .wp-block-button__link:hover, .atom-cart-count:hover, .woocommerce button.button.alt.disabled:hover, .elementor-field-type-submit button:hover',
                    'default'       => '',
                    'id'            => 'primary_button_color_hover',
                    'title'         => __('Primary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => [ 
                        'selector' => '.elementor-button, .woocommerce input.button, .woocommerce input[type=\'submit\'].button, .header .atom-cart input.button, .woocommerce button.button, .header .atom-cart button.button, .woocommerce a.button, .header .atom-cart a.button, .header .atom-cart a.button', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'secondary_button_background',
                    'title'         => __('Secondary Button Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [ 
                        'selector' => '.elementor-button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover .header .atom-cart input.button:hover, .woocommerce button.button:hover, .header .atom-cart button.button:hover, .woocommerce a.button:hover, .header .atom-cart a.button:hover, .header .atom-cart a.button:hover', 
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'secondary_button_background_hover',
                    'title'         => __('Secondary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => '.elementor-button, .woocommerce input.button, .woocommerce input[type=\'submit\'].button, .header .atom-cart input.button, .woocommerce button.button, .header .atom-cart button.button, .woocommerce a.button, .header .atom-cart a.button, .header .atom-cart a.button',
                    'default'       => '',
                    'id'            => 'secondary_button_color',
                    'title'         => __('Secondary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.elementor-button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover, .header .atom-cart input.button:hover, .woocommerce button.button:hover, .header .atom-cart button.button:hover, .woocommerce a.button:hover, .header .atom-cart a.button:hover, .header .atom-cart a.button:hover',
                    'default'       => '',
                    'id'            => 'secondary_button_color_hover',
                    'title'         => __('Secondary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]    
            ]
        ]     
    ]
];