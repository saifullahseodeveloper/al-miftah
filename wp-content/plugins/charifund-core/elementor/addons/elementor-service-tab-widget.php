<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Service_Tab extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-service-tab-widget';
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
		return esc_html__( 'Service Tab', 'charifund-core');
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
                'label' => __('Service Tab Settings', 'holaa-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'icon_img', [
				'label' => __( 'Icon Img', 'charifund-core' ),
				'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'solid',
                ],
			]
		);
		$repeater->add_control(
            'title', [
                'label' => esc_html__('title', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Fund raised & donations', 'charifund-core'),
            ]
        );
		$repeater->add_control(
            'video_1', [
                'label' => esc_html__('Video One', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('https://www.youtube.com/watch?v=RvreULjnzFo', 'charifund-core'),
                'description' => esc_html__('https://www.youtube.com/watch?v=RvreULjnzFo', 'charifund-core'),
            ]
        );
		$repeater->add_control(
			'video_1_img', [
				'label' => __('video 1 img', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$repeater->add_control(
			'video_1_shape', [
				'label' => __('video 1 shape', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$repeater->add_control(
            'video_2', [
                'label' => esc_html__('Video Two', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('https://www.youtube.com/watch?v=RvreULjnzFo', 'charifund-core'),
            ]
        );
		$repeater->add_control(
			'video_2_img', [
				'label' => __('video 2 img', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);
		$repeater->add_control(
            'chack_list_1', [
                'label' => esc_html__('chack list 1', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Peoples Growth', 'charifund-core'),
            ]
        );
		$repeater->add_control(
            'chack_list_2', [
                'label' => esc_html__('chack list 2', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Helped fund 3,265 Project powerful', 'charifund-core'),
            ]
        );
		$repeater->add_control(
            'chack_list_3', [
                'label' => esc_html__('chack list 3', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Awards Winning nonprofit company', 'charifund-core'),
            ]
        );
		$this->add_control('service_items', [
            'label' => esc_html__('Service Tab Item', 'fixturbo-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'image' => array(
                        'url' => Utils::get_placeholder_image_src()
                    )
                ]
            ],
        ]);

		$this->add_control('btn_show_hr', [
         	'type' => Controls_Manager::DIVIDER,
			'label' => __('btn show hr', 'charifund-core'),
		]);
		$this->add_control(
            'btn_text', [
                'label' => esc_html__('btn text', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('More Services', 'charifund-core'),
            ]
        );
		$this->add_control(
            'btn_url', [
                'label' => esc_html__('btn url', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'charifund-core'),
            ]
        );
		$this->add_control(
			'btn_shape_img', [
				'label' => __( 'Btn shape Icon Img', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);

		$this->add_control('shape_show_hr', [
			'type' => Controls_Manager::DIVIDER,
		   'label' => __('shape show hr', 'charifund-core'),
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
		$service_items = $settings['service_items'];

		echo '
		<script>
			jQuery(document).ready(function($) {
				$(".fc-profit-single").hide();
				$(".fc-profit-single:first").show();
				$(".profit__tab-btn").on("click", function () {
					$(".profit__tab-btn").removeClass("active");
					$(this).addClass("active");
					$(".fc-profit-single").hide();
					var target = $(this).data("target");
					$(target).fadeIn(500);
					return false;
				});
			});
		</script>';
		?>

		<div class="fc-profit padding-bottom-120">
			<div class="container">
				<div class="row gutter-40 mt-60">
					<div class="col-12 col-lg-5 col-xl-5">
						<div class="fc-profit__tab-btns">
							<?php 
								$i = 0;
								foreach($service_items as $items) :
								$i++; 
								$active = '';
								if($i == 1){
									$active = 'active';
								};
							?>
								<button class="profit__tab-btn <?php echo $active; ?>" data-target="#profit-<?php echo $i; ?>" aria-label="fund raised & donations" title="fund raised & donations">
									<?php if($items['icon_img']) {	
										Icons_Manager::render_icon($items['icon_img'], ['aria-hidden' => 'true']);
									}; ?>
									<?php echo $items['title']; ?> 
									<i class="fa-solid fa-arrow-right"></i>
								</button>
							<?php endforeach; ?>
							<?php if($settings['btn_text']) : ?>
								<div class="text-center mt-4 more-txt">
									<a href="<?php echo $settings['btn_url']; ?>" title="view all services" aria-label="view all services" class="fw-8"><?php echo $settings['btn_text']; ?></a>
									<img src="<?php echo $settings['btn_shape_img']['url']; ?>" alt="Image">
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-12 col-lg-7 col-xl-7">
						<div class="fc-profit__content">
							<?php 
								$j = 0;
								foreach($service_items as $items) :
								$j++; 
							?>
							<div class="fc-profit-single" id="profit-<?php echo $j; ?>">
								<?php if($items['video_1_img']['url']) : ?>
									<div class="thumb thumb-lg">
										<img src="<?php echo $items['video_1_img']['url']; ?>" alt="Image">
										<div class="video-btn-wrapper">
											<a href="<?php echo $items['video_1']; ?>" target="_blank" title="video Player" class="open-video-popup">
												<i class="icon-play"></i>
											</a>
										</div>
										<img src="<?php echo $items['video_1_shape']['url']; ?>" alt="Image" class="base-img">
									</div>
								<?php endif; ?>
								<div class="fc-profit-group">
									<?php if($items['video_2_img']['url']) : ?>
										<div class="thumb thumb-sm">
											<img src="<?php echo $items['video_2_img']['url']; ?>" alt="Image">
											<div class="video-btn-wrapper">
												<a href="<?php echo $items['video_2']; ?>" target="_blank" title="video Player" class="open-video-popup">
													<i class="icon-play"></i>
												</a>
											</div>
										</div>
									<?php endif; ?>
									<ul>
										<?php if($items['chack_list_1']) : ?>
											<li>
												<i class="fa-solid fa-check"></i><?php echo $items['chack_list_1']; ?>
											</li>
										<?php endif; ?>
										<?php if($items['chack_list_2']) : ?>
											<li>
												<i class="fa-solid fa-check"></i><?php echo $items['chack_list_2']; ?>
											</li>
										<?php endif; ?>
										<?php if($items['chack_list_3']) : ?>
											<li>
												<i class="fa-solid fa-check"></i><?php echo $items['chack_list_3']; ?> 
											</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if($settings['animate_img_1']['url']) : ?>
				<div class="shape-left" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
					<img src="<?php echo $settings['animate_img_1']['url']; ?>" alt="Image" class="base-img">
				</div>
			<?php endif; ?>
			<?php if($settings['animate_img_2']['url']) : ?>
				<div class="shape-right" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
					<img src="<?php echo $settings['animate_img_2']['url']; ?>" alt="Image">
				</div>
			<?php endif; ?>
		</div>
             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Service_Tab());