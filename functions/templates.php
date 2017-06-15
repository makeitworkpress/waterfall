<?php
/**
 * Main templating functions
 * To primary purpose of these templating functions is to clean up the template
 */

/**
 * Renders the header elements
 */
function waterfall_header_elements() {
    
    $disable = is_singular() ? get_theme_option('meta', 'disable_header') : '';
    $disable = $disable ? $disable : array('disable' => false);
    $transparent = is_singular() ? get_theme_option('meta', 'transparent_header') : '';

    // Our header is only shown if enabled
    if( ! $disable['disable'] ) {

        $logo = get_theme_option('customizer', 'logo');

        // Default header items
        $atoms = array(
            'logo'  => array( 
                'float'             => get_theme_option('customizer', 'header_logo_float'),
                'image'             => $logo ? $logo : get_template_directory_uri() . '/assets/img/waterfall.png', 
                'mobile'            => get_theme_option('customizer', 'logo_mobile'), 
                'mobileTransparent' => get_theme_option('customizer', 'logo_mobile_transparent'), 
                'transparent'       => get_theme_option('customizer', 'logo_transparent')
            ),
            'menu'  => array( 
                'args'          => array('theme_location' => 'header-menu'), 
                'float'         => get_theme_option('customizer', 'header_menu_float'),
                'hamburger'     => get_theme_option('customizer', 'header_hamburger_menu'),
                'view'          => 'dark'
            )                
        );
        
        // Search icon
        if( get_theme_option('customizer', 'header_search') ) {
            $atoms['menu']['search'] = true;
        }           

        // Social icons
        if( get_theme_option('customizer', 'header_social') ) {

            $networks = get_theme_option('options', 'social_networks');

            if( $networks ) {

                foreach( $networks as $network ) {
                    $urls[$network['network']] = $network['url'];
                }

                $atoms['menu']['social'] = $urls;

            }
        }        
        
        // Reset the order for right floats
        if( get_theme_option('customizer', 'header_menu_float') == 'right') {
            $menu = $atoms['menu'];
            unset($atoms['menu']);
            $atoms['menu'] = $menu;
        }      

        $container = get_theme_option('customizer', 'header_width');
        $headroom = get_theme_option('customizer', 'header_headroom');
        
        $args = apply_filters( 'waterfall_header_args', array(
            'atoms'         => apply_filters('waterfall_header_atoms', $atoms),
            'container'     => $container == 'container' ? true : false,
            'headroom'      => $headroom ? true : false,
            'fixed'         => get_theme_option('customizer', 'header_fixed'),
            'style'         => 'header',
            'transparent'   => isset($transparent['transparent']) ? $transparent['transparent'] : false
        ) );

        // Build the header! 
        WP_Components\Build::molecule( 'header', $args );

    }
    
}

/**
 * Renders the footer elements
 */
function waterfall_footer_elements() {
    
    /**
     * Retrieves and displays our footer
     */
    $disable = is_singular() ? get_theme_option('meta', 'disable_footer') : '';
    $disable = $disable ? $disable : array('disable' => false);

    if( ! $disable['disable'] ) {

        $atoms          = array();
        $container      = get_theme_option('customizer', 'footer_width');
        $copyright      = get_theme_option('customizer', 'footer_copyright');
        $logo           = get_theme_option('customizer', 'footer_logo');
        $menu           = get_theme_option('customizer', 'footer_menu');
        $sidebarGrid    = get_theme_option('customizer', 'footer_sidebars');
        $social         = get_theme_option('customizer', 'footer_social');

        switch( $sidebarGrid ) {
            case 'full':
                $sidebars = array('footer-one' => 'full');
                break;
            case 'half':
                $sidebars = array('footer-one' => 'half', 'footer-two' => 'half');
                break;
            case 'third':
                $sidebars = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
                break;
            case 'fourth':
                $sidebars = array('footer-one' => 'fourth', 'footer-two' => 'fourth', 'footer-three' => 'fourth', 'footer-four' => 'fourth');
                break;
            case 'fifth':
                $sidebars = array('footer-one' => 'fifth', 'footer-two' => 'fifth', 'footer-three' => 'fifth', 'footer-four' => 'fifth', 'footer-five' => 'fifth');
                break;
            default:
                $sidebars = array();
        }
        
        // Logo
        if( $logo ) {

            $atoms['logo'] = array(
                'float'     => 'center',
                'image'     => $logo
            );
        }       

        // Copyright Message
        if( $copyright ) {
            $atoms['copyright'] = array(
                'float'     => 'left',
                'name'      => get_theme_option('customizer', 'footer_copyright_name'),
                'schema'    => get_theme_option('customizer', 'footer_copyright_schema')
            );
        }

        // Social Icons
        if( $social ) {

            $networks = get_theme_option('options', 'social_networks');

            if( $networks ) {

                foreach( $networks as $network ) {
                    $urls[$network['network']] = $network['url'];
                }

                $atoms['social'] = array(
                    'rounded'   => true,
                    'float'     => 'right',
                    'urls'      => $urls
                );

            }                
        }


        // Menu
        if( $menu ) {
            $atoms['menu'] = array(
                'args'          => array('theme_location' => 'footer-menu'), 
                'float'         => 'right',
                'hamburger'     => 'none' 
            );
        }
        
        $args = apply_filters( 'waterfall_footer_args', array(
            'atoms'         => apply_filters('waterfall_footer_atoms', $atoms),
            'sidebars'      => $sidebars,
            'container'     => $container == 'container' ? true : false,
            'style'         => 'footer'
        ) );

        // Build the footer! 
        WP_Components\Build::molecule( 'footer', $args );

    }
    
}

