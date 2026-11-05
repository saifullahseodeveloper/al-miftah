<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Community_Count extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-community-count-widget';
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
		return esc_html__( 'Community Count', 'charifund-core');
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
            'settings_section',
            [
                'label' => __('Community Settings', 'holaa-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
            'sub_title', [
                'label' => esc_html__('sub title', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('We are always open for children', 'charifund-core'),
            ]
        );
		$this->add_control(
            'title', [
                'label' => esc_html__('title', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Join Our Community of Donors and Volunteers: Be Part of Positive Change in the World', 'charifund-core'),
            ]
        );
		$this->add_control(
            'count_val', [
                'label' => esc_html__('Count Val', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('154859', 'charifund-core'),
            ]
        );
		$this->add_control(
            'count_prefix', [
                'label' => esc_html__('Count prefix', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+', 'charifund-core'),
            ]
        );
		$this->add_control(
            'small_title', [
                'label' => esc_html__('small title', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Join the Many Who Already Support Our Mission', 'charifund-core'),
            ]
        );
		$this->add_control(
            'btn_text', [
                'label' => esc_html__('btn text', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Join Our Community', 'charifund-core'),
            ]
        );
		$this->add_control(
            'btn_url', [
                'label' => esc_html__('btn url', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'charifund-core'),
            ]
        );

		$this->add_control('icon_show_hr', [
         	'type' => Controls_Manager::DIVIDER,
			'label' => __('icon show hr', 'charifund-core'),
		]);
		$this->add_control(
			'animate_img_1', [
				'label' => __( 'Animate Image 1', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$this->add_control(
			'animate_img_2', [
				'label' => __( 'Animate Image 2', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$this->add_control(
			'animate_img_3', [
				'label' => __( 'Animate Image 3', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$this->add_control(
			'animate_img_4', [
				'label' => __( 'Animate Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
        $this->add_control('subtitle_color', [
            'label' => __('subtitle Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .sub-title" => "color: {{VALUE}}",
            ]
        ]);
		$this->add_control('bg_hover_color', [
            'label' => __('btn hover Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .counter-four .btn--primary:hover" => "background-color: {{VALUE}}",
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

			echo '
			<script>
				jQuery(".odometer").each(function () {
					$(this).isInViewport(function (status) {
						if (status === "entered") {
						for (
							var i = 0;
							i < document.querySelectorAll(".odometer").length;
							i++
						) {
							var el = document.querySelectorAll(".odometer")[i];
							el.innerHTML = el.getAttribute("data-odometer-final");
						}
						}
					});
				});
			</script>';
		?>

		<div class="counter-four padding-120">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-9">
						<div class="section__header text-center" data-aos="fade-up" data-aos-duration="1000">
							<?php if($settings['sub_title']) : ?>
								<span class="sub-title mb-4"><?php echo $settings['sub_title']; ?></span>
							<?php endif; ?>
							<?php if($settings['title']) : ?>
								<h3 class="title-animation fw-5 color-black"><?php echo $settings['title']; ?></h3>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="counter-four__content text-center">
							<?php if($settings['count_val']) : ?>
								<h2 class="hb color-black">
									<span class="odometer fw-8" data-odometer-final="<?php echo $settings['count_val']; ?>"></span>
									<?php if($settings['count_prefix']) : ?>
										<span class="prefix"><?php echo $settings['count_prefix']; ?></span>
									<?php endif; ?>
								</h2>
							<?php endif; ?>
							<?php if($settings['small_title']) : ?>
								<p class="text-xl"><?php echo $settings['small_title']; ?></p>
							<?php endif; ?>
							<?php if($settings['btn_text']) : ?>
								<div class="cta">
									<a href="<?php echo $settings['btn_url']; ?>" aria-label="join our community" title="join our community" class="btn--primary border-radius-40"><?php echo $settings['btn_text']; ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if($settings['animate_img_1']['url']) : ?>
				<div class="fc-one">
					<img src="<?php echo $settings['animate_img_1']['url']; ?>" alt="Image">
				</div>
			<?php endif; ?>
			<?php if($settings['animate_img_2']['url']) : ?>
				<div class="fc-two">
					<img src="<?php echo $settings['animate_img_2']['url']; ?>" alt="Image">
				</div>
			<?php endif; ?>
			<?php if($settings['animate_img_3']['url']) : ?>
				<div class="fc-three">
					<img src="<?php echo $settings['animate_img_3']['url']; ?>" alt="Image">
				</div>
			<?php endif; ?>
			<?php if($settings['animate_img_4']['url']) : ?>
				<div class="fc-four">
					<img src="<?php echo $settings['animate_img_4']['url']; ?>" alt="Image">
				</div>
			<?php endif; ?>
		</div>
             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Community_Count());