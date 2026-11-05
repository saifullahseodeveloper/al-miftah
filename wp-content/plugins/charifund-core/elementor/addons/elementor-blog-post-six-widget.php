<?php
/**
 * Elementor Widget
 * @package Charifund
 * @since 1.0.0
 */

namespace Elementor;

class Blog_Post_Six extends Widget_Base
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
        return 'charifund-blog-post-six-widget';
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
        return esc_html__('Blog Post 06', 'charifund-core');
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
                    'style2'   => esc_html__( 'Style Two', 'charifund-core' ),
                    'style3'   => esc_html__( 'Style Three', 'charifund-core' ),
                    'style4'   => esc_html__( 'Style Four', 'charifund-core' ),
                ),
            ]
        );
        
        $this->add_control('blog_grid', [
            'label' => esc_html__('Blog Grid', 'charifund-core'),
            'type' => Controls_Manager::SELECT,
            'options' => array(
                'col-lg-2' => esc_html__('col-lg-2', 'charifund-core'),
                'col-lg-3' => esc_html__('col-lg-3', 'charifund-core'),
                'col-lg-4' => esc_html__('col-lg-4', 'charifund-core'),
                'col-lg-6' => esc_html__('col-lg-6', 'charifund-core'),
                'col-lg-12' => esc_html__('col-lg-12', 'charifund-core'),
            ),
            'default' => 'col-lg-4',
            'description' => esc_html__('Select Blog Grid', 'charifund-core')
        ]);   
        
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
			'image',
				[
				  'label' => __( 'Hover Image', 'charifund-core' ),
				  'type' => Controls_Manager::MEDIA,
				  'default' => ['url' => Utils::get_placeholder_image_src(),],
				]
		);	
		
		$this->add_control(
			'alt_text',
			[
				'label'       => __( 'Hover Image Alt text', 'charifund-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter Your Text', 'charifund-core' ),
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
            <div class="blog syle-6 p-0">
                <div class="container">
                <div class="row gutter-30">
                    <?php while ($post_data->have_posts()):$post_data->the_post(); 
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                        $comments_count = get_comments_number(get_the_ID());
                        $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';
                    ?> 
                    <div class="col-12 <?php echo esc_attr($settings['blog_grid']); ?>">
                        <div class="blog__single-wrapper pb-3">
                            <div class="blog__single van-tilt">
                            <div class="blog__single-thumb">
                                
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                </a>
                                
                                <div class="tag">
                                
                                        <?php
                                        $post_tags = get_the_tags();
                                        if ($post_tags) {
                                            $first_tag = reset($post_tags);
                                            echo '<a href="' . esc_url(get_tag_link($first_tag->term_id)) . '"><i class="fa-solid fa-tags"></i> ' . esc_html($first_tag->name) . '</a>';
                                        } else {
                                            echo "No tags found";
                                        }
                                        ?>
                                   
                                </div>
                            </div>
                            <div class="blog__single-inner">
                                <div class="blog__single-meta">
                                    <p><i class="icon-user"></i><?php the_author(); ?></p>
                                    <p><i class="icon-message"></i><?php echo esc_html($comment_text); ?></p>
                                </div>
                                <div class="blog__single-content">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                </div>
                                <div class="blog__single-cta">
                                    <a href="<?php the_permalink(); ?>" aria-label="blog details" title="blog details"><span><i class="fa-solid fa-arrow-right"></i></span><?php echo $settings['button'];?></a>
                                </div>
                            </div>
                            <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
                                    <img class="spade-two" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        <?php if (!$pagination) { ?>
                            <div class="col-lg-12">
                                <div class="blog-pagination text-<?php echo esc_attr($pagination_alignment) ?> margin-top-20">
                                    
                                        <?php charifund()->post_pagination($post_data); ?>

                                </div>
                            </div>
                        <?php } ?>
                </div>
                </div>
            </div>
        <?php  elseif ( 'style2' === $settings['style'] ) : ?>
            <div class="blog syle-6 style_14 p-0">
                <div class="container">
                <div class="row gutter-15">
                    <?php while ($post_data->have_posts()):$post_data->the_post(); 
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                        $comments_count = get_comments_number(get_the_ID());
                        $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';
                    ?> 
                    <div class=" <?php echo esc_attr($settings['blog_grid']); ?>">
                        <div class="blog__single-wrapper pb-3">
                            <div class="blog__single van-tilt">
                            <div class="blog__single-thumb">
                                
                                <a class="imgs" href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                </a>
                                
                                <div class="tag">
                                
                                        <?php
                                        $post_tags = get_the_tags();
                                        if ($post_tags) {
                                            $first_tag = reset($post_tags);
                                            echo '<a href="' . esc_url(get_tag_link($first_tag->term_id)) . '"><i class="fa-solid fa-tags"></i> ' . esc_html($first_tag->name) . '</a>';
                                        } else {
                                            echo "No tags found";
                                        }
                                        ?>
                                   
                                </div>
                            </div>
                            <div class="blog__single-inner">
                                <div class="blog__single-meta">
                                    <p><i class="icon-user"></i><?php the_author(); ?></p>
                                    <p><i class="icon-message"></i><?php echo esc_html($comment_text); ?></p>
                                </div>
                                <div class="blog__single-content">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                </div>
                                <div class="blog__single-cta">
                                    <a href="<?php the_permalink(); ?>" aria-label="blog details" title="blog details"><span><i class="fa-solid fa-arrow-right"></i></span><?php echo $settings['button'];?></a>
                                </div>
                            </div>
                            <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
                                    <img class="spade-two" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        <?php if (!$pagination) { ?>
                            <div class="col-lg-12">
                                <div class="blog-pagination text-<?php echo esc_attr($pagination_alignment) ?> margin-top-20">
                                    
                                        <?php charifund()->post_pagination($post_data); ?>

                                </div>
                            </div>
                        <?php } ?>
                </div>
                </div>
            </div>
        <?php  elseif ( 'style3' === $settings['style'] ) : ?>
            <div class="blog fc-blog">
                <div class="container">
                    <div class="row gutter-40">
                        <?php 
                            $i = 0;
                            while ($post_data->have_posts()):$post_data->the_post(); 
                            $i++;
                            $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                            $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                            $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                            $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                            $comments_count = get_comments_number(get_the_ID());
                            $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';
                            $cou = '';
                            if($i<=9){
                                $cou = '0';
                            }
                        ?> 
                    
                        <div class="col-12 <?php echo esc_attr($settings['blog_grid']); ?>">
                            <div class="blog__single van-tilt mb-3">
                                <div class="blog__single-thumb">
                                    <a href="blog-details.html">
                                        <img src="<?php echo esc_url($img_url); ?>" alt="Image">
                                    </a>
                                    <div class="tag">
                                        <span><?php echo date('j') ?></span>
                                        <span><?php echo date('M') ?></span>
                                    </div>
                                </div>
                                <div class="blog__single-inner">
                                    <div class="blog__single-content">
                                        <?php
                                            $post_tags = get_the_tags();
                                            if ($post_tags) {
                                                $first_tag = reset($post_tags);
                                                echo '<span class="e-tag">' . esc_html($first_tag->name) . '</span>';
                                            } else {
                                                echo '<span class="e-tag">No tags found</span>';
                                            }
                                        ?>
                                        <h6>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h6>
                                    </div>
                                    <div class="blog__single-meta mb-0">
                                        <p>
                                            <i class="icon-user"></i> <?php charifund()->posted_by(); ?>
                                        </p>
                                        <p>
                                            <i class="icon-message"></i> <?php charifund()->comment_count(); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        <?php if (!$pagination) { ?>
                            <div class="col-lg-12">
                                <div class="blog-pagination text-<?php echo esc_attr($pagination_alignment) ?> margin-top-20">
                                    
                                        <?php charifund()->post_pagination($post_data); ?>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php elseif ( 'style4' === $settings['style'] ) : ?>
            <div class="blog syle-6 home-15 p-0">
                <div class="container">
                <div class="row gutter-30">
                    <?php while ($post_data->have_posts()):$post_data->the_post(); 
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_blog_12', false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                        $comments_count = get_comments_number(get_the_ID());
                        $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';
                    ?> 
                    <div class="col-12 <?php echo esc_attr($settings['blog_grid']); ?>">
                        <div class="blog__single-wrapper pb-3">
                            <div class="blog__single van-tilt">
                            <div class="blog__single-thumb">
                                
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                </a>
                                
                                <div class="tag">
                                
                                        <?php
                                        $post_tags = get_the_tags();
                                        if ($post_tags) {
                                            $first_tag = reset($post_tags);
                                            echo '<a href="' . esc_url(get_tag_link($first_tag->term_id)) . '"><i class="fa-solid fa-tags"></i> ' . esc_html($first_tag->name) . '</a>';
                                        } else {
                                            echo "No tags found";
                                        }
                                        ?>
                                   
                                </div>
                            </div>
                            <div class="blog__single-inner">
                                <div class="blog__single-meta">
                                    <p><i class="icon-user"></i><?php the_author(); ?></p>
                                    <p><i class="icon-message"></i><?php echo esc_html($comment_text); ?></p>
                                </div>
                                <div class="blog__single-content">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                </div>
                                <div class="blog__single-cta">
                                    <a href="<?php the_permalink(); ?>" aria-label="blog details" title="blog details"><?php echo $settings['button'];?> <i class="fa-solid fa-circle-arrow-right"></i></a>
                                </div>
                            </div>
                            <?php  if ( !empty(esc_url($settings['image']['id']) )) : ?>   
                                    <img class="spade-two" src="<?php echo wp_get_attachment_url($settings['image']['id']);?>" alt="<?php echo esc_attr($settings['alt_text']);?>"/>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        <?php if (!$pagination) { ?>
                            <div class="col-lg-12">
                                <div class="blog-pagination text-<?php echo esc_attr($pagination_alignment) ?> margin-top-20">
                                    
                                        <?php charifund()->post_pagination($post_data); ?>

                                </div>
                            </div>
                        <?php } ?>
                </div>
                </div>
            </div>
        <?php endif ;?>	

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Blog_Post_Six());