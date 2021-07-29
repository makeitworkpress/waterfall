<?php 
/**
 * Registers the autoloading for theme classes
 */
spl_autoload_register( function($class_name) {
    
    $called_class       = str_replace( '\\', '/', str_replace( '_', '-', strtolower($class_name) ) );
    $theme_dir          = get_template_directory() . '/';
    
    // Require main parent classes
    $class_names        = explode('/', $called_class);
    $final_class        = array_pop($class_names);
    $class_rel_path     = $class_names ? implode('/', $class_names) . '/class-' . $final_class : 'class-' . $final_class;
    $theme_class_file   = $theme_dir . 'classes/' . $class_rel_path . '.php';

    if( file_exists( $theme_class_file ) ) {
        require_once( $theme_class_file );
        return;
    } 

    // Child themes with WordPress class naming
    $child_class_file   = get_stylesheet_directory() . '/classes/' . $class_rel_path . '.php';
    
    if( file_exists($child_class_file) ) {
        require_once( $child_class_file );
        return;
    } 
    
    // Child themes not using the WordPress class naming ( using a simple class- replace; namespaces in child themes should not have Class_ )
    $child_class_file   = get_stylesheet_directory() . '/classes/' . str_replace('class-', '', $class_rel_path) . '.php';
    
    if( file_exists($child_class_file) ) {
        require_once( $child_class_file );
        return;
    }     
    
    // Require Vendor (composer) classes
    array_splice($class_names, 2, 0, 'src');
    $vendor_class_file  = $theme_dir . 'vendor/' . implode('/', $class_names) . '/' . $final_class . '.php';

    if( file_exists($vendor_class_file) ) {
        require_once( $vendor_class_file );    
    }
   
} );

/**
 * Boot our theme.
 */
$theme = Waterfall::instance();