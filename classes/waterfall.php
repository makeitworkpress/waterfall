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
     * Contains the configurations object for this theme
     *
     * @access private
     */
    public $config; 
    
 
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
         * Load our composer autoloader
         */
        
        /**
         * Enables our theme to be updated through an external repository
         */
        $this->updater = new MakeitWorkPress\WP_Updater\Boot( ['source' => 'https://github.com/makeitworkpress/waterfall'] );
        
        /**
         * Include basic utility functions
         */
        require_once( get_template_directory() . '/functions/utilities.php' ); 
        
        /**
         * Load standard configurations
         */
        $this->configure();
        
        /**
         * The execution of our configurations is hooked in after_setup_theme, 
         * so (child) themes can add configurations if they want on an earlier point
         */
        add_action('after_setup_theme', [$this, 'execute'], 10);           
        
        /**
         * Flush our rewrite rules for new posts
         */
        add_action('after_switch_theme', function() {
            flush_rewrite_rules();    
        });
        
        /**
         * Initialize our components
         */
        $this->components   = new MakeitWorkPress\WP_Components\Boot();         
        
        /**
         * Initialize the view component so templates are load and additional settings are added
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
        
        // Load our configurations file
        require_once( get_template_directory() . '/configurations/customizer.php' );
        require_once( get_template_directory() . '/configurations/enqueue.php' );
        require_once( get_template_directory() . '/configurations/postmeta.php' );
        require_once( get_template_directory() . '/configurations/register.php' );
        
        // Make configurations filterable at early moment
        $configurations = apply_filters( 'waterfall_configurations', [
            'language'  => 'waterfall', 
            'enqueue'   => $enqueue, 
            'register'  => $register, 
            'options'   => [
                'customizerGeneral' => ['frame' => 'customizer', 'fields' => $customizer],
                'colorsPanel'       => ['frame' => 'customizer', 'fields' => $colors],
                'layoutPanel'       => ['frame' => 'customizer', 'fields' => $layout],
                'typographyPanel'   => ['frame' => 'customizer', 'fields' => $typography],
                'postMeta'          => ['frame' => 'meta', 'fields' => $postmeta],
            ] 
        ] );

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
                $this->config->configurations['options']['params'] = isset($this->config->configurations['options']['params']) ? $this->config->configurations['options']['params'] : [];
                
                // Divergent framework
                $this->options = MakeitWorkPress\WP_Custom_Fields\Framework::instance($this->config->configurations['options']['params']);
                
                // Walk through all the option types
                foreach( $this->config->configurations['options'] as $key => $options ) {

                    if( $key == 'params' )
                        continue;
                    
                    $this->options->add( $options['frame'], $options['fields'] );    
                }                
                
            } else {
                $this->{$key} = new $methods[$key]( $this->config->configurations[$key] );    
            }
            
        }
        
        /**
         * Add our custom language domain
         */
        if( isset($this->config->configurations['language']) ) {
            
            if( is_dir( STYLESHEETPATH . '/languages' ) ) {
                $path = STYLESHEETPATH . '/languages';
            } else {
                $path = TEMPLATEPATH . '/languages'; 
            }
            
            $path = apply_filters('waterfall_language_path', $path);
            
            load_theme_textdomain( $this->config->configurations['language'], $path );   
        }

        // Save our additional post types to the database, so we can modify them later
        $this->savePostTypes();       
        
    }

    /**
     * Saves the available public post types to the database so we can access them at an earlier point, such as in the configurations
     */
    private function savePostTypes() {

        add_action('init', function() {
            $commons    = apply_filters( 'waterfall_exlude_post_types', ['attachment', 'elementor_library', 'product'] );
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