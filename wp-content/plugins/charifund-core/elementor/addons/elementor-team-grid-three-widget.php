<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Team_Grid_Three extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-team-grid-three-widget';
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
		return esc_html__( 'Team Grid 03', 'charifund-core' );
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
		return 'eicon-person';
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
				'label' => esc_html__( 'Team Grid 02', 'charifund-core' ),
			]
		);		
		$this->add_control(
            'grid_team_column',
            [
                'label'     =>esc_html__( 'Select Grid Column', 'ennlil' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'col-lg-3',
                'options'   => [
                        'col-lg-12'    =>esc_html__( '1 Columns', 'ennlil' ),
						'col-lg-6'    =>esc_html__( '2 Columns', 'ennlil' ),
                        'col-lg-4'    =>esc_html__( '3 Columns', 'ennlil' ),
                        'col-lg-3'    =>esc_html__( '4 Columns', 'ennlil' ),
                    ],
            ]
        );
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		$repeater->add_control(
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
		$repeater->add_control(
				'name',
				[
					'label'       => __( 'Name', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter Name', 'charifund-core' ),
					'default' => __( 'Arian Drobloas', 'charifund-core' ),
				]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Designation', 'charifund-core' ),
				'default' => __( 'Volunteer', 'charifund-core' ),
			]
		);
		$repeater->add_control(
			'title_link',
			[
			  'label' => __( 'Title Url', 'charifund-core' ),
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
		$this->add_control('team_items', [
            'label' => esc_html__('Team Items', 'charifund-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'image' => array(
                        'url' => Utils::get_placeholder_image_src()
                    )
                ]
            ],
        ]);

		$this->end_controls_section();


		// Tab Start - 2

			$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Team Social Media', 'charifund-core' ),
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
							['block_title' => esc_html__('Team Media', 'charifund-core')],
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

		

			$this->start_controls_section(
				'tab_settings_section',
				[
					'label' => esc_html__('Style Settings', 'charifund-core'),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			
			$this->add_control('name_color', [
				'label' => esc_html__('Name Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single-content h6" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('name_hover_color', [
				'label' => esc_html__('Name Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single-content h6:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'selector' => '{{WRAPPER}} ..ff-team .team__single-content h6',
				]
			);
			$this->add_control('designation_color', [
				'label' => esc_html__('Designation Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single-content p" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('designation_hover_color', [
				'label' => esc_html__('Designation Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single-content p:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'designation_typography',
					'selector' => '{{WRAPPER}} .ff-team .team__single-content p',
				]
			);
			$this->add_control('media_color', [
				'label' => esc_html__('Media Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single__thumb-social ul a" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('media_hover_color', [
				'label' => esc_html__('Media Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .ff-team .team__single__thumb-social ul a:hover" => "color: {{VALUE}} !important"
				]
			]);

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
		$team_items = $settings['team_items'];
		$grid_team_column = $settings['grid_team_column'];
		?>

			<div class="pg-four">
				<div class="team ff-team m-0 p-0">
					<div class="container">
						<div class="row">
							<?php foreach($team_items as $items) :?>
								<div class="<?php echo esc_attr($grid_team_column);?>">
									<div class="team__single-wrapper" data-aos="fade-up" data-aos-duration="1000">
										<div class="team__single van-tilt">
											<div class="team__single-thumb">
												<?php  if ( !empty(esc_url($items['image']['id']) )) : ?>   
													<img src="<?php echo wp_get_attachment_url($items['image']['id']);?>" alt="<?php echo esc_attr($items['alt_text']);?>"/>
												<?php endif;?>
												<div class="team__icons">
													<div class="team__single-content__icon">
														<i class="icon-share"></i>
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
												<?php if($items['name']) : ?>
													<h6><a href="<?php echo esc_url($items['title_link']['url']);?>"><?php echo $items['name'];?></a></h6>
												<?php endif; ?>
												<?php if($items['designation']) : ?>
													<p><?php echo $items['designation'];?></p>
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
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Team_Grid_Three());