<?php
/**
 * Loads our register configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Default registrations 
$register = [
    'imageSizes' => [
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
    ],
    'menus' => [
        'header-menu' => __('Header Menu', 'waterfall'),
        'footer-menu' => __('Footer Menu', 'waterfall')
    ],
    'sidebars' => [],    
];

/**
 * Additional sidebar registrations based on post types
 */
$types = wf_get_post_types( false, true );

if( $types ) {
    foreach( $types as $type => $properties ) {
        $register['sidebars'][] = [
            'id'            => $type, 
            'name'          => sprintf( __('%s Sidebar', 'waterfall'), $properties['singular'] ), 
            'description'   => sprintf( __('The sidebar for a single %s.', 'waterfall'), $properties['singular'] )
        ];

        // Skip pages for archives
        if( $type == 'page') {
            continue;
        }

        $register['sidebars'][] = [
            'id'            => $type . '_archive', 
            'name'          => sprintf( __('%s Archive Sidebar', 'waterfall'), $properties['singular'] ), 
            'description'   => sprintf( __('The sidebar for the %s archives.', 'waterfall'), $properties['singular'] ) 
        ];

    }
}

/**
 *  Search Sidebar
 */
$register['sidebars'][] = ['id' => 'search', 'name' => __('Search Sidebar', 'waterfall'), 'description' => __('The sidebar for search page.', 'waterfall')];

/**
 * Dynamic Footer Sidebars
 */
$footer     = wf_get_theme_option('layout');
$sidebars   = isset($footer['footer_sidebars']) && $footer['footer_sidebars'] ? $footer['footer_sidebars'] : 'third';
$columns    = [
    'full'      => ['one', __('One', 'waterfall'), __('first', 'waterfall')], 
    'half'      => ['two', __('Two', 'waterfall'), __('second', 'waterfall')], 
    'third'     => ['three', __('Three', 'waterfall'), __('third', 'waterfall')], 
    'fourth'    => ['four', __('Four', 'waterfall'), __('fourth', 'waterfall')], 
    'fifth'     => ['five', __('Five', 'waterfall'), __('fifth', 'waterfall')]
];  

foreach( $columns as $key => $column ) {
    if( in_array($sidebars, array_keys($columns)) ) {
        $register['sidebars'][] = [
            'id'            => 'footer-' . $column[0], 
            'name'          => sprintf( __('Footer %s', 'waterfall'), $column[1]), 
            'description'   => sprintf( __('The %s footer column sidebar.', 'waterfall'), $column[2])
        ];
    }
    unset($columns[$key]);
}

/**
 * Woocommerce sidebars
 */
if( class_exists( 'WooCommerce' ) ) {    
    $register['sidebars'][] = [
        'id'            => 'product-archive', 
        'name'          => __('Woocommerce Product Archive', 'waterfall'), 
        'description'   => __('The sidebar for product archives, also known as the shop page.', 'waterfall') 
    ];
    $register['sidebars'][] = [
        'id'            => 'product', 
        'name'          => __('Woocommerce Product Sidebar', 'waterfall'), 
        'description'   => __('The sidebar for products.', 'waterfall') 
    ];
}