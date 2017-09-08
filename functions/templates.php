<?php
/**
 * Main templating functions
 * To primary purpose of these templating functions is to clean up the template
 */

/**
 * Renders the header elements
 */
function waterfall_header() {
    
    $disable    = is_singular() ? get_theme_option('meta', 'disable_header') : '';
    $disable    = $disable ? $disable : array('disable' => false);    
    $customizer = get_theme_option('layout', 'header_disable');

    // Our header is only shown if enabled
    if( $disable['disable'] == true || $customizer === true )
        return; 
    
    // Default attributes
    $logo           = is_numeric( get_theme_option('customizer', 'logo') ) ? wp_get_attachment_image_src( get_theme_option('customizer', 'logo'), 'large' ) : false;
    $transparent    = is_singular() && get_theme_option('meta', 'transparent_header') 
        ? get_theme_option('meta', 'transparent_header') 
        : get_theme_option('layout', 'header_transparent');

    // Default header items
    $atoms = array(
        'logo'  => array( 
            'float'             => get_theme_option('layout', 'header_logo_float'),
            'logoHeight'        => $logo ? $logo[2] : '',
            'image'             => $logo ? $logo[0] : get_template_directory_uri() . '/assets/img/waterfall.png', 
            'mobile'            => get_theme_option('customizer', 'logo_mobile'), 
            'mobileTransparent' => get_theme_option('customizer', 'logo_mobile_transparent'), 
            'transparent'       => get_theme_option('customizer', 'logo_transparent'),
            'logoWidth'         => $logo ? $logo[1] : ''
        ),
        'menu'  => array( 
            'all'           => get_theme_option('layout', 'header_menu_all') ? get_theme_option('layout', 'header_menu_all') : __('View All Results', 'waterfall'), 
            'args'          => array('theme_location' => 'header-menu'), 
            'cart'          => get_theme_option('layout', 'header_menu_cart') ? true : false, 
            'float'         => get_theme_option('layout', 'header_menu_float'),
            'hamburger'     => get_theme_option('layout', 'header_menu_hamburger'),
            'none'          => get_theme_option('layout', 'header_menu_none') ? get_theme_option('layout', 'header_menu_none') : __('Nothing found!', 'waterfall'),
            'search'        => get_theme_option('layout', 'header_menu_search') ? true : false,
            'view'          => get_theme_option('layout', 'header_menu_style')
        )                
    );

    // Social icons
    if( get_theme_option('layout', 'header_menu_social') ) {
        $networks = get_social_networks();

        if( $networks ) {
            $atoms['menu']['social'] = $networks;
        }
    }        

    // Reset the order for right floats
    if( get_theme_option('layout', 'header_menu_float') == 'right') {
        $menu = $atoms['menu'];
        unset($atoms['menu']);
        $atoms['menu'] = $menu;
    } 
    
    
    // Disable logo or menu
    if( get_theme_option('layout', 'header_disable_logo') )
        unset( $atoms['logo'] );    

    if( get_theme_option('layout', 'header_disable_menu') )
        unset( $atoms['menu'] );  

    $args = apply_filters( 'waterfall_header_args', array(
        'atoms'         => apply_filters('waterfall_header_atoms', $atoms),
        'container'     => get_theme_option('layout', 'header_width') == 'default' ? true : false,
        'headroom'      => get_theme_option('layout', 'header_headroom') ? true : false,
        'fixed'         => get_theme_option('layout', 'header_fixed'),
        'style'         => 'header',
        'transparent'   => isset($transparent['transparent']) ? $transparent['transparent'] : $transparent
    ) );

    // Build the header! 
    WP_Components\Build::molecule( 'header', $args );

    
}

/**
 * Renders the footer elements
 */
