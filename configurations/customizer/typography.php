<?php
/**
 * Adds typography customizer panel
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$typography = [
    'description'   => __('Adjust the typography at various locations here.', 'waterfall'),
    'id'            => 'waterfall_typography',
    'title'         => __('Typography', 'waterfall'),
    'panel'         => true,
    'priority'      => 20,
    'sections'      => [
        'general_typography' => [
            'id'            => 'general_typography',
            'title'         => __('General', 'waterfall'),
            'fields'    => [                   
                [
                    'default'       => '',
                    'selector'      => 'body',
                    'id'            => 'body_typography',
                    'title'         => __('General Font', 'waterfall'),
                    'type'          => 'typography'
                ],               
                [
                    'default'       => '',
                    'selector'      => '.molecule-header-atoms .atom-menu',
                    'id'            => 'header_menu_typography',
                    'title'         => __('Header Navigation Menu', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => '.atom-breadcrumbs, .main-header .atom-breadcrumbs',
                    'id'            => 'breadcrumbs_typography',
                    'title'         => __('Breadcrumbs', 'waterfall'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => '.main-header .atom-description',
                    'id'            => 'subtitle_typography',
                    'title'         => __('Subtitle Typography', 'waterfall'),
                    'description'   => __('Determines the typography for subtitles in posts and pages.', 'waterfall'),
                    'type'          => 'typography'
                ],                                
                [
                    'default'       => '',
                    'selector'      => '.main-content',
                    'id'            => 'content_typography',
                    'title'         => __('Main Content', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => '.entry-meta',
                    'id'            => 'meta_typography',
                    'title'         => __('Meta', 'waterfall'),
                    'description'   => __('Meta are secondary text blocks such as the date and category of a post.', 'waterfall'),
                    'type'          => 'typography'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.widget',
                    'id'            => 'widget_typography',
                    'title'         => __('Widgets', 'waterfall'),
                    'description'   => __('Determines the typography for widgets.', 'waterfall'),
                    'type'          => 'typography'
                ],                               
                [
                    'default'       => '',
                    'selector'      => 'blockquote',
                    'id'            => 'blockquote_typography',
                    'title'         => __('Blockquotes', 'waterfall'),
                    'type'          => 'typography'
                ]                
            ]              
        ], 
        'headings_typography' => [
            'id'            => 'headings_typography',
            'title'         => __('General Headings', 'waterfall'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'selector'      => 'h1, h2, h3, h4, h5, h6',
                    'columns'       => 'third',
                    'id'            => 'heading16_typography',
                    'title'         => __('All Headings', 'waterfall'),
                    'type'          => 'typography'
                ],
                [
                    'default'       => '',
                    'selector'      => 'h1',
                    'columns'       => 'third',
                    'id'            => 'heading1_typography',
                    'title'         => __('Heading 1', 'waterfall'),
                    'type'          => 'typography'
                ],               
                [
                    'default'       => '',
                    'selector'      => 'h2',
                    'columns'       => 'third',
                    'id'            => 'heading2_typography',
                    'title'         => __('Heading 2', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => 'h3',
                    'columns'       => 'third',
                    'id'            => 'heading3_typography',
                    'title'         => __('Heading 3', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => 'h4',
                    'columns'       => 'third',
                    'id'            => 'heading4_typography',
                    'title'         => __('Heading 4', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => 'h5',
                    'columns'       => 'third',
                    'id'            => 'heading5_typography',
                    'title'         => __('Heading 5', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => 'h6',
                    'columns'       => 'third',
                    'id'            => 'heading6_typography',
                    'title'         => __('Heading 6', 'waterfall'),
                    'type'          => 'typography'
                ]                                                  
            ]
        ],                
        'headings_typography_specific' => [
            'id'            => 'headings_typography_specific',
            'title'         => __('Specific Headings', 'waterfall'),
            'fields'    => [                                 
                [
                    'default'       => '',
                    'selector'      => 'h1.page-title, .page h1.entry-title',
                    'id'            => 'page_heading_typography',
                    'title'         => __('Page Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in pages, 404 pages and archives.', 'waterfall'),
                    'type'          => 'typography'
                ],               
                [
                    'default'       => '',
                    'selector'      => '.single h1.entry-title',
                    'id'            => 'post_heading_typography',
                    'title'         => __('Post Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in post articles.', 'waterfall'),
                    'type'          => 'typography'
                ],               
                [
                    'default'       => '',
                    'selector'      => '.single-product h1.product_title',
                    'id'            => 'product_heading_typography',
                    'title'         => __('Product Title Headings', 'waterfall'),
                    'description'   => __('Determines the typography for headings in products.', 'waterfall'),
                    'type'          => 'typography'
                ],              
                [
                    'default'       => '',
                    'selector'      => '.widget-title',
                    'id'            => 'widget_title_typography',
                    'title'         => __('Widget Titles', 'waterfall'),
                    'description'   => __('Determines the typography for widget headings.', 'waterfall'),
                    'type'          => 'typography'
                ],                              
                [
                    'default'       => '',
                    'selector'      => '.main-related .related-title',
                    'id'            => 'related_title_typography',
                    'title'         => __('Related Post Title', 'waterfall'),
                    'description'   => __('Determines the typography for the title above related posts.', 'waterfall'),
                    'type'          => 'typography'
                ], 
                [
                    'default'       => '',
                    'selector'      => '.molecule-post .entry-title',
                    'id'            => 'post_title_typography',
                    'title'         => __('Post Grid and List Titles', 'waterfall'),
                    'description'   => __('Determines the typography for the titles for posts in archives, related posts and more.', 'waterfall'),
                    'type'          => 'typography'
                ],                                                                               
            ]              
        ],        
        'footer_typography' => [
            'id'            => 'footer_typography',
            'title'         => __('Footer', 'waterfall'),
            'fields'    => [                   
                [
                    'default'       => '',
                    'selector'      => '.molecule-footer-sidebars, .molecule-footer-sidebars .widget',
                    'id'            => 'footer_typography',
                    'title'         => __('Footer Widgets', 'waterfall'),
                    'type'          => 'typography'
                ],                
                [
                    'default'       => '',
                    'selector'      => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6, .footer .widget-title',
                    'id'            => 'footer_titles',
                    'title'         => __('Footer Titles', 'waterfall'),
                    'type'          => 'typography'
                ],              
                [
                    'default'       => '',
                    'selector'      => '.molecule-footer-socket',
                    'id'            => 'socket_typography',
                    'title'         => __('Socket Content', 'waterfall'),
                    'type'          => 'typography'
                ],              
                [
                    'default'       => '',
                    'selector'      => '.molecule-footer-socket .atom-menu',
                    'id'            => 'socket_menu_typography',
                    'title'         => __('Socket Navigation Menu', 'waterfall'),
                    'type'          => 'typography'
                ]               
            ]              
        ]
    ]
];


/**
 * Conditional configurations based on our elementor settings
 */
if( wf_elementor_theme_has_location('header') ) {
    foreach([1,3,4,5] as $key) {
        unset($typography['sections']['general_typography']['fields'][$key]);
    }
}

if( wf_elementor_theme_has_location('footer') ) {
    unset($typography['sections']['footer_typography']);
}