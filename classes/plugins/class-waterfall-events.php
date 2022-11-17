<?php
/**
 * Contains all Event Calendar related options
 */
namespace Plugins;
use Waterfall_Base as Waterfall_Base;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Events extends Waterfall_Base {

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 
        
        $this->filters = [
            ['template_include', 'locate_template', 50],
            ['tribe_get_events_link', 'adapt_events_link']
        ];

    } 

    /**
     * Setup a custom template for the Events Calendar
     * 
     * @param String $template The template that is included
     */
    public function locate_template($template) {

        if( strpos($template, 'the-events-calendar/src/views/v2/default-template.php') || strpos($template, 'the-events-calendar\src\views\v2\default-template.php') ) {

            // Use the custom theme template
            $template = '/templates/events-calendar/events-template.php';
            
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
     * Setup a custom link for the Events Calendar Page
     * 
     * @param String $link The link for the events overview page
     */
    public function adapt_events_link($link) {

        $page = wf_get_data('customizer', 'tribe_events_page');

        if( is_numeric($page) ) {
            $link = esc_url( get_permalink($page) );
        }
        
        return $link;

    }    

}