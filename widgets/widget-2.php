<?php

namespace Custom_Widget\ElementorWidgets\Widgets;

use Elementor\Widget_Base;

/**
 * Have the widget code for the Custom Elementor Widget.
 */

class Widget_2 extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );
    }

    public function get_style_depends() {
        return ['custom-widget-css'];
    }

    public function get_script_depends() {
        return ['custom-widget-js'];
    }
    
    public function get_name() {
        return 'custom-widget-2'; 
    }

    public function get_title() {
        return __( 'Widget 2', 'custom-elementor-react-addon' );
    }

    public function get_icon() {
        return 'eicon-edit';
    }

    public function get_categories() {
        return ['custom-category'];
    }

    public function register_controls() {
        $this->start_controls_section(
            'menu_selection',
            [
                'label' => __( 'Menu Selection', 'custom-elementor-react-addon' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
          'widget_title',
          [
            'label' => esc_html__( 'Title', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'Default title', 'textdomain' ),
            'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
          ]
        );

        $this->end_controls_section();

        // If we need to add a style section. Uncomment this.
        $this->start_controls_section(
            'menu_selection_style',
            [
                'label' => __( 'Menu Style', 'custom-elementor-react-addon' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __( 'Background Color', 'custom-elementor-react-addon' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-widget-2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    

    // front end.
    protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['widget_title'] ) ) {
			return;
		}
        $data = [
            'title' => $settings['widget_title'],
        ];
		
		echo '<div class="custom-widget-2" data-settings="' . esc_attr(json_encode($data)) . '"></div>';
		
	}

  protected function content_template() {
    ?>
    <#
    const data = {
      title: settings.widget_title,
    };
    const jsonData = JSON.stringify(data);
    #>
    <div class="custom-widget-2" data-settings="{{ jsonData }}"></div>
    <?php
  }
}
