<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_Icon_Box_Two_Widget extends Widget_Base
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
        return 'charifund-icon-box-two-widget';
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
        return esc_html__('charifund Icon Box 02', 'charifund-core');
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
                'icon_img',
                [
                    'label' => esc_html__( 'Select Icon', 'charifund-core' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'label_block' => true,
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
					'default' => __( 'Corporate Gifts donate', 'charifund-core' ),
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
                    'default' => __( '', 'charifund-core' ),
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
                "{{WRAPPER}} .ff-servicce-three i" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-servicce-three .content a" => "color: {{VALUE}} !important"
            ]
        ]);
         $this->add_control('title_hover_color', [
            'label' => esc_html__('Title Hover Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-servicce-three .content a:hover" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .ff-servicce-three .content a',
            ]
        );
        $this->add_control('button_color', [
            'label' => esc_html__('Button Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-servicce-three .thumb a" => "color: {{VALUE}} !important"
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
                <div class="ff-servicce-three">
                    <div class="ff-service-three-inner">
                        <div class="ff-service-three-single">
                            <div class="thumb">
                                <?php if($settings['icon_img']) {	
									Icons_Manager::render_icon($settings['icon_img'], ['aria-hidden' => 'true']);
								}; ?>
                                <?php if( 'yes'===$settings['show_button'] ){ ?>
                                    <a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="arr">
                                        <?php if($settings['button_text']) : ?>
                                            <?php echo $settings['button_text']; ?>
                                        <?php endif; ?>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="content">
                                <?php if($settings['title_text']) : ?>
                                    <a href="<?php echo esc_url($settings['button_url']['url']); ?>" aria-label="view details"><?php echo $settings['title_text']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Icon_Box_Two_Widget());