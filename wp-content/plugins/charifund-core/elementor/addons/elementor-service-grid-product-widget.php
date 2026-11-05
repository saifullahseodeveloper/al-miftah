<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Service_Grid_Product extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-service-grid-product-widget';
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
		return esc_html__( 'Service Grid Product', 'charifund-core' );
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
				'label'       => __( 'Price', 'charifund-core' ),
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
				'rating',
				[
					'label' => esc_html__( 'Rating', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 5,
					'step' => 1,
					'default' => 3,
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
				'default' => esc_html__('Add To Card', 'charifund-core'),
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
			<div class="service service_product">
				<div class="service-14-thumb position-relative z-1">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
						<a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
					<?php endif;?>
					<div class="service-14-wrap">
						<div class="review_star">
						<?php if( $settings['rating']==5 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==4 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==3 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==2 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==1 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>
					</div>

						<h4 class="service-14-title"><?php echo $settings['title'];?></h4>
						<p class="service-14-paragraph pb-3"><?php echo $settings['subtitle'];?></p>
					</div>
				</div>
			</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>		
			<div class="service service_product">
				<div class="service-14-thumb position-relative z-1">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
						<a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
					<?php endif;?>

					<div class="icons">
						<ul>
							<li><i class="fas fa-eye"></i></li>
						</ul>
						<ul>
							<li><i class="far fa-heart"></i></li>
						</ul>
						<ul>
							<li><i class="far fa-star"></i></li>
						</ul>

					</div>

					<div class="service-14-button">
						<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn"><?php echo $settings['button'];?></a>
					</div>
					<div class="service-14-wrap">
						<div class="review_star">
						<?php if( $settings['rating']==5 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==4 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==3 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==2 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==1 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>
					</div>

						<h4 class="service-14-title"><?php echo $settings['title'];?></h4>
						<p class="service-14-paragraph"><?php echo $settings['subtitle'];?></p>
					</div>
				</div>
			</div>
		<?php elseif ( 'style3' === $settings['style'] ) : ?>		
			<div class="service service_product">
				<div class="service-14-thumb position-relative z-1">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
						<a href="#"><img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb"></a>
					<?php endif;?>

					<div class="icons">
						<ul>
							<li><i class="fas fa-eye"></i></li>
						</ul>
						<ul>
							<li><i class="far fa-heart"></i></li>
						</ul>
						<ul>
							<li><i class="far fa-star"></i></li>
						</ul>

					</div>

					<div class="service-14-button">
						<a href="<?php echo esc_url($settings['button_link']['url']);?>" class="btn"><?php echo $settings['button'];?></a>
					</div>
					<div class="service-14-wrap">
						<div class="review_star">
						<?php if( $settings['rating']==5 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==4 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>

						<?php if( $settings['rating']==3 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==2 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>												
						<?php } ?>

						<?php if( $settings['rating']==1 ){ ?>
							<div class="testi-star">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						<?php } ?>
					</div>

						<h4 class="service-14-title"><?php echo $settings['title'];?></h4>
						<p class="service-14-paragraph"><?php echo $settings['subtitle'];?></p>
					</div>
				</div>
			</div>
		<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Service_Grid_Product());