<?php

/**
 * Utility functions that are used by the waterfall theme
 */

/**
 * Retrieves the theme header
 */
function get_theme_header() {
    get_template_part('templates/header');
}

/**
 * Retrieves the theme footer
 */
function get_theme_footer() {
    get_template_part('templates/footer');
}

/**
 * Retrieves a certain setting for the theme
 */
function get_theme_option( $type = '', $key = '' ) {
    
    switch( $type ) {
        case 'customizer':
            $options = get_theme_mod('waterfall_customizer');
            break;
        case 'meta':
            $options = get_post_meta( get_the_ID(), 'waterfall_meta', true);
            break;
        default: 
            $options = get_option('waterfall_options');
    }
    
    if( $key )
        $options = isset($options[$key]) ? $options[$key] : '';
    
    return $options;
    
}

/**
 * Checks if we are displaying a custom template
 * Works properly after the template_include hook.
 */
function is_custom() {
    
    global $wp_query;
    
    if( isset($wp_query->is_custom) && $wp_query->is_custom )
        return true;
    
    return false;
    
}