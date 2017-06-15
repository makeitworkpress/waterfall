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
            do_action('waterfall_before_post_header');
    
            waterfall_content_header();
    
            do_action('waterfall_before_post_content');
    
            // The content of our post
            waterfall_content();
    
            do_action('waterfall_before_post_related');
    
            // Related posts
            waterfall_related(); 
    
            do_action('waterfall_before_post_footer');
        
            // The footer of our post
            waterfall_content_footer(); 
    
            do_action('waterfall_after_post_footer');

        ?>

    </article>

    <?php } 

/**
 * Retrieves our footer
 */
get_theme_footer(); 
