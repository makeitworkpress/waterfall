<?php
/**
 * The view wrapper for displaying events
 */
namespace Views\Vendor;
use Tribe\Events\Views\V2\Template_Bootstrap;
use Elementor;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Events extends \Views\Base {

    /**
     * No properties are set for this template - we're not using the customizer
     */
    protected function setProperties() {
        $this->type = 'product_archive';
    }

    /**
     * Displays the single post or page content
     */
    public function content() {

        // Displays regular content if we're using Elementor
        if( is_singular('tribe_events') && class_exists('Elementor\Plugin') && Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_id()) ) {
            
            echo apply_filters('the_content', '');

        // We're using the Events Calendar Display
        } elseif( class_exists('Tribe\Events\Views\V2\Template_Bootstrap') ) {
            echo tribe( Template_Bootstrap::class )->get_view_html(); 
        }

    }

}