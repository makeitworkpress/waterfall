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
         * Include basic utility and template functions
         */
        require_once( get_template_directory() . '/functions/templates.php' );
        require_once( get_template_directory() . '/functions/utilities.php' );
        
        /**
         * Load standard configurations
         */
        $this->configure();
        
        /**
         * The execution of our configurations is hooked in after_setup_theme, 
         * so (child) themes can add configurations if they want
         */
        add_action('after_setup_theme', array($this, 'execute'), 10);           
        
        /**
         * Flush our rewrite rules for new posts
         */
        add_action('after_switch_theme', function() {
            flush_rewrite_rules();    
        });
        
        /**
         * Initialize the view component so templates are load and additional settings are added
         */
        $view = new Waterfall_View();
    
    }
    
    /**
     * Loads and set-up our configurations
     */
    private function configure() {
        
        // Load our configurations file
        require_once( get_template_directory() . '/configurations/configurations.php' );
        
        // Make configurations filterable
        $configurations = apply_filters('waterfall_configurations', $configurations);

        /**
         * Register theme language domain
         */
        $this->register( 'language', $configurations['language'] );

        /**
         * Register styles
         */
        $this->register( 'enqueue', $configurations['enqueue'] );

        /**
         * Register custom fonts
         */
        $this->register( 'register', $configurations['register'] );

        /**
         * Register the theme framework with several options
         */
        $this->register( 'options',  $configurations['options'] );

        /**
         * Register the theme optimizations
         */
        $optimizations = get_theme_option( 'options', 'optimizations' );

        if( $optimizations )
            $this->register( 'optimize', $optimizations );
        
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
            $configurations = wp_parse_args( $this->configurations[$type], $configurations );
        
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
            'routes'    => 'WP_Router\Router', 
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