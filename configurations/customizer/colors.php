<?php
/**
 * Adds customizer color panels
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$menu   = wf_get_data('layout', 'header_menu_hamburger');

$colors = [
    'description'   => __('Adjust the colors of all of the theme sections.', 'waterfall'),
    'id'            => 'waterfall_colors',
    'title'         => __('Colors', 'waterfall'),
    'panel'         => true,
    'priority'      => 10,
    'sections'      => [
       'general' => [
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
                [
                    'default'       => '',
                    'selector'      => 'h1',
                    'id'            => 'body_heading_one_color',
                    'title'         => __('Heading 1 Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => 'h2',
                    'id'            => 'body_heading_two_color',
                    'title'         => __('Heading 2 Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => 'h3',
                    'id'            => 'body_heading_three_color',
                    'title'         => __('Heading 3 Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => 'h4',
                    'id'            => 'body_heading_four_color',
                    'title'         => __('Heading 4 Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]                                                                                               
            ]
        ],
        'header' => [
            'id'            => 'colors_header',
            'title'         => __('Header Colors', 'waterfall'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'header_colors_general',
                    'title'         => __('General Colors', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => ['header_background', 'header_background_image']
                ],                
                [
                    'selector'      => ['selector' => '.header, .molecule-header.molecule-header-transparent.molecule-header-scrolled', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'header_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.header',
                    'default'       => '',
                    'id'            => 'header_background_image',
                    'title'         => __('Background Image', 'waterfall'),
                    'type'          => 'image'
                ],
                [
                    'default'       => '',
                    'id'            => 'header_colors_menu',
                    'title'         => __('Menu Colors', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'navigation_link_color', 
                        'navigation_link_hover_color',
                        'navigation_link_hover_background',
                        'navigation_link_active_color',
                        'navigation_link_active_background',
                        'navigation_link_transparent_color',
                        'navigation_link_transparent_hover_color'
                    ]
                ],                              
                [
                    'selector'      => '.molecule-header-atoms .menu > li > a, .atom-search-expand',
                    'default'       => '',
                    'id'            => 'navigation_link_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-header-atoms .menu > li > a:hover, .atom-search-expand:hover',
                    'default'       => '',
                    'id'            => 'navigation_link_hover_color',
                    'title'         => __('Link Hover Color', 'waterfall'),
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
                    'title'         => __('Link Hover Background', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-header-atoms .menu > li.current-menu-item > a, .molecule-header-atoms .menu > li.current-menu-ancestor > a',
                    'default'       => '',
                    'id'            => 'navigation_link_active_color',
                    'title'         => __('Link Active Color', 'waterfall'),
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
                    'title'         => __('Link Active Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => [
                        'min-width' => $menu == 'tablet' ? '1025px' : '768px',
                        'selector'  => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu.atom-menu-default .menu > li > a, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu.atom-menu-dark .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-search-expand',
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_color',
                    'title'         => __('Link Color Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [
                        'min-width' => $menu == 'tablet' ? '1025px' : '768px',
                        'selector'  => '.molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu.atom-menu-default .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-menu.atom-menu-dark .menu > li > a:hover, .molecule-header-top.molecule-header-transparent .molecule-header-atoms .atom-search-expand:hover',
                    ],
                    'default'       => '',
                    'id'            => 'navigation_link_transparent_hover_color',
                    'title'         => __('Link Hover Transparent Header', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'id'            => 'header_colors_submenu',
                    'title'         => __('Submenu Colors', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'navigation_submenu_background', 
                        'navigation_submenu_color',
                        'navigation_submenu_hover_color',
                        'navigation_submenu_hover_background'
                    ]
                ],                
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .sub-menu', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_submenu_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-header-atoms .sub-menu a',
                    'default'       => '',
                    'id'            => 'navigation_submenu_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-header-atoms .sub-menu a:hover',
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_color',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .sub-menu a:hover', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_submenu_hover_background',
                    'title'         => __('Hover Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'id'            => 'header_colors_mobile',
                    'title'         => __('Mobile Menu Colors', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'navigation_background', 
                        'navigation_mobile_link_color',
                        'navigation_mobile_link_hover_color',
                        'navigation_hamburger_normal_color',
                        'navigation_hamburger_normal_hover_color',
                        'navigation_hamburger_transparent_color',
                        'navigation_hamburger_transparent_hover_color'
                    ]
                ],                               
                [
                    'selector'      => ['selector' => '.molecule-header-atoms .menu', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'navigation_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'description'   => __('This color applies to the default mobile menu.', 'waterfall'),
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
                    'title'         => __('Link Color', 'waterfall'),
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
                    'title'         => __('Link Hover Color', 'waterfall'),
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
                ]
            ]              
        ],   
        'content' => [
            'id'            => 'colors_main_content',
            'title'         => __('Content Colors', 'waterfall'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_title_header',
                    'title'         => __('Title Section', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'title_section',
                        'title_section_title',
                        'title_section_text',
                        'title_section_link',
                        'title_section_link_hover',
                        'title_section_meta',
                        'title_section_featured_background_color',
                    ]
                ],                                    
                [
                    'selector'      => ['selector' => '.main-header', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'title_section',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6',
                    'default'       => '',
                    'id'            => 'title_section_title',
                    'title'         => __('Title Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header',
                    'default'       => '',
                    'id'            => 'title_section_text',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-header a',
                    'default'       => '',
                    'id'            => 'title_section_link',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-header a:hover',
                    'default'       => '',
                    'id'            => 'title_section_link_hover',
                    'title'         => __('Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => '.main-header .entry-meta a, .main-header .entry-time, .main-header .entry-meta i, .main-header .entry-meta ',
                    'default'       => '',
                    'id'            => 'title_section_meta',
                    'title'         => __('Meta Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-header.components-image-background .entry-meta, .main-header.components-image-background .entry-meta a, .main-header.components-image-background .entry-meta i, .main-header.components-image-background .entry-time, .main-header.components-image-background a, .main-header.components-image-background a:hover, .main-header.components-image-background, .main-header.components-image-background h1, .main-header.components-image-background h2, .main-header.components-image-background h3, .main-header.components-image-background h4, .main-header.components-image-background h5, .main-header.components-image-background h6',
                    'default'       => '',
                    'id'            => 'title_section_featured_background_color',
                    'title'         => __('Text Color with Image Background', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_content_header',
                    'title'         => __('Main Content', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_main',
                        'content_main_title',
                        'content_main_text',
                        'content_main_link',
                        'content_main_link_hover'
                    ]                    
                ],                                       
                [
                    'selector'      => ['selector' => '.main-content', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_main',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content h1, .main-content h2, .main-content h3, .main-content h4, .main-content h5, .main-content h6',
                    'default'       => '',
                    'id'            => 'content_main_title',
                    'title'         => __('Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content',
                    'default'       => '',
                    'id'            => 'content_main_text',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-content a',
                    'default'       => '',
                    'id'            => 'content_main_link',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-content a:hover',
                    'default'       => '',
                    'id'            => 'content_main_link_hover',
                    'title'         => __('Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'id'            => 'colors_main_sidebar_content_header',
                    'title'         => __('Main Sidebar', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_sidebar_color',
                        'content_sidebar_title_color',
                        'content_sidebar_background',
                        'content_sidebar_link_color',
                        'content_sidebar_link_color_hover'
                    ]                    
                ],                 
                [
                    'selector'      => '.main-sidebar',
                    'default'       => '',
                    'id'            => 'content_sidebar_color',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-sidebar h1, .main-sidebar h2, .main-sidebar h3, .main-sidebar h4, .main-sidebar h5, .main-sidebar h6',
                    'default'       => '',
                    'id'            => 'content_sidebar_title_color',
                    'title'         => __('Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => ['selector' => '.main-sidebar', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_sidebar_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-sidebar a',
                    'default'       => '',
                    'id'            => 'content_sidebar_link_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.main-sidebar a:hover',
                    'default'       => '',
                    'id'            => 'content_sidebar_link_color_hover',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                                
                [
                    'default'       => '',
                    'id'            => 'colors_main_content_related_header',
                    'title'         => __('Related Section', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_related',
                        'content_related_title',
                        'content_related_text',
                        'content_related_link',
                        'content_related_link_hover',
                        'content_related_posts_link',
                        'content_related_posts_link_hover',
                        'content_related_posts_featured_link',
                        'content_related_posts_featured_link_hover'
                    ]                    
                ],                                
                [
                    'selector'      => ['selector' => '.main-related', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_related',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related h1, .main-related h2, .main-related h3, .main-related h4, .main-related h5, .main-related h6',
                    'default'       => '',
                    'id'            => 'content_related_title',
                    'title'         => __('Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related',
                    'default'       => '',
                    'id'            => 'content_related_text',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-related a',
                    'default'       => '',
                    'id'            => 'content_related_link',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-related a:hover',
                    'default'       => '',
                    'id'            => 'content_related_link_hover',
                    'title'         => __('Link Hover Color', 'waterfall'),
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
                    'title'         => __('Content Footer', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'content_footer',
                        'content_footer_title',
                        'content_footer_text',
                        'content_footer_link',
                        'content_footer_link_hover'
                    ]                    
                ],                                   
                [
                    'selector'     => ['selector' => '.main-footer', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'content_footer',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                      
                [
                    'selector'      => '.main-footer h1, .main-footer h2, .main-footer h3, .main-footer h4, .main-footer h5, .main-footer h6',
                    'default'       => '',
                    'id'            => 'content_footer_title',
                    'title'         => __('Title Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-footer',
                    'default'       => '',
                    'id'            => 'content_footer_text',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],     
                [
                    'selector'      => '.main-footer a',
                    'default'       => '',
                    'id'            => 'content_footer_link',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.main-footer a:hover',
                    'default'       => '',
                    'id'            => 'content_footer_link_hover',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]
            ]              
        ],   
        'footer' => [
            'id'            => 'colors_footer',
            'title'         => __('Footer Colors', 'waterfall'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'id'            => 'colors_footer_sidebars_heading',
                    'title'         => __('Footer Widget Section', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'footer_background',
                        'footer_background_image',
                        'footer_text_color',
                        'footer_title_color',
                        'footer_link_color',
                        'footer_link_hover_color'
                    ]                    
                ],                                   
                [
                    'selector'      => ['selector' => '.molecule-footer-sidebars', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'footer_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_background_image',
                    'title'         => __('Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ],
                [
                    'selector'      => '.molecule-footer-sidebars',
                    'default'       => '',
                    'id'            => 'footer_text_color',
                    'title'         => __('Text Color', 'waterfall'),
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
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => '.molecule-footer-sidebars a:hover',
                    'default'       => '',
                    'id'            => 'footer_link_hover_color',
                    'title'         => __('Link Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'id'            => 'colors_footer_socket_heading',
                    'title'         => __('Socket', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'socket_background',
                        'socket_background_image',
                        'socket_text_color',
                        'socket_link_color',
                        'socket_link_hover_color'
                    ]                    
                ],                       
                [
                    'selector'      => ['selector' => '.molecule-footer-socket', 'property' => 'background-color'],
                    'default'       => '',
                    'id'            => 'socket_background',
                    'title'         => __('Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_background_image',
                    'title'         => __('Background Image', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'image'
                ],
                [
                    'selector'      => '.molecule-footer-socket',
                    'default'       => '',
                    'id'            => 'socket_text_color',
                    'title'         => __('Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'selector'      => '.molecule-footer-socket a',
                    'default'       => '',
                    'id'            => 'socket_link_color',
                    'title'         => __('Link Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.molecule-footer-socket a:hover',
                    'default'       => '',
                    'id'            => 'socket_link_hover_color',
                    'title'         => __('Link Hover', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'id'            => 'colors_footer_scroll_heading',
                    'title'         => __('Scroll Button Colors', 'waterfall'),
                    'type'          => 'heading',
                    'choices'       => [
                        'scroll_top_color',
                        'scroll_top_hover_color',
                        'scroll_top_background',
                        'scroll_top_background_hover'
                    ]                    
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
        'buttons' => [
            'id'            => 'colors_buttons',
            'title'         => __('Button & Form Colors', 'waterfall'),
            'fields'    => [                      
                [
                    'selector'     => [ 
                        'selector' => 'input[type=\'submit\'], input[type=\'submit\'].button, .wp-block-file .wp-block-file__button, .wp-block-button__link, .atom-button.components-default-background, .atom-button.primary, .header .atom-cart button.button.alt, .header .atom-cart input.button.alt, .header .atom-cart a.button.alt, .header .atom-cart a.button.checkout, .elementor-field-type-submit .elementor-button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce button.button.alt.disabled, .elementor-element .elementor-field-type-submit button', 
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
                        'selector' => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .wp-block-file .wp-block-file__button:hover, .wp-block-button__link:hover, .atom-button.components-default-background:hover, .atom-button.primary:hover, .header .atom-cart button.button.alt:hover, .header .atom-cart input.button.alt:hover, .header .atom-cart a.button.alt:hover, .header .atom-cart a.button.checkout:hover, .elementor-field-type-submit .elementor-button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt.disabled:hover, .elementor-element .elementor-field-type-submit button:hover',                         
                        'property' => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'primary_button_background_hover',
                    'title'         => __('Primary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => 'input[type=\'submit\'], input[type=\'submit\'].button, .wp-block-file .wp-block-file__button, .wp-block-button__link, .atom-button.components-default-background, .atom-button.primary, .header .atom-cart button.button.alt, .header .atom-cart input.button.alt, .header .atom-cart a.button.alt, .header .atom-cart a.button.checkout, .elementor-field-type-submit .elementor-button, .elementor-element.elementor-button-danger .elementor-button, .woocommerce input.button.alt, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce button.button.alt.disabled, .elementor-field-type-submit button', 
                    'default'       => '',
                    'id'            => 'primary_button_color',
                    'title'         => __('Primary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => 'input[type=\'submit\']:hover, input[type=\'submit\'].button:hover, .wp-block-file .wp-block-file__button:hover, .wp-block-button__link:hover, .atom-button.components-default-background:hover, .atom-button.primary:hover, .header .atom-cart button.button.alt:hover, .header .atom-cart input.button.alt:hover, .header .atom-cart a.button.alt:hover, .header .atom-cart a.button.checkout:hover, .elementor-field-type-submit .elementor-button:hover, .elementor-element.elementor-button-danger .elementor-button:hover, .woocommerce input.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt.disabled:hover, .elementor-field-type-submit button:hover',                         
                    'default'       => '',
                    'id'            => 'primary_button_color_hover',
                    'title'         => __('Primary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => [ 
                        'selector'  => '.atom-button, .atom-button.secondary, .elementor-element .elementor-button, .header .atom-cart input.button, .header .atom-cart button.button, .header .atom-cart a.button, .woocommerce input.button,  .woocommerce input[type=\'submit\'].button, .woocommerce button.button, .woocommerce a.button, .woocommerce #respond input#submit',
                        'property'  => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'secondary_button_background',
                    'title'         => __('Secondary Button Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => [ 
                        'selector'  => '.atom-button:hover, .atom-button.secondary:hover, .elementor-element .elementor-button:hover, .header .atom-cart input.button:hover, .header .atom-cart button.button:hover, .header .atom-cart a.button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover, .woocommerce button.button:hover, .woocommerce a.button:hover, .woocommerce #respond input#submit:hover',
                        'property'  => 'background-color' 
                    ],
                    'default'       => '',
                    'id'            => 'secondary_button_background_hover',
                    'title'         => __('Secondary Button Background Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],    
                [
                    'selector'      => '.atom-button, .atom-button.secondary, .elementor-element .elementor-button, .header .atom-cart input.button, .header .atom-cart button.button, .header .atom-cart a.button, .woocommerce input.button,  .woocommerce input[type=\'submit\'].button, .woocommerce button.button, .woocommerce a.button, .woocommerce #respond input#submit',
                    'default'       => '',
                    'id'            => 'secondary_button_color',
                    'title'         => __('Secondary Button Text Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'selector'      => '.atom-button:hover, .atom-button.secondary:hover, .elementor-element .elementor-button:hover, .header .atom-cart input.button:hover, .header .atom-cart button.button:hover, .header .atom-cart a.button:hover, .woocommerce input.button:hover, .woocommerce input[type=\'submit\'].button:hover, .woocommerce button.button:hover, .woocommerce a.button:hover, .woocommerce #respond input#submit:hover',
                    'default'       => '',
                    'id'            => 'secondary_button_color_hover',
                    'title'         => __('Secondary Button Text Hover Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],                
                [
                    'default'       => '',
                    'selector'      => [
                        'selector'  => 'input:not([type=\'submit\']), input:not([type=\'reset\']), input:not([type=\'button\']), input:not([type=\'range\']), select, textarea, .elementor-form .elementor-field-group .elementor-field-textual, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text', 
                        'property'  => 'border-color'
                    ],
                    'id'            => 'form_border_color',
                    'title'         => __('Form Field Border Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ], 
                [
                    'default'       => '',
                    'selector'      => 'input:not([type=\'submit\']), input:not([type=\'reset\']), input:not([type=\'button\']), input:not([type=\'range\']), input:not([type=\'checkbox\']), input:not([type=\'radio\']), select, textarea, .elementor-form .elementor-field-group .elementor-field-textual', 
                    'id'            => 'form_text_color',
                    'title'         => __('Form Field Text Colors', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ],
                [
                    'default'       => '',
                    'selector'      => [
                        'selector'  => 'input:not([type=\'submit\']), input:not([type=\'reset\']), input:not([type=\'button\']), input:not([type=\'range\']), input:not([type=\'checkbox\']), input:not([type=\'radio\']), select, textarea, .elementor-form .elementor-field-group .elementor-field-textual', 
                        'property'  => 'background-color'
                    ],
                    'id'            => 'form_background_color',
                    'title'         => __('Form Field Background Color', 'waterfall'),
                    'transport'     => 'postMessage',
                    'type'          => 'colorpicker'
                ]                     
            ]
        ]     
    ]
];

/**
 * Conditional settings. 
 * If some areas are designed by elementor, their display is conditional
 */
