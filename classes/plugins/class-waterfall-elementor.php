<?php
/**
 * Registers our custom elementor widgets
 */
namespace Plugins;
use Elementor as Elementor;
use Waterfall_Base as Waterfall_Base;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Waterfall_Elementor extends Waterfall_Base {

    /**
     * Remembers if we're saving in Elementor
     */
    private $saving_in_elementor = false;

    /**
     * Contains shared fields between elementor and Waterfall meta
     */
    private $shared_meta = [];

    /**
     * Contains the class references to our custom widgets
     * @access private
     */
    private $widgets;

    /**
     * Initializes the class
     * 
     * @return void
     */
    public function initialize() {

        // Passed on from the inherited parent class
        $this->widgets = $this->options['elementor'];

        // Set our shared meta fields
        $this->set_shared_meta();

        // Filter hooks
        $this->filters = [
            ['template_include', 'load_header_footer', 20]
        ];

        // Filter actions
        $this->actions = [
            ['elementor/editor/after_enqueue_scripts', 'enqueue_editor_scripts'],
            ['save_post', 'save_waterfall_meta', 15],
            ['elementor/editor/after_save', 'save_elementor_meta', 10, 2],
            ['elementor/theme/register_locations', 'support_theme_builder'],
            ['elementor/documents/register_controls', 'register_document_controls'],
        ];

        // Extra actions if we have widgets
        if( $this->widgets ) {
            $this->actions[] = ['elementor/elements/categories_registered', 'register_widget_categories'];
            $this->actions[] = ['elementor/widgets/widgets_registered', 'register_widgets'];   
        }

    }

    /**
     * Enqueues our custom editor scripts
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script('waterfall-elementor', get_template_directory_uri() . '/assets/js/plugins/waterfall-elementor-editor.js');  
    }

    /**
     * Sets the shared post meta between Waterfall and Elementor
     * 
     * @return void
     */
    private function set_shared_meta() {

        $meta = [
            'content_width', 
            'header_disable', 
            'transparent_header', 
            'content_header_disable', 
            'content_sidebar_disable', 
            'content_related_disable', 
            'content_footer_disable', 
            'footer_disable'
        ];
        $fields = isset($this->options['options']['post_meta']['fields']['sections']['layout']['fields']) && $this->options['options']['post_meta']['fields']['sections']['layout']['fields'] ? $this->options['options']['post_meta']['fields']['sections']['layout']['fields'] : [];

        foreach($fields as $field ) {
            if( ! in_array($field['id'], $meta) ) {
                continue;
            }

            $this->shared_meta[$field['id']] = [
                'label' => $field['title'],
                'description' => $field['description']
            ];
        }
    }   

    /**
     * Automatically save the meta in the elementor settings field if we save from Elementor
     * 
     * @param int $post_id The post id for the saved post
     * @return void
     */
    public function save_waterfall_meta($post_id) {

        // This hook is also triggered when elementor saves, so ignores it
        if( $this->saving_in_elementor || (isset($_POST['action']) && $_POST['action'] === 'elementor_ajax' ) ) {
            return;
        }

        $post_type = get_post_type($post_id);

        // Post types should match these supported by Elementor
        $elementor_post_types = get_option('elementor_cpt_support');
        if( ! $elementor_post_types || (is_array($elementor_post_types) && ! in_array($post_type, $elementor_post_types)) ) {
            return;
        }

        // And those supported by Waterfall
        $waterfall_post_types = array_keys( wf_get_post_types(true) );
        if( ! in_array($post_type, $waterfall_post_types) ) {
            return;
        }

        $this->save_page_settings_meta($post_id, 'waterfall_meta', '_elementor_page_settings');

    }    

    /**
     * Automatically saves the waterfall meta if we save some values within elementor
     * 
     * @param int $post_id The post id for the saved post
     * @param array $editor_data The array of editor elements
     * @return void
     */
    public function save_elementor_meta($post_id, $editor_data) {
        $this->saving_in_elementor = true;
        $this->save_page_settings_meta($post_id, '_elementor_page_settings', 'waterfall_meta');
    }

    /**
     * Helper function that helps to switch post meta between waterfall and elementor
     * 
     * @param int $post_id The post id to save for
     * @param string $origin The origin to get the meta values from
     * @param string $target The destination to set the meta value for
     * @return void
     */
    public function save_page_settings_meta($post_id, $origin, $target) {

        // This can only be executed with the right capabilities
        if( ! current_user_can('edit_posts') || ! current_user_can('edit_pages') ) {
            return;
        }  
        
        $origin_post_meta = (array) maybe_unserialize( get_post_meta($post_id, $origin, true) );
        $updated_meta = [];

        foreach( $this->shared_meta as $meta_key => $values ) {
            if( isset($origin_post_meta[$meta_key]) && $origin_post_meta[$meta_key] && ! is_array($origin_post_meta[$meta_key]) ) {
                $updated_meta[$meta_key] = $target === 'waterfall_meta' ? true : 'yes';
            } else {
                $updated_meta[$meta_key] = $target === 'waterfall_meta' ? false : '';
            }
        }
        
        $target_meta = (array) maybe_unserialize( get_post_meta($post_id, $target, true) );
        foreach($updated_meta as $key => $value) {
            $target_meta[$key] = $value;   
        }

        update_post_meta($post_id, $target, $target_meta);        

    }


    /**
     * Indicates that this theme supports Elementor
     * 
     * @param Object $elementor_theme_manager The Elements Theme Manager object
     * @return void
     */
    public function support_theme_builder($elementor_theme_manager) {
        $elementor_theme_manager->register_all_core_location();
    }

    /**
     * Add additional settings to the elementor document settings
     * 
     * @param \Elementor\Core\DocumentTypes\PageBase $document The PageBase document instance.
     * @return void
     */
    public function register_document_controls( $document ) {

        if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) ) {
            return;
        }

        $document->start_controls_section(
            'waterfall_settings',
            [
                'label' => __( 'Layout Settings', 'waterfall' ),
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
            ]
        );

        $document->add_control(
            'waterfall_settings_description',
            [
                'type'          => \Elementor\Controls_Manager::RAW_HTML,
                'raw'           => '<div class="elementor-control-field-description">' . __('Elementor Settings for the Waterfall theme. If disabled sections do not-reappear, reload the editor after saving.', 'waterfall') . '</div>',
                'separator'     => 'after'
            ]
        );           

        foreach( $this->shared_meta as $meta_key => $values ) {
            $document->add_control(
                $meta_key,
                [
                    'label'         => $values['label'],
                    'type'          => \Elementor\Controls_Manager::SWITCHER,
                    'description'   => $values['description']
                ]
            );         
        }
    
        $document->end_controls_section();        

    }

    /**
     * Prevent elementor inserting weird header and footer templates, but use the ones from waterfall instead
     * 
     * @param String $template The template being included
     * @return String $template The string to the template file returned
     */
    public function load_header_footer(string $template) {

        /**
         * We need to overwrite the elementor basic template display with our own, so the correct
         * header and footer is rendered for the theme builder templates.
         */
        if( strpos($template, 'elementor/modules/page-templates/templates/header-footer.php') ) {
            
            $template = '/templates/elementor/header-footer.php';
            
            // Check if our file exists
            if ( file_exists( get_stylesheet_directory() . $template ) ) {
                $template = get_stylesheet_directory() . $template;
            } elseif ( file_exists( get_template_directory() . $template ) ) {
                $template = get_template_directory() . $template;
            }

        }

        return $template;

    }

    /**
     * Registers custom widget categories for elementor
     * 
     * @param \Elementor\Elements_Manager $elements_manager The Elements Manager object
     * @return void
     */
    public function register_widget_categories($elements_manager) {
            
        $elements_manager->add_category(
            'waterfall-widgets',
            [
                'title' => __( 'Waterfall', 'waterfall' ),
                'icon' => 'fa fa-plug',
            ]
        );

    }

    /**
     * Registers our new widgets
     * 
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     * @return void
     */
    public function register_widgets( $widgets_manager ) {
      
        foreach( $this->widgets as $widget ) {

            if( ! class_exists($widget) ) {
                continue;
            }
            
            $widgets_manager->register( new $widget() );

        }

    }

}