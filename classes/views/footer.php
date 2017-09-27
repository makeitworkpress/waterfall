<?php
/**
 * Contains the class for initiating a new header
 */
namespace Views;
use WP_Components as WP_Components;

class Footer extends Base {

    /**
     * Sets the properties for the footer
     */
    protected function setProperties() {
        $this->properties = apply_filters( array(
            'customizer' => array(
                'logo',   
                'logo_transparent',             
                'logo_mobile',               
                'logo_mobile_transparent'  
            ),
            'layout' => array( 'copyright', 'copyright_name', 'copyright_schema', 'display_sidebars', 'display_socket', 'logo', 'menu', 'sidebars', 'social', 'width' ),                                    
        ), 'waterfall_footer_properties' );

        // Sets our header prefix
        $this->prefix = 'footer_';

    }

    /**
     * Displays the header
     */
    public function footer() {

        // Return if the footer is disabled
        if( $this->disabled() ) {
            return;
        }

        // Retrieve our footer properties from the DB
        $this->getProperties();   

        /**
         * Set-up our atoms for the footer
         */
        $atoms = array();

        // Sidebars
        switch( $this->layout['sidebars'] ) {
            case 'full':
                $sidebarGrid = array('footer-one' => 'full');
                break;
            case 'half':
                $sidebarGrid = array('footer-one' => 'half', 'footer-two' => 'half');
                break;
            case 'third':
                $sidebarGrid = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
                break;
            case 'fourth':
                $sidebarGrid = array('footer-one' => 'fourth', 'footer-two' => 'fourth', 'footer-three' => 'fourth', 'footer-four' => 'fourth');
                break;
            case 'fifth':
                $sidebarGrid = array('footer-one' => 'fifth', 'footer-two' => 'fifth', 'footer-three' => 'fifth', 'footer-four' => 'fifth', 'footer-five' => 'fifth');
                break;
            default:
                $sidebarGrid = array('footer-one' => 'third', 'footer-two' => 'third', 'footer-three' => 'third');
        }

        // We do not have sidebars
        if( $this->layout['display_sidebars'] == false ) {
            $sidebarGrid = array();
        }

        // Logo
        if( is_numeric($this->layout['logo']) ) {
            $logo = wp_get_attachment_image_src( $this->layout['logo'], 'medium' );
            $atoms['logo'] = array(
                'float'         => 'center',
                'logoHeight'    => $logo[2],
                'logoWidth'     => $logo[1],
                'image'         => $logo[0]
            );
        }       

        // Copyright Message
        if( $this->layout['copyright'] ) {
            $atoms['copyright'] = array(
                'float'     => 'left',
                'name'      => $this->layout['copyright_name'],
                'schema'    => $this->layout['copyright_schema'] ? $this->layout['copyright_schema'] : 'http://schema.org/Organization'
            );
        }

        // Social Icons
        if( $this->layout['social'] ) {
            $networks = get_social_networks();
            if( $networks ) {
                $atoms['social'] = array(
                    'rounded'   => true,
                    'float'     => 'right',
                    'urls'      => $networks
                );
            }                
        }

        // Menu
        if( $this->layout['menu'] ) {
            $atoms['menu'] = array(
                'args'          => array('theme_location' => 'footer-menu'), 
                'float'         => 'right',
                'dropdown'      => false,
                'hamburger'     => 'none',
            );
        }        

        // We should not have any atoms in the socket if it is disabled.
        if( $this->layout['display_socket'] == false ) {
            $atoms = array();
        }        
   
        $args = apply_filters( 'waterfall_footer_args', array(
            'atoms'         => $atoms,
            'sidebars'      => $sidebarGrid,
            'container'     => $this->layout['width'] == 'full' ? false : true,
            'style'         => 'footer'
        ) );
    
        // Build the footer! 
        WP_Components\Build::molecule( 'footer', $args );

    }

}