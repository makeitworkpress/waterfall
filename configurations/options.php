<?php
/**
 * Loads our option configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$options = [
    'capability'    => 'manage_options',
    'class'         => 'tabs-left',
    'id'            => 'waterfall_options',
    'location'      => 'menu', 
    'menu_icon'     => 'dashicons-admin-generic',
    'menu_title'    => __('Waterfall', 'waterfall'),
    'menu_position' => 99,
    'title'         => __('Waterfall Settings', 'waterfall'),
    'sections'      => [
        'general'   => [
            'icon'          => 'settings',
            'id'            => 'general',
            'title'         => __('General Settings', 'waterfall'),
            'description'   => __('The general settings for the theme. Are you looking for lay-out options? Those can be found in the Customizer.', 'waterfall'),
            'fields'        => [                
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This determines what scheme is used, so that Google knows your website is resembling a person or organization.', 'waterfall'),
                    'id'            => 'represent_scheme',
                    'options'       => [
                        'organization' => __('Organization', 'waterfall'),
                        'person'       => __('Person', 'waterfall')
                    ],
                    'title'         => __('Microscheme for Website Representation', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'columns'       => 'half',
                    'default'       => '',
                    'description'   => __('This automatically set-ups the correct JavaScript for loading Google Analytics. The Tracking ID has a format of UA-000000-01.', 'waterfall'),
                    'id'            => 'analytics',
                    'title'         => __('Google Analytics Tracking ID', 'waterfall'),
                    'type'          => 'input'
                ],                 
                [
                    'action'        => 'syncMultiSiteOptions',
                    'description'   => __('This function synchronizes Waterfall Customizer and Option settings for all the sites registered in a multisite network. It will use the options of the current site.', 'waterfall'),
                    'id'            => 'sync_settings',
                    'label'         => __('Synchronize', 'waterfall'),
                    'message'       => true,
                    'title'         => __('Synchronize Settings', 'waterfall'),
                    'type'          => 'button'
                ],
                [
                    'default'       => '',
                    'description'   => __('Improve the loading performance by enabling optimalizations. Be aware that some optimizations such as Disabling the REST API can break plugins.', 'waterfall'),
                    'id'            => 'optimize',
                    'options'       => [
                        'lazyLoad'                  => ['label' => __('Enable Images and Iframe Lazyload', 'waterfall')],
                        'deferCSS'                  => ['label' => __('Defer CSS', 'waterfall')],
                        'deferJS'                   => ['label' => __('Defer Javascript Loading', 'waterfall')],
                        'disableComments'           => ['label' => __('Disable Comments', 'waterfall')],
                        'disableEmbed'              => ['label' => __('Disable Embed Scripts', 'waterfall')],
                        'disableEmoji'              => ['label' => __('Disable Emoji', 'waterfall')],
                        'disableFeeds'              => ['label' => __('Disable Feeds', 'waterfall')],
                        'disableHeartbeat'          => ['label' => __('Disable Heartbeat', 'waterfall')],
                        'slowHeartbeat'             => ['label' => __('Slow Down Heartbeat Script', 'waterfall')],
                        'jqueryToFooter'            => ['label' => __('Move the jQuery Script to Footer', 'waterfall')],
                        'disablejQuery'             => ['label' => __('Disable jQuery', 'waterfall')],
                        'disablejQueryMigrate'      => ['label' => __('Disable jQuery Migrate', 'waterfall')],
                        'disableRestApi'            => ['label' => __('Disable the REST API', 'waterfall')],
                        'disableRSD'                => ['label' => __('Disable RSD', 'waterfall')],
                        'disableShortlinks'         => ['label' => __('Disable WordPress Shortlinks', 'waterfall')],                      
                        'disableVersionNumbers'     => ['label' => __('Remove WordPress Version Numbers from Scripts', 'waterfall')],            
                        'disableWLWManifest'        => ['label' => __('Disable the WLW Manifest', 'waterfall')],
                        'disableWPVersion'          => ['label' => __('Remove the WordPress Version from front-end', 'waterfall')],           
                        'disableXMLRPC'             => ['label' => __('Disable XMLRPC', 'waterfall')],
                        'limitRevisions'            => ['label' => __('Limit Post Revisions to 5', 'waterfall')],
                        'blockExternalHTTP'         => ['label' => __('Block external HTTP Requests', 'waterfall')],
                        'limitCommentsJS'           => ['label' => __('Enqueue Comment JavaScript only on Comments', 'waterfall')],
                        'removeCommentsStyle'       => ['label' => __('Remove Additional Styling for Comments', 'waterfall')]
                    ],
                    'title'         => __('Theme Optimizations', 'waterfall'),
                    'type'          => 'checkbox'
                ]
            ]      
        ]
    ] 
];