<?php 
/**
 * Displays the a single post
 *
 * Retrieves our header
 */
get_theme_header(); 

// Start our loop
while( have_posts() ) {
        
    the_post(); ?>

    <article <?php post_class(); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/Blogposting">
        
        <?php
            // The header of our article
            waterfall_content_header();
    
            // The content of our post
            waterfall_content();
    
            // Related posts
            waterfall_related(); 
        
            // The footer of our post
            waterfall_content_footer(); 

        ?>

    </article>

    <?php } 

/**
 * Retrieves our footer
 */
get_theme_footer(); 
