<?php
/**
 * Loads our postmeta configurations
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

/**
 * All custom post types receive these metaboxes
 */
$post_types = [];
foreach( wf_get_post_types(true) as $type => $label ) {
    $post_types[] = $type;
}

/**
 * If the Events Calendar is Active, it will support some metaboxes
 */
if( class_exists('Tribe__Events__Main') ) {
    $post_types[] = 'tribe_events';
}

// No metaboxes will be added if no post type is supported
if( ! $post_types ) {
    $postmeta = [];
    return;
}

/**
 * Our array with configurations
 */
$postmeta = [
    'context'       => 'normal',
    'id'            => 'waterfall_meta',
    'priority'      => 'high',
    'title'         => __('Custom Fields', 'waterfall'),
    'type'          => 'post',
    'screen'        => $post_types,
    'sections'      => [
        'layout' => [
            'icon'      => 'web_asset',
            'id'        => 'footer',
            'title'     => __('Layout', 'waterfall'),
            'fields'    => [ 
                [
                    'columns'       => 'fourth',
                    'default'       => '',
                    'id'            => 'content_width',
                    'title'         => __('Fullwidth Main Content', 'waterfall'),
                    'description'   => __('Makes the main content fullwidth without any padding and sidebars. Useful if using page-builders.', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher',
                    'options'       => [ 
                        'full' => ['label' => __('Enable Fullwidth Content', 'waterfall')]
                    ]
                    ],   
                [
                    'columns'       => 'fourth',
                    'default'       => '',
                    'description'   => __('Give this post or page a transparent header.', 'waterfall'),
                    'id'            => 'transparent_header',
                    'title'         => __('Header Transparency', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher',
                    'options'   => [ 
                        'transparent' => ['label' => __('Enable Transparent Header', 'waterfall')]
                    ]
                ],   
                [
                    'columns'       => 'fourth',
                    'description'   => __('The Header is the main header of the site, usually containing the main navigation.', 'waterfall'),
                    'id'            => 'header_disable',
                    'title'         => __('Disable Header', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'   => [ 
                        'disable' => [ 'label' => __('Disable the header', 'waterfall') ]
                    ]
                ],
                [
                    'columns'       => 'fourth',
                    'description'   => __('The Footer is the main footer of the site, usually containing widgets, copyright and more.', 'waterfall'),
                    'id'            => 'footer_disable',
                    'title'         => __('Disable Footer', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'   => [ 
                        'disable' => ['label' => __('Disable the footer', 'waterfall')]
                    ]
                ],    
                'content_header_disable' => [
                    'columns'       => 'fourth',
                    'description'   => __('The Title Section usually shows elements such as the title, the featured image and so forth.', 'waterfall'),
                    'id'            => 'content_header_disable',
                    'title'         => __('Disable Title Section', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'       => [ 
                        'disable' => ['label' => __('Disable title section', 'waterfall')] 
                    ]
                ],
                'content_sidebar_disable' => [
                    'columns'       => 'fourth',
                    'description'   => __('The sidebar is usually shown left or right of your pages.', 'waterfall'),
                    'id'            => 'content_sidebar_disable',
                    'title'         => __('Disable Sidebar', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'       => [ 
                        'disable' => [ 'label' => __('Disable sidebar', 'waterfall') ] 
                    ]
                ],                
                'content_related_disable' => [
                    'columns'       => 'fourth',
                    'description'   => __('The Related Section usually contains related posts and post navigation.', 'waterfall'),
                    'id'            => 'content_related_disable',
                    'title'         => __('Disable Related Section', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'       => [ 
                        'disable' => [ 'label' => __('Disable related section', 'waterfall') ] 
                    ]
                ],     
                'content_footer_disable' => [
                    'columns'       => 'fourth',
                    'description'   => __('The Content Footer usually shows elements such as comments, the author and so forth.', 'waterfall'),
                    'id'            => 'content_footer_disable',
                    'title'         => __('Disable Content Footer', 'waterfall'),
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-disable',
                    'options'       => [ 
                        'disable' => [ 'label' => __('Disable page footer', 'waterfall') ] 
                    ]
                ]   
            ]              
        ],    
        'title' => [
            'description' => __('The title section displays your title, featured images, meta information and more.', 'waterfall'),
            'icon'      => 'remove_from_queue',
            'id'        => 'page_header',
            'title'     => __('Title Section', 'waterfall'),
            'fields'    => [  
                [
                    'columns'       => 'half',
                    'id'            => 'page_header_subtitle',
                    'title'         => __('Subtitle', 'waterfall'),
                    'type'          => 'textarea'
                ], 
                [
                    'columns'       => 'half',
                    'description'   => __('Adds additional buttons in the title section.', 'waterfall'),
                    'id'            => 'page_header_buttons',
                    'title'         => __('Buttons', 'waterfall'),
                    'type'          => 'repeatable',
                    'fields'        => [
                        [
                            'columns'       => 'half',
                            'id'            => 'text',
                            'title'         => __('Button Text', 'waterfall'),
                            'description'   => __('Enter the text for the button.', 'waterfall'),
                            'type'          => 'input'
                        ],
                        [
                            'columns'       => 'half',
                            'id'            => 'link',
                            'title'         => __('Button Link', 'waterfall'),
                            'description'   => __('Enter the link for this button here.', 'waterfall'),
                            'type'          => 'input',
                            'subtype'       => 'url',
                        ]
                    ]
                ],                                    
                [
                    'selector'      => '.main-header',
                    'columns'       => 'half',
                    'id'            => 'page_header_background',
                    'multiple'      => false,
                    'title'         => __('Custom Background', 'waterfall'),
                    'type'          => 'background'
                ],     
                [
                    'columns'       => 'fourth',
                    'selector'      => '.main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6, .main-header, .main-header a, .main-header .entry-meta a, .main-header .entry-time',
                    'id'            => 'page_header_color',
                    'title'         => __('Custom Text Color', 'waterfall'),
                    'type'          => 'colorpicker'
                ], 
                [
                    'selector'      => ['property' => 'background-color', 'selector' => '.main-header:after'],
                    'columns'       => 'fourth',
                    'id'            => 'page_header_overlay',
                    'title'         => __('Overlay Color', 'waterfall'),
                    'type'          => 'colorpicker'
                ]    
            ]              
        ]  
    ]
];

/**
 * For the events calendar, certain parts are disabled
 */
if( is_admin() && class_exists('Tribe__Events__Main') ) {

    if( in_array($_SERVER["SCRIPT_NAME"], ['/wp-admin/post.php', '/wp-admin/post-new.php']) ) {
        $tribe = false;

        // Editing a post
        if( isset($_GET['post']) && get_post_type( intval($_GET['post']) ) === 'tribe_events' && isset($_GET['action']) && $_GET['action'] === 'edit' ) {
            $tribe = true;
        }

        // A new post
        if( isset($_GET['post_type']) && $_GET['post_type'] === 'tribe_events' ) {
            $tribe = true;
        }

        if( $tribe ) {
            unset($postmeta['sections']['title']);
            unset($postmeta['sections']['layout']['fields']['content_header_disable']);
            unset($postmeta['sections']['layout']['fields']['content_sidebar_disable']);
            unset($postmeta['sections']['layout']['fields']['content_related_disable']);
            unset($postmeta['sections']['layout']['fields']['content_footer_disable']);
        }

    }
    
}