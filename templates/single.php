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

    <article <?php post_class(); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

        <?php

            // Initialize our post
            $single = new Views\Singular( 'post' );
            $single->structuredData();

            // The header of our article
            do_action('waterfall_before_' . $single->type . '_header');
    
            $single->header();
    
            do_action('waterfall_before_' . $single->type . '_content');

        ?>

        <div class="main-content">

            <?php
                do_action('waterfall_' . $single->type . '_main_content_begin');
            ?>
        
            <?php if( $single->contentContainer ) { ?>
                <div class="components-container">    
            <?php } ?>            

            <?php 

                do_action('waterfall_before_' . $single->type . '_content');

                // The content of our post
                single->content();

                do_action('waterfall_after_' . $single->type . '_content');

                // The sidebar
                single->sidebar();

                do_action('waterfall_after_' . $single->type . '_sidebar');

            ?>

            <?php if( $single->contentContainer ) { ?>
                </div>    
            <?php } ?>
            
            <?php
                do_action('waterfall_' . $single->type . '_main_content_end');
            ?>
            
        </div>

        <?php

            if( $single->relatedSection ) {
    
            do_action('waterfall_before_' . $single->type . '_related');
    
            // Related posts
            single->related();

            }
    
            do_action('waterfall_before_' . $single->type . '_footer');
        
            // The footer of our post
            single->footer();
    
            do_action('waterfall_after_' . $single->type . '_footer');

        ?>

    </article>

    <?php } 

/**
 * Retrieves our footer
 */
get_theme_footer(); 