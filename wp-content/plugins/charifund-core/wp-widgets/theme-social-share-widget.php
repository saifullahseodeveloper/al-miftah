<?php
/**
 * Theme Social Share Widget
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('charifund_social_share_widget', array(
        'title' => esc_html__('Charifund: Social Share', 'charifund-core'),
        'classname' => 'charifund-social-share-about',
        'description' => esc_html__('Display Social Share widget', 'charifund-core'),
        'fields' => array(
            array(
                'id' => 'heading',
                'type' => 'text',
                'title' => esc_html__('Enter Your Header Title', 'charifund-core'),
                'default' => esc_html__('Never Miss News', 'charifund-core')
            ),
            array(
                'id' => 'charifund-social-icon-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Social Icon', 'charifund-core'),
                'fields' => array(
                    array(
                        'id' => 'charifund-social-icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'charifund-core'),
                        'default' => 'fab fa-facebook'
                    ),
                    array(
                        'id' => 'charifund-social-text',
                        'type' => 'text',
                        'title' => esc_html__('Enter Your Ulr', 'charifund-core'),
                        'default' => '#'
                    ),
                ),
            ),
        )
    ));


    if (!function_exists('charifund_social_share_widget')) {
        function charifund_social_share_widget($args, $instance)
        {

            echo $args['before_widget'];
            

            $heading_title = $instance['heading'] ?? '';
            $socialIcon = is_array($instance['charifund-social-icon-repeater']) && !empty($instance['charifund-social-icon-repeater']) ? $instance['charifund-social-icon-repeater'] : [];


            ?>
            <div class="social-share-widget">
                <h4 class="widget-headline"><?php echo esc_html($heading_title); ?></h4>
                <ul class="social-icon style-03">
                    <?php
                    foreach ($socialIcon as $icon) {
                        printf('<li><a href="%2$s"><i class="%1$s"></i></a></li>', esc_html($icon['charifund-social-icon']), esc_url($icon['charifund-social-text']));
                    };
                    ?>
                </ul>
            </div>

            <?php

            echo $args['after_widget'];

        }
    }

}

?>