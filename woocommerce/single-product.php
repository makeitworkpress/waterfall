<?php
/**
 * Displays a single woocommerce product
 *
 * Retrieves our header
 */
get_theme_header(); 

do_action('waterfall_before_single_product');

waterfall_single_product();

do_action('waterfall_after_single_product');


/**
 * Retrieves our footer
 */
get_theme_footer(); 