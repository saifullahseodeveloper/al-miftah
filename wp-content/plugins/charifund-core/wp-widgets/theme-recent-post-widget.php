<?php
/**
 * Theme Recent Post Widget
 * @package Charifund
 * @since 1.0.0
 * @changed 1.0.1
 */

if (!defined('ABSPATH')) {

    exit(); //exit if access directly

}

class Charifund_Recent_Post_Widget extends WP_Widget

{
    public function __construct()
    {
        parent::__construct(
            'charifund_popular_posts',
            esc_html__('Charifund: Recent Posts with Thumbnails', 'charifund-core'),
            array('description' => esc_html__('Display your recent posts, with a thumbnail.', 'charifund-core'))
        );
    }

    public function widget($args, $instance)

    {
        $title = isset($instance['title']) && !empty($instance['title']) ? $instance['title'] : '';
        $no_of_posts = isset($instance['no_of_posts']) && !empty($instance['no_of_posts']) ? $instance['no_of_posts'] : '';
        $order = isset($instance['order']) && !empty($instance['order']) ? $instance['order'] : 'ASC';
        $post_type = isset($instance['post_type']) && !empty($instance['post_type']) ? $instance['post_type'] : 'post';
        $orderby = isset($instance['orderby']) && !empty($instance['orderby']) ? $instance['orderby'] : 'ID';
        echo wp_kses_post($args['before_widget']);

        if (!empty($title)) {
            echo wp_kses_post($args['before_title']) . esc_html($title) . wp_kses_post($args['after_title']);
        }
        //WP_Query argument

        $qargs = array(

            'post_type' => $post_type,
            'posts_per_page' => $no_of_posts,
            'offset' => 0,
            'ignore_sticky_posts' => 1,
            'post_status' => array('publish'),
            'order' => $order,
            'orderby' => $orderby

        );


        $recent_articles = new WP_Query($qargs);

        //have to write code for displing query data

        if ($recent_articles->have_posts()) : ?>

            <ul class="theme-recent-post-wrap">

            <?php while ($recent_articles->have_posts()) : $recent_articles->the_post(); ?>
                <li class="theme-recent-post-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumb">
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php the_post_thumbnail_url('thumbnail') ?>" alt="<?php the_title() ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="content">
                        <span class="time"><?php echo get_the_date('F j, Y');?></span>
                        <h6><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></a></h6>
                    </div>
                </li>

            <?php
            endwhile;
            wp_reset_query();

        else :
            esc_html__(' Oops, there are no posts.', 'charifund-core')
            ?>
        <?php endif; ?>
        </ul>
        <?php

        echo wp_kses_post($args['after_widget']);

    }

    public function form($instance)

    {
        //have to create form instance

        if (!empty($instance) && $instance['title']) {

            $title = apply_filters('widget_title', $instance['title']);

        } else {

            $title = esc_html__('Recent Posts', 'charifund-core');

        }
        $no_of_posts = !empty($instance) && $instance['no_of_posts'] ? $instance['no_of_posts'] : '5';
        $order = !empty($instance) && $instance['order'] ? $instance['order'] : 'ASC';
        $orderby = !empty($instance) && $instance['orderby'] ? $instance['orderby'] : 'ID';

        $post_type = array(
            'post' => esc_html__('Blog Post Type', 'charifund-core'),
            'packages' => esc_html__('Packages Post Type', 'charifund-core'),
            'project' => esc_html__('project Post Type', 'charifund-core'),
            'service' => esc_html__('Service Post Type', 'charifund-core'),
            'courses' => esc_html__('Courses Post Type', 'charifund-core')
        );

        $order_arr = array(
            'ASC' => esc_html__('Acceding', 'charifund-core'),
            'DESC' => esc_html__('Descending', 'charifund-core')
        );

        $orderby_arr = array(
            'ID' => esc_html__('ID', 'charifund-core'),
            'title' => esc_html__('Title', 'charifund-core'),
            'date' => esc_html__('Date', 'charifund-core'),
            'rand' => esc_html__('Random', 'charifund-core'),
            'comment_count' => esc_html__('Most Comment', 'charifund-core')
        );

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_type')) ?>"><?php esc_html_e('Post Type', 'charifund-core'); ?></label>

            <select name="<?php echo esc_attr($this->get_field_name('post_type')) ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('post_type')) ?>">

                <?php

                foreach ($post_type as $key => $value) {

                    $checked = ($key == $order) ? 'selected' : '';

                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);

                }
                ?>
            </select>
        </p>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'charifund-core'); ?></label>

            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')) ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   value="<?php echo esc_attr($title) ?>">

        </p>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('no_of_posts')) ?>"><?php esc_html_e('No Of Posts', 'charifund-core'); ?></label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('no_of_posts')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('no_of_posts')); ?>" type="text"
                   value="<?php echo esc_attr($no_of_posts); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')) ?>"><?php esc_html_e('Order', 'charifund-core'); ?></label>

            <select name="<?php echo esc_attr($this->get_field_name('order')) ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('order')) ?>">

                <?php

                foreach ($order_arr as $key => $value) {

                    $checked = ($key == $order) ? 'selected' : '';

                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);

                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')) ?>"><?php esc_html_e('OrderBy', 'charifund-core'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('orderby')) ?>" class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('orderby')) ?>">
                <?php
                foreach ($orderby_arr as $key => $value) {
                    $checked = ($key == $orderby) ? 'selected' : '';
                    printf('<option value="%1$s" %3$s >%2$s</option>', $key, $value, $checked);
                }
                ?>
            </select>
        </p>
        <?php

    }

    public function update($new_instance, $old_instance)

    {
        $instance = array();
        $instance['order'] = (!empty($new_instance['order']) ? sanitize_text_field($new_instance['order']) : '');
        $instance['orderby'] = (!empty($new_instance['orderby']) ? sanitize_text_field($new_instance['orderby']) : '');
        $instance['title'] = (!empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '');
        $instance['post_type'] = (!empty($new_instance['post_type']) ? sanitize_text_field($new_instance['post_type']) : '');
        $instance['no_of_posts'] = (!empty($new_instance['no_of_posts']) ? absint($new_instance['no_of_posts']) : '');
        if (is_numeric($new_instance['no_of_posts']) == false) {
            $instance['no_of_posts'] = $old_instance['no_of_posts'];
        }

        return $instance;

    }

} // end class


if (!function_exists('Charifund_Recent_Post_Widget')) {

    function Charifund_Recent_Post_Widget()

    {
        register_widget('Charifund_Recent_Post_Widget');
    }

    add_action('widgets_init', 'Charifund_Recent_Post_Widget');

}

