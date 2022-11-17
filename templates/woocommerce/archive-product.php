<?php
/**
 * Displays a single woocommerce product
 *
 * Retrieves our header
 */
wf_get_theme_header(); 

// Outputs our elementor templates, unless we have the product archive running
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'product-archive' ) ) {

    do_action('waterfall_before_product_archive_header');
        
    /**
     * Displays the default header for WooCommerce Pages
     */
    $wf_shop = wf_get_view('shop');
    $wf_shop->header();
        
    do_action('waterfall_after_product_archive_header');

?>

<div class="main-content">

    <?php do_action('waterfall_before_product_archive_content_container'); ?>

    <?php if( $wf_shop->content_container ) { ?>
        <div class="components-container">    
    <?php } ?> 

        <?php
            do_action('waterfall_before_product_archive_posts');
        ?>         

        <div class="content">
            <?php
            
                /**
                * Displays the default post-loop from WooCommerce
                */
                $wf_shop->posts();
            ?>
        </div>

        <?php 
            do_action('waterfall_after_product_archive_posts');

            $wf_shop->sidebar();

            do_action('waterfall_after_product_archive_sidebar');
        ?>

    <?php if( $wf_shop->content_container ) { ?>
        </div>    
    <?php } ?>  

    <?php do_action('waterfall_after_product_archive_content_container'); ?>    
    
</div>

<?php

}

/**
 * Retrieves our footer
 */
wf_get_theme_footer(); ?>