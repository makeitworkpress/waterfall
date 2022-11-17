<?php
/**
 * Contains all bbPress related options
 */
namespace Plugins;
use Waterfall_Base as Waterfall_Base;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_bbPress extends Waterfall_Base {

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 
        
        $this->filters      = [
            ['bbp_get_bbpress_template', 'modify_template']
        ];

    } 
    

    /**
     * Adds support for arrow and dot navigation in the carousel
     * 
     * @param Array {$args} The template arguments
     * @return Array {$args} The modified template arguments
     */
    public function modify_template( $args ) {
        
        array_unshift($args, 'templates/bbpress/bbpress-template.php');
        
        return $args;

    }

}