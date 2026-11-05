<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;

class Charifund_Testimonial_Slider_Four_Widget extends Widget_Base
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
        return 'charifund-testimonial-slider-four';
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
        return esc_html__('Testimonial Slider 04', 'charifund-core');
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
        return 'eicon-slides';
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

        // Tab Start - 1

        $this->start_controls_section(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'charifund-core' ),
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
            'image', [
                'label' => __( 'Image', 'charifund-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
                'condition' => ['style' => ['style1','style2']],
            ]
        );
        $this->add_control(
            'image_2', [
                'label' => __( 'Image 2', 'charifund-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
                'condition' => ['style' => ['style1','style2']],
            ]
        );
        $this->add_control(
            'image_3', [
                'label' => __( 'Image 3', 'charifund-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
                'condition' => ['style' => ['style1','style2']],
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
            'repeat', [
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => 
                    [
                        ['block_title' => esc_html__('Projects Completed', 'charifund-core')],
                    ],
                    'fields' => [                       
                    
                        'block_title' =>
                        [
                            'name' => 'block_title',
                            'label' => esc_html__('Title', 'charifund-core'),
                            'type' => Controls_Manager::TEXTAREA,
                            'default' => esc_html__('', 'charifund-core'),
                        ],

                        'block_subtitle' =>
                        [
                            'name' => 'block_subtitle',
                            'label' => esc_html__('Subtitle', 'charifund-core'),
                            'type' => Controls_Manager::TEXTAREA,
                            'default' => esc_html__('', 'charifund-core'),
                        ],

                        'block_text' =>
                        [
                            'name' => 'block_text',
                            'label' => esc_html__('Text', 'charifund-core'),
                            'type' => Controls_Manager::TEXTAREA,
                            'default' => esc_html__('', 'charifund-core'),
                        ],

                        'block_image' =>
                        [
                            'name' => 'block_image',
                            'label' => __( 'Image', 'charifund-core' ),
                            'type' => Controls_Manager::MEDIA,
                            'default' => ['url' => Utils::get_placeholder_image_src(),],
                        ],  

                         

                        'qut' =>
                        [
                            'name' => 'qut',
                            'label' => __( 'Qut Image', 'charifund-core' ),
                            'type' => Controls_Manager::MEDIA,
                            'default' => ['url' => Utils::get_placeholder_image_src(),],
                        ],  

                        

                        'block_rating' =>
                        [
                            'name' => 'block_rating',
                            'label'   => esc_html__( 'Select Rating', 'charifund-core' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'rat1',
                            'options' => array(
                                'rat1'   => esc_html__( 'Rating One', 'charifund-core' ),
                                'rat2'   => esc_html__( 'Rating Two', 'charifund-core' ),
                                'rat3'   => esc_html__( 'Rating Three', 'charifund-core' ),
                                'rat4'   => esc_html__( 'Rating Four', 'charifund-core' ),
                                'rat5'   => esc_html__( 'Rating Five', 'charifund-core' ),
                            ),
                        ],
                        
                    ],
                'title_field' => '{{block_title}}',
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
    protected function render() {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');
        ?>

        <?php  if ( 'style1' === $settings['style'] ) : ?>  
            <div class="testimonial p-0">
                <div class="testimonial__inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                            <div class="testimonial__slider swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach($settings['repeat'] as $item):?>  
                                    <div class="swiper-slide">
                                        <div class="testimonial__slider-single">
                                        <div class="review">
                                            <?php if ( 'rat1' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat2' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat3' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat4' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat5' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <blockquote><q><?php echo wp_kses($item['block_text'], $allowed_tags);?></q></blockquote>
                                        </div>
                                        <div class="author-info">
                                            <div class="author-thumb">
                                            <?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
                                                <img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text'], $allowed_tags);?>">
                                            <?php endif;?>
                                            </div>
                                            <div class="author-content">
                                                <h6><?php echo wp_kses($item['block_title'], $allowed_tags);?></h6>
                                                <p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>
                                            </div>
                                        </div>
                                        <div class="quote">
                                            <?php if(!empty(wp_get_attachment_url($item['block_image2']['id']))): ?>
                                                <img src="<?php echo wp_get_attachment_url($item['block_image2']['id']);?>" alt="<?php echo wp_kses($item['block_alt_text2'], $allowed_tags);?>">
                                            <?php endif;?>
                                        </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>

        <?php  elseif ( 'style2' === $settings['style'] ) : ?>      
    <div class="testimonial-nine-area position-relative z-1">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-12">
                  <div class="testimonial-nine-top overflow-hidden position-relative z-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                     <div class="row">
                        <div class="col-xl-4">
                           <div class="testimonial-nine-img-slide">
                              <div class="testimonial-nine-img-active">
                                 
                                  <!-- slide 1 -->
                                  <div class="testimonial-nine-img">
                                    <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?> 
                                      <img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="thumb-small">
                                      <?php endif;?>

                                  </div>
                                  <!-- slide 2 -->
                                 <div class="testimonial-nine-img">
                                    <?php  if ( !empty(esc_url($settings['image_2']['id']) )) : ?>
                                      <img src="<?php echo wp_get_attachment_url($settings['image_2']['id']);?>" alt="thumb-small">
                                      <?php endif;?>
                                  </div>
                                  <!-- slide 3 -->
                                  <div class="testimonial-nine-img">
                                    <?php  if ( !empty(esc_url($settings['image_3']['id']) )) : ?>
                                      <img src="<?php echo wp_get_attachment_url($settings['image_3']['id']);?>" alt="thumb-small">
                                      <?php endif;?>
                                  </div>
                                  
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-8">
                           <div class="testimonial-nine-top-content">
                              <div class="section-nine-wrapper mb-4">
                                 <h6 class="section-nine-subtitle"><?php echo $settings['subtitle'];?></h6>
                                 <h2 class="section-nine-title char-animation"><?php echo $settings['title'];?></h2>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-12">
                           <div class="testimonial-nine-slider-section">
                               <div class="testimonial-nine-thumb-active">
                                <?php foreach($settings['repeat'] as $item):?> 
                                   <!-- slide 1 -->
                                    <div class="testimonial-nine-wrapper position-relative z-1">
                                       <div class="testimonial-nine-thumb">
                                          <?php if(!empty(wp_get_attachment_url($item['block_image']['id']))): ?>
                                                <img src="<?php echo wp_get_attachment_url($item['block_image']['id']);?>" alt="imgs">
                                                    <?php endif;?>
                                          <div class="testimonial-nine-tag">
                                             <span><i class="icon-star"></i> 4.9</span>
                                          </div>
                                       </div>
                                       <div class="testimonial-nine-wrap">
                                          <div class="testimonial-nine-content">
                                             <p class="testimonial-nine-paragraph"><?php echo wp_kses($item['block_text'], $allowed_tags);?></p>
                                             <div class="testimonial-nine-bio">
                                                <div class="testimonial-nine-review">
                                                    
                                                   <h4><?php echo wp_kses($item['block_title'], $allowed_tags);?></h4>

                                                   <p><?php echo wp_kses($item['block_subtitle'], $allowed_tags);?></p>

                                                   <div class="testimonial-six-review testimonial-nine-review">
                                                      <div class="review">
                                            <?php if ( 'rat1' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat2' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat3' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat4' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            <?php elseif ( 'rat5' === $item['block_rating'] ) : ?>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            <?php endif; ?>
                                        </div>
                                                   </div>
                                                </div>
                                                <div class="testimonial-nine-quate">
                                                   <span>
                                                    <?php if(!empty(wp_get_attachment_url($item['qut']['id']))): ?>
                                                        <img src="<?php echo wp_get_attachment_url($item['qut']['id']);?>" alt="img">
                                                    <?php endif;?>
                                                    </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php endforeach; ?>  
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
        <?php endif ;?> 

             
        <?php 
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Testimonial_Slider_Four_Widget());