<?php
/**
 * Contains all functionalities which determine the general display of this theme
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_View extends Waterfall_Base  {
    
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
            ['index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home', 'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment']
        );

        $this->actions = [
            ['wp_head', 'headerHeight', 10, 0],
            ['wp_head', 'analytics', 20, 0],
        ];        

        $this->filters = [
            ['body_class', 'bodyClasses'],
            ['excerpt_length', 'excerptLength', 999],
        ];
                
        // Execute our hooks
        $this->modifyTemplateFolder();
        
        // Extend theme support
        $this->themeSupport();

        // Loads our custom components from Make it WorkPress
        new MakeitWorkPress\WP_Components\Boot();       
        
    }
    
    /**
     * Modifies the template folder for each template file
     */
    private function modifyTemplateFolder() {

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
        
    }

    /**
     * Adjusts specific styling for the header
     * Adds optional styling which can not yet be covered by wp-custom-fields
     */
    public function headerHeight() {

        if( isset($this->options['layout']['header_height']['amount']) && $this->options['layout']['header_height']['amount'] && $this->options['layout']['header_height']['unit'] ) {

            echo '<style type="text/css"> 
                .molecule-header-atoms .atom-logo img { height: calc(' . $this->options['layout']['header_height']['amount'] . $this->options['layout']['header_height']['unit'] . ' - 16px); width: auto;} 
                .molecule-header-atoms .atom-menu-hamburger { margin: calc( (' . $this->options['layout']['header_height']['amount'] . $this->options['layout']['header_height']['unit'] . ' - 30px)/2 ) 4px; }
                .molecule-header-transparent ~ .main .main-header, .molecule-header-transparent ~ .main .main-header.components-image-background { padding-top: calc(' . $this->options['layout']['header_height']['amount'] . $headerHeight['unit'] . ' + 32px); }
            </style>';
        } 

    }

    /**
     * Adds the analytics script to the header
     */
    public function analytics() {
        if( isset($this->options['options']['analytics']) && $this->options['options']['analytics'] ) {
            echo '<!-- Global site tag (gtag.js) - Google Analytics -->
            <script async="async" src="https://www.googletagmanager.com/gtag/js?id=' . $this->options['options']['analytics'] . '"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag("js", new Date());
            gtag("config", "' . $this->options['options']['analytics'] . '", {"anonymize_ip": true });
            </script>';
        }
    }

    /**
     * Alters our body classes
     * 
     * @param Array $classes The passed body classes
     */    
    public function bodyClasses($classes) {

        global $wp_query;

        // Retrieve configurations
        $customize      = $this->options['customizer']; 
        $colors         = $this->options['colors']; 
        $layout         = $this->options['layout'];
        $woocommerce    = $this->options['woocommerce'];
        $sidebar        = 'default';
        
        // Default layout class for boxed and non-boxed
        if( isset($customize['layout']) ) {
            $classes[]  = 'waterfall-' . $customize['layout'] . '-layout';    
        }

        if( isset($colors['content_sidebar_background']) && $colors['content_sidebar_background'] ) {
            $classes[]  = 'waterfall-colored-sidebar';    
        }
        
        // Initialize lightbox
        if( isset($customize['lightbox']) ) {
            $classes[]  = 'waterfall-lightbox';
        }

        // Set-up the sidebars for default archives and pages set-up as posts page under Settings, Reading
        $page = isset( get_queried_object()->ID ) ? get_queried_object()->ID : 0;
        
        if( is_archive() || (is_front_page() && get_option('show_on_front') == 'posts') || ( is_home() && $page = get_option('page_for_posts') ) ) {
            $type       = wf_get_archive_post_type();

            // Default archives
            if( isset($layout[$type . '_archive_sidebar_position']) && $layout[$type . '_archive_sidebar_position'] ) {
                $sidebar = $layout[$type . '_archive_sidebar_position'];  
            } 
            
            // Woocommerce archives
            if( function_exists('is_woocommerce') && is_woocommerce() ) {

                if( isset($woocommerce[$type . '_archive_sidebar_position']) && $woocommerce[$type . '_archive_sidebar_position'] ) {   
                    $sidebar = $woocommerce[$type . '_archive_sidebar_position'];
                } elseif( (! isset($woocommerce[$type . '_archive_sidebar_position']) || ! $woocommerce[$type . '_archive_sidebar_position']) ) {
                    $sidebar = 'left'; // A non set Woocommerce Sidebar defaults to a left sidebar.
                }

            }

        }
        
        // Search Archives
        if( is_search() ) {
            $sidebar = isset($layout['search_sidebar_position']) ? $layout['search_sidebar_position'] : 'default';  
        }

        // Single Posts and pages
        if( is_singular() ) {

            $type       = $wp_query->queried_object->post_type;
            $this->meta = wf_get_theme_option('meta');

            if( isset($layout[$type . '_sidebar_position']) ) {
                $sidebar = $layout[$type . '_sidebar_position'];  
            } elseif( isset($woocommerce[$type . '_sidebar_position']) ) {
                $sidebar = $woocommerce[$type . '_sidebar_position'];
            } 

            // Posts or pages with an overlay and adjustable width
            if( isset($this->meta['page_header_overlay']) && $this->meta['page_header_overlay'] ) {
                $classes[] = 'waterfall-content-header-overlay';
            }
            
            if( (isset($this->meta['content_width']['full']) && $this->meta['content_width']['full']) || (isset($layout[$type . '_content_width']) && $layout[$type . '_content_width'] == 'full') ) {
                $sidebar    = 'default';
                $classes[]  = 'waterfall-fullwidth-content';
            }

        }
                    
        $classes[] = apply_filters('waterfall_sidebar_class', 'waterfall-' . $sidebar . '-sidebar');
        
        return $classes;
        
    }

    /**
     * Alters the excerpt length based on our settings
     * 
     * @param Int $length The excerpt length
     */    
    public function excerptLength($length) {

        if( isset($this->options['customizer']['excerpt_length']) && is_numeric($this->options['customizer']['excerpt_length']) ) {
            $length = absint($customize['excerpt_length']);
            return $length;
        }

    }
 
    /**
     * Enables different theme support modules
     */
    private function themeSupport() {
        
        add_theme_support( 'custom-background' ); 
        add_theme_support( 'custom-logo' ); 
		add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'title-tag' );
		add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'caption'] );
       
    }    
    
}