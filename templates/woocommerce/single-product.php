<?php
/**
 * Displays a single woocommerce product
 *
 * Retrieves our header
 */
wf_get_theme_header(); 

$wf_product = wf_get_view('product');

// Outputs our elementor templates, unless we have the product archive running
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'product' ) ) { ?>

    <div class="main-content product-content">

        <?php do_action('waterfall_before_product_breadcrumbs'); ?> 

        <?php if( $wf_product->breadcrumbs() ) { ?>
            <div class="components-container"><?php echo $wf_product->breadcrumbs(); ?></div>
        <?php } ?>

        <?php do_action('waterfall_before_product_content_container'); ?> 

        <?php if( $wf_product->content_container ) { ?>
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
                    $wf_product->content();                                  
                ?>
        
            </div> 

            <?php
                do_action('waterfall_after_product_content');

                $wf_product->sidebar();

                do_action('waterfall_after_product_sidebar');
            ?>

        <?php if( $wf_product->content_container ) { ?>
            </div>
        <?php } ?>

        <?php do_action('waterfall_after_product_content_container'); ?> 

    </div>

<?php }
/**
 * Retrieves our footer
 */
wf_get_theme_footer(); 