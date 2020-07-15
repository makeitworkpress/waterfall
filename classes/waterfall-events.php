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
            ['template_include', 'locateTemplate', 50]
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
     * If an event is not being built with Elementor, make sure the Event Calendar outputs it's content
     */

}