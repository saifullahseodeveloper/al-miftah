<?php
/**
 * Elementor Widget
 * @package charifund
 * @since 1.0.0
 */

namespace Elementor;

class Charifund_Donation_List_Two_Widget extends Widget_Base
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
        return 'charifund-donation-list-two-widget';
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
        return esc_html__('Donation List 02', 'charifund-core');
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
        $this->add_control('donation_style', [
            'label' => esc_html__('donation Grid', 'eduall-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'style-1' => esc_html__('Style One', 'eduall-core'),
                'style-2' => esc_html__('Style Two', 'eduall-core'),
                'style-3' => esc_html__('Style Three', 'eduall-core'),
            ),
            'default' => 'style-1',
            'description' => esc_html__('Select Donation Style', 'eduall-core')
        ]);
		$this->add_control('donation_grid', [
            'label' => esc_html__('donation Grid', 'eduall-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'col-lg-3' => esc_html__('col-lg-2', 'eduall-core'),
                'col-lg-3' => esc_html__('col-lg-3', 'eduall-core'),
                'col-lg-4' => esc_html__('col-lg-4', 'eduall-core'),
                'col-lg-6' => esc_html__('col-lg-6', 'eduall-core'),
                'col-lg-12' => esc_html__('col-lg-12', 'eduall-core'),
            ),
            'default' => 'col-lg-3',
            'description' => esc_html__('Select Blog Grid', 'eduall-core')
        ]);
        $this->add_control('total', [
            'label' => esc_html__('Total Posts', 'charifund-core'),
            'type' => Controls_Manager::TEXT,
            'default' => '-1',
            'description' => esc_html__('enter how many course you want in masonry , enter -1 for unlimited course.')
        ]);
        $this->add_control('order', [
            'label' => esc_html__('Order', 'charifund-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'ASC' => esc_html__('Ascending', 'charifund-core'),
                'DESC' => esc_html__('Descending', 'charifund-core'),
            ),
            'default' => 'ASC',
            'description' => esc_html__('select order', 'charifund-core')
        ]);
       
        $this->add_control('orderby', [
            'label' => esc_html__('OrderBy', 'charifund-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'ID' => esc_html__('ID', 'charifund-core'),
                'title' => esc_html__('Title', 'charifund-core'),
                'date' => esc_html__('Date', 'charifund-core'),
                'rand' => esc_html__('Random', 'charifund-core'),
                'comment_count' => esc_html__('Most Comments', 'charifund-core'),
            ),
            'default' => 'ID',
            'description' => esc_html__('select order', 'charifund-core')
        ]);
        $this->end_controls_section();

        $this->start_controls_section(
            'donation_styling_settings_section',
            [
                'label' => esc_html__('Styling Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'sastek-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .donation-card .donation-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control('title_hover_color', [
            'label' => esc_html__('title_hover_color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .donation-title a:hover" => "color: {{VALUE}}",
            ]
        ]);
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'label' => esc_html__('title Typography', 'charifund-core'),
            'name' => 'title_typography',
            'description' => esc_html__('title typography', 'charifund-core'),
            'selector' => "{{WRAPPER}} .donation-title"
        ]);
        $this->add_control('donation_icon_color', [
            'label' => esc_html__('donation_icon_color', 'charifund-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                "{{WRAPPER}} .donation-card .donation-meta p svg" => "color: {{VALUE}}",
            ]
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        //query settings
        $total_posts = $settings['total'];
        $order = $settings['order'];
        $orderby = $settings['orderby'];
        // 'taxonomy' => 'give_forms_category',
        //setup query
        $args = array(
            'post_type' => 'give_forms',
            'posts_per_page' => $total_posts,
            'order' => $order,
            'orderby' => $orderby,
            'post_status' => 'publish'
        );
        $post_data = new \WP_Query($args);
        ?>
        <?php if($settings['donation_style'] === 'style-2') : ?>   
            <div class="cause fc-cause bg-transparent p-0">
                <div class="row">
                    <?php 
                        $i = 0;
                        while ($post_data->have_posts()):$post_data->the_post(); 
                        $i++;
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                    ?> 
                    <div class="<?php echo $settings['donation_grid']; ?> col-md-6">
                        <div class="cause__slider-single">
                            <div class="thumb">
                                <?php
                                    $form_id = get_the_ID();
                                    $logo_id = get_post_meta( $form_id, '_give_email_logo', true );
                                    if ( $logo_id ) {
                                        echo wp_get_attachment_image( $logo_id, 'medium', false, [
                                            'class' => 'givewp-email-logo',
                                            'alt'   => get_the_title( $form_id )
                                        ]);
                                    } else {
                                        echo '<p>No email logo set for this campaign.</p>';
                                    }
                                    $logo_url = get_post_meta( $form_id, '_give_email_logo', true );
                                ?>
                                <?php if($logo_url) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo $logo_url; ?>" alt="Image">
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/cause/'.$i.'.png'; ?>" alt="Image">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <h6 class="fw-7"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                            <?php
                                $form        = new \Give_Donate_Form( get_the_ID() );
                                $goal        = $form->goal;
                                $income      = $form->get_earnings();

                                $remaing = $goal - $income;
                                if ($income && $goal) {
                                    $progress = round( ( $income / $goal ) * 100 );
                                } else {
                                    $progress = '0';
                                }

                                if ( $income >= $goal ) {
                                    $progress_percentage = 1;
                                } else {
                                    $progress_percentage = $progress.'%';
                                }

                                if ( $income >= $goal ) {
                                    $progress = 100;
                                    $remaing = 0;
                                }

                                if ( $income >= $goal ) {
                                    $progressCir = 1;
                                } else {
                                    $progressCir = '0.'.$progress;
                                }

                                $income = give_human_format_large_amount( give_format_amount( $income ) );
                                $goal = give_human_format_large_amount( give_format_amount( $goal ) );
                                $remaing = give_human_format_large_amount( give_format_amount( $remaing ) );                                                                              
                            ?>
                            <div class="cause__slider-cta">
                                <div class="cause__progress progress-bar-single">
                                    <div class="cause-progress__intro">
                                        <p>
                                            <span class="raised"><?php echo $income; ?></span> raised of <span class="goal"><?php echo $goal; ?></span> goal <span class="percent-value"><?php echo $progress; ?>%</span>
                                        </p>
                                    </div>
                                    <div class="cause-progress__bar">
                                        <div class="progress-bar-wrapper" data-percent="<?php echo $progress; ?>%">
                                            <div class="progress-bar">
                                                <div class="progress-bar-percent"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cause__cta">
                                    <a href="<?php echo get_the_permalink(); ?>" aria-label="donate now" title="donate now" class="btn--secondary">Donate Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </div>
            </div>
       
        <?php elseif($settings['donation_style'] === 'style-3') : ?>   
            <div class="cause bg-transparent style3">
                <div class="row">
                    <?php 
                        $i = 0;
                        while ($post_data->have_posts()):$post_data->the_post(); 
                        $i++;
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                    ?> 
                    <div class="<?php echo $settings['donation_grid']; ?> col-md-6">
                        <div class="cause__slider-inner">
                            <div class="cause__slider-single">
                                <div class="thumb">
                                    <a href="cause-details.html">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/cause/'.$i.'.png'; ?>" alt="Image">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                                    <p>Lorem ipsum dolor sit amet, consete
                                        sadipscing elitr, sed diam nonum
                                    </p>
                                </div>
                                <?php
                                    $form        = new \Give_Donate_Form( get_the_ID() );
                                    $goal        = $form->goal;
                                    $income      = $form->get_earnings();
    
                                    $remaing = $goal - $income;
                                    if ($income && $goal) {
                                        $progress = round( ( $income / $goal ) * 100 );
                                    } else {
                                        $progress = '0';
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progress_percentage = 1;
                                    } else {
                                        $progress_percentage = $progress.'%';
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progress = 100;
                                        $remaing = 0;
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progressCir = 1;
                                    } else {
                                        $progressCir = '0.'.$progress;
                                    }
    
                                    $income = give_human_format_large_amount( give_format_amount( $income ) );
                                    $goal = give_human_format_large_amount( give_format_amount( $goal ) );
                                    $remaing = give_human_format_large_amount( give_format_amount( $remaing ) );                                                                              
                                ?>
                                <div class="cause__slider-cta">
                                    <div class="cause__progress progress-bar-single">
                                        <div class="cause-progress__intro">
                                        <p><span>Donation</span>
                                            <span class="percent-value"><?php echo $progress; ?>%</span>
                                        </p>
                                        </div>
                                        <div class="cause-progress__bar">
                                        <div class="progress-bar-wrapper" data-percent="<?php echo $progress; ?>%">
                                            <div class="progress-bar">
                                                <div class="progress-bar-percent">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="cause-progress__goal">
                                        <p>Raised: <span class="raised"><?php echo $income; ?></span></p>
                                        <p>Goal: <span class="goal"><?php echo $goal; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="cause__cta">
                                        <a href="<?php echo get_the_permalink(); ?>" aria-label="donate now"
                                        title="donate now" class="btn--secondary">Donate Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="cause home-15 p-0 bg-transparent">
                <div class="row">
                    <?php 
                        $i = 0;
                        while ($post_data->have_posts()):$post_data->the_post(); 
                        $i++;
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                    ?> 
                    <div class="<?php echo $settings['donation_grid']; ?> col-md-6">
                        <div class="cause__slider-inner">
                            <div class="cause__slider-single">
                                <div class="thumb">
                                    <a href="cause-details.html">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/cause/'.$i.'.png'; ?>" alt="Image">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                                    <p>Lorem ipsum dolor sit amet, consete
                                        sadipscing elitr, sed diam nonum
                                    </p>
                                </div>
                                <?php
                                    $form        = new \Give_Donate_Form( get_the_ID() );
                                    $goal        = $form->goal;
                                    $income      = $form->get_earnings();
    
                                    $remaing = $goal - $income;
                                    if ($income && $goal) {
                                        $progress = round( ( $income / $goal ) * 100 );
                                    } else {
                                        $progress = '0';
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progress_percentage = 1;
                                    } else {
                                        $progress_percentage = $progress.'%';
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progress = 100;
                                        $remaing = 0;
                                    }
    
                                    if ( $income >= $goal ) {
                                        $progressCir = 1;
                                    } else {
                                        $progressCir = '0.'.$progress;
                                    }
    
                                    $income = give_human_format_large_amount( give_format_amount( $income ) );
                                    $goal = give_human_format_large_amount( give_format_amount( $goal ) );
                                    $remaing = give_human_format_large_amount( give_format_amount( $remaing ) );                                                                              
                                ?>
                                <div class="cause__slider-cta">
                                    <div class="cause__progress progress-bar-single">
                                        <div class="cause-progress__intro">
                                        <p><span>Donation</span>
                                            <span class="percent-value"><?php echo $progress; ?>%</span>
                                        </p>
                                        </div>
                                        <div class="cause-progress__bar">
                                        <div class="progress-bar-wrapper" data-percent="<?php echo $progress; ?>%">
                                            <div class="progress-bar">
                                                <div class="progress-bar-percent">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="cause-progress__goal">
                                        <p>Raised: <span class="raised"><?php echo $income; ?></span></p>
                                        <p>Goal: <span class="goal"><?php echo $goal; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="cause__cta">
                                        <a href="<?php echo get_the_permalink(); ?>" aria-label="donate now"
                                        title="donate now" class="btn--secondary">Donate Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                    ?>
                </div>
            </div>
        <?php endif; ?>
            
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Charifund_Donation_List_Two_Widget());