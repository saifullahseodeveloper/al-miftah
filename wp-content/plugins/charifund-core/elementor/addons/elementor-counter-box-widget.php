<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Counter_Box extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-counter-box-widget';
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
		return esc_html__( 'Counter Box', 'charifund-core' );
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

		$this->add_control(
			'image',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			]
		);

		$this->add_control(
			'image2',
				[
				  'label' => __( 'Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
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
						['block_title' => esc_html__('Hello World', 'charifund-core')],
					],
				'fields' => 
					[	
						'block_icons' =>
						[
							'name' => 'block_icons',
							'label' => __( 'Icon', 'charifund-core' ),
							'type' => Controls_Manager::ICONS,
						],

						'block_number' =>

						[
							'name' => 'block_number',
							'label' => esc_html__('Number %', 'charifund-core'),
							'type' => Controls_Manager::TEXT,
							'default' => esc_html__('0.7', 'charifund-core')
						],

						
						'block_title' =>
						[
							'name' => 'block_title',
							'label' => esc_html__('Suffix', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('+', 'charifund-core')
						],

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
							'type' => Controls_Manager::TEXTAREA,
							'default' => esc_html__('', 'charifund-core')
						],

						'block_show' =>
						[
							'name' => 'block_show',
							'label' => __( 'Show Right Border', 'charifund-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label_on' => __( 'Show', 'charifund-core' ),
							'label_off' => __( 'Hide', 'charifund-core' ),
							'return_value' => 'yes',
							'default' => 'yes',
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

		 <section class="counter">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="counter__inner">
					 	<?php foreach($settings['repeat'] as $item):?>	
                        <div class="counter__single">
                           <div class="thumb">
						   		<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
                           </div>
                           <div class="counter__content">
                              <h2><span class="odometer" data-odometer-final="<?php echo esc_attr($item['block_number'], $allowed_tags);?>"></span> <?php echo wp_kses($item['block_title'], $allowed_tags);?>
                              </h2>
                              <h5><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></h5>
                           </div>
                        </div>
						<?php  if ( 'yes' === $item['block_show'] ) : ?>						
                        	<div class="divider"></div>
						<?php endif ;?>	
						<?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="poor">
			   <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img class="parallax-image" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>
            </div>
            <div class="shape-left">
			   <?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
					<img class="base-img" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
				<?php endif;?>
            </div>
         </section>
		
<?php endif; ?>

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Counter_Box());