<?php
/**
 * Contains the class for initiating a new shop or product archive page
 */
namespace Views\Plugins;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Shop extends \Views\Base {

    /**
     * Sets the properties for the index
     */
    protected function set_properties() {
        $this->type         = 'product_archive';
        $this->properties   = apply_filters( 'waterfall_catalog_properties', [
            'woocommerce' => ['header_disable', 'header_align', 'header_breadcrumbs', 'header_height', 'header_position', 'header_width', 'sidebar_position' ]                                     
        ] );
    }

    /**
     * Displays the shop header
     */
    public function header() {

        // Get our properties
        $this->get_properties();

        /**
         * Completely disables the title section
         * Our woocommerce recieves options from a different customizer id, 
         * hence we do not use the built-in disabled function from the extended base class in classes/views/base.php.
         */ 
        if( $this->woocommerce['header_disable'] ) {
            return;
        }

        // Breadcrumbs
        if( $this->woocommerce['header_breadcrumbs'] ) {
            $atoms['breadcrumbs'] = ['atom' => 'breadcrumbs', 'properties' => []];    
        }
        
        // Default title
        if( apply_filters( 'woocommerce_show_page_title', true ) ) {
            $atoms['archive-title'] = [
                'atom'  => 'archive-title',
                'properties' => [
                    'attributes'    => ['class' => 'woocommerce-products-header__title page-title'],
                    'custom'        => woocommerce_page_title(false) 
                ]
            ];    
        }
        
        // Add custom action from woocommerce as a a string
        ob_start();
        do_action( 'woocommerce_archive_description' );
        $atoms['string'] = ['atom' => 'string', 'properties' => ['string' => ob_get_clean()]];
        
        $args = apply_filters('waterfall_product_archive_header_args', [
            'align'         => $this->woocommerce['header_align'],
            'atoms'         => $atoms,
            'attributes'    => ['class' => 'main-header woocommerce-products-header'],
            'container'     => $this->woocommerce['header_width'] === 'full' ? false : true,
            'height'        => $this->woocommerce['header_height']
        ] );
        
        WP_Components\Build::molecule( 'post-header', $args );        
     
    }

    /**
     * Displays the products shop content
     */
    public function posts() {

        if ( have_posts() ) :

            /**
                * woocommerce_before_shop_loop hook.
                *
                * @hooked wc_print_notices - 10
                * @hooked woocommerce_result_count - 20
                * @hooked woocommerce_catalog_ordering - 30
                */
            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            woocommerce_product_subcategories();

            while ( have_posts() ) : the_post();


                /**
                    * woocommerce_shop_loop hook.
                    *
                    * @hooked WC_Structured_Data::generate_product_data() - 10
                    */
                do_action( 'woocommerce_shop_loop' );

                wc_get_template_part( 'content', 'product' ); 

            endwhile; // end of the loop.

            woocommerce_product_loop_end();

            /**
                * woocommerce_after_shop_loop hook.
                *
                * @hooked woocommerce_pagination - 10
                */
            do_action( 'woocommerce_after_shop_loop' );


        elseif ( ! woocommerce_product_subcategories(['before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)]) ) :

            /**
                * woocommerce_no_products_found hook.
                *
                * @hooked wc_no_products_found - 10
                */
            do_action( 'woocommerce_no_products_found' );

        endif;     
        
    }  
    
    /**
     * Displays the sidebar for the shop
     */
    public function sidebar() {

        if( ! isset($this->woocommerce) ) {
            $this->get_properties();
        }

        if( $this->woocommerce['sidebar_position'] === 'left' || $this->woocommerce['sidebar_position'] === 'right' || $this->woocommerce['sidebar_position'] === 'bottom' || ! $this->woocommerce['sidebar_position'] )
            WP_Components\Build::atom( 'sidebar', ['attributes' => ['class' => 'main-sidebar'], 'sidebars' => ['product-archive']] );         
        
    }    

}