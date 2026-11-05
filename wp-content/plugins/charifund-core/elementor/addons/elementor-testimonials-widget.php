<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Testimonials extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-testimonials-widget';
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
		return esc_html__( 'Testimonials Widget', 'charifund-core' );
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
					'style4'   => esc_html__( 'Style Four', 'charifund-core' ),
					'style5'   => esc_html__( 'Style Five', 'charifund-core' ),
					'style6'   => esc_html__( 'Style Six', 'charifund-core' ),
				),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
				'condition'	=> ['style' => ['style2', 'style4']],
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
				'condition'	=> ['style' => ['style2', 'style4']],
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' => esc_html__('Background image', 'charifund-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style2']],
			]
		);	

		
		$this->add_control(
			'image', [
				'label' => __( 'Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style2','style3', 'style4']],
			]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style2','style3']],
			]
		);

		$this->add_control(
			'image2',
				[
				'label' => __( 'Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style2']],
			]
		);	
		
		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style2']],
			]
		);

		$this->add_control(
			'image3',
				[
				'label' => __( 'Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style2']],
			]
		);	
		
		$this->add_control(
			'alt_text3',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style2']],
			]
		);

		$this->add_control(
			'image4',
				[
				'label' => __( 'Image', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
				'condition'	=> ['style' => ['style2']],
			]
		);	
		
		$this->add_control(
			'alt_text4',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				'condition'	=> ['style' => ['style2']],
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
					    
					    'block_top_title' =>
						[
							'name' => 'block_top_title',
							'label' => esc_html__('Top Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
							// 'condition'	=> ['style' => ['style5']],
						],
					
						'block_title' =>
						[
							'name' => 'block_title',
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
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
								'rat5'   => esc_html__( 'Rating Five', 'charifund-core' ),
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

			var testimonialTwo = new Swiper(".testimonial-two__slider", {
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
					nextEl: ".next-testimonial-two",
					prevEl: ".prev-testimonial-two",
				},
			});

			var testimonialThree = new Swiper(".testimonial-three__slider", {
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
					nextEl: ".next-testimonial-three",
					prevEl: ".prev-testimonial-three",
				},

				breakpoints: {
					1400: {
					slidesPerView: 2,
					},
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
			
			var testimonial = new Swiper(".testimonial_14", {
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
					slidesPerView: 2,
					},
				},
			});
			
			
			var testimonial = new Swiper(".testimonial_15", {
				loop: false,
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
					slidesPerView: 2,
					},
					1200: {
					slidesPerView: 3,
					},
					1500: {
					slidesPerView: 3,
					},
				},

				pagination: {
                  el: ".ministrie-eight-dotss",
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
					<div class="slider-navigation">
						<button type="button" aria-label="prev slide" title="prev slide"
							class="prev-testimonial slider-btn">
						<i class="fa-solid fa-arrow-left"></i>
						</button>
						<button type="button" aria-label="next slide" title="next slide"
							class="next-testimonial slider-btn slider-btn-next">
						<i class="fa-solid fa-arrow-right"></i>
						</button>
					</div>
				</div>
			</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>	
			<div class="testimonial-two">
				<div class="container">
				<div class="row">
					<div class="col-12 col-lg-9 col-xl-5">
						<?php if($settings['title']): ?>
						<div class="section__header">
							<span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
							<h2 class="title-animation"><?php echo $settings['title'];?></h2>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="testimonial-two__inner" data-background="<?php echo wp_get_attachment_url($settings['bg_image']['id']);?>">
						<div class="row align-items-center">
							<div class="col-12 col-lg-5 d-none d-lg-block">
							<div class="testimonial-two__thumb">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
								<?php endif;?>
								<div class="quote-thumb">
									<i class="fa-solid fa-quote-right"></i>
								</div>
							</div>
							</div>
							<div class="col-12 col-lg-7 col-xl-6">
							<div class="testimonial-two__content">
								<div class="testimonial-two__slider swiper">
									<div class="swiper-wrapper">
										<?php foreach($settings['repeat'] as $item):?>	
										<div class="swiper-slide">
										<div class="testimonial-two__single">
											<div class="author-info">
												<div class="author-thumb">
												<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
													<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
												<?php endif;?>
												</div>
												<div class="author-content">
													<h5><?php echo wp_kses($item['block_title'], $allowed_tags);?></h5>
													<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
												</div>
											</div>
											<div class="testimonial-two__single-content">
												<h5><?php echo wp_kses($item['block_text'], $allowed_tags);?></h5>
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
										</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="slider-navigation cta">
									<button type="button" aria-label="prev slide" title="prev slide"
										class="prev-testimonial-two slider-btn">
									<i class="fa-solid fa-arrow-left"></i>
									</button>
									<button type="button" aria-label="next slide" title="next slide"
										class="next-testimonial-two slider-btn slider-btn-next">
									<i class="fa-solid fa-arrow-right"></i>
									</button>
								</div>
								<div class="quote">
									<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
										<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
									<?php endif;?>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="blog-bg">
				<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
				<?php endif;?>
				</div>
				<div class="spade">
				<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
						<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
					<?php endif;?>
				</div>
			</div>
		<?php  elseif ( 'style3' === $settings['style'] ) : ?>	
			<div class="testimonial-three p-0">
				<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-9 col-xxl-12">
						<div class="testimonial-three__inner">
							<div class="testimonial-three__slider swiper">
							<div class="swiper-wrapper">
								<?php foreach($settings['repeat'] as $item):?>	
								<div class="swiper-slide">
									<div class="testimonial-three__single">
										<div class="thumb">
											<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
												<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
											<?php endif;?>
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
										<div class="testimonial-three__content">
										<div class="author-info">
											<div class="author-content">
												<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
												<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
											</div>
											<div class="quote">
												<i class="icon-quotation-two"></i>
											</div>
										</div>
										<p><?php echo wp_kses($item['block_text'], $allowed_tags);?> </p>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="slider-navigation">
							<button type="button" aria-label="prev slide" title="prev slide"
							class="prev-testimonial-three slider-btn">
							<i class="fa-solid fa-arrow-left"></i>
							</button>
							<button type="button" aria-label="next slide" title="next slide"
							class="next-testimonial-three slider-btn slider-btn-next">
							<i class="fa-solid fa-arrow-right"></i>
							</button>
						</div>
					</div>
				</div>
				</div>
				<div class="spade">
				<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>
				</div>
			</div>
		<?php  elseif ( 'style4' === $settings['style'] ) : ?>
			<div class="testimonial fc-testimonial pt-120 pb-120 pg-four">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-12 col-xl-4">
							<div class="fc-test__thumb d-none d-xl-block">
								<?php if($settings['image']['url']) : ?>
									<img src="<?php echo $settings['image']['url']; ?>" alt="">
								<?php endif; ?>
							</div>
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
								<div class="slider-navigation">
									<button type="button" aria-label="prev slide" title="prev slide" class="prev-test slider-btn">
										<i class="fa-solid fa-arrow-left"></i>
									</button>
									<button type="button" aria-label="next slide" title="next slide"
									class="next-test slider-btn slider-btn-next">
										<i class="fa-solid fa-arrow-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if($settings['title']) : ?>
					<span class="test-text"><?php echo $settings['title']; ?></span>
				<?php endif; ?>
				<?php if($settings['subtitle']) : ?>
					<div class="feed">
						<svg xmlns="http://www.w3.org/2000/svg" width="31" height="37" viewBox="0 0 31 37" fill="none">
						<path
							d="M0 9.7657L0 32.2089C0 34.3788 1.76172 36.1348 3.92942 36.1348H16.1925C17.2803 36.1348 18.2607 35.6977 18.973 34.9846C19.6854 34.2792 20.122 33.2977 20.122 32.2089C20.122 31.9482 20.3518 31.7488 20.6199 31.7872L24.848 32.4466C25.2616 32.5156 25.5068 32.0249 25.2157 31.7335L20.2446 26.6499C20.1679 26.5655 20.122 26.4659 20.122 26.3508L20.122 9.7657C20.122 7.59574 18.3679 5.83219 16.1925 5.83219H3.92942C1.76172 5.83219 0 7.59574 0 9.7657ZM9.72777 27.1483L10.7848 28.2371C10.8767 28.3291 11.0146 28.3751 11.1448 28.3521L12.6385 28.0914C12.9602 28.0377 13.213 28.3828 13.0598 28.6742L12.3551 30.0236C12.2938 30.1387 12.2938 30.2767 12.3551 30.3917L13.0598 31.7488C13.213 32.0402 12.9678 32.3853 12.6385 32.3239L11.1448 32.0709C11.0146 32.0479 10.8844 32.0939 10.7925 32.1859L9.72777 33.2747C9.49032 33.5124 9.09205 33.3821 9.03842 33.0524L8.82393 31.5495C8.80864 31.4191 8.72435 31.3042 8.60948 31.2428L7.23837 30.568C6.93968 30.4224 6.93968 29.993 7.23837 29.8473L8.60948 29.1802C8.72435 29.1188 8.80864 29.0039 8.82393 28.8735L9.03842 27.3706C9.09205 27.0409 9.49032 26.9106 9.72777 27.1483ZM9.72777 17.9241L10.7848 19.0129C10.8767 19.1049 11.0146 19.1509 11.1448 19.1279L12.6385 18.8672C12.9602 18.8135 13.213 19.1509 13.0598 19.4499L12.3551 20.7995C12.2938 20.9144 12.2938 21.0525 12.3551 21.1675L13.0598 22.517C13.213 22.8161 12.9678 23.1534 12.6385 23.0998L11.1448 22.8467C11.0146 22.8237 10.8844 22.8697 10.7925 22.9617L9.72777 24.0505C9.49032 24.2882 9.09205 24.1579 9.03842 23.8282L8.82393 22.3253C8.80864 22.195 8.72435 22.0799 8.60948 22.0186L7.23837 21.3438C6.93968 21.1982 6.93968 20.7688 7.23837 20.6231L8.60948 19.956C8.72435 19.8947 8.80864 19.7796 8.82393 19.6493L9.03842 18.1464C9.09205 17.8167 9.49032 17.6864 9.72777 17.9241ZM9.72777 8.69988L10.7848 9.78872C10.8767 9.88073 11.0146 9.91906 11.1448 9.89603L12.6385 9.64303C12.9602 9.58168 13.213 9.92673 13.0598 10.2257L12.3551 11.5676C12.2938 11.6903 12.2938 11.8283 12.3551 11.9433L13.0598 13.2928C13.213 13.5842 12.9678 13.9292 12.6385 13.8755L11.1448 13.6225C11.0146 13.5995 10.8844 13.6455 10.7925 13.7375L9.72777 14.8263C9.49032 15.0641 9.09205 14.9337 9.03842 14.604L8.82393 13.0935C8.80864 12.9631 8.72435 12.8558 8.60948 12.7944L7.23837 12.1197C6.93968 11.9663 6.93968 11.5446 7.23837 11.3989L8.60948 10.7242C8.72435 10.6705 8.80864 10.5555 8.82393 10.4251L9.03842 8.92227C9.09205 8.59257 9.49032 8.46218 9.72777 8.69988Z"
							fill="white" />
						<path
							d="M9.07395 0.0969944H21.3448C22.4324 0.0969944 23.4129 0.541733 24.1253 1.24714C24.8299 1.96023 25.2665 2.94934 25.2665 4.0305C25.2665 4.29118 25.504 4.49055 25.7644 4.44454L29.9926 3.79281C30.4062 3.72378 30.6513 4.21452 30.3679 4.5059L25.3891 9.58955C25.3202 9.67389 25.2665 9.77357 25.2665 9.8886L25.2665 26.4737C25.2665 27.3478 24.9831 28.1529 24.5006 28.8047L21.6588 25.8986L21.6588 9.76589C21.6588 6.75251 19.2078 4.29885 16.1975 4.29885H5.14453V4.0305C5.14453 1.86055 6.89863 0.0969944 9.07395 0.0969944Z"
							fill="white" />
						</svg><span><?php echo $settings['subtitle']; ?></span>
					</div>
				<?php endif; ?>
			</div>

		<?php elseif( 'style5' === $settings['style'] ) : ?>	
			<div class="testimonial home_14 p-0">
				<div class="testimonial__inner">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="testimonial_14 swiper">
									<div class="swiper-wrapper">
										<?php foreach($settings['repeat'] as $item):?>	
											<div class="swiper-slide">
												<div class="testimonial__slider-single">

													<div class="top">
														<div class="quotes">
															<?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
																<img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
															<?php endif;?>
														</div>

														<h3><?php echo wp_kses($item['block_top_title'], $allowed_tags);?></h3>
													</div>

													<div class="content">
														<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
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

												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		<?php elseif( 'style6' === $settings['style'] ) : ?>	
			<div class="testimonial home_14 home_15 p-0">
				<div class="testimonial__inner">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="testimonial_15 swiper">
									<div class="swiper-wrapper">
										<?php foreach($settings['repeat'] as $item):?>	
											<div class="swiper-slide">
												<div class="testimonial__slider-single">

													<div class="top">
														<div class="quotes">
															<?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
																<img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
															<?php endif;?>
														</div>

														<h3><?php echo wp_kses($item['block_top_title'], $allowed_tags);?></h3>
													</div>

													<div class="content">
														<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
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
		                     <div class="ministrie-eight-dotss text-center"></div>
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
		<?php endif ;?>	
        
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type(new Testimonials());