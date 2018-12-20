<?php

/**
 * Utility functions that are used by the waterfall theme
 */

/**
 * Retrieves the theme header
* Replaces the standard get_header call that WordPress uses
 */
function wf_get_theme_header() {
    get_template_part('templates/header');
}

/**
 * Retrieves the theme footer
 * Replaces the standard get_footer call that WordPress uses
 */
function wf_get_theme_footer() {
    get_template_part('templates/footer');
}

/**
 * Retrieves a certain setting for the theme
 *
 * @param   string    $type     The type of options to retrieve
 * @param   mixed     $key      The array of option keys or single option key to retrieve
 * @param   string    $prefix   A common prefix for the option
 *
 * @return  mixed     $options   The array with options; 
 */
function wf_get_theme_option( $type = '', $key = '', $prefix = '' ) {

    $options    = '';
    
    // Determine our source
    switch( $type ) {
        case 'customizer':
            $options = get_theme_mod('waterfall_customizer');
            break;        
        case 'colors':
            $options = get_theme_mod('waterfall_colors');
            break;        
        case 'layout':
            $options = get_theme_mod('waterfall_layout');
            break;        
        case 'typography':
            $options = get_theme_mod('waterfall_typography');
            break;
        case 'woocommerce':
            $options = get_theme_mod('woocommerce');
            break;            
        case 'meta':
            $options = get_post_meta( get_the_ID(), 'waterfall_meta', true);
            break;
        default: 
            $options = get_option('waterfall_options');
    }
    
    // Switch option type, whether to receive a single option or multiple at once
    if( is_array($key) ) {
        $formatted = array();
        foreach( $key as $value ) {
            $formatted[$value] = isset($options[$prefix . $value]) ? $options[$prefix . $value] : false;
        }        
    } elseif( $key ) {
        $formatted = isset($options[$prefix . $key]) ? $options[$prefix . $key] : false;
    }
    
    return isset($formatted) ? $formatted : $options;
    
}

/**
 * Retrieves the main microscheme for a theme
 */
function wf_get_main_schema() {
    
    $schema = 'http://schema.org/WebPageElement';
    
    if( is_single() || is_archive() ) {
        $schema = 'https://schema.org/Blog';
    }
        
    if( is_search() ) {
        $schema = 'https://schema.org/SearchResultsPage';
    }
        
    return apply_filters('waterfall_main_scheme', $schema);
    
}

/**
 * Checks if we are displaying a custom template
 * Works properly after the template_include hook.
 */
function wf_is_custom() {
    
    global $wp_query;
    
    if( isset($wp_query->is_custom) && $wp_query->is_custom )
        return true;
    
    return false;
    
}

/**
 * Retrieves all image sizes for this theme
 */
function wf_get_image_sizes() {
    return apply_filters( 'waterfall_image_sizes', array(
        'thumbnail'     => __('Thumbnail', 'waterfall'),
        'medium'        => __('Medium', 'waterfall'),
        'large'         => __('Large', 'waterfall'),
        'full'          => __('Fullsize', 'waterfall'),
        'ld'            => __('LD (640x360)', 'waterfall'),
        'sd'            => __('SD (854x480)', 'waterfall'),
        'hd'            => __('HD (1280x720)', 'waterfall'),
        'fhd'           => __('FHD (1920x1080)', 'waterfall'),
        'qhd'           => __('QHD (2560x1440)', 'waterfall'),
        'uhd'           => __('UHD (3840x2560)', 'waterfall'),
        'half-ld'       => __('Half LD (640x240)', 'waterfall'),
        'half-sd'       => __('Half SD (854x360)', 'waterfall'),
        'half-hd'       => __('Half HD (1280x540)', 'waterfall'),
        'half-fhd'      => __('Half FHD (1920x720)', 'waterfall'),
        'half-qhd'      => __('Half QHD (2560x1080)', 'waterfall'),
        'half-uhd'      => __('Half UHD (3840x1440)', 'waterfall'),
        'square-ld'     => __('Square LD (360x360)', 'waterfall'),
        'square-sd'     => __('Square SD (480x480)', 'waterfall'),
        'square-hd'     => __('Square HD (720x720)', 'waterfall'),
        'square-fhd'    => __('Square FHD (1080x1080)', 'waterfall')          
    ) );
}

/**
 * Retrieves the default grid columns of the grid system
 */
function wf_get_column_options() {
    return apply_filters( 'waterfall_column_options', array(
        'full'      => __('No columns', 'waterfall'),
        'half'      => __('Two columns', 'waterfall'),
        'third'     => __('Three columns', 'waterfall'),
        'fourth'    => __('Four columns', 'waterfall'),
        'fifth'     => __('Five columns', 'waterfall')
    ) );
}

/**
 * Retrieve options for displaying the sidebar
 */
