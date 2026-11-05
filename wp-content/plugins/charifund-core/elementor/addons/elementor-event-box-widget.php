<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Charifund_Event_Box extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-event-box-widget';
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
		return esc_html__( 'Event Box', 'charifund-core' );
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
			'counter_box',
			[
				'label' => esc_html__( 'Counter Box', 'charifund-core' ),
			]
		);	

		$this->add_control(
			'image',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'date',
			[
				'label'       => __( 'Date', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( 'October 19, 2025', 'charifund-core' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'title', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default' => __( 'Transforming Lives Charity Golf Tournam Entdges Charity Networking Event', 'charifund-core' ),
			]
		);
		$this->add_control(
			'location',
			[
				'label'       => __( 'location', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( '135 W, 46nd Street, New York', 'charifund-core' ),
			]
		);
		$this->add_control(
			'link',
			[
				'label'       => __( 'link', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
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
		?>

		<div class="event m-0 p-0">
			<div class="event__single-wrapper" data-aos="fade-up" data-aos-duration="1000">
				<div class="event__single van-tilt">
					<div class="event__single-thumb">
						<img src="<?php echo $settings['image']['url']; ?>" alt="Image">
					</div>
					<div class="event__content">
						<span><?php echo $settings['date']; ?></span>
						<h4><a href="<?php echo $settings['link']; ?>"><?php echo $settings['title']; ?></a>
						</h4>
						<p><i class="fa-solid fa-location-dot"></i> <?php echo $settings['location']; ?></p>
					</div>
				</div>
			</div>
		</div>

		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Event_Box());