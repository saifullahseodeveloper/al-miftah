<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;
class charifund_About_Img_One_Widget extends Widget_Base
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
        return 'charifund-about-image-one-widget';
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
        return esc_html__('About Img 01', 'charifund-core');
    }

    public function get_keywords()
    {
        return ['Section', 'About', 'Title', 'charifund'];
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
        return 'eicon-image-hotspot';
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
                'label' => esc_html__('General Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'about_img', [
                'label' => esc_html__('About Main img', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('About Main Img', 'charifund-core'),
                'default' => array(
                    'url' => Utils::get_placeholder_image_src()
                )
            ]
        );
        $this->add_control(
            'about_img2', [
                'label' => esc_html__('About Shape img', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('About Shape Img', 'charifund-core'),
            ]
        );
        $this->add_control(
            'show_counter',
            [
                'label' => __( 'Show / Hide Counter Box', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'charifund-core' ),
                'label_off' => __( 'Hide', 'charifund-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
			'counter_position',
			[
				'label'   => esc_html__( 'Select Counter Possition', 'charifund-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'   => esc_html__( 'Default', 'charifund-core' ),
					'left-top'   => esc_html__( 'Left Top', 'charifund-core' ),
					'right-top'   => esc_html__( 'Right Top', 'charifund-core' ),
					'right-bottom'   => esc_html__( 'Right Bottom', 'charifund-core' ),
				),
			]
		);
        $this->add_control(
            'counter_icon', [
                'label' => esc_html__('Counter Icon', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'number', [
                'label' => esc_html__('Conter Number', 'charifund-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('20000', 'charifund-core')
            ]
        );
        $this->add_control(
            'number_plus', [
                'label' => esc_html__('Number Plus', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+', 'charifund-core')
            ]
        );
        $this->add_control(
            'title', [
                'label' => esc_html__('title', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Enter title', 'charifund-core'),
                'default' => esc_html__('People have donated here', 'charifund-core')
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

            <div class="commit d-inline-block">
                <div class="commit__thumb">
                    <div class="thumb-lg">
                        <?php if($settings['about_img']['url']) : ?>
                            <img src="<?php echo $settings['about_img']['url']; ?>" alt="img">
                        <?php endif; ?>
                    </div>
                    <div class="thumb-sm">
                        <?php if($settings['about_img2']['url']) : ?>
                            <img src="<?php echo $settings['about_img2']['url']; ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <?php if($settings['show_counter'] === 'yes') : ?>
                        <div class="commit-count <?php echo $settings['counter_position']; ?>">
                            <?php if($settings['counter_icon']['url']) : ?>
                                <div class="counter-icon mb-3">
                                    <img src="<?php echo $settings['counter_icon']['url']; ?>" alt="img">
                                </div>
                            <?php endif; ?>
                            <?php if($settings['number']) : ?>
                                <h4>
                                    <span class="odometer fw-7" data-odometer-final="<?php echo $settings['number']; ?> "></span>
                                    <?php if($settings['number_plus']) : ?>
                                        <span class="prefix fw-7"><?php echo $settings['number_plus']; ?></span>
                                    <?php endif; ?>
                                </h4>
                            <?php endif; ?>
                            <?php if($settings['title']) : ?>
                                <p class="text-black"><?php echo $settings['title']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new charifund_About_Img_One_Widget());