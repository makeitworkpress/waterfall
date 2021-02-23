<?php
/**
 * Contains all bbPress related options
 */
namespace Vendor;
use Waterfall_Base as Waterfall_Base;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_bbPress extends Waterfall_Base {

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 
        
        $this->filters      = [
            ['bbp_get_bbpress_template', 'modifyTemplate']
        ];

    } 
    

    /**
     * Adds support for arrow and dot navigation in the carousel
     * 
     * @param Array {$args} The template arguments
     * @return Array {$args} The modified template arguments
     */
    public function modifyTemplate( $args ) {
        
        array_unshift($args, 'templates/bbpress/bbpress-template.php');
        
        return $args;

    }

}