<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Advanced{

    function __construct(){
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widget'], 10, 1);
    }

    public function register_widget($widgets_manager){
        $default_widgets = self::default_widgets();
        $active_widgets = Init::active_widgets();

        foreach ($active_widgets as $widget) {
            if (in_array($widget, $default_widgets)) {
                $class_name = 'IMAddons\IMAddons_' . Utils::mk_class($widget);
                include IMADDONS_WIDGETS_DIR_PATH . '/' . $widget . '.php';
                if (class_exists($class_name)) {
                    $widgets_manager->register_widget_type(new $class_name());
                }
            }
        }
    }

    public static function widgets_map(){
        return [
           
            'countdown' => [
                'demo' => '',
                'title' => __('Countdown', 'imaddons'),
                'icon' => 'eicon-button',
                'filter' => 'advanced',
            ],
            // 'dual-button' => [
            //     'demo' => '',
            //     'title' => __('Dual Button', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'advanced',
            // ],
            // 'call-to-action' => [
            //     'demo' => '',
            //     'title' => __('Call to action', 'imaddons'),
            //     'icon' => 'eicon-text',
            //     'filter' => 'advanced',
            // ],
            // 'image-compare' => [
            //     'demo' => '',
            //     'title' => __('Image Compare', 'imaddons'),
            //     'icon' => 'eicon-icon-box',
            //     'filter' => 'advanced',
            // ],
            // 'image-gallery' => [
            //     'demo' => '',
            //     'title' => __('Image Gallery', 'imaddons'),
            //     'icon' => 'eicon-icon-box',
            //     'filter' => 'advanced',
            // ],
            // 'flip-box' => [
            //     'demo' => '',
            //     'title' => __('Flip Box', 'imaddons'),
            //     'icon' => 'eicon-icon-box',
            //     'filter' => 'advanced',
            // ],
            // 'price-table' => [
            //     'demo' => '',
            //     'title' => __('Price Table', 'imaddons'),
            //     'icon' => 'eicon-price-table',
            //     'filter' => 'advanced',
            // ],
            // 'circle-progressbar' => [
            //     'demo' => '',
            //     'title' => __('Circle Progressbar', 'imaddons'),
            //     'icon' => 'eicon-counter-circle',
            //     'filter' => 'advanced',
            // ],
            // 'blog-carousel' => [
            //     'demo' => '',
            //     'title' => __('Blog Carousel', 'imaddons'),
            //     'icon' => 'eicon-posts-carousel',
            //     'filter' => 'advanced',
            // ],
            // 'blog-posts' => [
            //     'demo' => '',
            //     'title' => __('Blog Posts', 'imaddons'),
            //     'icon' => 'eicon-posts-grid',
            //     'filter' => 'advanced',
            // ],
            // 'testimonial' => [
            //     'demo' => '',
            //     'title' => __('Testimonial', 'imaddons'),
            //     'icon' => 'eicon-testimonial',
            //     'filter' => 'advanced',
            // ],
            // 'testimonial-carousel' => [
            //     'demo' => '',
            //     'title' => __('Testimonial Carousel', 'imaddons'),
            //     'icon' => 'eicon-testimonial',
            //     'filter' => 'advanced',
            // ],
            // 'team' => [
            //     'demo' => '',
            //     'title' => __('Team', 'imaddons'),
            //     'icon' => 'eicon-lock-user',
            //     'filter' => 'advanced',
            // ],
            // 'team-carousel' => [
            //     'demo' => '',
            //     'title' => __('Team Carousel', 'imaddons'),
            //     'icon' => 'eicon-lock-user',
            //     'filter' => 'advanced',
            // ],
            // 'logo' => [
            //     'demo' => '',
            //     'title' => __('Logo', 'imaddons'),
            //     'icon' => 'eicon-logo',
            //     'filter' => 'advanced',
            // ],
            // 'nav-menu' => [
            //     'demo' => '',
            //     'title' => __('Nav Menu', 'imaddons'),
            //     'icon' => 'eicon-nav-menu',
            //     'filter' => 'advanced',
            // ],
            // 'portfolio-filter' => [
            //     'demo' => '',
            //     'title' => __('Portfolio Filter', 'imaddons'),
            //     'icon' => 'eicon-posts-justified',
            //     'filter' => 'advanced',
            // ],
            // 'portfolio-carousel' => [
            //     'demo' => '',
            //     'title' => __('Portfolio Carousel', 'imaddons'),
            //     'icon' => 'eicon-posts-carousel',
            //     'filter' => 'advanced',
            // ],
            // 'tabs' => [
            //     'demo' => '',
            //     'title' => __('Tabs', 'imaddons'),
            //     'icon' => 'eicon-tabs',
            //     'filter' => 'advanced',
            // ],
            // 'social-share' => [
            //     'demo' => '',
            //     'title' => __('Social Share', 'imaddons'),
            //     'icon' => 'eicon-social-icons',
            //     'filter' => 'advanced',
            // ],
            // 'carousel' => [
            //     'demo' => '',
            //     'title' => __('Carousel', 'imaddons'),
            //     'icon' => 'eicon-carousel',
            //     'filter' => 'advanced',
            // ],
            // 'wpcf7' => [
            //     'demo' => '',
            //     'title' => __('Contact Form 7', 'imaddons'),
            //     'icon' => 'eicon-form-horizontal',
            //     'filter' => 'advanced',
            // ],
            // 'easy-forms' => [
            //     'demo' => '',
            //     'title' => __('Easy Forms', 'imaddons'),
            //     'icon' => 'eicon-form-horizontal',
            //     'filter' => 'advanced',
            // ],
            // 'instafeed' => [
            //     'demo' => '',
            //     'title' => __('Instagram Feed', 'imaddons'),
            //     'icon' => 'eicon-instagram-nested-gallery',
            //     'filter' => 'advanced',
            // ],
            // 'slider' => [
            //     'demo' => '',
            //     'title' => __('Slider', 'imaddons'),
            //     'icon' => 'eicon-media-carousel',
            //     'filter' => 'advanced',
            // ],
            // 'login' => [
            //     'demo' => '',
            //     'title' => __('Login', 'imaddons'),
            //     'icon' => 'eicon-lock-user',
            //     'filter' => 'advanced',
            // ],
            // 'blockquote' => [
            //     'demo' => '',
            //     'title' => __('Blockquote', 'imaddons'),
            //     'icon' => 'eicon-blockquote',
            //     'filter' => 'advanced',
            // ],
        ];
    }

    public static function default_widgets(){
        $map = self::widgets_map();
        $dynamic_widgets = [];
        foreach ($map as $key => $value) {
            $dynamic_widgets[] = $key;
        }
        return $dynamic_widgets;
    }
}
