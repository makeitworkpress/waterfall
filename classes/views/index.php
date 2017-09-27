<?php
/**
 * Contains the class for initiating a new header
 */
namespace Views;
use WP_Components as WP_Components;

class Index extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( array(
            'layout' => array(
                // Header
                'align', 
                'breadcrumbs', 
                // Grid
                'button_label', 
                'columns', 
                'content', 
                'image', 
                'image_float',  
                'type', 
                'style',
                // Sidebar
                'layout',
                // Both
                'height', 
                'width'
            )                                     
        ), 'waterfall_index_properties' );


    }

    /**
     * Displays the header
     */
    public function header() {

        // Our settings prefix for the header
        $this->prefix = '_header_';

        // Return if the header is disabled
        if( $this->disabled() ) {
            return;
        }

        // Retrieve our properties for the archive header
        $this->getProperties();

        // Breadcrumbs
        if( $this->layout['breadcrumbs'] ) {
            $atoms['breadcrumbs'] = array();    
        }
        
        // Default title
        $atoms['archive-title'] = array('style' => 'page-title');    
        
        // Add searchform on search pages
        if( is_search() ) {     
            $atoms['search'] = array();
        }
        
        $args = apply_filters( 'waterfall_archive_header_args', array(
            'atoms'     => $atoms,
            'align'     => $this->layout['align'],
            'container' => $this->layout['width'] == 'full' ? false : true,
            'height'    => $this->layout['height'],
            'style'     => 'main-header'
        ) );
        
        WP_Components\Build::molecule( 'post-header', $args );         

    }

    /**
     * Displays the grid with posts
     */
    public function posts() {
        $this->prefix = '_content_';

        // Retrieve our properties for the posts
        $this->getProperties();

        // Retrieve our global query.
        global $wp_query;
        
        $args = apply_filters( 'waterfall_archive_posts_args', array(
            'contentAtoms'      => $this->layout['content'] == 'none' ? array() : array( 'content' => array('type' => 'excerpt') ),
            'headerAtoms'       => $this->layout['type'] 
                ? array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ), 'type' => array('style' => 'entry-meta') ) 
                : array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ) ),
            'footerAtoms'       => array( 
                'button' => array( 
                    'float' => 'right',
                    'link'  => 'post', 
                    'label' => $this->layout['button_label'] ? $this->layout['button_label'] : __('View Post', 'waterfall'), 
                    'size'  => 'small'
                ) 
            ),
            'image'             => array( 
                'link'      => 'post', 
                'size'      => $this->layout['image'] ? $this->layout['image'] : 'medium', 
                'enlarge'   => 'true', 
                'float'     => $this->layout['image_float'] ? $this->layout['image_float'] : 'none', 
                'lazyload'  => get_theme_option('customizer', 'lazyload') 
            ),
            'postsAppear'       => 'bottom',
            'postsGrid'         => $this->layout['columns'] ? $columns : 'third',
            'postsInlineStyle'  => $this->layout['height'] ? 'min-height:' . $this->layout['height'] . 'px;' : '',
            'style'             => 'content',
            'view'              => $this->layout['style'] ? $this->layout['style'] : 'grid',
            'query'             => $wp_query    
        ) );
        
        WP_Components\Build::molecule( 'posts', $args );

    }

    /**
     * Displays the grid with sidebar
     */
    public function sidebar() {

        $this->prefix = '_sidebar_'; 

        // Retrieve our properties for the sidebar
        $this->getProperties();        
        
        if( $this->layout['layout'] == 'left' || $this->layout['layout'] == 'right' ) {
            WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($this->type), 'style' => 'sidebar') );
        }

    }

}