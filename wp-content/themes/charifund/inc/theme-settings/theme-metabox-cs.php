<?php
/**
 * Theme Metabox Options
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}

if (class_exists('CSF')) {

    $allowed_html = charifund()->kses_allowed_html(array('mark'));

    $prefix = 'charifund';

    /*-------------------------------------
        Post Format Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_post_video_options', array(
        'title' => esc_html__('Video Post Format Options', 'charifund'),
        'post_type' => 'post',
        'post_formats' => 'video'
    ));
    CSF::createSection($prefix . '_post_video_options', array(
        'fields' => array(
            array(
                'id' => 'video_url',
                'type' => 'text',
                'title' => esc_html__('Enter Video URL', 'charifund'),
                'desc' => wp_kses(__('enter <mark>video url</mark> to show in frontend', 'charifund'), $allowed_html)
            )
        )
    ));
    CSF::createMetabox($prefix . '_post_gallery_options', array(
        'title' => esc_html__('Gallery Post Format Options', 'charifund'),
        'post_type' => 'post',
        'post_formats' => 'gallery'
    ));
    CSF::createSection($prefix . '_post_gallery_options', array(
        'fields' => array(
            array(
                'id' => 'gallery_images',
                'type' => 'gallery',
                'title' => esc_html__('Select Gallery Photos', 'charifund'),
                'desc' => wp_kses(__('select <mark>gallery photos</mark> to show in frontend', 'charifund'), $allowed_html)
            )
        )
    ));

    /*-------------------------------------
      Page Container Options
    -------------------------------------*/
    CSF::createMetabox($prefix . '_page_container_options', array(
        'title' => esc_html__('Page Options', 'charifund'),
        'post_type' => array('page'),
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Layout & Colors', 'charifund'),
        'icon' => 'fa fa-columns',
        'fields' => Charifund_Group_Fields::page_layout()
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Header Footer & Breadcrumb', 'charifund'),
        'icon' => 'fa fa-header',
        'fields' => Charifund_Group_Fields::Page_Container_Options('header_options')
    ));
    CSF::createSection($prefix . '_page_container_options', array(
        'title' => esc_html__('Width & Padding', 'charifund'),
        'icon' => 'fa fa-file-o',
        'fields' => Charifund_Group_Fields::Page_Container_Options('container_options')
    ));
    //	Service Meta Box
    CSF::createMetabox($prefix . '_service_options', array(
        'title' => esc_html__('Service Options', 'charifund'),
        'post_type' => 'service',
    ));
    CSF::createSection($prefix . '_service_options', array(
        'fields' => array(
            array(
                'id' => 'service_icon',
                'type' => 'media',
                'title' => esc_html__('Icon', 'charifund'),
                'desc' => wp_kses(__('Select Your Icon', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'service_icon_shape',
                'type' => 'media',
                'title' => esc_html__('Icon Shape', 'charifund'),
                'desc' => wp_kses(__('Select Your Icon Shape', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'service_icon_shape_2',
                'type' => 'media',
                'title' => esc_html__('Icon Shape 2', 'charifund'),
                'desc' => wp_kses(__('Select Your Icon Shape 2', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'service_line_shape',
                'type' => 'media',
                'title' => esc_html__('Line Shape', 'charifund'),
                'desc' => wp_kses(__('Select Your Shape', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'service_content',
                'type' => 'textarea',
                'title' => esc_html__('service content', 'charifund'),
                'desc' => wp_kses(__('Select Your service content', 'charifund'), $allowed_html)
            )
        )
    ));

    /*-------------------------------------
     Team Options
    -------------------------------------*/
    
    CSF::createMetabox($prefix . '_team_options', array(
        'title' => esc_html__('Team Options', 'charifund'),
        'post_type' => array('team'),
        'priority' => 'high'
    ));
    CSF::createSection($prefix . '_team_options', array(
        'title' => esc_html__('Team Info', 'charifund'),
        'id' => 'charifund-info',
        'fields' => array(
            array(
                'id' => 'designation',
                'type' => 'text',
                'title' => esc_html__('Designation', 'charifund'),
            ),
            array(
                'id' => 'course',
                'type' => 'text',
                'title' => esc_html__('Course', 'charifund'),
            ),
            array(
                'id' => 'student',
                'type' => 'text',
                'title' => esc_html__('student', 'charifund'),
            ),
            array(
                'id' => 'rating',
                'type' => 'text',
                'title' => esc_html__('rating', 'charifund'),
            ),
            array(
                'id' => 'team_content',
                'type' => 'textarea',
                'title' => esc_html__('Team content', 'charifund'),
                'desc' => wp_kses(__('Write Your content', 'charifund'), $allowed_html)
            )
        )
    ));
    CSF::createSection($prefix . '_team_options', array(
        'title' => esc_html__('Social Info', 'charifund'),
        'id' => 'social-info',
        'fields' => array(
            array(
                'id' => 'social-icons',
                'type' => 'repeater',
                'title' => esc_html__('Social Info', 'charifund'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'title' => esc_html__('Icon', 'charifund'),
                        'default' => 'fa fa-facebook-f'

                    ),
                    array(
                        'id' => 'url',
                        'type' => 'text',
                        'title' => esc_html__('URL', 'charifund')
                    ),

                ),
            ),
        )
    ));

    //	Project Meta Box
    CSF::createMetabox($prefix . '_project_options', array(
        'title' => esc_html__('Project Options', 'charifund'),
        'post_type' => 'project',
    ));

    CSF::createSection($prefix . '_project_options', array(
        'fields' => array(
            array(
                'id' => 'project_icon',
                'type' => 'text',
                'title' => esc_html__('Project Icon', 'charifund'),
                'desc' => wp_kses(__('Write your Project Icon Text', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'project_subtitle',
                'type' => 'text',
                'title' => esc_html__('Project Subtitle', 'charifund'),
                'desc' => wp_kses(__('Write your Project Subtitle', 'charifund'), $allowed_html)
            ),
            array(
                'id' => 'project_content',
                'type' => 'textarea',
                'title' => esc_html__('Project content', 'charifund'),
                'desc' => wp_kses(__('Write your Project content', 'charifund'), $allowed_html)
            ),
        )
    ));

    //	Product Meta Box
    CSF::createMetabox($prefix . '_product_options', array(
        'title' => esc_html__('Product Options', 'charifund'),
        'post_type' => 'product',
    ));
    CSF::createSection($prefix . '_product_options', array(
        'fields' => array(
            array(
                'id' => 'product_audio_img',
                'type' => 'media',
                'title' => esc_html__('Product audio image', 'charifund'),
            ),
            array(
                'id' => 'product_audio_list',
                'type' => 'text',
                'title' => esc_html__('Product audio url', 'charifund'),
                'default' => esc_html__('http://physical-authority.surge.sh/music/2.mp3', 'charifund'),
            ),
            array(
                'id' => 'product_subtitle',
                'type' => 'text',
                'title' => esc_html__('Product Subtitle', 'charifund'),
                'default' => esc_html__('Ray studio', 'charifund'),
            ),
            array(
                'id' => 'download_text',
                'type' => 'text',
                'title' => esc_html__('download text', 'charifund'),
                'default' => esc_html__('Download: 2.4K', 'charifund'),
            ),
        )
    ));

    //	Courses Meta Box
    CSF::createMetabox($prefix . '_courses_options', array(
        'title' => esc_html__('Courses Options', 'charifund'),
        'post_type' => 'courses',
    ));

    CSF::createSection($prefix . '_courses_options', array(
        'title' => esc_html__('Social Info', 'charifund'),
        'id' => 'social-info',
        'fields' => array(
            array(
                'id' => 'course_start_date_option',
                'type' => 'text',
                'title' => esc_html__('Start From', 'charifund'),
                'default' => esc_html__('Thursday, Nov 4, 2023', 'charifund'),
            ),
            array(
                'id' => 'study-option',
                'type' => 'repeater',
                'title' => esc_html__('Study Options', 'charifund'),
                'fields' => array(

                    array(
                        'id' => 'qualification',
                        'type' => 'text',
                        'title' => esc_html__('Qualification', 'charifund'),
                        'default' => esc_html__('Bachelor of Aviation (Hons)', 'charifund'),
                    ),
                    array(
                        'id' => 'length',
                        'type' => 'text',
                        'title' => esc_html__('Length', 'charifund'),
                        'default' => esc_html__('9 months full time', 'charifund'),
                    ),
                    array(
                        'id' => 'code',
                        'type' => 'text',
                        'title' => esc_html__('Code', 'charifund'),
                        'default' => esc_html__('ba1x', 'charifund'),
                    ),
                ),
            ),
            array(
                'id' => 'course_module_option',
                'type' => 'text',
                'title' => esc_html__('Course Module Title', 'charifund'),
                'default' => esc_html__('Download full course Module', 'charifund'),
            ),
            array(
                'id' => 'course_module_button_title',
                'type' => 'text',
                'title' => esc_html__('Course Module Button Title', 'charifund'),
                'default' => esc_html__('Download', 'charifund'),
            ),
            array(
                'id' => 'course_module_button_url',
                'type' => 'text',
                'title' => esc_html__('Course Module Button URL', 'charifund'),
                'default' => esc_html__('#', 'charifund'),
            ),
        )
    ));
}//endif