<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Service_Grid extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-service-grid-widget';
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
		return esc_html__( 'Service Grid', 'charifund-core' );
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
			'service_grid',
			[
				'label' => esc_html__( 'Service Grid', 'charifund-core' ),
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
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
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
				]
		);

		$this->add_control(
			'button',
			[
				'label'       => __( 'Button', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your button text', 'charifund-core' ),
				'default' => esc_html__('Read More', 'charifund-core'),
			]
		);
		$this->add_control(
			'button_link',
			[
			  'label' => __( 'Button Url', 'charifund-core' ),
			  'type' => Controls_Manager::URL,
			  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
			  'show_external' => true,
			  'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
			  ],
			
		   ]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'service_settings',
			[
				'label' => __( 'Service Setting', 'charifund-core' ),
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
				'selector'  => '{{WRAPPER}} .service.style2 .service-eight-title',
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
					'{{WRAPPER}} .service.style2 .service-eight-title' => 'color: {{VALUE}} !important',
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
				'selector'  => '{{WRAPPER}} .service.style2 .service-eight-paragraph',
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
					'{{WRAPPER}} .service.style2 .service-eight-paragraph' => 'color: {{VALUE}} !important',
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
		?>

		<?php  if ( 'style1' === $settings['style'] ) : ?>	
			<div class="service">	
				<div class="service_grid">
					<div class="single_service">
						<div class="service_single-thumb">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="img"/>
							<?php endif;?>

							<div class="service-buttons">
								<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn"><?php echo $settings['button'];?>
								<i class="fa-solid fa-arrow-right"></i>
								</a>
							</div>

						</div>

						<div class="service_single-content">	
							<h6><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h6>
							<p><?php echo $settings['subtitle'];?></p>
						</div>
					</div>
				</div>
			</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>		
		<div class="service style2">
				<div class="service-eight-thumb position-relative z-1">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
                        <a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
                     <?php endif;?>
                        <div class="service-eight-button">
                        	<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn--primary"><?php echo $settings['button'];?> <i class="fa-solid fa-arrow-right"></i></a>
                           <!-- <a href="#"><i class="fa-solid fa-arrow-right"></i></a> -->
                        </div>
                        <div class="service-eight-wrap">
                           <h4 class="service-eight-title"><?php echo $settings['title'];?></h4>
                           <p class="service-eight-paragraph"><?php echo $settings['subtitle'];?></p>
                        </div>
                     </div>
                  </div>
                  
        	<?php  elseif ( 'style3' === $settings['style'] ) : ?>		
		        <div class="service style3">
				    <div class="service-eight-thumb">
					    <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
                            <a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
                         <?php endif;?>
                        <div class="content">
                            <div class="service-eight-wrap">
                               <h4 class="service-eight-title"><?php echo $settings['title'];?></h4>
                               <p class="service-eight-paragraph"><?php echo $settings['subtitle'];?></p>
                            </div>
                            <div class="service-eight-button">
                            	<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn-primary"><span><i class="fa-solid fa-arrow-right"></i></span><?php echo $settings['button'];?> </a>
                               
                            </div>
                        </div>
                     </div>
                  </div>
		<?php elseif ( 'style4' === $settings['style'] ) : ?>		
			<div class="service style2 style4">
				<div class="service-eight-thumb position-relative z-1">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
                        <a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
                     <?php endif;?>
                        
                        <div class="service-eight-wrap">
                           <h4 class="service-eight-title"><?php echo $settings['title'];?></h4>
                           <p class="service-eight-paragraph"><?php echo $settings['subtitle'];?></p>

                           <div class="service-eight-button">
                        		<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn"><?php echo $settings['button'];?> <i class="fa-solid fa-arrow-right"></i></a>
                           
                        	</div>
                        </div>
                </div>
            </div>
		<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Service_Grid());