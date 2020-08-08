<?php
/**
 * Contains all WooCommerce related options
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_WooCommerce extends Waterfall_Base {

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 
        
        $this->filters = [
            ['woocommerce_template_path', 'templatePath']
        ];
        
        $this->themeSupport();

    } 
    
    /**
     * Extends themesupport
     */
    private function themeSupport() {

        add_theme_support( 'woocommerce' );  
        
        $woocommerce = wf_get_data('woocommere', ['product_content_zoom', 'product_content_lightbox', 'product_content_slider']);
        
        if( $woocommerce['product_content_zoom'] ) {
            add_theme_support( 'wc-product-gallery-zoom' );
        }
    
        // Lightbox Support
        if( $woocommerce['product_content_lightbox'] ) {
            add_theme_support( 'wc-product-gallery-lightbox' );
        }
        
        // Slider support
        if( $woocommerce['product_content_slider']  ) {
            add_theme_support( 'wc-product-gallery-slider' );
        }

    }

    /**
     * Alters the default WooCommerce template path
     * 
     * @param Array $classes The passed body classes
     */
    public function templatePath( $path ) {
        
        $path = 'templates/woocommerce/';

        return $path;

    }    

}