function waterfall_footer() {
    
    /**
     * Retrieves and displays our footer
     */
    $disable    = is_singular() ? get_theme_option('meta', 'disable_footer') : '';
    $disable    = $disable ? $disable : array('disable' => false);
    
    $sidebars   = get_theme_option('layout', 'footer_display_sidebars');  
    $socket     = get_theme_option('layout', 'footer_display_socket');  

    // We should display the footer
    if( $disable['disable'] === true || ($sidebars === false && $socket === false) ) 
        return;

    $atoms          = array();
    $container      = get_theme_option('layout', 'footer_width');
    $copyright      = get_theme_option('layout', 'footer_copyright');
    $logo           = get_theme_option('layout', 'footer_logo');
    $menu           = get_theme_option('layout', 'footer_menu');
    $sidebarGrid    = $sidebars === false ? 'none' : get_theme_option('layout', 'footer_sidebars');
    $social         = get_theme_option('layout', 'footer_social');

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
    if( is_numeric($logo) && $socket !== false ) {
        $logo = wp_get_attachment_image_src( $logo, 'medium' );
        
        $atoms['logo'] = array(
            'float'         => 'center',
            'logoHeight'    => $logo[2],
            'logoWidth'     => $logo[1],
            'image'         => $logo[0]
        );
    }       

    // Copyright Message
    if( $copyright && $socket !== false ) {
        $atoms['copyright'] = array(
            'float'     => 'left',
            'name'      => get_theme_option('layout', 'footer_copyright_name'),
            'schema'    => get_theme_option('layout', 'footer_copyright_schema')
        );
    }

    // Social Icons
    if( $social && $socket !== false ) {

        $networks = get_social_networks();

        if( $networks ) {
            $atoms['social'] = array(
                'rounded'   => true,
                'float'     => 'right',
                'urls'      => $networks
            );
        }                
    }


    // Menu
    if( $menu && $socket !== false ) {
        $atoms['menu'] = array(
            'args'          => array('theme_location' => 'footer-menu'), 
            'float'         => 'right',
            'dropdown'      => false,
            'hamburger'     => 'none',
        );
    }

    $args = apply_filters( 'waterfall_footer_args', array(
        'atoms'         => apply_filters('waterfall_footer_atoms', $atoms),
        'sidebars'      => $sidebars,
        'container'     => $container == 'full' ? false : true,
        'style'         => 'footer'
    ) );

    // Build the footer! 
    WP_Components\Build::molecule( 'footer', $args );
    
}

/**
 * Renders the archive titles
 */
