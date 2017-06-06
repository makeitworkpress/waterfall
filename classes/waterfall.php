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
		add_theme_support( 'post-thumbnails' ); 
		add_theme_support( 'custom-background' ); 
		add_theme_support( 'custom-header' ); 
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
                    $return[] = 'templates/' . $template . 'php';    
                }
                
                return $return;
                
            });
        }
        
    }    
    
    /**
     * Adds certain configurations for initializing the theme
     *
     * @param string    $type               The type of configurations to add. Accepts optimize, enqueue, register, route, settings and language
     * @param array     $configurations     The configurations that you want to add to this type
     */
    public function register( $type = '', Array $configurations = [] ) {
        
        // A type should be registered
        if( ! $type )
            return new WP_Error('type_missing', __('Please define a type', 'waterfall'));
        
        $this->configurations[$type] = $configurations;
 
    }
    
    /**
     * Executes all registrations
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function execute( $type = '') {
        
        /**
         * Execute our class actions
         */
        $methods = [
            'enqueue'   => 'WP_Enqueue',
            'optimize'  => 'WP_Optimize', 
            'register'  => 'WP_Register', 
            'route'     => 'WP_Router', 
            'settings'  => 'Divergent'
        ];
        
        foreach($methods as $key => $method ) {
            
            if( $type && $type != $key )
                continue;
            
            
            
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