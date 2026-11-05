<?php
namespace IMAddons\Admin\Menu;
 
defined( 'ABSPATH' ) || die();

class Init { 
    private static $page_slug	 = 'imaddons-dashboard';
    static $menu_slug = '';

    public function __construct() {
            
        add_action( 'admin_menu', [ __CLASS__, 'add_menu' ], 21 );
        add_action( 'admin_menu', [ __CLASS__, 'update_menu_items' ], 99 );
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
         
    }
    
    public static function enqueue_scripts( $hook ) {
        if ( self::$menu_slug !== $hook || ! current_user_can( 'manage_options' ) ) {
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
        wp_enqueue_script(
            'imaddons-dashboard-bootstrap',
            IMADDONS_ADMIN_JS_DIR_URL . '/bootstrap.min.js',
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

    }
    public static function add_menu() {
        self::$menu_slug = add_menu_page(
            __( 'IM Addons Dashboard', 'imaddons' ),
            __( 'IM Addons', 'imaddons' ),
            'manage_options',
            self::$page_slug,
            [ __CLASS__, 'render_dashboard' ],
            IMADDONS_IMG_DIR_URL .'/fav.png',
            2
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Dashboard' ),
            'Dashboard',
            'manage_options',
            self::$page_slug . '&admin_tab=dashboard',
            [ __CLASS__, 'render_dashboard' ]
        );
        // add_submenu_page(
        //     self::$page_slug,
        //     sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Header Footer' ),
        //     'Header Footer',
        //     'manage_options',
        //     home_url('/').'wp-admin/edit.php?post_type=bp_header_footer&admin_tab=header_footer'
        // );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Header' ),
            'Headers',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_header&admin_tab=header'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Footer' ),
            'Footers',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_footer&admin_tab=footer'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Nested Templates' ),
            'Nested Templates',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=imaddons_nested&admin_tab=nested'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Blocks' ),
            'Blocks',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_block&admin_tab=block'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Forms' ),
            'Forms',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_form&admin_tab=form'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Form Entries' ),
            'Form Entries',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_form_entry&admin_tab=entry'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Popups' ),
            'Popups',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_popup&admin_tab=popup'
        );
        add_submenu_page(
            self::$page_slug,
            sprintf( __( '%s - IM Addons Elementor Addons', 'imaddons' ), 'Megamenus' ),
            'Megamenus',
            'manage_options',
            home_url('/').'wp-admin/edit.php?post_type=bp_megamenu&admin_tab=megamenu'
        );


        do_action('imaddons_admin_menu',self::$page_slug);

    }
    public static function update_menu_items() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        global $submenu;
        $menu = $submenu[ self::$page_slug ];
        array_shift( $menu );
        $submenu[ self::$page_slug ] = $menu;
    }
    public static function get_tabs() {
        $tabs = [
            'dashboard' => [
                'title' => esc_html__( 'Dashboard', 'imaddons' ),
                'render' => [ __CLASS__, 'render_dashboard' ]
            ],
        ];

        return apply_filters( 'psb_dashboard_get_tabs', $tabs );
    }

    private static function load_template( $template ) { 

        $file = IMADDONS_MENU_DIR_PATH . '/view/' . $template . '.php';
        if ( is_readable( $file ) ) {
            include( $file );
        }
        
    }

    public static function render_main() {
        self::load_template( 'main' );
    }
    public static function render_home() {
        self::load_template( 'home' );
    }
    public static function render_dashboard() {
        self::load_template( 'dashboard' );
    }
    public static function render_tabs($template) {
        self::load_template( $template );
    }
}
