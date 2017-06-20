<?php
/**
 * Contains the basic configurations for the theme
 */

$configurations['enqueue'] = array(
    array( 'handle' => 'waterfall', 'src' => get_template_directory_uri() . '/assets/css/waterfall.min.css' ),
);

$configurations['language'] = 'waterfall';

$configurations['options']  = array(
    'options' => array(
        'capability'    => 'manage_options',
        'id'            => 'waterfall_options',
        'menu_icon'     => 'dashicons-admin-generic',
        'menu_position' => 99,
        'menu_title'    => __('Waterfall', 'waterfall'),
        'title'         => __('Theme Options', 'waterfall'),
        'sections'      => array(
            array(
                'icon'      => 'format_size',
                'id'        => 'typography',
                'title'     => __('Typography', 'waterfall'),
                'fields'    => array( 
                    array(
                        'css'           => 'body',
                        'id'            => 'body_typography',
                        'title'         => __('General Font', 'waterfall'),
                        'type'          => 'typography'
                    ),     
                    array(
                        'css'           => '.header',
                        'id'            => 'header_menu_typography',
                        'title'         => __('Header Navigation Menu', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'css'           => '.main-header h1',
                        'id'            => 'main_heading_typography',
                        'title'         => __('Main Heading', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'css'           => '.main-content',
                        'id'            => 'content_typography',
                        'title'         => __('Main Content', 'waterfall'),
                        'type'          => 'typography'
                    ),    
                    array(
                        'css'           => 'h1',
                        'columns'       => 'third',
                        'id'            => 'heading1_typography',
                        'title'         => __('Heading 1', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'css'           => 'h2',
                        'columns'        => 'third',
                        'id'            => 'heading2_typography',
                        'title'         => __('Heading 2', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'css'           => 'h3',
                        'columns'        => 'third',
                        'id'            => 'heading3_typography',
                        'title'         => __('Heading 3', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'css'           => 'h4',
                        'columns'        => 'third',
                        'id'            => 'heading4_typography',
                        'title'         => __('Heading 4', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'css'           => 'h5',
                        'columns'        => 'third',
                        'id'            => 'heading5_typography',
                        'title'         => __('Heading 5', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'css'           => 'h6',
                        'columns'       => 'third',
                        'id'            => 'heading6_typography',
                        'title'         => __('Heading 6', 'waterfall'),
                        'type'          => 'typography'
                    ),    
                    array(
                        'css'           => '.entry-meta',
                        'id'            => 'meta_typography',
                        'title'         => __('Meta', 'waterfall'),
                        'type'          => 'typography'
                    ),     
                    array(
                        'css'           => 'blockquote',
                        'id'            => 'blockquote_typography',
                        'title'         => __('Blockquotes', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'       => 'half',
                        'css'           => '.footer',
                        'id'            => 'footer_typography',
                        'title'         => __('Footer Content', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'       => 'half',
                        'css'           => '.footer h1, .footer h2, .footer h3, .footer h4, .footer h5, .footer h6',
                        'id'            => 'footer_titles',
                        'title'         => __('Footer Titles', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'columns'       => 'half',
                        'css'           => '.molecule-footer-socket',
                        'id'            => 'socket_typography',
                        'title'         => __('Socket Content', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'       => 'half',
                        'css'           => '.molecule-footer-socket .atom-menu',
                        'id'            => 'socket_menu_typography',
                        'title'         => __('Socket Navigation Menu', 'waterfall'),
                        'type'          => 'typography'
                    ),     
                )              
            ),
            array(
                'icon'      => 'share',
                'id'        => 'social',
                'title'     => __('Social Networks', 'waterfall'),
                'fields'    => array(                   
                    array (
                        'description'   => __('Add your social networks here', 'waterfall'),
                        'id'            => 'social_networks',
                        'title'         => __('Social Networks', 'waterfall'),
                        'type'          => 'repeatable',
                        'fields'        => array(
                            array(
                                'columns'       => 'half',
                                'id'            => 'url',
                                'title'         => __('Url to Social Network', 'waterfall'),
                                'type'          => 'input',    
                                'subtype'       => 'url' 
                            ),
                            array(
                                'columns'       => 'half',
                                'id'            => 'network',
                                'title'         => __('Type of Social Network', 'waterfall'),
                                'type'          => 'select',    
                                'options'       => array(
                                    'email'         => __('Email', 'waterfall'), 
                                    'facebook'      => __('Facebook', 'waterfall'), 
                                    'instagram'     => __('Instagram', 'waterfall'), 
                                    'twitter'       => __('Twitter', 'waterfall'), 
                                    'linkedin'      => __('LinkedIn', 'waterfall'), 
                                    'google-plus'   => __('Google Plus', 'waterfall'), 
                                    'pinterest'     => __('Pinterest', 'waterfall'), 
                                    'reddit'        => __('Reddit', 'waterfall')   
                                )
                            )    
                        )
                    ),     
                )              
            ),    
            array(
                'icon'      => 'show_chart',
                'id'        => 'optimizations',
                'title'     => __('Optimizations', 'waterfall'),
                'fields'    => array(                   
                    array (
                        'id'            => 'optimizations',
                        'title'         => __('Enable Optimizations', 'waterfall'),
                        'description'   => __('Enables different optimizations, which can speed up your website.', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array(
                            array( 'id' => 'blockExternalHTTP', 'label' => __('Block external HTTP connections', 'waterfall') ),
                            array( 'id' => 'deferCSS', 'label' => __('Defer the loading of CSS', 'waterfall') ),
                            array( 'id' => 'deferJS', 'label' => __('Defer the loading of JavaScript', 'waterfall') ),
                            array( 'id' => 'disableEmbed', 'label' => __('Disable embed JavaScripts', 'waterfall') ),
                            array( 'id' => 'disableComments', 'label' => __('Disable comments', 'waterfall') ),
                            array( 'id' => 'disableRestApi', 'label' => __('Disable the JSON REST Api', 'waterfall') ),
                            array( 'id' => 'disableXMLRPC', 'label' => __('Disable XMLRPC', 'waterfall') ),
                            array( 'id' => 'jqueryToFooter', 'label' => __('Move jQuery to footer', 'waterfall') ),
                            array( 'id' => 'removeEmoji', 'label' => __('Remove Emoji Scripts', 'waterfall') ),
                            array( 'id' => 'removeFeeds', 'label' => __('Remove Feeds', 'waterfall') ),
                            array( 'id' => 'removeHeartbeat', 'label' => __('Remove the Heartbeatscript ', 'waterfall') ),
                            array( 'id' => 'removejQuery', 'label' => __('Remove jQuery', 'waterfall') ),
                            array( 'id' => 'removeShortlinks', 'label' => __('Remove shortlinks', 'waterfall') ),
                            array( 'id' => 'removeVersionNumbers', 'label' => __('Remove version numbers from scripts and styles.', 'waterfall') ),
                            array( 'id' => 'removeWLWManifest', 'label' => __('Remove the Windows Live Writer Manifest', 'waterfall') ),
                            array( 'id' => 'removeWPVersion', 'label' => __('Remove WordPress Version', 'waterfall') ),
                        )
                    ),     
                )              
            )    
        )
    ),
    'customizer' => array(
        'description'   => __('Customizer settings for the Waterfall theme', 'waterfall'),
        'id'            => 'waterfall_customizer',
        'title'         => __('Waterfall', 'waterfall'),
        'sections'      => array(
            array(
                'id'            => 'branding',
                'title'         => __('Branding', 'waterfall'),
                'fields'    => array(                   
                    array(
                        'default'       => '',
                        'id'            => 'logo',
                        'title'         => __('Logo Image', 'waterfall'),
                        'type'          => 'image',
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'logo_transparent',
                        'title'         => __('Transparent Logo Image', 'waterfall'),
                        'type'          => 'image',
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'logo_mobile',
                        'title'         => __('Mobile Logo Image', 'waterfall'),
                        'type'          => 'image',
                    ), 
                    array(
                        'default'       => '',
                        'id'            => 'logo_mobile_transparent',
                        'title'         => __('Transparent Mobile Logo Image', 'waterfall'),
                        'type'          => 'image',
                    ),     
                    array(
                        'default'       => '',
                        'id'            => 'favicon',
                        'title'         => __('Favicon Image', 'waterfall'),
                        'type'          => 'image',
                    ),
                    array(
                        'description'   => __('Choose a logo for use in the socket, preferably with height of 50px.', 'waterfall'),
                        'default'       => '',
                        'id'            => 'footer_logo',
                        'title'         => __('Footer Logo Image', 'waterfall'),
                        'type'          => 'image',
                    )    
                )              
            ),
            array(
                'id'            => 'general_layout',
                'title'         => __('Layout', 'waterfall'),
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
                    )   
                )              
            ),    
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
                        'default'       => '',
                        'id'            => 'header_search',
                        'title'         => __('Add a Search Icon to the Menu', 'waterfall'),
                        'type'          => 'checkbox'
                    ),     
                    array(
                        'default'       => '',
                        'id'            => 'header_social',
                        'title'         => __('Add Social Icons to the Menu', 'waterfall'),
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
                        'default'       => 'mobile',
                        'id'            => 'header_hamburger_menu',
                        'title'         => __('Display of Hamburger Menu', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'always'    => __('Always Display', 'waterfall'),
                            'tablet'    => __('Display on Tablets (<1024px)', 'waterfall'),
                            'mobile'    => __('Display on Mobile (<768px)', 'waterfall'),
                        ),
                    ),
                    array(
                        'default'       => 'default',
                        'id'            => 'header_menu_style',
                        'title'         => __('Menu Style', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'default'   => __('Default', 'waterfall'),
                            'dark'      => __('Dark', 'waterfall'),
                            'fixed'     => __('Dark Always Mobile', 'waterfall'),
                            'left'      => __('Left Always Mobile', 'waterfall'),
                            'right'     => __('Right Always Mobile', 'waterfall'),
                        ),
                    ),    
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
                        'css'           => '.header .menu > li > a',
                        'default'       => '',
                        'id'            => 'navigation_link_color',
                        'title'         => __('Navigation Link Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ), 
                    array(
                        'css'           => '.header .menu > li > a:hover',
                        'default'       => '',
                        'id'            => 'navigation_link_hover_color',
                        'title'         => __('Navigation Link Hover and Active Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ), 
                    array(
                        'css'           => array( 
                            'selector' => '.header .menu > li > a:hover, .header .menu > li.current-menu-item > a, .header .menu > li.current-menu-ancestor > a', 
                            'property' => 'background-color' 
                        ),
                        'default'       => '',
                        'id'            => 'navigation_link_hover_background',
                        'title'         => __('Navigation Link Hover and Active Background Color', 'waterfall'),
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
                        'title'         => __('Navigation Link Hover Color Transparent Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => array('selector' => '.header .sub-menu', 'property' => 'background-color' 
                        ),
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
                    )    
                )              
            ),   
            array(
                'id'            => 'content_styling',
                'title'         => __('Content Styling', 'waterfall'),
                'fields'    => array(
                    array(
                        'css'           => array( 'selector' => '.main-header', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_header',
                        'title'         => __('Content Header Background Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header h1, .main-header h2, .main-header h3, .main-header h4',
                        'default'       => '',
                        'id'            => 'content_header_title',
                        'title'         => __('Content Header Title Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header',
                        'default'       => '',
                        'id'            => 'content_header_text',
                        'title'         => __('Content Header Text Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-header a',
                        'default'       => '',
                        'id'            => 'content_header_link',
                        'title'         => __('Content Header Link Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header a:hover',
                        'default'       => '',
                        'id'            => 'content_header_link_hover',
                        'title'         => __('Content Header Link Hover Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => '.main-header .entry-meta a, .main-header .entry-time',
                        'default'       => '',
                        'id'            => 'content_header_meta',
                        'title'         => __('Content Header Meta Color', 'waterfall'),
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
                        'css'           => '.main-content h1, .main-header h2, .main-header h3, .main-header h4',
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
                        'title'         => __('Main Content Link Hover Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => array( 'selector' => '.main-sidebar', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_sidebar',
                        'title'         => __('Main Sidebar Background Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5',
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
                        'title'         => __('Main Content Link Hover Color', 'waterfall'),
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
                        'css'           => '.main-related h1, .main-related h2, .main-related h3, .main-related h4, .main-related h5',
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
                        'title'         => __('Related Main Content Link Hover', 'waterfall'),
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
                        'css'           => '.main-footer h1, .main-footer h2, .main-footer h3, .main-footer h4, .main-footer h5',
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
                        'title'         => __('Content Footer Link Hover Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                )
            ),
            array(
                'id'            => 'page_content',
                'title'         => __('Pages', 'waterfall'),
                'fields'    => array(
                    array(
                        'default'       => '',
                        'id'            => 'page_header_disable',
                        'title'         => __('Disable content header', 'waterfall'),
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
                        'default'       => 'half',
                        'id'            => 'page_header_height',
                        'title'         => __('Content Header Minimum Height', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => get_height_options()
                    ),
                    array(
                        'default'       => 'default',
                        'description'   => __('Width of the header of the content.', 'waterfall'),
                        'id'            => 'page_header_width',
                        'choices'       => get_container_options(),
                        'title'         => __('Content Header Width', 'waterfall'),
                        'type'          => 'select'
                    ),      
                    array(
                        'default'       => 'left',
                        'id'            => 'page_header_align',
                        'title'         => __('Content Header Text Align', 'waterfall'),
                        'description'   => __('How should text be aligned within the content header?', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => get_align_options()
                    ),   
                    array(
                        'default'       => '',
                        'id'            => 'page_header_parallax',
                        'title'         => __('Enable the parallax effect to page content headers', 'waterfall'),
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
                        'title'         => __('Enable the scroll button in content headers', 'waterfall'),
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
                'title'         => __('Single Posts', 'waterfall'),
                'fields'    => array(
                    array(
                        'default'       => '',
                        'id'            => 'single_header_disable',
                        'title'         => __('Disable content header', 'waterfall'),
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
                        'default'       => 'half',
                        'id'            => 'single_header_height',
                        'title'         => __('Content Header Minimum Height', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => get_height_options()
                    ),
                    array(
                        'default'       => 'default',
                        'description'   => __('Width of the header of the content.', 'waterfall'),
                        'id'            => 'single_header_width',
                        'choices'       => get_container_options(),
                        'title'         => __('Content Header Width', 'waterfall'),
                        'type'          => 'select'
                    ),     
                    array(
                        'default'       => 'left',
                        'id'            => 'single_header_align',
                        'title'         => __('Content Header Text Align', 'waterfall'),
                        'description'   => __('How should text be aligned within the content header?', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => get_align_options()
                    ),    
                    array(
                        'default'       => '',
                        'id'            => 'single_header_parallax',
                        'title'         => __('Enable the parallax effect to content headers', 'waterfall'),
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
                        'title'         => __('Show a date in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'single_header_terms',
                        'title'         => __('Show tags and categories in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => false,
                        'id'            => 'single_header_author',
                        'title'         => __('Show the author in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'default'       => 'none',
                        'id'            => 'single_header_scroll',
                        'title'         => __('Enable the scroll button in content headers', 'waterfall'),
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
                        'id'            => 'single_related',
                        'title'         => __('Show related posts', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'single_related_text',
                        'title'         => __('Title above Related Posts', 'waterfall'),
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
                        'id'            => 'archive_breadcrumbs',
                        'title'         => __('Display Breadcrumbs', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => 'default',
                        'description'   => __('Width of header in posts archives.', 'waterfall'),
                        'id'            => 'archive_header_width',
                        'choices'       => get_container_options(),
                        'title'         => __('Archives Width', 'waterfall'),
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
                        'description'   => __('Shows a button within posts.', 'waterfall'),
                        'id'            => 'archive_grid_button',
                        'title'         => __('Archive Posts Button', 'waterfall'),
                        'type'          => 'number'
                    ),
                    array(
                        'default'       => '',
                        'description'   => __('Shows a button within archive posts.', 'waterfall'),
                        'id'            => 'archive_grid_button',
                        'title'         => __('Archive Posts Button', 'waterfall'),
                        'type'          => 'checkbox'
                    ), 
                    array(
                        'default'       => __('View Post', 'waterfall'),
                        'description'   => __('The label for this button.', 'waterfall'),
                        'id'            => 'archive_grid_label',
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
                        'id'            => 'search_breadcrumbs',
                        'title'         => __('Display Breadcrumbs', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => 'default',
                        'description'   => __('Width of header in search archives.', 'waterfall'),
                        'id'            => 'search_header_width',
                        'choices'       => get_container_options(),
                        'title'         => __('Search Page Width', 'waterfall'),
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
                        'default'       => '',
                        'description'   => __('Shows a button within search page results.', 'waterfall'),
                        'id'            => 'search_grid_button',
                        'title'         => __('Search Page Results Button', 'waterfall'),
                        'type'          => 'checkbox'
                    ), 
                    array(
                        'default'       => __('View Post', 'waterfall'),
                        'description'   => __('The label for this button.', 'waterfall'),
                        'id'            => 'search_grid_label',
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
                        'id'            => '404_title',
                        'title'         => __('Default 404 Title', 'waterfall'),
                        'type'          => 'input'
                    ),
                    array(
                        'default'       => __('Try visiting another page or searching.', 'waterfall'),
                        'id'            => '404_description',
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
                    ),    
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
                        'title'         => __('Socket Link Hover Color', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    )    
                )              
            )    
        )
    ),
    'meta' => array(
        'context'       => 'normal',
        'id'            => 'waterfall_meta',
        'priority'      => 'high',
        'title'         => __('Waterfall Options', 'waterfall'),
        'type'          => 'post',
        'screen'        => array('page', 'post'),    
        'sections'      => array(
            array(
                'icon'      => 'web_asset',
                'id'        => 'footer',
                'title'     => __('Layout', 'waterfall'),
                'fields'    => array(   
                    array(
                        'columns'       => 'half',
                        'default'       => '',
                        'description'   => __('Give this post or page a transparent header.', 'waterfall'),
                        'id'            => 'transparent_header',
                        'title'         => __('Header Transparency', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'transparent', 'label' => __('Transparent Header', 'waterfall') )
                        )
                    ),   
                    array(
                        'columns'       => 'half',
                        'default'       => '',
                        'id'            => 'content_width',
                        'title'         => __('Page Content Width', 'waterfall'),
                        'description'   => __('Define the content width of a page. Useful if using a pagebuilder with full-width sections.', 'waterfall'),
                        'type'          => 'select',
                        'options'       => get_container_options()
                    ),
                    array(
                        'columns'       => 'half',
                        'description'   => __('The Header is the main header of the site, usually containing the main navigation.', 'waterfall'),
                        'id'            => 'disable_header',
                        'title'         => __('Disable Header', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'disable', 'label' => __('Disable the display of the header', 'waterfall') )
                        )
                    ),
                    array(
                        'columns'       => 'half',
                        'description'   => __('The Footer is the main footer of the site, usually containing widgets, copyright and more.', 'waterfall'),
                        'id'            => 'disable_footer',
                        'title'         => __('Disable Footer', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'disable', 'label' => __('Disable the display of the footer', 'waterfall') )
                        )
                    ),    
                    array(
                        'columns'       => 'third',
                        'description'   => __('The Page Title Header usually shows elements such as the title, the featured image and so forth.', 'waterfall'),
                        'id'            => 'page_header_disable',
                        'title'         => __('Disable Page Title Header', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array( array('id' => 'disable', 'label' => __('Disable page header', 'waterfall') ) )
                    ),
                    array(
                        'columns'       => 'third',
                        'description'   => __('The Page Related Section usually contains related posts and post navigation.', 'waterfall'),
                        'id'            => 'page_related_disable',
                        'title'         => __('Disable Page Related Section', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array( array('id' => 'disable', 'label' => __('Disable page footer', 'waterfall') ) )
                    ),     
                    array(
                        'columns'       => 'third',
                        'description'   => __('The Page Content Footer usually shows elements such as comments, the author and so forth.', 'waterfall'),
                        'id'            => 'page_footer_disable',
                        'title'         => __('Disable Page Content Footer', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array( array('id' => 'disable', 'label' => __('Disable page footer', 'waterfall') ) )
                    )   
                )              
            ),    
            array(
                'description' => __('The page header is the header or title section within your content, displaying the title and more.', 'waterfall'),
                'icon'      => 'remove_from_queue',
                'id'        => 'page_header',
                'title'     => __('Page Title Header', 'waterfall'),
                'fields'    => array(  
                     array(
                        'id'            => 'page_header_subtitle',
                        'title'         => __('Subtitle Page Header', 'waterfall'),
                        'type'          => 'input'
                    ),      
                    array(
                        'css'           => '.entry-header',
                        'columns'       => 'half',
                        'id'            => 'page_header_background',
                        'multiple'      => false,
                        'title'         => __('Custom Background for the Page Header', 'waterfall'),
                        'type'          => 'background'
                    ),     
                    array(
                        'columns'       => 'fourth',
                        'css'           => '.entry-header h1, .entry-header h2, .entry-header, .entry-header a',
                        'id'            => 'page_header_color',
                        'title'         => __('Custom Text Color Page Header', 'waterfall'),
                        'type'          => 'colorpicker'
                    ), 
                    array(
                        'css'           => '.entry-header:after',
                        'columns'       => 'fourth',
                        'id'            => 'page_header_overlay',
                        'title'         => __('Overlay Color Page Header', 'waterfall'),
                        'type'          => 'colorpicker'
                    )    
                )              
            )  
        )
    )
);
    
$configurations['register'] = array(
    'imageSizes' => array(
        array('name' => 'square-ld', 'width' => 360, 'height' => 360, 'crop' => true),
        array('name' => 'square-sd', 'width' => 480, 'height' => 480, 'crop' => true),
        array('name' => 'square-hd', 'width' => 720, 'height' => 720, 'crop' => true),
        array('name' => 'square-fhd', 'width' => 1080, 'height' => 1080, 'crop' => true),
        array('name' => 'half-ld', 'width' => 640, 'height' => 240, 'crop' => true),
        array('name' => 'ld', 'width' => 640, 'height' => 360, 'crop' => true),
        array('name' => 'half-sd', 'width' => 854, 'height' => 360, 'crop' => true),
        array('name' => 'sd', 'width' => 854, 'height' => 480, 'crop' => true),
        array('name' => 'half-hd', 'width' => 1280, 'height' => 480, 'crop' => true),
        array('name' => 'hd', 'width' => 1280, 'height' => 720, 'crop' => true),
        array('name' => 'half-fhd', 'width' => 1920, 'height' => 720, 'crop' => true),
        array('name' => 'fhd', 'width' => 1920, 'height' => 1080, 'crop' => true),
        array('name' => 'half-qhd', 'width' => 2560, 'height' => 1080, 'crop' => true),
        array('name' => 'qhd', 'width' => 2560, 'height' => 1440, 'crop' => true),
        array('name' => 'half-uhd', 'width' => 3840, 'height' => 1440, 'crop' => true),
        array('name' => 'uhd', 'width' => 3840, 'height' => 2160, 'crop' => true)
    ),
    'menus' => array(
        'header-menu' => __('Header Menu', 'waterfall'),
        'footer-menu' => __('Footer Menu', 'waterfall')
    ),
    'sidebars' => array(
        array('id' => 'page', 'name' => __('Page Sidebar', 'textdomain'), 'description' => __('The sidebar for pages.', 'textdomain') ),
        array('id' => 'archive', 'name' => __('Archive Sidebar', 'textdomain'), 'description' => __('The sidebar for post archives.', 'textdomain') ),
        array('id' => 'single', 'name' => __('Single Post Sidebar', 'textdomain'), 'description' => __('The sidebar for single posts.', 'textdomain') ),
        array('id' => 'search', 'name' => __('Search Sidebar', 'textdomain'), 'description' => __('The sidebar for search page.', 'textdomain') ),
        array('id' => 'footer-one', 'name' => __('Footer One', 'textdomain'), 'description' => __('The first footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-two', 'name' => __('Footer Two', 'textdomain'), 'description' => __('The second footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-three', 'name' => __('Footer Three', 'textdomain'), 'description' => __('The third footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-four', 'name' => __('Footer Four', 'textdomain'), 'description' => __('The fourth footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-five', 'name' => __('Footer Five', 'textdomain'), 'description' => __('The fifth footer column sidebar.', 'textdomain') )
    ),    
);

$configurations = apply_filters('waterfall_configurations', $configurations);