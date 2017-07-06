<?php 
/**
 * Main Functions file
 *
 * Table of Functions (ToF)
 * 1. Autoload Registration
 * 2. Basic functions for retrieving headers and so forth
 * 3. Boot components
 * 4. Theme instanciation and registration
 */

/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($classname) {
    
    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );
    
    $classes    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    $vendor     = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . $class . '.php';
    
    if( file_exists($classes) ) {
        require_once( $classes );
    } elseif( file_exists($vendor) ) {
        require_once( $vendor );    
    }
   
} );

/**
 * Boot our components
 */
$components = new WP_Components\Boot();

/**
 * Boot our theme
 */
$theme = Waterfall::instance();