<?php 
/**
 * Displays the default page 
 *
 * Retrieves our header
 */
get_theme_header();


// Start our loop
while( have_posts() ) {
        
    the_post(); ?>

    <article <?php post_class(); ?> itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
        
        <?php

            // Initialize our page
            $pageView = new Views\Singular('page');
            
            do_action('waterfall_before_page_header');
            
            // The header of our article
            $pageView->header();

            do_action('waterfall_after_page_header');

        ?>       
       
        <div class="main-content">

            <?php do_action('waterfall_before_page_content_container'); ?>

            <?php if( $pageView->contentContainer ) { ?>
                <div class="components-container">    
            <?php } ?>

                <?php
        
                    do_action('waterfall_before_page_content');
            
                    $pageView->content(); 
            
                    do_action('waterfall_after_page_content');

                    $pageView->sidebar();

                    do_action('waterfall_after_page_sidebar');

                ?>            

            <?php if( $pageView->contentContainer ) { ?>
                </div>    
            <?php } ?>

            <?php do_action('waterfall_after_page_content_container'); ?>

        </div>

        <?php
            do_action('waterfall_after_page_main_content');
        ?>        

    </article>

    <?php }
        
/**
 * Retrieves our footer
 */
get_theme_footer(); ?>