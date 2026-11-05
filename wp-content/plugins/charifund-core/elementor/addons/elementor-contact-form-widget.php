<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Contact_Form extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-contact-form-widget';
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
		return esc_html__( 'Contact Form', 'charifund-core' );
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
			'contact_form',
			[
				'label' => esc_html__( 'Contact Form', 'charifund-core' ),
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
					'style3'   => esc_html__( 'Style Three', 'charifund-core' ),
				),
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
		
	//Title
	
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

		$this->add_control(
			'contact_us_form',
			[
				'label'       => __( 'Contact Form ShortCode', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Contact Form ShortCode', 'charifund-core' ),
				'default'     => __( '', 'charifund-core' ),
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

	<section class="contact home-3-contact-form">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-12 col-md-10 col-xl-7">
					<div class="contact__content">
					<div class="section__content">
						<?php if($settings['subtitle']): ?>
						<span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
						<?php endif; ?>
						<h2 class="title-animation"><?php echo $settings['title'];?></h2>

					</div>
						
					<div class="contact__form cta">
						<?php echo do_shortcode( $settings['contact_us_form'] );?>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="contact-bg">
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

		<?php  elseif ( 'style2' === $settings['style'] ) : ?>	

			<section class="volunteer p-0">
				<div class="contact__form volunteer__form checkout__form">
					<div class="volunteer__form-content">
						<h4 class="title-animation"><?php echo $settings['title'];?></h4>
						<p><?php echo $settings['subtitle'];?></p>
					</div>
					<div class="cta">
					
						<?php echo do_shortcode( $settings['contact_us_form'] );?>

					</div>
				</div>
			</section>
	<?php  elseif ( 'style3' === $settings['style'] ) : ?>
	<section class="contact fc-contact">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-12 col-md-10 col-xl-7">
						<div class="contact__content">
						<div class="section__content">
							<?php if($settings['subtitle']): ?>
							<span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
							<?php endif; ?>
							<h2 class="title-animation color-black"><?php echo $settings['title'];?></h2>

						</div>

						<div class="contact__form cta">
							<?php echo do_shortcode( $settings['contact_us_form'] );?>
						</div>
						</div>
					</div>
				</div>
			</div>
			<div class="contact-bg">
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

Plugin::instance()->widgets_manager->register_widget_type(new Contact_Form());