<?php 
    /**
     * Displays the archive page 
     *
     * Retrieves our header
     */
    get_theme_header(); 

    // Build the header for our archive page 
    waterfall_archive_title();

?>

<div class="entry-archive">
    <div class="container">
        <?php
        
            global $wp_query;

            // Build the overview with posts
            waterfall_posts( array(
                'image'         => array( 'link' => 'post', 'size' => 'medium'),
                'postsAppear'   => 'bottom',
                'postsGrid'     => 'third',
                'view'          => 'grid',
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