<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class About_Help extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-about-help-widget';
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
		return esc_html__( 'About Help', 'charifund-core' );
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
			'about-help',
			[
				'label' => esc_html__( 'All Images', 'charifund-core' ),
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
					  'label' => __( 'Image', 'charifund-core' ),
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
					  'label' => __( 'Image', 'charifund-core' ),
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
					  'label' => __( 'Image', 'charifund-core' ),
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

		$this->end_controls_section();


		$this->start_controls_section(
			'about-content',
			[
				'label' => esc_html__( 'All Content', 'charifund-core' ),
			]

		);	
		 $this->add_control(
            'show_counter',
            [
                'label' => __( 'Show / Hide Counter Box', 'betx-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'betx-core' ),
                'label_off' => __( 'Hide', 'betx-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
			$this->add_control(
				'ff_stop',
				[
				'label' => __( 'Counter Stop', 'charifund-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
				'active' => true,
				],
				'placeholder' => __( 'Enter Counter Stop', 'charifund-core' ),
				]
			);
		
		
			$this->add_control(
				'ff_sign',
				[
				'label' => __( 'Counter Suffix', 'charifund-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
				'active' => true,
				],
				'placeholder' => __( 'Enter Counter Suffix', 'charifund-core' ),
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
				'text2',
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
				'title3',
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
				'subtitle2',
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
				'subtitle3',
				[
					'label'       => __( 'Text', 'charifund-core' ),
					'type'        => Controls_Manager::TEXTAREA,
					'dynamic'     => [
						'active' => true,
					],
					'placeholder' => __( 'Enter your Text', 'charifund-core' ),
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
					
						'block_icons' =>
						[
							'name' => 'block_icons',
							'label' => esc_html__('Enter The icons', 'charifund-core'),
							'type' => Controls_Manager::ICONS,							
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



	<section class="help-two">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-5 col-xxl-6 ">
					<div class="help-two__thumb d-none d-lg-block">
						<div class="help-two__thumb-inner">
							<div class="thumb-lg">
								<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
								<?php endif;?>
							</div>
							<div class="thumb-sm">
								<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
								<?php endif;?>
							</div>
							<div class="thumb-md">
							<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
								<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
							<?php endif;?>
							</div>
							<?php if($settings['show_counter'] == 'yes') : ?>
								<div class="help-two__thumb-content">
									<div class="thumb">
										<i class="icon-donation"></i>
									</div>
									<div class="content">
										<h2><span class="odometer" data-odometer-final="<?php echo esc_attr($settings['ff_stop']);?>"></span><span><?php echo esc_attr($settings['ff_sign']);?></span>
										</h2>
										<p><?php echo $settings['title'];?> </p>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>	
				</div>
				<div class="col-12 col-lg-7 col-xxl-6">
					<div class="help-two__content">
					<div class="section__content">
						<span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
						<h2 class="title-animation"><?php echo $settings['title2'];?></h2>
						<p><?php echo $settings['text'];?></p>
					</div>
					<div class="help-two__inner cta">
						<div class="help-two__inner-content">
							<div class="help__content-icon-group">

								<?php foreach($settings['repeat'] as $item):?>	
								<div class="help__content-icon">
									<div class="thumb">
										<i class="<?php echo str_replace("icon ", " ", esc_attr( $item['block_icons']['value']));?>"></i>
									</div>
									<div class="content">
										<h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
										<p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
									</div>
								</div>
								<?php endforeach; ?>

							</div>
							<div class="help__content-list">
								<ul>
									<?php echo $settings['text2'];?>
								</ul>
							</div>
						</div>
						<div class="help-two-card-wrapper">
							<div class="help-two__card van-tilt">
								<div class="help-card-thumb">
								<?php  if ( !empty(esc_url($settings['image4']['id']) )) : ?>   
									<img src="<?php echo wp_get_attachment_url($settings['image4']['id']);?>" alt="<?php echo esc_attr($settings['alt_text4']);?>"/>
								<?php endif;?>
								<i class="icon-star"></i>
								</div>
								<div class="help-card-content">
								<h4><?php echo $settings['title3'];?></h4>
								<h6><?php echo $settings['subtitle2'];?></h6>
								<p><?php echo $settings['subtitle3'];?></p>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		</section>


             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new About_Help());