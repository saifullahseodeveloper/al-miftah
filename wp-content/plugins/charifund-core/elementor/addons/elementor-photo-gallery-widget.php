<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Photo_Gallery extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-photo-gallery-widget';
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
		return esc_html__( 'Photo Gallery', 'charifund-core' );
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
			'photo_gallery',
			[
				'label' => esc_html__( 'Photo Gallery', 'charifund-core' ),
			]
		);		
		
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Style', 'charifund-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => array(
					'style1'   => esc_html__( 'Style One', 'charifund-core' ),
				),
			]
		);

		$this->end_controls_section();

		// Tab Start - 2

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Team Grid Block', 'charifund-core' ),
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

						'block_image' =>
						[
							'name' => 'block_image',
							'label' => __( 'Image', 'charifund-core' ),
							'type' => Controls_Manager::MEDIA,
							'default' => ['url' => Utils::get_placeholder_image_src(),],
						],	

						  'block_alt_text' =>
						[
						  'name' => 'block_alt_text',
						  'label' => esc_html__('Image Text', 'charifund-core'),
						  'type' => Controls_Manager::TEXTAREA,
						  'default' => esc_html__('', 'charifund-core')
						],

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
							'label' => esc_html__('Subtitle', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],	
						
						'block_button_link' =>
						[
						  'name' => 'block_button_link',
						  'label' => __( 'Button Url', 'charifund-core' ),
						  'type' => Controls_Manager::URL,
						  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
						  'show_external' => true,
						  'default' => [
							'url' => '',
							'is_external' => true,
							'nofollow' => true,
						  ],
					   ],	
					   
					   'block_class' =>
						[
							'name' => 'block_class',
							'label' => __( 'Select Style', 'charifund-core' ),
							'type' => Controls_Manager::SELECT,
							'options' => [
								'col-lg-12' => __( 'col-lg-12', 'charifund-core' ),
								'col-lg-8' => __( 'col-lg-8', 'charifund-core' ),
								'col-lg-7' => __( 'col-lg-7', 'charifund-core' ),
								'col-lg-6' => __( 'col-lg-6', 'charifund-core' ),
								'col-lg-5' => __( 'col-lg-5', 'charifund-core' ),
								'col-lg-4' => __( 'col-lg-4', 'charifund-core' ),
								],
								'default' => 'col-lg-12',
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

<?php  if ( 'style1' === $settings['style'] ) : ?>	

	<div class="award p-0">
		<div class="container">
			<div class="row gutter-24">
				<?php foreach($settings['repeat'] as $item):?>	
				<div class="col-12 <?php echo esc_attr($item['block_class']); ?>">
					<div class="award__single">
					<div class="thumb">
						<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
						<?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
							<img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
						<?php endif;?>
						</a>
					</div>
					<div class="content">
						<div class="award__content">
							<h5><a href="<?php echo esc_url($item['block_button_link']['url']);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></a></h5>
							<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
						</div>
						<div class="award__thumb">
							<a href="<?php echo esc_url($item['block_button_link']['url']);?>">
							<i class="fa-solid fa-arrow-right"></i>
							</a>
						</div>
					</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php  elseif ( 'style2' === $settings['style'] ) : ?>		


<?php endif ;?>	

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Photo_Gallery());