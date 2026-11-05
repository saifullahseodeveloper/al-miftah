<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Counter_Box_Two extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-counter-box-two-widget';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Counter Box 02', 'charifund-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-number-field';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories()
    {
        return ['charifund_widgets'];
    }
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Tab Start - 1

		$this->start_controls_section(
			'counter_box',
			[
				'label' => esc_html__( 'Counter Box', 'charifund-core' ),
			]
		);	
		$this->add_control(
			'counter_number',
			[
				'label' => __( 'Number', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Number', 'charifund-core' ),
				'label_block' => true,
				'default' => __( '154859', 'charifund-core' ),
			]
		);
		$this->add_control(
			'counter_prefix',
			[
				'label' => __( 'Prefix', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter prefix', 'charifund-core' ),
				'label_block' => true,
				'default' => __( '+', 'charifund-core' ),
			]
		);
		$this->add_control(
			'counter_title',
			[
				'label' => __( 'Counter Title', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Title', 'charifund-core' ),
				'label_block' => true,
				'default' => __( '', 'charifund-core' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'style_settings_section',
            [
                'label' => esc_html__('Style Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('number_color', [
            'label' => esc_html__('Number Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .pg-four h3" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .pg-four h3',
            ]
        );
		$this->add_control('prefix_color', [
            'label' => esc_html__('Prefix Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .pg-four .txt-base" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .pg-four .text-gr" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .pg-four .text-xl',
            ]
        );

        $this->end_controls_section();

		}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

			<div class="pg-four">
				<div class="counter-four">
					<div class="counter-four__content mt-20">
						<h3 class="hb cnt"><span class="odometer fw-8" data-odometer-final="<?php echo $settings['counter_number']; ?>"></span>
							<?php if($settings['counter_prefix']) : ?>
								<span class="prefix txt-base"><?php echo $settings['counter_prefix']; ?></span>
							<?php endif; ?>
						</h3>
						<?php if($settings['counter_title']) : ?>
							<p class="text-xl fw-5 text-gr mt-10"><?php echo $settings['counter_title']; ?></p>
						<?php endif; ?>
					</div>
				</div> 
			</div>

		<?php 
	}
	
}
Plugin::instance()->widgets_manager->register_widget_type(new Counter_Box_Two());