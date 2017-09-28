<?php
/**
 * Contains the class for initiating a new index or search page
 */
namespace Views;
use WP_Components as WP_Components;

class Index extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_index_properties', array(
            'layout' => array(
                // Header
                'header_align', 
                'header_breadcrumbs', 
                'header_height', 
                'header_width', 
                // Grid
                'content_button', 
                'content_columns', 
                'content_content', 
                'content_height', 
                'content_image', 
                'content_image_enlarge',  
                'content_image_float',  
                'content_type', 
                'content_style',
                // Sidebar
                'sidebar_position'
            )                                     
        ) );


    }

    /**
     * Displays the header
     */
    public function header() {

        // Return if the header is disabled
        if( $this->disabled('header') ) {
            return;
        }

        // Retrieve our properties for the archive header
        $this->getProperties();

        // Breadcrumbs
        if( $this->layout['header_breadcrumbs'] ) {
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
            'align'     => $this->layout['header_align'],
            'container' => $this->layout['header_width'] == 'full' ? false : true,
            'height'    => $this->layout['header_height'],
            'style'     => 'main-header'
        ) );
        
        WP_Components\Build::molecule( 'post-header', $args );         

    }

    /**
     * Displays the grid with posts
     */
    public function posts() {

        // Retrieve our properties for the posts
        if( ! isset($this->layout) ) {
            $this->getProperties();
        }

        // Retrieve our global query.
        global $wp_query;
        
        $args = apply_filters( 'waterfall_archive_posts_args', array(
            'contentAtoms'      => $this->layout['content_content'] == 'none' ? array() : array( 'content' => array('type' => 'excerpt') ),
            'headerAtoms'       => $this->layout['content_type'] 
                ? array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ), 'type' => array('style' => 'entry-meta') ) 
                : array( 'title' => array( 'tag' => 'h2', 'link' => 'post' ) ),
            'footerAtoms'       => array( 
                'button' => array( 
                    'float' => 'right',
                    'link'  => 'post', 
                    'label' => $this->layout['content_button'], 
                    'size'  => 'small'
                ) 
            ),
            'image'             => array( 
                'link'      => 'post', 
                'size'      => $this->layout['content_image'] ? $this->layout['content_image'] : 'medium', 
                'enlarge'   => $this->layout['content_image_enlarge'] ? true : false, 
                'float'     => $this->layout['content_image_float'] ? $this->layout['content_image_float'] : 'none', 
                'lazyload'  => get_theme_option('customizer', 'lazyload') 
            ),
            'postsAppear'       => 'bottom',
            'postsGrid'         => $this->layout['content_columns'] ? $this->layout['content_columns'] : 'third',
            'postsInlineStyle'  => $this->layout['content_height'] ? 'min-height:' . $this->layout['content_height'] . 'px;' : '',
            'style'             => 'content',
            'view'              => $this->layout['content_style'] ? $this->layout['content_style'] : 'grid',
            'query'             => $wp_query    
        ) );

        // Unset button if no text is set
        if( ! $this->layout['content_button'] ) {
            unset( $args['footerAtoms']['button'] );
        }        
        
        WP_Components\Build::molecule( 'posts', $args );

    }

    /**
     * Displays the grid with sidebar
     */
    public function sidebar() {

        // Retrieve our properties for the sidebar
        if( ! isset($this->layout) ) {
            $this->getProperties(); 
        }       
        
        if( $this->layout['sidebar_position'] == 'left' || $this->layout['sidebar_position'] == 'right' ) {
            WP_Components\Build::molecule( 'sidebar', array('sidebars' => array($this->type), 'style' => 'sidebar') );
        }

    }

}