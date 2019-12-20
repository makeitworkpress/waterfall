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
            
            $nothing = new Views\Nothing('404');
            
            do_action('waterfall_before_404_header');
        
            $nothing->header();
        
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