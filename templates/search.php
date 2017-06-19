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

<div class="main-content">
    <?php

        do_action('waterfall_before_search_results');

        // Build the overview with posts
        waterfall_archive_posts();

        do_action('waterfall_after_search_results');

    ?>
</div>

<?php

    /**
     * Retrieves our footer
     */
    get_theme_footer(); 

?>