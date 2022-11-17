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
    protected function set_properties() {

        $this->type         = is_search() ? 'search' : wf_get_archive_post_type() . '_archive';
        $this->properties   = apply_filters( 'waterfall_index_properties', [
            'layout' => [
                // Header
                'header_align', 
                'header_breadcrumbs', 
                'header_breadcrumbs_posts', 
                'header_description', 
                'header_height', 
                'header_title', 
                'header_width', 
                // Grid
                'content_button', 
                'content_button_icon',
                'content_columns', 
                'content_content', 
                'content_gap',
                'content_height', 
                'content_image', 
                'content_image_enlarge',  
                'content_image_float',  
                'content_meta_author', 
                'content_meta_avatar', 
                'content_meta_date', 
                'content_none', 
                'content_type', 
                'content_style',
                // Sidebar
                'sidebar_position'
            ],
            'options' => [
                'scheme_post_types_disable'
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
        $this->get_properties();

        // Breadcrumbs
        if( $this->layout['header_breadcrumbs'] ) {
            $atoms['breadcrumbs'] = ['atom' => 'breadcrumbs', 'properties' => ['archive' => $this->layout['header_breadcrumbs_posts'] ? true : false]];    
        }
        
        // Default title
        $atoms['title'] = ['atom' => 'archive-title', 'properties' => [ 'attributes' => ['class' => 'page-title']]];   
        
        // Adjustments in the default title
        if( $this->layout['header_title'] ) {
            
            global $wp_query;

            if( is_search() ) {   
                $atoms['title']['properties']['types']['search']    = str_replace( 
                    ['{number}', '{term}'], 
                    ['<span>' . number_format_i18n( $wp_query->found_posts ) . '</span>', '<span>' . get_search_query() . '</span>'], 
                    $this->layout['header_title']
                );  
            } else {
                $atoms['title']['properties']['types']['default']   = $this->layout['header_title'];
                $atoms['title']['properties']['types']['home']      = $this->layout['header_title'];
            } 

        }

        if( $this->layout['header_description'] ) {
            $description            = str_replace('{description}', str_replace( ['<p>', '</p>'], '', term_description() ), $this->layout['header_description'] );
            $atoms['description']   = [
                'atom'              => 'description', 
                'properties'        => [
                    'attributes'    => ['class' => 'page-description'], 
                    'description'   => do_shortcode($description)
                ]
            ];
        }
        
        // Add searchform on search pages
        if( is_search() ) {     
            $atoms['search'] = ['atom' => 'search', 'properties' => []];
        }
        
        $args = apply_filters( 'waterfall_archive_header_args', [
            'atoms'         => $atoms,
            'attributes'    => ['class' => 'main-header archive-header'],
            'align'         => $this->layout['header_align'],
            'container'     => $this->layout['header_width'] === 'full' ? false : true,
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
            $this->get_properties();
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

        // Settings to determina what Microdata to show
        $type        = str_replace('_archive', '', $this->type);
        $blog_types  = apply_filters( 'waterfall_blog_scheme_post_types', ['post'] );
        $no_schema   = $this->options['scheme_post_types_disable'] ? $this->options['scheme_post_types_disable'] : [];
        
        $args = apply_filters( 'waterfall_archive_posts_args', [            
            'attributes'        => [
                'class'         => 'content archive-posts',
                'itemtype'      => in_array($type, $blog_types) ? 'http://schema.org/Blog' : '' 
            ],
            'grid_gap'          => $this->layout['content_gap'] ? $this->layout['content_gap'] : 'default', 
            'none'              => $this->layout['content_none'] ? $this->layout['content_none'] : __('Bummer! No posts have been found.', 'waterfall'),
            'post_properties'   => [
                'appear'        => 'bottom',
                'attributes'    => [
                    'itemprop'  => in_array($type, $blog_types) ? 'blogPost' : '', 
                    'itemtype'  => in_array($type, $blog_types) ? 'http://schema.org/BlogPosting' : 'http://schema.org/CreativeWork', 
                    'style'     => ['min-height' => $this->layout['content_height'] ? $this->layout['content_height'] . 'px' : '']
                ],
                'blog_schema'   => in_array($type, $blog_types) ? true : false,
                'content_atoms' => $this->layout['content_content'] === 'none' ? [] : ['content' => ['atom' => 'content', 'properties' => ['type' => 'excerpt']]],          
                'footer_atoms'  => [ 
                    'button'    => [
                        'atom'      => 'button', 
                        'properties' => [
                            'attributes'    => ['href' => 'post'], 
                            'float'         => 'right', 
                            'icon_after'    => $this->layout['content_button_icon'] ? 'angle-right' : '',
                            'icon_visible'  => 'hover',
                            'label'         => $this->layout['content_button'], 
                            'size'          => 'small'
                        ]
                    ]
                ], 
                'grid'          => $this->layout['content_columns'] ? $this->layout['content_columns'] : $defaults['columns'],   
                'header_atoms'  => [
                    'title'     => [
                        'atom' => 'title', 
                        'properties' => ['attributes' => ['itemprop' => 'name', 'class' => 'entry-title'], 'tag' => 'h2', 'link' => 'post']
                    ] 
                ],                                 
                'image'         => [
                    'attributes'    => ['class' => 'entry-image'],
                    'enlarge'       => $this->layout['content_image_enlarge'] ? true : false, 
                    'float'         => $this->layout['content_image_float'] ? $this->layout['content_image_float'] : $defaults['float'],                   
                    'link'          => 'post', 
                    'size'          => $this->layout['content_image'] ? $this->layout['content_image'] : $defaults['size']                    
                ]
            ],
            'schema'            => in_array($type, $no_schema) ? false : true,
            'view'              => $this->layout['content_style'] ? $this->layout['content_style'] : $defaults['style'],
            'query'             => $wp_query
        ] );

        // Adds the post author
        if( $this->layout['content_meta_author'] ) {
            $args['post_properties']['header_atoms']['author'] = [
                'atom'          => 'author',
                'properties'    => [
                    'attributes'    => ['class' => 'entry-author'],
                    'description'   => false, 
                    'imageFloat'    => 'left',
                    'schema'        => in_array($type, $no_schema) ? false : true,
                ]
            ];

            // Disables the avatar bu default
            if( ! $this->layout['content_meta_avatar'] ) {
                $args['post_properties']['header_atoms']['author']['properties']['avatar'] = false;
            }

        }

        // Adds the post date
        if( $this->layout['content_meta_date'] ) {
            $args['post_properties']['header_atoms']['date'] = [
                'atom'              => 'date', 
                'properties'        => [
                    'attributes'    => ['class' => 'entry-time'], 
                    'schema'        => in_array($type, $no_schema) ? false : true
                ]
            ]; 
        }        

        // Adds the post type indicator
        if( $this->layout['content_type'] ) {
            $args['post_properties']['header_atoms']['type'] = [
                'atom'          => 'type', 
                'properties'    => ['attributes' => ['class' => 'entry-meta']]
            ];
        }

        // Unset button if no text is set
        if( ! $this->layout['content_button'] ) {
            unset( $args['post_properties']['footer_atoms']['button'] );
        }        
        
        WP_Components\Build::molecule( 'posts', $args );

    }

    /**
     * Displays the grid with sidebar
     */
    public function sidebar() {

        // Retrieve our properties for the sidebar
        if( ! isset($this->layout) ) {
            $this->get_properties(); 
        }
        
        // Adds sidebars. Sidebars ids are similar to the type displayed (archive, post, etc)
        if( $this->layout['sidebar_position'] === 'left' || $this->layout['sidebar_position'] === 'right' || $this->layout['sidebar_position'] === 'bottom' ) {
            $args = apply_filters( 'waterfall_archive_sidebar_args', [
                'attributes'    => ['class' => 'main-sidebar'], 
                'sidebars'      => [$this->type]
            ] );

            WP_Components\Build::atom( 'sidebar', $args);
        }

    }

}