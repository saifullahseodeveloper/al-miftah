<?php

namespace IMAddons\Admin\WidgetsMap;

use \IMAddons\Helpers\Utils as Utils;

class Woo{

    function __construct(){
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widget'], 10, 1);
    }

    public function register_widget($widgets_manager){
        $default_widgets = self::default_widgets();
        $active_widgets = Init::active_widgets();

        foreach ($active_widgets as $widget) {
            if (in_array($widget, $default_widgets)) {
                $class_name = 'IMAddons\IMAddons_' . Utils::mk_class($widget);
                include IMADDONS_WIDGETS_DIR_PATH . '/woocommerce/' . $widget . '.php';
                if (class_exists($class_name)) {
                    $widgets_manager->register_widget_type(new $class_name());
                }
            }
        }
    }
 
    public static function widgets_map(){
        return [
            'product-archive' => [
                'demo' => '',
                'title' => __('Products', 'imaddons'),
                'icon' => 'eicon-button',
                'filter' => 'woo',
            ],
            // 'product-categories' => [
            //     'demo' => '',
            //     'title' => __('Products Categories', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'woo-breadcrumb' => [
            //     'demo' => '',
            //     'title' => __('Woo Breadcrumb', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'add-to-cart' => [
            //     'demo' => '',
            //     'title' => __('Add To Cart', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'woo-pages' => [
            //     'demo' => '',
            //     'title' => __('Woo Pages', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'menu-cart' => [
            //     'demo' => '',
            //     'title' => __('Menu Cart', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-title' => [
            //     'demo' => '',
            //     'title' => __('Product Title', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-thumbnail' => [
            //     'demo' => '',
            //     'title' => __('Product Thumbnail', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-short-description' => [
            //     'demo' => '',
            //     'title' => __('Product Short Description', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // // 'product-content' => [
            // //     'demo' => '',
            // //     'title' => __('Product Content', 'imaddons'),
            // //     'icon' => 'eicon-button',
            //     // 'filter' => 'woo',
            // // ],
            // 'product-price' => [
            //     'demo' => '',
            //     'title' => __('Prouct Price', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-meta' => [
            //     'demo' => '',
            //     'title' => __('Prouct Meta', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-ratting' => [
            //     'demo' => '',
            //     'title' => __('Prouct Rating', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'group-products' => [
            //     'demo' => '',
            //     'title' => __('Group Products', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'tabs' => [
            //     'demo' => '',
            //     'title' => __('Prouct Tabs', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'total-sale' => [
            //     'demo' => '',
            //     'title' => __('Total Sale', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'up-sells' => [
            //     'demo' => '',
            //     'title' => __('Up Sells', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-attribute' => [
            //     'demo' => '',
            //     'title' => __('Prouct Attributes', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-images' => [
            //     'demo' => '',
            //     'title' => __('Prouct Images', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-related' => [
            //     'demo' => '',
            //     'title' => __('Prouct Related', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-sale-badge' => [
            //     'demo' => '',
            //     'title' => __('Sale Badge', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-stock' => [
            //     'demo' => '',
            //     'title' => __('Stock', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'product-variation' => [
            //     'demo' => '',
            //     'title' => __('Prouct Variation', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'your-order' => [
            //     'demo' => '',
            //     'title' => __('Your Order', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'customer-details' => [
            //     'demo' => '',
            //     'title' => __('Customer Details', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'order-details' => [
            //     'demo' => '',
            //     'title' => __('Order Details', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'order-receipt' => [
            //     'demo' => '',
            //     'title' => __('Order Receipt', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'cart-items' => [
            //     'demo' => '',
            //     'title' => __('Cart Items', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'cart-table' => [
            //     'demo' => '',
            //     'title' => __('Cart Table', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'cart-total' => [
            //     'demo' => '',
            //     'title' => __('Cart Total', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'coupon' => [
            //     'demo' => '',
            //     'title' => __('Coupon', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'cross-sells' => [
            //     'demo' => '',
            //     'title' => __('Cross Sells', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'dashboard' => [
            //     'demo' => '',
            //     'title' => __('Dashboard', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'form-additional' => [
            //     'demo' => '',
            //     'title' => __('Form Additional', 'imaddons'),
            //     'icon' => 'eicon-button',
                // 'filter' => 'woo',
            // ],
            // 'form-billing' => [
            //     'demo' => '',
            //     'title' => __('Form Billing', 'imaddons'),
            //     'icon' => 'eicon-button',
                // 'filter' => 'woo',
            // ],
            // 'form-shipping' => [
            //     'demo' => '',
            //     'title' => __('Form Shipping', 'imaddons'),
            //     'icon' => 'eicon-button',
                // 'filter' => 'woo',
            // ],
            // 'woo-nav-menu' => [
            //     'demo' => '',
            //     'title' => __('Woo Nav Menu', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'payment-method' => [
            //     'demo' => '',
            //     'title' => __('Payment Method', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'review-order' => [
            //     'demo' => '',
            //     'title' => __('Review Order', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
            // 'review' => [
            //     'demo' => '',
            //     'title' => __('Review', 'imaddons'),
            //     'icon' => 'eicon-button',
            //     'filter' => 'woo',
            // ],
        ];
    }
    public static function default_widgets(){
        $map = self::widgets_map();
        $default_woo_builder_widgets = [];
        foreach ($map as $key => $value) {
            $default_woo_builder_widgets[] = $key;
        }
        return $default_woo_builder_widgets;
    }
}
