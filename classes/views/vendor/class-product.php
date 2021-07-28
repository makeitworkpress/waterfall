<?php
/**
 * Contains the class for initiating a new single product
 */
namespace Views\Vendor;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Product extends \Views\Base {

    /**
     * Sets the properties for the index
     */
    protected function set_properties() {
        $this->type         = 'product';
        $this->properties   = apply_filters( 'waterfall_product_properties', [
            'woocommerce'   => [
                'content_breadcrumbs', 
                'content_breadcrumbs_taxonomy',
                'sidebar_position'
            ]                                    
        ] );
    }

    /**
     * Displays the breadcrumbs
     */
    public function breadcrumbs() {   

        $this->get_properties();

        if( $this->woocommerce['content_breadcrumbs'] ) {
            $taxonomy = $this->woocommerce['content_breadcrumbs_taxonomy'] ? true : false;
            return WP_Components\Build::atom('breadcrumbs', apply_filters('waterfall_single_product_breadcrumbs', ['taxonomy' => $taxonomy, 'archive' => true]), false);
        } else {
            return false;
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

        if( ! isset($this->woocommerce) ) {
            $this->get_properties();
        }

        if( $this->woocommerce['sidebar_position'] === 'left' || $this->woocommerce['sidebar_position'] === 'right' || $this->woocommerce['sidebar_position'] === 'bottom' ) {
            WP_Components\Build::atom( 'sidebar', ['attributes' => ['class' => 'main-sidebar'], 'sidebars' => ['product']] );   
        }      
        
    }    

}