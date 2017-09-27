<?php
/**
 * Contains the basic class for new view controllers
 */
namespace Views;

abstract class Base {

    /**
     * Contains our optional prefix
     *
     * @access protected
     */
    protected $prefix; 
    
    /**
     * The current type we are looking at
     * This is used to make a distinction between archives and search or pages and posts, as they share similar settings.
     *
     * @access protected
     */
     private $type;    

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
     * Contains our condition for the width of our content section in archives or singulars
     *
     * @access public
     */
    public $contentContainer;
     
    /**
     * Contains the condition for the width of our overall content structure and sidebar place
     *
     * @access public
     */
    public $mainContainer;     
          

    /**
     * The initial state of our class
     *
     * @param string $type The optional type of content we are looking at. This determines a context (is_page, is_single, etc) based prefix for retrieving settings
     */
    public function __construct( $type = '' ) {
        $this->prefix = '';
        $this->type   = $type;
        $this->setProperties();

        // Determine odd layout properties that can occur for archives and singulars
        $this->contentContainer = true;
        $this->mainContainer    = false; // In the future, this allows us to have a more flexible placement of the sidebar        
        $this->mainLayout();
    }

    /**
     * Sets all basic properties that are retrieved from our customizer or meta settings. Can only be defined in child class
     * This function should define $this->properties and $this->prefix in it's child classes if this is not defined in one of the methods
     */
    abstract protected function setProperties();

    /**
     * This function automatically sets all properties based upon the array mentioned above.
     * It should be called during rendering.
     */
    protected final function getProperties() {

        // Loads meta data from the postmeta
        if( is_singular() && isset($this->properties['meta']) ) {
            $this->meta         = apply_filters( 'waterfall_meta_properties', get_theme_option('meta', $this->properties['meta']), get_called_class() );
        }

        // Sets general customizer properties
        if( isset($this->properties['customizer']) ) {
            $this->customizer   = apply_filters( 'waterfall_customizer_properties', get_theme_option('meta', $this->properties['customizer']), get_called_class() );
        }

        // Sets layout customizer properties
        if( isset($this->properties['layout']) ) {
            $this->layout       = apply_filters( 'waterfall_layout_properties', get_theme_option('layout', $this->properties['layout'], $this->type . $this->prefix), get_called_class() );    
        }        

    }

    /**
     * Examines whether an module is disabled
     */
    protected function disabled() {
        
        $customizer     = false;
        $disabled       = false;
        $meta           = array( 'disable' => false );
        
        // For singular items
        if( is_singular() ) {
            $disable    = get_theme_option( 'meta', '', '', 'disable_' . str_replace('_', '', $this->prefix) );
            $meta       = $disable ? $disable : $meta;
        }

        // General (most likely used for the general header and footer)
        $customizer = get_theme_option( 'layout', '', '', $this->type . $this->prefix . '_disable' );    

        if( $meta['disable'] == true || $customizer === true ) {
            $disabled   = true;
        }

        return $disabled;

    }

    /**
     * Determines if we need to do some odd lay-out conditions for the main layout
     */
     private function mainLayout() {

        // Look if our display of content inside .main-content should be fullwidth or not
        $contentWidth           = get_theme_option( 'layout', $this->type . '_content_width' );
        $metaContentWidth       = get_theme_option( 'meta', 'content_width' );

        if( $contentWidth == 'full' || (isset($metaContentWidth['full']) && $metaContentWidth['full']) ) {
            $this->contentContainer = false;
        }

     }

}