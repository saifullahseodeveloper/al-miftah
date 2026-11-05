<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Team_Grid_Six extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-team-grid-six-widget';
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
		return esc_html__( 'Team Grid 06', 'charifund-core' );
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
				'description',
				[
					'label'       => __( 'Description', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'charifund-core' ),
				]
		);

		$this->add_control(
				'social_title',
				[
					'label'       => __( 'Social Title', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'charifund-core' ),
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
			<div class="single-team">
			<div class="active-with-click">
				<div class="material-card">
					<h2>
						<span><?php echo $settings['title'];?></span>
						<strong>
							<p><?php echo $settings['subtitle'];?></p>
						</strong>
					</h2>
					<div class="mc-content">
						<div class="img-container">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img class="img-responsive" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="img"/>
							<?php endif;?>
						</div>
						<div class="mc-description">
							<p><?php echo $settings['description'];?></p>
						</div>
					</div>
					<a class="mc-btn-action">
						<i class="fa fa-bars"></i>
					</a>
					<div class="mc-footer">
						<h4>
							<?php echo $settings['social_title'];?>
						</h4>
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
			</div>
		<?php  elseif ( 'style2' === $settings['style'] ) : ?>		
			<div class="single-team">
			<div class="active-with-click">
				<div class="material-card">
					<h2>
						<span><?php echo $settings['title'];?></span>
						<strong>
							<p><?php echo $settings['subtitle'];?></p>
						</strong>
					</h2>
					<div class="mc-content">
						<div class="img-container">
							<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
								<img class="img-responsive" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="img"/>
							<?php endif;?>
						</div>
						<div class="mc-description">
							<p><?php echo $settings['description'];?></p>
						</div>
					</div>
					<a class="mc-btn-action">
						<i class="fa fa-bars"></i>
					</a>
					<div class="mc-footer">
						<h4>
							<?php echo $settings['social_title'];?>
						</h4>
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
			</div>


		<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Team_Grid_Six());