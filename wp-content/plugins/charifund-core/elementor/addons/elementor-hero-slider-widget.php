<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Hero_Slider extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-hero-slider-widget';
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
		return esc_html__( 'Hero Slider Widget', 'charifund-core' );
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
			'testimonials',
			[
				'label' => esc_html__( 'Hero Slider', 'charifund-core' ),
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
				),
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
		  	'repeat', [
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => 
					[
						['block_title' => esc_html__('Projects Completed', 'charifund-core')],
					],
					'fields' => [

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],
					    

						'block_title' =>
						[
							'name' => 'block_title',
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						

						'block_text' =>
						[
							'name' => 'block_text',
							'label' => esc_html__('Text', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

							

						'block_image2' =>
						[
							'name' => 'block_image2',
							'label' => __( 'Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],	

						'block_alt_text2' =>
						[
							'name' => 'block_alt_text2',
							'label' => esc_html__('Image Text', 'charifund-core'),
							'type' => Controls_Manager::TEXT,
							'default' => esc_html__('', 'charifund-core'),
						],	

							'button' =>
							[
								'name' => 'button',
								'label'       => __( 'Button', 'charifund-core' ),
								'type'        => Controls_Manager::TEXT,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => esc_html__( 'Enter your button text', 'charifund-core' ),
								'default' => esc_html__('Read More', 'charifund-core'),
							],

						'button_link' =>
							[
								'name' => 'button_link',
							  'label' => __( 'Button Url', 'charifund-core' ),
							  'type' => Controls_Manager::URL,
							  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
							  'show_external' => true,
							  'default' => [
								'url' => '',
								'is_external' => true,
								'nofollow' => true,
							  ],
							
						   ],
						
					],
				'title_field' => '{{block_title}}',
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

			// js code start

	
			
			var testimonial = new Swiper(".hero_slider", {
				loop: true,
				speed: 1000,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 24,

				autoplay: {
					delay: 2000,
					disableOnInteraction: false,
					pauseOnMouseEnter: false,
				},
				navigation: {
					nextEl: ".next-testimonial",
					prevEl: ".prev-testimonial",
				},

				breakpoints: {
					768: {
					slidesPerView: 1,
					},
					1200: {
					slidesPerView: 1,
					},
					1500: {
					slidesPerView: 1,
					},
				},

				pagination: {
                  el: ".ministrie-eight-dotsss",
                  clickable: true,
                },
                scrollbar: {
                    el: ".swiper-scrollbar.two",
                },


			});
			

			// js code end 

			});
			</script>';


		?>

		<?php  if ( 'style1' === $settings['style'] ) : ?>	
			<div class="hero home_15 p-0">
				<div class="hero_inner">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="hero_slider swiper">
									<div class="swiper-wrapper">
										<?php foreach($settings['repeat'] as $item):?>	
											<div class="swiper-slide">
												<div class="slider-single">
													<div class="content">
														<div class="hero-img">
															<?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
																<img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
															<?php endif;?>
														</div>
														<div class="text">
															<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
															<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
															
															<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>

															<div class="hero-button">
																<a href="<?php echo esc_url($item['button_link']['url']);?>" class="btn-primary"><?php echo $item['button'];?> <i class="fa-solid fa-arrow-right"></i></a>
															</div>
														
														</div>
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

				<div class="container">
					<div class="ministrie-eight-space">
						<div class="row align-items-center justify-content-between">
							<div class="col-xl-3 col-lg-3 col-md-4">
								<div class="ministrie-eight-dotsss text-center"></div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-7">
		                    <!--  <div class="ministrie-eight-scrollbar position-relative z-1">
		                        <div class="swiper-scrollbar two"></div>
		                    </div> -->
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>	
			
		<?php  elseif ( 'style3' === $settings['style'] ) : ?>	
			
		<?php  elseif ( 'style4' === $settings['style'] ) : ?>
			
		<?php elseif( 'style5' === $settings['style'] ) : ?>	
			
		<?php elseif( 'style6' === $settings['style'] ) : ?>	
			
		<?php endif ;?>	
        
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type(new Hero_Slider());