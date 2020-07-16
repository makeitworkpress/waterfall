<?php
/**
 * Contains all Event Calendar related options
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Events extends Waterfall_Base {

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 
        
        $this->filters = [
            ['template_include', 'locateTemplate', 50],
            ['the_content', 'filterContent']
        ];



    } 

    /**
     * Setup a custom template for the Events Calendar
     * 
     * @param String $template The template that is included
     */
    public function locateTemplate($template) {

        if( strpos($template, 'the-events-calendar/src/views/v2/default-template.php') ) {

            $template = '/templates/events-calendar/default-template.php';
                
            if( tribe_get_option( 'tribeEventsTemplate') == 'default' ) {
                if( is_singular() ) {
                    $template = '/templates/singular.php';
                } else {
                    $template = '/templates/index.php';
                }
            }
            
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
     * If an event is  being built with Elementor, make sure the Event Calendar doesn't output it's content
     */
    public function filterContent($content) {

        // Remove the front-end content filtering if this page is been designed by Elementor
        if( class_exists('Elementor\Plugin') ) {
            var_dump( Elementor\Plugin::$instance->frontend->has_elementor_in_page() );

        }
        
        // Always return content here! Otherwise, it ill crank up your WordPress Bigtime
        return $content;

    }

}