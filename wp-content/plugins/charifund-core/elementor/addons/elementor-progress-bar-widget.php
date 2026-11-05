<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Progress_Bar extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-progress-bar-widget';
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
		return esc_html__( 'Progress Bar', 'charifund-core' );
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
			'progress-bar',
			[
				'label' => esc_html__( 'Progress Bar', 'charifund-core' ),
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
					'style2'   => esc_html__( 'Style Two', 'charifund-core' ),
				),
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

<?php  if ( 'style1' === $settings['style'] ) : ?>	
	<div class="difference-two p-0">
		<div class="difference-two__progress">
			<?php foreach($settings['repeat'] as $item):?>	
			<div class="difference-progress-single">
				<div class="progress-bar-single" data-percent="<?php echo wp_kses($item['block_title'], $allowed_tags);?>%">
					<div class="circular-progress">
						<div class="percent-value">0%</div>
						<svg class="progress-circle" viewBox="0 0 36 36">
							<path class="circle-bg" d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831" />
							<path class="circle-progress" d="M18 2.0845
							a 15.9155 15.9155 0 0 1 0 31.831
							a 15.9155 15.9155 0 0 1 0 -31.831" />
						</svg>
					</div>
				</div>
				<div class="content">
					<p><?php echo wp_kses($item['block_text'], $allowed_tags);?>
					</p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php  elseif ( 'style2' === $settings['style'] ) : ?>	

		<section class="team-details p-0 m-0">
			<div class="team-details__content ps-0">
				<div class="progress-wrapper" >
					<?php foreach($settings['repeat'] as $item):?>	
					<div class="cause__progress progress-bar-single">
						<div class="cause-progress__bar">
							<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
							<div class="progress-bar-wrapper" data-percent="<?php echo wp_kses($item['block_title'], $allowed_tags);?>%">
							<div class="progress-bar">
								<div class="progress-bar-percent"><span class="percent-value"></span>
								</div>
							</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
         </section>

	<?php endif ;?>	

		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Progress_Bar());