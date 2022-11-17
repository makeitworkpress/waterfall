<?php
/**
 * View: Default Template for bbPress
 */
wf_get_theme_header();

$wf_bbpress = wf_get_view('bbpress');

while( have_posts() ) {
        
    the_post();  ?> 

<article <?php post_class(); ?>>

    <?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { ?>

        <?php do_action('waterfall_before_bbpress_header'); ?>
        
        <?php $wf_bbpress->header(); ?>
            
        <?php do_action('waterfall_after_bbpress_header'); ?>

        <div class="main-content singular-content bbpress-template">

            <?php do_action('waterfall_before_bbpress_content_container'); ?>

            <?php if( $wf_bbpress->content_container ) { ?>
                <div class="components-container">
            <?php } ?> 

                <?php if( ! $wf_bbpress->isPrivate() ) { ?> 

                    <?php do_action('waterfall_before_bbpress_content'); ?>

                    <div class="entry-content content">
                            <?php the_content(); ?>
                    </div>

                    <?php do_action('waterfall_after_bbpress_content'); ?>

                    <?php $wf_bbpress->sidebar(); ?>

                <?php } else { ?>

                    <?php $wf_bbpress->notifyPrivate(); ?>

                <?php } ?>  

            <?php if( $wf_bbpress->content_container ) { ?>
                </div>
            <?php } ?>

            <?php do_action('waterfall_after_bbpress_content_container'); ?>  

        </div>

        <?php do_action('waterfall_after_bbpress_main_content'); ?> 

    <?php } ?> 

</article>

<?php } 
    wf_get_theme_footer();
?>