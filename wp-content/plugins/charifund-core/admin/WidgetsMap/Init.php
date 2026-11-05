<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Init{
    function __construct()
    {
        new Advanced();
        new Basic();
        new Site();
        new Woo();
        new Form();
    }
    public static function active_widgets($default = []){
        return Utils::get_option('imaddons_options', 'widget_list', $default);
    }
    public static function widget_filters(){
        return [
            // 'basic' => 'Basic',
            // 'advanced' => 'Advanced',
            // 'site' => 'Site',
            // 'form' => 'Form',
            // 'woo' => 'WooCommerce',
        ];
    }
}