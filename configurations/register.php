<?php
/**
 * Loads our register configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Default registrations 
$register = [
    'image_sizes' => [
        ['name' => 'square-ld', 'width' => 360, 'height' => 360, 'crop' => true],
        ['name' => 'square-sd', 'width' => 480, 'height' => 480, 'crop' => true],
        ['name' => 'square-hd', 'width' => 720, 'height' => 720, 'crop' => true],
        ['name' => 'square-fhd', 'width' => 1080, 'height' => 1080, 'crop' => true],
        ['name' => 'half-ld', 'width' => 640, 'height' => 240, 'crop' => true],
        ['name' => 'ld', 'width' => 640, 'height' => 360, 'crop' => true],
        ['name' => 'half-sd', 'width' => 854, 'height' => 360, 'crop' => true],
        ['name' => 'sd', 'width' => 854, 'height' => 480, 'crop' => true],
        ['name' => 'half-hd', 'width' => 1280, 'height' => 480, 'crop' => true],
        ['name' => 'hd', 'width' => 1280, 'height' => 720, 'crop' => true],
        ['name' => 'half-fhd', 'width' => 1920, 'height' => 720, 'crop' => true],
        ['name' => 'fhd', 'width' => 1920, 'height' => 1080, 'crop' => true],
        ['name' => 'half-qhd', 'width' => 2560, 'height' => 1080, 'crop' => true],
        ['name' => 'qhd', 'width' => 2560, 'height' => 1440, 'crop' => true],
        ['name' => 'half-uhd', 'width' => 3840, 'height' => 1440, 'crop' => true],
        ['name' => 'uhd', 'width' => 3840, 'height' => 2160, 'crop' => true]
    ],
    'menus' => [
        'header-menu'   => __('Header Menu', 'waterfall'),
        'footer-menu'   => __('Footer Menu', 'waterfall'),
        'top-menu'      => __('Top Menu', 'waterfall')
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
        if( $type === 'page') {
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
 * bbPress Sidebars
 */
if( class_exists('bbPress') ) {
    foreach( wf_get_bbpress_types() as $type => $label ) {
        $register['sidebars'][] = [
            'id'            => $type, 
            'name'          => sprintf( __('%s Sidebar', 'waterfall'), $label ), 
            'description'   => sprintf( __('The sidebar for a bbPress %s.', 'waterfall'), $label )
        ];
    }    
}

/**
 *  Search Sidebar
 */
$register['sidebars'][] = ['id' => 'search', 'name' => __('Search Sidebar', 'waterfall'), 'description' => __('The sidebar for search page.', 'waterfall')];

/**
 * Dynamic Footer Sidebars
 * $sidebars is retrieved from classes/waterfall.php
 */
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