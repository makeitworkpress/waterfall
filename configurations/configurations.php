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
                        'columns'        => 'half',
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
                                'id'            => 'url',
                                'title'         => __('Url to Social Network', 'waterfall'),
                                'type'          => 'input',    
                                'subtype'       => 'url' 
                            ),
                            array(
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
        'title'         => __('Waterfall Options', 'waterfall'),
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
                'id'        => 'layout',
                'title'     => __('Lay-Out', 'waterfall'),
                'fields'    => array(                   
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
                        'default'       => 'third',
                        'description'   => __('Amount of grid columns for posts archives.', 'waterfall'),
                        'id'            => 'archives_grid',
                        'choices'       => array(
                            'full'      => __('No columns', 'waterfall'),
                            'half'      => __('Two columns', 'waterfall'),
                            'third'     => __('Three columns', 'waterfall'),
                            'fourth'    => __('Four columns', 'waterfall')
                        ),
                        'title'         => __('Archives Lay-Out', 'waterfall'),
                        'type'          => 'select'
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
                            'tablets'   => __('Display on Tablets (<1024px)', 'waterfall'),
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
                'id'            => 'styling_content',
                'title'         => __('Styling Content', 'waterfall'),
                'fields'    => array(    
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
                'icon'      => 'web_asset',
                'id'        => 'header',
                'title'     => __('Site Header', 'waterfall'),
                'fields'    => array(                   
                    array(
                        'default'       => '',
                        'id'            => 'transparent_header',
                        'title'         => __('Header Transparency', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'transparent', 'label' => __('Transparent Header', 'waterfall') )
                        )
                    ),
                    array(
                        'default'       => '',
                        'id'            => 'disable_header',
                        'title'         => __('Disable Header', 'waterfall'),
                        'type'          => 'checkbox',
                        'options'   => array( 
                            array( 'id' => 'disable', 'label' => __('Disable the display of the header', 'waterfall') )
                        )
                    )    
                )              
            ),
            array(
                'icon'      => 'remove_from_queue',
                'id'        => 'page_header',
                'title'     => __('Page Header', 'waterfall'),
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
                        'title'         => __('Custom Background for the Page Header', 'waterfall'),
                        'type'          => 'background'
                    ),     
                    array(
                        'columns'       => 'fourth',
                        'css'           => '.entry-header h1, .entry-header h2, .entry-header',
                        'id'            => 'page_header_color',
                        'title'         => __('Custom Text Color Page Header', 'waterfall'),
                        'type'          => 'colorpicker'
                    ), 
                    array(
                        'columns'       => 'fourth',
                        'id'            => 'page_header_overlay',
                        'title'         => __('Overlay Color Page Header', 'waterfall'),
                        'type'          => 'colorpicker'
                    ),   
                    array(
                        'columns'       => 'half',
                        'default'       => 'background',
                        'id'            => 'page_header_featured',
                        'title'         => __('Position of Featured Image', 'waterfall'),
                        'type'          => 'select',
                        'options'       => array(
                            'background'    => __('As background of the page header', 'waterfall'),
                            'before'        => __('Before the page title in the page header', 'waterfall'),
                            'after'         => __('After the page title in the page header', 'waterfall'),
                            'none'          => __('Do not use the featured image in the page header', 'waterfall')
                        )
                    ), 
                    array(
                        'columns'       => 'half',
                        'default'       => 'default',
                        'id'            => 'page_header_height',
                        'title'         => __('Mininum Height Page Header', 'waterfall'),
                        'type'          => 'select',
                        'options'       => array(
                            'default'   => __('No mininum height', 'waterfall'),
                            'full'      => __('Fullscreen mininum  height', 'waterfall'),
                            'normal'    => __('Three quarter of screen mininum height', 'waterfall'),
                            'half'      => __('Half of screen mininum height', 'waterfall'),
                            'third'     => __('Third of screen mininum height', 'waterfall'),
                            'quarter'   => __('Quarter of screen mininum height', 'waterfall')
                        )
                    ),     
                )              
            ),    
            array(
                'icon'      => 'video_label',
                'id'        => 'footer',
                'title'     => __('Site Footer', 'waterfall'),
                'fields'    => array(                   
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