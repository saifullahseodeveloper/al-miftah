<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Theme_Accordion_Two extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-theme-accordion-two-widget';
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
		return esc_html__( 'Theme Accordion 02', 'charifund-core' );
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

		// Tab Start - 0

		$this->start_controls_section(
			'faq_content_section',
			[
				'label' => esc_html__( 'Faq Content', 'charifund-core' ),
			]
		);	
	

		// $this->add_control(
		// 	'subtitle',
		// 	[
		// 		'label'       => __( 'Sub Title', 'charifund-core' ),
		// 		'type'        => Controls_Manager::TEXTAREA,
		// 		'dynamic'     => [
		// 			'active' => true,
		// 		],
		// 		'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
		// 	]
		// );
	
		// $this->add_control(
		// 		'title',
		// 		[
		// 			'label'       => __( 'Title', 'charifund-core' ),
		// 			'type'        => Controls_Manager::TEXTAREA,
		// 			'dynamic'     => [
		// 				'active' => true,
		// 			],
		// 			'placeholder' => __( 'Enter your title', 'charifund-core' ),
		// 		]
		// );

		// $this->add_control(
		// 	'image',
		// 		[
		// 			'label' => __( 'Image', 'charifund-core' ),
		// 			'type' => Controls_Manager::MEDIA,
		// 			'default' => ['url' => Utils::get_placeholder_image_src(),],
		// 		]
		// );	
		
		// $this->add_control(
		// 	'alt_text',
		// 	[
		// 		'label'       => __( 'Alt text', 'charifund-core' ),
		// 		'type'        => Controls_Manager::TEXTAREA,
		// 		'dynamic'     => [
		// 			'active' => true,
		// 		],
		// 		'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
		// 	]
		// );

		// $this->add_control(
		// 	'image2',
		// 		[
		// 			'label' => __( 'Image', 'charifund-core' ),
		// 			'type' => Controls_Manager::MEDIA,
		// 			'default' => ['url' => Utils::get_placeholder_image_src(),],
		// 		]
		// );	
		
		// $this->add_control(
		// 	'alt_text2',
		// 	[
		// 		'label'       => __( 'Alt text', 'charifund-core' ),
		// 		'type'        => Controls_Manager::TEXTAREA,
		// 		'dynamic'     => [
		// 			'active' => true,
		// 		],
		// 		'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
		// 	]
		// );

		// $this->add_control(
		// 	'image3',
		// 		[
		// 			'label' => __( 'Image', 'charifund-core' ),
		// 			'type' => Controls_Manager::MEDIA,
		// 			'default' => ['url' => Utils::get_placeholder_image_src(),],
		// 		]
		// );	
		
		// $this->add_control(
		// 	'alt_text3',
		// 	[
		// 		'label'       => __( 'Alt text', 'charifund-core' ),
		// 		'type'        => Controls_Manager::TEXTAREA,
		// 		'dynamic'     => [
		// 			'active' => true,
		// 		],
		// 		'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
		// 	]
		// );

		$this->end_controls_section();

		// Tab Start - 1

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Accordion Repeater', 'charifund-core' ),
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
						['block_title' => esc_html__('Hello World', 'charifund-core')],
					],
				'fields' => 
					[	

						'block_title' =>

						[
							'name' => 'block_title',
							'label' => esc_html__('Title', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_subtitle' =>
						
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Progress Value', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],
						
					],
				'title_field' => '{{block_title}}',
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
		$allowed_tags = wp_kses_allowed_html('post');
		?>


		<div class="faq home-10">
			<div class="container">
				<div class="faq__content">
					<div class="faq__content-inner cta">
						<div class="accordion" id="accordion">
							<?php foreach($settings['repeat'] as $key=>$item):?>
								<div class="accordion-item">
									<h6 class="accordion-header" id="headingOne<?php echo esc_attr($key);?>">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
										data-bs-target="#collapseOne<?php echo esc_attr($key);?>" aria-expanded="true"
										aria-controls="collapseOne<?php echo esc_attr($key);?>">
										<?php echo wp_kses($item['block_title'], $allowed_tags);?>
									</button>
								</h6>
								<div id="collapseOne<?php echo esc_attr($key);?>" class="accordion-collapse collapse <?php if($key == 1) echo 'show';?>"
									aria-labelledby="headingOne<?php echo esc_attr($key);?>" data-bs-parent="#accordion">
									<div class="accordion-body">
										<p>
											<?php echo wp_kses($item['block_subtitle'], $allowed_tags);?>
										</p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>


             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Theme_Accordion_Two());