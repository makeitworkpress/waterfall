<?php
/**
 * This class loads all theme data from the database
 * From customizer settings to meta settings.
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Data {
   
    /**
     * Contains the queried database data, for customizer, options and meta values;
     * @access private
     */
    private $data;   
    
    /**
     * Determines whether a class has already been instanciated.
     * @access private
     */
    private static $instance = null;  

    /**
     * Determines if customizer data already has been reloaded
     * @access private
     */
    private static $reloaded_customizer_data = false;        

    /**
     * Gets the single instance. Applies Singleton Pattern
     *
     */
    public static function instance() {

        if( self::$instance === null ) {
            self::$instance = new self();
        }

        return self::$instance;

    } 

    /** 
     * Constructor. This allows the class to be only initialized once.
     */
    private function __construct() {
        $this->load_data();
    }       

    /**
     * Retrieves data saved from the Database
     */
    public function get_data() {
        return $this->data;
    }          

    /**
     * Loads our theme options and meta values
     */
    private function load_data() {

        // Default values
        $this->data = [
            'meta'          => [],
            'options'       => get_option('waterfall_options'),
        ];

        // Customizer data
        $this->load_customizer_data();

        // Meta values
        add_action('wp', [$this, 'load_meta']);

    }

    /**
     * Loads customizer data
     */
    public function load_customizer_data() {

        $mods = get_theme_mods();

        // Customizer values
        foreach( ['colors', 'customizer', 'layout', 'typography', 'woocommerce', 'bbpress'] as $key ) {
            $mod = in_array($key, ['woocommerce', 'bbpress']) ? $key : 'waterfall_' . $key; // Most of the mods have waterfall_ before, except for woocommerce mods
            $this->data[$key] = isset($mods[$mod]) ? apply_filters( "theme_mod_{$mod}", $mods[$mod]) : apply_filters( "theme_mod_{$mod}", []);
        }

    }

    /**
     * Reloads customizer data, which is done so the customizer preview can access it
     * The previewer needs to access data at a later point than theme initialization 
     * (That is the first time data is retrieved is in waterfall.php, using wf_get_data which creates an Waterfall_Data instance)
     * Thus, in some cases we need to reload data later so updates in the customizer are reflected. 
     * That is because customizer live reloads are not 'really' saved if not published.
     */
    public function reload_customizer_data() {

        // We can only reload once
        if( self::$reloaded_customizer_data ) {
            return;
        }

        $this->load_customizer_data();

        self::$reloaded_customizer_data = true;

    }

    /**
     * Loads metaData for singular posts or pages (hooked to WP)
     */
    public function load_meta() {

        if( is_singular() ) {
            $this->data['meta'] = get_post_meta( get_the_ID(), 'waterfall_meta', true);
        }
        
    }
    
}