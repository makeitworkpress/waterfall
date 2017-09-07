<?php
/**
 * Contains the basic configurations for the theme
 */


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
                        'css'           => '.main-content',
                        'id'            => 'content_typography',
                        'title'         => __('Main Content', 'waterfall'),
                        'type'          => 'typography'
                    ),                     
                    array(
                        'css'           => '.main-header h1',
                        'id'            => 'main_heading_typography',
                        'title'         => __('Title Section Headings', 'waterfall'),
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
                                'id'            => 'network',
                                'title'         => __('Type of Social Network', 'waterfall'),
                                'placeholder'   => __('Select a network', 'waterfall'),
                                'type'          => 'select',    
                                'options'       => array(
                                    'email'         => __('Email', 'waterfall'), 
                                    'facebook'      => __('Facebook', 'waterfall'), 
                                    'instagram'     => __('Instagram', 'waterfall'), 
                                    'twitter'       => __('Twitter', 'waterfall'), 
                                    'linkedin'      => __('LinkedIn', 'waterfall'), 
                                    'google-plus'   => __('Google Plus', 'waterfall'), 
                                    'pinterest'     => __('Pinterest', 'waterfall'), 
                                    'reddit'        => __('Reddit', 'waterfall'),   
                                    'whatsapp'      => __('Whatsapp', 'waterfall')   
                                )
                            ),
                            array(
                                'columns'       => 'half',
                                'id'            => 'url',
                                'title'         => __('Url, E-mail Address or Telephone Number', 'waterfall'),
                                'type'          => 'input',    
                                'subtype'       => 'url' 
                            )    
                        )
                    ),     
                )              
            ),        
        )
    ),
);