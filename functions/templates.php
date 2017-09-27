<?php
/**
 * Main templating functions
 * To primary purpose of these templating functions is to clean up the template
 */


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