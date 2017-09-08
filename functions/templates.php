<?php
/**
 * Main templating functions
 * To primary purpose of these templating functions is to clean up the template
 */

/**
 * Renders the header elements
 */
function waterfall_header() {
    
    $disable    = is_singular() ? get_theme_option( 'meta', 'disable_header' ) : false;
    $disable    = $disable ? $disable : array('disable' => false);    
    $customizer = get_theme_option( 'layout', 'header_disable' );

    // Our header is only shown if enabled
    if( $disable['disable'] == true || $customizer === true )
        return; 
    
    /**
     * Default attributes
     */   
    $properties = array( 
        'border',
        'disable_logo',
        'disable_menu',
        'fixed',
        'logo_float',
        'headroom',
        'menu_all',
        'menu_cart',
        'menu_float',
        'menu_hamburger',
        'menu_none',
        'menu_search',
        'menu_social',
        'menu_style',
        'transparent', 
        'width' 
    );
    $settings = get_element_properties( $properties, 'header_' );
    
    // Grab the logo
    $logo           = is_numeric( get_theme_option('customizer', 'logo') ) ? wp_get_attachment_image_src( get_theme_option('customizer', 'logo'), 'large' ) : false;

    /**
     * Default header items
     */
    $atoms = array(
        'logo'  => array( 
            'float'             => $settings['logo_float'] ? $settings['logo_float'] : 'left',
            'logoHeight'        => $logo ? $logo[2] : 64,
            'image'             => $logo ? $logo[0] : get_template_directory_uri() . '/assets/img/waterfall.png', 
            'mobile'            => get_theme_option('customizer', 'logo_mobile'), 
            'mobileTransparent' => get_theme_option('customizer', 'logo_mobile_transparent'), 
            'transparent'       => get_theme_option('customizer', 'logo_transparent'),
            'logoWidth'         => $logo ? $logo[1] : 306
        ),
        'menu'  => array( 
            'all'           => $settings['menu_all'] ? $settings['menu_all'] : __('View All Results', 'waterfall'), 
            'args'          => array('theme_location' => 'header-menu'), 
            'cart'          => $settings['menu_cart'] ? true : false, 
            'float'         => $settings['menu_float'] ? $settings['menu_float'] : 'right',
            'hamburger'     => $settings['menu_hamburger'] ? $settings['menu_hamburger'] : 'mobile',
            'none'          => $settings['menu_none'] ? $settings['menu_none'] : __('Nothing found!', 'waterfall'),
            'search'        => $settings['menu_search'] ? true : false,
            'view'          => $settings['menu_style'] ? $settings['menu_style'] : 'default'
        )                
    );

    // Social icons
    if( $settings['menu_social'] ) {
        $networks = get_social_networks();

        if( $networks ) {
            $atoms['menu']['social'] = $networks;
        }
    }        

    // Reset the order for right floats
    if( $settings['menu_float'] == 'right') {
        $menu = $atoms['menu'];
        unset($atoms['menu']);
        $atoms['menu'] = $menu;
    } 
    
    // Disable logo or menu
    if( $settings['disable_logo'] )
        unset( $atoms['logo'] );    

    if( $settings['disable_menu'] )
        unset( $atoms['menu'] ); 
    
    // Set-up our transparency
    $meta           = is_singular() ? get_theme_option('meta', 'transparent_header') : array();
    $transparent    = isset($meta['transparent']) && $meta['transparent'] ? $meta['transparent'] : $settings['transparent'];  

    $args = apply_filters( 'waterfall_header_args', array(
        'atoms'         => $atoms,
        'container'     => $settings['width'] == 'default' ? true : false,
        'headroom'      => $settings['headroom'],
        'fixed'         => $settings['fixed'],
        'style'         => $settings['border'] ? 'header waterfall-no-border' : 'header',
        'transparent'   => $transparent
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
    $disable    = is_singular() ? get_theme_option('meta', 'disable_footer') : false;
    $disable    = $disable ? $disable : array('disable' => false); 

    // We should not display the footer if disabled
    if( $disable['disable'] === true ) 
        return;

    
    /*
     * Default properties
     */
    $atoms      = array();
    $properties = array('copyright', 'display_sidebars', 'display_socket', 'logo', 'menu', 'sidebars', 'social', 'width');
    $settings   = get_element_properties( $properties, 'footer_' );
    
    // Return if both sidebars and socket are disabled
    if( $settings['display_sidebars'] === false && $settings['display_socket'] === false )
        return;

    /**
     * Sidebars
     */
    switch( $settings['sidebars'] ) {
        case 'full':
            $sidebarGrid = array('footer-one' => 'full');
            break;
        case 'half':
            $sidebarGrid = array('footer-one' => 'half', 'footer-two' => 'half');
            break;
        case 'third':
            $sidebarGrid = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
            break;
        case 'fourth':
            $sidebarGrid = array('footer-one' => 'fourth', 'footer-two' => 'fourth', 'footer-three' => 'fourth', 'footer-four' => 'fourth');
            break;
        case 'fifth':
            $sidebarGrid = array('footer-one' => 'fifth', 'footer-two' => 'fifth', 'footer-three' => 'fifth', 'footer-four' => 'fifth', 'footer-five' => 'fifth');
            break;
        default:
            $sidebarGrid = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
    }
    
    // We do not have sidebars if we have disabled them.
    if( $settings['display_sidebars'] == false )
        $sidebarGrid = array();    

    // Logo
    if( is_numeric($settings['logo']) && $socket !== false ) {
        $logo = wp_get_attachment_image_src( $settings['logo'], 'medium' );
        $atoms['logo'] = array(
            'float'         => 'center',
            'logoHeight'    => $logo[2],
            'logoWidth'     => $logo[1],
            'image'         => $logo[0]
        );
    }       

    // Copyright Message
    if( $settings['copyright'] && $settings['display_socket'] !== false ) {
        $atoms['copyright'] = array(
            'float'     => 'left',
            'name'      => get_theme_option('layout', 'footer_copyright_name'),
            'schema'    => get_theme_option('layout', 'footer_copyright_schema')
        );
    }

    // Social Icons
    if( $settings['social'] && $settings['display_socket'] !== false ) {

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
    if( $settings['menu'] && $settings['display_socket'] !== false ) {
        $atoms['menu'] = array(
            'args'          => array('theme_location' => 'footer-menu'), 
            'float'         => 'right',
            'dropdown'      => false,
            'hamburger'     => 'none',
        );
    }

    $args = apply_filters( 'waterfall_footer_args', array(
        'atoms'         => $atoms,
        'sidebars'      => $sidebarGrid,
        'container'     => $settings['width'] == 'full' ? false : true,
        'style'         => 'footer'
    ) );

    // Build the footer! 
    WP_Components\Build::molecule( 'footer', $args );
    
}

/**
 * Renders the archive titles
 */
function waterfall_archive_header() {
    
    /**
     * Default properties
     */
    $properties = array('align', 'breadcrumbs', 'disable', 'height', 'width' );
    $types      = array('archive', 'search');
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() || ( is_home() && $type == 'archive') ) {
            $settings = get_element_properties( $properties, $type . '_header_' );          
        }
        
    }
    
    // Return if we do not want to show the header
    if( $settings['disable'] === true ) 
        return;

    // Breadcrumbs
    if( $settings['breadcrumbs'] ) {
        $atoms['breadcrumbs'] = array();    
    }
    
    // Default title
    $atoms['archive-title'] = array('style' => 'page-title');    
    
    // Add searchform
    if( is_search() ) {     
        $atoms['search'] = array();
    }
    
    $args = apply_filters( 'waterfall_archive_header_args', array(
        'atoms'     => $atoms,
        'align'     => $settings['align'],
        'container' => $settings['width'] == 'full' ? false : true,
        'height'    => $settings['height'],
        'style'     => 'main-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args );    
}

/**
 * Renders the posts within an archive
 */
function waterfall_archive_posts() {
    
    $properties = array( 'button_label', 'columns', 'image', 'image_float', 'height', 'type', 'style', 'width');
    $types      = array( 'archive', 'search' );
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() || ( is_home() && $type == 'archive') ) { 
            
            $settings           = get_element_properties( $properties, $type , '_grid_' );
            $settings['layout'] = get_theme_option('layout', $type . '_layout');
            $location           = $type;
        }
        
    }
    
    // Retrieve our global query.
    global $wp_query;
    
    $args = apply_filters( 'waterfall_archive_posts_args', array(
        'contentAtoms'      => $content == 'none' ? array() : array( 'content' => array('type' => 'excerpt') ),
        'headerAtoms'       => $settings['type'] 
            ? array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ), 'type' => array('style' => 'entry-meta') ) 
            : array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ) ),
        'footerAtoms'       => array( 
            'button' => array( 
                'float' => 'right',
                'link'  => 'post', 
                'label' => $settings['button_label'] ? $settings['button_label'] : __('View Post', 'waterfall'), 
                'size'  => 'small'
            ) 
        ),
        'image'             => array( 
            'link'      => 'post', 
            'size'      => $settings['image'] ? $settings['image'] : 'medium', 
            'enlarge'   => 'true', 
            'float'     => $settings['image_float'] ? $settings['image_float'] : 'none', 
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

    /**
     * Conditional settings
     */
    $properties = array( 'align', 'author', 'breadcrumbs', 'date', 'featured', 'parallax', 'scroll', 'size', 'terms', 'width' );
    $types      = array( 'page', 'single' );
    
    foreach( $types as $type ) {
        $condition = 'is_' . $type;
        
        if( $condition() ) {
            
            $settings = get_element_properties( $properties, $type . '_header_' );
            $settings['height']         = has_post_thumbnail() 
                ? get_theme_option('layout', $type . '_header_height_image') 
                : get_theme_option('layout', $type . '_header_height'); 
            $settings['subtitle']       = get_theme_option('meta', 'page_header_subtitle'); 
            
            $settings['featuredArgs']   = array( 
                'size'      => $settings['size'] ? $settings['size'] : 'half-hd', 
                'lazyload'  => get_theme_option( 'customizer', 'lazyload' ) 
            );            
            
        }
        
    }
    
     
    /**
     * Default arguments
     */
    $args = array(
        'lazyload'  => get_theme_option( 'customizer', 'lazyload' ),
        'style'     => 'main-header entry-header'
    );    

    
    /** 
     * Default attributes
     */
    $args['align']      = $settings['align'] ? $settings['align'] : 'left';   
    $args['container']  = $settings['width'] == 'full' ? false : true;   
    $args['height']     = $settings['height'] ? $settings['height'] : true;   
    $args['parallax']   = $settings['parallax'];   
                                               
    
    /**
     * Elements
     */
    if( $settings['breadcrumbs'] ) {
        $args['atoms']['breadcrumbs'] = array('archive' => false);  
    }    
    
    // Title
    $args['atoms']['title'] = array('tag' => 'h1', 'style' => 'entry-title');   
    
    // Subtitle  
    if( $settings['subtitle']  )
        $args['atoms']['description'] = array( 'description' =>  $subtitle );
        
    // Time
    if( $settings['date']  ) {
        $args['atoms']['date'] = array( 'style' => 'entry-time' );    
    }

    // Terms
    if( $settings['terms']  ) {
        $args['atoms']['termlist'] = array( 'style' => 'entry-meta' );    
    }             

    // Featured image
    $featured = $settings['featured'] ? $settings['featured'] : 'after';
    
    if( $featured == 'before' ) {
        $args['atoms'] = array( 'image' => $settings['featuredArgs'] ) + $args['atoms'];
    } elseif( $featured == 'after' ) {
        $args['atoms']['image'] = $settings['featuredArgs'];    
    } elseif( $featured == 'background' ) {
        $args['background'] = get_the_post_thumbnail_url( null, 'hd' );
    } 
                                               
        
    if( $settings['author'] ) {

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
    if( $settings['scroll'] == 'default' ) {
        $args['atoms']['scroll'] = array('icon' => false);
    } elseif( $settings['scroll'] == 'arrow' ) {
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
    $style      = $readable ? 'entry-content readable-content content' : 'entry-content content'; ?>
    
    <div class="main-content">
    
        <?php if( $customizer != 'full' && ( isset($full['full']) && ! $full['full'] ) || ($customizer != 'full' && ! $full) ) { ?>
            <div class="components-container">
        <?php } ?>
    
        <?php
            do_action('waterfall_before_the_content');

            // Our content
            WP_Components\Build::atom( 'content', array('style' => $style) );

            do_action('waterfall_after_the_content');

            // Sidebars
            if( ($position == 'left' || $position == 'right') && (isset($full['full']) && ! $full['full']) )
                WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($sidebar), 'style' => 'sidebar') ); 

            do_action('waterfall_after_single_sidebars');
        ?>
    
        <?php if( $customizer != 'full' && ( isset($full['full']) && ! $full['full'] ) || ($customizer != 'full' && ! $full) ) { ?>
            </div>
        <?php } ?>
    
    </div>

    <?php  
}

