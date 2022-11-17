<?php 
    /**
     * Displays the 404 page 
     *
     * Retrieves our header
     */
    wf_get_theme_header(); 
?>

<article class="waterfall-nothing-found">

    <?php

        /**
         * Initializes our 404 page with support for custom pages by elementor
         */
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
            
            do_action('waterfall_before_404_header');
        
            $wf_nothing = wf_get_view('404');
            $wf_nothing->header();
        
            do_action('waterfall_after_404_header');

        }
    
    ?>

</article>

<?php 
    /**
     * Retrieves our footer
     */
    wf_get_theme_footer(); 
?>