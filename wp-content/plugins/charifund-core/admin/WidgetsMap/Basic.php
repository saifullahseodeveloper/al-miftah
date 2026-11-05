<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Basic{

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
            'accordion' => [
                'demo' => '',
                'title' => __('Accordion', 'imaddons'),
                'icon' => 'eicon-accordion',
                'filter' => 'basic',
            ],
            // 'button' => [
            //     'demo' => '',
            //     'title' => __('Button', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'basic',
            // ],
            // 'contact-info' => [
            //     'demo' => '',
            //     'title' => __('Contact Info', 'imaddons'),
            //     'icon' => 'eicon-text',
            //     'filter' => 'basic',
            // ],
            // 'faq' => [
            //     'demo' => '',
            //     'title' => __('Faq', 'imaddons'),
            //     'icon' => 'eicon-accordion',
            //     'filter' => 'basic',
            // ],
            // 'heading' => [
            //     'demo' => '',
            //     'title' => __('Heading', 'imaddons'),
            //     'icon' => 'eicon-t-letter',
            //     'filter' => 'basic',
            // ],
            // 'funfact' => [
            //     'demo' => '',
            //     'title' => __('Funfact', 'imaddons'),
            //     'icon' => 'eicon-nerd-chuckle',
            //     'filter' => 'basic',
            // ],
            // 'icon-box' => [
            //     'demo' => '',
            //     'title' => __('Icon Box', 'imaddons'),
            //     'icon' => 'eicon-icon-box',
            //     'filter' => 'basic',
            // ],
            // 'image-box' => [
            //     'demo' => '',
            //     'title' => __('Image Box', 'imaddons'),
            //     'icon' => 'eicon-icon-box',
            //     'filter' => 'basic',
            // ],
            // 'progressbar' => [
            //     'demo' => '',
            //     'title' => __('Progressbar', 'imaddons'),
            //     'icon' => 'eicon-skill-bar',
            //     'filter' => 'basic',
            // ],
            // 'social' => [
            //     'demo' => '',
            //     'title' => __('Social', 'imaddons'),
            //     'icon' => 'eicon-social-icons',
            //     'filter' => 'basic',
            // ],
            // 'video' => [
            //     'demo' => '',
            //     'title' => __('Video', 'imaddons'),
            //     'icon' => 'eicon-youtube',
            //     'filter' => 'basic',
            // ],
            // 'form' => [
            //     'demo' => '',
            //     'title' => __('Form', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'basic',
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
