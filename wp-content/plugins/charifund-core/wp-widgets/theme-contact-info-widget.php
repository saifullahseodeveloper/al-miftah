<?php
/**
 * Theme Contact Info Widget
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a Contact Info Widget
    CSF::createWidget('charifund_contact_info_widget', array(
        'title' => esc_html__('Charifund: Contact Info', 'charifund-core'),
        'classname' => 'charifund-widget-contact-info',
        'description' => esc_html__('Display Contact Info widget', 'charifund-core'),
        'fields' => array(
            array(
                'id' => 'title',
                'type' => 'text',
                'title' => esc_html__('Title', 'charifund-core'),
            ),
            array(
                'id' => 'location',
                'type' => 'textarea',
                'title' => esc_html__('Location', 'Charifund-core'),
                'default' => esc_html__('4517 Washington Ave. Manchester, Kentucky 39495', 'charifund-core'),
            ),
            array(
                'id' => 'phone',
                'type' => 'text',
                'title' => esc_html__('Phone', 'Charifund-core'),
                'default' => esc_html__(' (+888) 123 456 765', 'charifund-core'),
            ),
            array(
                'id' => 'email',
                'type' => 'text',
                'title' => esc_html__('Email', 'Charifund-core'),
                'default' => esc_html__(' infoname@mail.com', 'charifund-core'),
            ),

            array(
                'id' => 'charifund-footer-social-icon-repeater',
                'type' => 'repeater',
                'title' => esc_html__('Social Icon', 'charifund-core'),
                'fields' => array(

                    array(
                        'id' => 'charifund-footer-social-icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'charifund-core'),
                        'default' => 'flaticon-call'
                    ),
                    array(
                        'id' => 'charifund-footer-social-text',
                        'type' => 'text',
                        'title' => esc_html__('Enter Your Url', 'charifund-core'),
                        'default' => esc_html__('#', 'charifund-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('charifund_contact_info_widget')) {
        function charifund_contact_info_widget($args, $instance)
        {

            echo $args['before_widget'];
            $title = $instance['title'] ?? '';
            $location = $instance['location'] ?? '';
            $phone = $instance['phone'] ?? '';
            $email = $instance['email'] ?? '';
            $csocialIcon = is_array($instance['charifund-footer-social-icon-repeater']) && !empty($instance['charifund-footer-social-icon-repeater']) ? $instance['charifund-footer-social-icon-repeater'] : [];
            ?>

            <div class="footer-widget widget">
            	<h4 class="widget-headline"><?php echo esc_html($title); ?></h4>
            	<div class="widget_contact">
                    <ul class="details">
                        <li><i class="fa fa-map-marker-alt"></i><?php echo esc_html($location); ?></li>
                        <li class="mt-3"><i class="fa fa-phone-alt"></i> <?php echo esc_html($phone); ?></li>
                        <li class="mt-2"><i class="fas fa-envelope"></i> <?php echo esc_html($email); ?></li>
                    </ul>
                    <?php if (!empty($csocialIcon)) { ?>
                        <ul class="social-media mt-4">
                            <?php
                            foreach ($csocialIcon as $cicon) {
                                echo '<li>
	                                <a href="'.$cicon['charifund-footer-social-text'].'">
	                                    <i class="'. $cicon['charifund-footer-social-icon'] . '"></i></a>
	                            </li>';
                            };
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>

            <?php

            echo $args['after_widget'];

        }
    }

}

?>