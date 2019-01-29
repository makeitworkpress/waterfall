<?php
/**
 * Contains all functionalities which determine the display of this theme
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

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
         * Adds optional styling which can not yet be covered by wp-custom-fields
         */
        add_action( 'wp_head', function() {
            $headerHeight = wf_get_theme_option( 'layout', 'header_height' ); 

            if( isset($headerHeight['amount']) && $headerHeight['unit'] ) {
                echo '<style type="text/css"> 
                    .header .atom-logo img { height: calc(' . $headerHeight['amount'] . $headerHeight['unit'] . ' - 16px); width: auto;} 
                    .header .atom-menu-hamburger { margin: calc( (' . $headerHeight['amount'] . $headerHeight['unit'] . ' - 30px)/2 ) 4px; }
                    .molecule-header-transparent ~ .main .main-header.components-image-background { padding-top: calc(' . $headerHeight['amount'] . $headerHeight['unit'] . ' + 32px); }
                </style>';
            }
        }, 20 );

        /**
         * Adds the Google Analytics scripts, if defined
         */
        $options            = wf_get_theme_option();

        if( isset($options['analytics']) && $options['analytics'] ) {
            $tracking = $options['analytics'];
            add_action( 'wp_head', function() use ($tracking) {
                echo '<!-- Global site tag (gtag.js) - Google Analytics -->
                <script async="async" src="https://www.googletagmanager.com/gtag/js?id=' . $tracking . '"></script>
                <script>
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag("js", new Date());
                  gtag("config", "' . $tracking . '", {"anonymize_ip": true });
                </script>';
            }, 20 );            
        }

        
        /**
         * Add our lay-out classes to the body
         */
        add_filter( 'body_class', function($classes) {

            global $wp_query;

            /**
             * Inbuild
             */
            $customize      = wf_get_theme_option('customizer'); 
            $layout         = wf_get_theme_option('layout');
            $woocommerce    = wf_get_theme_option('woocommerce');
            $sidebar        = 'default';
            
            // Default layout class for boxed and non-boxed
            if( isset($customize['layout']) ) {
                $classes[]  = 'waterfall-' . $customize['layout'] . '-layout';    
            }
            
            // Initialize lightbox
            if( isset($customize['lightbox']) ) {
                $classes[]  = 'waterfall-lightbox';
            }

            // Default archives
            if( is_archive() || (is_front_page() && get_option('show_on_front') == 'posts') ) {
                $type       = wf_get_archive_post_type();

                if( isset($layout[$type . '_archive_sidebar_position']) ) {
                    $sidebar = $layout[$type . '_archive_sidebar_position'];  
                } elseif( isset($woocommerce[$type . '_archive_sidebar_position']) ) {
                    $sidebar = $woocommerce[$type . '_archive_sidebar_position'];
                } 

            }
            
            // Search Archives
            if( is_search() ) {
                $sidebar = isset($layout['search_sidebar_position']) ? $layout['search_sidebar_position'] : 'default';  
            }

            // Single Posts and pages
            if( is_singular() ) {
                $type       = $wp_query->queried_object->post_type;

                if( isset($layout[$type . '_sidebar_position']) ) {
                    $sidebar = $layout[$type . '_sidebar_position'];  
                } elseif( isset($woocommerce[$type . '_sidebar_position']) ) {
                    $sidebar = $woocommerce[$type . '_sidebar_position'];
                } 

                // Posts or pages with an overlay and adjustable width
                if( wf_get_theme_option('meta', 'page_header_overlay') ) {
                    $classes[] = 'waterfall-content-header-overlay';
                }

                $full           = wf_get_theme_option( 'meta', 'content_width' );
                $customizer     = wf_get_theme_option( 'layout', get_post_type() . '_content_width' );
                
                if( (isset($full['full']) && $full['full']) || $customizer == 'full' ) {
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
            if( wf_get_theme_option('woocommerce', 'product_content_zoom') )
                add_theme_support( 'wc-product-gallery-zoom' );
            
            // Lightbox Support
            if( wf_get_theme_option('woocommerce', 'product_content_lightbox') && ! wf_get_theme_option('customizer', 'lightbox') )
                add_theme_support( 'wc-product-gallery-lightbox' );
            
            // Slider support
            if( wf_get_theme_option('woocommerce', 'product_content_slider') )
                add_theme_support( 'wc-product-gallery-slider' );
        }        
    }    
    
}