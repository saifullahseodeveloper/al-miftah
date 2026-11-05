<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Heading_Title_Three extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-heading-title-three-widget';
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
		return esc_html__( 'Heading Title 03', 'charifund-core' );
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
		return 'eicon-flash';
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
			'heading_title',
			[
				'label' => esc_html__( 'Heading Title', 'charifund-core' ),
			]
		);	
		
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style', 'charifund-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => array(
					'style1'   => esc_html__( 'Style One', 'charifund-core' ),
					'style2'   => esc_html__( 'Style Two', 'charifund-core' ),
				),
			]
		);
		
		$this->add_control(
			'sub_title',
			[
				'label'       => __( 'Sub Title', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'charifund-core' ),
			]
		);

		$this->add_control(
			'title_2',
			[
				'label'       => __( 'Title Two', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'charifund-core' ),
			]
		);

		$this->end_controls_section();


		// Section Title Settings ==================
		$this->start_controls_section(
			'section_title_settings',
			[
				'label' => __( 'Section Title Setting', 'charifund-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Show Section Title Control
		$this->add_control(
			'show_section_title',
			[
				'label' => esc_html__( 'Show Section Title', 'charifund-core' ),
				'type'  => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'show' => [
						'title' => esc_html__( 'Show', 'charifund-core' ),
						'icon'  => 'eicon-check-circle',
					],
					'none' => [
						'title' => esc_html__( 'Hide', 'charifund-core' ),
						'icon'  => 'eicon-close-circle',
					],
				],
				'default'   => 'show',
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'display: {{VALUE}} !important',
				],
			]
		);

		// Section Title Alignment Control
		$this->add_control(
			'section_title_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'charifund-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'charifund-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'charifund-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'condition' => [
					'show_section_title' => 'show',
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .heading-three' => 'text-align: {{VALUE}} !important',
				],
			]
		);

		// Section Title Margin Control
		$this->add_control(
			'section_title_margin',
			[
				'label'     => __( 'Margin', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'=> ['px', '%', 'em'],
				'condition' => [
					'show_section_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
				],
			]
		);

		// Section Title Padding Control
		$this->add_control(
			'section_title_padding',
			[
				'label'     => __( 'Padding', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'=> ['px', '%', 'em'],
				'condition' => [
					'show_section_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
				],
			]
		);

		// Typography Control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'section_title_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				'condition' => [
					'show_section_title' => 'show',
				],
				'selector'  => '{{WRAPPER}} h2.title-animation',
			]
		);

		// Section Title Color Control
		$this->add_control(
			'section_title_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_section_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'color: {{VALUE}} !important',
				],
			]
		);

		// Section Title Background Color Control
		$this->add_control(
			'section_title_bg_color',
			[
				'label'     => __( 'Background Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_section_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h2.title-animation' => 'background-color: {{VALUE}} !important',
				],
			]
		);






		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'sub_title_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				'condition' => [
					'show_sub_title' => 'show',
				],
				'selector'  => '{{WRAPPER}} h4.title-animation',
			]
		);

		// Section Title Color Control
		$this->add_control(
			'sub_title_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_sub_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h4.title-animation' => 'color: {{VALUE}} !important',
				],
			]
		);

		// Section Title Background Color Control
		$this->add_control(
			'sub_title_bg_color',
			[
				'label'     => __( 'Background Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_sub_title' => 'show',
				],
				'selectors' => [
					'{{WRAPPER}} h4.title-animation' => 'background-color: {{VALUE}} !important',
				],
			]
		);


		$this->end_controls_section();
		// End of Section Title Setting ==================



	
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
		$allowed_tags = wp_kses_allowed_html('post');
		?>

	
<?php  if ( 'style1' === $settings['style'] ) : ?>

<div class="section__header heading-three p-0 m-0">
    <?php if($settings['sub_title']) : ?>
	    <h4 class="title-animation"><?php echo $settings['sub_title'];?></h4>
	<?php endif; ?>
	<?php if($settings['title']) : ?>
	    <h2 class="title-animation"><?php echo $settings['title'];?></h2>
	<?php endif; ?>
	<?php if($settings['title_2']) : ?>
	    <h2 class="title-animation"><?php echo $settings['title_2'];?></h2>
	<?php endif; ?>
</div>

<?php  elseif ( 'style2' === $settings['style'] ) : ?>

<div class="help p-0 m-0">
	<h2 class="title-animation"><?php echo $settings['title'];?></h2>
</div>

<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Heading_Title_Three());