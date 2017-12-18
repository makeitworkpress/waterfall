<?php
/**
 * Loads our register configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Default registrations 
$register = array(
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
    'sidebars' => array(),    
);

// Additional registrations based on post types
foreach( get_option('waterfall_post_types') as $type ) {
    $object                 = get_post_type_object( $type );
    $register['sidebars'][] = array(
        'id'            => $type, 
        'name'          => sprintf( __('%s Sidebar', 'waterfall'), $object->labels->singular_name ), 
        'description'   => sprintf( __('The sidebar for a single %s.', 'waterfall'), $object->labels->singular_name ) 
    );

    // Skip pages for archives
    if( $type == 'page') {
        continue;
    }

    $register['sidebars'][] = array(
        'id'            => $type . '_archive', 
        'name'          => sprintf( __('%s Archive Sidebar', 'waterfall'), $object->labels->singular_name ), 
        'description'   => sprintf( __('The sidebar for the %s archives.', 'waterfall'), $object->labels->singular_name ) 
    );

}

$register['sidebars'][] = array('id' => 'search', 'name' => __('Search Sidebar', 'waterfall'), 'description' => __('The sidebar for search page.', 'waterfall') );
$register['sidebars'][] = array('id' => 'footer-one', 'name' => __('Footer One', 'waterfall'), 'description' => __('The first footer column sidebar.', 'waterfall') );
$register['sidebars'][] = array('id' => 'footer-two', 'name' => __('Footer Two', 'waterfall'), 'description' => __('The second footer column sidebar.', 'waterfall') );
$register['sidebars'][] = array('id' => 'footer-three', 'name' => __('Footer Three', 'waterfall'), 'description' => __('The third footer column sidebar.', 'waterfall') );
$register['sidebars'][] = array('id' => 'footer-four', 'name' => __('Footer Four', 'waterfall'), 'description' => __('The fourth footer column sidebar.', 'waterfall') );
$register['sidebars'][] = array('id' => 'footer-five', 'name' => __('Footer Five', 'waterfall'), 'description' => __('The fifth footer column sidebar.', 'waterfall') );

if( class_exists( 'WooCommerce' ) ) {    
    $register['sidebars'][] = array(
        'id'            => 'product-archive', 
        'name'          => __('Woocommerce Product Archive', 'waterfall'), 
        'description'   => __('The sidebar for product archives, also known as the shop page.', 'waterfall') 
    );
    $register['sidebars'][] = array(
        'id'            => 'product', 
        'name'          => __('Woocommerce Product Sidebar', 'waterfall'), 
        'description'   => __('The sidebar for products.', 'waterfall') 
    );
}