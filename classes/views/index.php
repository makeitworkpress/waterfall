<?php
/**
 * Contains the class for initiating a new index or search page
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Index extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( 'waterfall_index_properties', [
            'layout' => [
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
                'content_none', 
                'content_type', 
                'content_style',
                // Sidebar
                'sidebar_position'
            ]                                     
        ] );


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
            $atoms['breadcrumbs'] = [ 'atom' => 'breadcrumbs', 'properties' => []];    
        }
        
        // Default title
        $atoms['archive-title'] = ['atom' => 'archive-title', 'properties' => [ 'attributes' => ['class' => 'page-title']]];    
        
        // Add searchform on search pages
        if( is_search() ) {     
            $atoms['search'] = ['atom' => 'search'];
        }
        
        $args = apply_filters( 'waterfall_archive_header_args', [
            'atoms'         => $atoms,
            'attributes'    => ['class' => 'main-header archive-header'],
            'align'         => $this->layout['header_align'],
            'container'     => $this->layout['header_width'] == 'full' ? false : true,
            'height'        => $this->layout['header_height']
        ] );
        
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
        
        $args = apply_filters( 'waterfall_archive_posts_args', [            
            'attributes'        => [
                'class'         => 'content archive-posts'
            ],
            'none'              => $this->layout['content_none'],
            'postProperties'    => [
                'appear'        => 'bottom',
                'attributes'    => [
                    'style'     => ['min-height' => $this->layout['content_height'] ? $this->layout['content_height'] . 'px' : '']
                ],
                'contentAtoms'  => $this->layout['content_content'] == 'none' ? [] : ['content' => ['atom' => 'content', 'properties' => ['type' => 'excerpt']]],          
                'footerAtoms'   => [ 
                    'button'    => ['atom' => 'button', 'properties' => ['attributes' => ['href' => 'post'], 'float' => 'right', 'label' => $this->layout['content_button'], 'size' => 'small']] 
                ], 
                'grid'          => $this->layout['content_columns'] ? $this->layout['content_columns'] : 'third',   
                'headerAtoms'   => [ 
                    'title'     => ['atom' => 'title', 'properties' => ['attributes' => ['itemprop' => 'name', 'class' => 'entry-title'], 'tag' => 'h2', 'link' => 'post']] 
                ],                                 
                'image'         => [
                    'enlarge'   => $this->layout['content_image_enlarge'] ? true : false, 
                    'float'     => $this->layout['content_image_float'] ? $this->layout['content_image_float'] : 'none', 
                    'lazyload'  => wf_get_theme_option('customizer', 'lazyload'),                     
                    'link'      => 'post', 
                    'size'      => $this->layout['content_image'] ? $this->layout['content_image'] : 'medium'                    
                ]
            ],
            'view'              => $this->layout['content_style'] ? $this->layout['content_style'] : 'grid',
            'query'             => $wp_query
        ] );

        // Adds the post type indicator
        if( $this->layout['content_type'] ) {
            $args['postProperties']['headerAtoms']['type'] = ['atom' => 'type', 'properties' => ['attributes' => ['class' => 'entry-meta']]];
        }

        // Unset button if no text is set
        if( ! $this->layout['content_button'] ) {
            unset( $args['postProperties']['footerAtoms']['button'] );
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
        
        // Adds sidebars. Sidebards ids are similar to the type displayed (archive, post, etc)
        if( $this->layout['sidebar_position'] == 'left' || $this->layout['sidebar_position'] == 'right' || $this->layout['sidebar_position'] == 'bottom' ) {
            WP_Components\Build::atom( 'sidebar', ['attributes' => ['class' => 'sidebar'], 'sidebars' => [$this->type]] );
        }

    }

}