/**
 * Renders the related posts
 */
function waterfall_related() {

    $disable    = get_theme_option('meta', 'page_related_disable');
    $customizer = get_theme_option('layout', 'single_related_disable');
    
    if( (isset($disable['disable']) && $disable['disable']) || $customizer === true )
        return;
    
    // Properties
    $properties = array( 'posts', 'button', 'grid', 'height', 'number', 'pagination', 'pagination_next', 'pagination_prev', 'text', 'width' );
    $settings   = get_element_properties( $properties, 'single_related_' );    
    
    if( $settings['posts'] || $settings['pagination'] ) { ?>
        
        <aside class="main-related">
        
            <?php if( $width != 'full' ) { ?> 
                <div class="components-container">
            <?php } ?>
                    
            <?php 
        
                if( $settings['posts'] ) {

                    global $post;

                    // Base query
                    $query = array( 
                        'post__not_in'      => array($post->ID), 
                        'posts_per_page'    => $settings['number'] ? $settings['number'] : 3, 
                        'post_type'         => $post->post_type 
                    );

                    // Include only categories from post
                    $categories = get_the_category($post->ID);

                    if( $categories ) {
                        foreach($categories as $term) {
                            $query['cat'][] = $term->term_id;     
                        }
                    }

                    $args = apply_filters('waterfall_related_args', array( 
                        'args'              => $query,
                        'contentAtoms'      => array(),
                        'footerAtoms'       => array(
                            'button' => array(
                                'iconAfter'     => 'angle-right', 
                                'iconVisible'   => 'hover', 
                                'label'         => $settings['button'] ? $settings['button'] : __( 'View Post', 'waterfall' ), 
                                'size'          => 'small'
                            ) 
                        ),
                        'image'             => array( 
                            'link'      => 'post', 
                            'size'      => 'square-ld', 
                            'enlarge'   => true, 
                            'lazyload'  => get_theme_option('customizer', 'lazyload') 
                        ),
                        'pagination'        => false,
                        'postsAppear'       => 'bottom',
                        'postsGrid'         => $settings['grid'] ? $settings['grid'] : 'third',
                        'postsInlineStyle'  => $settings['height'] ? 'min-height:' . $settings['height'] . 'px;' : '',
                        'view'              => 'grid',
                    ) ); 

                if( $settings['title'] ) {
        ?>
            <h3><?php esc_html_e( $title ); ?></h3>
        <?php 
                }
            
                WP_Components\Build::molecule( 'posts', $args );
                              
            } 
    
            // Pagination
            if( $settings['pagination'] ) {

                $args = array();

                $args = apply_filters('waterfall_related_paginate_args', array( 
                    'type' => 'post', 
                    'prev' => '<span>' . $settings['pagination_prev'] . '</span>%title', 
                    'next' => '<span>' . $settings['pagination_next'] . '</span>%title' 
                ) );

                WP_Components\Build::atom( 'pagination', $args );
            }          
        
        if( $width != 'full' ) { ?>
            </div>
        <?php } ?>
        
        </aside>
        
    <?php }
    
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
    $properties = array('author', 'comments', 'share', 'width');
    $settings   = get_element_properties( $properties, 'single_footer_' );
    
    // Default arguments
    $args = array(
        'container' => $settings['width'] == 'full' ? false : true,
        'style' => 'main-footer entry-footer'
    );
        
    // Sharing Buttons
    if( $settings['share'] ) {
        $args['atoms']['share'] = array( 'fixed' => true );
        $networks = array('facebook', 'twitter', 'linkedin', 'google-plus', 'pinterest', 'reddit', 'stumbleupon', 'pocket', 'whatsapp');
        
        // Networks should be enabled
        foreach($networks as $network) {
            if( get_theme_option( 'layout', 'single_share_' . $network ) )
                $args['atoms']['share']['enabled'][] = $network;
        }
    }
    
    // Author
    if( $settings['author'] ) {
        $args['atoms']['author'] = array( 'imageFloat' => 'left', 'style' => 'entry-author' );
    }      
    
    // Comments
    if( $settings['comments'] ) {
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
    
    $properties     = array( 'align', 'breadcrumbs', 'height', 'title', 'search', 'width' );
    $settings       = get_element_properties( $properties, '404_header_' );
    
    $args = array(
        'align'     => $settings['align'],
        'atoms'     => array(),
        'height'    => $settings['height'],
        'style'     => 'main-header'        
    );
    
    // Breadcrumbs
    if( $settings['breadcrumbs'] )
       $args['atoms']['breadcrumbs']    = array();
    
    // YUP
    $args['atoms']['title']             = array( 
        'style' => 'page-title', 
        'tag'   => 'h1', 
        'title' => $settings['title'] ? $settings['title'] : __('Woops! Nothing found here...', 'waterfall') 
    ); 
    $args['atoms']['description']       = array( 'description' => $settings['description'] ? $settings['description'] : __('Try visiting another page or searching.', 'waterfall') ); 
    
    // Search
    if( $settings['search'] )
        $args['atoms']['search'] = array();
    
    $args = apply_filters( 'waterfall_404_header_args', $args );
    
    WP_Components\Build::molecule( 'post-header', $args ); 
    
}

/**
 * Retrieves the display for a single product generated by woocommerce
 */
function waterfall_single_product() {
    
    $properties     = array( 'breadcrumbs', 'layout', 'width' );
    $settings       = get_element_properties( $properties, 'product_' ); ?>

    <div class="main-content">
    
        <?php if( $width != 'full' ) { ?>
            <div class="components-container">
        <?php } ?>
    
        <?php 
                                            
            if( $settings['breadcrumbs'] )
                WP_Components\Build::atom(
                    'breadcrumbs', 
                    apply_filters( 'waterfall_single_product_breadcrumbs', ['taxonomy' => true, 'archive' => true] ) 
                );

            do_action('waterfall_before_single_product_content');
        
        ?>
    
        <div class="content">

            <?php
                                            
                /**
                 * Retrieves the loop for the single product from woocommerce
                 */
                while ( have_posts() ) : the_post();

                    wc_get_template_part( 'content', 'single-product' );

                endwhile; // end of the loop.
                                            
            ?>
    
        </div>
    
        <?php 
                                            
            do_action('waterfall_after_single_product_content');

            // Sidebars
            if( $settings['layout'] == 'left' || $settings['layout'] == 'right' )
                WP_Components\Build::molecule( 'sidebar', ['sidebars' => ['product'], 'style' => 'sidebar'] ); 

            do_action('waterfall_after_single_product_sidebar');
                                            
        ?>
    
    
    <?php if( $width != 'full' ) { ?>
        </div>
    <?php } ?>    
    
    </div>
    
<?php
}

/**
 * Displays the header for a product archive
 */
function waterfall_product_archive_header() {
    
    $disable        = get_theme_option('layout', 'product_archive_header_disable');
    
    // Return if we do not want to show the header
    if( $disable === true ) 
        return;
    
    $properties     = array( 'align', 'breadcrumbs', 'height', 'width' );
    $settings       = get_element_properties( $properties, 'product_archive_header_' );    

    // Breadcrumbs
    if( $settings['breadcrumbs'] ) {
        $atoms['breadcrumbs'] = array();    
    }
    
    // Default title
    if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
        $atoms['archive-title'] = array('style' => 'woocommerce-products-header__title page-title', 'custom' => woocommerce_page_title(false) );    
    }
    
    // Add custom action as a a string
    ob_start();
    do_action( 'woocommerce_archive_description' );
    $atoms['string'] = array( 'string' => ob_get_clean() );
    
    $args = apply_filters('waterfall_archive_title_args', array(
        'atoms'     => $atoms,
        'align'     => $settings['align'],
        'container' => $settings['width'] == 'full' ? false : true,
        'height'    => $settings['height'],
        'style'     => 'main-header woocommerce-products-header'
    ) );
    
    WP_Components\Build::molecule( 'post-header', $args );
    
}

/**
 * Displays the header for a product archive
 */
function waterfall_product_archive_posts() {
    
    $properties     = array( 'layout', 'width' );
    $settings       = get_element_properties( $properties, 'product_archive_' );     
    
    /** 
     * The actual output for this section
     */
    if( $settings['width'] != 'full' ) { ?>
        <div class="components-container">
    <?php } ?>        
    
    <?php do_action('waterfall_before_product_archive_posts'); ?>
    
    <div class="content">
        
        <?php 

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
        
        ?>
    
    </div>
    
    <?php
        do_action('waterfall_after_product_archive_posts');
    
        // The sidebar
        if( $layout == 'left' || $layout == 'right' )
            WP_Components\Build::molecule( 'sidebar', array('sidebars' => array('product-archive'), 'style' => 'sidebar') );

        do_action('waterfall_after_product_archive_sidebar');    
    ?>
            
    <?php if( $width != 'full' ) { ?>
        </div>
    <?php }
}