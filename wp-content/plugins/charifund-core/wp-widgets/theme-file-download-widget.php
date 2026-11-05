<?php
/**
 * Theme File Download Widget
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {


    // Create a About Widget
    CSF::createWidget('charifund_file_download_widget', array(
        'title' => esc_html__('Charifund: File Download', 'charifund-core'),
        'classname' => 'charifund-widget-file-download',
        'description' => esc_html__('Display File Download widget', 'charifund-core'),
        'fields' => array(
            array(
                'id' => 'title',
                'type' => 'text',
                'title' => esc_html__('Title', 'Charifund-core'),
                'default' => esc_html__('Download', 'charifund-core')
            ),

            array(
                'id' => 'charifund-file-download-repeater',
                'type' => 'repeater',
                'title' => esc_html__('File Download', 'charifund-core'),
                'fields' => array(
                    array(
                        'id' => 'charifund-file-download',
                        'type' => 'media',
                        'title' => esc_html__('File', 'charifund-core'),
                    ),
                    array(
                        'id' => 'charifund-file-download-text',
                        'type' => 'text',
                        'title' => esc_html__('File Text', 'charifund-core'),
                        'default' => esc_html__('Company Profile', 'charifund-core')
                    ),

                ),
            ),
        )
    ));


    if (!function_exists('charifund_file_download_widget')) {
        function charifund_file_download_widget($args, $instance)
        {

            echo $args['before_widget'];

            $title = $instance['title'] ?? '';
            $file_download = is_array($instance['charifund-file-download-repeater']) && !empty($instance['charifund-file-download-repeater']) ? $instance['charifund-file-download-repeater'] : [];


            ?>
            <div class="widget_download">
                <h5 class="widget-headline style-01"><?php echo esc_html($title); ?></h5>               
                <ul>
                    <?php
                        foreach ($file_download as $file) {
                            echo '<li class="mb-0 mt-0">
                                <a download href="'.$file['charifund-file-download']['url'].'">
                                    ' . $file['charifund-file-download-text'] . '
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>';
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