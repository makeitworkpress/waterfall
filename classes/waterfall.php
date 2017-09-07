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
        
        /**
         * Adapt some of the customizer sections
         */
        add_action( 'customize_register', function($wp_customize) {
            $wp_customize->get_section('background_image')->title = __( 'Background' );
            $wp_customize->get_section('background_image')->priority = 110;
            $wp_customize->get_section('static_front_page')->title = __( 'General' );
            $wp_customize->get_section('static_front_page')->priority = 1;
            $wp_customize->remove_section('colors');
        }, 20 );
    
    }
    
    /**
     * Loads and set-up our configurations
     */
    private function configure() {
        
        // Load our configurations file
        require_once( get_template_directory() . '/configurations/customizer.php' );
        require_once( get_template_directory() . '/configurations/enqueue.php' );
        require_once( get_template_directory() . '/configurations/postmeta.php' );
        require_once( get_template_directory() . '/configurations/register.php' );
        
        // Make configurations filterable at early moment
        $configurations = apply_filters('waterfall_configurations', array(
            'language'  => 'waterfall', 
            'enqueue'   => $enqueue, 
            'register'  => $register, 
            'options'   => array(
                'customizerGeneral' => array('frame' => 'customizer', 'fields' => $customizer),
                'colorsPanel'       => array('frame' => 'customizer', 'fields' => $colors),
                'layoutPanel'       => array('frame' => 'customizer', 'fields' => $layout),
                'typographyPanel'   => array('frame' => 'customizer', 'fields' => $typography),
                'postMeta'          => array('frame' => 'meta', 'fields' => $postmeta),
            ) 
        ));
        
        // Register our configurations so that they can be executed
        foreach( $configurations as $key => $configuration ) {
            $this->register( $key, $configuration );    
        }
        
    }
    
    /**
     * Adds certain configurations for initializing the theme
     *
     * @param string    $type               The type of configurations to add. Accepts enqueue, register, route, options and language
     * @param array     $configurations     The configurations that you want to add to this type
     */
    public function register( $type = '', $configurations = [] ) {
        
        // A type should be registered
        if( ! $type )
            return new WP_Error('type_missing', __('Please define a configuration type', 'waterfall'));
        
        // If we already have configurations, we merge the arrays
        if( isset($this->configurations[$type]) && is_array($this->configurations[$type]) )
            $configurations = wp_parse_args( $configurations, $this->configurations[$type] );
        
        // Set our configurations
        $this->configurations[$type] = apply_filters('waterfall_' . $type, $configurations);
 
    }    
    
    
    /**
     * Executes all registrations
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function execute( $type = '' ) {
        
        /**
         * General filter for changing configurations upon execution
         */
        $this->configurations = apply_filters('waterfall_configurations_execute', $this->configurations);
        
        /**
         * Execute our class actions
         */
        $methods = apply_filters( 'waterfall_execute_methods', [
            'enqueue'   => 'WP_Enqueue\Enqueue',
            'register'  => 'WP_Register\Register', 
            'routes'    => 'WP_Router\Router', 
            'options'   => 'WP_Custom_Fields\Framework'
        ] );
        
        /**
         * Loop through our configurations and execute given methods
         */
        foreach( $this->configurations as $key => $configurations ) {
            
            // If we have a type executed, it should match a key
            if( $type && $type != $key )
                continue;            
            
            // The method should be set
            if( ! isset($methods[$key]) )
                continue;
            
            // And the class should exist
            if( ! class_exists($methods[$key]) )
                continue;
            
            if( $key == 'options' ) {
                
                // Default parameters
                $this->configurations['options']['params'] = isset($this->configurations['options']['params']) ? $this->configurations['options']['params'] : array();
                
                // Divergent framework
                $execute = WP_Custom_Fields\Framework::instance($this->configurations[$key]['params']);
                
                // Walk through all the option types
                foreach( $this->configurations['options'] as $key => $options ) {

                    if( $key == 'params' )
                        continue;
                    
                    $execute->add( $options['frame'], $options['fields'] );    
                }                
                
            } else {
                $execute = new $methods[$key]( $this->configurations[$key] );    
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