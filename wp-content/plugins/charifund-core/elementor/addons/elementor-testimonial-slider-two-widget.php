<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;

class Charifund_Testimonial_Slider_Two_Widget extends Widget_Base
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
        return 'charifund-testimonial-slider-two';
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
        return esc_html__('Testimonial Slider 02', 'charifund-core');
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
    public function get_icon()
    {
        return 'eicon-slides';
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
            'slider_settings_section',
            [
                'label' => esc_html__('Slider Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'testi_title', [
                'label' => esc_html__('Title', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Great Experience', 'charifund-core'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'testi_description', [
                'label' => esc_html__('Description', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Sasstech hires great people from a widely variety
                                of backgrounds, which simply makes our compan
                                stronger, and we could not be prouder of that.
                                elevating your optimizing Business Growth.', 'charifund-core'),
                'show_label' => true,
            ]
        );
        
        $repeater->add_control(
            'name', [
                'label' => esc_html__('Name', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Robert J. Hare /', 'charifund-core'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'designation', [
                'label' => esc_html__('Designation', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Graphics Designer', 'charifund-core'),
            ]
        );
        $repeater->add_control(
            'shape_img', [
                'label' => esc_html__('Shape Image', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Shape Image', 'charifund-core'),
            ]
        );
        $this->add_control('testimonial_items', [
            'label' => esc_html__('Testimonial Slider Item', 'charifund-core'),
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
            'slider_control_section',
            [
                'label' => esc_html__('Slider Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control('nav_position', [
            'label' => esc_html__('Nav Position', 'charifund-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'style-1' => esc_html__('default', 'charifund-core'),
                'slider-control-right-top' => esc_html__('Top Right', 'charifund-core'),
            ),
            'default' => 'style-1',
            'description' => esc_html__('Select price style', 'charifund-core')
        ]);
        $this->add_control(
            'items',
            [
                'label' => esc_html__('slidesToShow', 'charifund-core'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('you can set how many item show in slider', 'charifund-core'),
                'default' => '1',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),
            ]
        );
        $this->add_control(
            'nav',
            [
                'label' => esc_html__('Nav', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'nav_left_arrow',
            [
                'label' => esc_html__('Nav Left Icon', 'charifund-core'),
                'type' => Controls_Manager::ICONS,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'solid',
                ],
                'condition' => ['nav' => 'yes']
            ]
        );
        $this->add_control(
            'nav_right_arrow',
            [
                'label' => esc_html__('Nav Right Icon', 'charifund-core'),
                'type' => Controls_Manager::ICONS,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'solid',
                ],
                'condition' => ['nav' => 'yes']
            ]
        );
        $this->add_control(
            'center',
            [
                'label' => esc_html__('Center', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'charifund-core'),

            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_styling_settings_section',
            [
                'label' => esc_html__('Styling Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-testimonial q" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Title Typography', 'charifund-core'),
            'name' => 'title_typography',
            'description' => esc_html__('Title Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .pg-four .text-xl"
        ]);
        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-testimonial .content-p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Description Typography', 'charifund-core'),
            'name' => 'description_typography',
            'description' => esc_html__('Description Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .ff-testimonial .content-p"
        ]);
        $this->add_control('name_color', [
            'label' => esc_html__('Name Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-testimonial .designation-p" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Name Typography', 'charifund-core'),
            'name' => 'name_typography',
            'description' => esc_html__('Name Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .pg-four span.text-xl"
        ]);
        $this->add_control('designation_color', [
            'label' => esc_html__(' Designation Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .ff-testimonial .designation-p" => "color: {{VALUE}} !important"
            ]
        ]);

        $this->end_controls_section();

    }


    /**
     * Render Elementor widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $all_testimonial_items = $settings['testimonial_items'];

        $rand_numb = rand(333, 999999999);
        //slider settings
        $slider_settings = [
            "loop" => esc_attr($settings['loop']),
            "items" => esc_attr($settings['items'] ?? 1),
            "center" => esc_attr($settings['center']),
            "autoplay" => esc_attr($settings['autoplay']),
            "nav" => esc_attr($settings['nav']),
            "navleft" => charifund_core()->render_elementor_icons($settings['nav_left_arrow']),
            "navright" => charifund_core()->render_elementor_icons($settings['nav_right_arrow'])
        ];
        
        echo '
		<script>
			jQuery(document).ready(function($) {

			// js code start

			/**
     * ======================================
     * testimonial two slider js start
     * ======================================
     */

    var testimonialFive = new Swiper(".ff-testimonial-slider", {
        loop: true,
        speed: 1000,
        slidesPerView: 1.1,
        slidesPerGroup: 1,
        spaceBetween: 24,
        centeredSlides: true,
  
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
        pagination: {
          el: ".ff-test-pagination",
          clickable: true,
        },
  
        breakpoints: {
          576: {
            slidesPerView: 1.3,
          },
          992: {
            slidesPerView: 2,
          },
          1200: {
            slidesPerView: 2.5,
          },
        },
      });

			// js code end 

			});
			</script>';


		?>

            <div class="pg-four">
                <div class="ff-testimonial">
                    <div class="ff-testimonial-slider swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($all_testimonial_items as $testimonial_item): ?>
                                <div class="swiper-slide">
                                    <div class="ff-testimonial__single">
                                        <q class="text-xl fw-7"><?php echo esc_html($testimonial_item['testi_title']); ?></q>
                                        <p class="text-xl fw-5 content-p mt-60"><?php echo $testimonial_item['testi_description']; ?></p>
                                        <p class="designation-p mt-60"><span class="text-xl fw-7"><?php echo esc_html($testimonial_item['name']); ?></span>
                                            <?php echo esc_html($testimonial_item['designation']); ?>
                                        </p>
                                        <img src="<?php echo $testimonial_item['shape_img']['url'] ?>" alt="">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="ff-test-pagination pagination-one mt-40"></div>
                </div>
            </div>

        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Testimonial_Slider_Two_Widget());