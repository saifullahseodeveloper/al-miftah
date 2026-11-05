<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Banner_Slider extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-banner-slider-widget';
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
		return esc_html__( 'Banner Slider', 'charifund-core' );
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
					'style3'   => esc_html__( 'Style Three', 'charifund-core' ),
					'style4'   => esc_html__( 'Style Four', 'charifund-core' ),
				),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Shape Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image2',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style1','style2','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2','style3']],
			]
		);

		$this->add_control(
			'image3',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				 'condition'	=> ['style' => ['style1','style3']],
				]
		);	
		
		$this->add_control(
			'alt_text3',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style3']],
			]
		);

		$this->add_control(
			'image4',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style3']],
				]
		);

		$this->add_control(
			'alt_text4',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style3']],
			]
		);

		$this->add_control(
			'image5',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style1','style3']],
				]
		);

		$this->add_control(
			'alt_text5',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style3']],
			]
		);

		$this->add_control(
			'image6',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style3']],
				]
		);

		$this->add_control(
			'alt_text6',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style3']],
			]
		);

		$this->add_control(
			'image7',
			[
				'label' => __( 'Shape Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style3']],
			]
		);

		$this->add_control(
			'alt_text7',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style3']],
			]
		);

		$this->add_control(
			'image8',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				  'condition'	=> ['style' => ['style3']],
				]
		);

		$this->add_control(
			'alt_text8',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style3']],
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

						'block_bg_image' =>
						[
							'name' => 'block_bg_image',
							'label' => __( 'Background Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],

						'block_icons' =>
						[
							'name' => 'block_icons',
							'label' => __( 'Icon', 'charifund-core' ),
							'type' => Controls_Manager::ICONS,
						],

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_title' =>
						[
							'name' => 'block_title',
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_text' =>
						[
							'name' => 'block_text',
							'label' => esc_html__('Text', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_button' =>
						[
							'name' => 'block_button',
							'label' => esc_html__('Button Text', 'charifund-core'),
							'type' => Controls_Manager::TEXT,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_button_link' =>
						[
							'name' => 'block_button_link',
							'label' => esc_html__('Button Link', 'charifund-core'),
							'type' => Controls_Manager::URL,
							'default' => ['url' => '',],
						],

						'block_button2' =>
						[
							'name' => 'block_button2',
							'label' => esc_html__('Button Text', 'charifund-core'),
							'type' => Controls_Manager::TEXT,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_button_link2' =>
						[
							'name' => 'block_button_link2',
							'label' => esc_html__('Button Link', 'charifund-core'),
							'type' => Controls_Manager::URL,
							'default' => ['url' => '',],
						],	
						
					],
				'title_field' => '{{block_title}}',
			]
	);
	$this->end_controls_section();
		
	$this->start_controls_section(
		'content_styling_settings_section',
		[
			'label' => esc_html__('Content Style', 'charifund-core'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_control('banner_subtitle_color', [
		'label' => esc_html__('banner subtitle color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two__slider-content .sub-title" => "color: {{VALUE}}"
		]
	]);
	$this->add_group_control(Group_Control_Typography::get_type(), [
			'label' => esc_html__('banner subtitle Typography', 'charifund-core'),
			'name' => 'banner_subtitle',
			'selector' => "{{WRAPPER}} .banner-two__slider-content .sub-title"
	]);
	$this->add_control('banner_title_color', [
		'label' => esc_html__('banner title color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two__slider-content h1" => "color: {{VALUE}}"
		]
	]);
	$this->add_group_control(Group_Control_Typography::get_type(), [
			'label' => esc_html__('banner title Typography', 'charifund-core'),
			'name' => 'banner_title',
			'selector' => "{{WRAPPER}} .banner-two__slider-content h1"
	]);
	$this->add_control('banner_title_action_color', [
		'label' => esc_html__('banner title action color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two .banner-two__slider-content h1 span" => "color: {{VALUE}}"
		]
	]);
	$this->add_group_control(Group_Control_Typography::get_type(), [
			'label' => esc_html__('Button 1 Typography', 'charifund-core'),
			'name' => 'banner_button1',
			'selector' => "{{WRAPPER}} .banner-two__slider-content .btn--tertiary"
	]);
	$this->add_control('banner_button1_bg_color', [
		'label' => esc_html__('button 1 bg color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two .banner-two__slider-content .btn--tertiary" => "background-color: {{VALUE}}"
		]
	]);
	$this->add_control('banner_button1_hover_bg_color', [
		'label' => esc_html__('button 1 hover bg color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two .banner-two__slider-content .btn--tertiary:hover" => "background-color: {{VALUE}}"
		]
	]);
	
	$this->add_group_control(Group_Control_Typography::get_type(), [
			'label' => esc_html__('Button 2 Typography', 'charifund-core'),
			'name' => 'banner_button2',
			'selector' => "{{WRAPPER}} .banner-two__slider-content .btn--primary"
	]);
	$this->add_control(
		'banner_button2_bg_color',
		[
			'label' => esc_html__('Button 2 bg Color', 'charifund-core'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-two .banner-two__slider-content .btn--primary::before' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .banner-two .banner-two__slider-content .btn--primary::after' => 'background-color: {{VALUE}};',
			],
		]
	);
	$this->add_control('banner_button2_hover_bg_color', [
		'label' => esc_html__('button 2 hover bg color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-two .banner-two__slider-content .btn--primary:hover" => "background-color: {{VALUE}}"
		]
	]);
	$this->end_controls_section();
		
	$this->start_controls_section(
		'nav_styling_settings_section',
		[
			'label' => esc_html__('Navigation Settings', 'charifund-core'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_control('slider_navigation_prev_color', [
		'label' => esc_html__('navigation prev icon color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-slider-navigation .prev-banner" => "color: {{VALUE}} !important"
		]
	]);
	$this->add_control('slider_navigation_next_color', [
		'label' => esc_html__('navigation Next icon color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-slider-navigation .next-banner" => "color: {{VALUE}} !important"
		]
	]);
	$this->add_control('slider_navigation_prev_bgcolor', [
		'label' => esc_html__('slider navigation prev bg color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-slider-navigation .prev-banner" => "background-color: {{VALUE}} !important"
		]
	]);
	$this->add_control('slider_navigation_next_bgcolor', [
		'label' => esc_html__('slider navigation Next bg color', 'charifund-core'),
		'type' => Controls_Manager::COLOR,
		'selectors' => [
			"{{WRAPPER}} .banner-slider-navigation .next-banner" => "background-color: {{VALUE}} !important"
		]
	]);
	$this->add_group_control(Group_Control_Typography::get_type(), [
			'label' => esc_html__('navigation Typography', 'charifund-core'),
			'name' => 'slider_navigation_typography',
			'description' => esc_html__('navigation typography', 'charifund-core'),
			'selector' => "{{WRAPPER}} .banner-slider-navigation button"
	]);
	$this->add_control(
			'navigation_direction',
			[
				'label' => __( 'navigation direction', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'column' => __( 'column', 'charifund-core' ),
					'flex-direction-row' => __( 'row', 'medicol-core' ),
				],
				'default' => 'column',
			]
	);
		
	// Position type (relative, absolute, etc.)
	$this->add_control(
		'custom_position',
		[
			'label'   => esc_html__( 'Position', 'plugin-name' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => [
				''         => esc_html__( 'Default', 'plugin-name' ),
				'relative' => esc_html__( 'Relative', 'plugin-name' ),
				'absolute' => esc_html__( 'Absolute', 'plugin-name' ),
				'fixed'    => esc_html__( 'Fixed', 'plugin-name' ),
				'sticky'   => esc_html__( 'Sticky', 'plugin-name' ),
			],
			'selectors' => [
				'{{WRAPPER}} .banner-slider-navigation' => 'position: {{VALUE}};',
			],
		]
	);

	// Top
	$this->add_responsive_control(
		'custom_position_top',
		[
			'label' => esc_html__( 'Top', 'plugin-name' ),
			'type'  => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem' ],
			'range' => [
				'px' => [ 'min' => -500, 'max' => 500 ],
				'%'  => [ 'min' => -100, 'max' => 100 ],
			],
			'selectors' => [
				'{{WRAPPER}} .banner-slider-navigation' => 'top: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'custom_position!' => '',
			],
		]
	);

	// Right
	$this->add_responsive_control(
		'custom_position_right',
		[
			'label' => esc_html__( 'Right', 'plugin-name' ),
			'type'  => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem' ],
			'range' => [
				'px' => [ 'min' => -500, 'max' => 500 ],
				'%'  => [ 'min' => -100, 'max' => 100 ],
			],
			'selectors' => [
				'{{WRAPPER}} .banner-slider-navigation' => 'right: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'custom_position!' => '',
			],
		]
	);

	// Bottom
	$this->add_responsive_control(
		'custom_position_bottom',
		[
			'label' => esc_html__( 'Bottom', 'plugin-name' ),
			'type'  => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem' ],
			'range' => [
				'px' => [ 'min' => -500, 'max' => 500 ],
				'%'  => [ 'min' => -100, 'max' => 100 ],
			],
			'selectors' => [
				'{{WRAPPER}} .banner-slider-navigation' => 'bottom: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'custom_position!' => '',
			],
		]
	);

	// Left
	$this->add_responsive_control(
		'custom_position_left',
		[
			'label' => esc_html__( 'Left', 'plugin-name' ),
			'type'  => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em', 'rem' ],
			'range' => [
				'px' => [ 'min' => -500, 'max' => 500 ],
				'%'  => [ 'min' => -100, 'max' => 100 ],
			],
			'selectors' => [
				'{{WRAPPER}} .banner-slider-navigation' => 'left: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'custom_position!' => '',
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
				var bannerOne = new Swiper(".banner-two__slider", {
					loop: true,
					speed: 2000,
					slidesPerView: 1,
					slidesPerGroup: 1,
					spaceBetween: 0,
					effect: "fade",
					fadeEffect: {
						crossFade: true,
					},
					autoplay: {
						delay: 6000,
						disableOnInteraction: false,
						pauseOnMouseEnter: true,
					},
					navigation: {
						nextEl: ".next-banner",
						prevEl: ".prev-banner",
					},
					});

					var bannerTwo = new Swiper(".banner__slider", {
					loop: true,
					speed: 2000,
					slidesPerView: 1,
					slidesPerGroup: 1,
					spaceBetween: 24,
					effect: "fade",
					fadeEffect: {
						crossFade: true,
					},
					autoplay: {
						delay: 6000,
						disableOnInteraction: false,
						pauseOnMouseEnter: true,
					},
					});

					var bannerThree = new Swiper(".banner-three__slider", {
					loop: true,
					speed: 2000,
					slidesPerView: 1,
					slidesPerGroup: 1,
					spaceBetween: 24,
					effect: "fade",
					fadeEffect: {
						crossFade: true,
					},
					autoplay: {
						delay: 6000,
						disableOnInteraction: false,
						pauseOnMouseEnter: true,
					},
				});
			});
		</script>';
	?>

	<?php  if ( 'style1' === $settings['style'] ) : ?>	
		<section class="banner-two m-0">
			<div class="banner-two__slider swiper">
				<div class="swiper-wrapper">

					<?php foreach($settings['repeat'] as $item):?>						
					<div class="swiper-slide">
						<div class="banner-two__slider-single">
							<div class="banner-two__slider-bg" data-background="<?php echo wp_get_attachment_url($item['block_bg_image']['id']);?>"></div>
							<div class="container">
								<div class="row">
									<div class="col-12 col-md-9 col-lg-7 col-xxl-6">
										<div class="banner-two__slider-content">
										<span class="sub-title"><i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
										<h1><?php echo wp_kses($item['block_title'], $allowed_tags);?></h1>
										<div class="banner__content-cta cta">
											<?php if(wp_kses($item['block_button'], $allowed_tags)): ?>
											<a href="<?php echo esc_url($item['block_button_link']['url']);?>" aria-label="about us" title="about us"
												class="btn--tertiary"><?php echo wp_kses($item['block_button'], $allowed_tags);?> <i
												class="fa-solid fa-arrow-right"></i></a>
											<?php endif; ?>
											<?php if(wp_kses($item['block_button2'], $allowed_tags)): ?>
											<a href="<?php echo esc_url($item['block_button_link2']['url']);?>" aria-label="contact us" title="contact us"
												class="btn--primary"><?php echo wp_kses($item['block_button2'], $allowed_tags);?> <i
												class="fa-solid fa-arrow-right"></i></a>
											<?php endif; ?>
												
										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
			</div>
			<div class="slider-navigation banner-slider-navigation <?php echo $settings['navigation_direction']; ?> d-none d-md-flex">
				<button type="button" aria-label="prev slide" title="prev slide" class="prev-banner slider-btn">
					<i class="fa-solid fa-arrow-left"></i>
				</button>
				<button type="button" aria-label="next slide" title="next slide"
					class="next-banner slider-btn slider-btn-next">
					<i class="fa-solid fa-arrow-right"></i>
				</button>
			</div>
			<div class="shape">
			<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
			<?php endif;?>
			</div>
			<div class="shape-left" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
			<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
			<?php endif;?>
			</div>
			<div class="sprade-shape">
			<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
				<img class="base-img" data-aos="zoom-in" data-aos-duration="1000" src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
			<?php endif;?>
			</div>
			<div class="unity">
			<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
			<?php endif;?>
			</div>
		</section>
	<?php  elseif ( 'style2' === $settings['style'] ) : ?>	
		<section class="banner m-0">
			<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-10">
					<div class="banner__slider swiper">
						<div class="swiper-wrapper">							
							<?php foreach($settings['repeat'] as $item):?>	
						<div class="swiper-slide">
							<div class="banner__content text-center">
								<span class="sub-title"><i
									class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
								<h1><?php echo wp_kses($item['block_title'], $allowed_tags);?></h1>
								<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
								<div class="banner__content-cta cta">
									<?php if(wp_kses($item['block_button'], $allowed_tags)): ?>
									<a href="<?php echo esc_url($item['block_button_link']['url']);?>" aria-label="about us" title="about us"
									class="btn--tertiary"><?php echo wp_kses($item['block_button'], $allowed_tags);?> <i class="fa-solid fa-arrow-right"></i></a>
									<?php endif; ?>
									<?php if(wp_kses($item['block_button2'], $allowed_tags)): ?>
									<a href="<?php echo esc_url($item['block_button_link2']['url']);?>" aria-label="contact us" title="contact us"
									class="btn--primary"><?php echo wp_kses($item['block_button2'], $allowed_tags);?> <i class="fa-solid fa-arrow-right"></i></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="banner-bg">
			<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img class="parallax-image" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>
			</div>
			<div class="bottom-shape">
			<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
			<?php endif;?>
			</div>
			<div class="alter-shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
			<div class="circle-shape"></div>
		</section>
	<?php  elseif ( 'style3' === $settings['style'] ) : ?>	
		<section class="banner-three m-0">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-12 col-lg-8">
                     <div class="banner-three__slider swiper">
                        <div class="swiper-wrapper">
							<?php foreach($settings['repeat'] as $item):?>	
                           <div class="swiper-slide">
                              <div class="banner-three__content">
                                 <span class="sub-title"><i
                                    class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
                                 <h1 class="title-animation"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h1>
                                 <p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
                                 <div class="banner__content-cta cta">
									   <?php if(wp_kses($item['block_button'], $allowed_tags)): ?>
                                    <a href="<?php echo esc_url($item['block_button_link']['url']);?>"
                                       class="btn--tertiary"><?php echo wp_kses($item['block_button'], $allowed_tags);?> <i class="fa-solid fa-arrow-right"></i></a>
									   <?php endif; ?>
									<?php if(wp_kses($item['block_button2'], $allowed_tags)): ?>
                                    <a href="<?php echo esc_url($item['block_button_link2']['url']);?>"
                                       class="btn--primary"><?php echo wp_kses($item['block_button2'], $allowed_tags);?> <i class="fa-solid fa-arrow-right"></i></a>
									   <?php endif; ?>
                                 </div>
                              </div>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-4 d-none d-lg-block">
                     <div class="banner-three__thumb">
                        <div class="banner-three__thumb-inner">
                           <div class="group">
                              <div class="m-one move-image">
							  <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
								<?php endif;?>
                              </div>
                              <div class="m-three move-image">
							  <?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
								<?php endif;?>
                              </div>
                           </div>
                           <div class="group">
                              <div class="m-two move-image">
							  	<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
								<?php endif;?>
                              </div>
                              <div class="m-four move-image">
							  	<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
								<?php endif;?>
                              </div>
                           </div>
                           <div class="group">
                              <div class="m-five move-image">
							  	<?php  if ( !empty(esc_url($settings['image5']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image5']['id']);?>" alt="<?php echo esc_attr($settings['alt_text5']);?>"/>
								<?php endif;?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="shape-lg">
			<?php  if ( !empty(esc_url($settings['image6']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image6']['id']);?>" alt="<?php echo esc_attr($settings['alt_text6']);?>"/>
			<?php endif;?>
            </div>
            <div class="sprade-shape">
        	<?php  if ( !empty(esc_url($settings['image7']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image7']['id']);?>" alt="<?php echo esc_attr($settings['alt_text7']);?>"/>
			<?php endif;?>
            </div>
            <div class="parasuit">
			<?php  if ( !empty(esc_url($settings['image8']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image8']['id']);?>" alt="<?php echo esc_attr($settings['alt_text8']);?>"/>
			<?php endif;?>
            </div>
		</section>

	<?php endif ;
	}
}

Plugin::instance()->widgets_manager->register_widget_type(new Banner_Slider());