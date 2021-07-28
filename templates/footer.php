<?php
/**
 * Displays the footer of the page
 */
?>      
                <?php do_action('waterfall_main_content_end'); ?>

            </main>
            
            <?php

                do_action('waterfall_before_footer');
                
                // Echoes the footer elements.
                $wf_footer = $GLOBALS['wf_footer'];
                $wf_footer->footer();

                do_action('waterfall_after_footer');

            ?>

        </div><!-- .wrapper -->

		<?php wp_footer(); ?>

    </body>
</html>     