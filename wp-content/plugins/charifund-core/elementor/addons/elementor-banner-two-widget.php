<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_Banner_Two_Widget extends Widget_Base
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
        return 'charifund-banner-two-widget';
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
        return esc_html__('Banner Two', 'charifund-core');
    }

    public function get_keywords()
    {
        return ['hero', 'content', 'banner', 'charifund'];
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
		return 'eicon-carousel-loop';
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
            'settings_section',
            [
                'label' => __('Banner Content', 'holaa-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter subtitle', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'For Prevent Proverties', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Support', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'bottom_title',
            [
                'label' => __( 'Title Bottom', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Humanity', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Description', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Transmax is the world is driving worldwide coordinations supplier — we uphold industry and exchange the worldwide trade of mercha', 'charifund-core' ),
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
                'default' => __( 'Check Our Causes', 'charifund-core' ),
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
                'condition' => [
                  'icons_type' => 'img',
                ]
            ]
        );
        $this->add_control(
            'content_title', [
                'label' => esc_html__('Content Title', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Trusted organization', 'charifund-core'),
            ]
        );
        $this->add_control(
            'content_text', [
                'label' => esc_html__('Content Text', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Welcome to our Print 128 company that offers a', 'charifund-core'),
            ]
        );
        $this->add_control(
            'icons_type2',
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
                'default' => 'select_icon2',
            ]
         );
         
         $this->add_control(
            'select_icon2',
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
            'select_img2',
            [
                'label' => esc_html__('Select Image','charifund-core'),
                'type'=> \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                  'icons_type' => 'img',
                ]
            ]
        );
        $this->add_control(
            'content_title2', [
                'label' => esc_html__('Content Title 2', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Awarded services', 'charifund-core'),
            ]
        );
        $this->add_control(
            'content_text2', [
                'label' => esc_html__('Content Text 2', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Welcome to our company that offers a Proservice', 'charifund-core'),
            ]
        );
        $this->add_control(
            'line_img', [
                'label' => esc_html__('shape Image', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('shape Image', 'charifund-core'),
            ]
        );
        $this->add_control(
            'shape_img', [
                'label' => esc_html__('spade Image', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Spade Img', 'charifund-core'),
            ]
        );
        $this->add_control(
            'bg_img', [
                'label' => esc_html__('Bg Image', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Bg Img', 'charifund-core'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_setting_section',
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
                "{{WRAPPER}} .pg-four h1" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .pg-four h1',
            ]
        );
        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .pg-four p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .pg-four p',
            ]
        );
        $this->add_control('content_title_color', [
            'label' => esc_html__('Content title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit-tab-inner .text-lg" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_title_typography',
                'selector' => '{{WRAPPER}} .commit .commit-tab-inner .text-lg',
            ]
        );
        $this->add_control('content_text_color', [
            'label' => esc_html__('Content Text Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .pg-four .content p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_text_typography',
                'selector' => '{{WRAPPER}} .pg-four .content p',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
            <div class="pg-four">
                <div class="banner-five commit m-0" style="background-image: url('<?php echo $settings['bg_img']['url'];?>')">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-five__content">
                                    <?php if($settings['subtitle']) : ?>
                                        <span class="text-xl sub-title"><?php echo $settings['subtitle']; ?></span>
                                    <?php endif; ?>
                                    <?php if($settings['title']) : ?>
                                        <h1 class="title-animation fw-7 mt-40"><?php echo $settings['title']; ?>
                                        <?php if($settings['bottom_title']) : ?>
                                            <span class="bottom-line"><?php echo $settings['bottom_title']; ?></span>
                                        <?php endif; ?>
                                    </h1>
                                    <?php endif; ?>
                                    <?php if($settings['description']) : ?>
                                        <p><?php echo $settings['description']; ?></p>
                                    <?php endif; ?>
                                    <?php if( 'yes'===$settings['show_button'] ){ ?>
                                        <div class="mt-40">
                                            <a href="<?php echo esc_url($settings['button_url']['url']); ?>" aria-label="our causes" title="our causes" class="btn--primary">
                                                <?php echo $settings['button_text']; ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="commmit-tab-single mt-40">
                                        <div class="commit-tab-inner">
                                            <?php if($settings['icons_type'] == 'icon' ) : ?>
                                                <div class="thumb">
                                                    <i class="<?php echo esc_attr($settings['select_icon']['value']); ?>"></i>
                                                </div>
                                            <?php else: ?>
                                                <div class="thumb">
                                                    <img src="<?php echo $settings['select_img']['url'];?>" alt="" />
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <p class="text-lg fw-7"><?php echo $settings['content_title']; ?></p>
                                                <p><?php echo $settings['content_text']; ?></p>
                                            </div>
                                        </div>
                                        <span class="divider d-none d-xxl-block"></span>
                                        <div class="commit-tab-inner">
                                            <?php if($settings['icons_type2'] == 'icon' ) : ?>
                                                <div class="thumb">
                                                    <i class="<?php echo esc_attr($settings['select_icon2']['value']); ?>"></i>
                                                </div>
                                            <?php else: ?>
                                                <div class="thumb">
                                                    <img src="<?php echo $settings['select_img2']['url'];?>" alt="" />
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <p class="text-lg fw-7"><?php echo $settings['content_title2']; ?></p>
                                                <p><?php echo $settings['content_text2']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($settings['shape_img']['url']) : ?>
                        <div class="spade">
                            <img src="<?php echo $settings['shape_img']['url']; ?>" alt="img">
                        </div>
                    <?php endif; ?>
                    <?php if($settings['line_img']['url']) : ?>
                        <div class="shape">
                            <img src="<?php echo $settings['line_img']['url']; ?>" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
		<?php 
	}

}           

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Banner_Two_Widget());