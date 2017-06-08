<?php
/**
 * This class adds custom routes for easily adding custom templates
 */
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Router { 
    
    /**
     * Contains our routes
     *
     * @access private
     */
    private $routes;
    
    /*
     * Our permalink structure
     *
     * @access public
     */
    public $structure;
    
    /**
     * Constructs the routes and custom query vars
     */
    public function __construct( Array $routes = array() ) {
        
        /**
         * Initial variables
         */
        $this->routes    = $routes;
        $this->structure = get_option('permalink_structure');
        
        /**
         * Add our custom query vars
         */
        add_filter( 'query_vars', function($vars) {
            
            $queryVars = array('template');
            
            foreach( $queryVars as $var ) {
                array_push($vars, $var);
            }
            
            return $vars;
            
        }, 10, 1 );
        
        /**
         * Add our rewrites, but only if there are pretty permalinks
         */
        if( $this->structure )
            $this->rewrite();
        
        /**
         * Locate our templates
         */
        $this->locate();

        
    }
    
    /**
     * Adds the necessary rewrites for the routes
     */
    private function rewrite() {
        
        $routes = $this->routes;
        
        // Adds our rewrite rules based on our routes, and makes sure they are prefixed.
        add_action('init', function() use($routes) {
            
            // Watch our prefixes for pretty permalinks
            $prefix = '';
            
            if( preg_match('/(?U)(.*)(\/%.*%\/)/', $this->structure, $matches) ) {             
                
                if( ! empty($matches[1]) )                
                    $prefix = str_replace('/', '', $matches[1]) . '/';
                
            }
            
            // Register our custom routes
            foreach( $routes as $name => $route ) {

                // Adds the rewrite rule
                add_rewrite_rule( $prefix . $route . '?$', 'index.php?template=' . $name, 'top' );
                
            }
            
        });
        
    }
    
    /**
     * Locate our custom templates and add the right settings for this template
     */
    private function locate() {
        
        $routes = $this->routes;
        
        // Load the right template
        add_filter( 'template_include', function($template) use($routes) {
            
            global $wp_query;
            $name = get_query_var('template');
            
            if( $name ) {
                $template = locate_template( 'templates/' . $name . '.php' );
                
                if( $template )
                    return new WP_Error( 'missing_template', __('The template does not exist', 'waterfall') );
                    
                $wp_query->is_404 = false;
                $wp_query->is_custom = true;
            }
            
            return $template;
            
        } );
        
        // This defines the page title for our custom templates
        add_filter( 'document_title_parts', function( $title ) use( $routes ) {
            
            $name = get_query_var('template');
            
            if( $name && isset($routes[$name]['title']) ) {
                $title['title'] = $routes[$name]['title'];    
            }
            
            return $title;
            
        } );
        
        // Add custom body classes to the front-end of our application so we can style accordingly.
        add_filter( 'body_class', function( $classes ) {
            
            $name = get_query_var('template');
            
            if($name)
                $classes[] = 'template-' . $name;
            
            return $classes;
            
        } );        
        
    }
    
}