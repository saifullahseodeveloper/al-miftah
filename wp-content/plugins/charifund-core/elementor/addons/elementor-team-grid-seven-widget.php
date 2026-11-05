<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Team_Grid_Seven extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-team-grid-seven-widget';
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
		return esc_html__( 'Team Grid 7', 'charifund-core' );
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
			'team_grid',
			[
				'label' => esc_html__( 'Team Grid', 'charifund-core' ),
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
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
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

		// Tab Start - 2

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Team Grid Block', 'charifund-core' ),
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

						'block_icons' =>
						[
							'name' => 'block_icons',
							'label' => esc_html__('Enter The icons', 'charifund-core'),
							'type' => Controls_Manager::ICONS,							
						],
						
						'block_button_link' =>
						[
						  'name' => 'block_button_link',
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
		?>

		<?php  if ( 'style1' === $settings['style'] ) : ?>	
			<div class="team p-0 m-0">	
				<div class="team__single-wrapper">
					<div class="team__single van-tilt">
						<div class="team__single-thumb">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
							<?php endif;?>
							<div class="team__icons">
								<div class="team__single-content__icon">
								<i class="fa-solid fa-plus"></i>
								</div>
								<div class="team__single__thumb-social">
									<ul>
										<?php foreach($settings['repeat'] as $item):?>	
										<li>
											<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
											<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="team__single-content">
							<h6><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h6>
							<p><?php echo $settings['subtitle'];?></p>
						</div>
					</div>
				</div>
			</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>		
			<div class="team-nine-area">
				<div class="team__single-wrapper">
					<div class="position-relative z-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                     <div class="team-eight-wrapper team-nine-wrapper">
                        <div class="team-eight-thumb position-relative z-1">
                           <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
							<?php endif;?>
                           <div class="team-eight-social">
                              <span><i class="fa-regular fa-plus"></i></span>
                              <div class="team-eight-social-icon">
                                 <ul>
										<?php foreach($settings['repeat'] as $item):?>	
										<li>
											<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
											<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
                              </div>
                           </div>
                           <div class="team-eight-content text-center">
                              <h4 class="team-eight-title"><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h4>
                              <p class="team-eight-paragraph"><?php echo $settings['subtitle'];?></p>
                           </div>
                        </div>
                        <div class="team-nine-overlay"></div>
                     </div>
                  </div>
				</div>
			</div>
		<?php elseif ( 'style3' === $settings['style'] ) : ?>		
			<div class="team-14-area">
				<div class="team_single">
					<div class="team-14-wrapper">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="img"/>
							<?php endif;?>
							<div class="team-14-content">
								<div class="team-14-social-icon">
									<ul>
										<?php foreach($settings['repeat'] as $item):?>	
											<li>
												<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
													<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>

								<h4 class="team-14-title"><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h4>
								<p class="team-designation"><?php echo $settings['subtitle'];?></p>
							</div>
					</div>
				</div>
			</div>
		<?php elseif ( 'style4' === $settings['style'] ) : ?>	
			<div class="team style-4 p-0 m-0">	
				<div class="team__single-wrapper">
					<div class="team__single van-tilt">
						<div class="team__single-thumb">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
							<?php endif;?>
							
						</div>

						<div class="team__icons">
								<div class="team__single-content__icon">
								<i class="fa-solid fa-plus"></i>
								</div>
								<div class="team__single__thumb-social">
									<ul>
										<?php foreach($settings['repeat'] as $item):?>	
										<li>
											<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
											<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							
						<div class="team__single-content">
							<h6><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h6>
							<p><?php echo $settings['subtitle'];?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Team_Grid_Seven());