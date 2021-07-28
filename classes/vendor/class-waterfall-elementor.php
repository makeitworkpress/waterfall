<?php
/**
 * Registers our custom elementor widgets
 */
namespace Vendor;
use Elementor as Elementor;
use Waterfall_Base as Waterfall_Base;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Elementor extends Waterfall_Base {

    /**
     * Contains the class references to our custom widgets
     * @access private
     */
    private $widgets;

    /**
     * Initializes the class
     */
    public function initialize() {

        // Elementor should have loaded
        if( ! did_action('elementor/loaded') ) {
            return;
        }

        // Passed on from the inherited parent class
        $this->widgets = $this->options;

        $this->filters = [
            ['template_include', 'load_header_footer', 20]
        ];

        $this->actions = [
            ['elementor/theme/register_locations', 'support_theme_builder'],
        ];

        // Extra actions if we have widgets
        if( $this->widgets ) {
            $this->actions[] = ['elementor/elements/categories_registered', 'register_widget_categories'];
            $this->actions[] = ['elementor/widgets/widgets_registered', 'register_widgets'];   
        }

    }

    /**
     * Registers custom widget categories for elementor
     * 
     * @param Object $elementor_theme_manager The Elements Theme Manager object
     */
    public function support_theme_builder($elementor_theme_manager) {
        $elementor_theme_manager->register_all_core_location();
    }

    /**
     * Prevent elementor inserting weird header and footer templates, but use the ones from waterfall instead
     * 
     * @param String $template The template being included
     * 
     * @return String $template The string to the template file returned
     */
    public function load_header_footer($template) {

        /**
         * We need to overwrite the elementor basic template display with our own, so the correct
         * header and footer is rendered for the theme builder templates.
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

    }

    /**
     * Registers custom widget categories for elementor
     * 
     * @param Object $elements_manager The Elements Manager object
     */
    public function register_widget_categories($elements_manager) {
            
        $elements_manager->add_category(
            'waterfall-widgets',
            [
                'title' => __( 'Waterfall', 'waterfall' ),
                'icon' => 'fa fa-plug',
            ]
        );

    }

    /**
     * Registers our new widgets
     */
    public function register_widgets() {

        // Add our custom widgets
        $classes    = $this->widgets;

        // Some things should be here....
        if( ! defined('ELEMENTOR_PATH') || ! class_exists('Elementor\Widget_Base') || ! is_callable( 'Elementor\Plugin', 'instance' ) ) { 
            return;
        }

        // Load the elementor plugin instance
        $elementor  = Elementor\Plugin::instance();

        if( isset($elementor->widgets_manager) && method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {
            
            foreach( $this->widgets as $widget ) {

                if( ! class_exists($widget) ) {
                    continue;
                }
                
                $elementor->widgets_manager->register_widget_type( new $widget() );

            }

        }

    }

}