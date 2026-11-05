<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */
namespace Elementor;
class Charifund_About_Content_Widget extends Widget_Base
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
        return 'charifund-about-content-widget';
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
        return esc_html__('About Content', 'charifund-core');
    }

    public function get_keywords()
    {
        return ['about', 'content', 'about us', 'charifund'];
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
            'settings_section',
            [
                'label' => __('About Content', 'holaa-core'),
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
                'default' => __( 'We are always open for children', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'We are Committed to Help those less fortuness.', 'charifund-core' ),
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


		$repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'button_title', [
                    'label' => esc_html__('button text', 'charifund-core'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Check Your Causes', 'charifund-core'),
                ]
            );
            $repeater->add_control(
				'icons_type',
				[
				    'label' => esc_html__('Icon Type','elementor-webtheme-widget'),
				    'type' => \Elementor\Controls_Manager::CHOOSE,
				    'options' =>[
					  'img' =>[
						'title' =>esc_html__('Image','elementor-webtheme-widget'),
						'icon' =>'fa fa-picture-o',
					  ],
					  'icon' =>[
						'title' =>esc_html__('Icon','elementor-webtheme-widget'),
						'icon' =>'fa fa-info',
					  ]
				    ],
				    'default' => 'icon',
				]
			 );
			 
			 $repeater->add_control(
				'select_icon',
				[
					'label' => esc_html__( 'Select Icon', 'elementor-webtheme-widget' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'condition'=>[
						'icons_type'=> 'icon',
					],
					'label_block' => true,
				]
			);
			
			$repeater->add_control(
				'select_img',
				[
				    'label' => esc_html__('Select Image','elementor-webtheme-widget'),
				    'type'=> \Elementor\Controls_Manager::MEDIA,
				    'condition' => [
					  'icons_type' => 'img',
				    ]
				]
			);
            $repeater->add_control(
                'content_title', [
                    'label' => esc_html__('Content Title', 'charifund-core'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Trusted organization', 'charifund-core'),
                ]
            );
            $repeater->add_control(
                'content_text', [
                    'label' => esc_html__('Content Text', 'charifund-core'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Welcome to our Print 128 company that offers a', 'charifund-core'),
                ]
            );
            $repeater->add_control(
				'icons_type2',
				[
				    'label' => esc_html__('Icon Type','elementor-webtheme-widget'),
				    'type' => \Elementor\Controls_Manager::CHOOSE,
				    'options' =>[
					  'img' =>[
						'title' =>esc_html__('Image','elementor-webtheme-widget'),
						'icon' =>'fa fa-picture-o',
					  ],
					  'icon' =>[
						'title' =>esc_html__('Icon','elementor-webtheme-widget'),
						'icon' =>'fa fa-info',
					  ]
				    ],
				    'default' => 'icon',
				]
			 );
			 
			 $repeater->add_control(
				'select_icon2',
				[
					'label' => esc_html__( 'Select Icon', 'elementor-webtheme-widget' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'condition'=>[
						'icons_type'=> 'icon',
					],
					'label_block' => true,
				]
			);
			
			$repeater->add_control(
				'select_img2',
				[
				    'label' => esc_html__('Select Image','elementor-webtheme-widget'),
				    'type'=> \Elementor\Controls_Manager::MEDIA,
				    'condition' => [
					  'icons_type' => 'img',
				    ]
				]
			);
            $repeater->add_control(
                'content_title2', [
                    'label' => esc_html__('Content Title 2', 'charifund-core'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Awarded services', 'charifund-core'),
                ]
            );
            $repeater->add_control(
                'content_text2', [
                    'label' => esc_html__('Content Text 2', 'charifund-core'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('Welcome to our company that offers a Proservice', 'charifund-core'),
                ]
            );
		$this->add_control('about_items', [
            'label' => esc_html__('Service Tab Item', 'fixturbo-core'),
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
                "{{WRAPPER}} .commit__content  h2" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .commit__content  h2',
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
        $this->add_control('con_title_color', [
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
        $this->add_control('con_text_color', [
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
        $this->add_control('button_text_color', [
            'label' => esc_html__('Button Text Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('button_bg_color', [
            'label' => esc_html__('Button bg Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn" => "background-color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('button_active_color', [
            'label' => esc_html__('Button active Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn.active" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('button_active_bg_color', [
            'label' => esc_html__('Button active bg Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn.active" => "background-color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('button_hover_color', [
            'label' => esc_html__('Button hover Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn:hover" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_control('button_hover_bg_color', [
            'label' => esc_html__('Button hover bg Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn:hover" => "background-color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typography',
                'selector' => '{{WRAPPER}} .commit .commit__tab-btns .commit__tab-btn',
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
		$about_items = $settings['about_items']; ?>

            <div class="pg-four commit">
                <div class="commit__content ">

                    <?php if($settings['subtitle']) : ?>
                        <span class="sub-title"><?php echo $settings['subtitle']; ?></span>
                    <?php endif; ?>
                    <?php if($settings['title']) : ?>
                        <h2 class="title-animation fw-7"><?php echo $settings['title']; ?></h2>
                    <?php endif; ?>
                    <?php if($settings['description']) : ?>
                        <p><?php echo $settings['description']; ?></p>
                    <?php endif; ?>

                    <div class="commit__tab mt-40">
                        <div class="commit__tab-wrapper tab-content" id="nav-tabContent">

                            <?php 
								$j = 0;
								foreach($about_items as $items) :
								$j++; 
                                $active2 = '';
                                if($j == 1){
                                    $active2 = 'show active';
                                };
							?>
							<div class="commmit-tab-single tab-pane fade <?php echo $active2; ?>" id="nav-<?php echo $j; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $j; ?>-tab">
                                <div class="commit-tab-inner">
                                    
                                    <?php if($items['icons_type'] == 'icon' ) : ?>
                                        <div class="thumb">
                                            <i class="<?php echo esc_attr($items['select_icon']['value']); ?>"></i>
                                        </div>
                                    <?php else: ?>
                                    <div class="thumb">
                                        <img src="<?php echo $items['select_img']['url'];?>" alt="" />
                                    </div>
                                    <?php endif; ?>
                                    <div class="content">
                                        <p class="text-lg fw-7"><?php echo $items['content_title']; ?></p>
                                        <p><?php echo $items['content_text']; ?></p>
                                    </div>
                                </div>
                                <span class="divider d-none d-xxl-block"></span>
                                <div class="commit-tab-inner">
                                    <?php if($items['icons_type2'] == 'icon' ) : ?>
                                        <div class="thumb">
                                            <i class="<?php echo esc_attr($items['select_icon2']['value']); ?>"></i>
                                        </div>
                                    <?php else: ?>
                                    <div class="thumb">
                                        <img src="<?php echo $items['select_img2']['url'];?>" alt="" />
                                    </div>
                                    <?php endif; ?>
                                    <div class="content">
                                        <p class="text-lg fw-7"><?php echo $items['content_title2']; ?></p>
                                        <p><?php echo $items['content_text2']; ?></p>
                                    </div>
                                </div>
							</div>
							<?php endforeach; ?>
                        </div>
                        <nav class="commit__tab-btns mt-40">
                            <div class="nav nav-tabs fc-profit__tab-btns border-0">
                                <?php 
                                    $i = 0;
                                    foreach($about_items as $items) :
                                    $i++; 
                                    $active = '';
                                    if($i == 1){
                                        $active = 'active';
                                    };
                                ?>
                                    <button class="commit__tab-btn <?php echo $active; ?>" id="nav-<?php echo $i; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $i; ?>" type="button" role="tab" aria-controls="nav-<?php echo $i; ?>" aria-selected="true">
                                        <?php echo $items['button_title']; ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

		<?php 
	}

}           

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_About_Content_Widget());