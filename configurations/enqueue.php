<?php
/**
 * Contains standard scripts
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$enqueue = array(
    array( 'handle' => 'waterfall', 'src' => get_template_directory_uri() . '/assets/css/waterfall.min.css' ),
);

// If we have lightbox in the configurations
if( wf_get_theme_option('customizer', 'lightbox') ) {
    $enqueue[] = array( 'handle' => 'swipebox', 'src' => get_template_directory_uri() . '/assets/js/vendor/swipebox.min.js' );
    $enqueue[] = array( 
        'handle' => 'waterfall', 
        'src' => get_template_directory_uri() . '/assets/js/waterfall.min.js', 
        array('jquery', 'photoswipe') 
    );
}