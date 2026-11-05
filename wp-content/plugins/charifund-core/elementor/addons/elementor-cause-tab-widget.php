<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Cause_Tab extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-cause-tab-widget';
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
		return esc_html__( 'Cause Tab', 'charifund-core' );
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
			'cause-tab',
			[
				'label' => esc_html__( 'Cause Tab', 'charifund-core' ),
			]
		);		

		$this->end_controls_section();

		// Tab Start - 2

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Block', 'charifund-core' ),
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
						['block_title' => esc_html__('Projects Completed', 'charifund-core')],
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

						'block_text' =>
						[
							'name' => 'block_text',
							'label' => esc_html__('Text', 'charifund-core'),
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

	<section class="difference-two p-0">           
		<div class="difference-two__content p-0">
			<div class="difference-two__inner cta mt-0">
				<div class="difference-two__inner-content">
					<div class="difference-two__tab">
						<div class="difference-two__tab-btns">
							<?php foreach($settings['repeat'] as $key=>$item):?>
							<button class="difference-two__tab-btn <?php if($key == 1) echo 'active';?>" data-target="#mission<?php echo esc_attr($key);?>"
							aria-label="mission<?php echo esc_attr($key);?>" title="mission<?php echo esc_attr($key);?>"><?php echo wp_kses($item['block_title'], $allowed_tags);?></button>
							<?php endforeach; ?>
						</div>
						<div class="difference-two__tab-content">
							<?php foreach($settings['repeat'] as $key=>$item):?>
							<div class="difference-two__content-single <?php if($key == 1) echo 'active';?>" id="mission<?php echo esc_attr($key);?>">
								<ul>
									<?php echo wp_kses($item['block_text'], $allowed_tags);?>
								</ul>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>    
    </section>

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Cause_Tab());