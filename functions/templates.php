<?php
/**
 * Main templating functions
 * To primary purpose of these templating functions is to clean up the template
 */

/**
 * Renders the header elements
 */
function waterfall_header_elements() {
    
    $disable = is_singular() ? get_theme_option('meta', 'disable_header') : '';
    $disable = $disable ? $disable : array('disable' => false);
    $transparent = is_singular() ? get_theme_option('meta', 'transparent_header') : '';

    // Our header is only shown if enabled
    if( ! $disable['disable'] ) {

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
                    'rounded'   => true,
                    'float'     => get_theme_option('customizer', 'header_menu_float'),
                    'urls'      => $urls
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
    
}

/**
 * Renders the footer elements
 */
function waterfall_footer_elements() {
    
    /**
     * Retrieves and displays our footer
     */
    $disable = is_singular() ? get_theme_option('meta', 'disable_footer') : '';
    $disable = $disable ? $disable : array('disable' => false);

    if( ! $disable['disable'] ) {

        $atoms          = array();
        $container      = get_theme_option('customizer', 'footer_width');
        $copyright      = get_theme_option('customizer', 'footer_copyright');
        $logo           = get_theme_option('customizer', 'footer_logo');
        $menu           = get_theme_option('customizer', 'footer_menu');
        $sidebarGrid    = get_theme_option('customizer', 'footer_sidebars');
        $social         = get_theme_option('customizer', 'footer_social');

        switch( $sidebarGrid ) {
            case 'full':
                $sidebars = array('footer-one' => 'full');
                break;
            case 'half':
                $sidebars = array('footer-one' => 'half', 'footer-two' => 'half');
                break;
            case 'third':
                $sidebars = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
                break;
            case 'fourth':
                $sidebars = array('footer-one' => 'fourth', 'footer-two' => 'fourth', 'footer-three' => 'fourth', 'footer-four' => 'fourth');
                break;
            case 'fifth':
                $sidebars = array('footer-one' => 'fifth', 'footer-two' => 'fifth', 'footer-three' => 'fifth', 'footer-four' => 'fifth', 'footer-five' => 'fifth');
                break;
            default:
                $sidebars = array();
        }

        // Copyright Message
        if( $copyright ) {
            $atoms['copyright'] = array(
                'float'     => 'left',
                'name'      => get_theme_option('customizer', 'footer_copyright_name'),
                'schema'    => get_theme_option('customizer', 'footer_copyright_schema')
            );
        }

        // Logo
        if( $logo ) {

            $atoms['logo'] = array(
                'float'     => 'center',
                'image'     => $logo
            );
        }

        // Social Icons
        if( $social ) {

            $networks = get_theme_option('options', 'social_networks');

            if( $networks ) {

                foreach( $networks as $network ) {
                    $urls[$network['network']] = $network['url'];
                }

                $atoms['social'] = array(
                    'rounded'   => true,
                    'float'     => 'right',
                    'urls'      => $urls
                );

            }                
        }


        // Menu
        if( $menu ) {
            $atoms['menu'] = array(
                'args'          => array('theme_location' => 'footer-menu'), 
                'float'         => 'right',
                'hamburger'     => 'none' 
            );
        }

        // Build the footer! 
        WP_Components\Build::molecule( 'footer', array(
            'atoms'         => apply_filters('waterfall_footer_atoms', $atoms),
            'sidebars'      => $sidebars,
            'container'     => $container == 'container' ? true : false,
            'style'         => 'footer'
        ) );

    }
    
}

/**
 * Renders the archive titles
 */
function waterfall_archive_title() {
    WP_Components\Build::molecule( 'post-header', array(
        'atoms' => array('archive-title' => array()),
        'style' => 'entry-archive-header'
    ) );    
}

/**
 * Renders the posts grid
 * 
 * @param array $args The array with arguments to display posts, resembling the posts molecule arguments from vendor/wp-components/molecules
 */
function waterfall_posts( $args = array() ) {
    
    WP_Components\Build::molecule( 'posts', $args );    
    
}

/**
 * Renders the header for content
 * 
 * @param array $args The array with arguments to display header content, resembling the posts-header molecule arguments from vendor/wp-components/molecules
 */
function waterfall_content_header( $args = array() ) {
    
}