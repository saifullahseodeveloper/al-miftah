<?php
/**
 *Theme Group Fields
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}


if (!class_exists('Charifund_Group_Fields')) {

    class Charifund_Group_Fields
    {
        
        /**
         * $instance
         * @since 1.0.0
         */
        private static $instance;


        /**
         * construct()
         * @since 1.0.0
         */
        public function __construct()
        {

        }

        /**
         * getInstance()
         * @since 1.0.0
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout()
        {
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => esc_html__('Page Layouts & Colors Options', 'charifund'),
                ),
                array(
                    'id' => 'page_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'charifund'),
                    'options' => array(
                        'default' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/default.png',
                        'left-sidebar' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'right-sidebar' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'blank' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/blank.png',
                    ),
                    'default' => 'default'
                ),
                array(
                    'id' => 'page_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'charifund'),
                    'default' => ''
                ),
                array(
                    'id' => 'page_content_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Background Color', 'charifund'),
                    'default' => ''
                ),
                array(
                    'id' => 'page_content_text_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Content Text Color', 'charifund'),
                    'default' => ''
                )

            );

            return $fields;
        }

        /**
         * Page container options
         * @since 1.0.0
         */
        public static function Page_Container_Options($type)
        {
            $fields = array();
            $allowed_html = charifund()->kses_allowed_html(array('mark'));
            if ('header_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Header, Footer & Breadcrumb Options', 'charifund'),
                    ),
                    array(
                        'id' => 'page_title',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Title', 'charifund'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page title.', 'charifund'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'charifund'),
                        'text_off' => esc_html__('No', 'charifund'),
                        'default' => true
                    ),
                    array(
                        'id' => 'page_breadcrumb',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Breadcrumb', 'charifund'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show/hide page breadcrumb.', 'charifund'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'charifund'),
                        'text_off' => esc_html__('No', 'charifund'),
                        'default' => true
                    ),
                    array(
                        'id' => 'navbar_type',
                        'title' => esc_html__('Navbar Type', 'charifund'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/00.png',
                            'style-01' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/01.png',
                            'style-02' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/02.png',
                            'style-03' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/03.png',
                            'style-04' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/04.png',
                    		'style-05' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/05.png',
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>navbar type</mark> transparent type or solid background.', 'charifund'), $allowed_html),
                    ),
                    array(
                        'id' => 'footer_type',
                        'title' => esc_html__('Footer Type', 'charifund'),
                        'type' => 'image_select',
                        'options' => array(
                            '' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/00.png',
                            'style-01' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/01.png',
                            'style-02' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/02.png',
                            'style-03' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/03.png',
                        ),
                        'default' => '',
                        'desc' => wp_kses(__('you can set <mark>footer type</mark> transparent type or solid background.', 'charifund'), $allowed_html),
                    ),

                );
            } elseif ('container_options' == $type) {
                $fields = array(
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Width & Padding Options', 'charifund'),
                    ),
                    array(
                        'id' => 'page_container',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Full Width', 'charifund'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page container full width.', 'charifund'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'charifund'),
                        'text_off' => esc_html__('No', 'charifund'),
                        'default' => false
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Spacing Options', 'charifund'),
                    ),
                    array(
                        'id' => 'page_spacing_top',
                        'title' => esc_html__('Page Spacing Top', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page container.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'id' => 'page_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page container.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 120,
                    ),
                    array(
                        'type' => 'subheading',
                        'content' => esc_html__('Page Content Spacing Options', 'charifund'),
                    ),
                    array(
                        'id' => 'page_content_spacing',
                        'type' => 'switcher',
                        'title' => esc_html__('Page Content Spacing', 'charifund'),
                        'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to set page content spacing.', 'charifund'), $allowed_html),
                        'text_on' => esc_html__('Yes', 'charifund'),
                        'text_off' => esc_html__('No', 'charifund'),
                        'default' => false
                    ),
                    array(
                        'id' => 'page_content_spacing_top',
                        'title' => esc_html__('Page Spacing Bottom', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_bottom',
                        'title' => esc_html__('Page Spacing Bottom', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_left',
                        'title' => esc_html__('Page Spacing Left', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Left</mark> for page content area.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                    array(
                        'id' => 'page_content_spacing_right',
                        'title' => esc_html__('Page Spacing Right', 'charifund'),
                        'type' => 'slider',
                        'desc' => wp_kses(__('you can set <mark>Padding Right</mark> for page content area.', 'charifund'), $allowed_html),
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                        'unit' => 'px',
                        'default' => 0,
                        'dependency' => array('page_content_spacing', '==', 'true')
                    ),
                );
            }

            return $fields;
        }


        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout_options($title, $prefix)
        {
            $allowed_html = charifund()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Page Options', 'charifund') . '</h3>',
                ),
                array(
                    'id' => $prefix . '_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Select Page Layout', 'charifund'),
                    'options' => array(
                        'right-sidebar' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/right-sidebar.png',
                        'left-sidebar' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/left-sidebar.png',
                        'no-sidebar' => CHARIFUND_THEME_SETTINGS_IMAGES . '/page/no-sidebar.png',
                    ),
                    'default' => 'right-sidebar'
                ),
                array(
                    'id' => $prefix . '_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Page Background Color', 'charifund'),
                    'default' => ''
                ),
                array(
                    'id' => $prefix . '_spacing_top',
                    'title' => esc_html__('Page Spacing Top', 'charifund'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Top</mark> for page content area.', 'charifund'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
                array(
                    'id' => $prefix . '_spacing_bottom',
                    'title' => esc_html__('Page Spacing Bottom', 'charifund'),
                    'type' => 'slider',
                    'desc' => wp_kses(__('you can set <mark>Padding Bottom</mark> for page content area.', 'charifund'), $allowed_html),
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'unit' => 'px',
                    'default' => 120,
                ),
            );

            return $fields;
        }

        /**
         * Post meta
         * @since 1.0.0
         */
        public static function post_meta($prefix, $title)
        {
            $allowed_html = charifund()->kses_allowed_html(array('mark'));
            $fields = array(
                array(
                    'type' => 'subheading',
                    'content' => '<h3>' . $title . esc_html__(' Post Options', 'charifund') . '</h3>',
                ),
                array(
                    'id' => $prefix . '_posted_by',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted By', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted by.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                )
            );

            if ('blog_post' == $prefix) {
                $fields[] = array(
                    'id' => $prefix . '_posted_cat',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Category', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn',
                    'type' => 'switcher',
                    'title' => esc_html__('Read More Button', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide read more button.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_readmore_btn_text',
                    'type' => 'text',
                    'title' => esc_html__('Read More Text', 'charifund'),
                    'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'charifund'), $allowed_html),
                    'default' => esc_html__('Read More', 'charifund'),
                    'dependency' => array($prefix . '_readmore_btn', '==', 'true')
                );
                $fields[] = array(
                    'id' => $prefix . '_excerpt_more',
                    'type' => 'text',
                    'title' => esc_html__('Excerpt More', 'charifund'),
                    'desc' => wp_kses(__('you can set read more <mark>button text</mark> to button text.', 'charifund'), $allowed_html),
                    'attributes' => array(
                        'placeholder' => esc_html__('....', 'charifund')
                    )
                );
                $fields[] = array(
                    'id' => $prefix . '_excerpt_length',
                    'type' => 'select',
                    'options' => array(
                        '25' => esc_html__('Short', 'charifund'),
                        '55' => esc_html__('Regular', 'charifund'),
                        '100' => esc_html__('Long', 'charifund'),
                    ),
                    'title' => esc_html__('Excerpt Length', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark> excerpt length</mark> for post.', 'charifund'), $allowed_html),
                );
            } elseif ('blog_single_post' == $prefix) {

                $fields[] = array(
                    'id' => $prefix . '_posted_category',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Category', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide posted category.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_tag',
                    'type' => 'switcher',
                    'title' => esc_html__('Posted Tags', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post tags.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_posted_share',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Share', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post share.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
                $fields[] = array(
                    'id' => $prefix . '_next_post_nav_btn',
                    'type' => 'switcher',
                    'title' => esc_html__('Post Navigation', 'charifund'),
                    'desc' => wp_kses(__('you can set <mark>ON / OFF</mark> to show / hide post navigation button.', 'charifund'), $allowed_html),
                    'text_on' => esc_html__('Yes', 'charifund'),
                    'text_off' => esc_html__('No', 'charifund'),
                    'default' => true
                );
            }

            return $fields;
        }

    }//end class

}//end if

