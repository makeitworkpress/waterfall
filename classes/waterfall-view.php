<?php
/**
 * Contains all functionalities which determine the display of this theme
 */
class Waterfall_View {
    
    /**
     * Contains the templates that are routed to the /templates/ folder
     *
     * @access public
     */
    public $files;
    
    /**
     * Constructor
     */
    public function __construct() {
        
        $this->files = apply_filters(
            'waterfall_templates', 
            ['index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home', 'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment']
        );
                
        // Execute our hooks
        $this->hook();
        
        // Extend theme support
        $this->support();       
        
    }
    
    /**
     * Executes hooks
     */
    private function hook() {

        /**
         * Redefine where to look for our templates
         */        
        foreach( $this->files as $type ) {
            add_action("{$type}_template_hierarchy", function($templates) {
                
                $return = [];
                
                foreach($templates as $template) {
                    $return[] = 'templates/' . $template;    
                }
                
                return $return;
                
            });
        }        
        
        /**
         * Add our lay-out classes to the body
         */
        add_filter( 'body_class', function($classes) {

            /**
             * Inbuild
             */
            $customize = get_theme_option('customizer'); 
            $layout    = get_theme_option('layout');
            $sidebar   = 'default';
            
            // Default layout class for boxed and non-boxed
            if( isset($customize['layout']) ) {
                $classes[] = 'waterfall-' . $customize['layout'] . '-layout';    
            }
            
            // Initialize lightbox
            if( isset($customize['lightbox']) ) {
                $classes[] = 'waterfall-lightbox';
            }

            // Sidebar lay-out classes
            if( is_page() ) {
                $sidebar = isset($layout['page_sidebar_position']) ? $layout['page_sidebar_position'] : 'default'; 
            }

            // Default archives
            if( is_archive() ) {
                $sidebar = isset($layout['archive_sidebar_position']) ? $layout['archive_sidebar_position'] : 'default'; 
            }
            
            // Search Archives
            if( is_search() ) {
                $sidebar = isset($layout['search_sidebar_position']) ? $layout['search_sidebar_position'] : 'default';  
            } 

            // Single Posts
            if( is_single() ) {
                $sidebar = isset($layout['single_sidebar_position']) ? $layout['single_sidebar_position'] : 'default';     
            } 
            
            /**
             * WooCommerce
             */
             
            // WooCommerce single Products
            // if( class_exists('WooCommerce') && is_product() ) {
            //     $sidebar = isset($customize['product_sidebar_position']) ? $customize['product_sidebar_position'] : 'default';     
            // }
            
            // // WooCommerce Product Archives
            // if( class_exists('WooCommerce') && is_shop() ) {
            //     $sidebar = isset($customize['product_archive_sidebar_position']) ? $customize['product_archive_sidebar_position'] : 'default'; 
            // }            
            
            // Pages with an overlay
            if( is_singular() ) {

                if( get_theme_option('meta', 'page_header_overlay') ) {
                    $classes[] = 'waterfall-content-header-overlay';
                }
                
                $full = get_theme_option('meta', 'content_width');
                
                if( isset($full['full']) && $full['full'] ) {
                    $sidebar    = 'default';
                    $classes[]  = 'waterfall-fullwidth-content';
                }

            }

            $classes[] = apply_filters('waterfall_sidebar_class', 'waterfall-' . $sidebar . '-sidebar');
            
            return $classes;
            
        } );
        
    }
    
    /**
     * Enables different theme support modules
     */
    private function support() {
        
        /**
         * Basic theme supports
         */
        add_theme_support( 'custom-background' ); 
		add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'title-tag' );
		add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'caption'] );
        
        /**
         * Adds support for WooCommerce
         */
        if( class_exists('WooCommerce') ) {
            add_theme_support( 'woocommerce' );
            
            // Customizer support
            if( get_theme_option('layout', 'product_content_zoom') )
                add_theme_support( 'wc-product-gallery-zoom' );
            
            // Lightbox Support
            if( get_theme_option('layout', 'product_content_lightbox') && ! get_theme_option('customizer', 'lightbox') )
                add_theme_support( 'wc-product-gallery-lightbox' );
            
            // Slider support
            if( get_theme_option('layout', 'product_content_slider') )
                add_theme_support( 'wc-product-gallery-slider' );
        }        
    }    
    
}