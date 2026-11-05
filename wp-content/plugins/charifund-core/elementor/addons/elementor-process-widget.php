<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Process extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-process-widget';
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
		return esc_html__( 'Process', 'charifund-core' );
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
			'process',
			[
				'label' => esc_html__( 'Process', 'charifund-core' ),
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
				'button',
				[
					'label'       => __( 'Button', 'charifund-core' ),
					'type'        => Controls_Manager::TEXT,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'Enter your button text', 'charifund-core' ),
					'default' => esc_html__('Read More', 'charifund-core'),
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

		$this->add_control(
			'image',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			]
		);

		$this->add_control(
			'image2',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			]
		);

		$this->add_control(
			'image3',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text3',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			]
		);

		$this->add_control(
			'image4',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);

		$this->add_control(
			'alt_text4',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
			]
		);

		$this->add_control(
			'image5',
				[
				  'label' => __( 'Shape Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);

		$this->add_control(
			'alt_text5',
			[
				'label'       => __( 'Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
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

						'block_subtitle' =>
						[
							'name' => 'block_subtitle',
							'label' => esc_html__('Subtitle', 'charifund-core'),
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

	<section class="help-three">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="help-three__inner">
					<div class="section__header-secondary">
						<div class="row gutter-30 align-items-center">
							<div class="col-12 col-lg-8 col-xxl-7">
								<div class="section__header mb-0">
								<?php if($settings['subtitle']): ?>
									<span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
								<?php endif; ?>
								<h2 class="title-animation"><?php echo $settings['title'];?></h2>
								</div>
							</div>
							<div class="col-12 col-lg-4 col-xxl-5">
								<?php if($settings['button']): ?>
								<div class="help-cta">
									<a href="<?php echo esc_url($settings['button_link']['url']);?>" aria-label="our team" title="our team"
										class="btn--primary"><?php echo $settings['button'];?><i
										class="fa-solid fa-arrow-right"></i></a>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="help-three__wrapper">
						<div class="row gutter-60">
							<?php foreach($settings['repeat'] as $item):?>	
							<div class="col-12 col-md-6 col-xxl-3">
								<div class="help-three__single">
								<div class="help-three__thumb">
									<div class="thumb">
										<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
									</div>
									<div class="help-three__tag">
										<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
									</div>
								</div>
								<div class="help-three__content">
									<h6><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></h6>
									<p><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
								</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
							<img class="v-line d-none d-xxl-block" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
						<?php endif;?>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="help-three-bg">
			<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
				<img class="bg-help" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
			<?php endif;?>
			<div class="poor-boy">
			<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
				<img class="poor" src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
			<?php endif;?>
			<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
				<img class="shape" src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
			<?php endif;?>
			</div>
			<div class="parasuit">
				<?php  if ( !empty(esc_url($settings['image5']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image5']['id']);?>" alt="<?php echo esc_attr($settings['alt_text5']);?>"/>
				<?php endif;?>
			</div>
		</div>
		</section>

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Process());