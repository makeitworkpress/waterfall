<?php
/**
 * Displays a single woocommerce product
 *
 * Retrieves our header
 */
get_theme_header(); 

/**
 * Initiate our new product
 */
$productView = new Views\Product('product'); ?>

<div class="main-content product-content">

    <?php if( $productView->breadcrumbs() ) { ?>
        <div class="components-container"><?php echo $productView->breadcrumbs(); ?></div>
    <?php } ?>

    <?php if( $productView->contentContainer ) { ?>
        <div class="components-container">
    <?php } ?>

        <?php
            do_action('waterfall_before_product_content');
        ?>

        <div class="content">

            <?php      
                /**
                * Retrieves the loop for the single product from woocommerce
                */
                $productView->content();                                  
            ?>
    
        </div> 

        <?php
            do_action('waterfall_after_product_content');

            $productView->sidebar();

            do_action('waterfall_after_product_sidebar');
        ?>

    <?php if( $productView->contentContainer ) { ?>
        </div>
    <?php } ?>

</div>

<?php 
/**
 * Retrieves our footer
 */
get_theme_footer(); 