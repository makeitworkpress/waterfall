<?php
/**
 * View: Default Template for Events
 */
wf_get_theme_header(); 

$events = new Views\Vendor\Events(); ?>

<div class="main-content singular-content events-calendar-template">

    <?php do_action('waterfall_before_tribe_events_content_container'); ?>

    <?php if( $events->contentContainer ) { ?>
        <div class="components-container">
    <?php } ?> 

        <?php do_action('waterfall_before_tribe_events_content'); ?>

        <div class="entry-content content">
            <?php $events->content(); ?>
        </div>

        <?php do_action('waterfall_after_tribe_events_content'); ?>

    <?php if( $events->contentContainer ) { ?>
        </div>
     <?php } ?>   

     <?php do_action('waterfall_after_tribe_events_content_container'); ?>   

</div>

<?php wf_get_theme_footer(); ?>