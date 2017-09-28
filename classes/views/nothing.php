<?php
/**
 * Contains the class for initiating a new 404 page
 */
namespace Views;
use WP_Components as WP_Components;

class Nothing extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_404_properties', array(
            'layout' => array('header_align', 'header_breadcrumbs', 'header_description', 'header_height', 'header_title', 'header_search', 'header_width')                                     
        ) );
    }

    /**
     * Displays the header
     */
    public function header() {

        // Retrieve our properties for the header
        $this->getProperties();

        $args = array(
            'align'     => $this->layout['header_align'],
            'atoms'     => array(),
            'height'    => $this->layout['header_height'],
            'style'     => 'main-header'        
        );
        
        // Breadcrumbs
        if( $this->layout['header_breadcrumbs'] )
           $args['atoms']['breadcrumbs']    = array();
        
        // YUP
        $args['atoms']['title']             = array( 
            'style' => 'page-title', 
            'tag'   => 'h1', 
            'title' => $this->layout['header_title'] ? $this->layout['header_title'] : __('Woops! Nothing found here...', 'waterfall') 
        ); 
        $args['atoms']['description']       = array( 'description' => $this->layout['header_description'] ? $this->layout['header_description'] : __('Try visiting another page or searching.', 'waterfall') ); 
        
        // Search
        if( $this->layout['header_search'] )
            $args['atoms']['search'] = array();
        
        $args = apply_filters( 'waterfall_404_header_args', $args );
        
        WP_Components\Build::molecule( 'post-header', $args );

    }

}