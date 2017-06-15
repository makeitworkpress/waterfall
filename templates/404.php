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
        
        do_action('waterfall_before_404_header');
    
        waterfall_404_header();
    
        do_action('waterfall_after_404_header');
    
    ?>

</article>

<?php 
    /**
     * Retrieves our footer
     */
    get_theme_footer(); 
?>