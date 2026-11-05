<?php
namespace Elementor;

/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */ 
 
class Donation_War extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'charifund-donation-war-widget';
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
		return esc_html__( 'Donation War', 'charifund-core' );
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

		 <div class="donation-future war">
            <div class="container">
                     <div class="donation-future__thumb">

                        <h2 class="title-animation"><?php echo $settings['title'];?></h2>
                     	 <p class=""><?php echo $settings['subtitle'];?></p>

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

             
		<?php 
	}


}

Plugin::instance()->widgets_manager->register_widget_type(new Donation_War());