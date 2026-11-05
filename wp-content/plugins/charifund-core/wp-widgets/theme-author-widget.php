<?php
/**
 * Theme Author Widget
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('charifund_author_widget', array(
        'title' => esc_html__('Charifund: Author', 'charifund-core'),
        'classname' => 'charifund-widget-author',
        'description' => esc_html__('Display Author widget', 'charifund-core'),
        'fields' => array(
            array(
                'id' => 'image',
                'type' => 'media',
                'title' => esc_html__('Image', 'Charifund-core')
            ),
            array(
                'id' => 'name',
                'type' => 'text',
                'title' => esc_html__('Name', 'Charifund-core'),
                'default' => esc_html__('Rosalina Willaim', 'charifund-core')
            ),
            array(
                'id' => 'designation',
                'type' => 'text',
                'title' => esc_html__('designation', 'Charifund-core'),
                'default' => esc_html__('Front End Developer', 'charifund-core')
            ),
            array(
                'id' => 'content',
                'type' => 'text',
                'title' => esc_html__('content', 'Charifund-core'),
                'default' => esc_html__('he whimsically named Egg Canvas is the design director and photographer in New York.', 'charifund-core')
            ),

            array(
                'id' => 'charifund-author-social-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Author', 'charifund-core'),
                'fields' => array(
                    array(
                        'id' => 'charifund-author-social',
                        'type' => 'icon',
                        'title' => esc_html__('author social', 'charifund-core'),
                    ),
                    array(
                        'id' => 'charifund-author-social-url',
                        'type' => 'text',
                        'title' => esc_html__('author social', 'charifund-core'),
                        'default' => esc_html__('#', 'charifund-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('charifund_author_widget')) {
        function charifund_author_widget($args, $instance)
        {

            echo $args['before_widget'];
            $image = $instance['image'];
            $img_id = $image['id'] ?? '';
            $img_print = $img_id ? wp_get_attachment_image_src($img_id,'full')[0] : '';
            $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
            $name = $instance['name'] ?? '';
            $designation = $instance['designation'] ?? '';
            $content = $instance['content'] ?? '';
            $author = is_array($instance['charifund-author-social-repeater']) && !empty($instance['charifund-author-social-repeater']) ? $instance['charifund-author-social-repeater'] : [];
            ?>
            <div class="blog-main m-0 p-0">
                <div class="cm-details-author cm-sidebar-widget m-0 p-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <?php
                        if (!empty($img_print)) {
                            printf('<div class="author-thumb"><img src="%1$s" alt="%2$s"/></div>', esc_url($img_print), esc_attr($alt_text));
                        }
                    ?> 
                    <div class="author-meta">
                        <h6><?php echo esc_html($name); ?></h6>
                        <p><?php echo esc_html($designation); ?></p>
                        <p><?php echo esc_html($content); ?></p>
                    </div>
                    <div class="social">
                        <?php
                            foreach ($author as $socials) {
                                echo '
                                    <a href="'.$socials['charifund-author-social-url'].'">
                                        <i class="' . $socials['charifund-author-social'] . '"></i>
                                    </a>
                                ';
                            };
                        ?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }
    }

}

?>