foreach(['header' => __('Header', 'waterfall'), 'footer' => __('Footer', 'waterfall')] as $part => $label ) {
    
    if( ! wf_elementor_theme_has_location($part) ) {
        continue;
    }

    $colors['sections'][$part]['fields'] = [
        [
            'id'            => 'colors_' . $part . '_elementor',
            'description'   => sprintf( __('The %s is designed by the Elementor Theme Builder. Thus, no settings are shown here.', 'waterfall'), $label ),
            'title'         => __('Designed by Elementor', 'waterfall'),
            'type'          => 'heading'
        ] 
    ]; 

}

/**
 * Look if one of the post types is designed and give a warning accordingly.
 */
$types = wf_get_post_types(true, true);

foreach( $types as $type => $label ) {
    if( wf_elementor_theme_has_location('single', $type) || wf_elementor_theme_has_location('archive', $type) ) {
        array_unshift(
            $colors['sections']['content']['fields'], 
            [
                'id'            => 'colors_content_elementor',
                'description'   => sprintf( __('One or more pages are designed by the Elementor Theme Builder. Color settings thus may not apply to all pages.', 'waterfall'), $label ),
                'title'         => __('Elementor Notification', 'waterfall'),
                'type'          => 'heading'
            ]             
        );
        break;
    }
}

