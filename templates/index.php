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
        
        do_action('waterfall_before_archive_header');
        
        waterfall_archive_header();
        
        do_action('waterfall_after_archive_header');
    }

?>

<div class="main-content">
    <?php if($width != 'full') { ?>
        <div class="components-container">
    <?php }
    
        do_action('waterfall_before_archive_posts');
        
        global $wp_query;

        // Build the overview with posts
        waterfall_posts( array(
            'image'         => array( 'link' => 'post', 'size' => 'medium', 'enlarge' => 'true'),
            'postsAppear'   => 'bottom',
            'postsGrid'     => $grid,
            'style'         => 'entry-archive',
            'view'          => 'grid',
            'query'         => $wp_query
        ) );
    
        // Sidebars
        if( $sidebar == 'left' || $sidebar == 'right' )
            WP_Components/Build::molecule( 'sidebar', array('sidebars' => array('archive'), 'style' => 'entry-sidebar') );
    
        do_action('waterfall_after_archive_posts');

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