/**
 * Renders the archive titles
 */
function waterfall_archive_header() {
    
    $breadcrumbs = get_theme_option('customizer', 'archive_breadcrumbs');
    
    if( $breadcrumbs ) {
        $atoms['breadcrumbs'] = array();    
    }
    
    $atoms['archive-title'] = array();
    
    $args = apply_filters('waterfall_archive_title_args', array(
        $atoms,
        'style' => 'entry-archive-header main-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args );    
}

/**
 * Renders the posts grid
 * 
 * @param array $args The array with arguments to display posts, resembling the posts molecule arguments from vendor/wp-components/molecules
 */
function waterfall_posts( $args = array() ) {
    
    $args = apply_filters( 'waterfall_posts_args', $args );
    
    WP_Components\Build::molecule( 'posts', $args );    
    
}

/**
 * Renders the header for content
 */
function waterfall_content_header() {
 
    // Heading disabled
    $disable    = get_theme_option('meta', 'page_header_disable');

    if( isset($disable['disable']) && $disable['disable'] )
        return;      
     
    // Default arguments
    $args = array('style' => 'main-header entry-header'); 
    
    if( is_page() ) {
        $breadcrumbs = get_theme_option('customizer', 'page_header_breadcrumbs');    
    } elseif( is_single() ) {
        $breadcrumbs = get_theme_option('customizer', 'post_header_breadcrumbs');
    }
    
    if( $breadcrumbs ) {
        $args['atoms']['breadcrumbs'] = array('archive' => false);  
    }    
    
    // Title
    $args['atoms']['title'] = array('tag' => 'h1');   
    
    /**
     *  Meta and customizer values
     */
    if( is_single() ) {
        
        $date = get_theme_option('customizer', 'post_header_date');
        $terms = get_theme_option('customizer', 'post_header_terms');    
        
        // Time
        if( $terms ) {
            $args['atoms']['date'] = array('style' => 'entry-time');    
        }
        
        // Terms
        if( $terms ) {
            $args['atoms']['termlist'] = array('style' => 'entry-meta');    
        }        
        
    }

    
    // Subtitle
    $subtitle   = get_theme_option('meta', 'page_header_subtitle');

    if( $subtitle )
        $args['atoms']['description'] = array('description' => $subtitle);
    
    // Featured image
    if( is_page() ) {
        $featured = get_theme_option('customizer', 'page_header_featured');
        $featuredArgs = array( 'size' => get_theme_option('customizer', 'page_header_size') );
    } elseif( is_single() ) {
        $featured = get_theme_option('customizer', 'post_header_featured');
        $featuredArgs = array( 'size' => get_theme_option('customizer', 'post_header_size') );
    }
    
    if( $featured == 'before' ) { 
        $image = array( 'image' => $featuredArgs );
        $args['atoms'] = $image + $args['atoms'];
    } elseif( $featured == 'after' ) {
        $args['atoms']['image'] = $featuredArgs;    
    } elseif( $featured == 'background' ) {
        $args['background'] = get_the_post_thumbnail_url( null, 'hd' );
    }  
    
    // Author
    if( is_single() ) {
        $author     = get_theme_option('customizer', 'post_header_author');
        
        if( $author ) {
            
            global $post;
            
            $args['atoms']['author'] = array(
                'avatar'        => get_avatar($post->post_author, 64),
                'description'   => false, 
                'imageFloat'    => 'left', 
                'prepend'       => __('Article by ', 'waterfall'),
                'style'         => 'entry-author'
            ); 
        }
    }
    
    /**
     * Meta styling
     */
    
    // Parallax
    if( is_page() ) {
        $parallax = get_theme_option('customizer', 'page_header_parallax');
    } elseif( is_single() ) {
        $parallax = get_theme_option('customizer', 'post_header_height');
    }    
    
    if( (isset($parallax['enable']) && $parallax['enable']) || $parallax == true )
        $args['parallax'] = true;      
    
    // Height
    if( is_page() ) {
        $args['height'] = get_theme_option('customizer', 'page_header_height');
    } elseif( is_single() ) {
        $args['height'] = get_theme_option('customizer', 'post_header_height');
    }
    
    // Scroll-button
    if( is_page() ) {
        $scroll = get_theme_option('customizer', 'page_header_scroll');
    } elseif( is_single() ) {
        $scroll = get_theme_option('customizer', 'post_header_scroll');
    }
    
    if( $scroll == 'default' ) {
        $args['atoms']['scroll'] = array('icon' => false);
    } elseif( $scroll == 'arrow' ) {
        $args['atoms']['scroll'] = array('icon' => 'angle-down');    
    }     
    
    $args = apply_filters( 'waterfall_content_header_args', $args );
    
    /**
     * Build our post header with the arguments
     */
    WP_Components\Build::molecule( 'post-header', $args );
    
}

/**
 * Renders the page or post content
 */
function waterfall_content() {
    
    $width = get_theme_option('meta', 'content_width');
    $container = $width == 'default' || ! $width ? true : false;
    
    echo '<div class="main-content">';
    
    if($container)
        echo '<div class="components-container">';
    
    // Our content
    WP_Components\Build::atom( 'content', array('style' => 'entry-content') );

    // Sidebars
    if( is_page() ) {
        $position = get_theme_option('customizer', 'page_layout');
        $sidebar = 'page';
    } elseif( is_single() ) {
        $position = get_theme_option('customizer', 'post_layout');
        $sidebar = 'post';
    } 
    
    if( $position == 'left' || $position == 'right' )
        WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($sidebar), 'style' => 'entry-sidebar') ); 
    
    if($container)
        echo '</div>';
    
    echo '</div>';
    
}

