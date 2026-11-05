<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;

class Charifund_Testimonial_Slider_Three_Widget extends Widget_Base
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
        return 'charifund-testimonial-slider-three';
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
        return esc_html__('Testimonial Slider 03', 'charifund-core');
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

        $this->start_controls_section(
            'testimonial slider',
            [
                'label' => esc_html__( 'Service Grid', 'charifund-core' ),
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
            'image_1',
                [
                  'label' => __( 'Image One', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );  
        
        $this->add_control(
            'image_2',
                [
                  'label' => __( 'Image Two', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );
        
        $this->add_control(
            'image_3',
                [
                  'label' => __( 'Image Three', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_1',
            [
                'label' => esc_html__( 'Slider 1', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'subtitle_1',
            [
                'label'       => __( 'Sub Title', 'charifund-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
            ]
        );
    
        $this->add_control(
                'description_1',
                [
                    'label'       => __( 'Description', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );
        $this->add_control(
                'name_1',
                [
                    'label'       => __( 'Name', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
                'designation_1',
                [
                    'label'       => __( 'Designation', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
            'icon_image_1',
                [
                  'label' => __( 'Icon Image', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );
        
       
        $this->end_controls_section();


        $this->start_controls_section(
            'slider_2',
            [
                'label' => esc_html__( 'Slider 2', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'subtitle_2',
            [
                'label'       => __( 'Sub Title', 'charifund-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
            ]
        );
    
        $this->add_control(
                'description_2',
                [
                    'label'       => __( 'Description', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );
        $this->add_control(
                'name_2',
                [
                    'label'       => __( 'Name', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
                'designation_2',
                [
                    'label'       => __( 'Designation', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
            'icon_image_2',
                [
                  'label' => __( 'Icon Image', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );
        
       
        $this->end_controls_section();

        $this->start_controls_section(
            'slider_3',
            [
                'label' => esc_html__( 'Slider 3', 'charifund-core' ),
            ]
        );
        $this->add_control(
            'subtitle_3',
            [
                'label'       => __( 'Sub Title', 'charifund-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your sub title', 'charifund-core' ),
            ]
        );
    
        $this->add_control(
                'description_3',
                [
                    'label'       => __( 'Description', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );
        $this->add_control(
                'name_3',
                [
                    'label'       => __( 'Name', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
                'designation_3',
                [
                    'label'       => __( 'Designation', 'charifund-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic'     => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'Enter your title', 'charifund-core' ),
                ]
        );

        $this->add_control(
            'icon_image_3',
                [
                  'label' => __( 'Icon Image', 'charifund-core' ),
                  'type' => Controls_Manager::MEDIA,
                  'default' => ['url' => Utils::get_placeholder_image_src(),],
                ]
        );
        
       
        $this->end_controls_section();
        

        $this->start_controls_section(
            'testimonial_styling_settings_section',
            [
                'label' => esc_html__('Styling Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control('subtitle_color', [
            'label' => esc_html__('Subtitle Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .testimonial-seven-title" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Subtitle Typography', 'charifund-core'),
            'name' => 'title_typography',
            'description' => esc_html__('Subtitle Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .testimonial-seven-title"
        ]);
        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .testimonial-seven-title" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Description Typography', 'charifund-core'),
            'name' => 'description_typography',
            'description' => esc_html__('Description Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .testimonial-seven-title"
        ]);
        $this->add_control('name_color', [
            'label' => esc_html__('Name Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} h6.testimonial-seven-name" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Name Typography', 'charifund-core'),
            'name' => 'name_typography',
            'description' => esc_html__('Name Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} h6.testimonial-seven-name"
        ]);
        $this->add_control('designation_color', [
            'label' => esc_html__(' Designation Color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} h4.testimonial-seven-name" => "color: {{VALUE}} !important"
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('Designation Typography', 'charifund-core'),
            'name' => 'name_typography',
            'description' => esc_html__('Designation Typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} h4.testimonial-seven-name"
        ]);

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
            <section class="testimonial-seven-area project-panel-area position-relative z-1">
         <div class="container">
            <div class="row">
               <div class="col-xl-5 col-lg-4">
                  <div class="testimonial-seven-thumb position-relative z-1">
                     <?php  if ( !empty(esc_url($settings['image_1']['id']) )) : ?>   
                        <img src="<?php echo wp_get_attachment_url($settings['image_1']['id']);?>" alt="img"/>
                    <?php endif;?>
                  </div>
                  <div class="testimonial-seven-thumb position-relative z-1">
                     <?php  if ( !empty(esc_url($settings['image_2']['id']) )) : ?>   
                        <img src="<?php echo wp_get_attachment_url($settings['image_2']['id']);?>" alt="img"/>
                    <?php endif;?>
                  </div>
                  <div class="testimonial-seven-thumb position-relative z-1">
                     <?php  if ( !empty(esc_url($settings['image_3']['id']) )) : ?>   
                        <img src="<?php echo wp_get_attachment_url($settings['image_3']['id']);?>" alt="img"/>
                    <?php endif;?>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-8">
                  <div class="row">
                     <div class="col-xl-12 project-panel">
                        <div class="testimonial-seven-wrapper">
                            <?php if($settings['subtitle_1']) : ?>
                           <h4 class="testimonial-seven-title"><?php echo $settings['subtitle_1'];?></h4>
                           <?php endif; ?>

                           <?php if($settings['description_1']) : ?>
                           <p class="testimonial-seven-paragraph"><?php echo $settings['description_1'];?></p>
                           <?php endif; ?>

                           <div class="testimonial-seven-wrap">
                              <div class="testimonial-seven-left">
                                 <div class="testimonial-seven-icon">
                                    <?php  if ( !empty(esc_url($settings['icon_image_1']['id']) )) : ?> 
                                    <span><img src="<?php echo wp_get_attachment_url($settings['icon_image_1']['id']);?>" alt="quate"></span>
                                    <?php endif;?>

                                 </div>
                                 <?php if($settings['name_1']) : ?>
                                 <h6 class="testimonial-seven-name"><?php echo $settings['name_1'];?></h6>
                                 <?php endif; ?>

                                 <?php if($settings['designation_1']) : ?>
                                 <h4 class="testimonial-seven-name"><?php echo $settings['designation_1'];?></h4>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12 project-panel">
                        <div class="testimonial-seven-wrapper">
                            <?php if($settings['subtitle_2']) : ?>
                           <h4 class="testimonial-seven-title"><?php echo $settings['subtitle_2'];?></h4>
                           <?php endif; ?>

                           <?php if($settings['description_2']) : ?>
                           <p class="testimonial-seven-paragraph"><?php echo $settings['description_2'];?></p>
                           <?php endif; ?>

                           <div class="testimonial-seven-wrap">
                              <div class="testimonial-seven-left">
                                 <div class="testimonial-seven-icon">
                                    <?php  if ( !empty(esc_url($settings['icon_image_2']['id']) )) : ?> 
                                    <span><img src="<?php echo wp_get_attachment_url($settings['icon_image_2']['id']);?>" alt="quate"></span>
                                    <?php endif;?>

                                 </div>
                                 <?php if($settings['name_2']) : ?>
                                 <h6 class="testimonial-seven-name"><?php echo $settings['name_2'];?></h6>
                                 <?php endif; ?>

                                 <?php if($settings['designation_2']) : ?>
                                 <h4 class="testimonial-seven-name"><?php echo $settings['designation_2'];?></h4>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xl-12 project-panel">
                        <div class="testimonial-seven-wrapper">
                            <?php if($settings['subtitle_3']) : ?>
                           <h4 class="testimonial-seven-title"><?php echo $settings['subtitle_3'];?></h4>
                           <?php endif; ?>

                           <?php if($settings['description_3']) : ?>
                           <p class="testimonial-seven-paragraph"><?php echo $settings['description_3'];?></p>
                           <?php endif; ?>

                           <div class="testimonial-seven-wrap">
                              <div class="testimonial-seven-left">
                                 <div class="testimonial-seven-icon">
                                    <?php  if ( !empty(esc_url($settings['icon_image_3']['id']) )) : ?> 
                                    <span><img src="<?php echo wp_get_attachment_url($settings['icon_image_3']['id']);?>" alt="quate"></span>
                                    <?php endif;?>

                                 </div>
                                 <?php if($settings['name_3']) : ?>
                                 <h6 class="testimonial-seven-name"><?php echo $settings['name_3'];?></h6>
                                 <?php endif; ?>

                                 <?php if($settings['designation_3']) : ?>
                                 <h4 class="testimonial-seven-name"><?php echo $settings['designation_3'];?></h4>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

        <?php  elseif ( 'style2' === $settings['style'] ) : ?>      
            <!-- <div class="service">
                <div class="service_grid">
                    <div class="single_service">
                        <div class="service_single-thumb">
                            <a href="<?php echo esc_url($settings['button_link']['url']);?>">
                            <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
                                <img src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
                            <?php endif;?>
                            </a>
                        </div>
                        <div class="service_content-wrapper">
                            <div class="service_single-content">
                                <h5><a href="<?php echo esc_url($settings['button_link']['url']);?>"><?php echo $settings['title'];?></a></h5>
                                <p><?php echo $settings['subtitle'];?></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> -->
        <?php endif ;?> 

             
        <?php 
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Testimonial_Slider_Three_Widget());