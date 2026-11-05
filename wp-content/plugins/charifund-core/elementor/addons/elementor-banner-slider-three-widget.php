<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Banner_Slider_Three extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-banner-slider-three-widget';
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
		return esc_html__( 'Banner Slider 3', 'charifund-core' );
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
			'banner_slider',
			[
				'label' => esc_html__( 'Banner Slider', 'charifund-core' ),
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


		$this->add_control(
            'show_button',
            [
                'label' => __( 'Show / Hide Button One', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'charifund-core' ),
                'label_off' => __( 'Hide', 'charifund-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'Read More', 'educharifundall-core' ),
                'label_block' => true,
                'default' => __( 'Check Our Causes', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'button_url',
            [
                'label' => __( 'Button Link', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'Enter Your Link Here', 'charifund-core' ),
            ]
        );

       


		$this->end_controls_section();

		// Tab Start - 2

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Block', 'charifund-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
		  'repeat', 
			[
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => 
					[
						['block_title' => esc_html__('Hello World', 'charifund-core')],
					],
					
					'fields' => 
					[	

						'slider_image' =>
						[
							'name' => 'slider_image',
							'label' => __( 'Slider Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],

							
						
					],
				'title_field' => '{{block_title}}',
			]
	);
		
		
	$this->end_controls_section();

	$this->start_controls_section(
			'banner_settings',
			[
				'label' => __( 'Banner Setting', 'charifund-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


	$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				
				'selector'  => '{{WRAPPER}} .banner-seven-wrapper .banner-seven-content h1',
			]
		);

		// Section Title Color Control
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .banner-seven-wrapper .banner-seven-content h1' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'paragraph_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				
				'selector'  => '{{WRAPPER}} .banner-seven-wrapper .banner-seven-descri p.banner-seven-paragraph',
			]
		);

		// Section Title Color Control
		$this->add_control(
			'paragraph_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .banner-seven-wrapper .banner-seven-descri p.banner-seven-paragraph' => 'color: {{VALUE}} !important',
				],
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
		$allowed_tags = wp_kses_allowed_html('post');
		echo '
		<script>
			jQuery(document).ready(function($) {
				var bannerOne = new Swiper(".banner-seven-active", {
					slidesPerView: 1.4,
		      spaceBetween: 20,
		      loop: true,
		      speed: 7000,
		      allowTouchMove: false,
		      autoplay: {
		        delay: 1,
		        disableOnInteraction: true,
		      },
		     


					});

						
			});
		</script>';
	?>

	<?php  if ( 'style1' === $settings['style'] ) : ?>

		<section class="banner-seven-area">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-12">
						<div class="banner-seven-wrapper">
							<div class="banner-seven-content">
								
								<?php if($settings['title']) : ?>
									<h1 class="title-animation"><?php echo $settings['title'];?></h1>
								<?php endif; ?>

								<?php if($settings['title_2']) : ?>
									<h2 class="title-animation"><?php echo $settings['title_2'];?></h2>
								<?php endif; ?>
							</div>
							<div class="banner-seven-button">
								<?php if( 'yes'===$settings['show_button'] ){ ?>
									<div class="left">
										<a href="<?php echo esc_url($settings['button_url']['url']); ?>" aria-label="our causes" title="our causes" class="btn--primary">
											<?php echo $settings['button_text']; ?>

											<i class="fa-solid fa-arrow-right"></i>
										</a>
									</div>
								<?php } ?>

								<a class="banner-seven-btn" href="contact-us.html">Join our Community</a>
							</div>
							<div class="banner-seven-descri">
								<p class="banner-seven-paragraph">We offer dental services at a perfect highly innovative level, with dental
								guarantee for all treatments.</p>
							</div>

						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="banner-seven-slide">
							<div class="banner-seven-active swiper">
								<div class="swiper-wrapper banner-seven-titming">
									<?php foreach($settings['repeat'] as $item):?>	
										<div class="swiper-slide">

											<div class="banner-seven-wrapper swiper-slide">
												<div class="banner-seven-thumb">
													<?php  if ( !empty(esc_url($item['slider_image']['id']) )) : ?>   
														<img src="<?php echo wp_get_attachment_url($item['slider_image']['id']);?>" alt="image"/>
													<?php endif;?>
												</div>
											</div>
										</div>


									<?php endforeach; ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>



	<?php  elseif ( 'style2' === $settings['style'] ) : ?>	

	<?php  elseif ( 'style3' === $settings['style'] ) : ?>	


	<?php endif ;
	}
}

Plugin::instance()->widgets_manager->register_widget_type(new Banner_Slider_Three());