/**
 * Renders the related posts
 */
function waterfall_related() {

    $related    = get_theme_option('customizer', 'post_related');
    $paginate  = get_theme_option('customizer', 'post_related_pagination');
    
    if( $related || $paginate ) {
        
        echo '<aside class="main-related">';
        echo '<div class="components-container">';
        
        if( $related ) {
        
            global $post;

            // Base query
            $query = array( 'post__not_in' => array($post->ID), 'posts_per_page' => 3, 'post_type' => $post->post_type );

            // Include only categories from post
            $categories = get_the_category($post->ID);

            if( $categories ) {
                foreach($categories as $term) {
                    $query['cat'][] = $term->term_id;     
                }
            }

            $args = apply_filters('waterfall_related_args', array( 
                'args'          => $query,
                'contentAtoms'  => array(),
                'footerAtoms'   => array( 'button' => array('iconAfter' => 'angle-right', 'iconVisible' => 'hover', 'label' => __('View Post', 'waterfall'), 'size' => 'small') ),
                'image'         => array( 'link' => 'post', 'size' => 'square-ld', 'enlarge' => true ),
                'pagination'    => false,
                'postsAppear'   => 'bottom',
                'postsGrid'     => 'third',
                'view'          => 'grid',
            ) );       
        
            $title = get_theme_option('customizer', 'post_related_text');

            if( $title )
                echo '<h3>' . $title . '</h3>';

            WP_Components\Build::molecule( 'posts', $args );
                              
        } 
    
        if( $paginate ) {
            
            $args = array();

            $args = apply_filters('waterfall_related_paginate_args', array( 
                'type' => 'post', 
                'prev' => sprintf( __('&lsaquo; Previous Article %s', 'waterfall'), '<span>%title</span>'), 
                'next' => sprintf( __('Next Article &rsaquo; %s', 'waterfall'), '<span>%title</span>') 
            ) );
            
            WP_Components\Build::atom( 'pagination', $args );
        }          
        
        echo '</div>';
        echo '</aside>';
    }
    
}

/**
 * Renders the page or post content
 */
function waterfall_content_footer() {
    
    // Heading disabled
    $disable    = get_theme_option('meta', 'page_footer_disable');

    if( isset($disable['disable']) && $disable['disable'] )
        return;       
    
    $args = array(
        'style' => 'main-footer entry-footer'
    );
    
    /**
     * Retrieve our values
     */
    $author     = get_theme_option('customizer', 'post_footer_author');
    $share      = get_theme_option('customizer', 'post_footer_share');
    $comments   = get_theme_option('customizer', 'post_footer_comments');

    if( $share ) {
        $args['atoms']['share'] = array( 'fixed' => true );
    }
    
    if( $author ) {
        $args['atoms']['author'] = array( 'imageFloat' => 'left', 'style' => 'entry-author' );
    }      
    
    if( $comments ) {
        $args['atoms']['comments'] = array( 'closedText' => __('Comments are closed.', 'waterfall') );
    }    
    
    $args = apply_filters( 'waterfall_content_footer_args', $args );
    
    // Our content
    WP_Components\Build::molecule( 'post-footer', $args );
    
}

/**
 * Renders the header for content
 */
function waterfall_404_header() {
    
    $args = apply_filters( 'waterfall_404_header_args', array(
        'atoms' => array( 
            'title' => array('tag' => 'h1', 'title' => __('Woops! Nothing found here...', 'waterfall')), 
            'description' => array('description' => __('Try visiting another page or searching.', 'waterfall')), 
            'search' => array() 
        ),
        'height' => 'normal',
        'style' => 'main-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args ); 
    
}