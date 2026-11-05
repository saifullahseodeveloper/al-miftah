<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Team_Grid_Two extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-team-grid-two-widget';
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
		return esc_html__( 'Team Grid 02', 'charifund-core' );
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
				'label' => esc_html__( 'Team Grid 02', 'charifund-core' ),
			]
		);		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show / Hide Title', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'charifund-core' ),
				'label_off' => __( 'Hide', 'charifund-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter subtitle', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'We are always open for childrenn', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Meet Our Volunteers', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Description', 'charifund-core' ),
                'label_block' => true,
            ]
        );

		$repeater = new \Elementor\Repeater();
		$this->add_control(
			'show_team',
			[
				'label' => __( 'Show / Hide Team', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'charifund-core' ),
				'label_off' => __( 'Hide', 'charifund-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
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

		$this->add_control(
			'show_button',
			[
				'label' => __( 'Show / Hide Button', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'charifund-core' ),
				'label_off' => __( 'Hide', 'charifund-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Read More', 'educharifundall-core' ),
				'label_block' => true,
				'default' => __( 'Become volunteer', 'charifund-core' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button Link', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'Enter Your Link Here', 'charifund-core' ),
			]
		);
		$this->add_control(
			'shape_one',
			[
				'label' => __( 'Shape One', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'shape_two',
			[
				'label' => __( 'Shape Two', 'charifund-core' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

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
			'icon_section',
			[
				'label' => __( 'Right Icon Box', 'charifund-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_icon_box',
			[
				'label' => __( 'Show / Hide Icon Box', 'charifund-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'charifund-core' ),
				'label_off' => __( 'Hide', 'charifund-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
			$this->add_control(
				'icons_type',
				[
					'label' => esc_html__('Select Icon or Image','charifund-core'),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' =>[
						'img' =>[
							'title' =>esc_html__('Image','charifund-core'),
							'icon' =>'fa fa-picture-o',
						],
						'icon' =>[
							'title' =>esc_html__('Icon','charifund-core'),
							'icon' =>'fa fa-info',
						],
						
					],
					'default' => 'select_icon',
				]
			);
			
			$this->add_control(
				'select_icon',
				[
					'label' => esc_html__( 'Select Icon', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'condition'=>[
						'icons_type'=> 'icon',
					],
					'label_block' => true,
				]
			);
			
			$this->add_control(
				'select_img',
				[
					'label' => esc_html__('Select Image','charifund-core'),
					'type'=> \Elementor\Controls_Manager::MEDIA,
					'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'condition' => [
					'icons_type' => 'img',
					]
				]
			);

			$this->add_control(
				'box_title_text',
				[
					'label' => __( 'Title Title', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter title', 'charifund-core' ),
					'label_block' => true,
					'default' => __( 'Become a Volunteer', 'charifund-core' ),
				]
			);
			$this->add_control(
				'box_description_text',
				[
					'label' => __( 'Box Description', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter paragraph', 'charifund-core' ),
					'default' => __( 'Centuries but also the leap electtypesetting, remaining exchange the.', 'charifund-core' ),
				]
			);
			$this->add_control(
				'show_box_button',
				[
					'label' => __( 'Show / Hide Button One', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'charifund-core' ),
					'label_off' => __( 'Hide', 'charifund-core' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$this->add_control(
				'box_button_text',
				[
					'label' => __( 'Button Text', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Read More', 'educharifundall-core' ),
					'label_block' => true,
					'default' => __( 'Join Us Today', 'charifund-core' ),
				]
			);
			$this->add_control(
				'box_button_url',
				[
					'label' => __( 'Button Link', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'Enter Your Link Here', 'charifund-core' ),
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
			$this->add_control('subtitle_color', [
				'label' => esc_html__('SubTitle Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .pg-four .sub-title" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .pg-four .sub-title',
				]
			);
			$this->add_control('title_color', [
				'label' => esc_html__('Title Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} h2" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} h2',
				]
			);
			$this->add_control('name_color', [
				'label' => esc_html__('Name Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-content a" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('name_hover_color', [
				'label' => esc_html__('Name Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-content a:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'selector' => '{{WRAPPER}} .fc-team .team__single-content a',
				]
			);
			$this->add_control('designation_color', [
				'label' => esc_html__('Designation Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-content p" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'designation_typography',
					'selector' => '{{WRAPPER}} .fc-team .team__single-content p',
				]
			);

			$this->add_control('button_color', [
				'label' => esc_html__('Button Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .btn--primary" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('button_hover_color', [
				'label' => esc_html__('Button Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .btn--primary:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'button_typography',
					'selector' => '{{WRAPPER}} .btn--primary',
				]
			);
			$this->add_control('button_bg_color', [
				'label' => esc_html__('Button BG Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .pg-four .btn--primary" => "background-color: {{VALUE}} !important"
				]
			]);
			$this->add_control('button_hover_bg_color', [
				'label' => esc_html__('Button Hover BG Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .pg-four .btn--primary:hover" => "background-color: {{VALUE}} !important"
				]
			]);
			$this->add_control('box_title_color', [
				'label' => esc_html__('Box Title Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt h5" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'box_title_typography',
					'selector' => '{{WRAPPER}} .fc-team .team__single-alt h5',
				]
			);
			$this->add_control('box_desc_color', [
				'label' => esc_html__('Box Description Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt p" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'box_desc_typography',
					'selector' => '{{WRAPPER}} .fc-team .team__single-alt p',
				]
			);
			$this->add_control('box_button_color', [
				'label' => esc_html__('Box Button Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt a" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_control('box_button_hover_color', [
				'label' => esc_html__('Box Button Hover Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt a:hover" => "color: {{VALUE}} !important"
				]
			]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'box_button_typography',
					'selector' => '{{WRAPPER}} .fc-team .team__single-alt a',
				]
			);
			$this->add_control('box_button_bg_color', [
				'label' => esc_html__('Box Button BG Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt a" => "background-color: {{VALUE}} !important"
				]
			]);
			$this->add_control('box_button_hover_bg_color', [
				'label' => esc_html__('Box Button Hover BG Color', 'charifund-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} .fc-team .team__single-alt a:hover" => "background-color: {{VALUE}} !important"
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
		?>
			<div class="pg-four">
				<div class="team fc-team">
					<div class="container">
						<?php if( 'yes'===$settings['show_title'] ){ ?>
							<div class="row justify-content-center">
								<div class="col-12 col-lg-10 col-xl-6">
									<div class="section__header text-center" data-aos="fade-up" data-aos-duration="1000">
										<?php if($settings['subtitle']) : ?>
											<span class="sub-title"><?php echo $settings['subtitle']; ?></span>
										<?php endif; ?>
										<?php if($settings['title']) : ?>
											<h2 class="title-animation mt-0"><?php echo $settings['title']; ?></h2>
										<?php endif; ?>
										<?php if($settings['description']) : ?>
											<p><?php echo $settings['description']; ?></p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="row gutter-40">
							<?php if( 'yes'===$settings['show_team'] ){ ?>
								<?php foreach($team_items as $items) :?>
									<div class="col-12 col-sm-6 col-xl-3">
										<div class="team__single-wrapper" data-aos="fade-up" data-aos-duration="1000">
											<div class="team__single van-tilt">
												<div class="team__single-thumb">
													<?php  if ( !empty(esc_url($items['image']['id']) )) : ?>   
														<img src="<?php echo wp_get_attachment_url($items['image']['id']);?>" alt="<?php echo esc_attr($items['alt_text']);?>"/>
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
							<?php } ?>

							<?php if( 'yes'===$settings['show_icon_box'] ){ ?>
								<div class="col-12 col-sm-6 col-xl-3">
									<div class="team__single-wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
										<div class="team__single-alt text-center van-tilt">
											<?php if($settings['icons_type'] == 'icon' ) : ?>
												<div class="thumb">
													<i class="<?php echo esc_attr($settings['select_icon']['value']); ?>"></i>
												</div>
											<?php else: ?>
												<div class="thumb">
													<img src="<?php echo $settings['select_img']['url'];?>" alt="" />
												</div>
											<?php endif; ?>
											<?php if($settings['box_title_text']) : ?>
												<h5 class="fw-7"><?php echo $settings['box_title_text']; ?></h5>
											<?php endif; ?>
											<?php if($settings['box_description_text']) : ?>
												<p><?php echo $settings['box_description_text']; ?></p>
											<?php endif; ?>
											<?php if( 'yes'===$settings['show_box_button'] ){ ?>
												<a href="<?php echo esc_url($settings['box_button_url']['url']); ?>" aria-label="join us" title="join us">
													<?php echo $settings['box_button_text']; ?>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="section__cta mt-60 text-center">
									<?php if( 'yes'===$settings['show_button'] ){ ?>
										<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="btn--primary">
											<?php echo $settings['button_text']; ?>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="spade">
						<?php if($settings['shape_one']['url']) : ?>
							<img src="<?php echo $settings['shape_one']['url']; ?>" alt="img">
						<?php endif; ?>
					</div>
					<div class="spade-two">
						<?php if($settings['shape_two']['url']) : ?>
							<img src="<?php echo $settings['shape_two']['url']; ?>" alt="img" class="base-img">
						<?php endif; ?>
					</div>
				</div>
			</div>

		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Team_Grid_Two());