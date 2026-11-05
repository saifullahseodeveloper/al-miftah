<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Gallery_Section extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-gallery-section-widget';
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
		return esc_html__( 'Gallery Section', 'charifund-core' );
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
			'gallery_content',
			[
				'label' => esc_html__( 'Gallery Content', 'charifund-core' ),
			]
		);		
		
		$this->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter subtitle', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'We are always open for children', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'charifund-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter Title', 'charifund-core' ),
                'label_block' => true,
                'default' => __( 'Recent Causes galler', 'charifund-core' ),
            ]
        );
		$this->add_control(
            'bg_image', [
                'label' => esc_html__('Video BG', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => false,
                'description' => esc_html__('Video BG Image', 'charifund-core'),
            ]
        );
        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Video Link', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('https://www.youtube.com/watch?v=pPl3ZZdTP3g', 'charifund-core'),
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_left_image',
			[
				'label' => esc_html__( 'Left Image Content', 'charifund-core' ),
			]
		);		
		$this->add_control(
            'image_1', [
                'label' => esc_html__('Image 1', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image One', 'charifund-core'),
            ]
        );
		$this->add_control(
            'image_2', [
                'label' => esc_html__('Image 2', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image Two', 'charifund-core'),
            ]
        );
		$this->add_control(
            'image_3', [
                'label' => esc_html__('Image 3', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image Three', 'charifund-core'),
            ]
        );

		$this->end_controls_section();

	$this->start_controls_section(
			'gallery_Right_image',
			[
				'label' => esc_html__( 'Right Image Content', 'charifund-core' ),
			]
		);		
		$this->add_control(
            'image_4', [
                'label' => esc_html__('Image 1', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image One', 'charifund-core'),
            ]
        );
		$this->add_control(
            'image_5', [
                'label' => esc_html__('Image 2', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image Two', 'charifund-core'),
            ]
        );
		$this->add_control(
            'image_6', [
                'label' => esc_html__('Image 3', 'charifund-core'),
                'type' => Controls_Manager::MEDIA,
                'show_label' => true,
                'description' => esc_html__('image Three', 'charifund-core'),
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

			<div class="ff-gallery pt-120 pb-120">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-10 col-xl-7">
							<div class="section__header text-center" data-aos="fade-up" data-aos-duration="1000">
								<?php if($settings['subtitle']) : ?>
									<span class="sub-title"><?php echo $settings['subtitle']; ?></span>
								<?php endif; ?>
								<?php if($settings['title']) : ?>
									<h2 class="title-animation mt-0 fw-6"><?php echo $settings['title']; ?></h2>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-12 col-xl-6">
							<div class="thumb-lg">
								<?php if($settings['bg_image']) : ?>
									<img src="<?php echo $settings['bg_image']['url']; ?>" alt="" >
								<?php endif; ?>
								<div class="video-btn-wrapper">
									<?php if($settings['video_link']) : ?>
										<a href="<?php echo $settings['video_link']; ?>" target="_blank"
											title="video Player" class="popup-video-link play-button open-video-popup">
											<i class="icon-play"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="left-group">
					<?php if($settings['image_1']['url']) : ?>
						<div class="m-one move-image">
							<img src="<?php echo $settings['image_1']['url']; ?>" alt="Image" data-aos="fade-right"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
					<?php if($settings['image_2']['url']) : ?>
						<div class="m-two move-image">
							<img src="<?php echo $settings['image_2']['url']; ?>" alt="Image" data-aos="fade-right"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
					<?php if($settings['image_3']['url']) : ?>
						<div class="m-three move-image">
							<img src="<?php echo $settings['image_3']['url']; ?>" alt="Image" data-aos="fade-right"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
				</div>
				
				<div class="right-group">
					<?php if($settings['image_4']['url']) : ?>
						<div class="m-one move-image">
							<img src="<?php echo $settings['image_4']['url']; ?>" alt="Image" data-aos="fade-left"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
					<?php if($settings['image_5']['url']) : ?>
						<div class="m-two move-image">
							<img src="<?php echo $settings['image_5']['url']; ?>" alt="Image" data-aos="fade-left"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
					<?php if($settings['image_6']['url']) : ?>
						<div class="m-three move-image">
							<img src="<?php echo $settings['image_6']['url']; ?>" alt="Image" data-aos="fade-left"
								data-aos-duration="1000">
						</div>
					<?php endif; ?>
				</div>

			</div>

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Gallery_Section());