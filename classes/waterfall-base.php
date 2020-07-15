<?php
/**
 * The abstract class template for container classes
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

abstract class Waterfall_Base {
    
    /**
     * The action hooks as passed by the child
     * 
     * @access protected
     */
    protected $actions = []; 
    
    /**
     * The filter hooks as passed by the child
     * 
     * @access protected
     */
    protected $filters = [];

    /**
     * Contains stored metavalues for a given post. Only filled for singular posts at hook level
     *
     * @access private
     */
    protected $meta = [];    
    
    /**
     * The passed options from the DB
     * 
     * @access private
     */
    protected $options = [];
    
    /**
     * Constructor
     * 
     * @param Array $options The options passed to this element
     */
    public function __construct( Array $options = [] ) {   
        
        $this->options = $options;
        
        $this->initialize();

        $this->hook( $this->actions, 'action' );
        $this->hook( $this->filters, 'filter' );
    }

    /**
     *  Child classes should use this function to register their hooks and subsequent actions that should be done on initialization
     */
    abstract protected function initialize();    
    
    /**
     * Executes the action and filter hooks
     */
    private function hook( Array $hooks, $type = 'action' ) {

        foreach( $hooks as $hook ) {

            // Are we accessing an array?
            if( ! is_array($hook) ) {
                continue;
            }

            // Support both numerical as
            foreach( ['hook' => 0, 'method' => 1, 'priority' => 2, 'arguments' => 3] as $argument => $key ) {
                if( isset($hook[$key]) ) {
                    $hook[$argument] = $hook[$key];
                    unset($hook[$key]);
                }
            }

            // Obviously, our action hook and method should be defined.
            if( ! isset($hook['hook']) || ! isset($hook['method']) ) {
                continue;
            }

            // Our method should exist.
            if( ! method_exists($this, $hook['method']) ) {
                continue;
            }

            // Set our default arguments
            $hook['priority']  = isset($hook['priority']) ? $hook['priority'] : 10;
            $hook['arguments'] = isset($hook['arguments']) ? $hook['arguments'] : 1;

            // Execute our action
            if( $type == 'action' ) {
                add_action( $hook['hook'], [$this, $hook['method']], $hook['priority'], $hook['arguments'] );
            } elseif( $type == 'filter' ) {
                add_filter( $hook['hook'], [$this, $hook['method']], $hook['priority'], $hook['arguments'] );   
            }

        }       

    }

}