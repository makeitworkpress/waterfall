<?php 
/**
 * Main Functions file
 *
 * Table of Functions (ToF)
 * 1. Autoload Registration
 * 2. Theme instanciation
 */

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($classname) {
    
    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );
    
    $classes    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    $vendor     = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . $class . '.php';
    
    if( file_exists($classes) ) {
        require_once( $classes );
    } elseif( file_exists($vendor) ) {
        require_once( $vendor );    
    }
   
} );

/**
 * Boot our theme
 */
$theme = Waterfall::instance();

/**
 * Register theme language domain
 */
$theme->register( 'language', 'waterfall' );

/**
 * Register styles
 */
$theme->register( 'enqueue', array(
    array( 'handle' => 'waterfall', 'src' => get_template_directory_uri() . '/assets/css/waterfall.min.css' ),
) );

/**
 * Register custom fonts
 */
$theme->register( 'register', array(
    'menus' => array(
        'header-menu' => __('Header Menu', 'waterfall'),
        'footer-menu' => __('Footer Menu', 'waterfall')
    )      
) );

/**
 * Register the theme framework with several options
 */
$theme->register( 'divergent', array(
    'options' => array(
        'capability'    => 'manage_options',
        'class'         => 'tabs-left',
        'id'            => 'divergent_options',
        'menu_icon'     => 'dashicons-admin-generic',
        'menu_position' => 99,
        'menu_title'    => __('Waterfall', 'waterfall'),
        'title'         => __('Theme Options', 'waterfall'),
        'sections'      => array(
            array(
                'icon'      => 'dashboard',
                'id'        => 'layout',
                'title'     => __('Lay-Out', 'waterfall'),
                'fields'    => array(                   
                    array (
                        'columns'       => 'third',
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for pages.', 'waterfall'),
                        'id'            => 'page_layout',
                        'options'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall'),
                            'double'    => __('Double Sidebars', 'waterfall')
                        ),
                        'title'         => __('Page Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    ),
                    array (
                        'columns'       => 'third',
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for posts.', 'waterfall'),
                        'id'            => 'post_layout',
                        'options'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall'),
                            'double'    => __('Double Sidebars', 'waterfall')
                        ),
                        'title'         => __('Posts Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    ),
                    array (
                        'columns'       => 'third',
                        'default'       => 'full',
                        'description'   => __('Choose the sidebar lay-out for archives.', 'waterfall'),
                        'id'            => 'archives_layout',
                        'options'       => array(
                            'full'      => __('Fullwidth', 'waterfall'),
                            'left'      => __('Left Sidebar', 'waterfall'),
                            'right'     => __('Right Sidebar', 'waterfall'),
                            'double'    => __('Double Sidebars', 'waterfall')
                        ),
                        'title'         => __('Archives Lay-Out', 'waterfall'),
                        'type'          => 'select'
                    )    
                )              
            ),
            array(
                'icon'      => 'format_size',
                'id'        => 'typography',
                'title'     => __('Typography', 'waterfall'),
                'fields'    => array(                   
                    array (
                        'description'   => __('Choose the lay-out for pages.', 'waterfall'),
                        'id'            => 'navigation_menu',
                        'title'         => __('Typography Main Navigation Menu', 'waterfall'),
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
                        'id'            => 'text_field_value',
                        'title'         => __('Example Title', 'waterfall'),
                        'description'   => __('Example Description', 'waterfall'),
                        'type'          => 'input',
                        'subtype'       => 'email',
                        'sanitize'      => 'enabled',
                        'default'       => 'awesome@henk.nl'

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
        'id'            => 'divergent_customizer',
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
                        'id'            => 'favicon',
                        'title'         => __('Favicon Image', 'waterfall'),
                        'type'          => 'image',
                    )
                )              
            ),
            array(
                'id'            => 'styling_header',
                'title'         => __('Styling Header', 'waterfall'),
                'fields'    => array(                   
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
                'title'         => __('Styling Footer', 'waterfall'),
                'fields'    => array( 
                    array(
                        'css'           => '.footer',
                        'default'       => '',
                        'id'            => 'footer_background',
                        'title'         => __('Footer Background', 'waterfall'),
                        'transport'     => 'postMessage',
                        'type'          => 'colorpicker'
                    ),    
                )              
            ),    
        )
    ) 
) );