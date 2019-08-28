<?php
/**
 * Contains the class for initiating a new singular page
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Singular extends Base {

    /**
     * Holds the post types that may receive a BlogPosting microdata schema
     * @access public
     */
    public $blogTypes;    

    /**
     * Holds the social networks for a singular post or page
     * @access public
     */
    public $networks; 
    
    /**
     * Holds the post types for which schemes are disabled
     * @access public
     */
    public $noSchema;      

    /**
     * Holds the primary microdata schema for a singular post or page (that is used in the article tag)
     * @access public
     */
    public $schema;  

    /**
     * Sets the data properties for the index
     */
    protected function setProperties() {

        $this->networks   = apply_filters(
            'waterfall_social_share_networks', 
            ['facebook', 'twitter', 'linkedin', 'pinterest', 'reddit', 'pocket', 'whatsapp']
        );

        $this->properties = apply_filters( 'waterfall_singular_properties', [
            'layout' => [
                // Header
                'header_align', 
                'header_author', 
                'header_breadcrumbs', 
                'header_breadcrumbs_archive',
                'header_breadcrumbs_terms', 
                'header_comments',
                'header_date', 
                'header_disable_title', 
                'header_featured', 
                'header_height',
                'header_height_image',
                'header_parallax', 
                'header_scroll', 
                'header_share',
                'header_size', 
                'header_terms', 
                'header_width', 
                // Content
                'content_readable',
                // Sidebar
                'sidebar_position',
                // Related
                'related_button', 
                'related_content',
                'related_grid', 
                'related_grid_gap', 
                'related_height', 
                'related_image',
                'related_image_enlarge',
                'related_image_float',
                'related_number', 
                'related_none', 
                'related_pagination', 
                'related_pagination_next', 
                'related_pagination_prev', 
                'related_posts', 
                'related_style',
                'related_title',
                'related_width',
                // Footer
                'footer_author',
                'footer_comments',
                'footer_comments_closed',
                'footer_comments_title',
                'footer_comments_reply',
                'footer_share',
                'footer_share_fixed',
                'footer_width',
                // Share
                'share_text',
                'share_facebook',
                'share_twitter',
                'share_linkedin',
                'share_pinterest',
                'share_reddit',
                'share_stumbleupon',
                'share_pocket',
                'share_whatsapp',
            ],
            'meta'  => [
                'page_header_subtitle',
                'page_header_button_text',
                'page_header_button_link'
            ]                                     
        ] );

        // Main Microscheme
        $this->blogTypes    = apply_filters( 'waterfall_blog_scheme_post_types', ['post'] );
        $this->noSchema     = isset($this->options['scheme_post_types_disable']) && $this->options['scheme_post_types_disable'] ? $this->options['scheme_post_types_disable'] : []; 
        $this->schema       = in_array($this->type, $this->blogTypes) ? 'itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"' : 'itemscope="itemscope" itemtype="http://schema.org/CreativeWork"';
        $this->schema       = in_array($this->type, $this->noSchema) ? '' : apply_filters( 'waterfall_singular_schema', $this->schema);

    }

    /**
     * Displays structured data for single types
     */
    public function structuredData() {

        // This only counts for types that may have this kind of microdata
        if( ! in_array($this->type, $this->blogTypes) ) {
            return;
        }

        // If schemes are disabled for this post type, return
        if( in_array($this->type, $this->noSchema) ) {
            return;
        }

        $logo = is_numeric( $this->customizer['logo'] ) ? wp_get_attachment_image_src( $this->customizer['logo'], 'large' ) : get_template_directory_uri() . '/assets/img/waterfall.png';

        ?>
            <span class="components-structured-data" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
                <meta itemprop="name" content="<?php the_author(); ?>">
            </span>
            <span class="components-structured-data" itemprop="publisher" itemscope="itemscope" itemtype="http://schema.org/Organization">
                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
                <meta itemprop="logo" content="<?php echo $logo; ?>">
            </span>                    
            <meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>" />
            <meta itemprop="datePublished" content="<?php the_date('c') ?>" />
            <meta itemprop="dateModified" content="<?php the_modified_date('c') ?>" />        
        <?php 
    }    

    /**
     * Displays the header
     */
    public function header() {

        // Our header is disabled
        if( $this->disabled('header') ) {
            return;
        }

        // Set our layout properties
        $this->getProperties();

        $this->layout['header_height'] = has_post_thumbnail() ? $this->layout['header_height_image'] : $this->layout['header_height'];
     
        /**
        * Default arguments
        */
        $args = [
            'align'         => $this->layout['header_align'] ? $this->layout['header_align'] : 'left',
            'attributes'    => ['class' => 'main-header entry-header singular-header'],
            'container'     => $this->layout['header_width'] == 'full' ? false : true,
            'height'        => $this->layout['header_height'] ? $this->layout['header_height'] : 'quarter',
            'lazyload'      => isset($this->options['optimize']['lazyLoad']) && $this->options['optimize']['lazyLoad'] ? true : false,
            'parallax'      => $this->layout['header_parallax'] ? true : false,
        ];    
    
        /**
         * Elements
         */
        if( $this->layout['header_breadcrumbs'] ) {
            $args['atoms']['breadcrumbs'] = [
                'atom' => 'breadcrumbs', 
                'properties' => ['archive' => $this->layout['header_breadcrumbs_archive'] ? true : false, 'taxonomy' => $this->layout['header_breadcrumbs_terms'] ? true : false]
            ];  
        }    
        
        // Title
        if( ! $this->layout['header_disable_title'] ) {
            $args['atoms']['title'] = [
                'atom'          => 'title',
                'properties'    => [
                    'attributes'    => ['class' => 'entry-title'], 
                    'schema'        => in_array($this->type, $this->noSchema) ? false : true,
                    'tag'           => 'h1'
                ]
            ];   
        }
        
        // Subtitle  
        if( $this->meta['page_header_subtitle']  ) {
            $args['atoms']['description'] = [ 
                'atom'              => 'description',
                'properties'        => [
                    'description'   =>  $this->meta['page_header_subtitle'],
                    'schema'        => in_array($this->type, $this->noSchema) ? false : true
                ]
            ];
        }

        // Button  
        if( $this->meta['page_header_button_text'] && $this->meta['page_header_button_link'] ) {
            $args['atoms']['button'] = [ 
                'atom'              => 'button',
                'properties'        => [
                    'attributes'    => [
                        'href'      => $this->meta['page_header_button_link']
                    ],
                    'background'    => 'default',
                    'label'         =>  $this->meta['page_header_button_text'] 
                ]
            ];
        }        
            
        // Time
        if( $this->layout['header_date'] ) {
            $args['atoms']['date']      = [
                'atom'          => 'date', 
                'properties'    => ['attributes' => ['class' => 'entry-time', 'schema' => in_array($this->type, $this->noSchema) ? false : true]]
            ];    
        }
    
        // Terms
        if( $this->layout['header_terms'] ) {
            $args['atoms']['termlist']  = ['atom' => 'termlist', 'properties' => ['attributes' => ['class' => 'entry-meta'], 'taxonomies' => []]];    
        }
        
        // Comments
        if( $this->layout['header_comments']  ) {
            $comments = get_comments_number();
            $link     = esc_url( get_permalink() . '#respond');
            $args['atoms']['comments']  = [
                'atom' => 'string', 
                'properties' => [
                    'string' => '<div class="entry-meta"><i class="fa fa-comment"></i> <a href="' . $link . '" title="' . __('Respond', 'waterfall') . '">' . sprintf( _n( '%s comment', '%s comments', $comments, 'waterfall' ), $comments ) . '</a></div>'
                ]
            ];    
        }          
    
        // Featured image
        $featured       = $this->layout['header_featured'] ? $this->layout['header_featured'] : 'after';
        $featuredArgs   = [ 
            'lazyload'  => isset($this->options['optimize']['lazyLoad']) && $this->options['optimize']['lazyLoad'] ? true : false,
            'size'      => $this->layout['header_size'] ? $this->layout['header_size'] : 'half-hd', 
            'schema'    => in_array($this->type, $this->noSchema) ? false : true
        ]; 
        
        if( $featured == 'before' ) {
            $args['atoms']          = ['image' => ['atom' => 'image', 'properties' => $featuredArgs]] + $args['atoms'];
        } elseif( $featured == 'after' ) {
            $args['atoms']['image'] = ['atom' => 'image', 'properties' => $featuredArgs];    
        } elseif( $featured == 'background' ) {
            $args['background']     = get_the_post_thumbnail_url( null, $this->layout['header_size'] );
        } 
        
        if( $this->layout['header_share'] ) {
            $args['atoms']['share'] = ['atom' => 'share', 'properties' => ['share' => $this->layout['share_text'] ? $this->layout['share_text'] : __('Share', 'waterfall')]];
            
            // Networks should be enabled
            foreach( $this->networks as $network ) {
                if( $this->layout['share_' . $network] ) {
                    $args['atoms']['share']['properties']['enabled'][] = $network;
                }
            }            
        }
            
        if( $this->layout['header_author'] ) {
    
            global $post;
    
            $args['atoms']['author'] = [
                'atom'          => 'author',
                'properties'    => [
                    'attributes'    => ['class' => 'entry-author'],
                    'avatar'        => get_avatar($post->post_author, 64),
                    'description'   => false, 
                    'imageFloat'    => 'left', 
                    'prepend'       => __('Article by ', 'waterfall'),
                    'schema'        => in_array($this->type, $this->noSchema) ? false : true
                ]
            ]; 
        }                                                
        
        // Scroll-button
        if( $this->layout['header_scroll'] == 'default' ) {
            $args['atoms']['scroll'] = ['atom' => 'scroll', 'properties' => ['icon' => false]];
        } elseif( $this->layout['header_scroll'] == 'arrow' ) {
            $args['atoms']['scroll'] = ['atom' => 'scroll', 'properties' => ['icon' => 'angle-down']];
        }     
        
        $args = apply_filters( 'waterfall_content_header_args', $args );
     
        /**
        * Build our post header with the arguments
        */
        WP_Components\Build::molecule( 'post-header', $args );        

    }

    /**
     * Displays the single post or page content
     */
    public function content() {

        // Set our layout properties
        if( ! isset($this->layout) ) {
            $this->getProperties();  
        }

        $args = apply_filters( 'waterfall_content_content_args', [
            'attributes'    => ['class' => $this->layout['content_readable'] ? 'entry-content readable-content content' : 'entry-content content'],
            'schema'        => in_array($this->type, $this->noSchema) ? false : true,
        ] );

        WP_Components\Build::atom( 'content', $args );     

    }

    /**
     * Displays the grid with sidebar
     */
    public function sidebar() {

        // If we have a fullwidth lay-out, our sidebar is removed.
        if( ! $this->contentContainer || $this->disabled('sidebar') ) {
            return;
        }

        // Retrieve our properties for the sidebar
        if( ! isset($this->layout) ) {
            $this->getProperties();     
        }   
        
        if( $this->layout['sidebar_position'] == 'right' || $this->layout['sidebar_position'] == 'left' || $this->layout['sidebar_position'] == 'bottom' ) {
            $args = apply_filters( 'waterfall_content_sidebar_args', ['attributes' => ['class' => 'main-sidebar'], 'sidebars' => [$this->type]] );            
            WP_Components\Build::atom( 'sidebar', $args );
        }

    }

    /**
     * Displays our related posts section
     */
    public function related() {

        // Our section is disabled
        if( $this->disabled('related') ) {
            return;
        }

        // Set our layout properties for the related section
        if( ! isset($this->layout) ) {
            $this->getProperties();
        }

        /**
         * Display related posts
         */
        if( $this->layout['related_posts'] ) {
    
            global $post;
    
            // Base query
            $query = [
                'post__not_in'      => [$post->ID], 
                'posts_per_page'    => $this->layout['related_number'] ? $this->layout['related_number'] : 3, 
                'post_type'         => $post->post_type 
            ];

            /**
             * This looks for taxonomies/terms attached to the post and loads these based on these terms
             * If ElasticPress is installed on this site, it uses elasticpress to search for posts
             */
            if( function_exists('ep_find_related') ) {
                $query['post__in']      = ep_find_related( $post->ID, $this->layout['related_number'] );
                $query['ep_integrate']  = true;
            } else {
                $taxonomies = get_post_taxonomies( $post );

                if( $taxonomies ) {
                    foreach( $taxonomies as $taxonomy ) {
                        $terms = get_the_terms( $post->ID, $taxonomy );
                        if( $terms ) {
                            $termIDs = [];
                            foreach( $terms as $term ) {
                                $termIDs[] = $term->term_id;   
                            }
                            $query['tax_query'][] = [
                                'taxonomy'  => $taxonomy,
                                'terms'     => $termIDs
                            ];
                        }
                    }
                }

            }         

            $args = apply_filters( 'waterfall_related_args', [
                'attributes'        => ['class' => 'related-posts'],
                'gridGap'           => $this->layout['related_grid_gap'] ? $this->layout['related_grid_gap'] : 'default',
                'none'              => $this->layout['related_none'] ? $this->layout['related_none'] : __('Bummer! No related posts have been found.', 'waterfall'),
                'pagination'        => false,
                'postProperties'    => [
                    'appear'        => 'bottom',
                    'attributes'    => [
                        'style'     => ['min-height' => $this->layout['related_height'] ? $this->layout['related_height'] . 'px' : '']
                    ],
                    'contentAtoms'  => $this->layout['related_content'] == 'none' ? [] : ['content' => ['atom' => 'content', 'properties' => ['type' => 'excerpt']]],
                    'footerAtoms'   => [
                        'button'    => [
                            'atom' => 'button', 'properties' => ['iconAfter' => 'angle-right', 'iconVisible' => 'hover', 'label' => $this->layout['related_button'], 'size' => 'small']
                        ] 
                    ],  
                    'headerAtoms'   => [
                        'title' => [
                            'atom'          => 'title', 
                            'properties'    => [
                                'attributes'    => ['class' => 'entry-title'], 
                                'tag'           => 'h3', 
                                'link'          => 'post' 
                            ] 
                        ] 
                    ],              
                    'grid'          => $this->layout['related_grid'] ? $this->layout['related_grid'] : 'third',
                    'image'         => [ 
                        'enlarge'   => $this->layout['related_image_enlarge'] ? true : false, 
                        'float'     => $this->layout['related_image_float'] ? $this->layout['related_image_float'] : 'none',
                        'lazyload'  => isset($this->options['optimize']['lazyLoad']) && $this->options['optimize']['lazyLoad'] ? true : false,
                        'link'      => 'post', 
                        'size'      => $this->layout['related_image'] ? $this->layout['related_image'] : 'square-ld'                         
                    ]
                ],                
                'queryArgs'         => $query,
                'schema'            => in_array($this->type, $this->noSchema) ? false : true,
                'view'              => $this->layout['related_style'] ? $this->layout['related_style'] : 'grid'
            ] );
                
            // Remove the button if the text is empty
            if( ! $this->layout['related_button'] ) {
                unset( $args['postProperties']['footerAtoms']['button'] );
            }

            // Echo a title above the related posts
            if( $this->layout['related_title'] ) {
                echo '<h2 class="related-title">' .  esc_html( $this->layout['related_title'] ) . '</h2>';
            }
                
            WP_Components\Build::molecule( 'posts', $args );
                                  
        } 
        
        // Pagination
        if( $this->layout['related_pagination'] ) {

            $next = $this->layout['related_pagination_next'] ? $this->layout['related_pagination_next'] : __('Next Article &rsaquo;', 'waterfall');
            $prev = $this->layout['related_pagination_prev'] ? $this->layout['related_pagination_prev'] : __('Previous Article &rsaquo;', 'waterfall');

            $args = apply_filters( 'waterfall_related_paginate_args', [ 
                'next' => '<span>' . $next . '</span>%title', 
                'prev' => '<span>' . $prev . '</span>%title', 
                'type' => 'post'
            ] );
            WP_Components\Build::atom( 'pagination', $args );
        }
    
    }

    public function footer() {
        
        // Our section is disabled
        if( $this->disabled('footer') ) {
            return;
        }

        // Set our layout properties for the footer section
        if( ! isset($this->layout) ) {
            $this->getProperties();
        }
        
        // Default arguments
        $args = [
            'attributes'    => ['class' => 'main-footer entry-footer singular-footer'],
            'container'     => $this->layout['footer_width'] == 'full' ? false : true
        ];
            
        // Sharing Buttons
        if( $this->layout['footer_share'] ) {
            $args['atoms']['share'] = [
                'atom'          => 'share', 
                'properties'    => ['fixed' => $this->layout['footer_share_fixed'] ? true : false, 'share' => $this->layout['share_text'] ? $this->layout['share_text'] : '']
            ];
            
            // Networks should be enabled
            foreach( $this->networks as $network ) {
                if( $this->layout['share_' . $network] ) {
                    $args['atoms']['share']['properties']['enabled'][] = $network;
                }
            }

        }
        
        // Author
        if( $this->layout['footer_author'] ) {
            $args['atoms']['author'] = [ 
                'atom'          => 'author',
                'properties'    => [
                    'attributes'    => ['class' => 'entry-author'], 
                    'imageFloat'    => 'left',
                    'schema'        => in_array($this->type, $this->noSchema) ? false : true,
                ]
            ];
        }      
        
        // Comments
        if( $this->layout['footer_comments'] ) {

            $number = get_comments_number();
            $title  = get_the_title();

            $args['atoms']['comments'] = [
                'atom'          => 'comments',
                'properties'    => [
                    'closedText' => $this->layout['footer_comments_closed'] ? $this->layout['footer_comments_closed'] : __('Comments are closed.', 'waterfall'),
                    'title'      => $this->layout['footer_comments_title'] ? str_replace( ['{number}', '{title}'], [$number, $title], $this->layout['footer_comments_title'] ) : sprintf( 
                        _n( 'One Response to %2$s', '%1$s Responses to %2$s', $number, 'waterfall' ),
                        number_format_i18n( $number ),
                        $title
                    ) 
                ]
            ];

            // Adjust the reply title
            if( $this->layout['footer_comments_reply'] ) {    
                add_filter('comment_form_defaults', function($defaults) {

                    $defaults['title_reply'] = $this->layout['footer_comments_reply'];

                    return $defaults;
                    
                } );
            }
            
        }    
        
        $args = apply_filters( 'waterfall_content_footer_args', $args );
        
        // Our content
        WP_Components\Build::molecule( 'post-footer', $args );        

    }

}