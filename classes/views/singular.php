<?php
/**
 * Contains the class for initiating a new header
 */
namespace Views;
use WP_Components as WP_Components;

class Singular extends Base {

    /**
     * Sets the properties for the index
     */
    protected function setProperties() {
        $this->properties = apply_filters( array(
            'layout' => array(
                // Header
                'align', 
                'author', 
                'breadcrumbs', 
                'date', 
                'featured', 
                'height',
                'height_image',
                'parallax', 
                'scroll', 
                'size', 
                'terms', 
                // Content
                'readable',
                // Sidebar
                'layout',
                // Related
                // All
                'width'
            ),
            'meta'  => array(
                'page_header_subtitle'    
            )                                     
        ), 'waterfall_singular_properties' );

    }

    /**
     * Displays structured data for single types
     */
     public function structuredData() { ?>
        <span class="components-structured-data" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
            <meta itemprop="name" content="<?php the_author(); ?>">
        </span>
        <span class="components-structured-data" itemprop="publisher" itemscope="itemscope" itemtype="http://schema.org/Person">
            <meta itemprop="name" content="<?php the_author(); ?>">
        </span>                    
        <meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>" />
        <meta itemprop="datePublished" content="<?php the_date('c') ?>" />
        <meta itemprop="dateModified" content="<?php the_modified_date('c') ?>" />        
    <?php }    

    /**
     * Displays the header
     */
    public function header() {

        $this->prefix = '_header_';

        // Set our layout properties
        $this->setProperties();

        $this->layout['height'] = has_post_thumbnail() ? $this->layout['height_image'] : $this->layout['height']; 
     
        /**
        * Default arguments
        */
        $args = array(
            'align'     => $this->layout['align'] ? $this->layout['align'] : 'left',
            'container' => $this->layout['width'] == 'full' ? false : true,
            'height'    => $this->layout['height'] ? $this->layout['height'] : true,
            'lazyload'  => get_theme_option( 'customizer', 'lazyload' ),
            'parallax'  => $this->layout['parallax'],
            'style'     => 'main-header entry-header'
        );    
    
        /**
        * Elements
        */
        if( $this->layout['breadcrumbs'] ) {
            $args['atoms']['breadcrumbs'] = array('archive' => false);  
        }    
        
        // Title
        $args['atoms']['title'] = array( 'tag' => 'h1', 'style' => 'entry-title', 'schema' => is_single() ? 'name headline' : 'name' );   
        
        // Subtitle  
        if( $this->meta['subtitle']  ) {
            $args['atoms']['description'] = array( 'description' =>  $subtitle );
        }
            
        // Time
        if( $this->layout['date']  ) {
            $args['atoms']['date'] = array( 'style' => 'entry-time' );    
        }
    
        // Terms
        if( $this->layout['terms']  ) {
            $args['atoms']['termlist'] = array( 'style' => 'entry-meta' );    
        }             
    
        // Featured image
        $featured       = $this->layout['featured'] ? $this->layout['featured'] : 'after';
        $featuredArgs   = array( 
            'size'      => $this->layout['size'] ? $this->layout['size'] : 'half-hd', 
            'lazyload'  => get_theme_option( 'customizer', 'lazyload' ) 
        ); 
        
        if( $featured == 'before' ) {
            $args['atoms'] = array( 'image' => $featuredArgs ) + $args['atoms'];
        } elseif( $featured == 'after' ) {
            $args['atoms']['image'] = $featuredArgs;    
        } elseif( $featured == 'background' ) {
            $args['background'] = get_the_post_thumbnail_url( null, 'hd' );
        }                                             
            
        if( $this->layout['author'] ) {
    
            global $post;
    
            $args['atoms']['author'] = array(
                'avatar'        => get_avatar($post->post_author, 64),
                'description'   => false, 
                'imageFloat'    => 'left', 
                'prepend'       => __('Article by ', 'waterfall'),
                'style'         => 'entry-author'
            ); 
        }                                                
        
        // Scroll-button
        if( $this->layout['scroll'] == 'default' ) {
            $args['atoms']['scroll'] = array('icon' => false);
        } elseif( $this->layout['scroll'] == 'arrow' ) {
            $args['atoms']['scroll'] = array('icon' => 'angle-down');    
        }     
        
        $args = apply_filters( 'waterfall_content_header_args', $args );
     
        /**
        * Build our post header with the arguments
        */
        WP_Components\Build::molecule( 'post-header', $args );        

    }

    /**
     * Displays the grid with posts
     */
    public function content() {
        $this->prefix = '_content_';

        // Set our layout properties
        $this->setProperties();        

        WP_Components\Build::atom( 'content', array('style' => $this->layout['readable'] ? 'entry-content readable-content content' : 'entry-content content') );     

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

    /**
     * Displays our related posts section
     */
    public function related() {

    }

}