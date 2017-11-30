<?php
/**
 * Registers our custom elementor widgets
 */
use Elementor as Elementor;
use WP_Error as WP_Error;

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

        // We don't do anything without the widgets
        if( ! $widgets || ! is_array($widgets) ) {
            return;
        }

        // Our widgets
        $this->widgets = $widgets;
        $this->registerWidgets();
    }

    /**
     * Registers our new widgets
     *
     * @return string/null $error The Error message if Elementor is missing
     */
    private function registerWidgets() {

        // Some things should be here....
        if( ! defined('ELEMENTOR_PATH') || ! class_exists('Elementor\Widget_Base') || ! class_exists( 'Elementor\Plugin' ) || ! is_callable( 'Elementor\Plugin', 'instance' ) ) { 
            return new WP_Error( 'missing', __('In order to register custom elementor Widgets in Waterfall, you need to have the Elementor Plugin activated.', 'waterfall') );
        }        

        // Add our custom widgets
        $classes = $this->widgets;

        add_action( 'elementor/init', function() use($classes) {

            // Load the elementor plugin instance
            $elementor  = Elementor\Plugin::instance();

            if( isset($elementor->widgets_manager) && method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {
                foreach( $classes as $widget ) {
                    $widget = new $widget();
                    $elementor->widgets_manager->register_widget_type( $widget );
                }

            }

        } );

    }

}