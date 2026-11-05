<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Form
{

    function __construct(){
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widget'], 10, 1);
    }

    public function register_widget($widgets_manager){

        $default_widgets = self::default_widgets();
        $active_widgets = Init::active_widgets();

        foreach ($active_widgets as $widget) {
            if (in_array($widget, $default_widgets)) {
                $class_name = 'IMAddons\IMAddons_Input_' . Utils::mk_class($widget);
                include IMADDONS_WIDGETS_DIR_PATH . '/formbuilder/widgets/' . $widget . '.php';
                if (class_exists($class_name)) {
                    $widgets_manager->register_widget_type(new $class_name());
                }
            }
        }
    }

    public static function widgets_map(){
        return [
            'text' => [
                'demo' => '',
                'title' => __('Text', 'imaddons'),
                'icon' => 'eicon-button',
                'filter' => 'form',
            ],
            // 'email' => [
            //     'demo' => '',
            //     'title' => __('Email', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
            // ],
            // 'number' => [
            //     'demo' => '',
            //     'title' => __('Number', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
            // ],
            // 'telephone' => [
            //     'demo' => '',
            //     'title' => __('Telephone', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
            // ],
            // 'textarea' => [
            //     'demo' => '',
            //     'title' => __('Textarea', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
            // ],
            // 'url' => [
            //     'demo' => '',
            //     'title' => __('URL', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
            // ],
            // 'button' => [
            //     'demo' => '',
            //     'title' => __('Button', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'form',
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
