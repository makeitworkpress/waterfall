<?php
/**
 * View: Default Template for bbPress
 */
wf_get_theme_header();

$bbPress = new Views\Vendor\bbPress();

while( have_posts() ) {
        
    the_post();  ?> 

<article <?php post_class(); ?>>

    <?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) { ?>

        <?php do_action('waterfall_before_bbpress_header'); ?>
        
        <?php $bbPress->header(); ?>
            
        <?php do_action('waterfall_after_bbpress_header'); ?>

        <div class="main-content singular-content bbpress-template">

            <?php do_action('waterfall_before_bbpress_content_container'); ?>

            <?php if( $bbPress->contentContainer ) { ?>
                <div class="components-container">
            <?php } ?> 

                <?php if( ! $bbPress->isPrivate() ) { ?> 

                    <?php do_action('waterfall_before_bbpress_content'); ?>

                    <div class="entry-content content">
                            <?php the_content(); ?>
                    </div>

                    <?php do_action('waterfall_after_bbpress_content'); ?>

                    <?php $bbPress->sidebar(); ?>

                <?php } else { ?>

                    <?php $bbPress->notifyPrivate(); ?>

                <?php } ?>  

            <?php if( $bbPress->contentContainer ) { ?>
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