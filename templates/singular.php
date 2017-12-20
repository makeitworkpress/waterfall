<?php 
/**
 * Displays the a single post
 *
 * Retrieves our header
 */
get_theme_header(); 

// Start our loop
while( have_posts() ) {
        
    the_post(); 

    // Initialize our post
    $postView = new Views\Singular('singular'); ?>

    <article <?php post_class(); ?> <?php echo $postView->scheme; ?>>

        <?php

            $postView->structuredData();

            // The header of our article
            do_action('waterfall_before_' . $postView->type . '_header');
    
            $postView->header();
    
            do_action('waterfall_after_' . $postView->type . '_header');

        ?>

        <div class="main-content">

            <?php do_action('waterfall_before_' . $postView->type . '_content_container'); ?>
        
            <?php if( $postView->contentContainer ) { ?>
                <div class="components-container">    
            <?php } ?>            

                <?php 

                    do_action('waterfall_before_' . $postView->type . '_content');

                    // The content of our post
                    $postView->content();

                    do_action('waterfall_after_' . $postView->type . '_content');

                    // The sidebar
                    $postView->sidebar();

                    do_action('waterfall_after_' . $postView->type . '_sidebar');

                ?>

            <?php if( $postView->contentContainer ) { ?>
                </div>    
            <?php } ?>

            <?php do_action('waterfall_after_' . $postView->type . '_content_container'); ?>
            
        </div>

        <?php
            do_action('waterfall_after_' . $postView->type . '_main_content');
        ?>        

        <?php
            /**
             * This section shows the related sections
             */
            if( $postView->relatedSection ) {
        ?>
            
            <aside class="main-related">

                <?php if( $postView->relatedContainer ) { ?>
                    <div class="components-container">
                <?php } ?>

                <?php
        
                    do_action('waterfall_before_' . $postView->type . '_related');
            
                    // Related posts
                    $postView->related();

                    do_action('waterfall_after_' . $postView->type . '_related');

                ?>

                <?php if( $postView->relatedContainer ) { ?>
                    </div>
                <?php } ?>

            </aside>           

        <?php

            }
    
            do_action('waterfall_before_' . $postView->type . '_footer');
        
            // The footer of our post
            $postView->footer();
    
            do_action('waterfall_after_' . $postView->type . '_footer');

        ?>

    </article>

<?php } 

/**
 * Retrieves our footer
 */
get_theme_footer(); 