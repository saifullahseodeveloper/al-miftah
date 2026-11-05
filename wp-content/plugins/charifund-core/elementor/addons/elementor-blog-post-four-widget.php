<?php
/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */

namespace Elementor;

class Blog_Post_Four extends Widget_Base
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
        return 'charifund-blog-post-four-widget';
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
        return esc_html__('Blog Post 4', 'charifund-core');
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
        return 'eicon-post';
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
            'settings_section',
            [
                'label' => esc_html__('General Settings', 'charifund-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
                    
                ),
            ]
        );
        
  
        
        $this->add_control(
			'button',
			[
				'label'       => __( 'Button', 'charifund-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Enter your button text', 'charifund-core' ),
				'default' => esc_html__('Read More', 'charifund-core'),
			]
		);	


        $this->add_control(
            'word_limit',
            [
                'label' => esc_html__('Word Limit', 'charifund-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'description' => esc_html__('Set the number of words to display from the post content.', 'charifund-core'),
            ]
        );

        $this->add_control(
            'more_text',
            [
                'label' => esc_html__('More Text', 'charifund-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '...',
                'description' => esc_html__('Set the text to append after the trimmed words, e.g., "Read More". Leave blank for no text.', 'charifund-core'),
            ]
        );
   
        $this->add_control('total', [
            'label' => esc_html__('Total Posts', 'charifund-core'),
            'type' => Controls_Manager::TEXT,
            'default' => '-1',
            'description' => esc_html__('enter how many post you want in masonry , enter -1 for unlimited post.')
        ]);
        $this->add_control('offset', [
            'label' => esc_html__('Offset Posts', 'charifund-core'),
            'type' => Controls_Manager::TEXT,
            'default' => '0',
            'description' => esc_html__('enter how many post you want in masonry , enter -1 for unlimited post.')
        ]);
        $this->add_control('category', [
            'label' => esc_html__('Category', 'charifund-core'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => charifund_core()->get_terms_names('category', 'id'),
            'description' => esc_html__('Select category as you want, leave it blank for all categories', 'charifund-core'),
        ]);        

        $this->add_control('order', [
            'label' => esc_html__('Order', 'charifund-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'ASC' => esc_html__('Ascending', 'charifund-core'),
                'DESC' => esc_html__('Descending', 'charifund-core'),
            ),
            'default' => 'DESC',
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
        
           $this->add_control(
            'image_thumb_display',
            [
                'label' => esc_html__('Image Display', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('show/hide description', 'charifund-core'),
            ]
        );
        
        $this->add_control(
            'thumb_date',
            [
                'label' => esc_html__('Thumb Date Show/Hide', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('show/hide description', 'charifund-core'),
            ]
        );
      
        $this->add_control(
            'pagination',
            [
                'label' => esc_html__('Pagination', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes to show pagination.', 'charifund-core'),
                'default' => 'no',
            ]
        );
        
          $this->add_control(
            'category_display',
            [
                'label' => esc_html__('Category Display', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Show  Or Hide Category.', 'charifund-core'),
            ]
        );

          $this->add_control(
            'tag_display',
            [
                'label' => esc_html__('Tags Display', 'charifund-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('Show  Or Hide Tags.', 'charifund-core'),
            ]
        );
        
        $this->add_control(
            'pagination_alignment',
            [
                'label' => esc_html__('Pagination Alignment', 'charifund-core'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'start' => esc_html__('Left Align', 'charifund-core'),
                    'center' => esc_html__('Center Align', 'charifund-core'),
                    'end' => esc_html__('Right Align', 'charifund-core'),
                ),
                'description' => esc_html__('you can set pagination alignment.', 'charifund-core'),
                'default' => 'start',
                'condition' => array('pagination' => 'yes'),
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
        $rand_numb = rand(333, 999999999);
        //query settings
        $total_posts = $settings['total'];
        $category = $settings['category'];
        $order = $settings['order'];
        $orderby = $settings['orderby'];
        $offset = $settings['offset'];
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        //other settings
        $pagination = $settings['pagination'] ? false : true;
        $pagination_alignment = $settings['pagination_alignment'];

        //setup query       

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $total_posts,
            'order' => $order,
            'orderby' => $orderby,
            'paged' => $paged, // Use paged instead of offset
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        );
        
        if (!empty($category)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $category
                )
            );
        }
        
        $post_data = new \WP_Query($args);
        

        ?>

        
        <?php  if ( 'style1' === $settings['style'] ) : ?>
            <div class="blogs">
                
                
                        
                <?php while ($post_data->have_posts()):$post_data->the_post(); 
                    $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                    $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                    $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                    $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                    $comments_count = get_comments_number(get_the_ID());
                    $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';
                    ?>
                   

                   <div class="blog-seven-wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                     <div class="blog-seven-content">
                        <div class="blog-seven-meta">
                           <ul>
                              <li><?php the_author(); ?></li>
                              <li><?php echo esc_html($comment_text); ?></li>
                           </ul>
                       </div>
                       <h4 class="blog-seven-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="blog-seven-button">
                           <a href="">Read More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                     </div>
                     <div class="blog-seven-thumb">
                       
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                      
                     </div>
                  </div>

                 <?php
             endwhile;
             wp_reset_query();
             ?>
             
 
         </div>
        <?php  elseif ( 'style2' === $settings['style'] ) : ?>
            <div class="blog blog-two p-0">
               
            </div>
        <?php  elseif ( 'style3' === $settings['style'] ) : ?>
           
        <?php endif ;?>	

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Blog_Post_Four());