<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

wf_get_theme_header(); ?>

<div class="main-content singular-content events-calendar-template">

    <div class="components-container">

        <div class="content entry-content">

            <?php echo tribe( Template_Bootstrap::class )->get_view_html(); ?>

        </div>

    </div>

</div>

<?php wf_get_theme_footer(); ?>