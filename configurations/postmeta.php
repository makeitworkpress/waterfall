<?php
/**
 * Loads our postmeta configurations
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$initial    = get_option('waterfall_post_types');
$postTypes  = [];

if( $initial ) {
    foreach( $initial as $key => $value ) {
        $postTypes[] = $key;
    }
}
$screen = $postTypes ? $postTypes : array('page', 'post');

$postmeta = array(
    'context'       => 'normal',
    'id'            => 'waterfall_meta',
    'priority'      => 'high',
    'title'         => __('Waterfall Options', 'waterfall'),
    'type'          => 'post',
    'screen'        => $screen,
    'sections'      => array(
        array(
            'icon'      => 'web_asset',
            'id'        => 'footer',
            'title'     => __('Layout', 'waterfall'),
            'fields'    => array( 
                array(
                    'columns'       => 'fourth',
                    'default'       => '',
                    'id'            => 'content_width',
                    'title'         => __('Fullwidth Main Content', 'waterfall'),
                    'description'   => __('Makes the main content fullwidth without any padding and sidebars. Useful if using page-builders.', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'       => array( 
                        'full' => array( 'label' => __('Enable Fullwidth Content', 'waterfall') )
                    )
                ),   
                array(
                    'columns'       => 'fourth',
                    'default'       => '',
                    'description'   => __('Give this post or page a transparent header.', 'waterfall'),
                    'id'            => 'transparent_header',
                    'title'         => __('Header Transparency', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'   => array( 
                        'transparent' => array( 'label' => __('Enable Transparent Header', 'waterfall') )
                    )
                ),   
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The Header is the main header of the site, usually containing the main navigation.', 'waterfall'),
                    'id'            => 'header_disable',
                    'title'         => __('Disable Header', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'   => array( 
                        'disable' => array( 'label' => __('Disable the header', 'waterfall') )
                    )
                ),
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The Footer is the main footer of the site, usually containing widgets, copyright and more.', 'waterfall'),
                    'id'            => 'footer_disable',
                    'title'         => __('Disable Footer', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'   => array( 
                        'disable' => array( 'label' => __('Disable the footer', 'waterfall') )
                    )
                ),    
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The Title Header usually shows elements such as the title, the featured image and so forth.', 'waterfall'),
                    'id'            => 'content_header_disable',
                    'title'         => __('Disable Title Header', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'       => array( 
                        'disable' => array('label' => __('Disable title header', 'waterfall') ) 
                    )
                ),
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The sidebar is usually shown left or right of your pages.', 'waterfall'),
                    'id'            => 'content_sidebar_disable',
                    'title'         => __('Disable Sidebar', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'       => array( 
                        'disable' => array( 'label' => __('Disable sidebar', 'waterfall') ) 
                    )
                ),                
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The Related Section usually contains related posts and post navigation.', 'waterfall'),
                    'id'            => 'content_related_disable',
                    'title'         => __('Disable Page Related Section', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'       => array( 
                        'disable' => array( 'label' => __('Disable related section', 'waterfall') ) 
                    )
                ),     
                array(
                    'columns'       => 'fourth',
                    'description'   => __('The Content Footer usually shows elements such as comments, the author and so forth.', 'waterfall'),
                    'id'            => 'content_footer_disable',
                    'title'         => __('Disable Page Content Footer', 'waterfall'),
                    'type'          => 'checkbox',
                    'options'       => array( 
                        'disable' => array( 'label' => __('Disable page footer', 'waterfall') ) 
                    )
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
                    'columns'       => 'half',
                    'id'            => 'page_header_subtitle',
                    'title'         => __('Subtitle Page Header', 'waterfall'),
                    'type'          => 'textarea'
                ), 
                array(
                    'columns'       => 'fourth',
                    'id'            => 'page_header_button_text',
                    'title'         => __('Button Page Header Text', 'waterfall'),
                    'description'   => __('Enter the text for an optional button here.', 'waterfall'),
                    'type'          => 'input'
                ),
                array(
                    'columns'       => 'fourth',
                    'id'            => 'page_header_button_link',
                    'title'         => __('Button Page Header Link', 'waterfall'),
                    'description'   => __('Enter the link for this button here.', 'waterfall'),
                    'type'          => 'input',
                    'subtype'       => 'url',
                ),                                      
                array(
                    'selector'      => '.main-header',
                    'columns'       => 'half',
                    'id'            => 'page_header_background',
                    'multiple'      => false,
                    'title'         => __('Custom Background for the Page Header', 'waterfall'),
                    'type'          => 'background'
                ),     
                array(
                    'columns'       => 'fourth',
                    'selector'           => '.main-header h1, .main-header h2, .main-header h3, .main-header h4, .main-header h5, .main-header h6, .main-header, .main-header a, .main-header .entry-meta a, .main-header .entry-time',
                    'id'            => 'page_header_color',
                    'title'         => __('Custom Text Color Page Header', 'waterfall'),
                    'type'          => 'colorpicker'
                ), 
                array(
                    'selector'           => array( 'property' => 'background-color', 'selector' => '.main-header:after' ),
                    'columns'       => 'fourth',
                    'id'            => 'page_header_overlay',
                    'title'         => __('Overlay Color Page Header', 'waterfall'),
                    'type'          => 'colorpicker'
                )    
            )              
        )  
    )
);