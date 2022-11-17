<?php 
/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($class_name) {
    
    $called_class       = str_replace( '\\', '/', str_replace( '_', '-', $class_name ) );
    $theme_dir          = get_template_directory() . '/';
    
    // Require main parent classes
    $class_names        = explode('/', $called_class);
    $final_class        = array_pop($class_names);
    $class_rel_path     = $class_names ? implode('/', $class_names) . '/class-' . $final_class : 'class-' . $final_class;
    $theme_class_file   = $theme_dir . 'classes/' . strtolower( $class_rel_path ) . '.php';

    if( file_exists( $theme_class_file ) ) {
        require_once( $theme_class_file );
        return;
    } 

    // Child themes with WordPress class naming
    $child_class_file   = get_stylesheet_directory() . '/classes/' . strtolower($class_rel_path) . '.php';
    
    if( file_exists($child_class_file) ) {
        require_once( $child_class_file );
        return;
    } 
    
    // Child themes not using the WordPress class naming ( using a simple class- replace; namespaces in child themes should not have Class_ )
    $child_class_file   = get_stylesheet_directory() . '/classes/' . strtolower( str_replace('class-', '', $class_rel_path) ) . '.php';
    
    if( file_exists($child_class_file) ) {
        require_once( $child_class_file );
        return;
    }  
    
        
    // Require Vendor (composer) classes
    if( ! isset($class_names[0]) || $class_names[0] !== 'MakeitWorkPress' || ! isset($class_names[1]) ) {
        return;
    }

    array_splice($class_names, 2, 0, 'src');
    $class_names[0] = strtolower($class_names[0]);
    $class_names[1] = strtolower($class_names[1]);
    $vendor_class_file  = $theme_dir . 'vendor/' . implode('/', $class_names) . '/' . $final_class . '.php';

    if( file_exists($vendor_class_file) ) {
        require_once( $vendor_class_file );    
    }
   
} );

/**
 * Boot our theme.
 */
$theme = Waterfall::instance();