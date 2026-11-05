<?php

class CustomIcon
{
    public function __construct()
    {
        add_filter('elementor/icons_manager/additional_tabs', array($this, 'register_custom_icon_tab'));
    }

    public function register_custom_icon_tab($tabs)
    {
        $tabs['custom-icon'] = array(
            'name'          => 'custom-icon',
            'label'         => 'Theme Icon',
            'url'           => '',
            'enqueue'       => array(
                plugin_dir_url(__FILE__) . '/icomoon.css',
            ),
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'custom-icon',
            'ver'           => '',
            'fetchJson'     => plugin_dir_url(__FILE__) . '/icon.json',
            'native'        => true,
        );

        return $tabs;
    }
}

// Instantiate the CustomIcon class to activate it
new CustomIcon();









