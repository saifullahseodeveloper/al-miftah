<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_Cta_Widget extends Widget_Base
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
        return 'charifund-cta-widget';
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
        return esc_html__('CTA', 'charifund-core');
    }

    public function get_keywords()
    {
        return ['button', 'Box', 'volunteer', 'charifund'];
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
		return 'eicon-button';
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
				'label' => __( 'Volunteer', 'charifund-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
					'default' => __( 'Our Goal is to Help Poor People', 'charifund-core' ),
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
                'show_button2',
                [
                    'label' => __( 'Show / Hide Button 2', 'charifund-core' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'charifund-core' ),
                    'label_off' => __( 'Hide', 'charifund-core' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'button_text2',
                [
                    'label' => __( 'Button Text', 'charifund-core' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Donate Now', 'educharifundall-core' ),
                    'label_block' => true,
                    'default' => __( 'Donate Now', 'charifund-core' ),
                ]
            );
            $this->add_control(
                'button_url2',
                [
                    'label' => __( 'Button Link', 'charifund-core' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'Enter Your Link Here', 'charifund-core' ),
                ]
            );
            $this->add_control(
				'shape_image',
				[
					'label' => __( 'Shape image', 'charifund-core' ),
					'type' => Controls_Manager::MEDIA,
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
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .fc-goal .goal__inner h4" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .fc-goal .goal__inner h4',
            ]
        );
        $this->add_control('volunteer_color', [
            'label' => esc_html__('Volunteer Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .fc-goal .goal__inner a" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'volunteer_typography',
                'selector' => '{{WRAPPER}} .fc-goal .goal__inner a',
            ]
        );
        $this->add_control('donate_color', [
            'label' => esc_html__('Donate Text Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .fc-goal .btn--primary" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'donate_typography',
                'selector' => '{{WRAPPER}} .fc-goal .btn--primary',
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

            <div class="row fc-goal justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="goal__inner mt-120">
                        <div class="goal__left">
                            <?php if($settings['title_text']) : ?>
                                <h4 class="fw-7 hb"><?php echo $settings['title_text']; ?></h4>
                            <?php endif; ?>
                            <?php if( 'yes'===$settings['show_button'] ){ ?>
                                <a href="<?php echo esc_url($settings['button_url']['url']); ?>">
                                    <?php echo $settings['button_text']; ?>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="goal__right pg-four">
                            <?php if( 'yes'===$settings['show_button2'] ){ ?>
                                <a href="<?php echo esc_url($settings['button_url2']['url']); ?>" aria-label="Donate Now" title="Donate Now" class="btn--primary">
                                    <?php echo $settings['button_text2']; ?>
                                    <i class="icon-heart"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <?php  if ( !empty(esc_url($settings['shape_image']['id']) )) : ?>   
                            <img class="poor" src="<?php echo wp_get_attachment_url($settings['shape_image']['id']);?>" alt=""/>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Cta_Widget());