<?php
/**
 * Contains all functionalities which determine the general display of this theme
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_View extends Waterfall_Base {

    /**
     * Contains the components object
     *
     * @access public
     */
    public $components;      
    
    /**
     * Contains the templates that are routed to the /templates/ folder
     *
     * @access private
     */
    private $files; 

    /**
     * Initialize our view functions
     */
    protected function initialize() {
        
        // Template files used by Waterfall
        $this->files = apply_filters(
            'waterfall_templates', 
            [
                '404', 
                'archive', 
                'author', 
                'category', 
                'tag',
                'taxonomy', 
                'date', 
                'home', 
                'frontpage', 
                'page', 
                'paged', 
                'search', 
                'single', 
                'singular', 
                'attachment',
                'embed',
                'bbpress',
                'index'
            ]
        );

        $this->actions = [
            ['get_header', 'get_theme_header'],
            ['wp_head', 'wp_head_header_height', 10, 0],
            ['wp_head', 'wp_head_container_width', 10, 0],
            ['wp_head', 'wp_head_analytics', 20, 0],
            ['wp_footer', 'wp_footer_analytics', 20, 0]
        ];        

        $this->filters = [
            ['body_class', 'modify_body_classes'],
            ['excerpt_length', 'modify_excerpt_length', 999],
        ];
                
        // Modify the template folders and hierarchy
        $this->modify_template_folder();
        
        // Extend theme support
        $this->theme_support();

        // Loads our custom components from Make it WorkPress
        $configurations = apply_filters( 'wf_wp_components_config', ['maps' => wf_get_data('options', 'maps_api_key')] );
        $this->components = new MakeitWorkPress\WP_Components\Boot($configurations);
        
    }
    
    /**
     * Modifies the template folder for each template file
     * This function ensures that the templates from /templates are loaded
     */
    private function modify_template_folder() {

        // Redefine where to look for our templates       
        foreach( $this->files as $type ) {
            add_action("{$type}_template_hierarchy", function($templates) {
                
                $foldered_templates = [];
                
                foreach($templates as $template) {
                    $foldered_templates[] = 'templates/' . $template;    
                }
                
                return $foldered_templates;
                
            });
        } 
        
    }

    /**
     * Adjusts specific styling for the header
     * Adds optional styling which can not yet be covered by wp-custom-fields
     */
    public function wp_head_header_height() {

        $height = wf_get_data('layout', 'header_height');

        if( isset($height['amount']) && $height['amount'] && $height['unit'] ) {

            echo '<style type="text/css" id="waterfall-header-height"> 
                .molecule-header-atoms .atom-logo img { 
                    height: calc(' . $height['amount'] . $height['unit'] . ' - 16px); width: auto;
                } 
                .molecule-header-atoms .atom-menu-hamburger { 
                    margin: calc( (' . $height['amount'] . $height['unit'] . ' - 30px)/2 ) 4px; 
                }
                .molecule-header-transparent ~ .main .main-header, .molecule-header-transparent ~ .main .main-header.components-image-background { 
                    padding-top: calc(' . $height['amount'] . $height['unit'] . ' + 32px);
                }
            </style>';

        } 

    }

    /**
     * Adds additional styling for page builders if the container width is set
     */
    public function wp_head_container_width() {
        
        $styles     = '';
        $width      = wf_get_data('layout', 'layout_width');

        if( isset($width['amount']) && $width['amount'] && $width['unit'] ) {

            /** For Elementor */
            if( did_action('elementor/loaded') ) { 
                
                // Width for elements with no gap
                $styles .= '.elementor-top-section.elementor-section-boxed > .elementor-column-gap-no {
                    max-width:' . $width['amount'] . $width['unit'] . ';
                }';                

                foreach( ['narrow' => 5, 'default' => 10, 'extended' => 15, 'wide' => 20, 'wider' => 30] as $gap_name => $gap_width ) {
                    $styles .= '.elementor-top-section.elementor-section-boxed > .elementor-column-gap-' . $gap_name . ' {
                        margin: 0 -' . $gap_width . 'px;
                        max-width: calc(' . $width['amount'] . $width['unit'] . ' + ' . $gap_width * 2 . 'px);
                    }';

                }

                // Reset default queries  
                $styles .= '@media screen and (min-width: 768px) and (max-width: 1280px) {
                    .waterfall-fullwidth-content .elementor-top-section > .elementor-container, 
                    [class*="elementor-location-"] .elementor-top-section > .elementor-container {
                        padding-left: 0;
                        padding-right: 0;                        
                    }    
                }';                  
              
                // Adaptive queries depending on container width    
                $buffer = $width['unit'] === 'px' ? 64 : 0;
                $styles .= '@media screen and (min-width: 768px) and (max-width: ' . ($width['amount'] + $buffer) . $width['unit'] . ') {
                    .waterfall-fullwidth-content .elementor-top-section > .elementor-container, 
                    [class*="elementor-location-"] .elementor-top-section > .elementor-container {
                        padding-left: 32px;
                        padding-right: 32px;                        
                    }    
                }';               

                // Reset the styles for any of the elements - center the containers by default
                $styles .= '@media screen and (min-width: ' . ($width['amount']) . $width['unit'] . ') {
                    .elementor-top-section.elementor-section-boxed > .elementor-container {
                        margin: 0 auto;
                    }
                }';

            }
        
        }

        // Output our styles
        if( ! $styles ) {
            return;
        }

        echo '<style type="text/css" id="waterfall-container-width">' . $styles . '</style>'; 

    }

    /**
     * Adds analytics scripts to the header
     */
    public function wp_head_analytics() {

        $analytics = wf_get_data('options', ['analytics']);
        
        if( $analytics['analytics'] ) {
            echo '<!-- Global site tag (gtag.js) - Google Analytics -->
            <script async="async" src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($analytics['analytics']) . '"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag("js", new Date());
                gtag("config", "' . esc_attr($analytics['analytics']) . '", {"anonymize_ip": true });
            </script>';
        }     

    }

    /**
     * Adds analytics scripts to the footer
     */
    public function wp_footer_analytics() {

        $analytics = wf_get_data('options', ['cf_analytics']);
        
        if( $analytics['cf_analytics'] ) {
            echo '<!-- Cloudflare Web Analytics -->
            <script defer src="https://static.cloudflareinsights.com/beacon.min.js" 
            data-cf-beacon="{\'token\': \'' . esc_attr($analytics['cf_analytics']) . '\'}"></script>
            <!-- End Cloudflare Web Analytics -->';
        }        

    }    

    /**
     * Alters our body classes
     * 
     * @param   Array $classes The passed body classes
     * @return  Array $classes The modified body classes
     */    
    public function modify_body_classes($classes) {

        global $wp_query;

        // Retrieve default customizer and metadata
        $classes    = $classes ? $classes : [];
        $data       = [];
        $sidebar    = 'default';
        $types      = [
            'customizer'    => ['lightbox'],
            'colors'        => ['content_sidebar_background'],
            'layout'        => ['layout', 'search_sidebar_position'],
            'meta'          => ['content_width', 'page_header_overlay', 'content_sidebar_disable']
        ];

        foreach( $types as $type => $keys ) {
            $data[$type] = wf_get_data($type, $keys);
        }
        
        // Default layout class for boxed and non-boxed
        if( $data['layout']['layout'] ) {
            $classes[]  = 'waterfall-' . $data['layout']['layout'] . '-layout';
        }

        if( $data['colors']['content_sidebar_background'] ) {
            $classes[]  = 'waterfall-colored-sidebar';    
        }
        
        // Initialize lightbox
        if( $data['customizer']['lightbox'] ) {
            $classes[]  = 'waterfall-lightbox';
        }

        // Set-up the sidebars for default archives and pages set-up as posts page under Settings, Reading
        $page = isset( get_queried_object()->ID ) ? (int) get_queried_object()->ID : 0;

        // Archives
        if( is_archive() || (is_front_page() && get_option('show_on_front') === 'posts') || ( is_home() && $page === (int) get_option('page_for_posts') ) ) {
            
            $type                   = wf_get_archive_post_type();

            // Adds archive types to the classes. Used by customizer settings for sidebar styling.
            $classes[]              = 'archive-' . $type;
            
            // WooCommerce archives
            if( function_exists('is_woocommerce') && is_woocommerce() ) {

                $sidebar_position   = wf_get_data('woocommerce', $type . '_archive_sidebar_position');
                $sidebar            = $sidebar_position  ? $sidebar_position : 'left';

            // bbPress archives
            } elseif( class_exists('bbPress') && $type === 'forum' ) { 

                $sidebar            = wf_get_data('bbpress', $type . '_archive_sidebar_position');
            
            // Default archives
            } else {
                $sidebar            = wf_get_data('layout', $type . '_archive_sidebar_position');
            }

        }
        
        // Search Archives
        if( is_search() ) {
            $sidebar = $data['layout']['search_sidebar_position'];  
        }

        // Single Posts and pages
        if( is_singular() ) {

            $type               = isset($wp_query->queried_object->post_type) ? $wp_query->queried_object->post_type : 'post';

            // WooCommerce sidebar
            if( function_exists('is_product') && is_product() ) {
                $sidebar        = wf_get_data('woocommerce', $type . '_sidebar_position');
            // bbPress sidebar
            } elseif( class_exists('bbPress') && ( is_singular('forum') || is_singular('topic') ) ) {
                $sidebar        = wf_get_data('bbpress', $type . '_sidebar_position');
            // Default sidebars
            } else {
                $sidebar        = wf_get_data('layout', $type . '_sidebar_position');
            }

            $content_width      = wf_get_data('layout', $type . '_content_width');

            // Posts or pages with an overlay and adjustable width
            if( $data['meta']['page_header_overlay'] ) {
                $classes[] = 'waterfall-content-header-overlay';
            }
            
            // We add a fullwidth content class if it is a setting in our customizer, post meta or when viewing an elementor template
            if( isset($data['meta']['content_width']) && $data['meta']['content_width'] === true || $content_width === 'full' || is_singular('elementor_library') ) {
                $sidebar    = 'default';
                $classes[]  = 'waterfall-fullwidth-content';
            }

            if( isset($data['meta']['content_sidebar_disable']) && $data['meta']['content_sidebar_disable'] === true ) {
                $sidebar    = 'default';   
            }

        }
             
        $sidebar    = $sidebar ? $sidebar : 'default';
        $classes[]  = apply_filters('waterfall_sidebar_class', 'waterfall-' . $sidebar . '-sidebar');
        
        return $classes;
        
    }

    /**
     * Alters the excerpt length based on our settings
     * 
     * @param Int $length The excerpt length
     */    
    public function modify_excerpt_length($length) {

        $excerpt_length = wf_get_data('customizer', 'excerpt_length');

        if( is_numeric($excerpt_length) ) {
            return absint($excerpt_length);
        }

        return $length;

    }
 
    /**
     * Enables different theme support modules
     */
    private function theme_support() {
        
        add_theme_support( 'align-wide' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'custom-background' ); 
        add_theme_support( 'custom-logo' ); 
        add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'html5', ['caption', 'comment-list', 'comment-form', 'gallery', 'search-form' ] );
		add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'title-tag' ); 
        add_theme_support( 'wp-block-styles' );   
        
        // @todo Add support for dynamic gutenberg color palettes (add theme support for editor-color-palette) and dynamic gradients (editor-gradient-preset)
        // Also incorporate this with the colorpicker in the customizer (using default colors)
        // Someday, use the default pallette kit from gutenberg to merge this all.
       
    }    
    
}