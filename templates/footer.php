<?php
/**
 * Displays the footer of the page
 */
?>      
        </main>
        
        <?php
            /**
             * Retrieves and displays our footer
             */
            $atoms          = array();
            $container      = get_theme_option('customizer', 'footer_width');
            $copyright      = get_theme_option('customizer', 'footer_copyright');
            $logo           = get_theme_option('customizer', 'footer_logo');
            $menu           = get_theme_option('customizer', 'footer_menu');
            $sidebarGrid    = get_theme_option('customizer', 'footer_sidebars');
            $social         = get_theme_option('customizer', 'footer_social');

            switch( $sidebarGrid ) {
                case 'full':
                    $sidebars = array('full' => 'sidebar-one');
                    break;
                case 'half':
                    $sidebars = array('half' => 'sidebar-one', 'half' => 'sidebar-two');
                    break;
                case 'third':
                    $sidebars = array('third' => 'sidebar-one', 'third' => 'sidebar-two', 'third' => 'sidebar-three');
                    break;
                case 'fourth':
                    $sidebars = array('fourth' => 'sidebar-one', 'fourth' => 'sidebar-two', 'fourth' => 'sidebar-three', 'fourth' => 'sidebar-four');
                    break;
                case 'fifth':
                    $sidebars = array('fifth' => 'sidebar-one', 'fifth' => 'sidebar-two', 'fifth' => 'sidebar-three', 'fifth' => 'sidebar-four', 'fifth' => 'sidebar-five');
                    break;
                default:
                    $sidebars = array();
            }

            // Logo
            if( $logo ) {
                
                $atoms['logo'] = array(
                    'float'     => 'left',
                    'image'     => $logo
                );
            }

            // Copyright Message
            if( $copyright ) {
                $atoms['copyright'] = array(
                    'float'     => 'left',
                    'name'      => get_theme_option('customizer', 'footer_copyright_name'),
                    'schema'    => get_theme_option('customizer', 'footer_copyright_schema')
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
                        'float' => 'right',
                        'urls'  => $urls
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

        ?>

		<?php wp_footer(); ?>
    </body>
</html>     