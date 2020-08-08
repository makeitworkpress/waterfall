<?php
/**
 * This class boots up the necessary theme functions
 */
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall {
    
    /**
     * Contains the ajax object
     *
     * @access public
     */
    public $ajax;    

    /**
     * Contains the configurations object
     *
     * @access public
     */
    public $config; 


    /**
     * Contains the queried database data, for customizer, options and meta values;
     *
     * @access private
     */
    private $data;     
    
    /**
     * Contains the events object
     *
     * @access public
     */
    public $events;     
    
    /**
     * Determines whether a class has already been instanciated.
     *
     * @access private
     */
    private static $instance = null;  
    
    /**
     * Contains the WP Optimize object
     *
     * @access public
     */
    public $optimize;     
      
    
    /**
     * Contains the updater object
     *
     * @access public
     */
    public $updater;     
  
    /**
     * Contains the view object
     *
     * @access public
     */
    public $view;    
     
    /**
     * Contains the woocommerce object
     *
     * @access public
     */
    public $woocommerce;
    
    /**
     * Gets the single instance. Applies Singleton Pattern
     */
    public static function instance() {

        if( self::$instance == null ) {    
            var_dump('WATERFALL_INSTANCE');  
            self::$instance = new Waterfall();
        }

        return self::$instance;

    }    
      
    /** 
     * Constructor. This allows the class to be only initialized once.
     */
    private function __construct() {

        // Sets our languages - before anything else loads
        $this->loadLanguages();     

        // Sets our database options from option pages and the customizer - before anything else loads
        $this->loadData();

        // Loads utilityFunctions and other static dependencies
        $this->requireDependencies();        

        // Boot the updater
        $this->bootUpdater();

        // Loads and executes configurations
        $this->configure();

        // Flush rewrite rules
        $this->flushRewriteRules();

        // Setup Ajax related functions
        $this->setupAjax();

        // Setup the view - loading templates, components and modifiying the front-end
        $this->setupView();
        
        // Setup WooCommerce related functions
        $this->setupWooCommerce();

        // Setup Events Calendar related functions
        $this->setupEventsCalendar();
         
        // Adapt some of the customizer sections
        $this->adaptCustomizer();
        
        // Setup supportive functions for deprecated functionalities
        $this->deprecatedSupport();
        
        // Enable optimizations
        $this->enableOptimizations();

    }

    /**
     * Retrieves the theme configurations
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Retrieves data saved from the Database
     */
    public function getData() {
        return $this->data;
    }    

    /**
     * Loads our translations before loading anything else
     */
    private function loadLanguages() {

        if( is_dir( get_stylesheet_directory() . '/languages' ) ) {
            $path = get_stylesheet_directory() . '/languages';
        } else {
            $path = get_template_directory() . '/languages'; 
        }
        
        load_theme_textdomain( 'waterfall', apply_filters('waterfall_language_path', $path) ); 

    }

    /**
     * Loads our theme options and meta values
     */
    private function loadData() {

        // Default values
        $this->data = [
            'meta'          => [],
            'options'       => get_option('waterfall_options'),
        ];

        $mods = get_theme_mods();

        // Customizer values
        foreach(['colors', 'customizer', 'layout', 'woocommerce'] as $mod) {
            $this->data[$mod] = isset($mods[$mod]) ? apply_filters( "theme_mod_{$mod}", $mods[$mod]) : apply_filters( "theme_mod_{$mod}", []);
        }

        // Meta values
        add_action('wp', [$this, 'loadMeta']);

    }

    /**
     * Loads metaData (hooked to WP)
     */
    public function loadMeta() {

        $this->data['meta'] = get_post_meta( get_the_ID(), 'waterfall_meta', true);
        
    }

    /**
     * Loads utilityFunctions and other static dependencies
     *  Include basic utility functions, so that these are available throughout the theme
     */
    private function requireDependencies() { 
        require_once( get_template_directory() . '/functions/utilities.php' );   
    }

    /**
     * Enables our theme to be updated through an external repository, in this case github
     */
    private function bootUpdater() { 
        $this->updater = new MakeitWorkPress\WP_Updater\Boot( ['source' => 'https://github.com/makeitworkpress/waterfall'] );   
    }    
        
    /**
     * Flush our rewrite rules for new posts
     */
    private function flushRewriteRules() {

        add_action('after_switch_theme', function() { 
            flush_rewrite_rules(); 
        });

    }

    /**
     * Initializes the basic settings for a theme
     */
    private function enableOptimizations() {    

        if( isset($this->data['options']['optimize']) && $this->data['options']['optimize'] ) {
            $this->optimize = new MakeitWorkPress\WP_Optimize\Optimize( $this->data['options']['optimize'] );    
        }
    
    }

    /**
     * Initializes our ajax actions
     */
    private function setupAjax() {     
        $this->ajax = new Waterfall_Ajax();   
    }
    
    /**
     * Initializes the view component so components and templates are load and additional settings are added
     */
    private function setupView() {     
        $this->view = new Waterfall_View();  
    }     

    /**
     * Initializes all WooCommerce related functions
     */
    private function setupWooCommerce() {     
        if( class_exists('WooCommerce') ) {
            $this->woocommerce = new Waterfall_WooCommerce();
        }
    } 
    
    /**
     * Initializes all Event Calendar Related functions
     */
    private function setupEventsCalendar() {     
        if( class_exists('Tribe__Events__Main') ) {
            $this->events = new Waterfall_Events();
        }
    }    
    
    /**
     * Adapt some of the customizer sections with custom names
     */
    private function adaptCustomizer() {  
        add_action( 'customize_register', function($wp_customize) {
            $wp_customize->get_section('background_image')->title = __( 'Background' );
            $wp_customize->get_section('background_image')->priority = 110;
            $wp_customize->get_section('static_front_page')->title = __( 'General' );
            $wp_customize->get_section('static_front_page')->priority = 1;
            $wp_customize->remove_section('colors');
        }, 20 );
    }

    /**
     * Supportive functions for deprecated functionalities
     */
    private function deprecatedSupport() {

        // Older themes still use the customizer value for the main logo, so update it automatically.
        if( (isset($this->data['customizer']['logo']) && $this->data['customizer']['logo']) && ! get_theme_mod('custom_logo') ) {
            set_theme_mod( 'custom_logo', intval($this->data['customizer']['logo']) );
        }        
    
    }
    
    /**
     * Loads and set-up our configurations
     */
    private function configure() {
        
        // Load our basic configurations file
        require_once( get_template_directory() . '/configurations/enqueue.php' );
        require_once( get_template_directory() . '/configurations/register.php' );
        
        $configurations = [
            'elementor' => [
                'Views\Widgets\Breadcrumbs',
                'Views\Widgets\Terms',
            ],
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
        
        /**
         * The execution of our configurations is hooked in after_setup_theme, 
         * so (child) themes can add configurations if they want on an earlier point.
         * This executes all our custom modules, such as custom fields and post types
         */
        add_action('after_setup_theme', [$this, 'executeConfiguration'], 10);        
        
    }   
    
    /**
     * Executes all configuration registrations, so that the configurations have effect. This is hooked on after_theme_setup.
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function executeConfiguration( $type = '' ) {
        
        /**
         * General filter for changing configurations upon execution. 
         * Filtered here so it is accessible by external code
         */
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
                
                // Custom Fields framework
                $customFields = MakeitWorkPress\WP_Custom_Fields\Framework::instance($this->config->configurations['options']['params']);
                
                // Walk through all the option types for the back-end
                if( is_admin() || is_customize_preview() ) {
                    
                    foreach( $this->config->configurations['options'] as $key => $options ) {

                        if( $key == 'params' ) {
                            continue;
                        }
                        
                        $customFields->add( $options['frame'], $options['fields'] );

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
            $commons    = apply_filters( 'waterfall_exlude_post_types', ['attachment', 'elementor_library', 'product', 'tribe_events', 'affiliate-links'] );
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