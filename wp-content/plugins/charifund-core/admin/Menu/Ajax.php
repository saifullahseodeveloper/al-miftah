<?php 
namespace IMAddons\Admin\Menu;
use \IMAddons\Helpers\Utils as Utils;

// use \IMAddons\Admin\WidgetsMap\General as General;

use \IMAddons\Admin\WidgetsMap\Basic as Basic;
use \IMAddons\Admin\WidgetsMap\Advanced as Advanced;
use \IMAddons\Admin\WidgetsMap\Form as Form;
use \IMAddons\Admin\WidgetsMap\Site as Site;
use \IMAddons\Admin\WidgetsMap\Woo as Woo;

defined( 'ABSPATH' ) || exit;

class Ajax{
    public function __construct() {
        add_action( 'wp_ajax_imaddons_admin_action', [$this, 'admin'] );
        add_action( 'init', [$this, 'admin_init'] );
    }
    public function admin() {
        if(!current_user_can('edit_theme_options')){
            wp_die(esc_html__('Access denied.', 'imaddons'));
        } 
        Utils::update_option('imaddons_options', 'widget_list', $_POST['widget_list']);
        Utils::update_option('imaddons_options', 'mailchimp_api', $_POST['mailchimp_api']);
        wp_die();
    }

    public function admin_init() {
        // $default_widgets = General::default_widgets(); 
        $all_widgets = array_merge(
            Basic::default_widgets(), 
            Advanced::default_widgets(), 
            Form::default_widgets(), 
            Site::default_widgets(), 
            Woo::default_widgets()
        );
        $data = get_option('imaddons_options');
        if(isset($data) && is_array($data['widget_list'])){
            return;
        }
        Utils::update_option('imaddons_options', 'widget_list', $all_widgets);

    }
}