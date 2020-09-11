<?php
/**
 * Contains all WooCommerce related options
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_WooCommerce extends Waterfall_Base {

    /**
     * Holds our customizer data
     * @access private
     */
    private $customizer = [];

    /**
     * Initialize our WooCommerce functions
     */
    public function initialize() { 

        $this->customizer   = wf_get_data( 'woocommerce', [
            'product_content_zoom', 
            'product_content_lightbox', 
            'product_content_slider',
            'product_content_slider_arrows',
            'product_content_slider_dots'
        ]);
        
        $this->filters      = [
            ['woocommerce_single_product_carousel_options', 'productCarouselSettings'],
            ['woocommerce_template_path', 'templatePath']
        ];
        
        $this->themeSupport();

    } 
    
    /**
     * Extends themesupport
     */
    private function themeSupport() {

        add_theme_support( 'woocommerce' );  
        
        if( $this->customizer['product_content_zoom'] ) {
            add_theme_support( 'wc-product-gallery-zoom' );
        }
    
        // Lightbox Support
        if( $this->customizer['product_content_lightbox'] ) {
            add_theme_support( 'wc-product-gallery-lightbox' );
        }
        
        // Slider support
        if( $this->customizer['product_content_slider']  ) {
            add_theme_support( 'wc-product-gallery-slider' );
        }

    }

    /**
     * Adds support for arrow and dot navigation in the carousel
     * 
     * @param Array {$args} The carousel arguments
     * @return Array {$args} The modifiedcarousel arguments
     */
    public function productCarouselSettings( $args ) {
        
        // Dot navigation
        if( $this->customizer['product_content_slider_dots'] ) {
            $args['controlNav']     = true;
        }

        // Arrows
        if( $this->customizer['product_content_slider_arrows'] ) {
            $args['directionNav']   = true;
            $args['nextText']       = '<i class="fa fa-angle-right"></i>';
            $args['prevText']       = '<i class="fa fa-angle-left"></i>';
        }
        
        return $args;

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