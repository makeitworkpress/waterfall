<?php 
    /**
     * Displays the search page 
     *
     * Retrieves our header
     */
    get_theme_header();
    

    // Build the header for our search page
    do_action('waterfall_before_search_header');

    waterfall_archive_header();

    do_action('waterfall_after_search_header');

?>

<div class="entry-search-results">
    <div class="components-container">
        <?php
        
            global $wp_query;
        
            do_action('waterfall_before_search_form');
        
            WP_Components\Build::atom('search');
        
            do_action('waterfall_before_search_results');

            // Build the overview with posts
            waterfall_posts( array(
                'image'         => array( 'link' => 'post', 'size' => 'thumbnail', 'rounded' => true, 'enlarge' => true ),
                'postsAppear'   => 'bottom',
                'query'         => $wp_query,
            ) );
        
            do_action('waterfall_after_search_results');

        ?>
    </div>
</div>

<?php

    /**
     * Retrieves our footer
     */
    get_theme_footer(); 

?>