<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Fund_Card extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-fund-card-widget';
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
		return esc_html__( 'Fund Card', 'charifund-core' );
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

		$this->start_controls_section(
			'about-content',
			[
				'label' => esc_html__( 'All Content', 'charifund-core' ),
			]

		);	
	
		
			$this->add_control(
					'title',
					[
						'label'       => __( 'Title', 'charifund-core' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => [
							'active' => true,
						],
						'placeholder' => __( 'Enter your title', 'charifund-core' ),
					]
				);	
				
				$this->add_control(
					'ff_stop',
					[
					'label' => __( 'Counter Stop', 'charifund-core' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
					'active' => true,
					],
					'placeholder' => __( 'Enter Counter Stop', 'charifund-core' ),
					]
				);
	
			$this->add_control(
				'subtitle',
				[
					'label'       => __( 'Sub Title', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
				]
			);

			$this->add_control(
				'title2',
				[
					'label'       => __( 'Title', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your title', 'charifund-core' ),
				]
			);	
		
			$this->add_control(
				'text',
				[
					'label'       => __( 'Description Text', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
				]
			);

			
			$this->add_control(
				'button_link',
				[
				'label' => __( 'Button Url', 'charifund-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				
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

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
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

		<section class="overview">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="overview__inner">
                        <div class="overview__single overview__left">
                           <h4><?php echo $settings['title'];?></h4>
                           <div class="cause__progress progress-bar-single">
                              <div class="cause-progress__bar">
                                 <div class="progress-bar-wrapper" data-percent="<?php echo esc_attr($settings['ff_stop']);?>">
                                    <div class="progress-bar">
                                       <div class="progress-bar-percent"><span class="percent-value"><?php echo esc_attr($settings['ff_stop']);?></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="cause-progress__goal">
						   	<?php foreach($settings['repeat'] as $item):?>							
                              <div class="goal-single">
                                 <span><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></span>
                                 <h5><?php echo wp_kses($item['block_title'], $allowed_tags);?></h5>
                              </div>
							  <?php endforeach; ?>
                           </div>
                        </div>
                        <div class="overview__single overview__right">
                           <span><?php echo $settings['subtitle'];?></span>
                           <h4><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title2'];?></a></h4>
                           <p><?php echo $settings['text'];?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Fund_Card());