function waterfall_archive_header() {
    
    $types = array('archive', 'search');
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() || ( is_home() && $type == 'archive') ) {
            $align          = get_theme_option('layout', $type . '_header_align');
            $breadcrumbs    = get_theme_option('layout', $type . '_breadcrumbs');
            $disable        = get_theme_option('layout', $type . '_header_disable');
            $height         = get_theme_option('layout', $type . '_header_height');            
            $width          = get_theme_option('layout', $type . '_header_width');            
        }
        
    }
    
    // Return if we do not want to show the header
    if( $disable === true ) 
        return;

    // Breadcrumbs
    if( $breadcrumbs ) {
        $atoms['breadcrumbs'] = array();    
    }
    
    // Default title
    $atoms['archive-title'] = array('style' => 'page-title');    
    
    // Add searchform
    if( is_search() ) {     
        $atoms['search'] = array();
    }
    
    $args = apply_filters('waterfall_archive_header_args', array(
        'atoms'     => $atoms,
        'align'     => $align,
        'container' => $width == 'full' ? false : true,
        'height'    => $height,
        'style'     => 'main-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args );    
}

/**
 * Renders the posts within an archive
 */
function waterfall_archive_posts() {
    
    $types = array('archive', 'search');
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() || ( is_home() && $type == 'archive') ) {        
            $label       = get_theme_option('layout', $type . '_grid_button_label');         
            $columns     = get_theme_option('layout', $type . '_grid_columns');         
            $content     = get_theme_option('layout', $type . '_grid_content');         
            $image       = get_theme_option('layout', $type . '_grid_image');         
            $imageFloat  = get_theme_option('layout', $type . '_grid_image_float');         
            $height      = get_theme_option('layout', $type . '_grid_height');         
            $layout      = get_theme_option('layout', $type . '_layout');  
            $postType    = get_theme_option('layout', $type . '_grid_type');  
            $style       = get_theme_option('layout', $type . '_grid_style');                
            $width       = get_theme_option('layout', $type . '_grid_width'); 
            $location    = $type;
        }
        
    }
    
    global $wp_query;
    
    $args = apply_filters( 'waterfall_archive_posts_args', array(
        'contentAtoms'      => $content == 'none' ? array() : array( 'content' => array('type' => 'excerpt') ),
        'headerAtoms'       => $postType 
            ? array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ), 'type' => array('style' => 'entry-meta') ) 
            : array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ) ),
        'footerAtoms'       => array( 'button' => array( 'link' => 'post', 'label' => $label, 'size' => 'small', 'float' => 'right') ),
        'image'             => array( 
            'link'      => 'post', 
            'size'      => $image ? $image : 'medium', 
            'enlarge'   => 'true', 
            'float'     => $imageFloat ? $imageFloat : 'none', 
            'lazyload'  => get_theme_option('customizer', 'lazyload') 
        ),
        'postsAppear'       => 'bottom',
        'postsGrid'         => $columns ? $columns : 'third',
        'postsInlineStyle'  => $height ? 'min-height:' . $height . 'px;' : '',
        'style'             => 'content',
        'view'              => $style ? $style : 'grid',
        'query'             => $wp_query    
    ) );    
    
    
    /** 
     * The actual output for this section
     */
    if( $width != 'full' )
        echo '<div class="components-container">';
    
        do_action('waterfall_before_archive_posts');
    
        // The posts
        WP_Components\Build::molecule( 'posts', $args );
    
        do_action('waterfall_after_archive_posts');
    
        // The sidebar
        if( $layout == 'left' || $layout == 'right' )
            WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($location), 'style' => 'sidebar') );
    
        do_action('waterfall_after_archive_sidebar');
    
    if( $width != 'full' )
        echo '</div>';    
    
}


/**
 * Renders the header for content
 */
