<?php
/**
 * Contains the class for initiating a new site header
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Header extends Base {

    /**
     * Sets the properties for the heading
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_header_properties', [
            'customizer'    => ['logo', 'logo_transparent', 'logo_mobile', 'logo_mobile_transparent'],
            'layout'        => [
                'header_border',
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
            ],
            'woocommerce'   => ['header_cart'],
            'meta'          => ['transparent_header']                                      
        ] );

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

        // Default header items
        $atoms = [
            'logo'  => [
                'atom'                      => 'logo',
                'properties'                => [
                    'attributes'            => ['itemtype' => wf_get_theme_option('options', 'represent_scheme') == 'person' ? 'http://schema.org/Person' : 'http://schema.org/Organization'],
                    'float'                 => $this->layout['header_logo_float'] ? $this->layout['header_logo_float'] : 'left',
                    'default'               => $this->customizer['logo'] ? $this->customizer['logo'] : ['src' => get_template_directory_uri() . '/assets/img/waterfall.png', 'height' => 64, 'width' => 306],
                    'defaultTransparent'    => $this->customizer['logo_transparent'],
                    'mobile'                => $this->customizer['logo_mobile'], 
                    'mobileTransparent'     => $this->customizer['logo_mobile_transparent']
                ]
            ],
            'menu'  => [ 
                'atom'          => 'menu',
                'properties'    => [
                    'args'          => ['theme_location' => 'header-menu'], 
                    'float'         => $this->layout['header_menu_float'] ? $this->layout['header_menu_float'] : 'right',
                    'hamburger'     => $this->layout['header_menu_hamburger'] ? $this->layout['header_menu_hamburger'] : 'mobile',
                    'view'          => $this->layout['header_menu_style'] ? $this->layout['header_menu_style'] : 'default'
                ]
            ]               
        ];

        // Search
        if( $this->layout['header_search'] ) {
            $atoms['search'] = [ 
                'atom'              => 'search', 
                'properties'        => [
                    'ajax'          => true,
                    'all'           => $this->layout['header_search_all'] ? $this->layout['header_search_all'] : __('View All Results', 'waterfall'),
                    'attributes'    => [
                        'data'      => ['none' => $this->layout['header_search_none'] ? $this->layout['header_search_none'] : __('Nothing found!', 'waterfall')]
                    ],
                    'collapse'      => true,
                    'float'         => 'right',
                ]
            ];
        } 
       
        // The cart
        if( $this->woocommerce['header_cart'] ) {
            $atoms['cart'] = [ 'atom' => 'cart', 'properties' => ['float' => 'right'] ];
        }          

        // Social icons
        if( $this->layout['header_social'] ) {
            $networks = wf_get_social_networks();
            if( $networks ) {
                $atoms['social'] = [ 'atom' => 'social', 'properties' => ['urls' => $networks, 'rounded' => true, 'float' => 'right'] ];
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
    
        $args = apply_filters( 'waterfall_header_args', [
            'atoms'         => $atoms,
            'attributes'    => [
                'class'     => $this->layout['header_border'] ? 'header waterfall-no-border molecule-header-top' : 'header molecule-header-top'
            ],
            'container'     => $this->layout['header_width'] == 'default' ? true : false,
            'headroom'      => $this->layout['header_headroom'],
            'fixed'         => $this->layout['header_fixed'],
            'transparent'   => $transparent
        ] );
    
        // Build the header!
        WP_Components\Build::molecule( 'header', $args );        

    }

}