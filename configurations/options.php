<?php
/**
 * Loads our option configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Default posts types supported in customzer
$defaultPosts = ['post', 'page'];
if( class_exists('Waterfall_Reviews\Plugin') ) {
    $defaultPosts[] = 'reviews';
}
if( class_exists('Waterfall_Events\Plugin') ) {
    $defaultPosts[] = 'events';   
}

// The options
$options = [
    'capability'    => 'manage_options',
    'class'         => 'tabs-left',
    'id'            => 'waterfall_options',
    'location'      => 'menu', 
    'menu_icon'     => 'dashicons-admin-generic',
    'menu_title'    => __('Waterfall', 'waterfall'),
    'menu_position' => 60,
    'title'         => __('Waterfall Theme Settings', 'waterfall'),
    'sections'      => [
        'general'   => [
            'icon'          => 'settings',
            'id'            => 'general',
            'title'         => __('General', 'waterfall'),
            'description'   => __('The general settings for the theme. Are you looking for lay-out options? Those can be found in the Customizer.', 'waterfall'),
            'fields'        => [ 
                [
                    'columns'       => 'half',
                    'default'       => $defaultPosts,
                    'description'   => __('For these post types, lay-out settings will be available in the customizer, and a sidebar under widgets.', 'waterfall'),
                    'id'            => 'customizer_post_types',
                    'options'       => wf_get_post_types(true),
                    'title'         => __('Customizer Post Types', 'waterfall'),
                    'multiple'      => true,
                    'type'          => 'select'
                ],
                [
                    'columns'       => 'half',
                    'description'   => __('Enable this to Enable ElasticPress for Related Posts. ElasticSearch and the ElasticPress plugin are required.', 'waterfall'),
                    'id'            => 'enable_elastic_related',
                    'title'         => __('Enable ElasticPress for Related Posts', 'waterfall'),
                    'single'        => true,
                    'type'          => 'checkbox',
                    'style'         => 'switcher switcher-enable',
                    'options'       => [
                        'enable' => ['label' => __('Enable ElasticPress', 'waterfall')],
                    ]
                ],   
                [
                    'default'       => '',
                    'id'            => 'integrations_heading',
                    'title'         => __('Integrations', 'waterfall'),
                    'type'          => 'heading'
                ],                                                
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This set-ups the correct script for loading Google Analytics. The Tracking ID should have a format of UA-000000-01.', 'waterfall'),
                    'id'            => 'analytics',
                    'title'         => __('Google Analytics Tracking ID', 'waterfall'),
                    'type'          => 'input'
                ], 
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This allows extensions of Waterfall to properly display Google Maps.', 'waterfall'),
                    'id'            => 'maps_api_key',
                    'title'         => __('Google Maps API Key', 'waterfall'),
                    'type'          => 'input'
                ],
                [
                    'default'       => '',
                    'description'   => __('Paste your token here to set-up CloudFlare Web Analytics. You can retrieve it from the JS Snippet.', 'waterfall'),
                    'id'            => 'cf_analytics',
                    'title'         => __('CloudFlare Analytics Token', 'waterfall'),
                    'type'          => 'input'
                ],                
                [
                    'default'       => '',
                    'id'            => 'structured_data_heading',
                    'title'         => __('Structured Data', 'waterfall'),
                    'type'          => 'heading'
                ],                                                                                   
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This determines what structured data is used for the website logo, usually representing the organization. Select none to discard.', 'waterfall'),
                    'id'            => 'represent_scheme',
                    'options'       => [
                        ''             => __('None', 'waterfall'),
                        'organization' => __('Organization', 'waterfall'),
                        'person'       => __('Person', 'waterfall')
                    ],
                    'title'         => __('Structured data for Website Representation', 'waterfall'),
                    'type'          => 'select'
                ],              
                [
                    'columns'       => 'half',
                    'default'       => [],
                    'description'   => __('This removes the Structured data for the selected post types.', 'waterfall'),
                    'id'            => 'scheme_post_types_disable',
                    'options'       => wf_get_post_types(true),
                    'title'         => __('Disable Microdata', 'waterfall'),
                    'multiple'      => true,
                    'type'          => 'select'
                ]
            ]
        ],
        'advanced'   => [
            'icon'          => 'autorenew',
            'id'            => 'advanced',
            'title'         => __('Advanced', 'waterfall'),
            'description'   => __('Advanced theme settings', 'waterfall'),
            'fields'        => [                  
                [
                    'action'        => 'sync_multisite_options',
                    'description'   => __('This function synchronizes Waterfall Customizer and Option settings for all the sites registered in a multisite network. It will use the options of the current site.', 'waterfall'),
                    'id'            => 'sync_settings',
                    'label'         => __('Synchronize', 'waterfall'),
                    'message'       => true,
                    'title'         => __('Synchronize Settings', 'waterfall'),
                    'type'          => 'button'
                ],
                [
                    'default'       => '',
                    'description'   => __('Improve the loading performance by enabling optimizations. Be aware that some optimizations can break functionality.', 'waterfall'),
                    'id'            => 'optimize',
                    'options'       => [
                        'defer_CSS'                 => ['label' => __('Defer CSS', 'waterfall')],
                        'defer_JS'                  => ['label' => __('Defer Javascript Loading', 'waterfall')],
                        'disable_theme_editor'      => ['label' => __('Disable Theme and Plugin Editor', 'waterfall')],
                        'disable_block_styling'     => ['label' => __('Disable Block Styling', 'waterfall')],
                        'disable_emoji'             => ['label' => __('Disable Emoji', 'waterfall')],
                        'disable_feeds'             => ['label' => __('Disable Feeds', 'waterfall')],
                        'disable_heartbeat'         => ['label' => __('Disable Heartbeat', 'waterfall')],
                        'slow_heartbeat'            => ['label' => __('Slow Down Heartbeat Script', 'waterfall')],
                        'jquery_to_footer'          => ['label' => __('Move the jQuery Script to Footer', 'waterfall')],
                        'disable_jquery'            => ['label' => __('Disable jQuery', 'waterfall')],
                        'disable_jquery_migrate'    => ['label' => __('Disable jQuery Migrate', 'waterfall')],
                        'disable_RSD'               => ['label' => __('Disable RSD', 'waterfall')],
                        'disable_shortlinks'        => ['label' => __('Disable WordPress Shortlinks', 'waterfall')],                      
                        'disable_version_numbers'   => ['label' => __('Remove WordPress Version Numbers from Scripts', 'waterfall')],            
                        'disable_WLW_manifest'      => ['label' => __('Disable the WLW Manifest', 'waterfall')],
                        'disable_WP_version'        => ['label' => __('Remove the WordPress version from front-end', 'waterfall')],           
                        'limit_revisions'           => ['label' => __('Limit Post Revisions to 5', 'waterfall')],
                        'disable_comments'          => ['label' => __('Disable Comments', 'waterfall')],                      
                        'limit_comments_JS'         => ['label' => __('Enqueue Comment JavaScript only on Comments', 'waterfall')],
                        'remove_comments_style'     => ['label' => __('Remove Additional Styling for Comments', 'waterfall')],
                        'disable_embed'             => ['label' => __('Disable Embed Scripts (breaks video embedding).', 'waterfall')],
                        'disable_XMLRPC'            => ['label' => __('Disable XMLRPC (can break some functionalities)', 'waterfall')],                        
                        'block_external_HTTP'       => ['label' => __('Block external HTTP Requests (breaks external embeds and many plugins).', 'waterfall')],
                    
                    ],
                    'title'         => __('Theme Optimizations', 'waterfall'),
                    'type'          => 'checkbox'
                ]                
            ]
        ]        
    ] 
];