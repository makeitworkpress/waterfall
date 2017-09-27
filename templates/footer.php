<?php
/**
 * Displays the footer of the page
 */
?>      
            <?php do_action('waterfall_main_content_end'); ?>

        </main>
        
        <?php

            do_action('waterfall_before_footer');
            
            // Echoes the footer elements. Can be found in functions/templates.php. 
            $footer = new Views\Footer();
            $footer->footer();

            do_action('waterfall_after_footer');

        ?>

		<?php wp_footer(); ?>
    </body>
</html>     