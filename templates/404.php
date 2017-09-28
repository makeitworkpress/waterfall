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

        /**
         * Initializes our 404 page
         */
        $nothing = new Views\Nothing('404');
        
        do_action('waterfall_before_404_header');
    
        $nothing->header();
    
        do_action('waterfall_after_404_header');
    
    ?>

</article>

<?php 
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>