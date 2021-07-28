<?php
/**
 * Displays an in between section with a document, for use in the articles itself
 */
namespace Views\Widgets;
use Elementor as Elementor;

defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

class Terms extends Elementor\Widget_Base {

	/**
	 * Retrieves the name for the widget
	 *
	 * @return string Widget name
	 */
	public function get_name() {
		return 'waterfall-terms';
	}

	/**
	 * Set the custom title for the widget
	 *
	 * @return string Widget title
	 */
	public function get_title() {
		return __( 'Terms', 'waterfall' );
    }
    
    /**
	 * Name for the icon used
	 *
	 * @return string Widget icon
     */
	public function get_icon() {
		return 'eicon-button';
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
                'label' => esc_html__( 'Terms', 'waterfall' ),
            ]
		);

		$taxonomies = get_taxonomies([], 'objects');

		foreach( $taxonomies as $key => $taxonomy ) {
			unset($taxonomies[$key]);
			$taxonomies[$taxonomy->name] = $taxonomy->label;	
		}

		$this->add_control(
			'taxonomy',
			[
				'label'     	=> __( 'Taxonomy', 'waterfall' ),
				'description'   => __( 'The taxonomy to load terms from.', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::SELECT2,
				'default'   	=> '',
				'multiple'		=> false,
				'options'		=> $taxonomies
			]
		);
		
		$this->add_control(
			'empty',
			[
				'label'     	=> __( 'Show Empty Terms', 'waterfall' ),
				'description'   => __( 'Shows terms with no posts attached.', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::SWITCHER,
				'default'   	=> '',
				'label_on'  	=> __( 'Yes', 'waterfall' ),
				'label_off' 	=> __( 'No', 'waterfall' ),
			]
		);		
		
		$this->add_control(
			'before',
			[
				'label'     	=> __( 'Before Text', 'waterfall' ),
				'description'   => __( 'The text before each term.', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::TEXT,
				'default'   	=> '',
			]
        ); 

		$this->add_control(
			'after',
			[
				'label'     	=> __( 'After Text', 'waterfall' ),
				'description'   => __( 'The text after each term.', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::TEXT,
				'default'   	=> '',
			]
        );        
        
		$this->add_control(
			'seperator',
			[
				'label'     	=> __( 'Separator', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::TEXT,
				'default'   	=> '',
			]
		);
        
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Styling', 'waterfall' ),
				'tab' => Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        
		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
			]
		);
		
		$this->add_control(
			'button',
			[
				'label'     	=> __( 'Button Style', 'waterfall' ),
				'type'      	=> Elementor\Controls_Manager::SWITCHER,
				'default'   	=> '',
				'label_on'  	=> __( 'Yes', 'waterfall' ),
				'label_off' 	=> __( 'No', 'waterfall' ),
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'waterfall' ),
				'type' 			=> Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .atom-term' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button[value]!' => ''
				]		
			]
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'waterfall' ),
			]
		);		
		
		$this->add_control(
			'text_color',
			[
				'label' 	=> __( 'Term Text Color', 'waterfall' ),
				'type' 		=> Elementor\Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .atom-term' => 'color: {{VALUE}};',
				]
			]
		);		

		$this->add_control(
			'background_color',
			[
				'label' 	=> __( 'Term Background Color', 'waterfall' ),
				'type' 		=> Elementor\Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .atom-term' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'waterfall' ),
			]
		);		
		
		$this->add_control(
			'text_color_hover',
			[
				'label' 	=> __( 'Term Text Color', 'waterfall' ),
				'type' 		=> Elementor\Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .atom-term:hover' => 'color: {{VALUE}};',
				]
			]
		);		

		$this->add_control(
			'background_color_hover',
			[
				'label' 	=> __( 'Term Background Color', 'waterfall' ),
				'type' 		=> Elementor\Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .atom-term:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();		

		$this->end_controls_tabs();
		
		$this->add_control(
			'separator_color',
			[
				'label' 	=> __( 'Separator Color', 'waterfall' ),
				'type' 		=> Elementor\Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .atom-terms-seperator' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
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

			wpc_atom( 'terms', [
				'attributes'		=> ['class' => 'waterfall-terms'],
				'after'       	=> $settings['after'],
				'args'       		=> ['taxonomy' => $settings['taxonomy'] ? $settings['taxonomy'] : 'post_tag', 'hide_empty' => $settings['empty'] ? false : true],
				'before'       	=> $settings['before'],
				'seperator'     => $settings['seperator'] ? $settings['seperator'] : '',
				'term_style'		=> $settings['button'] ? 'button' : 'normal'
			] );
		
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