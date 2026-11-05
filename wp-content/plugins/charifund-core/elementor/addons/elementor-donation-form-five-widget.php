<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;

class Charifund_Donation_Form_Five_Widget extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Elementor widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'charifund-donation-form-five-widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve Elementor widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Donation Form 05', 'charifund-core');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Elementor widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-person';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Elementor widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['charifund_widgets'];
    }

    /**
     * Register Elementor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => esc_html__('Slider Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
         $this->add_control(
            'title_3',
            [
                'label'       => __( 'Title Two Three', 'charifund-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Deal of The Day', 'charifund-core'),
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Join The <span>Community</span> To Give Education For Children', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'donation_url',
            [
                'label' => esc_html__('Donation Url', 'charifund-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('#', 'charifund-core'),
            ]
        );
        

        $this->end_controls_section();

        $this->start_controls_section(
            'donation_styling_settings_section',
            [
                'label' => esc_html__('Styling Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->end_controls_section();

    }


    /**
     * Render Elementor widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
            
        <div class="community home-15">
            <div class="container">
                
                        <div class="community-donation" data-aos="fade-up" data-aos-duration="1000">
                            <div class="community-donation__inner">
                            
                            <div class="donation-form">
                                <div class="donation-form__single">
                                    <h5>Your Donation:</h5>
                                    <div class="input-group-icon">
                                        <div class="thumb">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                        </div>
                                        <input type="text" name="donation-amount" id="donationAmount">
                                    </div>
                                    <div class="made-amount">
                                        <span class="donation-amount">20</span>
                                        <span class="donation-amount">50</span>
                                        <span class="donation-amount active">100</span>
                                        <span class="donation-amount">200</span>
                                        <span class="donation-amount custom-amount">Custom</span>
                                    </div>
                                </div>
                                <div class="donation-form__single">
                                    <h5>Select Payment Method</h5>
                                    <div class="radio-wrapper">
                                        <div class="radio-single">
                                        <input type="radio" id="testDonation" name="donation-payment" checked>
                                        <label for="testDonation">Test Donation</label>
                                        </div>
                                        <div class="radio-single">
                                        <input type="radio" id="offlineDonation" name="donation-payment"
                                            checked>
                                        <label for="offlineDonation">Offline Donation</label>
                                        </div>
                                        <div class="radio-single">
                                        <input type="radio" id="cardDonation" name="donation-payment" checked>
                                        <label for="cardDonation">Credit Card</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="cta">
                                    <a href="<?php echo $settings['donation_url']; ?>" aria-label="donate us" title="donate us"
                                        class="btn--primary">Donate Now <i
                                        class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                            
                        </div>
             
            </div>
           
            
        </div>
            
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Donation_Form_Five_Widget());