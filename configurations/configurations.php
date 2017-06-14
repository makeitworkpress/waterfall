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
                        'id'            => 'header_menu_typography',
                        'title'         => __('Header Navigation Menu', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'id'            => 'main_heading_typography',
                        'title'         => __('Main Heading', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'id'            => 'content_typography',
                        'title'         => __('Main Content', 'waterfall'),
                        'type'          => 'typography'
                    ),    
                    array(
                        'columns'       => 'half',
                        'id'            => 'heading1_typography',
                        'title'         => __('Heading 1', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'columns'        => 'half',
                        'id'            => 'heading2_typography',
                        'title'         => __('Heading 2', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'heading3_typography',
                        'title'         => __('Heading 3', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'heading4_typography',
                        'title'         => __('Heading 4', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'heading5_typography',
                        'title'         => __('Heading 5', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'heading6_typography',
                        'title'         => __('Heading 6', 'waterfall'),
                        'type'          => 'typography'
                    ),    
                    array(
                        'columns'        => 'half',
                        'id'            => 'meta_typography',
                        'title'         => __('Meta', 'waterfall'),
                        'type'          => 'typography'
                    ),     
                    array(
                        'columns'        => 'half',
                        'id'            => 'blockquote_typography',
                        'title'         => __('Blockquotes', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'footer_typography',
                        'title'         => __('Footer Content', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
                        'id'            => 'footer_titles',
                        'title'         => __('Footer Titles', 'waterfall'),
                        'type'          => 'typography'
                    ), 
                    array(
                        'columns'        => 'half',
                        'id'            => 'socket_typography',
                        'title'         => __('Socket Content', 'waterfall'),
                        'type'          => 'typography'
                    ),
                    array(
                        'columns'        => 'half',
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
                        'id'            => 'text_field_value',
                        'title'         => __('Example Title', 'waterfall'),
                        'description'   => __('Example Description', 'waterfall'),
                        'type'          => 'input',
                        'subtype'       => 'email',
                        'sanitize'      => 'enabled',
                        'default'       => 'awesome@henk.nl'
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
                        'default'       => 'full',
                        'id'            => 'header_width',
                        'title'         => __('Header Width', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'container' => __('Container width', 'waterfall'),
                        )
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
                        'title'         => __('Background Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header h1, .main-header h2, .main-header h3, .main-header h4',
                        'default'       => '',
                        'id'            => 'content_header_title',
                        'title'         => __('Title Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header',
                        'default'       => '',
                        'id'            => 'content_header_text',
                        'title'         => __('Text Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-header a',
                        'default'       => '',
                        'id'            => 'content_header_link',
                        'title'         => __('Link Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-header a:hover',
                        'default'       => '',
                        'id'            => 'content_header_link_hover',
                        'title'         => __('Link Hover Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => '.main-header .entry-meta a, .main-header .entry-time',
                        'default'       => '',
                        'id'            => 'content_header_meta',
                        'title'         => __('Meta Color Content Header', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),        
                    array(
                        'css'           => array( 'selector' => '.main-content', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_main',
                        'title'         => __('Background Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content h1, .main-header h2, .main-header h3, .main-header h4',
                        'default'       => '',
                        'id'            => 'content_main_title',
                        'title'         => __('Title Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content',
                        'default'       => '',
                        'id'            => 'content_main_text',
                        'title'         => __('Text Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-content a',
                        'default'       => '',
                        'id'            => 'content_main_link',
                        'title'         => __('Link Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content a:hover',
                        'default'       => '',
                        'id'            => 'content_main_link_hover',
                        'title'         => __('Link Hover Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => array( 'selector' => '.main-sidebar', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_sidebar',
                        'title'         => __('Background Color Main Sidebar', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5',
                        'default'       => '',
                        'id'            => 'content_main_title',
                        'title'         => __('Title Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content',
                        'default'       => '',
                        'id'            => 'content_main_text',
                        'title'         => __('Text Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-content a',
                        'default'       => '',
                        'id'            => 'content_main_link',
                        'title'         => __('Link Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-content a:hover',
                        'default'       => '',
                        'id'            => 'content_main_link_hover',
                        'title'         => __('Link Hover Color Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => array( 'selector' => '.main-related', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_related',
                        'title'         => __('Background Color Related Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-related h1, .main-related h2, .main-related h3, .main-related h4, .main-related h5',
                        'default'       => '',
                        'id'            => 'content_related_title',
                        'title'         => __('Title Color Related Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-related',
                        'default'       => '',
                        'id'            => 'content_related_text',
                        'title'         => __('Text Color Related Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-related a',
                        'default'       => '',
                        'id'            => 'content_related_link',
                        'title'         => __('Link Color Related Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-related a:hover',
                        'default'       => '',
                        'id'            => 'content_related_link_hover',
                        'title'         => __('Link Hover Related Main Content', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                    array(
                        'css'           => array( 'selector' => '.main-footer', 'property' => 'background-color' ),
                        'default'       => '',
                        'id'            => 'content_footer',
                        'title'         => __('Background Color Content Footer', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-footer h1, .main-footer h2, .main-footer h3, .main-footer h4, .main-footer h5',
                        'default'       => '',
                        'id'            => 'content_footer_title',
                        'title'         => __('Title Color Content Footer', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-footer',
                        'default'       => '',
                        'id'            => 'content_footer_text',
                        'title'         => __('Text Color Content Footer', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),     
                    array(
                        'css'           => '.main-footer a',
                        'default'       => '',
                        'id'            => 'content_footer_link',
                        'title'         => __('Link Color Content Footer', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),
                    array(
                        'css'           => '.main-footer a:hover',
                        'default'       => '',
                        'id'            => 'content_footer_link_hover',
                        'title'         => __('Link Hover Color Content Footer', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                )
            ),
            array(
                'id'            => 'page_content',
                'title'         => __('Page Content', 'waterfall'),
                'fields'    => array(
                    array(
                        'default'       => 'after',
                        'id'            => 'page_header_featured',
                        'title'         => __('Featured Image Position', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'background'    => __('As background of the content header', 'waterfall'),
                            'before'        => __('Before the page title in the content header', 'waterfall'),
                            'after'         => __('After the page title in the content header', 'waterfall'),
                            'none'          => __('Do not use the featured image in the content header', 'waterfall')
                        )
                    ),
                    array(
                        'default'       => 'half-hd',
                        'id'            => 'page_header_size',
                        'title'         => __('Size Featured Image', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'thumbnail'     => __('Thumbnail', 'waterfall'),
                            'medium'        => __('Medium', 'waterfall'),
                            'large'         => __('Large', 'waterfall'),
                            'full'          => __('Fullsize', 'waterfall'),
                            'ld'            => __('LD (640x360)', 'waterfall'),
                            'sd'            => __('SD (854x480)', 'waterfall'),
                            'hd'            => __('HD (1280x720)', 'waterfall'),
                            'fhd'           => __('FHD (1920x1080)', 'waterfall'),
                            'qhd'           => __('QHD (2560x1440)', 'waterfall'),
                            'uhd'           => __('UHD (3840x2560)', 'waterfall'),
                            'half-ld'       => __('Half LD (640x240)', 'waterfall'),
                            'half-sd'       => __('Half SD (854x360)', 'waterfall'),
                            'half-hd'       => __('Half HD (1280x540)', 'waterfall'),
                            'half-fhd'      => __('Half FHD (1920x720)', 'waterfall'),
                            'half-qhd'      => __('Half QHD (2560x1080)', 'waterfall'),
                            'half-uhd'      => __('Half UHD (3840x1440)', 'waterfall'),
                            'square-ld'     => __('Square (360x360)', 'waterfall'),
                            'square-sd'     => __('Square (480x480)', 'waterfall'),
                            'square-hd'     => __('Square (720x720)', 'waterfall'),
                            'square-fhd'    => __('Square (1080x1080)', 'waterfall'),  
                        )
                    ),    
                    array(
                        'default'       => 'half',
                        'id'            => 'page_header_height',
                        'title'         => __('Pages Content Header Minimum Height', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'default'   => __('No mininum height', 'waterfall'),
                            'full'      => __('Fullscreen height', 'waterfall'),
                            'normal'    => __('Three quarter of screen height', 'waterfall'),
                            'half'      => __('Half of screen height', 'waterfall'),
                            'third'     => __('Third of screen height', 'waterfall'),
                            'quarter'   => __('Quarter of screen height', 'waterfall')
                        )
                    ),   
                    array(
                        'default'       => '',
                        'id'            => 'page_header_parallax',
                        'title'         => __('Enable the parallax effect to page content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ), 
                    array(
                        'default'       => 'none',
                        'id'            => 'page_header_scroll',
                        'title'         => __('Enable the scroll button in page content headers', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'none'      => __('No button', 'waterfall'),
                            'default'   => __('Default button', 'waterfall'),
                            'arrow'     => __('Downwards Arrow', 'waterfall')
                        )
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'page_header_breadcrumbs',
                        'title'         => __('Display Breadcrumbs', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'choices'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall')
                        ),
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for pages.', 'waterfall'),
                        'id'            => 'page_layout',
                        'title'         => __('Page Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    )   
                )              
            ),
            array(
                'id'            => 'post_content',
                'title'         => __('Post Content', 'waterfall'),
                'fields'    => array(
                     array(
                        'default'       => 'after',
                        'id'            => 'post_header_featured',
                        'title'         => __('Posts Featured Image Position', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'background'    => __('As background of the content header', 'waterfall'),
                            'before'        => __('Before the page title in the content header', 'waterfall'),
                            'after'         => __('After the page title in the content header', 'waterfall'),
                            'none'          => __('Do not use the featured image in the content header', 'waterfall')
                        )
                    ),
                    array(
                        'default'       => 'half-hd',
                        'id'            => 'post_header_size',
                        'title'         => __('Size Featured Image', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'thumbnail'     => __('Thumbnail', 'waterfall'),
                            'medium'        => __('Medium', 'waterfall'),
                            'large'         => __('Large', 'waterfall'),
                            'full'          => __('Fullsize', 'waterfall'),
                            'ld'            => __('LD (640x360)', 'waterfall'),
                            'sd'            => __('SD (854x480)', 'waterfall'),
                            'hd'            => __('HD (1280x720)', 'waterfall'),
                            'fhd'           => __('FHD (1920x1080)', 'waterfall'),
                            'qhd'           => __('QHD (2560x1440)', 'waterfall'),
                            'uhd'           => __('UHD (3840x2560)', 'waterfall'),
                            'half-ld'       => __('Half LD (640x240)', 'waterfall'),
                            'half-sd'       => __('Half SD (854x360)', 'waterfall'),
                            'half-hd'       => __('Half HD (1280x540)', 'waterfall'),
                            'half-fhd'      => __('Half FHD (1920x720)', 'waterfall'),
                            'half-qhd'      => __('Half QHD (2560x1080)', 'waterfall'),
                            'half-uhd'      => __('Half UHD (3840x1440)', 'waterfall'),
                            'square-ld'     => __('Square (360x360)', 'waterfall'),
                            'square-sd'     => __('Square (480x480)', 'waterfall'),
                            'square-hd'     => __('Square (720x720)', 'waterfall'),
                            'square-fhd'    => __('Square (1080x1080)', 'waterfall'),  
                        )
                    ),    
                    array(
                        'default'       => 'half',
                        'id'            => 'post_header_height',
                        'title'         => __('Posts Content Header Minimum Height', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'default'   => __('No mininum height', 'waterfall'),
                            'full'      => __('Fullscreen height', 'waterfall'),
                            'normal'    => __('Three quarter of screen height', 'waterfall'),
                            'half'      => __('Half of screen height', 'waterfall'),
                            'third'     => __('Third of screen height', 'waterfall'),
                            'quarter'   => __('Quarter of screen height', 'waterfall')
                        )
                    ),    
                    array(
                        'default'       => '',
                        'id'            => 'post_header_parallax',
                        'title'         => __('Enable the parallax effect to post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'default'       => 'none',
                        'id'            => 'post_header_scroll',
                        'title'         => __('Enable the scroll button in page content headers', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'none'      => __('No button', 'waterfall'),
                            'default'   => __('Default button', 'waterfall'),
                            'arrow'     => __('Downwards Arrow', 'waterfall')
                        )
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_header_breadcrumbs',
                        'title'         => __('Display Breadcrumbs', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'default'       => '',
                        'id'            => 'post_header_date',
                        'title'         => __('Show a date in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_header_terms',
                        'title'         => __('Show tags and categories in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => false,
                        'id'            => 'post_header_author',
                        'title'         => __('Show the author in post content headers', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for posts.', 'waterfall'),
                        'id'            => 'post_layout',
                        'choices'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall')
                        ),
                        'title'         => __('Posts Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_related',
                        'title'         => __('Show related posts', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_related_text',
                        'title'         => __('Title above Related Posts', 'waterfall'),
                        'type'          => 'input'
                    ),     
                    array(
                        'default'       => '',
                        'id'            => 'post_footer_author',
                        'title'         => __('Show the author in the post content footer', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_footer_share',
                        'title'         => __('Show sharing buttons in posts', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'post_footer_pagination',
                        'title'         => __('Show posts pagination', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                    array(
                        'default'       => '',
                        'id'            => 'post_footer_comments',
                        'title'         => __('Show comments in the post content footer', 'waterfall'),
                        'type'          => 'checkbox'
                    ),    
                )
            ),
            array(
                'id'        => 'archives',
                'title'     => __('Archives', 'waterfall'),
                'fields'    => array(
                    array(
                        'default'       => true,
                        'id'            => 'archives_title',
                        'title'         => __('Display Title', 'waterfall'),
                        'type'          => 'checkbox'
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'archives_breadcrumbs',
                        'title'         => __('Display Breadcrumbs', 'waterfall'),
                        'type'          => 'checkbox'
                    ),     
                    array(
                        'default'       => 'third',
                        'description'   => __('Amount of grid columns for posts archives.', 'waterfall'),
                        'id'            => 'archives_grid',
                        'choices'       => array(
                            'full'      => __('No columns', 'waterfall'),
                            'half'      => __('Two columns', 'waterfall'),
                            'third'     => __('Three columns', 'waterfall'),
                            'fourth'    => __('Four columns', 'waterfall'),
                            'fifth'    => __('Five columns', 'waterfall')
                        ),
                        'title'         => __('Archives Grid', 'waterfall'),
                        'type'          => 'select'
                    ),
                    array(
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for archives.', 'waterfall'),
                        'id'            => 'archives_layout',
                        'choices'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall')
                        ),
                        'title'         => __('Archives Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    ),     
                    array(
                        'default'       => 'container',
                        'description'   => __('Width of grid in posts archives.', 'waterfall'),
                        'id'            => 'archives_width',
                        'choices'       => array(
                            'container' => __('Default', 'waterfall'),
                            'full'      => __('Fullwidth', 'waterfall'),
                        ),
                        'title'         => __('Archives Width', 'waterfall'),
                        'type'          => 'select'
                    )      
                )              
            ),     
            array(
                'id'            => 'styling_footer',
                'title'         => __('Footer', 'waterfall'),
                'fields'    => array(
                    array(
                        'default'       => 'container',
                        'id'            => 'footer_width',
                        'title'         => __('Footer Width', 'waterfall'),
                        'type'          => 'select',
                        'choices'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'container' => __('Container width', 'waterfall'),
                        ),
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
                'description' => __('The page header is the header within your content, displaying the title and more.', 'waterfall'),
                'icon'      => 'remove_from_queue',
                'id'        => 'page_header',
                'title'     => __('Page Header', 'waterfall'),
                'fields'    => array(  
                     array(
                        'columns'       => 'half',
                        'id'            => 'page_header_subtitle',
                        'title'         => __('Subtitle Page Header', 'waterfall'),
                        'type'          => 'input'
                    ),    
                    array(
                        'columns'       => 'half',
                        'id'            => 'page_header_disable',
                        'title'         => __('Disable Page Header', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array( array('id' => 'disable', 'label' => __('Disable page header', 'waterfall') ) )
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
            ),
            array(
                'description' => __('The page header is the footer within your content, displaying comments and share buttons in posts.', 'waterfall'),
                'icon'      => 'remove_from_queue',
                'id'        => 'page_footer',
                'title'     => __('Page Footer', 'waterfall'),
                'fields'    => array(    
                    array(
                        'id'            => 'page_footer_disable',
                        'title'         => __('Disable Page Footer', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'       => array( array('id' => 'disable', 'label' => __('Disable page footer', 'waterfall') ) )
                    ),
                )
            ),
            array(
                'icon'      => 'web_asset',
                'id'        => 'footer',
                'title'     => __('Layout', 'waterfall'),
                'fields'    => array(   
                    array(
                        'columns'       => 'half',
                        'default'       => '',
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
                        'id'            => 'disable_header',
                        'title'         => __('Disable Header', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'disable', 'label' => __('Disable the display of the header', 'waterfall') )
                        )
                    ),    
                    array(
                        'default'       => '',
                        'id'            => 'content_width',
                        'title'         => __('Page Content Width', 'waterfall'),
                        'description'   => __('Define the content width of a page. Useful if using a pagebuilder with full-width sections.', 'waterfall'),
                        'type'          => 'select',
                        'options'   => array( 
                            'default'   => __('Default width'),
                            'full'      => __('Full width')
                        )
                    ),   
                    array(
                        'default'       => '',
                        'id'            => 'disable_footer',
                        'title'         => __('Disable Footer', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'disable', 'label' => __('Disable the display of the footer', 'waterfall') )
                        )
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
        array('id' => 'page', 'name' => __('Page Sidebar', 'textdomain'), 'description' => __('The primary sidebar for pages.', 'textdomain') ),
        array('id' => 'archive', 'name' => __('Archive Sidebar', 'textdomain'), 'description' => __('The primary sidebar for post archives.', 'textdomain') ),
        array('id' => 'post', 'name' => __('Post Sidebar', 'textdomain'), 'description' => __('The primary sidebar for posts.', 'textdomain') ),
        array('id' => 'footer-one', 'name' => __('Footer One', 'textdomain'), 'description' => __('The first footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-two', 'name' => __('Footer Two', 'textdomain'), 'description' => __('The second footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-three', 'name' => __('Footer Three', 'textdomain'), 'description' => __('The third footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-four', 'name' => __('Footer Four', 'textdomain'), 'description' => __('The fourth footer column sidebar.', 'textdomain') ),
        array('id' => 'footer-five', 'name' => __('Footer Five', 'textdomain'), 'description' => __('The fifth footer column sidebar.', 'textdomain') )
    ),    
);

$configurations = apply_filters('waterfall_configurations', $configurations);