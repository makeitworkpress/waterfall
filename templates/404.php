<?php 
    /**
     * Displays the 404 page 
     *
     * Retrieves our header
     */
    get_theme_header(); 
?>

<article class="waterfall-nothing-found">

    <?php
        $args = apply_filters( 'waterfall_404_header_args', array(
            'atoms' => array( 
                'title' => array('tag' => 'h1', 'title' => __('Woops! Nothing found here...', 'waterfall')), 
                'description' => array('description' => __('Try visiting another page or searching.', 'waterfall')), 
                'search' => array() 
            ),
            'height' => 'normal',
            'style' => 'main-header'
        ) );
        WP_Components\Build::molecule( 'post-header', $args );
    ?>

</article>

<?php 
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>