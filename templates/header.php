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
        
            /**
             * Display our main header
             */
            $disable = is_singular() ? get_theme_option('meta', 'disable_header') : '';
            $transparent = is_singular() ? get_theme_option('meta', 'transparent_header') : '';
        
            // Our header is only shown if enabled
            if( $disable['disable'] == false || ! isset($disable['disable']) ) {
        
                $logo = get_theme_option('customizer', 'logo');

                // Default header items
                $atoms = array(
                    'logo'  => array( 
                        'float'             => get_theme_option('customizer', 'header_logo_float'),
                        'image'             => $logo ? $logo : get_template_directory_uri() . '/assets/img/waterfall.png', 
                        'mobile'            => get_theme_option('customizer', 'logo_mobile'), 
                        'mobileTransparent' => get_theme_option('customizer', 'logo_mobile_transparent'), 
                        'transparent'       => get_theme_option('customizer', 'logo_transparent')
                    ),
                    'menu'  => array( 
                        'args'          => array('theme_location' => 'header-menu'), 
                        'float'         => get_theme_option('customizer', 'header_menu_float'),
                        'hamburger'     => get_theme_option('customizer', 'header_hamburger_menu') 
                    )                
                );

                
                // Social icons
                if( get_theme_option('customizer', 'header_social') ) {
                    
                    $networks = get_theme_option('options', 'social_networks');
                    
                    if( $networks ) {
                        
                        foreach( $networks as $network ) {
                            $urls[$network['network']] = $network['url'];
                        }

                        $atoms['social'] = array(
                            'float' => get_theme_option('customizer', 'header_menu_float'),
                            'urls'  => $urls
                        );
                        
                        // Reset the order for right floats
                        if( get_theme_option('customizer', 'header_menu_float') == 'right') {
                            $menu = $atoms['menu'];
                            unset($atoms['menu']);
                            $atoms['menu'] = $menu;
                        }
                        
                    }
                }
                
                $container = get_theme_option('customizer', 'header_width');

                // Build the header! 
                WP_Components\Build::molecule( 'header', array(
                    'atoms'         => apply_filters('waterfall_header_atoms', $atoms),
                    'container'     => $container == 'container' ? true : false,
                    'fixed'         => get_theme_option('customizer', 'header_fixed'),
                    'style'         => 'header',
                    'transparent'   => isset($transparent['transparent']) ? $transparent['transparent'] : false
                ) );
                
            }
        
        ?>

        <main class="content" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
   