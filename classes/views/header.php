<?php
/**
 * Contains the class for initiating a new site header
 */
namespace Views;
use WP_Components as WP_Components;

class Header extends Base {

    /**
     * Sets the properties for the heading
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_header_properties', array(
            'customizer' => array( 'logo', 'logo_transparent', 'logo_mobile', 'logo_mobile_transparent' ),
            'layout' => array(
                'header_border',
                'header_disable_logo',
                'header_disable_menu',
                'header_fixed',
                'header_logo_float',
                'header_headroom',
                'header_menu_all',
                'header_menu_cart',
                'header_menu_float',
                'header_menu_hamburger',
                'header_menu_none',
                'header_menu_search',
                'header_menu_social',
                'header_menu_style',
                'header_transparent', 
                'header_width'   
            ),
            'meta' => array( 'transparent_header' )                                      
        ) );

    }

    /**
     * Displays the header
     */
    public function header() {

        // Return if the header is disabled
        if( $this->disabled('header', '') ) {
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
                'float'             => $this->layout['header_logo_float'] ? $this->layout['header_logo_float'] : 'left',
                'logoHeight'        => $logo ? $logo[2] : 64,
                'image'             => $logo ? $logo[0] : get_template_directory_uri() . '/assets/img/waterfall.png', 
                'mobile'            => $this->customizer['logo_mobile'], 
                'mobileTransparent' => $this->customizer['logo_mobile_transparent'], 
                'transparent'       => $this->customizer['logo_transparent'],
                'logoWidth'         => $logo ? $logo[1] : 306
            ),
            'menu'  => array( 
                'all'           => $this->layout['header_menu_all'] ? $this->layout['header_menu_all'] : __('View All Results', 'waterfall'), 
                'args'          => array('theme_location' => 'header-menu'), 
                'cart'          => $this->layout['header_menu_cart'] ? true : false, 
                'float'         => $this->layout['header_menu_float'] ? $this->layout['header_menu_float'] : 'right',
                'hamburger'     => $this->layout['header_menu_hamburger'] ? $this->layout['header_menu_hamburger'] : 'mobile',
                'none'          => $this->layout['header_menu_none'] ? $this->layout['header_menu_none'] : __('Nothing found!', 'waterfall'),
                'search'        => $this->layout['header_menu_search'] ? true : false,
                'view'          => $this->layout['header_menu_style'] ? $this->layout['header_menu_style'] : 'default'
            )                
        );
    
        // Social icons
        if( $this->layout['header_menu_social'] ) {
            $networks = get_social_networks();
    
            if( $networks ) {
                $atoms['menu']['social'] = $networks;
            }
        }        
    
        // Reset the order for right floats
        if( $this->layout['header_menu_float'] == 'right') {
            $menu = $atoms['menu'];
            unset($atoms['menu']);
            $atoms['menu'] = $menu;
        } 
        
        // Disable logo or menu
        if( $this->layout['header_disable_logo'] )
            unset( $atoms['logo'] );    
    
        if( $this->layout['header_disable_menu'] )
            unset( $atoms['menu'] );
        
        // Set-up our transparency
        $transparent    = isset($this->meta['transparent_header']['transparent']) && $this->meta['transparent_header']['transparent'] ? true : $this->layout['header_transparent'];  
    
        $args = apply_filters( 'waterfall_header_args', array(
            'atoms'         => $atoms,
            'container'     => $this->layout['header_width'] == 'default' ? true : false,
            'headroom'      => $this->layout['header_headroom'],
            'fixed'         => $this->layout['header_fixed'],
            'style'         => $this->layout['header_border'] ? 'header waterfall-no-border' : 'header',
            'transparent'   => $transparent
        ) );
    
        // Build the header!
        WP_Components\Build::molecule( 'header', $args );        

    }

}