function wf_get_sidebar_options() {
    return apply_filters( 'waterfall_sidebar_options', array(
        'full'      => __('No Sidebars', 'waterfall'),
        'left'      => __('Left Sidebar', 'waterfall'),
        'right'     => __('Right Sidebar', 'waterfall'),
        'bottom'    => __('Bottom Sidebar', 'waterfall'),
    ) );      
}

/**
 * Retrieve options for container/fullwidth
 */
function wf_get_container_options() {
    return apply_filters( 'waterfall_container_options', array(
        ''          => __('Select Option', 'waterfall'),
        'default'   => __('Default', 'waterfall'),
        'full'      => __('Fullwidth', 'waterfall')
    ) );  
}
                         
/**
 * Retrieves screen heights
 */
function wf_get_height_options() {
    return apply_filters( 'waterfall_height_options', array(
        'default'   => __('No minimum height', 'waterfall'),
        'full'      => __('Fullscreen height', 'waterfall'),
        'normal'    => __('Three quarter of screen height', 'waterfall'),
        'two-third' => __('Two third of screen height', 'waterfall'),
        'half'      => __('Half of screen height', 'waterfall'),
        'third'     => __('Third of screen height', 'waterfall'),
        'quarter'   => __('Quarter of screen height', 'waterfall')
    ) );  
}

/**
 * Retrieves alignments
 */
function wf_get_align_options() {
    return apply_filters( 'waterfall_align_options', array(
        'left'    => __('Left', 'waterfall'),
        'center'  => __('Center', 'waterfall'),
        'right'   => __('Right', 'waterfall')
    ) );  
}

/**
 * Retrieves button options
 */
function wf_get_button_options() {
    return apply_filters( 'waterfall_button_options', array(
        'none'      => __('No button', 'waterfall'),
        'default'   => __('Default button', 'waterfall'),
        'arrow'     => __('Downwards Arrow', 'waterfall')
    ) );  
}

/**
 * Retrieves background options
 */
function wf_get_background_options() {
    return apply_filters( 'waterfall_background_options', array(
        'background'    => __('As background of the title section', 'waterfall'),
        'before'        => __('Before the page title in the title section', 'waterfall'),
        'after'         => __('After the page title in the title section', 'waterfall'),
        'none'          => __('Do not use the featured image in the title section', 'waterfall')
    ) );  
}

/**
 * Retrieves float options
 */
function wf_get_float_options() {
    return apply_filters( 'waterfall_float_options', array(
        'center' => __('Center', 'waterfall'),
        'left'   => __('Left', 'waterfall'),
        'none'   => __('None', 'waterfall'),
        'right'  => __('Right', 'waterfall')
    ) );  
}

/**
 * Retrieves grid view options
 */
function wf_get_grid_options() {
    return apply_filters( 'waterfall_grid_options', array(
        'grid'      => __('Grid', 'waterfall'),
        'list'      => __('List', 'waterfall'),
        'magazine'  => __('Magazine', 'waterfall')
    ) );
}

/**
 * Retrieves our social networks
 *
 * @return array $urls The array with social network urls as values, and their sanitized names as keys
 */
function wf_get_social_networks() {
    $networks   = apply_filters( 'waterfall_social_loaded_networks', array(
        'telephone'     => __('Telephone', 'waterfall'), 
        'email'         => __('Email', 'waterfall'), 
        'facebook'      => __('Facebook', 'waterfall'), 
        'instagram'     => __('Instagram', 'waterfall'), 
        'twitter'       => __('Twitter', 'waterfall'), 
        'linkedin'      => __('LinkedIn', 'waterfall'), 
        'google-plus'   => __('Google Plus', 'waterfall'), 
        'youtube'       => __('Youtube', 'waterfall'), 
        'pinterest'     => __('Pinterest', 'waterfall'), 
        'behance'       => __('Behance', 'waterfall'), 
        'dribble'       => __('Dribble', 'waterfall'), 
        'reddit'        => __('Reddit', 'waterfall'),   
        'whatsapp'      => __('Whatsapp', 'waterfall')           
    ));
    $options    = wf_get_theme_option('customizer');
    $urls       = array();
    
    foreach( $networks as $network => $label ) {
        if( isset($options[$network]) && $options[$network] )
            $urls[$network] = $options[$network];        
    }
    
    return $urls;
}

/**
 * Retrieves the post type of the archive, whether we are looking into our homepage with posts, a taxonomy page or a post type archive
 * 
 * @return string $type the post type
 */
function wf_get_archive_post_type() {

    $type = 'post';
    
    global $wp_query;
    
    if( isset($wp_query->query['post_type']) ) {
        $type = $wp_query->query['post_type'];
    } elseif( $wp_query->tax_query->queried_terms ) {

        // Get the first of the queried taxonomies
        foreach( $wp_query->tax_query->queried_terms as $key => $vars ) {
            $taxonomy = $key;
            break;
        }

        $type = get_taxonomy($taxonomy)->object_type[0];

    }

    return $type;
}