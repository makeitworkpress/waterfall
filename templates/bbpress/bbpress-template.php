<?php
/**
 * View: Default Template for bbPress
 */
wf_get_theme_header();

$bb_press = new Views\Vendor\bbPress();

while( have_posts() ) {
        
    the_post();  ?> 

<article <?php post_class(); ?>>

    <?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { ?>

        <?php do_action('waterfall_before_bbpress_header'); ?>
        
        <?php $bb_press->header(); ?>
            
        <?php do_action('waterfall_after_bbpress_header'); ?>

        <div class="main-content singular-content bbpress-template">

            <?php do_action('waterfall_before_bbpress_content_container'); ?>

            <?php if( $bb_press->content_container ) { ?>
                <div class="components-container">
            <?php } ?> 

                <?php if( ! $bb_press->isPrivate() ) { ?> 

                    <?php do_action('waterfall_before_bbpress_content'); ?>

                    <div class="entry-content content">
                            <?php the_content(); ?>
                    </div>

                    <?php do_action('waterfall_after_bbpress_content'); ?>

                    <?php $bb_press->sidebar(); ?>

                <?php } else { ?>

                    <?php $bb_press->notifyPrivate(); ?>

                <?php } ?>  

            <?php if( $bb_press->content_container ) { ?>
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