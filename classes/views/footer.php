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
        $this->properties = apply_filters( 'waterfall_footer_properties', [
            'customizer'    => [
                'footer_logo', 
            ],
            'layout' => [ 
                'footer_copyright', 
                'footer_copyright_name', 
                'footer_copyright_schema', 
                'footer_display_sidebars', 
                'footer_display_socket', 
                'footer_grid_gap', 
                'footer_logo_stack',
                'footer_menu', 
                'footer_sidebars', 
                'footer_scroll',
                'footer_scroll_style',
                'footer_social', 
                'footer_social_background', 
                'footer_width'
            ],                                    
         ] );

    }

    /**
     * Displays the footer
     */
    public function footer() {

        // Return if the footer is disabled
        if( $this->disabled('footer', '') ) {
            return;
        }

        // Elementor is rendering our footer
        if( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
            return;
        }

        // Retrieve our footer properties from the DB
        $this->getProperties();   

        /**
         * Set-up our atoms for the footer
         */
        $atoms = [];

        // Sidebars
        switch( $this->layout['footer_sidebars'] ) {
            case 'full':
                $sidebarGrid = ['footer-one' => 'components-full-grid'];
                break;
            case 'half':
                $sidebarGrid = ['footer-one' => 'components-half-grid', 'footer-two' => 'components-half-grid'];
                break;
            case 'third':
                $sidebarGrid = ['footer-one' => 'components-third-grid', 'footer-two' => 'components-third-grid', 'footer-three' => 'components-third-grid'];
                break;
            case 'fourth':
                $sidebarGrid = ['footer-one' => 'components-fourth-grid', 'footer-two' => 'components-fourth-grid', 'footer-three' => 'components-fourth-grid', 'footer-four' => 'components-fourth-grid'];
                break;
            case 'fifth':
                $sidebarGrid = ['footer-one' => 'components-fifth-grid', 'footer-two' => 'components-fifth-grid', 'footer-three' => 'components-fifth-grid', 'footer-four' => 'components-fifth-grid', 'footer-five' => 'components-fifth-grid'];
                break;
            default:
                $sidebarGrid = ['footer-one' => 'components-third-grid', 'footer-two' => 'components-third-grid', 'footer-three' => 'components-third-grid'];
        }

        // We do not have sidebars
        if( $this->layout['footer_display_sidebars'] == false ) {
            $sidebarGrid = [];
        }

        $represents = wf_get_theme_option('options', 'represent_scheme');
        $itemType   = $represents == 'person' ? 'http://schema.org/Person' : 'http://schema.org/Organization'; 

        // Logo
        if( is_numeric($this->customizer['footer_logo']) ) {
            $logo = wp_get_attachment_image_src( $this->customizer['footer_logo'], 'medium' );
            $atoms['logo'] = [
                'atom'       => 'logo',
                'properties' => [
                    'attributes'    => [
                        'class'    => $this->layout['footer_logo_stack'] ? 'footer-logo-stack' : 'footer-logo-default',
                        'itemtype' => $itemType
                    ],
                    'float'         => 'center',
                    'default'       => ['src' => $logo[0], 'height' => $logo[2], 'width' => $logo[1]],
                    'schema'        => $represents ? true : false
                ]
            ];
        }       

        // Copyright Message
        if( $this->layout['footer_copyright'] ) {
            $atoms['copyright'] = [
                'atom'          => 'copyright',
                'properties'    => [
                    'float'     => 'left',
                    'name'      => $this->layout['footer_copyright_name'],
                    'itemtype'  => $itemType
                ]
            ];
        }

        // Social Icons
        if( $this->layout['footer_social'] ) {
            $networks = wf_get_social_networks();
            if( $networks ) {
                $atoms['social'] = [
                    'atom'          => 'social',
                    'properties'     => [
                        'colorBackground'   => $this->layout['footer_social_background'] ? false : true,
                        'rounded'           => true,
                        'float'             => 'right',
                        'urls'              => $networks
                    ]
                ];
            }                
        }

        // Menu
        if( $this->layout['footer_menu'] ) {
            $atoms['menu'] = [
                'atom'          => 'menu',
                'properties'    => [
                    'args'          => ['theme_location' => 'footer-menu'], 
                    'float'         => 'right',
                    'dropdown'      => false,
                    'hamburger'     => false
                ]
            ];
        }        

        // We should not have any atoms in the socket if it is disabled.
        if( $this->layout['footer_display_socket'] == false ) {
            $atoms = [];
        }        
   
        $args = apply_filters( 'waterfall_footer_args', [
            'attributes'    => [
                'class'     => 'footer'
            ],
            'atoms'         => $atoms,
            'container'     => $this->layout['footer_width'] == 'full' ? false : true,
            'gridGap'       => $this->layout['footer_grid_gap'] ? $this->layout['footer_grid_gap'] : 'default',
            'sidebars'      => $sidebarGrid,
        ] );
    
        // Build the footer! 
        WP_Components\Build::molecule( 'footer', $args );

        // Adds the scroll to top element as a seperate element
        if( in_array($this->layout['footer_scroll'], ['center', 'left', 'right']) ) {
            WP_Components\Build::atom( 'scroll', 
                apply_filters(
                    'waterfall_footer_scroll_args', 
                    [
                        'attributes'    => ['class' => 'waterfall-scroll-top position-' . $this->layout['footer_scroll']], 
                        'rounded'       => $this->layout['footer_scroll_style'] == 'rounded' ? true : false,
                        'top'           => true
                    ]
                )            
            );
        }

    }

}