function waterfall_content_header() {
 
    // Heading disabled
    $customizer = is_page() ? get_theme_option('layout', 'page_header_disable') : get_theme_option('layout', 'single_header_disable');
    $disable    = get_theme_option('meta', 'page_header_disable');

    if( (isset($disable['disable']) && $disable['disable']) || $customizer === true )
        return;      
     
    // Default arguments
    $args = array(
        'lazyload'  => get_theme_option('customizer', 'lazyload'),
        'style'     => 'main-header entry-header'
    );
    
    /**
     * Conditional settings
     */
    $types = array('page', 'single');
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() ) {
            
            $args['align']      = get_theme_option('layout', $type . '_header_align');
            $args['height']     = has_post_thumbnail() 
                ? get_theme_option('layout', $type . '_header_height_image') 
                : get_theme_option('layout', $type . '_header_height');
            $args['parallax']   = get_theme_option('layout', $type . '_header_parallax');
            $breadcrumbs        = get_theme_option('layout', $type . '_header_breadcrumbs');
            $featured           = get_theme_option('layout', $type . '_header_featured');
            $featuredArgs       = array( 'size' => get_theme_option('layout', $type . '_header_size'), 'lazyload' => get_theme_option('customizer', 'lazyload') ); 
            $scroll             = get_theme_option('layout', $type . '_header_scroll');
            $subtitle           = get_theme_option('meta', 'page_header_subtitle');
            $width              = get_theme_option('layout', $type . '_header_width');
            
            // Author, date and time
            $author             = get_theme_option('layout', $type . '_header_author');            
            $date               = get_theme_option('layout', $type . '_header_date');
            $terms              = get_theme_option('layout', $type . '_header_terms'); 
            
        }
    }
    
    // Container
    $args['container'] = $width == 'full' ? false : true;   
                                               
    /**
     * Elements
     */
    if( $breadcrumbs ) {
        $args['atoms']['breadcrumbs'] = array('archive' => false);  
    }    
    
    // Title
    $args['atoms']['title'] = array('tag' => 'h1', 'style' => 'entry-title');   
    
    // Subtitle  
    if( $subtitle )
        $args['atoms']['description'] = array( 'description' =>  $subtitle );
        
    // Time
    if( $date ) {
        $args['atoms']['date'] = array( 'style' => 'entry-time' );    
    }

    // Terms
    if( $terms ) {
        $args['atoms']['termlist'] = array( 'style' => 'entry-meta' );    
    }             

    // Featured image
    if( $featured == 'before' ) { 
        $image = array( 'image' => $featuredArgs );
        $args['atoms'] = $image + $args['atoms'];
    } elseif( $featured == 'after' ) {
        $args['atoms']['image'] = $featuredArgs;    
    } elseif( $featured == 'background' ) {
        $args['background'] = get_the_post_thumbnail_url( null, 'hd' );
    } 
                                               
        
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
   
    // Scroll-button
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
    
    $customizer = is_page() ? get_theme_option('layout', 'page_content_width') : get_theme_option('layout', 'single_content_width');
    $full       = get_theme_option('meta', 'content_width');
    
    $position   = is_page() ? get_theme_option('layout', 'page_layout') : get_theme_option('layout', 'single_layout');
    $readable   = is_page() ? get_theme_option('layout', 'page_content_readable') : get_theme_option('layout', 'single_content_readable');
    $sidebar    = is_page() ? 'page' : 'single';
    
    $style      = $readable ? 'entry-content readable-content content' : 'entry-content content';
    
    echo '<div class="main-content">';
    
    if( $customizer != 'full' && ( isset($full['full']) && ! $full['full'] ) || ($customizer != 'full' && ! $full) )
        echo '<div class="components-container">';
    
    do_action('waterfall_before_the_content');
    
    // Our content
    WP_Components\Build::atom( 'content', array('style' => $style) );
    
    do_action('waterfall_after_the_content');
    
    // Sidebars
    if( ($position == 'left' || $position == 'right') && (isset($full['full']) && ! $full['full']) )
        WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($sidebar), 'style' => 'sidebar') ); 
    
    do_action('waterfall_after_single_sidebars');
    
    if( $customizer != 'full' && (isset($full['full']) && ! $full['full']) || ($customizer != 'full' && ! $full) )
        echo '</div>';
    
    echo '</div>';
    
}

/**
 * Renders the related posts
 */
function waterfall_related() {

    $disable    = get_theme_option('meta', 'page_related_disable');
    $customizer = get_theme_option('layout', 'single_related_disable');
    
    $related    = get_theme_option('layout', 'single_related');
    $button     = get_theme_option('layout', 'single_related_button');
    $grid       = get_theme_option('layout', 'single_related_grid');
    $height     = get_theme_option('layout', 'single_related_height');
    $number     = get_theme_option('layout', 'single_related_number');
    $title      = get_theme_option('layout', 'single_related_text');
    $width      = get_theme_option('layout', 'single_related_width');
    
    $paginate   = get_theme_option('layout', 'single_related_pagination');
    $prev       = get_theme_option('layout', 'single_related_pagination_prev');
    $next       = get_theme_option('layout', 'single_related_pagination_next');   
    
    if( (isset($disable['disable']) && $disable['disable']) || $customizer === true )
        return;
    
    if( $related || $paginate ) {
        
        echo '<aside class="main-related">';
        
        if( $width != 'full' )
            echo '<div class="components-container">';
        
        if( $related ) {
        
            global $post;

            // Base query
            $query = array( 'post__not_in' => array($post->ID), 'posts_per_page' => $number ? $number : 3, 'post_type' => $post->post_type );

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
                'footerAtoms'   => array(
                    'button' => array(
                        'iconAfter'     => 'angle-right', 
                        'iconVisible'   => 'hover', 
                        'label'         => $button, 
                        'size'          => 'small'
                    ) 
                ),
                'image'         => array( 'link' => 'post', 'size' => 'square-ld', 'enlarge' => true, 'lazyload' => get_theme_option('customizer', 'lazyload') ),
                'pagination'    => false,
                'postsAppear'   => 'bottom',
                'postsGrid'     => $grid ? $grid : 'third',
                'postsInlineStyle'  => $height ? 'min-height:' . $height . 'px;' : '',
                'view'          => 'grid',
            ) ); 
        
            // Title
            $title = get_theme_option('layout', 'single_related_text');

            if( $title )
                echo '<h3>' . $title . '</h3>';

            WP_Components\Build::molecule( 'posts', $args );
                              
        } 
    
        if( $paginate ) {
            
            $args = array();

            $args = apply_filters('waterfall_related_paginate_args', array( 
                'type' => 'post', 
                'prev' => '<span>' . $prev . '</span>%title', 
                'next' => '<span>' . $next . '</span>%title' 
            ) );
            
            WP_Components\Build::atom( 'pagination', $args );
        }          
        
        if( $width != 'full' )
            echo '</div>';
        
        echo '</aside>';
        
    }
    
}

