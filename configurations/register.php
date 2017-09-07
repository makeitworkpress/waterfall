<?php
/**
 * Loads our register configurations
 */    
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

if( class_exists( 'WooCommerce' ) ) {    
    $register['sidebars'][] = array(
        'id'            => 'product-archive', 
        'name'          => __('Woocommerce Product Archive', 'textdomain'), 
        'description'   => __('The sidebar for product archives, also known as the shop page.', 'textdomain') 
    );
    $register['sidebars'][] = array(
        'id'            => 'product', 
        'name'          => __('Woocommerce Product Sidebar', 'textdomain'), 
        'description'   => __('The sidebar for products.', 'textdomain') 
    );
}