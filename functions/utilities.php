<?php
/**
 * Utility functions that are used by the waterfall theme
 */

/**
 * Retrieves a view instance
 * 
 * @param   String    $type The type of view to retrieve
 * @return  Object   The view object for the specified type
 */
function wf_get_view($type) {
    
    switch($type) {
        case 'header':
            $view = new Views\Header();
            break;
        case 'footer':
            $view = new Views\Footer();
            break;
        case 'singular':
            $view = new Views\Singular();
            break;
        case 'product':
            $view = new Views\Plugins\Product();
            break;              
        case 'events':
            $view = new Views\Plugins\Events();
            break;              
        case 'bbpress':
            $view = new Views\Plugins\bbPress();
            break;  
        case 'archive':
            $view = new Views\Index();
            break;
        case 'shop':
            $view = new Views\Plugins\Shop();
            break;
        case '404';
            $view = new Views\Nothing();
            break;
        default:
            $view = new Views\Index();
    }

    return $view;
}

/**
 * Retrieves the theme header
 * Replaces the standard get_header call that WordPress uses (required because our templates are in the templates folder)
 */
function wf_get_theme_header() {
    get_template_part('templates/header');
}

/**
 * Retrieves the theme footer
 * Replaces the standard get_footer call that WordPress uses (required because our templates are in the templates folder)
 */
function wf_get_theme_footer() {
    get_template_part('templates/footer');
}

/**
 * Retrieves certain data from the database for the theme
 *
 * @param   String          $type       The type of options to retrieve
 * @param   Array/String    $keys       The array of option keys or single option key to retrieve
 * @param   String          $prefix     A common prefix for the option, such as archive or single
 *
 * @return  Array/String    $options   The array with options; 
 */
function wf_get_data( $type = '', $keys = '', $prefix = '') {

    /**
     * Retrieves our data from the instance
     * This ensures data is only queried once
     */
    $type   = ! $type ? 'options' : $type;

    if( ! in_array($type, ['bbpress', 'colors', 'customizer', 'layout', 'meta', 'options', 'woocommerce']) ) {
        return [];
    }

    $data       = Waterfall_Data::instance()->get_data();
    $options    = $data[$type];

    /**
     * Allows only to return a certain set of options. 
     * Either receive a single option or multiple at once, but not all
     */
    if( is_array($keys) ) {
        $formatted = array();
        foreach( $keys as $key ) {
            $formatted[$key] = isset($options[$prefix . $key]) ? $options[$prefix . $key] : false;
        }        
    } elseif( $keys ) {
        $formatted = isset($options[$prefix . $keys]) ? $options[$prefix . $keys] : false;
    }
    
    return isset($formatted) ? $formatted : $options;

}

/**
 * Retrieves a certain setting for the theme
 * @deprecated, use wf_get_data instead
 *
 * @param   String          $type     The type of options to retrieve
 * @param   Array/String    $keys      The array of option keys or single option key to retrieve
 * @param   String          $prefix   A common prefix for the option, such as archive or single
 *
 * @return  Array/String    $options   The array with options; 
 */
function wf_get_theme_option( $type = '', $keys = '', $prefix = '' ) {
    return wf_get_data($type, $keys, $prefix);   
}

/**
 * Retrieves the main microdata for a theme
 */
function wf_get_main_schema() {
    
    $blogTypes  = apply_filters( 'waterfall_blog_schema_post_types', ['post'] );
    $disabled   = wf_get_data('options', 'scheme_post_types_disable') ? wf_get_data('options', 'scheme_post_types_disable') : [];
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
        'default'   => __('No Sidebars', 'waterfall'),
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
    
    $options    = wf_get_data('customizer', array_keys($networks));
    $urls       = [];
    
    foreach( $networks as $network => $label ) {
        if( isset($options[$network]) && $options[$network] )
            $urls[$network] = $options[$network];        
    }
    
    return $urls;
}

/**
 * Retrieves the post type of the archive, whether we are looking into our homepage with posts, a taxonomy page or a post type archive
 * Only works properly in archives
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
    } elseif( isset($wp_query->queried_object->ID) && (int) $wp_query->queried_object->ID === (int) get_option('page_for_posts') ) {
        $type = 'post';
    
    // bbPress search (will equal forums archive)
    } elseif( isset($wp_query->bbp_is_search) && $wp_query->bbp_is_search ) {
        $type = 'forum';
    
    // Taxonomy archives
    } elseif( isset($wp_query->tax_query->queried_terms) && $wp_query->tax_query->queried_terms ) {

        // Get the first of the queried taxonomies
        foreach( $wp_query->tax_query->queried_terms as $key => $vars ) {
            
            // If our key is language (from polylang), we skip it
            if( $key === 'language' ) {
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

    return apply_filters('waterfall_archive_post_type', $type);

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
 * Returns bbPress archives and post types
 * 
 * @return Array $types The bbPress types
 */
function wf_get_bbpress_types() {
    return apply_filters('waterfall_bbpress_types', [
        'forum_archive' => __('Forums Page', 'waterfall'), 
        'forum'         => __('Forum', 'waterfall'), 
        'topic'         => __('Topic', 'waterfall'), 
        'reply'         => __('Reply', 'waterfall')
    ]);
}

/**
 * Checks if a certain theme location was build by elementor. We can use the options to see if a condition applies.
 * It looks to the primary condition available
 * 
 * It does not yet support display based on tags, categories and taxonomies
 * 
 * @param string $location  The theme location of the template
 * @param string $type      The optional condition type, such as a post type or post type archive display (use post type name or 404) or search or author
 */
function wf_elementor_theme_has_location( $location, $type = '' ) {

    // Elementor should be active
    if( ! did_action('elementor/loaded') ) {
        return false;
    }

    $conditions = get_option('elementor_pro_theme_builder_conditions');
    $shown      = false;

    // There should be something to show
    if( ! isset($conditions[$location]) || empty($conditions[$location]) || ! is_array($conditions[$location]) ) {
        return $shown;
    }

    switch($location) {
        case 'header':
        case 'footer':
            foreach( $conditions[$location] as $condition ) {
                if( $condition[0] === 'include/general' ) {
                    $shown = true;
                }
            }
            break;
        case 'single':
            foreach( $conditions[$location] as $condition ) {
                              
                // For single template applying to all types
                if( $condition[0] === 'include/singular' ) {
                    $shown = true;
                }

                if( $condition[0] === 'include/singular/not_found404' && $type === '404' ) {
                    $shown = true;
                }                

                // For single template applying to products
                if( $condition[0] === 'include/product' && $type === 'product' ) {
                    $shown = true;
                }                

                // For a single templates applying to a specific type
                if( $condition[0] === 'include/singular/' . $type ) {
                    $shown = true;
                }

            }
            break;
        case 'archive':

            foreach( $conditions[$location] as $condition ) {

                // For an archive template applying to all types
                if( $condition[0] === 'include/archive' ) {
                    $shown = true;
                }

                // For a search, author or date templates 
                if( $condition[0] === 'include/archive/' . $type ) {
                    $shown = true;
                } 

                // For condition archives
                if( $condition[0] === 'include/product_archive' && $type === 'product' ) {
                    $shown = true;
                }                 

                // For a specific post type 
                if( $condition[0] === 'include/archive/' . $type . '_archive' ) {
                    $shown = true;
                }

            }                 

        break;

    }

   
    return $shown;
    
}