<?php 
/** 
 * This class is responsible for controlling the display of metaboxes
 * 
 * @author Michiel
 * @since 1.0.0
 */
namespace WP_Custom_Fields;

// Bail if accessed directly
if ( ! defined( 'ABSPATH' ) ) 
    die;

class Meta {
    
    /**
     * Use our validation functions
     */
    use Validate;
    
    /**
     * Contains the $metaBox array for each of the option pages
     */
    public $metaBox;
    
    /**
     * Constructor
     *
     * @param array $group The array with settings, sections and fields
     */    
    public function __construct( $group = array() ) {
        $this->metaBox  = $group;
        $this->type     = isset( $this->metaBox['type'] ) ? $this->metaBox['type'] : 'post';
        $this->registerHooks();
    }   
    
    /**
     * Register WordPress Hooks
     */
    protected function registerHooks() {
        
        // Post type metabox
        if( $this->type == 'post' ) {
            add_action( 'add_meta_boxes', array($this, 'add') );
            add_action( 'save_post', array($this, 'save'), 10, 1 );
        }
        
        // Taxonomy metabox
        if( $this->type == 'taxonomy' && isset($this->metaBox['taxonomy']) ) {
            add_action( $this->metaBox['taxonomy'] . '_edit_form_fields', array($this, 'add') );
            add_action( 'edited_' . $this->metaBox['taxonomy'], array($this, 'save'), 10, 1 );            
        }
      
    }
    
    /**
     * Adds the specific metaboxes to a certain post or any other type
     */    
    public function add() {
        
        // We should have an id
        if( ! isset($this->metaBox['id']) )
            return;
        
        // Post type metabox
        if( $this->type == 'post' ) {
            add_meta_box( 
                $this->metaBox['id'], 
                $this->metaBox['title'], 
                array( $this, 'render' ), 
                $this->metaBox['screen'], 
                $this->metaBox['context'], 
                $this->metaBox['priority']
            );
        }
        
    }
    
    /**
     * Callback for rendering the specific metaboxes, using any of the specified classes.
     *
     * @param object    $object     The post, term or user object for the current post type
     */
    public function render( $object ) {

        $values                 = get_metadata( $this->type,  $object->ID, $this->metaBox['id'], true );
        
        $frame                  = new Frame( $this->metaBox, $values );
        $frame->settingsFields  = wp_nonce_field( 'wp-custom-fields-metaboxes-' . $frame->id, 'wp-custom-fields-metaboxes-nonce-' . $frame->id, true, false );
        
        // Render our output
        $frame->render();
        
        return;
        
    }
    
    /**
     * Callback for saving the specific metaboxes
     *
     * @param int $id The id for the current object we are saving
     */      
    public function save( $id ) {

        // Do not save on autosaves
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return $id; 
        
        // Some pages do not have the nonce
        if( ! isset($_POST['wp-custom-fields-metaboxes-nonce-' . $this->metaBox['id']]) )
            return $id;

        // Check our user capabilities
        if ( ! current_user_can( 'edit_posts', $id ) || ! current_user_can( 'edit_page', $id ) )
            return $id;
         
        // Check our nonces
        if ( ! wp_verify_nonce( $_POST['wp-custom-fields-metaboxes-nonce-' . $this->metaBox['id']], 'wp-custom-fields-metaboxes-' . $this->metaBox['id'] ) ) 
            return $id;
        
        // Retrieve our current meta values
        $current    = get_metadata( $this->type, $id, $this->metaBox['id'], true ); 
        $output     = Validate::format( $this->metaBox, $_POST );
        
        // Return if nothing has changed
        if( $current == $output )
            return;
        
        // Delete metadata if the output is empty
        if( empty($output) ) {
            delete_metadata( $this->type, $id, $this->metaBox['id']);
            return;
        } 
        
        // Update meta data
        update_metadata( $this->type, $id, $this->metaBox['id'], $output);     
        
    }
    
}