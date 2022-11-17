<?php
/**
 * The view wrapper for displaying events
 */
namespace Views\Plugins;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class bbPress extends \Views\Base {

    /**
     * a couple of properties are set-up
     */
    protected function set_properties() {

        global $wp_query;

        // Determine our type on rendering 
        if( isset($wp_query->bbp_is_single_user) && $wp_query->bbp_is_single_user ) {
            $this->type = 'user';       
        } elseif( is_singular() ) { 
            global $post;
            $this->type = $post->post_type;
        } else {
            $this->type = 'forum_archive';
        }

        $this->properties = [
            'bbpress' => [
                // Header (for archives and single forums)
                'header',
                'header_breadcrumbs',
                'header_title',
                'header_description',
                'header_search',
                'header_align',
                'header_width',
                'header_height',
                // Sidebars
                'sidebar_position',
                // Private Pages
                'private'
            ]
        ];

    }

    /**
     * Checks if the content can only be shown to logged-in users
     */
    public function isPrivate() {

        // Retrieve properties first
        if( ! isset($this->bbpress) ) {
            $this->get_properties();     
        }
        return (bool) $this->bbpress['private'] && ! is_user_logged_in();

    } 

    /**
     * Checks if the content can only be shown to logged-in users
     */
    public function notifyPrivate() {

        do_action('waterfall_bbpress_private');

        wpc_atom('string', ['string' => apply_filters('bbpress_private_notification', '<p>' . __('Please login to view this page.', 'waterfall') . '</p>')]);

    }     

    /**
     * Displays our header (currently used in the forums archive - the bbPress main page and in the profile page)
     */
    public function header() {

        if( ! in_array($this->type, ['forum_archive', 'user', 'forum', 'topic', 'reply']) ) {
            return;
        }

        // Retrieve our properties for the archive header
        if( ! isset($this->bbpress) ) {
            $this->get_properties();     
        }
     
        // If the archive doesn't have a header, it's disabled...
        if( in_array($this->type, ['forum_archive', 'forum', 'topic', 'reply']) && ! $this->bbpress['header'] ) {
            return;
        }

        // Headers don't display on private users, topics and replies
        if( $this->isPrivate() && in_array($this->type, ['user', 'topic', 'reply']) ) {
            return;
        }       

        if( $this->bbpress['header_breadcrumbs'] ) {
            $atoms['breadcrumbs'] = ['atom' => 'string', 'properties' => ['string' => bbp_get_breadcrumb()] ];    
        }         

        // Switch our arguments atoms
        switch( $this->type ) {
            case 'user':

                if( $this->bbpress['header_title'] ) {
                    $atoms['title'] = [
                        'atom' => 'title', 
                        'properties' => ['tag'=> 'h1', 'title' => esc_html(bbpress()->displayed_user->display_name)]
                    ];    
                }                  
    
                $args = apply_filters( 'waterfall_content_header_args', [
                    'atoms'         => isset($atoms) ? $atoms : [],
                    'attributes'    => ['class' => 'main-header content-header'],
                ] );

                break;

            case 'forum':
            case 'topic':
            case 'reply':
            case 'forum_archive':

                // Default title
                $atoms['title'] = ['atom' => $this->type === 'forum_archive' ? 'archive-title' : 'title', 'properties' => [ 'attributes' => ['class' => 'page-title']]];  
                
                if( $this->bbpress['header_title'] ) {
                    $atoms['title']['properties']['title']              = $this->bbpress['header_title'];
                    $atoms['title']['properties']['types']['default']   = $this->bbpress['header_title'];
                    $atoms['title']['properties']['types']['home']      = $this->bbpress['header_title'];           
                }

                if( $this->bbpress['header_description'] ) {
                    $atoms['description']   = [
                        'atom' => 'description', 
                        'properties' => ['attributes' => ['class' => 'page-description'], 'description' => $this->bbpress['header_description']]
                    ];
                } 
                
                // BBP Search form
                if( $this->bbpress['header_search'] ) {
                    $atoms['search'] = ['atom' => 'string', 'properties' => ['string' => do_shortcode('[bbp-search-form]')] ];    
                }                  
            
                $context = $this->type === 'forum_archive' ? 'archive' : 'content';
                $args = apply_filters( 'waterfall_' . $context . '_header_args', [
                    'atoms'         => $atoms,
                    'attributes'    => ['class' => $this->type === 'forum_archive' ? 'main-header archive-header' : 'main-header singular-header'],
                    'align'         => $this->bbpress['header_align'],
                    'container'     => $this->bbpress['header_width'] === 'full' ? false : true,
                    'height'        => $this->bbpress['header_height']
                ] );                

                break;
        }
        
        wpc_molecule( 'post-header', $args );

    }


    /**
     * Displays the sidebar
     */
    public function sidebar() {

        // If we have a fullwidth lay-out, our sidebar is removed.
        if( ! $this->content_container || $this->disabled('sidebar') ) {
            return;
        }

        // Retrieve our properties for the sidebar
        if( ! isset($this->bbpress) ) {
            $this->get_properties();     
        }
        
        if( $this->bbpress['sidebar_position'] === 'right' || $this->bbpress['sidebar_position'] === 'left' || $this->bbpress['sidebar_position'] === 'bottom' ) {       
            wpc_atom( 'sidebar', ['attributes' => ['class' => 'main-sidebar'], 'sidebars' => [$this->type]] );
        }

    }    

}