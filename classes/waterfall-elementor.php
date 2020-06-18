<?php
/**
 * Registers our custom elementor widgets
 */
use Elementor as Elementor;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Elementor {

    /**
     * Contains the class references to our custom widgets
     * @access private
     */
    private $widgets;

    /**
     * Initializes the class
     */
    public function __construct( $widgets = [] ) {

        // These actions are only executed if elementor is installed
        if ( did_action('elementor/loaded') ) {

            /**
             * Registers support for Elementor Pro Theme Builder Locations
             */
            add_action( 'elementor/theme/register_locations', function($elementor_theme_manager) {
                $elementor_theme_manager->register_all_core_location();
            } );  

            /**
             * Prevent elementor inserting weird header and footer templates, but use the ones from waterfall instead
             */
            add_filter('template_include', function($template) {

                /**
                 * We need to overwrite the elementor basic template display with our own, so the correct
                 * header and footer is rendered. Sounds like a deal!
                 */
                if( strpos($template, 'elementor/modules/page-templates/templates/header-footer.php') ) {
                    
                    $template = '/templates/elementor/header-footer.php';
                    
                    // Check if our file exists
                    if ( file_exists( STYLESHEETPATH . $template ) ) {
                        $template = STYLESHEETPATH . $template;
                    } elseif ( file_exists( TEMPLATEPATH . $template ) ) {
                        $template = TEMPLATEPATH . $template;
                    }

                }

                return $template;

            }, 20);
            
            /**
             * As we're going to register Widgets here,
             * we don't do anything without the widgets
             */ 
            if( ! $widgets || ! is_array($widgets) ) {
                return;
            }

            // Our widgets
            $this->widgets = $widgets;            

            // Register custom categories
            $this->widgetCategories();

            // Register custom widgets
            $this->registerWidgets();

        }

    }


    /**
     * Registers custom widget categories for elementor
     */
    private function widgetCategories() {

        add_action( 'elementor/elements/categories_registered', function($elements_manager) {
            
            $elements_manager->add_category(
                'waterfall-widgets',
                [
                    'title' => __( 'Waterfall', 'waterfall' ),
                    'icon' => 'fa fa-plug',
                ]
            );

        } );

    }

    /**
     * Registers our new widgets
     */
    private function registerWidgets() {
       
        // Add our custom widgets
        $classes    = $this->widgets;

        add_action( 'elementor/widgets/widgets_registered', function() use($classes) {

            // Some things should be here....
            if( ! defined('ELEMENTOR_PATH') || ! class_exists('Elementor\Widget_Base') || ! class_exists( 'Elementor\Plugin' ) || ! is_callable( 'Elementor\Plugin', 'instance' ) ) { 
                return;
            }

            // Load the elementor plugin instance
            $elementor  = Elementor\Plugin::instance();

            if( isset($elementor->widgets_manager) && method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {
                foreach( $classes as $widget ) {

                    if( ! class_exists($widget) ) {
                        continue;
                    }
                    
                    $elementor->widgets_manager->register_widget_type( new $widget() );

                }

            }

        } );

    }

}