<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Site{

    function __construct(){
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widget'], 10, 1);
    }


    public function register_widget($widgets_manager){

        $default_widgets = self::default_widgets();
        $active_widgets = Init::active_widgets();

        foreach ($active_widgets as $widget) {
            if (in_array($widget, $default_widgets)) {
                $class_name = 'IMAddons\IMAddons_' . Utils::mk_class($widget);
                include IMADDONS_WIDGETS_DIR_PATH . '/site/' . $widget . '.php';
                if (class_exists($class_name)) {
                    $widgets_manager->register_widget_type(new $class_name());
                }
            }
        }
    }

    public static function widgets_map(){
        return [
            'post-title' => [
                'demo' => '',
                'title' => __( 'Post Title', 'imaddons' ),
                'icon' => 'eicon-button',
                'filter' => 'site',
            ],
            // 'post-excerpt' => [
            //     'demo' => '',
            //     'title' => __( 'Post Excerpt', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'post-content' => [
            //     'demo' => '',
            //     'title' => __( 'Post Content', 'imaddons' ),
            //     'icon' => 'eicon-button',
                // 'filter' => 'site',
            // ],
            // 'post-nav' => [
            //     'demo' => '',
            //     'title' => __( 'Post Nav', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'post-featured-image' => [
            //     'demo' => '',
            //     'title' => __( 'Post Featured Image', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'author-info' => [
            //     'demo' => '',
            //     'title' => __( 'Author Info', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'breadcrumb' => [
            //     'demo' => '',
            //     'title' => __( 'Breadcrumb', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'comments' => [
            //     'demo' => '',
            //     'title' => __( 'Breadcrumb', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'page-title' => [
            //     'demo' => '',
            //     'title' => __( 'Page Title', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'site-title' => [
            //     'demo' => '',
            //     'title' => __( 'Site Title', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'search-form' => [
            //     'demo' => '',
            //     'title' => __( 'Search Form', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
            // 'post-info' => [
            //     'demo' => '',
            //     'title' => __( 'Post Info', 'imaddons' ),
            //     'icon' => 'eicon-button',
            //     'filter' => 'site',
            // ],
        ];
    }
    public static function default_widgets(){
        $map = self::widgets_map();
        $default_site_builder_widgets = [];
        foreach ($map as $key => $value) {
            $default_site_builder_widgets[] = $key;
        }
        return $default_site_builder_widgets;
    }
}
