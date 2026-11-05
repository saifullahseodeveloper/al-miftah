<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_Icon_Box_Four_Widget extends Widget_Base
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
        return 'charifund-icon-box-four-widget';
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
        return esc_html__('charifund Icon Box Four', 'charifund-core');
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
				    'label' => esc_html__('Select Icon or Image','charifund-core'),
				    'type' => \Elementor\Controls_Manager::CHOOSE,
				    'options' =>[
						'icon_numbers' =>[
                            'title' =>esc_html__('Icon Number','charifund-core'),
                            'icon' =>'',
                        ],
                        'img' =>[
                            'title' =>esc_html__('Image','charifund-core'),
                            'icon' =>'fa fa-picture-o',
                        ],
                        'icon' =>[
                            'title' =>esc_html__('Icon','charifund-core'),
                            'icon' =>'fa fa-info',
                        ],
                        
				    ],
				    'default' => 'icon_numbers',
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
				'select_number',
				[
					'label' => esc_html__( 'Icon Number', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition'=>[
						'icons_type'=> 'icon_numbers',
					],
					'label_block' => true,
                    'default' => __( '42', 'charifund-core' ),
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
					'default' => __( 'People', 'charifund-core' ),
				]
			);
			$this->add_control(
				'description_text',
				[
					'label' => __( 'Description', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => __( 'Enter paragraph', 'charifund-core' ),
					'default' => __( 'Prevention of Cruelty', 'charifund-core' ),
				]
			);
			$this->add_control(
				'show_active',
				[
					'label' => __( 'Active Icon Box', 'charifund-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'charifund-core' ),
					'label_off' => __( 'No', 'charifund-core' ),
					'return_value' => 'yes',
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
                'label' => __( 'Alignment', 'elementor-webtheme-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'elementor-webtheme-widget' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor-webtheme-widget' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor-webtheme-widget' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                '{{WRAPPER}} .goal__single' => 'text-align: {{VALUE}} !important',
                ],
            ]
        );
		$this->add_control('border_color', [
            'label' => esc_html__('border Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .fc-goal .goal__single" => "border-color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('count_color', [
            'label' => esc_html__('Count Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .goal__single .thumb h2" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .content h6" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .content h6',
            ]
        );
        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .content p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .content p',
            ]
        );

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

	<div class="fc-goal box-four">
		<div class="goal__single <?php if('yes' === $settings['show_active']){echo esc_attr('goal__single-active');}?>">
			<div class="thumb">
				<?php if($settings['icons_type'] == 'icon' ) : ?>
                    <span class="">
                        <i class="<?php echo esc_attr($settings['select_icon']['value']); ?>"></i>
                    </span>
                <?php elseif($settings['icons_type'] == 'img' ) : ?>
                    <div class="">
                        <img src="<?php echo $settings['select_img']['url'];?>" alt=""/>
                    </div>
                <?php else: ?>
					<h2 class="fw-8"><?php echo esc_attr($settings['select_number']); ?></h2>
                <?php endif; ?>
			</div>
			<div class="content">
				<?php if($settings['title_text']) : ?>
					<h6 class="fw-8"><?php echo $settings['title_text']; ?></h6>
				<?php endif; ?>
				<?php if($settings['description_text']) : ?>
					<p><?php echo $settings['description_text']; ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Icon_Box_Four_Widget());