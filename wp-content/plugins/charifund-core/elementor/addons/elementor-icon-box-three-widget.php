<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_Icon_Box_Three_Widget extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Elementor widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'charifund-icon-box-three-widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve Elementor widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('charifund Icon Box 03', 'charifund-core');
    }

    public function get_keywords()
    {
        return ['icon', 'Box', 'icon box', 'charifund'];
    }

    /**
     * Get widget icon.
     *
     * Retrieve Elementor widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
	public function get_icon() {
		return 'eicon-icon-box';
	}

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Elementor widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['charifund_widgets'];
    }

    /**
     * Register Elementor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon Box', 'charifund-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
            $this->add_control(
                'icons_type',
                [
                    'label' => esc_html__('Icon Type','charifund-core'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' =>[
                    'img' =>[
                        'title' =>esc_html__('Image','charifund-core'),
                        'icon' =>'fa fa-picture-o',
                    ],
                    'icon' =>[
                        'title' =>esc_html__('Icon','charifund-core'),
                        'icon' =>'fa fa-info',
                    ]
                    ],
                    'default' => 'icon',
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
                    'condition' => [
                    'icons_type' => 'img',
                    ]
                ]
            );

			$this->add_control(
				'title_text',
				[
					'label' => __( 'Title', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter title', 'charifund-core' ),
					'label_block' => true,
					'default' => __( 'We Educate & help poor people', 'charifund-core' ),
				]
			);
            $this->add_control(
				'desc_text',
				[
					'label' => __( 'Description', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter title', 'charifund-core' ),
					'label_block' => true,
					'default' => __( 'Transmax is the world tr we uphold industry Cu stomer Oriented', 'charifund-core' ),
				]
			);
            $this->add_control(
                'show_button',
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
                'button_text',
                [
                    'label' => __( 'Button Text', 'charifund-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Read More', 'educharifundall-core' ),
                    'label_block' => true,
                    'default' => __( 'Read More', 'charifund-core' ),
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

		$this->end_controls_section();

        /*  tab styling tabs start */
        $this->start_controls_section(
            'tab_settings_section',
            [
                'label' => esc_html__('Style Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'charifund-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'charifund-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'charifund-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                '{{WRAPPER}} .ff-service-three-inner' => 'text-align: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control('icon_color', [
            'label' => esc_html__('Icon Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-service .thumb i" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-service .txt-lg" => "color: {{VALUE}} !important"
            ]
        ]);
         $this->add_control('title_hover_color', [
            'label' => esc_html__('Title Hover Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-service .txt-lg:hover" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ff-service .txt-lg',
            ]
        );
        $this->add_control('desc_color', [
            'label' => esc_html__('Description Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-service p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .ff-service p',
            ]
        );
        $this->add_control('button_color', [
            'label' => esc_html__('Button Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-service a" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->end_controls_section();
    }

    /**
     * Render Elementor widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

            <div class="pg-four">
                <div class="ff-service">
                    <div class="ff-service__single">
                        <div class="thumb">
                            <?php if($settings['icons_type'] == 'icon' ) : ?>
								<?php Icons_Manager::render_icon($settings['select_icon'], ['aria-hidden' => 'true']); ?>
                            <?php else: ?>
                                <img src="<?php echo $settings['select_img']['url'];?>" alt="" />
                            <?php endif; ?>
                        </div>
                        <div class="content mt-15">
                            <?php if($settings['title_text']) : ?>
                                <p class="txt-lg fw-7"><?php echo $settings['title_text']; ?></p>
                            <?php endif; ?>
                            <?php if($settings['desc_text']) : ?>
                                <p class="mt-20"><?php echo $settings['desc_text']; ?></p>
                            <?php endif; ?>
                            <?php if( 'yes'===$settings['show_button'] ){ ?>
                                <div class="mt-30">
                                    <a href="<?php echo esc_url($settings['button_url']['url']); ?>">
                                        <?php if($settings['button_text']) : ?>
                                            <?php echo $settings['button_text']; ?>
                                        <?php endif; ?>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Icon_Box_Three_Widget());