/**
 * If WooCommerce is installed, some additional colors may be adjusted
 */
if( class_exists('WooCommerce') ) {

    $colors['sections']['woocommerce'] = [
        'id'            => 'colors_woocommerce',
        'title'         => __('WooCommerce Colors', 'waterfall'),
        'fields'    => [ 
            // [
            //     'selector'      => ['selector' => '.atom-scroll.waterfall-scroll-top:hover', 'property' => 'background-color'],
            //     'default'       => '',
            //     'id'            => 'scroll_top_background_hover',
            //     'title'         => __('Scroll to Top Background Hover Color', 'waterfall'),
            //     'transport'     => 'postMessage',
            //     'type'          => 'colorpicker'
            // ]
            [
                'default'       => '',
                'id'            => 'colors_woocommerce_cart_header',
                'title'         => __('Cart', 'waterfall'),
                'type'          => 'heading',
                'choices'       => [
                    'colors_woocommerce_cart_icon',
                    'colors_woocommerce_cart_count',
                    'colors_woocommerce_cart_count_background'
                ]                    
            ],
            [
                'selector'      => '.atom-cart-icon, .atom-cart-icon:hover',
                'default'       => '',
                'id'            => 'colors_woocommerce_cart_icon',
                'title'         => __('Cart Icon Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],            
            [
                'selector'      => '.atom-cart-count',
                'default'       => '',
                'id'            => 'colors_woocommerce_cart_count',
                'title'         => __('Cart Count Text Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => ['selector' => '.atom-cart-count', 'property' => 'background-color'],
                'default'       => '',
                'id'            => 'colors_woocommerce_cart_count_background',
                'title'         => __('Cart Count Background Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                           
            [
                'default'       => '',
                'id'            => 'colors_woocommerce_product_header',
                'title'         => __('Products', 'waterfall'),
                'type'          => 'heading',
                'choices'       => [
                    'colors_woocommerce_price',
                    'colors_woocommerce_price_shop',
                    'colors_woocommerce_onsale',
                    'colors_woocommerce_onsale_background',
                    'colors_woocommerce_stars'
                ]                    
            ],            
            [
                'selector'      => '.woocommerce div.product p.price',
                'default'       => '',
                'id'            => 'colors_woocommerce_price',
                'title'         => __('Single Product Price Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce ul.products li.product .price',
                'default'       => '',
                'id'            => 'colors_woocommerce_price_shop',
                'title'         => __('Shop Price Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],            
            [
                'selector'      => '.woocommerce span.onsale',
                'default'       => '',
                'id'            => 'colors_woocommerce_onsale',
                'title'         => __('On Sale Badge Text Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => ['selector' => '.woocommerce span.onsale', 'property' => 'background-color'],
                'default'       => '',
                'id'            => 'colors_woocommerce_onsale_background',
                'title'         => __('On Sale Badge Background Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                        
            [
                'selector'      => '.woocommerce .stars a',
                'default'       => '',
                'id'            => 'colors_woocommerce_stars',
                'title'         => __('Product Rating Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                         
            [
                'default'       => '',
                'id'            => 'colors_woocommerce_message_header',
                'title'         => __('Messages', 'waterfall'),
                'type'          => 'heading',
                'choices'       => [
                    'colors_woocommerce_message_accent',
                    'colors_woocommerce_message_text',
                    'colors_woocommerce_message_link',
                    'colors_woocommerce_message_background',
                    'colors_woocommerce_info_accent',
                    'colors_woocommerce_info_text',
                    'colors_woocommerce_info_link',
                    'colors_woocommerce_info_background',
                    'colors_woocommerce_error_accent',
                    'colors_woocommerce_error_text',
                    'colors_woocommerce_error_link',
                    'colors_woocommerce_error_background'
                ]                    
            ],            
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-message, .woocommerce .woocommerce-message:before', 'property' => ['border-top-color', 'color']],
                'default'       => '',
                'id'            => 'colors_woocommerce_message_accent',
                'title'         => __('General Message Accent Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce .woocommerce-message',
                'default'       => '',
                'id'            => 'colors_woocommerce_message_text',
                'title'         => __('General Message Text Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ], 
            [
                'selector'      => '.woocommerce .woocommerce-message a:not(.button)',
                'default'       => '',
                'id'            => 'colors_woocommerce_message_link',
                'title'         => __('General Message Link Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                         
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-message', 'property' => 'background-color'],
                'default'       => '',
                'id'            => 'colors_woocommerce_message_background',
                'title'         => __('General Message Background Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-info, .woocommerce .woocommerce-info:before', 'property' => ['border-top-color', 'color']],
                'default'       => '',
                'id'            => 'colors_woocommerce_info_accent',
                'title'         => __('Info Message Accent Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce .woocommerce-info',
                'default'       => '',
                'id'            => 'colors_woocommerce_info_text',
                'title'         => __('Info Message Text Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce .woocommerce-info a:not(.button)',
                'default'       => '',
                'id'            => 'colors_woocommerce_info_link',
                'title'         => __('Info Message Link Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                         
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-info', 'property' => 'background-color'],
                'default'       => '',
                'id'            => 'colors_woocommerce_info_background',
                'title'         => __('Info Message Background Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-error, .woocommerce .woocommerce-error:before', 'property' => ['border-top-color', 'color']],
                'default'       => '',
                'id'            => 'colors_woocommerce_error_accent',
                'title'         => __('Error Message Accent Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce .woocommerce-error',
                'default'       => '',
                'id'            => 'colors_woocommerce_error_text',
                'title'         => __('Error Message Text Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],
            [
                'selector'      => '.woocommerce .woocommerce-error a:not(.button)',
                'default'       => '',
                'id'            => 'colors_woocommerce_error_link',
                'title'         => __('Error Message Link Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ],                         
            [
                'selector'      => ['selector' => '.woocommerce .woocommerce-error', 'property' => 'background-color'],
                'default'       => '',
                'id'            => 'colors_woocommerce_error_background',
                'title'         => __('Error Message Background Color', 'waterfall'),
                'transport'     => 'postMessage',
                'type'          => 'colorpicker'
            ]                        
        ]
    ];    

}