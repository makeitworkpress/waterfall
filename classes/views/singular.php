<?php
/**
 * Contains the class for initiating a new singular page
 */
namespace Views;
use MakeitWorkPress\WP_Components as WP_Components;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Singular extends Base {

    /**
     * Holds the scheme for a singular post
     * @access public
     */
    public $scheme;

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {

        $this->scheme = apply_filters( 'waterfall_singular_scheme', $this->type == 'post' ? 'itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"' : 'itemscope="itemscope" itemtype="http://schema.org/CreativeWork"' );
        
        $this->properties = apply_filters( 'waterfall_singular_properties', array(
            'layout' => array(
                // Header
                'header_align', 
                'header_author', 
                'header_breadcrumbs', 
                'header_date', 
                'header_disable_title', 
                'header_featured', 
                'header_height',
                'header_height_image',
                'header_parallax', 
                'header_scroll', 
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
                'related_height', 
                'related_image',
                'related_image_enlarge',
                'related_image_float',
                'related_number', 
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
                'footer_share',
                'footer_share_fixed',
                'footer_width',
                // Share
                'share_facebook',
                'share_twitter',
                'share_linkedin',
                'share_google-plus',
                'share_pinterest',
                'share_reddit',
                'share_stumbleupon',
                'share_pocket',
                'share_whatsapp',
            ),
            'meta'  => array(
                'page_header_subtitle'    
            )                                     
        ) );

    }

    /**
     * Displays structured data for single types
     */
    public function structuredData() {

        // This only counts for blog articles
        if( $this->type != 'post' ) {
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
        $args = array(
            'align'     => $this->layout['header_align'] ? $this->layout['header_align'] : 'left',
            'container' => $this->layout['header_width'] == 'full' ? false : true,
            'height'    => $this->layout['header_height'] ? $this->layout['header_height'] : true,
            'lazyload'  => get_theme_option( 'customizer', 'lazyload' ),
            'parallax'  => $this->layout['header_parallax'],
            'style'     => 'main-header entry-header singular-header'
        );    
    
        /**
        * Elements
        */
        if( $this->layout['header_breadcrumbs'] ) {
            $args['atoms']['breadcrumbs'] = array( 'atom' => 'breadcrumbs', 'properties' => array('archive' => false) );  
        }    
        
        // Title
        if( ! $this->layout['header_disable_title'] ) {
            $args['atoms']['title'] = array( 
                'atom' => 'title',
                'properties' => array(
                    'tag' => 'h1', 'style' => 'entry-title', 'schema' => is_single() ? 'name headline' : 'name' 
                )
            );   
        }
        
        // Subtitle  
        if( $this->meta['page_header_subtitle']  ) {
            $args['atoms']['description'] = array( 
                'atom'              => 'description',
                'properties'        => array(
                    'description'   =>  $this->meta['page_header_subtitle'] 
                )
            );
        }
            
        // Time
        if( $this->layout['header_date']  ) {
            $args['atoms']['date'] = array( 'atom' => 'date', 'properties' => array('style' => 'entry-time') );    
        }
    
        // Terms
        if( $this->layout['header_terms']  ) {
            $args['atoms']['termlist'] = array( 'atom' => 'termlist', 'properties' => array('style' => 'entry-meta') );    
        }             
    
        // Featured image
        $featured       = $this->layout['header_featured'] ? $this->layout['header_featured'] : 'after';
        $featuredArgs   = array( 
            'size'      => $this->layout['header_size'] ? $this->layout['header_size'] : 'half-hd', 
            'lazyload'  => get_theme_option( 'customizer', 'lazyload' ) 
        ); 
        
        if( $featured == 'before' ) {
            $args['atoms'] = array( 'image' => array( 'atom' => 'image', 'properties' => $featuredArgs) ) + $args['atoms'];
        } elseif( $featured == 'after' ) {
            $args['atoms']['image'] = array( 'atom' => 'image', 'properties' => $featuredArgs );    
        } elseif( $featured == 'background' ) {
            $args['background'] = get_the_post_thumbnail_url( null, $this->layout['header_size'] );
        }                                             
            
        if( $this->layout['header_author'] ) {
    
            global $post;
    
            $args['atoms']['author'] = array(
                'atom'          => 'author',
                'properties'    => array(
                    'avatar'        => get_avatar($post->post_author, 64),
                    'description'   => false, 
                    'imageFloat'    => 'left', 
                    'prepend'       => __('Article by ', 'waterfall'),
                    'style'         => 'entry-author'
                )
            ); 
        }                                                
        
        // Scroll-button
        if( $this->layout['header_scroll'] == 'default' ) {
            $args['atoms']['scroll'] = array( 'atom' => 'scroll', 'properties' => array( 'icon' => false) );
        } elseif( $this->layout['header_scroll'] == 'arrow' ) {
            $args['atoms']['scroll'] = array( 'atom' => 'scroll', 'properties' => array( 'icon' => 'angle-down') );    
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

        WP_Components\Build::atom( 'content', array('style' => $this->layout['content_readable'] ? 'entry-content readable-content content' : 'entry-content content') );     

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
            WP_Components\Build::atom( 'sidebar', array('sidebars' => array($this->type), 'style' => 'sidebar') );
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
                $query = array( 
                    'post__not_in'      => array($post->ID), 
                    'posts_per_page'    => $this->layout['related_number'] ? $this->layout['related_number'] : 3, 
                    'post_type'         => $post->post_type 
                );
    
                // Include only categories from post
                $categories = get_the_category($post->ID);

                if( $categories ) {
                    foreach($categories as $term) {
                        $query['cat'][] = $term->term_id;     
                    }
                }

                $args = apply_filters('waterfall_related_args', array( 
                    'args'              => $query,
                    'contentAtoms'      => $this->layout['related_content'] == 'none' ? array() : array( 'content' => array( 'atom' => 'content', 'properties' => array('type' => 'excerpt')) ),
                    'footerAtoms'       => array(
                        'button' => array(
                            'atom'          => 'button',
                            'properties'    => array(
                                'iconAfter'     => 'angle-right', 
                                'iconVisible'   => 'hover', 
                                'label'         => $this->layout['related_button'], 
                                'size'          => 'small'
                            )
                        ) 
                    ),
                    'image'             => array( 
                        'link'      => 'post', 
                        'size'      => $this->layout['related_image'] ? $this->layout['related_image'] : 'square-ld', 
                        'enlarge'   => $this->layout['related_image_enlarge'] ? true : false, 
                        'float'     => $this->layout['related_image_float'] ? $this->layout['related_image_float'] : 'none',
                        'lazyload'  => get_theme_option('customizer', 'lazyload') 
                    ),
                    'pagination'        => false,
                    'postsAppear'       => 'bottom',
                    'postsGrid'         => $this->layout['related_grid'] ? $this->layout['related_grid'] : 'third',
                    'postsInlineStyle'  => $this->layout['related_height'] ? 'min-height:' . $this->layout['related_height'] . 'px;' : '',
                    'view'              => $this->layout['related_style'] ? $this->layout['related_style'] : 'grid',
                ) );
                
            // Remove the button if the text is empty
            if( ! $this->layout['related_button'] ) {
                unset( $args['footerAtoms']['button'] );
            }

            // Echo a title above the related posts
            if( $this->layout['related_title'] ) {
                echo '<h3>' .  esc_html( $this->layout['related_title'] ) . '</h3>';
            }
                
            WP_Components\Build::molecule( 'posts', $args );
                                  
        } 
        
        // Pagination
        if( $this->layout['related_pagination'] ) {
            $args = apply_filters('waterfall_related_paginate_args', array( 
                'type' => 'post', 
                'prev' => '<span>' . $this->layout['related_pagination_prev'] . '</span>%title', 
                'next' => '<span>' . $this->layout['related_pagination_next'] . '</span>%title' 
            ) );
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
        $args = array(
            'container' => $this->layout['footer_width'] == 'full' ? false : true,
            'style' => 'main-footer entry-footer singular-footer'
        );
            
        // Sharing Buttons
        if( $this->layout['footer_share'] ) {
            $args['atoms']['share'] = array( 'atom' => 'share', 'properties' => array('fixed' => $this->layout['footer_share_fixed'] ? true : false) );
            $networks = array('facebook', 'twitter', 'linkedin', 'google-plus', 'pinterest', 'reddit', 'stumbleupon', 'pocket', 'whatsapp');
            
            // Networks should be enabled
            foreach( $networks as $network ) {
                if( $this->layout['share_' . $network] ) {
                    $args['atoms']['share']['properties']['enabled'][] = $network;
                }
            }

        }
        
        // Author
        if( $this->layout['footer_author'] ) {
            $args['atoms']['author'] = array( 
                'atom'          => 'author',
                'properties'    => array( 'imageFloat' => 'left', 'style' => 'entry-author' )
            );
        }      
        
        // Comments
        if( $this->layout['footer_comments'] ) {
            $args['atoms']['comments'] = array(
                'atom'          => 'comments',
                'properties'    => array( 'closedText' => $this->layout['footer_comments_closed'] ? $this->layout['footer_comments_closed'] : __('Comments are closed.', 'waterfall') )
            );
        }    
        
        $args = apply_filters( 'waterfall_content_footer_args', $args );
        
        // Our content
        WP_Components\Build::molecule( 'post-footer', $args );        

    }

}