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

    <article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
        
        <?php
            // The header of our article
            waterfall_content_header();
    
            // The content of our container
            waterfall_content(); 

        ?>

    </article>

    <?php }
        
/**
 * Retrieves our footer
 */
get_theme_footer(); ?>