/**
 * Renders the page or post content
 */
function waterfall_content_footer() {
    
    // Footer disabled
    $disable    = get_theme_option('meta', 'page_footer_disable');
    $customizer = get_theme_option('layout', 'single_footer_disable');
    
    if( (isset($disable['disable']) && $disable['disable']) || $customizer === true )
        return;


    /**
     * Retrieve our values
     */
    $author     = get_theme_option('layout', 'single_footer_author');
    $comments   = get_theme_option('layout', 'single_footer_comments');
    $share      = get_theme_option('layout', 'single_footer_share');
    $width      = get_theme_option('layout', 'single_footer_width');
    
    // Default arguments
    $args = array(
        'container' => $width == 'full' ? false : true,
        'style' => 'main-footer entry-footer'
    );
        
    // Sharing Buttons
    if( $share ) {
        $args['atoms']['share'] = array( 'fixed' => true );
        $networks = array('facebook', 'twitter', 'linkedin', 'google-plus', 'pinterest', 'reddit', 'stumbleupon', 'pocket', 'whatsapp');
        
        // Networks should be enabled
        foreach($networks as $network) {
            if( get_theme_option( 'layout', 'single_share_' . $network ) )
                $args['atoms']['share']['enabled'][] = $network;
        }
    }
    
    // Author
    if( $author ) {
        $args['atoms']['author'] = array( 'imageFloat' => 'left', 'style' => 'entry-author' );
    }      
    
    // Comments
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
    
    $height         =  get_theme_option('layout', '404_header_height');
    $width          =  get_theme_option('layout', '404_header_width');
    $align          =  get_theme_option('layout', '404_header_align');
    $title          =  get_theme_option('layout', '404_title');
    $description    =  get_theme_option('layout', '404_description');
    $breadcrumbs    =  get_theme_option('layout', '404_header_breadcrumbs');
    $search         =  get_theme_option('layout', '404_header_search');
    
    $args = array(
        'align'     => $align,
        'atoms'     => array(),
        'height'    => $height,
        'style'     => 'main-header'        
    );
    
    // Breadcrumbs
    if( $breadcrumbs )
       $args['atoms']['breadcrumbs'] = array();
    
    // YUP
    $args['atoms']['title']         = array( 'tag' => 'h1', 'title' => $title ? $title : __('Woops! Nothing found here...', 'waterfall') ); 
    $args['atoms']['description']   = array( 'description' => $description ? $description : __('Try visiting another page or searching.', 'waterfall') ); 
    
    // Search
    if( $search )
        $args['atoms']['search'] = array();
    
    $args = apply_filters( 'waterfall_404_header_args', $args );
    
    WP_Components\Build::molecule( 'post-header', $args ); 
    
}

/**
 * Retrieves the display for a single product generated by woocommerce
 */
