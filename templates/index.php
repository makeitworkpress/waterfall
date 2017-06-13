<?php 
    /**
     * Displays the archive page 
     *
     * Retrieves our header
     */
    get_theme_header(); 

        
    $grid = get_theme_option( 'customizer', 'archives_grid' ) ? get_theme_option( 'customizer', 'archives_grid' ) : 'third';
    $sidebar = get_theme_option( 'customizer', 'archives_layout' );
    $title = get_theme_option( 'customizer', 'archives_title' );
    $width = get_theme_option( 'customizer', 'archives_width' );

    // Build the header for our archive page 
    if( $title ) {
        waterfall_archive_title();
    }

?>

<div class="entry-archive">
    <?php if($width != 'full') { ?>
        <div class="container">
    <?php } 
        
        global $wp_query;

        // Build the overview with posts
        waterfall_posts( array(
            'image'         => array( 'link' => 'post', 'size' => 'medium'),
            'postsAppear'   => 'bottom',
            'postsGrid'     => $grid,
            'view'          => 'grid',
            'query'         => $wp_query
        ) );
    
        // Sidebars
        if( $sidebar == 'left' || $sidebar == 'right' )
            WP_Components/Build::molecule( 'sidebar', array('sidebars' => array('archive')) );

    if($width != 'full') { ?>
        </div>
    <?php } ?>
</div>

<?php 
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>