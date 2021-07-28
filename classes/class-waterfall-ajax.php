<?php
/**
 * Contains all functionalities which determine the display of this theme
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Ajax {

    /**
     * Contains our private actions
     * @access private;
     */
    private $private;

    /**
     * Contains our public actions
     * @access private;
     */ 
    private $public;  
    
    /**
     * Determines if we are syncing
     * @access public;
     */ 
    public $syncing = false;     
    
    /**
     * Constructor
     */
    public function __construct() {
        
        $this->private = ['sync_multisite_options'];
        $this->public = [];
                
        // Execute our hooks
        $this->hook();   
        
    }

    /**
     * Executes our hooked ajax actions
     */
    private function hook() {

        // Private actions
        foreach( $this->private as $action ) {

            if( ! method_exists($this, $action) ) {
                continue;
            }

            add_action( 'wp_ajax_' . $action, [$this, $action] );

        }

        // Public action
        foreach( $this->public as $action ) {

            if( ! method_exists($this, $action) ) {
                continue;
            }

            add_action( 'wp_ajax_nopriv_' . $action, [$this, $action] );

        }  

        /** 
         * The sanitize_option filter strips out the values of our options while synchronizing 
         * because we have a custom hook in our register_settings at WP Custom Fields. Hence, we need to filter it out.
         */
        $current_theme   = get_option( 'stylesheet' );
        
        foreach( ['waterfall_options', 'theme_mods_' . $current_theme] as $option ) {

            add_filter( 'sanitize_option_' . $option, function( $value, $option, $original ) {

                // Only apply for ajax actions and if we are doing the sync action
                if( wp_doing_ajax() && $this->syncing ) {
                    return $original;
                }

                return $value;

            }, 20, 3 );
        
        }

    }

    /**
     * Syncs our settings over multiple sites in the network - taking the current site as a measure.
     */
    public function sync_multisite_options() {

        wp_verify_nonce( 'wp-custom-fields', $_POST['action'] );

        if( ! is_multisite() ) {
            wp_send_json_error( __('This site is not a multisite!', 'waterfall') );
        }

        // We are syncing
        $this->syncing  = true;
 
        $current        = get_current_blog_id();
        $current_theme  = get_option( 'stylesheet' );
        $sites          = get_sites( ['fields' => 'ids'] );

        $customizer     = get_option( 'theme_mods_' . $current_theme );
        $options        = get_option( 'waterfall_options' );

        foreach( $sites as $site ) {

            $theme = get_blog_option( $site, 'stylesheet' );

            // Only update options for sites that have the same theme activated
            if( $current_theme !== $theme ) {
                continue;
            }

            // Skip our current site
            if( $current === $site ) {
                continue;
            }
            
            // Update!
            update_blog_option( $site, 'waterfall_options', $options );
            update_blog_option( $site, 'theme_mods_' . $theme, $customizer );
   
        }

        // Reset that we are syncing
        $this->syncing  = false;

        wp_send_json_success( __('Succesfully synced the options for each site in the network', 'waterfall') );

    }
    
}