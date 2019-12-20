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
             * Prevent elementor inserting weird templates
             */
            add_filter('template_include', function($template) {

                /**
                 * If we are viewing an archive, we want to display the archive from Waterfall
                 */

                /**
                 * If we are viewing a WooCommerce product archive, we want to display the Product archive from Waterfall
                 */                 

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

        add_action( 'elementor/init', function() use($classes) {

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

                    $widget = new $widget();
                    $elementor->widgets_manager->register_widget_type( $widget );
                }

            }

        } );

    }

}