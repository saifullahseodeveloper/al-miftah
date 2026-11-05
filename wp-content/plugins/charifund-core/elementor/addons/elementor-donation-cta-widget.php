<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Donation_Cta extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-donation-cta-widget';
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
		return esc_html__( 'Donation CTA', 'charifund-core' );
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
			'donation_cta',
			[
				'label' => esc_html__( 'Donation CTA', 'charifund-core' ),
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

		$this->add_control(
			'icons',
			[
				'label'   => __( 'Icon', 'charifund-core' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-hand-holding-heart',
					'library' => 'fa-solid',
				],
				'condition'	=> ['style' => ['style1','style2']],
			]
		);


		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Subtitle', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your subtitle', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
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
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'button',
			[
				'label'       => __( 'Button Text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your button text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Button Link', 'charifund-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Image', 'charifund-core' ),
				'type'    => Controls_Manager::MEDIA,
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Alt Text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your alt text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);


		$this->add_control(
			'video_link',
			[
			  'label' => __( 'Video Url', 'charifund-core' ),
			  'type' => Controls_Manager::URL,
			  'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
			  'show_external' => true,
			  'default' => [
				'url' => 'https://www.youtube.com/watch?v=Cn4G2lZ_g2I',
				'is_external' => true,
				'nofollow' => true,
			  ],
			  'condition'	=> ['style' => ['style1']],
			
		   ]
		);

		$this->add_control(
			'image2',
			[
				'label'   => __( 'Image', 'charifund-core' ),
				'type'    => Controls_Manager::MEDIA,
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'alt_text2',
			[
				'label'       => __( 'Alt Text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your alt text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'icons2',
			[
				'label'   => __( 'Icon', 'charifund-core' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-hand-holding-heart',
					'library' => 'fa-solid',
				],
				'condition'	=> ['style' => ['style1']],
			]
		);


		$this->add_control(
			'subtitle2',
			[
				'label'       => __( 'Subtitle', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your subtitle', 'charifund-core' ),
				'condition'	=> ['style' => ['style1']],
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
				'condition'	=> ['style' => ['style1']],
			]
		);

		$this->add_control(
			'button2',
			[
				'label'       => __( 'Button Text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your button text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'button_link2',
			[
				'label'       => __( 'Button Link', 'charifund-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'image3',
			[
				'label'   => __( 'Image', 'charifund-core' ),
				'type'    => Controls_Manager::MEDIA,
				'condition'	=> ['style' => ['style1','style2']],
			]
		);

		$this->add_control(
			'alt_text3',
			[
				'label'       => __( 'Alt Text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your alt text', 'charifund-core' ),
				'condition'	=> ['style' => ['style1','style2']],
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

	<section class="cta-section">
		<div class="container-fluid">
			<div class="row gutter-40">
				<div class="col-12 col-xl-4">
					<div class="cta-section__first cta-section__single">
					<div class="cta-section__group">
						<div class="thumb">
							<i class="<?php echo str_replace("icon ", "", esc_attr( $settings['icons']['value']));?>"></i>
						</div>
						<div class="content">
							<span><?php echo $settings['subtitle'];?></span>
							<h3 class="title-animation"><?php echo $settings['title'];?></h3>
						</div>
						<div class="cta-s">
							<a href="<?php echo esc_url($settings['button_link']['url']);?>" aria-label="become a volunteer"
								title="become a volunteer" class="btn--tertiary"><?php echo $settings['button'];?></a>
						</div>
					</div>
					<div class="cta-img">
					<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
						<img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
					<?php endif;?>
					</div>
					</div>
				</div>
				<div class="col-12 col-xl-4">
					<div class="cta-section__center cta-section__single">
					<div class="video-btn-wrapper">
						<a href="<?php echo esc_url($settings['video_link']['url']);?>" target="_blank"
							title="video Player" class="open-video-popup">
						<i class="icon-play"></i>
						</a>
					</div>
					<div class="cta-img">
						<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
							<img class="parallax-image" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
						<?php endif;?>
					</div>
					</div>
				</div>
				<div class="col-12 col-xl-4">
					<div class="cta-section__last cta-section__single">
					<div class="cta-section__group">
						<div class="thumb">
							<i class="<?php echo str_replace("icon ", "", esc_attr( $settings['icons2']['value']));?>"></i>
						</div>
						<div class="content">
							<span><?php echo $settings['subtitle2'];?></span>
							<h3 class="title-animation"><?php echo $settings['title2'];?></h3>
						</div>
						<div class="cta-s">
							<a href="<?php echo esc_url($settings['button_link']['url']);?>" aria-label="make a donation" title="make a donation"
								class="btn--primary"><?php echo $settings['button2'];?></a>
						</div>
					</div>
					<div class="cta-img">
					<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
						<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
					<?php endif;?>
					</div>
					</div>
				</div>
			</div>
		</div>
		</section>

		<?php  elseif ( 'style2' === $settings['style'] ) : ?>	

			<section class="cta-section-two">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-12 col-lg-7">
                     <div class="cta__section__content">
                        <div class="section__content text-center">
                           <span class="sub-title"><i class="<?php echo str_replace("icon ", "", esc_attr( $settings['icons']['value']));?>"></i><?php echo $settings['subtitle'];?></span>
                           <h2 class="title-animation"><?php echo $settings['title'];?></h2>
                           <div class="banner__content-cta cta">
						  	 <?php if($settings['button']): ?>
                              <a href="<?php echo esc_url($settings['button_link']['url']);?>" aria-label="about us" title="about us"
                                 class="btn--tertiary"><?php echo $settings['button'];?> <i class="fa-solid fa-arrow-right"></i></a>
								 <?php endif; ?>
								 <?php if($settings['button2']): ?>
                              <a href="<?php echo esc_url($settings['button_link2']['url']);?>" aria-label="contact us" title="contact us"
                                 class="btn--primary"><?php echo $settings['button2'];?> <i class="fa-solid fa-arrow-right"></i></a>
								 <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="cta-bg">
			   <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img class="parallax-image" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>
            </div>
            <div class="shape-left">
				<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
					<img src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
				<?php endif;?>
            </div>
            <div class="shape">
			<?php  if ( !empty(esc_url($settings['image3']['id']) )) : ?>   
				<img src="<?php echo wp_get_attachment_url($settings['image3']['id']);?>" alt="<?php echo esc_attr($settings['alt_text3']);?>"/>
			<?php endif;?>
            </div>
         </section>

<?php endif ;?>	
             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Donation_Cta());