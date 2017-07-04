<?php
    /**
     * Displays a single woocommerce product
     *
     * Retrieves our header
     */
    get_theme_header(); 

    do_action('waterfall_before_product_archive_header');
        
    /**
     * Displays the default header for WooCommerce Pages
     */
    waterfall_product_archive_header();
        
    do_action('waterfall_after_product_archive_header');

?>

<div class="main-content">

    <?php
        
        do_action('waterfall_before_product_archive_posts');
    
        /**
         * Displays the default post-loop from WooCommerce
         */
        waterfall_product_archive_posts();

        do_action('waterfall_after_product_archive_posts');
    ?>
    
</div>

<?php
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>