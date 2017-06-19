<?php
/**
 * This class boots up the necessary theme functions
 */
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall {  
    
    /**
     * Determines whether a class has already been instanciated.
     *
     * @access private
     */
    private static $instance = null;
    
    
    /**
     * Contains the configurations for the theme
     *
     * @access private
     */
    private $configurations; 
    
 
    /**
     * Gets the single instance. Applies Singleton Pattern
     */
    public static function instance() {
        
        $class = get_called_class();
        if ( ! isset(self::$instance[$class]) ) {
            self::$instance[$class] = new $class();
        }

        return self::$instance[$class];
    }    
     
    
    /** 
     * Constructor. This allows the class to be only initialized once.
     */
    private function __construct() {
        $this->initialize();
    }
    
    
    /**
     * Initializes the basic settings for a theme
     */
    private function initialize() {
        
        /**
         * Basic theme supports
         */
        add_theme_support( 'custom-background' ); 
		add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'title-tag' );
		add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'caption'] );
        
        /**
         * Flush our rewrite rules for new posts
         */
        add_action('after_switch_theme', function() {
            flush_rewrite_rules();    
        });
        
        /**
         * Redefine where to look for our templates
         */
        $files = apply_filters(
            'waterfall_templates', 
            ['index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home', 'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment']
        );
        
        foreach( $files as $type ) {
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

            $customize = get_theme_option('customizer');         
            $sidebar = 'default';
            
            // Default layout class
            if( isset($customize['layout']) ) {
                $classes[] = apply_filters('waterfall_layout_class', 'waterfall-' . $customize['layout'] . '-layout');    
            }

            // Sidebar lay-out classes
            if( is_page() ) {
                $sidebar = isset($customize['page_layout']) ? $customize['page_layout'] : 'default'; 
            }

            if( is_archive() ) {
                $sidebar = isset($customize['archive_layout']) ? $customize['archive_layout'] : 'default';    
            }
            
            if( is_search() ) {
                $sidebar = isset($customize['search_layout']) ? $customize['search_layout'] : 'default';    
            }            

            if( is_single() ) {
                $sidebar = isset($customize['post_layout']) ? $customize['post_layout'] : 'default';     
            }

            $classes[] = apply_filters('waterfall_sidebar_class', 'waterfall-' . $sidebar . '-sidebar');
            
            return $classes;
            
        } );
        
        
        /**
         * Our executing is hooked in after_setup_theme, so (child) themes can add configurations if they want
         */
        add_action('after_setup_theme', array($this, 'execute'), 10);        
        
    }    
    
    /**
     * Adds certain configurations for initializing the theme
     *
     * @param string    $type               The type of configurations to add. Accepts optimize, enqueue, register, route, settings and language
     * @param array     $configurations     The configurations that you want to add to this type
     */
    public function register( $type = '', $configurations = [] ) {
        
        // A type should be registered
        if( ! $type )
            return new WP_Error('type_missing', __('Please define a type', 'waterfall'));
        
        // If we already have configurations, we merge the arrays
        if( isset($this->configurations[$type]) && is_array($this->configurations[$type]) )
            $configurations = array_merge($this->configurations[$type], $configurations);
        
        // Set our configurations
        $this->configurations[$type] = apply_filters('waterfall_' . $type, $configurations);
 
    }
    
    /**
     * Executes all registrations
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function execute( $type = '') {
        
        /**
         * General filter for changing configurations upon execution
         */
        $this->configurations = apply_filters('waterfall_configurations_execute', $this->configurations);
        
        /**
         * Execute our class actions
         */
        $methods = apply_filters( 'waterfall_execute_methods', [
            'enqueue'   => 'WP_Enqueue\Enqueue',
            'optimize'  => 'WP_Optimize\Optimize', 
            'register'  => 'WP_Register\Register', 
            'routes'    => 'Router', 
            'options'   => 'Divergent\Divergent'
        ] );
        
        foreach($methods as $key => $class ) {
            
            // If we have a type executed, it should match a key
            if( $type && $type != $key )
                continue;
            
            // We should have the settings for the type
            if( ! isset($this->configurations[$key]) || ! $this->configurations[$key] )
                continue;
            
            // Our divergent is something different
            if( $key == 'options' ) {
                
                // Default parameters
                $this->configurations[$key]['params'] = isset($this->configurations[$key]['params']) ? $this->configurations[$key]['params'] : array();
                
                // Divergent framework
                $divergent = $class::instance($this->configurations[$key]['params']);
                
                // Walk through all the option types
                foreach( $this->configurations[$key] as $target => $options ) {

                    if( $target == 'params' )
                        continue;
                    
                    $divergent->add( $target, $options );    
                }
                
            } else {
                $execute = new $class($this->configurations[$key]);   
            }   
            
        }
    
            
        /**
         * Add our custom language domain
         */
        if( isset($this->configurations['language']) ) {
            
            if( is_dir( STYLESHEETPATH . '/languages' ) ) {
                $path = STYLESHEETPATH . '/languages';
            } else {
                $path = TEMPLATEPATH . '/languages'; 
            }
            
            $path = apply_filters('waterfall_language_path', $path);
            
            load_theme_textdomain( $this->configurations['language'], $path );   
        }
        
    } 
    
}