<?php
/**
 * Contains the basic class for new view controllers
 */
namespace Views;
use Waterfall_Data as Waterfall_Data;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

abstract class Base {
    
    /**
     * The current type we are looking at
     * This is used to make a distinction between archives and search or pages and posts, as they share similar settings.
     * Should be defined by child classes extending this class
     *
     * @access public
     */
    public $type;    

    /**
     * Contains the list of our custom properties for each view controller
     *
     * @access protected
     */
    protected $properties; 
    
    /**
     * Contains our customizer properties
     *
     * @access protected
     */
    protected $customizer;
    
    /**
     * Contains our layout properties
     *
     * @access protected
     */
    protected $layout;  
     
    /**
     * Contains our meta properties
     *
     * @access protected
     */
    protected $meta; 
    
    /**
     * Contains our WooCommerce properties
     *
     * @access protected
     */
    protected $woocommerce;
    
    /**
     * Contains our bbPress properties
     *
     * @access protected
     */
    protected $bbpress;     
    
    /**
     * Contains the custom options from the Theme Settings Panel
     */
    protected $options = [];
  
    /**
     * The initial state of our class
     */
    public function __construct() {

        // Reloads our data so the customizer can access it and updates are reflected
        if( is_customize_preview() ) {
            Waterfall_Data::instance()->reload_customizer_data();
        }

        // Set our properties based upon the arrays defined within a view
        $this->set_properties();

        // Determine odd, but default layout properties that can occur for archives and singulars
        $this->content_container = true;      
        $this->related_container = true;      
        $this->related_section   = true;      
        $this->set_main_layout();
        
    }

    /**
     * Sets all basic properties that are retrieved from our customizer or meta settings. Can only be defined in child class
     * This function should define $this->properties
     */
    abstract protected function set_properties();

    /**
     * This function automatically sets all properties based upon the array mentioned above.
     * It should be called during rendering.
     */
    protected final function get_properties() {

        $called = get_called_class();
        $prefix = $this->type ? $this->type . '_' : '';

        // Loads specific theme options
        if( isset($this->properties['options']) ) {
            $this->options      = wf_get_data('options', $this->properties['options'], '');
        }

        // Loads meta data from the postmeta
        if( is_singular() && isset($this->properties['meta']) ) {
            $this->meta         = apply_filters( 'waterfall_meta_properties', wf_get_data('meta', $this->properties['meta']), $called );
        }

        // Sets general customizer properties
        if( isset($this->properties['customizer']) ) {
            $this->customizer   = apply_filters( 'waterfall_customizer_properties', wf_get_data('customizer', $this->properties['customizer']), $called );
        }

        // Sets layout customizer properties
        if( isset($this->properties['layout']) ) {
            $this->layout       = apply_filters( 'waterfall_layout_properties', wf_get_data('layout', $this->properties['layout'], $prefix), $called );    
        } 
        
        // Sets woocommerce customizer properties
        if( isset($this->properties['woocommerce']) ) {
            $this->woocommerce  = apply_filters( 'waterfall_woocommerce_properties', wf_get_data('woocommerce', $this->properties['woocommerce'], $prefix), $called );    
        } 
        
        // Sets woocommerce customizer properties
        if( isset($this->properties['bbpress']) ) {
            $this->bbpress      = apply_filters( 'waterfall_bbpress_properties', wf_get_data('bbpress', $this->properties['bbpress'], $prefix), $called );    
        }         

    }

    /**
     * Examines whether an module is disabled.
     * The parameters can be used to do a manual check
     *
     * @param string $prefix    The current context prefix, such as post_related or header_
     * @param string $context   An optional context which is used for singular items to load post meta, which may indicate an item is disabeld
     */
    protected function disabled( $prefix = '', $context = 'content_') {
        
        $customizer     = false;
        $disabled       = false;
        $meta           = ['disable' => false];
        
        // For singular items
        if( is_singular() ) {
            $disable    = wf_get_data( 'meta', $context . $prefix . '_disable' );
            $meta       = $disable ? $disable : $meta;
        }

        // General (most likely used for the general header and footer)
        $prefix         = $this->type ? $this->type . '_' . $prefix : $prefix; // If a type is defined, this will have a different prefix
        $customizer     = wf_get_data( 'layout', $prefix . '_disable' );    

        // We hide the related section if we haven't saved anything yet for pages
        if( $prefix === $this->type . '_related' ) {

            $pagination = wf_get_data( 'layout', $prefix . '_pagination' );
            $posts      = wf_get_data( 'layout', $prefix . '_posts' );

            if( ! $posts && ! $pagination && ! has_action('waterfall_before_' . $this->type . '_related') && ! has_action('waterfall_after_' . $this->type . '_related') ) {
                $disabled = true;
            }

        }

        // We hide our post content footer is there is nothing to show
        if( $prefix === $this->type . '_footer' ) {

            $author     = wf_get_data( 'layout', $prefix . '_author' );
            $comments   = wf_get_data( 'layout', $prefix . '_comments' );
            $share      = wf_get_data( 'layout', $prefix . '_share' );

            if( ! $author && ! $comments && ! $share && ! has_action('waterfall_before_' . $this->type . '_footer') && ! has_action('waterfall_after_' . $this->type . '_footer') ) {
                $disabled = true;
            }            

        }

        if( $meta['disable'] === true || $customizer) {
            $disabled   = true;
        }

        return apply_filters( 'waterfall_disabled_section', $disabled, $prefix, $context );

    }

    /**
     * Determines if we need to do some odd lay-out conditions for the main layout - we can also limit showing the actual template parts
     */
    private function set_main_layout() {

        /**
         * Determines the settings for the content section
         */
        
        // Look if our display of content inside .main-content should be fullwidth or not
        if( function_exists('is_woocommerce') && is_woocommerce() ) {
            $context                    = 'woocommerce';
        } elseif( class_exists('bbPress') && in_array($this->type, ['forum', 'topic', 'reply', 'forum_archive']) ) {
            $context                    = 'bbpress';
        } else {
            $context                    = 'layout';
        }
        
        $content_width                  = wf_get_data( $context, $this->type . '_content_width' );
        $meta_Content_width             = wf_get_data( 'meta', 'content_width' );

        // Container is disabled when a post or type is set to full width content, or when viewing an elementor library
        if( $content_width === 'full' || ( is_singular() && (isset($meta_Content_width['full']) && $meta_Content_width['full']) ) || is_singular('elementor_library') ) {
            $this->content_container    = false;
        }

        /**
         * Determines the appearance and width for the related section
         */
        $related_width                  = wf_get_data( 'layout', $this->type . '_related_width' );

        if( $related_width === 'full' ) {
            $this->related_container    = false;
        }

        // And obviously, we also bail out if disabled
        if( $this->disabled('related') ) {
            $this->related_section      = false;
        }

     }

}