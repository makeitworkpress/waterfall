<?php
/**
 * Class wrapper for enqueing scripts and styles
 *
 * @author Michiel Tramper - https://michieltramper.com & https://www.makeitworkpress.com
 */
namespace MakeitWorkPress\WP_Enqueue;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Enqueue {

    /**
     * The array containing all assets
     * 
     * @var array 
     * @access public
     */
    public $assets;

    /**
     * Set the initial state of the class
     *
     * @param array $assets The array with the assets, namely scripts or styles, to be enqueued
     */
    public function __construct( array $assets = [] ) {
        $this->assets = $assets;
        $this->examine();
        $this->enqueue();
    }
    
    /**
     * Enqueues our scripts and styles, but only if we have them set.
     */
    private function enqueue(): void {
        
        if( isset($this->front_assets) ) {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_front_assets'], 20);    
        }
        
        if( isset($this->admin_assets) ) {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets'], 20, 1);    
        }
        
        if( isset($this->login_assets) ) {
            add_action('login_enqueue_scripts', [$this, 'enqueue_login_assets'], 20);    
        }

        if( isset($this->block_editor_assets) ) {
            add_action('enqueue_block_editor_assets', [$this, 'enqueue_block_editor_assets'], 20); 
        }

        if( isset($this->block_assets) ) {
            add_action('enqueue_block_assets', [$this, 'enqueue_block_assets'], 20);
        }        
        
    }
    
    /**
     * Examines the array of assets and formalize their properties
     */
    private function examine(): void {
        
        foreach( $this->assets as $asset ) {
            
            // Default values for each of the assets
            $defaults = array(
                'action'    => 'enqueue',   // The default action. Accepts enqueue, dequeue and register.
                'context'   => '',          // The context, in other words where to enqueue. Accepts admin, both and login. Defaults to front-end.
                'deps'      => array(),     // Dependencies for the script.
                'bare'      => false,       // If we only need to enqueue the script or style without any arguments (a bare action)
                'exclude'   => '',          // To exclude an asset somewhere. Accepts page names for admin, or conditionals such as array(is_page, id) for front-end.
                'include'   => '',          // To include an asset somewhere. Accepts page names for admin, or conditionals such as array(is_page, id) for front-end.
                'in_footer' => true,        // Whether to enqueue the script in the footer or not
                'localize'  => array(),     // If we need to add localized variables to our script
                'media'     => 'all',       // The media for which the style is
                'name'      => '',          // The object name that is used for localizing scripts
                'type'      => '',          // Enfore type of style or script. The script automatically looks to the suffix, but some sources do not have a .js or.css suffix.
                'ver'       => false        // Whether to include the version or not
            );
            
            $asset  = wp_parse_args($asset, $defaults); // Parse arguments
            $type   = substr($asset['src'], -2, 2);     // Check if we have a .js extension. A little bit dirty, but it works.
            
            // Determine the type and action based upon their type.
            if( ! $asset['type'] || ! in_array( $asset['type'], ['script', 'style'] ) ) {
                $asset['type']  = $type == 'js' ? 'script' : 'style';
            }
            $asset['function']  = 'wp_' . $asset['action'] . '_' . $asset['type'];
            $asset['mix']       = $type == 'js' ? $asset['in_footer'] : $asset['media'];
                
            // Add the assets to their context
            if( $asset['context'] == 'admin' || $asset['context'] == 'both' ) {
                $this->admin_assets[]   = $asset;      
            } elseif( $asset['context'] == 'block-editor' ) {
                $this->block_editor_assets[] = $asset;
            } elseif( $asset['context'] == 'block-assets' ) {
                $this->block_assets[]   = $asset;
            } elseif( $asset['context'] == 'login' ) {
                $this->login_assets[]   = $asset;    
            } else {
                $this->front_assets[]   = $asset;    
            }   
        
        }
        
    }
    
    /**
     * Enqueues the front-end scripts and styles
     */
    public function enqueue_front_assets(): void {
        
        foreach( $this->front_assets as $asset ) {
            
            // Set actions
            $include = is_array($asset['include']) ? $asset['include'][0] : $asset['include']; 

            // If we are not on a page where it should be included
            if( $include && ! call_user_func_array($include, array( isset($asset['include'][1]) ? $asset['include'][1] : '' )) ) {
                continue;
            }
            
            $exclude = is_array($asset['exclude']) ? $asset['exclude'][0] : $asset['exclude']; 
            
            // If we are on a page where an asset should be excluded
            if( $exclude && call_user_func_array($exclude, array( isset($asset['exclude'][1]) ? $asset['exclude'][1] : '' )) ) {
                continue;
            }             
            
            $this->action($asset);
        }
        
    }
    
    /**
     * Enqueues the admin scripts and styles
     * 
     * @param string $hook The current admin screen we are viewing, such as index.php or edit.php
     */
    public function enqueue_admin_assets( string $hook ): void {
        
        foreach( $this->admin_assets as $asset ) {
            
            // If we are not on a page where it should be included
            if( $asset['include'] && ! in_array($hook, $asset['include']) ) {
                continue;
            }
            
            // If we are on a page where an asset should be excluded
            if( $asset['exclude'] && in_array($hook, $asset['exclude']) ) {
                continue;
            }            
            
            $this->action($asset); 
            
        }
        
    } 
    
    /**
     * Enqueues the login scripts and styles
     */
    public function enqueue_login_assets(): void {
        
        foreach( $this->login_assets as $asset ) {
            
            $this->action($asset); 
            
        }
        
    } 

    /**
     * Enqueues the block editor scripts and styles
     */
    public function enqueue_block_editor_assets(): void {   
        foreach( $this->block_editor_assets as $asset ) {  
            $this->action($asset);  
        }  
    }
    
    /**
     * Enqueues the block scripts and styles
     */
    public function enqueue_block_assets(): void {   
        foreach( $this->block_assets as $asset ) {  
            $this->action($asset);  
        }
    }     
    
    /**
     * Executes the action itself
     *
     * @param array $asset The asset with the properties
     */
    private function action(array $asset): void {
        
        // Enqueing, registering and dequeing.
        if( $asset['action'] == 'dequeue' || $asset['bare'] ) {
            $asset['function']( $asset['handle'] );    
        } else {
            $asset['function']( $asset['handle'], $asset['src'], $asset['deps'], $asset['ver'], $asset['mix'] ); 
        } 
        
        // Localizing scripts
        if( $asset['type'] == 'script' && $asset['localize'] && $asset['name'] ) {
            wp_localize_script( $asset['handle'], $asset['name'], $asset['localize'] );    
        }
        
    }

}