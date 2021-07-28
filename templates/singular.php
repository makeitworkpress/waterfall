<?php 
/**
 * Displays the a single post
 *
 * Retrieves our header
 */
wf_get_theme_header();

// Retrieve our singular instance
$wf_singular = $GLOBALS['wf_singular'];

// Start our loop
while( have_posts() ) {
        
    the_post(); ?>

    <article class="<?php echo $wf_singular->post_class; ?>" <?php echo $wf_singular->schema; ?>>

        <?php

            $wf_singular->structured_data();

            if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {  

                // The header of our article
                do_action('waterfall_before_' . $wf_singular->type . '_header');
        
                $wf_singular->header();
        
                do_action('waterfall_after_' . $wf_singular->type . '_header');

            ?>

            <div class="main-content singular-content">

                <?php do_action('waterfall_before_' . $wf_singular->type . '_content_container'); ?>
            
                <?php if( $wf_singular->content_container ) { ?>
                    <div class="components-container">    
                <?php } ?>            

                    <?php

                        do_action('waterfall_before_' . $wf_singular->type . '_content');

                        // The content of our post
                        $wf_singular->content();

                        do_action('waterfall_after_' . $wf_singular->type . '_content');

                        // The sidebar
                        $wf_singular->sidebar();

                        do_action('waterfall_after_' . $wf_singular->type . '_sidebar');

                    ?>

                <?php if( $wf_singular->content_container ) { ?>
                    </div>    
                <?php } ?>

                <?php do_action('waterfall_after_' . $wf_singular->type . '_content_container'); ?>
                
            </div>

            <?php
                do_action('waterfall_after_' . $wf_singular->type . '_main_content');
            ?>        

            <?php
                /**
                 * This section shows the related sections
                 */
                if( $wf_singular->related_section ) {
            ?>
                
                <aside class="main-related singular-related">

                    <?php if( $wf_singular->related_container ) { ?>
                        <div class="components-container">
                    <?php } ?>

                    <?php
            
                        do_action('waterfall_before_' . $wf_singular->type . '_related');
                
                        // Related posts
                        $wf_singular->related();

                        do_action('waterfall_after_' . $wf_singular->type . '_related');

                    ?>

                    <?php if( $wf_singular->related_container ) { ?>
                        </div>
                    <?php } ?>

                </aside>           

            <?php

                }
        
                do_action('waterfall_before_' . $wf_singular->type . '_footer');
            
                // The footer of our post
                $wf_singular->footer();
        
                do_action('waterfall_after_' . $wf_singular->type . '_footer');

            }

        ?>

    </article>

<?php } 

/**
 * Retrieves our footer
 */
wf_get_theme_footer(); 