<?php
/**
 * Contains the class for initiating a new site footer
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Footer extends Base {

    /**
     * Sets the properties for the footer
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_footer_properties', array(
            'customizer'    => array(
                'footer_logo', 
            ),
            'layout' => array( 
                'footer_copyright', 
                'footer_copyright_name', 
                'footer_copyright_schema', 
                'footer_display_sidebars', 
                'footer_display_socket', 
                'footer_menu', 
                'footer_sidebars', 
                'footer_social', 
                'footer_social_background', 
                'footer_width' 
            ),                                    
        ) );

    }

    /**
     * Displays the header
     */
    public function footer() {

        // Return if the footer is disabled
        if( $this->disabled('footer', '') ) {
            return;
        }

        // Retrieve our footer properties from the DB
        $this->getProperties();   

        /**
         * Set-up our atoms for the footer
         */
        $atoms = array();

        // Sidebars
        switch( $this->layout['footer_sidebars'] ) {
            case 'full':
                $sidebarGrid = array('footer-one' => 'components-full-grid');
                break;
            case 'half':
                $sidebarGrid = array('footer-one' => 'components-half-grid', 'footer-two' => 'components-half-grid');
                break;
            case 'third':
                $sidebarGrid = array('footer-one' => 'components-third-grid', 'footer-two' => 'components-third-grid', 'footer-three' => 'components-third-grid');
                break;
            case 'fourth':
                $sidebarGrid = array('footer-one' => 'components-fourth-grid', 'footer-two' => 'components-fourth-grid', 'footer-three' => 'components-fourth-grid', 'footer-four' => 'components-fourth-grid');
                break;
            case 'fifth':
                $sidebarGrid = array('footer-one' => 'components-fifth-grid', 'footer-two' => 'components-fifth-grid', 'footer-three' => 'components-fifth-grid', 'footer-four' => 'components-fifth-grid', 'footer-five' => 'components-fifth-grid');
                break;
            default:
                $sidebarGrid = array('footer-one' => 'components-third-grid', 'footer-two' => 'components-third-grid', 'footer-three' => 'components-third-grid');
        }

        // We do not have sidebars
        if( $this->layout['footer_display_sidebars'] == false ) {
            $sidebarGrid = array();
        }

        // Logo
        if( is_numeric($this->customizer['footer_logo']) ) {
            $logo = wp_get_attachment_image_src( $this->customizer['footer_logo'], 'medium' );
            $atoms['logo'] = array(
                'atom'       => 'logo',
                'properties' => array(
                    'float'         => 'center',
                    'default'       => ['src' => $logo[0], 'height' => $logo[2], 'width' => $logo[1]]
                )
            );
        }       

        // Copyright Message
        if( $this->layout['footer_copyright'] ) {
            $atoms['copyright'] = array(
                'atom'          => 'copyright',
                'properties'    => array(
                    'float'     => 'left',
                    'name'      => $this->layout['footer_copyright_name'],
                    'schema'    => $this->layout['footer_copyright_schema'] ? $this->layout['footer_copyright_schema'] : 'http://schema.org/Organization'
                )
            );
        }

        // Social Icons
        if( $this->layout['footer_social'] ) {
            $networks = get_social_networks();
            if( $networks ) {
                $atoms['social'] = array(
                    'atom'          => 'social',
                    'properties'     => array(
                        'colorBackground'   => $this->layout['footer_social_background'] ? false : true,
                        'rounded'           => true,
                        'float'             => 'right',
                        'urls'              => $networks
                    )
                );
            }                
        }

        // Menu
        if( $this->layout['footer_menu'] ) {
            $atoms['menu'] = array(
                'atom'          => 'menu',
                'properties'    => array(
                    'args'          => array('theme_location' => 'footer-menu'), 
                    'float'         => 'right',
                    'dropdown'      => false,
                    'hamburger'     => false
                )
            );
        }        

        // We should not have any atoms in the socket if it is disabled.
        if( $this->layout['footer_display_socket'] == false ) {
            $atoms = array();
        }        
   
        $args = apply_filters( 'waterfall_footer_args', array(
            'atoms'         => $atoms,
            'sidebars'      => $sidebarGrid,
            'container'     => $this->layout['footer_width'] == 'full' ? false : true,
            'style'         => 'footer'
        ) );
    
        // Build the footer! 
        WP_Components\Build::molecule( 'footer', $args );

    }

}