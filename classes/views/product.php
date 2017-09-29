<?php
/**
 * Contains the class for initiating a new single product
 */
namespace Views;
use WP_Components as WP_Components;

class Product extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_product_properties', array(
            'layout' => array('content_breadcrumbs', 'sidebar_position')                                     
        ) );
    }

    /**
     * Displays the breadcrumbs
     */
    public function breadcrumbs() {   

        $this->getProperties();

        if( $this->layout['content_breadcrumbs'] ) {
            WP_Components\Build::atom(
                'breadcrumbs', 
                apply_filters( 'waterfall_single_product_breadcrumbs', ['taxonomy' => true, 'archive' => true] ) 
            ); 
        }       
    }

    /**
     * Displays the actual product content
     */
    public function content() {
        while ( have_posts() ) : the_post();
        
            wc_get_template_part( 'content', 'single-product' );
        
        endwhile; // end of the loop.        
    } 

    /**
     * Displays the product sidebar
     */
    public function sidebar() {

        if( ! isset($this->layout) ) {
            $this->getProperties();
        }

        if( $this->layout['sidebar_position'] == 'left' || $this->layout['sidebar_position'] == 'right' || $this->layout['sidebar_position'] == 'bottom' )
            WP_Components\Build::molecule( 'sidebar',array('sidebars' => array('product'), 'style' => 'sidebar') );         
        
    }    

}