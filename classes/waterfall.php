<?php
/**
 * This class boots up the necessary theme functions
 */
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall {
    
    /**
     * Contains the WP Components Object
     *
     * @access private
     */
    private $components;     

    /**
     * Contains the configurations object for this theme
     *
     * @access public
     */
    public $config;     
   
    
    /**
     * Determines whether a class has already been instanciated.
     *
     * @access private
     */
    private static $instance = null;     

    /**
     * Contains the views object for this theme
     *
     * @access public
     */
    public $view;     
    
 
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
         * Loads our translations before loading anything else
         */
        if( is_dir( get_stylesheet_directory() . '/languages' ) ) {
            $path = get_stylesheet_directory() . '/languages';
        } else {
            $path = get_template_directory() . '/languages'; 
        }
        
        load_theme_textdomain( 'waterfall', apply_filters('waterfall_language_path', $path) );     

        /**
         * Include basic utility functions, so that these are available throughout the theme
         */
        require_once( get_template_directory() . '/functions/utilities.php' );
        
        /**
         * Enables our theme to be updated through an external repository, in this case github
         */
        new MakeitWorkPress\WP_Updater\Boot( ['source' => 'https://github.com/makeitworkpress/waterfall'] );
        
        /**
         * Load all configurations
         */
        $this->configure();
        
        /**
         * The execution of our configurations is hooked in after_setup_theme, 
         * so (child) themes can add configurations if they want on an earlier point.
         * This executes all our custom modules, such as custom fields and post types
         */
        add_action('after_setup_theme', [$this, 'execute'], 10);
        
        /**
         * Flush our rewrite rules for new posts
         */
        add_action('after_switch_theme', function() { 
            flush_rewrite_rules(); 
        });
        
        /**
         * Initialize our components which are used to display elements
         */
        $this->components   = new MakeitWorkPress\WP_Components\Boot();

        /**
         * Enable optimizations for the theme
         */
        $optimize           = wf_get_theme_option('options', 'optimize');

        if( $optimize ) {
            $optimize       = new MakeitWorkPress\WP_Optimize\Optimize($optimize);    
        }

        /**
         * Initializes our ajax actions
         */
        $ajax               = new Waterfall_Ajax();        
        
        /**
         * Important! Initialize the view component so templates are load and additional settings are added
         */
        $this->view         = new Waterfall_View(); 
        
        /**
         * Adapt some of the customizer sections with custom names
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
        
        // Load our basic configurations file
        require_once( get_template_directory() . '/configurations/enqueue.php' );
        require_once( get_template_directory() . '/configurations/register.php' );
        
        $configurations = [
            'enqueue'   => $enqueue, 
            'register'  => $register, 
            'options'   => []
        ];

        // The custom fields options are only loaded in admin or customizer contexts to ensure better front-end performance
        if( is_admin() ) {

            // Load the custom fields configuration files          
            require_once( get_template_directory() . '/configurations/options.php' );
            require_once( get_template_directory() . '/configurations/postmeta.php' );

            $configurations['options'] = [
                'postMeta'          => ['frame' => 'meta', 'fields' => $postmeta],
                'options'           => ['frame' => 'options', 'fields' => $options]
            ]; 

        }

        // The custom fields options are only loaded in admin or customizer contexts to ensure better front-end performance
        if( is_customize_preview() ) {

            require_once( get_template_directory() . '/configurations/customizer.php' );  

            $configurations['options']['customizerGeneral'] = ['frame' => 'customizer', 'fields' => $customizer];
            $configurations['options']['colorsPanel']       = ['frame' => 'customizer', 'fields' => $colors];
            $configurations['options']['layoutPanel']       = ['frame' => 'customizer', 'fields' => $layout];
            $configurations['options']['typographyPanel']   = ['frame' => 'customizer', 'fields' => $typography];

            // Woocommerce configurations
            if( class_exists( 'WooCommerce' ) ) {
                require_once( get_template_directory() . '/configurations/customizer/woocommerce.php' );
                $configurations['options']['woocommerce']   = ['frame' => 'customizer', 'fields' => $woocommerce];
            }            

        }

        /**
         * Set-up our configurations
         */
        $this->config = new MakeitWorkPress\WP_Config\Config( $configurations );
        
    }   
    
    /**
     * Executes all configuration registrations, so that the configurations have effect. This is executed on after_theme_setup.
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function execute( $type = '' ) {
        
        // General filter for changing configurations upon execution
        $this->config = apply_filters( 'waterfall_configurations', $this->config );

        /**
         * Execute our class actions
         */
        $methods = apply_filters( 'waterfall_execute_methods', [
            'enqueue'   => 'MakeitWorkPress\WP_Enqueue\Enqueue',
            'elementor' => 'Waterfall_Elementor',
            'register'  => 'MakeitWorkPress\WP_Register\Register', 
            'routes'    => 'MakeitWorkPress\WP_Router\Router', 
            'options'   => 'MakeitWorkPress\WP_Custom_Fields\Framework'
        ] );
        
        /**
         * Loop through our configurations and execute given methods
         */
        foreach( $this->config->configurations as $key => $configurations ) {
            
            // If we have a type executed, it should match a key
            if( $type && $type != $key ) {
                continue;   
            }         
            
            // The method should be set
            if( ! isset($methods[$key]) ) {
                continue;
            }
            
            // And the class should exist
            if( ! class_exists($methods[$key]) ) {
                continue;
            }
            
            if( $key == 'options' ) {
                
                // Default parameters
                $this->config->configurations['options']['params'] = isset($this->config->configurations['options']['params']) ? $this->config->configurations['options']['params'] : [];
                
                // Divergent framework
                $this->options = MakeitWorkPress\WP_Custom_Fields\Framework::instance($this->config->configurations['options']['params']);
                
                // Walk through all the option types for the back-end
                if( is_admin() || is_customize_preview() ) {
                    
                    foreach( $this->config->configurations['options'] as $key => $options ) {

                        if( $key == 'params' ) {
                            continue;
                        }
                        
                        $this->options->add( $options['frame'], $options['fields'] );

                    }  
                
                }
                
            } else {
                $this->{$key} = new $methods[$key]( $this->config->configurations[$key] );    
            }
            
        }

        /**
         * Save our additional post types to the database, so we can modify them later
         * This is done on this location because before the configurations are executed, these post types are not available.
         */
        if( is_admin() ) {
            $this->savePostTypes();     
        }  
        
    }

    /**
     * Saves the available public post types to the database so we can access them at an earlier point, such as in the configurations
     */
    private function savePostTypes() {

        add_action('init', function() {
            $commons    = apply_filters( 'waterfall_exlude_post_types', ['attachment', 'elementor_library', 'product', 'affiliate-links'] );
            $initial    = get_post_types( ['public' => true] );
            $types      = [];

            // Exlude common post types
            foreach( $commons as $common ) {
                unset($initial[$common]);
            }

            foreach( $initial as $type ) {

                $object                     = get_post_type_object( $type );

                $types[$type]['singular']   = $object->labels->singular_name; 
                $types[$type]['name']       = $object->labels->name;
            }

            update_option( 'waterfall_post_types', $types );

        }, 20);

    }
    
}