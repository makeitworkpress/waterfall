<?php
/**
 * Displays a single woocommerce product
 *
 * Retrieves our header
 */
wf_get_theme_header(); 

// Outputs our elementor templates, unless we have the product archive running
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'product-archive' ) ) {    

    // Initialize our shop archive
    $shop = new Views\Shop('product_archive');

    do_action('waterfall_before_product_archive_header');
        
    /**
     * Displays the default header for WooCommerce Pages
     */
    $shop->header();
        
    do_action('waterfall_after_product_archive_header');

?>

<div class="main-content">

    <?php do_action('waterfall_before_product_archive_content_container'); ?>

    <?php if( $shop->contentContainer ) { ?>
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
                $shop->posts();
            ?>
        </div>

        <?php 
            do_action('waterfall_after_product_archive_posts');

            $shop->sidebar();

            do_action('waterfall_after_product_archive_sidebar');
        ?>

    <?php if( $shop->contentContainer ) { ?>
        </div>    
    <?php } ?>  

    <?php do_action('waterfall_after_product_archive_content_container'); ?>    
    
</div>

<?php

}

/**
 * Retrieves our footer
 */
wf_get_theme_footer(); 
?>