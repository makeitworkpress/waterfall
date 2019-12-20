<?php 
    /**
     * Displays the archive page 
     *
     * Retrieves our header
     */
    wf_get_theme_header();

    // Outputs our elementor templates, unless we have the archive running
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

        // Displays the archive
        $archive = new Views\Index('archive');

        do_action('waterfall_before_archive_header');
        
        // Build the header for the archive
        $archive->header();
            
        do_action('waterfall_after_archive_header');

    ?>

    <div class="main-content archive-content">

        <?php do_action('waterfall_before_archive_content_container'); ?>

        <?php if( $archive->contentContainer ) { ?>
            <div class="components-container">    
        <?php } ?>

            <?php

                do_action('waterfall_before_archive_posts');

                // Displays the grid with our posts
                $archive->posts();

                do_action('waterfall_after_archive_posts');

                // Displays our optional sidebar
                $archive->sidebar();

                do_action('waterfall_after_archive_sidebar');

            ?>

        <?php if( $archive->contentContainer ) { ?>
            </div>    
        <?php } ?>

        <?php do_action('waterfall_after_archive_content_container'); ?>

    </div>

    <?php do_action('waterfall_after_archive_main_content'); ?>

<?php 

    }

    /**
     * Retrieves our footer
     */
    wf_get_theme_footer(); 
?>