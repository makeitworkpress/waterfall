<?php
/**
 * View: Default Template for Events
 * @version 5.0.0
 */
wf_get_theme_header(); 

$events = new Views\Events(); ?>

<div class="main-content singular-content events-calendar-template">

    <?php if( $events->contentContainer ) { ?>
        <div class="components-container">
    <?php } ?> 
    
        <div class="entry-content content">
            <?php $events->content(); ?>
        </div>

    <?php if( $events->contentContainer ) { ?>
        </div>
     <?php } ?>      

</div>

<?php wf_get_theme_footer(); ?>