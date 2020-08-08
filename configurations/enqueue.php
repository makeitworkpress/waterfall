<?php
/**
 * Contains standard scripts
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$enqueue = [
    'style' => ['handle' => 'waterfall', 'src' => get_template_directory_uri() . '/assets/css/waterfall.min.css'],
];

// If we have lightbox in the configurations
if( wf_get_data('customizer', 'lightbox') ) {
    $enqueue['swipebox']    = ['handle' => 'swipebox', 'src' => get_template_directory_uri() . '/assets/js/vendor/swipebox.min.js'];
    $enqueue['script']      = [ 
        'handle'    => 'waterfall', 
        'src'       => get_template_directory_uri() . '/assets/js/waterfall.min.js', 
        'deps'      => ['jquery'],
    ];
}

// Slider script
if( wf_get_data('woocommerce', 'product_content_slider') && ! isset($enqueue['script']) ) {
    $enqueue['script']      = [ 
        'handle'    => 'waterfall', 
        'src'       => get_template_directory_uri() . '/assets/js/waterfall.min.js', 
        'deps'      => ['jquery'],
    ];
}