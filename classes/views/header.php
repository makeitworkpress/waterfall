<?php
/**
 * Contains the class for initiating a new header
 */
namespace Views;
use WP_Components as WP_Components;

class Header extends Base {

    /**
     * Sets the properties for the heading
     */
    protected function setProperties() {
        $this->properties = apply_filters( array(
            'customizer' => array( 'logo', 'logo_transparent', 'logo_mobile', 'logo_mobile_transparent' ),
            'layout' => array(
                'border',
                'disable_logo',
                'disable_menu',
                'fixed',
                'logo_float',
                'headroom',
                'menu_all',
                'menu_cart',
                'menu_float',
                'menu_hamburger',
                'menu_none',
                'menu_search',
                'menu_social',
                'menu_style',
                'transparent', 
                'width'   
            ),
            'meta' => array( 'transparent' )                                      
        ), 'waterfall_header_properties' );

        // Sets our header prefix
        $this->prefix = 'header_';

    }

    /**
     * Displays the header
     */
    public function header() {

        // Return if the header is disabled
        if( $this->disabled() ) {
            return;
        }

        // Retrieve our header properties from the DB
        $this->getProperties();   

        /**
         * Set-up our atoms
         * The header atoms form the building blocks for the header
         */

        $logo = is_numeric( $this->customizer['logo'] ) ? wp_get_attachment_image_src( $this->customizer['logo'], 'large' ) : false;
    
        // Default header items
        $atoms = array(
            'logo'  => array( 
                'float'             => $this->layout['logo_float'] ? $this->layout['logo_float'] : 'left',
                'logoHeight'        => $logo ? $logo[2] : 64,
                'image'             => $logo ? $logo[0] : get_template_directory_uri() . '/assets/img/waterfall.png', 
                'mobile'            => $this->customizer['logo_mobile'], 
                'mobileTransparent' => $this->customizer['logo_mobile_transparent'], 
                'transparent'       => $this->customizer['logo_transparent'],
                'logoWidth'         => $logo ? $logo[1] : 306
            ),
            'menu'  => array( 
                'all'           => $this->layout['menu_all'] ? $this->layout['menu_all'] : __('View All Results', 'waterfall'), 
                'args'          => array('theme_location' => 'header-menu'), 
                'cart'          => $this->layout['menu_cart'] ? true : false, 
                'float'         => $this->layout['menu_float'] ? $this->layout['menu_float'] : 'right',
                'hamburger'     => $this->layout['menu_hamburger'] ? $this->layout['menu_hamburger'] : 'mobile',
                'none'          => $this->layout['menu_none'] ? $this->layout['menu_none'] : __('Nothing found!', 'waterfall'),
                'search'        => $this->layout['menu_search'] ? true : false,
                'view'          => $this->layout['menu_style'] ? $this->layout['menu_style'] : 'default'
            )                
        );
    
        // Social icons
        if( $this->layout['menu_social'] ) {
            $networks = get_social_networks();
    
            if( $networks ) {
                $atoms['menu']['social'] = $networks;
            }
        }        
    
        // Reset the order for right floats
        if( $this->layout['menu_float'] == 'right') {
            $menu = $atoms['menu'];
            unset($atoms['menu']);
            $atoms['menu'] = $menu;
        } 
        
        // Disable logo or menu
        if( $this->layout['disable_logo'] )
            unset( $atoms['logo'] );    
    
        if( $this->layout['disable_menu'] )
            unset( $atoms['menu'] ); 
        
        // Set-up our transparency
        $transparent    = isset($this->meta['transparent']) && $this->meta['transparent'] ? $this->meta['transparent'] : $this->layout['transparent'];  
    
        $args = apply_filters( 'waterfall_header_args', array(
            'atoms'         => $atoms,
            'container'     => $this->layout['width'] == 'default' ? true : false,
            'headroom'      => $this->layout['headroom'],
            'fixed'         => $this->layout['fixed'],
            'style'         => $this->layout['border'] ? 'header waterfall-no-border' : 'header',
            'transparent'   => $transparent
        ) );
    
        // Build the header!
        WP_Components\Build::molecule( 'header', $args );        

    }

}