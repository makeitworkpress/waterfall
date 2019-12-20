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
 * Retrieves the main microdata for a theme
 */
function wf_get_main_schema() {
    
    $blogTypes  = apply_filters( 'waterfall_blog_schema_post_types', ['post'] );
    $disabled   = wf_get_theme_option('options', 'scheme_post_types_disable') ? wf_get_theme_option('options', 'scheme_post_types_disable') : [];
    $schema     = 'http://schema.org/WebPageElement';

    if( is_singular($blogTypes) ) {
        global $post;
        if( in_array($post->post_type, $blogTypes) && ! in_array($post->post_type, $disabled) ) {
            $schema = 'https://schema.org/Blog';
        }
    }

    // Archive blog schemes
    $archive    = wf_get_archive_post_type();
    if( is_archive() && in_array($archive, $blogTypes) && ! in_array($archive, $disabled) ) {
        $schema = 'https://schema.org/Blog';
    }    
        
    if( is_search() ) {
        $schema = 'https://schema.org/SearchResultsPage';
    }
        
    return apply_filters('waterfall_main_schema', $schema);
    
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
    return apply_filters( 'waterfall_image_sizes', [
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
    ] );
}

/**
 * Retrieves the default grid columns of the grid system
 */
function wf_get_column_options() {
    return apply_filters( 'waterfall_column_options', [
        'full'      => __('No columns', 'waterfall'),
        'half'      => __('Two columns', 'waterfall'),
        'third'     => __('Three columns', 'waterfall'),
        'fourth'    => __('Four columns', 'waterfall'),
        'fifth'     => __('Five columns', 'waterfall')
    ] );
}

/**
 * Retrieves the default grid columns of the grid system
 */
function wf_get_grid_gaps() {
    return apply_filters( 'waterfall_grid_gaps', [
        'default'   => __('Default', 'waterfall'),
        'none'      => __('None', 'waterfall'),
        'tiny'      => __('Tiny', 'waterfall'),
        'small'     => __('Small', 'waterfall'),
        'medium'    => __('Medium', 'waterfall'),
        'large'     => __('Large', 'waterfall'),
        'huge'      => __('Huge', 'waterfall')
    ] );
}

/**
 * Retrieve options for displaying the sidebar
 */
function wf_get_sidebar_options() {
    return apply_filters( 'waterfall_sidebar_options', [
        'full'      => __('No Sidebars', 'waterfall'),
        'left'      => __('Left Sidebar', 'waterfall'),
        'right'     => __('Right Sidebar', 'waterfall'),
        'bottom'    => __('Bottom Sidebar', 'waterfall'),
    ] );      
}

/**
 * Retrieve options for container/fullwidth
 */
function wf_get_container_options() {
    return apply_filters( 'waterfall_container_options', [
        ''          => __('Select Option', 'waterfall'),
        'default'   => __('Default', 'waterfall'),
        'full'      => __('Fullwidth', 'waterfall')
    ] );  
}
                         
/**
 * Retrieves screen heights
 */
function wf_get_height_options() {
    return apply_filters( 'waterfall_height_options', [
        'default'   => __('No minimum height', 'waterfall'),
        'full'      => __('Fullscreen height', 'waterfall'),
        'normal'    => __('Three quarter of screen height', 'waterfall'),
        'two-third' => __('Two third of screen height', 'waterfall'),
        'half'      => __('Half of screen height', 'waterfall'),
        'third'     => __('Third of screen height', 'waterfall'),
        'quarter'   => __('Quarter of screen height', 'waterfall')
    ] );  
}

/**
 * Retrieves alignments
 */
function wf_get_align_options() {
    return apply_filters( 'waterfall_align_options', [
        'left'    => __('Left', 'waterfall'),
        'center'  => __('Center', 'waterfall'),
        'right'   => __('Right', 'waterfall')
    ] );  
}

/**
 * Retrieves button options
 */
function wf_get_button_options() {
    return apply_filters( 'waterfall_button_options', [
        'none'      => __('No button', 'waterfall'),
        'default'   => __('Default button', 'waterfall'),
        'arrow'     => __('Downwards Arrow', 'waterfall')
    ] );  
}

/**
 * Retrieves background options
 */
function wf_get_background_options() {
    return apply_filters( 'waterfall_background_options', [
        'background'    => __('As background of the title section', 'waterfall'),
        'before'        => __('Before the page title in the title section', 'waterfall'),
        'after'         => __('After the page title in the title section', 'waterfall'),
        'none'          => __('Do not use the featured image in the title section', 'waterfall')
    ] );  
}

