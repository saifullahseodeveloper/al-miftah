<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Testimonials_Three extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-testimonials-three-widget';
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
		return esc_html__( 'Testimonials Widget 03', 'charifund-core' );
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
				'label' => esc_html__( 'Testimonials', 'charifund-core' ),
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
					
						'block_title' =>
						[
							'name' => 'block_title',
							'label' => esc_html__('Name', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Designatiob', 'charifund-core'),
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

						'block_image' =>
						[
							'name' => 'block_image',
							'label' => __( 'Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],	

						'block_alt_text' =>
						[
							'name' => 'block_alt_text',
							'label' => esc_html__('Image Text', 'charifund-core'),
							'type' => Controls_Manager::TEXT,
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

						'block_rating' =>
						[
							'name' => 'block_rating',
							'label'   => esc_html__( 'Select Rating', 'charifund-core' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'rat1',
							'options' => array(
								'rat1'   => esc_html__( 'Rating One', 'charifund-core' ),
								'rat2'   => esc_html__( 'Rating Two', 'charifund-core' ),
								'rat3'   => esc_html__( 'Rating Three', 'charifund-core' ),
								'rat4'   => esc_html__( 'Rating Four', 'charifund-core' ),
								
							),
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

			var testimonial = new Swiper(".testimonial__slider", {
				loop: true,
				speed: 1000,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 24,

				autoplay: {
					delay: 2000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},
				navigation: {
					nextEl: ".next-testimonial",
					prevEl: ".prev-testimonial",
				},

				breakpoints: {
					768: {
					slidesPerView: 2,
					},
					1200: {
					slidesPerView: 3,
					},
				},
			});

		


			 var slider = new Swiper(".testimonial-six-active", {
		        slidesPerView: 1,
		        loop: true,
		        effect: "cards",
		        grabCursor: true,
		        speed: 2500,
		        autoplay: true,
		        // pagination
		        pagination: {
		          el: ".testimonial-six-dot",
		          clickable: true,
		        },
		      });

			var testimonialFc = new Swiper(".fc-slider", {
				loop: true,
				speed: 1000,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 24,
				effect: "coverflow",
				coverflowEffect: {
					rotate: 40,
					stretch: 0,
					depth: 100,
					modifier: 1,
					slideShadows: false,
				},
				autoplay: {
					delay: 2000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},
				navigation: {
					nextEl: ".next-test",
					prevEl: ".prev-test",
				},
			});

			// js code end 

			});
			</script>';


		?>

		<?php  if ( 'style1' === $settings['style'] ) : ?>	
			<div class="testimonial p-0">
				<div class="testimonial_inner">
					<div class="container">
						<div class="testimonial-six-active swiper">
							<div class="swiper-wrapper">
								<?php foreach($settings['repeat'] as $item):?>	
									<div class="swiper-slide">
										<div class="testimonial-six-wrapper swiper-slide">
											<div class="testimonial-six-top">
												<div class="testimonial-six-top-content">
													<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
													<div class="testimonial-six-review">
														<div class="review">
															<?php if ( 'rat1' === $item['block_rating'] ) : ?>
																<i class="fas fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
															<?php elseif ( 'rat2' === $item['block_rating'] ) : ?>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
															<?php elseif ( 'rat3' === $item['block_rating'] ) : ?>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="far fa-star"></i>
																<i class="far fa-star"></i>
															<?php elseif ( 'rat4' === $item['block_rating'] ) : ?>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="far fa-star"></i>
															<?php elseif ( 'rat5' === $item['block_rating'] ) : ?>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
															<?php endif; ?>
														</div>
													</div>
												</div>
												<p class="testimonial-six-paragraph"><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
											</div>
											<div class="testimonial-six-bottom">
												<div class="testimonial-six-author">
													<div class="testimonial-six-author-img">
														<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
															<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
														<?php endif;?>
													</div>
													<div class="testimonial-six-author-content">
														<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
														<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
													</div>
												</div>
												<div class="testimonial-six-author-quate">
													<?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
														<img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
													<?php endif;?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						
					</div>
					<!-- <div class="slider-navigation">
						<button type="button" aria-label="prev slide" title="prev slide"
							class="prev-testimonial slider-btn">
						<i class="fa-solid fa-arrow-left"></i>
						</button>
						<button type="button" aria-label="next slide" title="next slide"
							class="next-testimonial slider-btn slider-btn-next">
						<i class="fa-solid fa-arrow-right"></i>
						</button>
					</div> -->
				</div>
			</div>
		<?php elseif ( 'style2' === $settings['style'] ) : ?>	
			<div class="testimonial p-0">
				<div class="testimonial__inner">
					<div class="container">
						<div class="row">
							<div class="col-12">
							<div class="testimonial__slider swiper">
								<div class="swiper-wrapper">
									<?php foreach($settings['repeat'] as $item):?>	
									<div class="swiper-slide">
										<div class="testimonial__slider-single">
										<div class="review">
											<?php if ( 'rat1' === $item['block_rating'] ) : ?>
												<i class="fas fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
											<?php elseif ( 'rat2' === $item['block_rating'] ) : ?>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
											<?php elseif ( 'rat3' === $item['block_rating'] ) : ?>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="far fa-star"></i>
												<i class="far fa-star"></i>
											<?php elseif ( 'rat4' === $item['block_rating'] ) : ?>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="far fa-star"></i>
											<?php elseif ( 'rat5' === $item['block_rating'] ) : ?>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
											<?php endif; ?>
										</div>
										<div class="content">
											<blockquote><q><?php echo wp_kses($item['block_text'], $allowed_tags);?></q></blockquote>
										</div>
										<div class="author-info">
											<div class="author-thumb">
											<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
												<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
											<?php endif;?>
											</div>
											<div class="author-content">
												<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
												<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
											</div>
										</div>
										<div class="quote">
											<?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
												<img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
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
					<!-- <div class="slider-navigation">
						<button type="button" aria-label="prev slide" title="prev slide"
							class="prev-testimonial slider-btn">
						<i class="fa-solid fa-arrow-left"></i>
						</button>
						<button type="button" aria-label="next slide" title="next slide"
							class="next-testimonial slider-btn slider-btn-next">
						<i class="fa-solid fa-arrow-right"></i>
						</button>
					</div> -->
				</div>
			</div>
		<?php elseif ( 'style3' === $settings['style'] ) : ?>
			<div class="testimonial fc-testimonial pt-120 pb-120 pg-four">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-12 col-xl-4">
							
						</div>
						<div class="col-12 col-xl-7 offset-xl-1">
							<div class="fc-test__content">
								<div class="fc-slider swiper">
									<div class="swiper-wrapper">
										<?php foreach ($settings['repeat'] as $item): ?>
											<div class="swiper-slide">
												<div class="testimonial__slider-single">
													<div class="content">
														<p class="text-xl"><?php echo $item['block_text']; ?></p>
													</div>
													<div class="author-info">
														<div class="author-thumb">
															<img src="<?php echo $item['block_image']['url'] ?>" alt="img">
														</div>
														<div class="author-content">
															<h6><?php echo esc_html($item['block_title']); ?></h6>
															<p><?php echo esc_html($item['block_subtitle']); ?></p>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								<!-- <div class="slider-navigation">
									<button type="button" aria-label="prev slide" title="prev slide" class="prev-test slider-btn">
										<i class="fa-solid fa-arrow-left"></i>
									</button>
									<button type="button" aria-label="next slide" title="next slide"
									class="next-test slider-btn slider-btn-next">
										<i class="fa-solid fa-arrow-right"></i>
									</button>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				
			</div>

		<?php endif ;?>	
        
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type(new Testimonials_Three());