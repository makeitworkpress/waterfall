<?php
/**
 * View: Default Template for Events
 */
wf_get_theme_header(); 

$wf_events = wf_get_view('events'); ?>

<div class="main-content singular-content events-calendar-template">

    <?php do_action('waterfall_before_tribe_events_content_container'); ?>

    <?php if( $wf_events->content_container ) { ?>
        <div class="components-container">
    <?php } ?> 

        <?php do_action('waterfall_before_tribe_events_content'); ?>

        <div class="entry-content content">
            <?php $wf_events->content(); ?>
        </div>

        <?php do_action('waterfall_after_tribe_events_content'); ?>

    <?php if( $wf_events->content_container ) { ?>
        </div>
     <?php } ?>   

     <?php do_action('waterfall_after_tribe_events_content_container'); ?>   

</div>

<?php wf_get_theme_footer(); ?>