/**
 * Retrieves float options
 */
function wf_get_float_options() {
    return apply_filters( 'waterfall_float_options', [
        'center' => __('Center', 'waterfall'),
        'left'   => __('Left', 'waterfall'),
        'none'   => __('None', 'waterfall'),
        'right'  => __('Right', 'waterfall')
     ] );  
}

/**
 * Retrieves grid view options
 */
function wf_get_grid_options() {
    return apply_filters( 'waterfall_grid_options', [
        'grid'      => __('Grid', 'waterfall'),
        'list'      => __('List', 'waterfall')
    ] );
}

/**
 * Retrieves our social networks
 *
 * @return array $urls The array with social network urls as values, and their sanitized names as keys
 */
function wf_get_social_networks() {
    
    $networks   = apply_filters( 'waterfall_social_loaded_networks', [
        'telephone'     => __('Telephone', 'waterfall'), 
        'email'         => __('Email', 'waterfall'), 
        'facebook'      => __('Facebook', 'waterfall'), 
        'instagram'     => __('Instagram', 'waterfall'), 
        'twitter'       => __('Twitter', 'waterfall'), 
        'linkedin'      => __('LinkedIn', 'waterfall'), 
        'youtube'       => __('Youtube', 'waterfall'), 
        'pinterest'     => __('Pinterest', 'waterfall'), 
        'behance'       => __('Behance', 'waterfall'), 
        'dribble'       => __('Dribble', 'waterfall'), 
        'reddit'        => __('Reddit', 'waterfall'),   
        'github'        => __('Github', 'waterfall'),   
        'whatsapp'      => __('Whatsapp', 'waterfall')           
    ] );
    
    $options    = wf_get_theme_option('customizer');
    $urls       = [];
    
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
    
    // Default post type archives
    if( isset($wp_query->query['post_type']) ) {
        $type = $wp_query->query['post_type'];
    // The page set-up as blog page
    } elseif( isset($wp_query->queried_object->ID) && $wp_query->queried_object->ID == get_option('page_for_posts') ) {
        $type = 'post';
    // Taxonomy archives
    } elseif( isset($wp_query->tax_query->queried_terms) && $wp_query->tax_query->queried_terms ) {

        // Get the first of the queried taxonomies
        foreach( $wp_query->tax_query->queried_terms as $key => $vars ) {
            
            // If our key is language (from polylang), we skip it
            if( $key == 'language' ) {
                continue;
            }

            $taxonomy = $key;
            break;
            
        }

        // If our taxonomy is a string, get the object first


        if( isset($taxonomy) && is_string($taxonomy) ) {
            $taxonomy = get_taxonomy($taxonomy);
        }

        if( isset($taxonomy->object_type[0]) ) {
            $type = $taxonomy->object_type[0];
        }       

    }

    return $type;

}

/**
 * Returns the public post types as available for Waterfall.
 * 
 * @param boolean $simple Whether to retrieve only the post type name and label
 * @param boolean $available Wheter to retrieve only the post types that are marked as available for the customizer within the Waterfall theme settings
 * 
 * @return array $posts The array with post types
 */
function wf_get_post_types( $simple = false, $available = false ) {

    $db     = get_option('waterfall_post_types');

    $saved  = $db && is_array($db) ? $db : [];
    $types  = [];

    if( $simple ) {

        foreach( $saved as $name => $type ) {
            $types[$name] = $type['name'];
        }

    } else {
        $types = $saved;
    }

    if( $available ) {
        $options = get_option('waterfall_options');
        $allowed = isset($options['customizer_post_types']) && is_array($options['customizer_post_types']) ? $options['customizer_post_types'] : ['post', 'page', 'reviews'];

        foreach( $types as $name => $type ) {

            if( ! in_array($name, $allowed) ) {
                unset($types[$name]);
            }

        }

    }   

    return $types;

}

/**
 * Checks if a certain theme location was build by elementor
 * 
 * @param string $location The theme location of the template
 */
function wf_elementor_theme_has_location( $location ) {
    
    /**
     * The elementor plugin should be installed
     */
    if ( ! did_action( 'elementor_pro/init' ) ) {
		return false;
    }
    
    // Let's look up our theme conditions
	$conditions_manager = \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'theme-builder' )->get_conditions_manager();
	$documents          = $conditions_manager->get_documents_for_location( $location );
    
    return ! empty($documents);
    
}