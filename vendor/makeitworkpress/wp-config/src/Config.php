<?php
/**
 * This class set-ups a configuration class for use in plugins and themes
 * It can load configurations from an array or a file
 * If the configurations are loaded from a file, the file itself should return these configurations
 */
namespace MakeitWorkPress\WP_Config;
use WP_Error as WP_Error;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Config { 

    /**
     * Contains our modified configurations
     *
     * @access public
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
    public function __construct( array $configuration ) {

        // If the configuration parameter is a string, we expect that it is a file path
        if( is_string($configuration) ) {
            
            $this->load( $configuration );

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
     * @param string    $type               The subtype of configurations to add. Refers to a direct key within the configurations.
     * @param array     $configurations     The configurations that you want to add to this type
     */
    public function add( string $type, array $configurations= [] ): void {
        
        // Type should be defined
        if( ! $type ) {
            $error = new WP_Error( 'type_missing', __('Please define a configuration type', 'wp-config') );
            echo $error->get_error_message();
            return;
        }

        // If the configuration alreday exists for the array, we merge those arrays
        if( isset($this->configurations[$type]) && is_array($this->configurations[$type]) ) {
            $configurations = $this->multi_parse_args( $configurations, $this->configurations[$type] );    
        }

        // Now, set our configurations
        $this->configurations[$type] = apply_filters( 'wp_config_' . $type, $configurations );

    }

    /**
     * Deletes a certain set of configurations
     * @todo To be developed
     */
    public function delete( string $type, array $configurations ): void {

    }    

    /**
     * Loads our configuration file
     *
     * @param string $configuration The uri to the configuration file
     * @return WP_Error|array Error if we can't load the file, the configuration if we succeed;
     */
    private function load( string $configuration ) {

        // Check's if we have a valid file and loads the configurations.
        if( file_exists( $configuration ) ) {

            $data = require_once(  $configuration  );
            $this->configurations = $data ? (array) $data : [];

        } else {
            return new WP_Error( 'missing', __('Could not load the configuration file for your theme or plugin!', 'wp-config') );
        }

    }

    /**
     * Allows us to parse arguments in a multidimensional array
     * 
     * @param array $args The arguments to parse
     * @param array $default The default arguments
     * 
     * @return array $array The merged array
     */
    public function multi_parse_args( array $args, array $default ): array {

        if( ! is_array($default) ) {
            return wp_parse_args( $args, $default );
        }

        $array = [];

        // Loop through our multidimensional array
        foreach( [$default, $args] as $elements ) {
            foreach( $elements as $key => $element ) {

                // If we have numbered keys
                if( is_integer($key) ) {
                    $array[] = $element;
                } elseif( isset( $array[$key] ) && (is_array( $array[$key] )) ) {
                    $array[$key] = $this->multi_parse_args( $element, $array[$key] );
                } else {
                    $array[$key] = $element;
                }

            }
        }

        return $array;

    }

}