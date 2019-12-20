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
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />

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

            /**
             * Displays our header elements, unless we have a custom header from elementor
             */ 
            if( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
                $header = new Views\Header();
                $header->header();
            }
        
            do_action('waterfall_after_header');
        
        ?>

        <main class="main" itemscope="itemscope" itemtype="<?php echo wf_get_main_schema(); ?>">
            
            <?php do_action('waterfall_main_content_begin'); ?>