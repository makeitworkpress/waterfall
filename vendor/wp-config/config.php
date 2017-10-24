<?php
/**
 * This class set-ups a configuration class for use in plugins and themes
 * It can load configurations from an array or a file
 * If the configurations are loaded from a file, the file itself should return these configurations
 */
namespace WP_Config;
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Config { 

    /**
     * Contains our modified configurations
     *
     * @access private
     */
    public $configurations;

    /**
     * Initializes and sets our configurations in the form of an array
     * Why do we keep the configurations in an array and not an object?
     * At first, this allows for easy looping through the data. Secondary, this limits the objects in memory.
     *
     * @param array $configuration The array with initial configurations, which could either be an array or a link to the file with configurations
     * @return void
     */ 
    public function __construct( $configuration ) {

        // If the configuration parameter is a string, we expect that it is a file path
        if( is_string($configuration) ) {
            $this->configurations = $this->load( $configuration );

            if( is_wp_error($this->configurations) ) {
                echo $this->configurations->get_error_message();
            }

        } else {
            $this->configurations = $configuration;
        }

    }

    /**
     * Adds or modifies configuration to one of the keys in the overall configuration array
     * This enables plugins or child themes to add additional configurations to an existing entity 
     *
     * @todo Enable to adapt or modify configurations on a deeper level
     *
     * @param string    $type               The subtype of configurations to add. Refers to a direct key of the configurations.
     * @param array     $configurations     The configurations that you want to add to this type
     */
    public function add( $type, $configurations= [] ) {
        
        // Tyoe should be defined
        if( ! $type ) {
            $error = new WP_Error( 'type_missing', __('Please define a configuration type', 'wp-config') );
            return $error->get_error_message();
        }

        // If the configuration alreday exists for the array, we merge those arrays
        if( isset($this->configurations[$type]) && is_array($this->configurations[$type]) ) {
            $configurations = wp_parse_args( $configurations, $this->configurations[$type] );    
        }

        // Now, set our configurations
        $this->configurations[$type] = apply_filters( 'wp_config_' . $type, $configurations );

    }

    /**
     * Loads our configuration file
     *
     * @param string $configuration The uri to the configuration file
     * @return WP_Error|array Error if we can't load the file, the configuration if we succeed;
     */
    private function load( $configuration ) {

        // Check's if we have a valid file and loads the configurations.
        if( file_exists( $configuration ) ) {

            // Make sure there the configuration file returns an array of data
            $data = require_once(  $configuration  );

            $this->configuration = $data ? (array) $data : [];

        } else {
            return new WP_Error( 'missing', __('Could not load the configuration file for your theme or plugin!', 'wp-config') );
        }

    }

    /**
     * Sanitizes the configurations in the array accordig to a certain pattern
     * @todo Needs to be developed
     */
    private function sanitize() {

    }

}