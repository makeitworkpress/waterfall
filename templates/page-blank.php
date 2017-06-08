<?php
    /**
     * Template Name: Empty Page
     * This is an empty and blank page, only showing its content
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
            /**
             * The loop for the current page
             */
            while ( have_posts() ) { 
                the_post();
                the_content();
            }
        ?>

		<?php wp_footer(); ?>
    </body>
</html>    