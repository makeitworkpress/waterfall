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
                'header_title', 
                'header_width', 
                // Grid
                'content_button', 
                'content_columns', 
                'content_content', 
                'content_gap',
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
        
        // Adjustments in the default title
        if( $this->layout['header_title'] ) {
            
            global $wp_query;

            if( is_search() ) {   
                $atoms['archive-title']['properties']['types']['search']    = str_replace( 
                    ['{number}', '{term}'], 
                    ['<span>' . number_format_i18n( $wp_query->found_posts ) . '</span>', '<span>' . get_search_query() . '</span>'], 
                    $this->layout['header_title']
                );  
            } else {
                $atoms['archive-title']['properties']['types']['default']   = $this->layout['header_title'];
                $atoms['archive-title']['properties']['types']['home']      = $this->layout['header_title'];
            } 

        }
        
        // Add searchform on search pages
        if( is_search() ) {     
            $atoms['search'] = ['atom' => 'search', 'properties' => []];
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

        // Some defaults are different for search pages
        $defaults = [
            'columns'   => is_search() ? 'full' : 'third',
            'float'     => is_search() ? 'left' : 'none',
            'size'      => is_search() ? 'thumbnail' : 'medium',
            'style'     => is_search() ? 'list' : 'grid'
        ];
        
        $args = apply_filters( 'waterfall_archive_posts_args', [            
            'attributes'        => [
                'class'         => 'content archive-posts'
            ],
            'gridGap'           => $this->layout['content_gap'] ? $this->layout['content_gap'] : 'default', 
            'none'              => $this->layout['content_none'] ? $this->layout['content_none'] : __('Bummer! No posts have been found.', 'waterfall'),
            'postProperties'    => [
                'appear'        => 'bottom',
                'attributes'    => [
                    'style'     => ['min-height' => $this->layout['content_height'] ? $this->layout['content_height'] . 'px' : '']
                ],
                'contentAtoms'  => $this->layout['content_content'] == 'none' ? [] : ['content' => ['atom' => 'content', 'properties' => ['type' => 'excerpt']]],          
                'footerAtoms'   => [ 
                    'button'    => ['atom' => 'button', 'properties' => ['attributes' => ['href' => 'post'], 'float' => 'right', 'label' => $this->layout['content_button'], 'size' => 'small']] 
                ], 
                'grid'          => $this->layout['content_columns'] ? $this->layout['content_columns'] : $defaults['columns'],   
                'headerAtoms'   => [ 
                    'title'     => ['atom' => 'title', 'properties' => ['attributes' => ['itemprop' => 'name', 'class' => 'entry-title'], 'tag' => 'h2', 'link' => 'post']] 
                ],                                 
                'image'         => [
                    'enlarge'   => $this->layout['content_image_enlarge'] ? true : false, 
                    'float'     => $this->layout['content_image_float'] ? $this->layout['content_image_float'] : $defaults['float'], 
                    'lazyload'  => isset($this->options['optimize']['lazyLoad']) && $this->options['optimize']['lazyLoad'] ? true : false,                     
                    'link'      => 'post', 
                    'size'      => $this->layout['content_image'] ? $this->layout['content_image'] : $defaults['size']                    
                ]
            ],
            'view'              => $this->layout['content_style'] ? $this->layout['content_style'] : $defaults['style'],
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
            WP_Components\Build::atom( 'sidebar', ['attributes' => ['class' => 'main-sidebar'], 'sidebars' => [$this->type]] );
        }

    }

}