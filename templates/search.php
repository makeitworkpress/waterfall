<?php 
    /**
     * Displays the search page 
     *
     * Retrieves our header
     */
    get_theme_header(); 
    

    // Build the header for our search page 
    waterfall_archive_title();

?>

<div class="entry-search-results">
    <div class="container">
        <?php
        
            global $wp_query;
        
            WP_Components\Build::atom('search');

            // Build the overview with posts
            waterfall_posts( array(
                'image'         => array( 'link' => 'post', 'size' => 'thumbnail', 'rounded' => true, 'enlarge' => true ),
                'postsAppear'   => 'bottom',
                'query'         => $wp_query,
            ) );

        ?>
    </div>
</div>

<?php

    /**
     * Retrieves our footer
     */
    get_theme_footer(); 

?>