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
            
            do_action('waterfall_before_page_header');
            
            // The header of our article
            waterfall_content_header();
    
            do_action('waterfall_before_page_content');
    
            // The content of our container
            waterfall_content(); 
    
            do_action('waterfall_after_page_content');

        ?>

    </article>

    <?php }
        
/**
 * Retrieves our footer
 */
get_theme_footer(); ?>