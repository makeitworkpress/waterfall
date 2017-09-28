<?php 
    /**
     * Displays the search page 
     *
     * Retrieves our header
     */
    get_theme_header();

    // Initializes our search
    $search = new Views\Index('search');
    
    // Build the header for our search page
    do_action('waterfall_before_search_header');

    $search->header();

    do_action('waterfall_after_search_header');

?>

<div class="main-content">

    <?php if( $search->contentContainer ) { ?>
        <div class="components-container">    
    <?php } ?>

        <?php

            do_action('waterfall_before_search_posts');

            // Displays the grid with our posts
            $search->posts();

            do_action('waterfall_after_search_posts');

            // Displays our optional sidebar
            $search->sidebar();

            do_action('waterfall_after_search_sidebar');

        ?>

    <?php if( $search->contentContainer ) { ?>
        </div>    
    <?php } ?>    

</div>

<?php

    /**
     * Retrieves our footer
     */
    get_theme_footer(); 

?>