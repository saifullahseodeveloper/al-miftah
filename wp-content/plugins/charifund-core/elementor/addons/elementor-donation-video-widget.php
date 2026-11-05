<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Donation_Video extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-donation-video-widget';
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
		return esc_html__( 'Donation Video', 'charifund-core' );
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
			'donation_video',
			[
				'label' => esc_html__( 'Donation Video', 'charifund-core' ),
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
				
			   ]
			);

			$this->add_control(
				'bg_image',
				[
					'label' => esc_html__('Background image', 'charifund-core'),
					'type' => Controls_Manager::MEDIA,
					'default' => ['url' => Utils::get_placeholder_image_src(),],
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

		 <section class="donation-future">
            <div class="container">
               <div class="row gutter-40">
                  <div class="col-12 col-lg-6 col-xl-7">
                     <div class="donation-future__content">
                        <div class="section__content">
                           <span class="sub-title"><i class="icon-donation"></i><?php echo $settings['subtitle'];?></span>
                           <h2 class="title-animation"><?php echo $settings['title'];?></h2>
                           <div class="video-btn-wrapper">
                              <a href="<?php echo esc_url($settings['video_link']['url']);?>" target="_blank"
                                 title="video Player" class="open-video-popup">
                              <i class="icon-play"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-5">
                     <div class="donation-future__thumb" data-background="<?php echo wp_get_attachment_url($settings['bg_image']['id']);?>"
                        data-aos="fade-up">
                        <h4>Support for Food Expenses</h4>
                        <div class="cause__progress progress-bar-single">
                           <div class="cause-progress__bar">
                              <div class="progress-bar-wrapper" data-percent="60%">
                                 <div class="progress-bar">
                                    <div class="progress-bar-percent"><span class="percent-value"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="cause-progress__goal">
                           <p>Raised: <span class="raised">$8500</span></p>
                           <p>Goal: <span class="goal">$1,00,000</span></p>
                        </div>
                        <hr>
                        <div class="made-amount">
                           <span class="donation-amount">$100</span>
                           <span class="donation-amount">$200</span>
                           <span class="donation-amount active">$500</span>
                           <span class="donation-amount">$1000</span>
                           <span class="donation-amount">$10000</span>
                        </div>
                        <div class="cta">
                           <a href="https://charifundwp.wowtheme7.com/donations/help-for-education/" class="btn--primary">Donate Now <i class="icon-heart"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="donation-bg">
			   	<?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
					<img class="parallax-image" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
				<?php endif;?>

				<?php  if ( !empty(esc_url($settings['image2']['id']) )) : ?>   
					<img class="shape" src="<?php echo wp_get_attachment_url($settings['image2']['id']);?>" alt="<?php echo esc_attr($settings['alt_text2']);?>"/>
				<?php endif;?>
            </div>
         </section>
             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Donation_Video());