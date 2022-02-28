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
     * Contains the bbPress object
     *
     * @access public
     */
    public $bbPress;    

    /**
     * Contains the configurations object
     *
     * @access public
     */
    public $config;  

   /**
     * Contains the elementor object
     *
     * @access public
     */
    public $elementor;       
    
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

        if( self::$instance === null ) {
            self::$instance = new self();
        }

        return self::$instance;

    }    
      
    /** 
     * Constructor. This allows the class to be only initialized once.
     */
    private function __construct() {

        // Sets our languages - before anything else loads
        $this->load_languages();

        // Loads utilityFunctions and other static dependencies
        $this->require_dependencies();        

        // Boot the updater
        $this->boot_updater();

        // Loads and executes configurations
        $this->configure();

        // Flush rewrite rules
        $this->flush_rewrite_rules();

        // Setup Ajax related functions
        $this->setup_ajax();

        // Setup the view - loading templates, components and modifiying the front-end
        $this->setup_view();
        
        // Setup WooCommerce related functions
        $this->setup_woocommerce();

        // Setup bbPress related functions
        $this->setup_bbpress();

        // Setup Events Calendar related functions
        $this->setup_events_calendar();
         
        // Adapt some of the customizer sections
        $this->adapt_customizer();
        
        // Setup supportive functions for deprecated functionalities
        $this->deprecated_support();
        
        // Enable optimizations
        $this->enable_optimizations();

    }

    /**
     * Retrieves the theme configurations
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Loads our translations before loading anything else
     */
    private function load_languages() {

        if( is_dir( get_stylesheet_directory() . '/languages' ) ) {
            $path = get_stylesheet_directory() . '/languages';
        } else {
            $path = get_template_directory() . '/languages'; 
        }
        
        load_theme_textdomain( 'waterfall', apply_filters('waterfall_language_path', $path) ); 

    }

    /**
     * Loads utilityFunctions and other static dependencies
     *  Include basic utility functions, so that these are available throughout the theme
     */
    private function require_dependencies() { 
        require_once( get_template_directory() . '/functions/utilities.php' );   
    }

    /**
     * Enables our theme to be updated through an external repository, in this case github
     */
    private function boot_updater() {
        $this->updater = MakeitWorkPress\WP_Updater\Boot::instance();
        $this->updater->add(['source' => 'https://github.com/makeitworkpress/waterfall', 'type' => 'theme']);
    }    
        
    /**
     * Flush our rewrite rules for new posts
     */
    private function flush_rewrite_rules() {

        add_action('after_switch_theme', function() { 
            flush_rewrite_rules(); 
        });

    }

    /**
     * Initializes the basic settings for a theme
     */
    private function enable_optimizations() {    

        $optimizations = wf_get_data('options', 'optimize');

        if( $optimizations ) {
            $this->optimize = new MakeitWorkPress\WP_Optimize\Optimize( $optimizations );    
        }
    
    }

    /**
     * Initializes our ajax actions
     */
    private function setup_ajax() {     
        $this->ajax = new Waterfall_Ajax();   
    }
    
    /**
     * Initializes the view component so components and templates are load and additional settings are added
     */
    private function setup_view() {     
        $this->view = new Waterfall_View();  
    }     

    /**
     * Initializes all WooCommerce related functions
     */
    private function setup_woocommerce() {     
        if( class_exists('WooCommerce') ) {
            $this->woocommerce = new Plugins\Waterfall_WooCommerce();
        }
    } 

    /**
     * Provides bbPress compatibility
     */
    private function setup_bbpress() {     
        if( class_exists('bbPress') ) {
            $this->bbPress = new Plugins\Waterfall_bbPress();
        }
    } 
    
    
    /**
     * Initializes all Elementor Related functions
     */
    private function setup_elementor() {     
        if( did_action('elementor/loaded') ) {
            $this->elementor = new Plugins\Waterfall_Elementor($this->config->configurations);
        }
    }     
    
    /**
     * Initializes all Event Calendar Related functions
     */
    private function setup_events_calendar() {     
        if( class_exists('Tribe__Events__Main') ) {
            $this->events = new Plugins\Waterfall_Events();
        }
    }    
    
    /**
     * Adapt some of the customizer sections with custom names
     */
    private function adapt_customizer() {  
        add_action( 'customize_register', function($wp_customize) {
            $wp_customize->get_section('background_image')->title = __( 'Background', 'waterfall' );
            $wp_customize->get_section('background_image')->priority = 110;
            $wp_customize->get_section('static_front_page')->title = __( 'General', 'waterfall'  );
            $wp_customize->get_section('static_front_page')->priority = 1;
            $wp_customize->remove_section('colors');
        }, 20 );
    }

    /**
     * Supportive functions for deprecated functionalities
     */
    private function deprecated_support() {

        /**
         * Older themes still use the customizer value for the main logo, so we need to update it automatically.
         */
        $logo = wf_get_data('customizer', 'logo');
        if( $logo  && ! get_theme_mod('custom_logo') ) {
            set_theme_mod( 'custom_logo', $logo );
        }  
        
        /**
         * Before version 2.3.9, layout was saved under the customizer thememod.
         * Hence, we need to transfer existing lay-out values to the new theme mod if not done so
         */
        $updated_layout_ids         = ['layout', 'layout_width', 'layout_boxed_width', 'border_radius', 'layout_elementor_padding_top', 'layout_elementor_padding_bottom'];
        $destination_layout_values  = wf_get_data('layout', $updated_layout_ids);
        $layout_values_set          = false;

        // Our values have been transferred
        foreach( $destination_layout_values as $key => $value ) {
            if( $value ) {
                $layout_values_set  = true;    
            }
        }

        // If our values have not been set, retrieve our old values and reset the new layout array. Only done once to save queries.
        if( ! $layout_values_set ) {

            $original_layout_values = wf_get_data('customizer', $updated_layout_ids);

            if( $original_layout_values ) {
                
                $customizer_values  = wf_get_data('layout');

                foreach( $original_layout_values as $key => $value ) {
                    $customizer_values[$key] = $value;
                }

                set_theme_mod('waterfall_layout', $customizer_values);

            }

        }

        /**
         * Before 2.7.9, meta keys for visibility, transparent headers and more were stored in a key with a boolean value. 
         * After, they are stored as single values without an extra key. This script converts this when saving a post.
         */
        $updated_meta = get_option('waterfall_updated_meta');

        if( ! $updated_meta ) {
            $updated_meta_array = [
                'content_width' => 'full', 
                'transparent_header' => 'transparent', 
                'header_disable' => 'disable', 
                'footer_disable' => 'disable',
                'content_header_disable' => 'disable', 
                'content_sidebar_disable' => 'disable', 
                'content_related_disable' => 'disable', 
                'content_footer_disable' => 'disable'        
            ];
            $waterfall_post_types = array_keys( wf_get_post_types(true) );
            $posts = get_posts(['fields' => 'ids', 'post_type' => $waterfall_post_types, 'posts_per_page' => -1]);

            if( $posts ) {
                foreach($posts as $post_id) {
                    $waterfall_meta = (array) get_post_meta($post_id, 'waterfall_meta', true);
                    
                    foreach( $updated_meta_array as $key => $subkey ) {
                        if( isset($waterfall_meta[$key][$subkey]) ) {
                            $waterfall_meta[$key] = $waterfall_meta[$key][$subkey];
                        }
                    }
       
                    update_post_meta( $post_id, 'waterfall_meta', $waterfall_meta);

                    if( did_action('elementor/loaded') ) {
                        $elementor_page_meta = (array) get_post_meta( $post_id, '_elementor_page_settings', true);
                        foreach($waterfall_meta as $meta_key => $meta_value) {
                            if( ! in_array($meta_key, array_keys($updated_meta_array)) ) {
                                continue;
                            }
                            $elementor_page_meta[$meta_key] = is_bool($meta_value) && $meta_value ? 'yes' : '';
                        }
                        update_post_meta( $post_id, '_elementor_page_settings', $elementor_page_meta );
                    }
                     

                }
            }
            update_option('waterfall_updated_meta', true);
        }
    
    }
    
    /**
     * Loads and set-up our configurations
     */
    private function configure() {
        
        // Load our basic configurations file
        $lightbox       = wf_get_data('customizer', 'lightbox');
        $sidebars       = wf_get_data('layout', 'footer_sidebars') ? wf_get_data('layout', 'footer_sidebars') : 'third';
        $slider         = wf_get_data('woocommerce', 'product_content_slider');
        require_once( get_template_directory() . '/configurations/enqueue.php' );
        require_once( get_template_directory() . '/configurations/register.php' );
        
        $configurations = [
            'elementor' => [
                'Views\Elementor_Widgets\Breadcrumbs',
                'Views\Elementor_Widgets\Terms',
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
                'params'            => ['google_maps_key' => wf_get_data('options', 'maps_api_key') ],
                'post_meta'         => ['frame' => 'meta', 'fields' => $postmeta],
                'options'           => ['frame' => 'options', 'fields' => $options]
            ]; 

        }

        // The custom fields options are only loaded in admin or customizer contexts to ensure better front-end performance
        if( is_customize_preview() ) {

            require_once( get_template_directory() . '/configurations/customizer.php' );  

            $configurations['options']['customizer_general'] = ['frame' => 'customizer', 'fields' => $customizer];
            $configurations['options']['colors_panel']       = ['frame' => 'customizer', 'fields' => $colors];
            $configurations['options']['layout_panel']       = ['frame' => 'customizer', 'fields' => $layout];
            $configurations['options']['typography_panel']   = ['frame' => 'customizer', 'fields' => $typography];

            // Woocommerce configurations
            if( class_exists( 'WooCommerce' ) ) {
                require_once( get_template_directory() . '/configurations/customizer/woocommerce.php' );
                $configurations['options']['woocommerce']   = ['frame' => 'customizer', 'fields' => $woocommerce];
            } 
            
            // bbPress configurations
            if( class_exists( 'bbPress' ) ) {
                require_once( get_template_directory() . '/configurations/customizer/bbpress.php' );
                $configurations['options']['bbpress']       = ['frame' => 'customizer', 'fields' => $bbpress];
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
        add_action('after_setup_theme', [$this, 'execute_configuration'], 10);        
        
    }   
    
    /**
     * Executes all configuration registrations, so that the configurations have effect. This is hooked on after_theme_setup.
     *
     * @param string $type If defined, executes a specific registration, otherwise executes all
     */
    public function execute_configuration( $type = '' ) {
        
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
            
            if( $key === 'options' ) {
                
                // Custom Fields framework
                $params       = isset($this->config->configurations['options']['params']) ? $this->config->configurations['options']['params'] : [];
                $customFields = MakeitWorkPress\WP_Custom_Fields\Framework::instance($params);
                
                // Walk through all the option types for the back-end
                if( is_admin() || is_customize_preview() ) {
                    
                    foreach( $this->config->configurations['options'] as $key => $options ) {

                        if( $key === 'params' ) {
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
            $this->save_post_types();     
        }  

        /**
         * Setup Elementor related functions
         * The function is hooked at this point, so that configuration from child themes are still taken into account
         */
        $this->setup_elementor();
        
    }

    /**
     * Saves the available public post types to the database so we can access them at an earlier point, such as in the configurations
     */
    private function save_post_types() {

        add_action('init', function() {
            $commons    = apply_filters( 
                'waterfall_exlude_post_types', 
                ['attachment', 'elementor_library', 'product', 'tribe_events', 'affiliate-links', 'forum', 'topic', 'reply', 'e-landing-page'] 
            );
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