function waterfall_single_product() {
    
    $breadcrumbs = get_theme_option('layout', 'product_breadcrumbs');
    $layout      = get_theme_option('layout', 'product_layout');
    $width       = get_theme_option('layout', 'product_width');

    echo '<div class="main-content">';
    
    if( $width != 'full' )
        echo '<div class="components-container">';
    
        if( $breadcrumbs )
            WP_Components\Build::atom(
                'breadcrumbs', 
                apply_filters( 'waterfall_single_product_breadcrumbs', ['taxonomy' => true, 'archive' => true] ) 
            );
    
        do_action('waterfall_before_single_product_content');
    
        echo '<div class="content">';

            /**
             * Retrieves the loop for the single product from woocommerce
             */
            while ( have_posts() ) : the_post();

                wc_get_template_part( 'content', 'single-product' );

            endwhile; // end of the loop.
    
        echo '</div>';
    
        do_action('waterfall_after_single_product_content');
    
        // Sidebars
        if( $layout == 'left' || $layout == 'right' )
            WP_Components\Build::molecule( 'sidebar', ['sidebars' => ['product'], 'style' => 'sidebar'] ); 
    
        do_action('waterfall_after_single_product_sidebar');
    
    
    if( $width != 'full' )
        echo '</div>';
    
    echo '</div>';    
}

/**
 * Displays the header for a product archive
 */
function waterfall_product_archive_header() {
    
    $align          = get_theme_option('layout', 'product_archive_header_align');
    $breadcrumbs    = get_theme_option('layout', 'product_archive_header_breadcrumbs');
    $disable        = get_theme_option('layout', 'product_archive_header_disable');
    $height         = get_theme_option('layout', 'product_archive_header_height');
    $width          = get_theme_option('layout', 'product_archive_header_width');
    
    // Return if we do not want to show the header
    if( $disable === true ) 
        return;

    // Breadcrumbs
    if( $breadcrumbs ) {
        $atoms['breadcrumbs'] = array();    
    }
    
    // Default title
    if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
        $atoms['archive-title'] = array('style' => 'woocommerce-products-header__title page-title', 'custom' => woocommerce_page_title(false) );    
    }
    
    // Add custom action as a a string
    ob_start();
        do_action( 'woocommerce_archive_description' );
    $string = ob_get_clean();
    $atoms['string'] = array( 'string' => $string );
    
    $args = apply_filters('waterfall_archive_title_args', array(
        'atoms'     => $atoms,
        'align'     => $align,
        'container' => $width == 'full' ? false : true,
        'height'    => $height,
        'style'     => 'main-header woocommerce-products-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args );
    
}

/**
 * Displays the header for a product archive
 */
function waterfall_product_archive_posts() {
    
    $layout      = get_theme_option('layout', 'product_archive_layout');                
    $width       = get_theme_option('layout', 'product_archive_width');  
    
    /** 
     * The actual output for this section
     */
    if( $width != 'full' )
        echo '<div class="components-container">';
    
        do_action('waterfall_before_product_archive_posts');
    
        echo '<div class="content">';

            if ( have_posts() ) :

                /**
                 * woocommerce_before_shop_loop hook.
                 *
                 * @hooked wc_print_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();

                woocommerce_product_subcategories();

                while ( have_posts() ) : the_post();


                    /**
                     * woocommerce_shop_loop hook.
                     *
                     * @hooked WC_Structured_Data::generate_product_data() - 10
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' ); 

                endwhile; // end of the loop.

                woocommerce_product_loop_end();

                /**
                 * woocommerce_after_shop_loop hook.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );


            elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :

                /**
                 * woocommerce_no_products_found hook.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );

            endif;
    
        echo '</div>';
    
        do_action('waterfall_after_product_archive_posts');
    
        // The sidebar
        if( $layout == 'left' || $layout == 'right' )
            WP_Components\Build::molecule( 'sidebar', array('sidebars' => array('product-archive'), 'style' => 'sidebar') );

        do_action('waterfall_after_product_archive_sidebar');    
    
    
    if( $width != 'full' )
        echo '</div>';    
    
}