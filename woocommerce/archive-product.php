<?php
    /**
     * Displays a single woocommerce product
     *
     * Retrieves our header
     */
    get_theme_header(); 

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
    
</div>

<?php
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>