<?php
/**
 * Contains the class for initiating a new 404 page
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Nothing extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {

        $this->type         = '404';
        $this->properties   = apply_filters( 'waterfall_404_properties', [
            'layout' => ['header_align', 'header_breadcrumbs', 'header_description', 'header_height', 'header_title', 'header_search', 'header_width']                                    
        ]);

    }

    /**
     * Displays the header
     */
    public function header() {

        // Retrieve our properties for the header
        $this->getProperties();

        $args = [
            'attributes'    => [
                'class'     => 'main-header nothing-header'
            ],
            'align'         => $this->layout['header_align'],
            'atoms'         => [],
            'height'        => $this->layout['header_height'],       
        ];
        
        // Breadcrumbs
        if( $this->layout['header_breadcrumbs'] )
           $args['atoms']['breadcrumbs']    = [ 'atom' => 'breadcrumbs', 'properties' => []];
        
        // Title
        $args['atoms']['title']             = [ 
            'atom'  => 'title',
            'properties' => [
                'attributes'    => ['class' => 'page-title nothing-title'],
                'tag'           => 'h1', 
                'title'         => $this->layout['header_title'] ? $this->layout['header_title'] : __('Woops! Nothing found here...', 'waterfall') 
            ]
        ]; 

        // Description
        $args['atoms']['description']       = [
            'atom'          => 'description',
            'properties'    => [ 
                'attributes'    => ['class' => 'nothing-description'],
                'description'   => $this->layout['header_description'] ? $this->layout['header_description'] : __('Try visiting another page or searching.', 'waterfall'),
            ]
        ]; 
        
        // Search
        if( $this->layout['header_search'] ) {
            $args['atoms']['search'] = ['atom' => 'search', 'properties' => []];
        }
        
        $args = apply_filters( 'waterfall_404_header_args', $args );
        
        WP_Components\Build::molecule( 'post-header', $args );

    }

}