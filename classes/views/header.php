<?php
/**
 * Contains the class for initiating a new site header
 */
namespace Views;
use WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Header extends Base {

    /**
     * Sets the properties for the heading
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_header_properties', array(
            'customizer' => array( 'logo', 'logo_transparent', 'logo_mobile', 'logo_mobile_transparent' ),
            'layout' => array(
                'header_border',
                'header_cart',
                'header_disable_logo',
                'header_disable_menu',
                'header_fixed',
                'header_logo_float',
                'header_headroom',
                'header_menu_float',
                'header_menu_hamburger',
                'header_search',
                'header_search_all',
                'header_search_none',
                'header_social',
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

        $logo                   = is_numeric( $this->customizer['logo'] ) ? wp_get_attachment_image_src( $this->customizer['logo'], 'medium' ) : false;
        $logoTransparent        = is_numeric( $this->customizer['logo_transparent'] ) ? wp_get_attachment_image_src( $this->customizer['logo_transparent'], 'medium' ) : false;
        $logoMobile             = is_numeric( $this->customizer['logo_mobile'] ) ? wp_get_attachment_image_src( $this->customizer['logo_mobile'], 'medium' ) : false;
        $logoMobileTransparent  = is_numeric( $this->customizer['logo_mobile_transparent'] ) ? wp_get_attachment_image_src( $this->customizer['logo_mobile_transparent'], 'medium' ) : false;
       
        // Default header items
        $atoms = array(
            'logo'  => array( 
                'atom'                      => 'logo',
                'properties'                => array(
                    'float'                 => $this->layout['header_logo_float'] ? $this->layout['header_logo_float'] : 'left',
                    'default'               => [
                        'src'               => $logo ? $logo[0] : get_template_directory_uri() . '/assets/img/waterfall.png', 
                        'height'            => $logo ? $logo[2] : 64, 
                        'width'             => $logo ? $logo[1] : 306
                    ], 
                    'defaultTransparent'    => $logoTransparent ? ['src' => $logoTransparent[0], 'height' => $logoTransparent[2], 'width' => $logoTransparent[1]] : ['src' => '', 'width' => '', 'height' => ''],
                    'mobile'                => $logoMobile ? ['src' => $logoMobile[0], 'height' => $logoMobile[2], 'width' => $logoMobile[1]] : ['src' => '', 'width' => '', 'height' => ''], 
                    'mobileTransparent'     => $logoMobileTransparent ? ['src' => $logoMobileTransparent[0], 'height' => $logoMobileTransparent[2], 'width' => $logoMobileTransparent[1]]  :  ['src' => '', 'width' => '', 'height' => ''] 
                )
            ),
            'menu'  => array( 
                'atom'          => 'menu',
                'properties'    => array(
                    'args'          => array('theme_location' => 'header-menu'), 
                    'float'         => $this->layout['header_menu_float'] ? $this->layout['header_menu_float'] : 'right',
                    'hamburger'     => $this->layout['header_menu_hamburger'] ? $this->layout['header_menu_hamburger'] : 'mobile',
                    'view'          => $this->layout['header_menu_style'] ? $this->layout['header_menu_style'] : 'default'
                )
            )                
        );               

        // Search
        if( $this->layout['header_search'] ) {
            $atoms['search'] = array( 
                'atom' => 'search', 
                'properties' => array(
                    'ajax'  => true,
                    'all'   => $this->layout['header_search_all'] ? $this->layout['header_search_all'] : __('View All Results', 'waterfall'),
                    'collapse' => true,
                    'float' => 'right',
                    'none'  => $this->layout['header_search_none'] ? $this->layout['header_search_none'] : __('Nothing found!', 'waterfall')
                ) 
            );
        } 
       
        // The cart
        if( $this->layout['header_cart'] ) {
            $atoms['cart'] = array( 'atom' => 'cart', 'properties' => array('float' => 'right') );
        }          

        // Social icons
        if( $this->layout['header_social'] ) {
            $networks = get_social_networks();
            if( $networks ) {
                $atoms['social'] = array( 'atom' => 'social', 'properties' => array('urls' => $networks, 'rounded' => true, 'float' => 'right') );
            }
        }          
        
        // For right float, our menu's comes last - so our other items float right of it.
        if( $atoms['menu']['properties']['float'] == 'right' ) {
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
        
        // For non transparent areas, the logo's are not load - reduces some kb's.
        if( ! $transparent ) {
            unset($atoms['logo']['properties']['defaultTransparent']);
            unset($atoms['logo']['properties']['mobileTransparent']);
        }
    
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