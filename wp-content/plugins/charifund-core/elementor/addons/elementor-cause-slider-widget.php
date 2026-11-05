<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Cause_Slider extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-cause-slider-widget';
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
		return esc_html__( 'Cause Slider', 'charifund-core' );
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
			'cause_slider',
			[
				'label' => esc_html__( 'Cause Slider', 'charifund-core' ),
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
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__('', 'charifund-core')
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

						'block_button_link' =>
						[
							'name' => 'block_button_link',
							'label' => esc_html__('Button Link', 'charifund-core'),
							'type' => Controls_Manager::URL,
							'default' => ['url' => '',],
						],

						'block_class' =>
						[
							'name' => 'block_class',
							'label' => __( 'Select Card Style', 'charifund-core' ),
							'type' => Controls_Manager::SELECT,
							'options' => [
								'difference__single-first' => __( 'Style 1', 'charifund-core' ),
								'difference__single-second' => __( 'Style 2', 'charifund-core' ),
								'difference__single-third' => __( 'Style 3', 'charifund-core' ),
								],
								'default' => 'difference__single-first',
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
		?>

<?php
	  echo '
	 <script>
 jQuery(document).ready(function($) {

// js code start

   var differenceSlider = new Swiper(".difference__slider", {
      loop: true,
      speed: 1000,
      slidesPerView: 1,
      slidesPerGroup: 1,
      spaceBetween: 24,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        nextEl: ".next-difference",
        prevEl: ".prev-difference",
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


	 var causeTwoSlider = new Swiper(".cause-two__slider", {
      loop: true,
      speed: 1000,
      slidesPerView: 1,
      slidesPerGroup: 1,
      spaceBetween: 24,
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      loopAddBlankSlides: true,
      loopAdditionalSlides: 1,
      slideToClickedSlide: true,
      roundLengths: true,
      coverflowEffect: {
        rotate: 40,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      thumbs: {
        swiper: causeTwoSliderThumb,
      },
      navigation: {
        nextEl: ".next-cause-two",
        prevEl: ".prev-cause-two",
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1400: {
          slidesPerView: 3,
        },
      },
    });


	   var causeTwoSliderThumb = new Swiper(".cause-two__content-slider", {
      loop: true,
      speed: 1000,
      slidesPerView: 1,
      slidesPerGroup: 1,
      spaceBetween: 24,
      centeredSlides: true,
      watchSlidesProgress: true,
      effect: "fade",

      fadeEffect: {
        crossFade: true,
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      navigation: {
        nextEl: ".next-cause-two",
        prevEl: ".prev-cause-two",
      },
    });

// js code end 

  });
</script>';


?>

<?php  if ( 'style1' === $settings['style'] ) : ?>	

<section class="difference p-0">
	<div class="difference__inner">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<div class="difference__slider swiper">
					<div class="swiper-wrapper">
					<?php foreach($settings['repeat'] as $item):?>	
						<div class="swiper-slide">
							<div class="difference__single-wrapper">
							<div class="difference__single <?php echo esc_attr($item['block_class']); ?>"
								data-background="<?php echo wp_get_attachment_url($item['block_bg_image']['id']);?>">
								<div class="difference__single-thumb">
									<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
								</div>
								<div class="difference__single-content">
									<h5><a href="<?php echo esc_url($item['block_button_link']['url']);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></a></h5>
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
		<div class="slider-navigation">
			<button type="button" aria-label="prev slide" title="prev slide"
				class="prev-difference slider-btn">
			<i class="fa-solid fa-arrow-left"></i>
			</button>
			<button type="button" aria-label="next slide" title="next slide"
				class="next-difference slider-btn slider-btn-next">
			<i class="fa-solid fa-arrow-right"></i>
			</button>
		</div>
	</div>
	</section>

	<?php  elseif ( 'style2' === $settings['style'] ) : ?>	
						
		<section class="cause-two">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
                     <div class="cause-two__inner">
                        <div class="slider-navigation">
                           <button type="button" aria-label="prev slide" title="prev slide"
                              class="prev-cause-two slider-btn">
                           <i class="fa-solid fa-arrow-left"></i>
                           </button>
                           <button type="button" aria-label="next slide" title="next slide"
                              class="next-cause-two slider-btn slider-btn-next">
                           <i class="fa-solid fa-arrow-right"></i>
                           </button>
                        </div>
                        <div class="cause-two__slider swiper">
                           <div class="swiper-wrapper">
						  	<?php foreach($settings['repeat'] as $item):?>	
                              <div class="swiper-slide">
                                 <div class="cause-two__slider-single">
                                    <div class="cause-thumb">
										<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
											<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
										<?php endif;?>
                                       <a href="<?php echo esc_url($item['block_button_link']['url']);?>">
                                       		<i class="fa-solid fa-arrow-right"></i>
                                       </a>
                                    </div>
                                 </div>
                              </div>
							<?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                     <div class="cause-two__content-slider swiper">
                        <div class="swiper-wrapper">
							<?php foreach($settings['repeat'] as $item):?>	
                           <div class="swiper-slide">
                              <div class="cause-content">
                                 <h4><?php echo wp_kses($item['block_title'], $allowed_tags);?></h4>
                                 <p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
                              </div>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		 <?php  elseif ( 'style3' === $settings['style'] ) : ?>	
		
			<div class="gallery">
            <div class="gallery__inner">
               <div class="gallery__slider">
			   	<?php foreach($settings['repeat'] as $item):?>	
                  <div class="gallery__single">
				  	<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
						<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
					<?php endif;?>
                     <a href="<?php echo esc_url($item['block_button_link']['url']);?>">
                     <i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
                     </a>
                  </div>
				  <?php endforeach; ?>
               </div>
            </div>
         </div>

<?php endif; ?>

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Cause_Slider());