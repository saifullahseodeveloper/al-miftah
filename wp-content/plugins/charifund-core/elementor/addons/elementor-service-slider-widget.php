<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Service_Slider extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-service-slider-widget';
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
		return esc_html__( 'Service Slider', 'charifund-core' );
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
			'service',
			[
				'label' => esc_html__( 'Service', 'charifund-core' ),
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
					
						'title' => [
							'name' => 'title',
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						'description' => [
							'name' => 'description',
							'label' => esc_html__('Subtitle', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						'block_image' => [
							'name' => 'block_image',
							'label' => __( 'Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],	
	
						'button'=> [
							'name' => 'button',
							'label'       => __( 'Button', 'charifund-core' ),
							'type'        => Controls_Manager::TEXT,
							'default' => esc_html__('Read More', 'charifund-core'),
						],
						
						'button_link'=> [
						    'name' => 'button url',
						    'label' => __( 'Button Url', 'charifund-core' ),
						    'type' => Controls_Manager::TEXT,
						    
					    ],
					
						'icons'=> [
							'name' => 'icon',
							'label'   => esc_html__( 'Select Icon', 'charifund-core' ),
							'type'    => Controls_Manager::ICONS,
							'default' => [
								'value'   => 'fas fa-star',
								'library' => 'fa-solid',
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

			var testimonial = new Swiper(".service_slider", {
				loop: true,
				speed: 1000,
				slidesPerView: 3.5,
				slidesPerGroup: 1,
				spaceBetween: 24,

				autoplay: {
					delay: 2000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},
				navigation: {
				    prevEl: ".prev-testimonial",
					nextEl: ".next-testimonial",
				},

				breakpoints: {
				320: {
					slidesPerView: 1,
					},
					768: {
					slidesPerView: 2,
					},
					1200: {
					slidesPerView: 2,
					},
					1500: {
					slidesPerView: 3.5,
					},
				},
			});

		
			// js code end 

			});
			</script>';


		?>

		<?php  if ( 'style1' === $settings['style'] ) : ?>	
			<div class="service p-0">
				<div class="service__inner">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="service_slider swiper">
									<div class="swiper-wrapper">
										<?php foreach($settings['repeat'] as $item):?>	
											<div class="swiper-slide">
												<div class="service_slider-single">

													<div class="all-content">
														<div class="img-thumb">
															<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
																<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="img">
															<?php endif;?>
														</div>
														<div class="text-content">
															<h6><?php echo wp_kses($item['title'], $allowed_tags);?></h6>
															<p><?php echo wp_kses($item['description'], $allowed_tags);?></p>
															
														    <?php if($item['button']) : ?>
    												            <div class="service-button">
    														        <a href="<?php echo $item['button_link'];?>" class="btn-primary"><?php echo $item['button'];?></a>
    														    </div>
    												        <?php endif; ?>
													
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
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>	
			
		<?php  elseif ( 'style3' === $settings['style'] ) : ?>	
			
		<?php  elseif ( 'style4' === $settings['style'] ) : ?>
			


		<?php endif ;?>	
        
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type(new Service_Slider());