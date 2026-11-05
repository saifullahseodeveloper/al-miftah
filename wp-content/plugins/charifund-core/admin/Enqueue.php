<?php
namespace IMAddons\Admin;

defined( 'ABSPATH' ) || die();

class Enqueue { 

    public function __construct() {

        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'admin_enqueue_scripts' ] );
         
    }
    
    public static function admin_enqueue_scripts( $hook ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        wp_enqueue_style( 
            'imaddons-framework',
            IMADDONS_CSS_DIR_URL . '/libraries.min.css', 
            null,
            '1.0'
        );
        
        wp_enqueue_style(
            'imaddons-font-awesome',
            IMADDONS_ADMIN_CSS_DIR_URL . '/font-awesome.min.css',
            null,
            '1.0'
        );
        wp_enqueue_style(
            'imaddons-admin',
            IMADDONS_ADMIN_CSS_DIR_URL . '/admin.css',
            null,
            '1.0'
        );
        wp_enqueue_style(
            'imaddons-dashboard',
            IMADDONS_ADMIN_CSS_DIR_URL . '/dashboard.css',
            null,
            '1.0'
        );

        // wp_enqueue_script(
        //     'imaddons-dashboard-bootstrap',
        //     IMADDONS_ADMIN_JS_DIR_URL . '/bootstrap.min.js',
        //     [ 'jquery' ],
        //     '1.0',
        //     true
        // );

        wp_enqueue_script(
            'imaddons-libraries',
            IMADDONS_JS_DIR_URL . '/libraries.min.js',
            [ 'jquery' ],
            '1.0',
            true
        );

        wp_enqueue_script(
            'imaddons-admin',
            IMADDONS_ADMIN_JS_DIR_URL . '/admin.js',
            [ 'jquery' ],
            '1.0',
            true
        );
        wp_enqueue_script(
            'imaddons-dashboard',
            IMADDONS_ADMIN_JS_DIR_URL . '/dashboard.js',
            [ 'jquery' ],
            '1.0',
            true
        );

    }
}
