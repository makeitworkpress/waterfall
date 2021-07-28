<?php
/**
 * Displays an in between section with a document, for use in the articles itself
 */
namespace Views\Widgets;
use Elementor as Elementor;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Breadcrumbs extends Elementor\Widget_Base {

	/**
	 * Retrieves the name for the widget
	 *
	 * @return string Widget name
	 */
	public function get_name() {
		return 'waterfall-breadcrumbs';
	}

	/**
	 * Set the custom title for the widget
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Breadcrumbs', 'waterfall' );
    }
    
    /**
	 * Name for the icon used
	 *
	 * @return string Widget icon
     */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

    
    /**
	 * Name for the category used
	 *
	 * @return string Category name
     */	
	public function get_categories() {
		return ['waterfall-widgets'];
	}	
    
	/**
	 * Registers the custom widget controls. 
	 */
	protected function _register_controls() {

        /**
         * Elements
         */
        $this->start_controls_section( 
            'section_elements',
            [
                'label' => esc_html__( 'Settings', 'waterfall' ),
            ]
		);
		
		$this->add_control(
			'home',
			[
				'label'     	=> __( 'Home Text', 'waterfall' ),
				'description'   => __( 'The text for the first breadcrumb.', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::TEXT,
				'default'   	=> __('Home', 'waterfall'),
			]
        ); 
        
		$this->add_control(
			'seperator',
			[
				'label'     	=> __( 'Separator', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::TEXT,
				'default'   	=> __('&rsaquo;', 'waterfall'),
			]
		);         
		
		$this->add_control(
			'archive',
			[
				'label'     	=> __( 'Display Archive', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::SWITCHER,
				'default'   	=> '',
				'label_on'  	=> __( 'Yes', 'waterfall' ),
				'label_off' 	=> __( 'No', 'waterfall' ),
			]
		);	
        
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Text Styling', 'waterfall' ),
				'tab' => Elementor\Controls_Manager::TAB_STYLE,
			]
		);	

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Link Color', 'waterfall' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'separator_color',
			[
				'label' => __( 'Separator Color', 'waterfall' ),
				'type' => Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .atom-breadcrumbs-seperator' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
			]
		);		
		
		$this->end_controls_section();

    }
	
	/**
	 * Renders the output of the widget
	 */
	protected function render() {

		$settings = $this->get_settings();

		/**
		 * Load our breadcrumbs
		 */
		if( function_exists('wpc_atom') ) {

			wpc_atom('breadcrumbs', [
				'attributes'	=> ['class' => 'waterfall-breadcrumbs'],
				'archive'       => $settings['archive'] ? true : false,
				'home'        	=> $settings['home'] ? $settings['home'] : __('Home', 'waterfall'),
				'seperator'     => $settings['seperator'] ? $settings['seperator'] : '&rsaquo'
			]);
		
		}
    
    }

	/**
	 * Render output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	 protected function _content_template() {}
		
	/**
	 * Render  as plain content.
	 *
	 * Override the default render behavior, don't render sidebar content.
	 *
	 * @access public
	 */
	public function render_plain_content() {}

}        