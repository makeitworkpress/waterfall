<?php
/**
 * This class loads all theme data from the database
 * From customizer settings to meta settings.
 */
class Waterfall_Data {

    /**
     * Contains the queried database data, for customizer, options and meta values;
     *
     * @access private
     */
    private $data;
    
    /**
     * Determines whether a class has already been instanciated.
     *
     * @access private
     */
    private static $instance = null;  

    
    /**
     * Gets the single instance. Applies Singleton Pattern
     */
    public static function instance() {

        if( self::$instance == null ) {
            self::$instance = new self();
        }

        return self::$instance;

    } 

    /** 
     * Constructor. This allows the class to be only initialized once.
     */
    private function __construct() {
        $this->loadData();
    }       

    /**
     * Retrieves data saved from the Database
     */
    public function getData() {
        return $this->data;
    }          

    /**
     * Loads our theme options and meta values
     */
    private function loadData() {

        // Default values
        $this->data = [
            'meta'          => [],
            'options'       => get_option('waterfall_options'),
        ];

        $mods = get_theme_mods();

        // Customizer values
        foreach( ['colors', 'customizer', 'layout', 'typography', 'woocommerce'] as $key ) {
            $mod = $key == 'woocommerce' ? $key : 'waterfall_' . $key; // Most of the mods have waterfall_ before, execept for woocommerce mods
            $this->data[$key] = isset($mods[$mod]) ? apply_filters( "theme_mod_{$mod}", $mods[$mod]) : apply_filters( "theme_mod_{$mod}", []);
        }

        // Meta values
        add_action('wp', [$this, 'loadMeta']);

    }

    /**
     * Loads metaData for singular posts or pages (hooked to WP)
     */
    public function loadMeta() {

        if( is_singular() ) {
            $this->data['meta'] = get_post_meta( get_the_ID(), 'waterfall_meta', true);
        }
        
    }
    
}