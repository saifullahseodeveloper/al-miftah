<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Theme_Button_two extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-theme-button-two-widget';
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
		return esc_html__( 'Theme Button 02', 'charifund-core' );
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
			'theme_button',
			[
				'label' => esc_html__( 'Theme Button', 'charifund-core' ),
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
					'style3'   => esc_html__( 'Style Three', 'charifund-core' ),
					'style4'   => esc_html__( 'Style Four', 'charifund-core' ),
					'style5'   => esc_html__( 'Style Five', 'charifund-core' ),
					'style6'   => esc_html__( 'Style Six', 'charifund-core' ),
					'style7'   => esc_html__( 'Style Seven', 'charifund-core' ),
					'style8'   => esc_html__( 'Slide Button', 'charifund-core' ),
				),
			]
		);
		
		$this->add_control(
			'button',
			[
				'label'       => __( 'Button', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your button text', 'charifund-core' ),
				'default' => esc_html__('Read More', 'charifund-core'),
			]
		);	

		$this->add_control(
			'button_link',
			[
			  'label' => __( 'Button Url', 'charifund-core' ),
			  'type' => Controls_Manager::URL,
			  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
			  'show_external' => true,
			  'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
			],
		   ]
		);
		$this->end_controls_section();

		//style tab start
        $this->start_controls_section(
            'styling_section',
            [
                'label' => __('Styling Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'charifund-core'),
                'selector' => '{{WRAPPER}} .btn--primary',
            ]
        );
         $this->add_control('color', [
            'label' => __('Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} a.btn--primary" => "color: {{VALUE}}",
            ]
        ]);
        $this->add_control('bg__color', [
            'label' => __('Bg Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .btn--primary" => "background-color: {{VALUE}}",
                "{{WRAPPER}} .btn--primary::before" => "background-color: {{VALUE}} !important",
                "{{WRAPPER}} .btn--primary::after" => "background-color: {{VALUE}} !important"
            ]
        ]);
         $this->add_control('bg_hover_color', [
            'label' => __('Bg hover Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .btn--primary:hover" => "background-color: {{VALUE}}",
            ]
        ]);
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
		$allowed_tags = wp_kses_allowed_html('post');
		?>

	
<?php  if ( 'style1' === $settings['style'] ) : ?>

	<div class="section__cta one">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php  elseif ( 'style2' === $settings['style'] ) : ?>

	<div class="section__cta two">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php  elseif ( 'style3' === $settings['style'] ) : ?>

    <div class="section__cta three">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php  elseif ( 'style4' === $settings['style'] ) : ?>

    <div class="section__cta four">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php  elseif ( 'style5' === $settings['style'] ) : ?>

    <div class="button_five">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn-primary"> <span><i class="fa-solid fa-arrow-right"></i></span><?php echo $settings['button'];?></a>
	</div>

<?php elseif ( 'style6' === $settings['style'] ) : ?>

    <div class="section__cta six">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php elseif ( 'style7' === $settings['style'] ) : ?>

    <div class="section__cta seven">
		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?>
		<i class="fa-solid fa-arrow-right"></i></a>
	</div>

<?php elseif ( 'style8' === $settings['style'] ) : ?>

    <div class="cause home-14 p-0 m-0 bg-transparent">
    	<div class="slider-navigation">
    	<button type="button" aria-label="prev slide" title="prev slide"
    		class="prev-cause slider-btn">
    	    <i class="fa-solid fa-arrow-left"></i>
    	</button>
    	<button type="button" aria-label="next slide" title="next slide"
    		class="next-cause slider-btn slider-btn-next">
    	<i class="fa-solid fa-arrow-right"></i>
    	</button>
    	</div>
    </div>

<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Theme_Button_two());