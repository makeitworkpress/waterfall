<?php 
    /**
     * Displays the search page 
     *
     * Retrieves our header
     */
    wf_get_theme_header();

    // Outputs our elementor templates, unless we have the search archive running
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {    
        
        // Build the header for our search page
        do_action('waterfall_before_search_header');

        $wf_archive = wf_get_view('archive');
        $wf_archive->header();

        do_action('waterfall_after_search_header');

    ?>

    <div class="main-content">

        <?php do_action('waterfall_before_search_content_container'); ?>

        <?php if( $wf_archive->content_container ) { ?>
            <div class="components-container">    
        <?php } ?>

            <?php

                do_action('waterfall_before_search_posts');

                // Displays the grid with our posts
                $wf_archive->posts();

                do_action('waterfall_after_search_posts');

                // Displays our optional sidebar
                $wf_archive->sidebar();

                do_action('waterfall_after_search_sidebar');

            ?>

        <?php if( $wf_archive->content_container ) { ?>
            </div>    
        <?php } ?>

        <?php do_action('waterfall_after_search_content_container'); ?>    

    </div>

    <?php do_action('waterfall_after_search_main_content'); ?>

    <?php }

    /**
     * Retrieves our footer
     */
    wf_get_theme_footer(); 

?>