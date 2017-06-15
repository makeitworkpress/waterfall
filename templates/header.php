<?php
/** 
 * Displays the header for each template
 * We still use this structure because most theme-authors are used to this
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
        <link href="//www.google-analytics.com" rel="dns-prefetch">

		<?php 
            /**
             * Adds the wp_head action hook to the header
             */
            wp_head(); 
        ?>

	</head>
	<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://www.schema.org/WebPage">
        
        <?php
        
            do_action('waterfall_before_header');
        
            // Echoes the header elements. Can be found in functions/templates.php. 
            waterfall_header_elements();
        
            do_action('waterfall_after_header');
        
        ?>

        <main class="content" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="<?php echo get_main_schema(); ?>">
   