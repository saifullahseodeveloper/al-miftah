<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Mission extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-mission-widget';
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
		return esc_html__( 'Mission Widget', 'charifund-core' );
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
			'mission',
			[
				'label' => esc_html__( 'Mission', 'charifund-core' ),
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
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core'),
						],

						'block_description' =>
						[
							'name' => 'block_description',
							'label' => esc_html__('Description', 'charifund-core'),
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

							

						

						
					],
				'title_field' => '{{block_title}}',
			 ]
	);
		
		
	$this->end_controls_section();	
	
	
	$this->start_controls_section(
			'mission_settings',
			[
				'label' => __( 'Mission Setting', 'charifund-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'subtitle_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				// 'condition' => [
				// 	'subtitle' => 'show',
				// ],
				'selector'  => '{{WRAPPER}} .ministrie-eight-paragraph',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				// 'condition' => [
				// 	'subtitle' => 'show',
				// ],
				'selectors' => [
					'{{WRAPPER}} .ministrie-eight-paragraph' => 'color: {{VALUE}} !important',
				],
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'charifund-core' ),
				// 'condition' => [
				// 	'title' => 'show',
				// ],
				'selector'  => '{{WRAPPER}} .ministrie-eight-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'charifund-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				// 'condition' => [
				// 	'title' => 'show',
				// ],
				'selectors' => [
					'{{WRAPPER}} .ministrie-eight-title' => 'color: {{VALUE}} !important',
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

			// js code start

			var testimonial = new Swiper(".ministrie-eight-active", {
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
				
				
				pagination: {
                  el: ".ministrie-eight-dot",
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
	<div class="mission-section">
		<div class="mission">
			<div class="ministrie-eight-slide p-relative">
				<div class="ministrie-eight-active swiper-container swiper">
					<div class="ministrie-eight-swiper-wrapper swiper-wrapper">
						<?php foreach($settings['repeat'] as $item):?>	
						<div class="swiper-slide">
							<div class="mission-single">
								<div class="ministrie-eight-wrapper swiper-slide">
									<div class="ministrie-eight-thumb position-relative z-1">
													<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
												<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="">
													<?php endif;?>
										<div class="ministrie-eight-wrap">
											<div class="ministrie-eight-button">
												<a href="#"><i class="fa-solid fa-arrow-right"></i></a>
												<!-- <a href="<?php echo esc_url($item['button_link']['url']);?>" class="btn--primary"><?php echo $item['button'];?> <i class="fa-solid fa-arrow-right"></i></a> -->
											</div>
											<div class="ministrie-eight-content">
												<h4 class="ministrie-eight-title"><?php echo wp_kses($item['block_title'], $allowed_tags);?></h4>
												<p class="ministrie-eight-paragraph"><?php echo wp_kses($item['block_description'], $allowed_tags);?></p>
											</div>
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
		
		<div class="container">
            <div class="ministrie-eight-space">
               <div class="row align-items-center justify-content-between">
                  <div class="col-xl-3 col-lg-3 col-md-4">
                     <div class="ministrie-eight-dot text-center"></div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-7">
                     <div class="ministrie-eight-scrollbar position-relative z-1">
                        <div class="swiper-scrollbar two"></div>
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

Plugin::instance()->widgets_manager->register_widget_type(new Mission());