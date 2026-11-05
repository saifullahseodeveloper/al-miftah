<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Volunteer_Two_Section extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-volunteer-two-section-widget';
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
		return esc_html__( 'Volunteer Two Section', 'charifund-core' );
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

		$this->start_controls_section(
			'volunteer_content',
			[
				'label' => esc_html__( 'Volunteer Content', 'charifund-core' ),
			]
		);	
		$this->add_control(
            'background_image', [
                'label' => esc_html__('Background Image', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Background Image', 'charifund-core'),
            ]
        );	
		$this->add_control(
			'icons_type',
			[
				'label' => esc_html__('Icon Type','charifund-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' =>[
				'img' =>[
					'title' =>esc_html__('Image','charifund-core'),
					'icon' =>'fa fa-picture-o',
				],
				'icon' =>[
					'title' =>esc_html__('Icon','charifund-core'),
					'icon' =>'fa fa-info',
				]
				],
				'default' => 'icon',
			]
		);
		
		$this->add_control(
			'select_icon',
			[
				'label' => esc_html__( 'Select Icon', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition'=>[
					'icons_type'=> 'icon',
				],
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'select_img',
			[
				'label' => esc_html__('Select Image','charifund-core'),
				'type'=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
				'icons_type' => 'img',
				]
			]
		);
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Become an volunteer?', 'charifund-core' ),
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
				'default' => __( 'Contact with Us', 'charifund-core' ),
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
        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Video Link', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('https://www.youtube.com/watch?v=pPl3ZZdTP3g', 'charifund-core'),
            ]
        );
		$this->add_control(
            'shape_image', [
                'label' => esc_html__('Shape img', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Shape Img', 'charifund-core'),
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
            'volunteer_settings_section',
            [
                'label' => esc_html__('Style Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

			$this->add_control('icon_color', [
				'label' => esc_html__('Icon Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-volunteer i" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('title_color', [
				'label' => esc_html__('Title Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-volunteer h3" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('title_hover_color', [
				'label' => esc_html__('Title Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-volunteer h3:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ff-volunteer h3',
				]
			);
			$this->add_control('button_color', [
				'label' => esc_html__('Button Text Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-volunteer a " => "color: {{VALUE}} !important"
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

		?>


			<div class="pg-four">
				<div class="ff-volunteer">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="ff-volunteer__inner text-center text-lg-start" style="background-image: url('<?php echo $settings['background_image']['url']; ?>')">
									<div class="row align-items-center gutter-40">
										<div class="col-12 col-lg-8">
											<div class="ff-volunteer-content">
												<?php if($settings['icons_type'] == 'icon' ) : ?>
													<i class="<?php echo esc_attr($settings['select_icon']['value']); ?>"></i>
												<?php else: ?>
													<img src="<?php echo $settings['select_img']['url'];?>" alt="" />
												<?php endif; ?>
												<?php if($settings['title']) : ?>
													<h3 class="fw-7 title-animation mt-25"><?php echo $settings['title']; ?></h3>
												<?php endif; ?>
												<?php if( 'yes'===$settings['show_button'] ){ ?>
													<div class="mt-25">
														<a href="<?php echo esc_url($settings['button_url']['url']); ?>"><?php echo $settings['button_text']; ?> <svg
																xmlns="http://www.w3.org/2000/svg" width="39" height="13"
																viewBox="0 0 39 13" fill="none">
																<path
																	d="M38.6044 7.85781C39.1319 7.59411 39.1319 6.73707 38.6044 6.47337C34.5171 4.2319 30.3637 2.1882 25.8808 1.00154C25.2215 0.869685 24.5623 1.59487 24.9578 2.1882C25.8808 3.50671 27.0015 4.62745 28.32 5.61633C19.0905 5.35263 9.53123 4.10004 0.433491 6.27559C-0.225765 6.40744 -0.0939178 7.52807 0.565449 7.46215C9.99282 6.27559 19.3543 7.19855 28.7816 7.3303C27.7927 8.45103 26.8039 9.57177 25.815 10.6266C25.3535 11.0881 25.6172 12.0771 26.4083 12.0111C30.7593 11.4836 34.8467 10.0332 38.6044 7.85781ZM30.7593 7.13263C31.3526 6.73707 31.2208 5.61633 30.2978 5.61633C30.2319 5.61633 30.166 5.61633 30.166 5.61633C29.3749 4.82523 28.5837 4.10004 27.7926 3.24301C30.8252 4.29782 33.66 5.61634 36.4948 7.13252C33.9237 8.45103 31.2867 9.43992 28.4519 9.96732C29.1112 9.24214 29.7704 8.45103 30.4956 7.72574C30.7593 7.5941 30.8252 7.33029 30.7593 7.13263Z"
																	fill="white" />
															</svg>
														</a>
													</div>
												<?php } ?>
											</div>
										</div>
										<div class="col-12 col-lg-4">
											<div class="video-btn-wrapper">
												<?php if($settings['video_link']) : ?>
													<a href="<?php echo $settings['video_link']; ?>" target="_blank"
														title="video Player" class="popup-video-link play-button open-video-popup">
														<i class="icon-play"></i>
													</a>
												<?php endif; ?>
											</div>

										</div>
									</div>
									<?php if($settings['shape_image']['url']) : ?>
										<div class="th-right">
											<img src="<?php echo $settings['shape_image']['url']; ?>" alt="">
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
  
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Volunteer_Two_Section());