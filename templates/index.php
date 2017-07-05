<?php 
    /**
     * Displays the archive page 
     *
     * Retrieves our header
     */
    get_theme_header(); 

    do_action('waterfall_before_archive_header');
      
    // Build the header for the archive
    waterfall_archive_header();
        
    do_action('waterfall_after_archive_header');

?>

<div class="main-content">
    
    <?php
    
        do_action('waterfall_before_archive_posts');

        // Build the overview with posts
        waterfall_archive_posts();

        do_action('waterfall_after_archive_posts');
    
    ?>

</div>

<?php 
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>