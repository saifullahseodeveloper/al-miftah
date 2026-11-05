<?php
/**
 * Theme Core Init
 * @package charifund
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
	exit(); //exit if access directly
}

if (!class_exists('Charifund_Core_Init')) {

	class Charifund_Core_Init
	{
	   /**
        * $instance
        * @since 1.0.0
        */
		protected static $instance;

		public function __construct()
		{
			//Load plugin assets
			add_action('wp_enqueue_scripts', array($this, 'plugin_assets'));
			//Load plugin admin assets
			add_action('admin_enqueue_scripts', array($this, 'admin_assets'));
			//load plugin text domain
			add_action('init', array($this, 'load_textdomain'));
			//add custom icon to codester framework
			add_filter('csf_field_icon_add_icons', array($this, 'csf_custom_icon'));
			//load plugin dependency files
            add_action('plugin_loaded', array($this, 'load_plugin_dependency_files'));
			//load codestar
            add_action('after_setup_theme', array($this, 'load_codestar'));
		}

	   /**
        * getInstance()
        * @since 1.0.0
        */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Load Plugin Text domain
		 * @since 1.0.0
		 */
		public function load_textdomain()
		{
			load_plugin_textdomain('logistick-core', false, CHARIFUND_CORE_ROOT_PATH . '/languages');
		}

		/**
		 * Load codestar
		 * @since 1.0.0
		 */
		public function load_codestar(){
			if (!class_exists('CSF') ) {
				require_once plugin_dir_path(__FILE__) . '../lib/codestar-framework/codestar-framework.php';
			}
		}

		/**
        * init codestar
        * @since 1.0.0
        */
		public function init_codestar(){
			if (class_exists('CSF') ) {
				CSF::init();
			}
		}

		/**
		 * Load plugin dependency files()
		 * @since 1.0.0
		 */
		public function load_plugin_dependency_files()
		{
			$includes_files = array(
				array(
					'file-name' => 'theme-menu-page',
					'folder-name' => CHARIFUND_CORE_ADMIN
				),
				array(
					'file-name' => 'theme-custom-post-type',
					'folder-name' => CHARIFUND_CORE_ADMIN
				),
				array(
					'file-name' => 'theme-post-column-customize',
					'folder-name' => CHARIFUND_CORE_ADMIN
				),
				array(
					'file-name' => 'theme-charifund-core-excerpt',
					'folder-name' => CHARIFUND_CORE_INC
				),
				array(
					'file-name' => 'csf-taxonomy',
					'folder-name' => CHARIFUND_CORE_INC
				),
				array(
					'file-name' => 'theme-core-shortcodes',
					'folder-name' => CHARIFUND_CORE_INC
				),
				array(
					'file-name' => 'elementor-widget-init',
					'folder-name' => CHARIFUND_CORE_ELEMENTOR
				),
                array(
                    'file-name' => 'theme-social-share-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-about-me-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-about-us-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-post-search-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-post-tags-menu',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
				array(
					'file-name' => 'theme-recent-post-widget',
					'folder-name' => CHARIFUND_CORE_WP_WIDGETS
				),
				array(
					'file-name' => 'theme-recent-post-title-widget',
					'folder-name' => CHARIFUND_CORE_WP_WIDGETS
				),
				array(
					'file-name' => 'theme-contact-info-widget',
					'folder-name' => CHARIFUND_CORE_WP_WIDGETS
				),
                array(
                    'file-name' => 'theme-service-category-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-request-form-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-post-category-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-discover-company-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-file-download-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
                array(
                    'file-name' => 'theme-author-widget',
                    'folder-name' => CHARIFUND_CORE_WP_WIDGETS
                ),
				array(
					'file-name' => 'theme-demo-data-import',
					'folder-name' => CHARIFUND_CORE_DEMO_IMPORT
				),
			);

            if (defined('ELEMENTOR_VERSION')) {
                $includes_files[] = array(
                    'file-name' => 'theme-elementor-icon-manager',
                    'folder-name' => CHARIFUND_CORE_INC
                );
            }
			if (is_array($includes_files) && !empty($includes_files)) {
				foreach ($includes_files as $file) {
					if (file_exists($file['folder-name'] . '/' . $file['file-name'] . '.php')) {
						require_once $file['folder-name'] . '/' . $file['file-name'] . '.php';
					}
				}
			}
		}

		/**
		 * Admin assets
		 * @since 1.0.0
		 */
		public function plugin_assets()
		{
			self::load_plugin_css_files();
			self::load_plugin_js_files();
		}

		/**
		 * Load plugin css files()
		 * @since 1.0.0
		 */
		public function load_plugin_css_files()
		{
			$plugin_version = CHARIFUND_CORE_VERSION;
			$all_css_files = array(
			    array(
                    'handle' => 'slick',
                    'src' => CHARIFUND_CORE_CSS . '/slick.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
				array(
                    'handle' => 'bootstrap',
                    'src' => CHARIFUND_CORE_CSS . '/bootstrap.min.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
				array(
					'handle' => 'charifund-core-theme-style',
					'src' => CHARIFUND_CORE_CSS . '/theme-style.css',
					'deps' => array(),
					'ver' => $plugin_version,
					'media' => 'all'
				)
			);
			$all_css_files = apply_filters('charifund_core_css', $all_css_files);

			if (is_array($all_css_files) && !empty($all_css_files)) {
				foreach ($all_css_files as $css) {
					call_user_func_array('wp_enqueue_style', $css);
				}
			}
		}

		/**
		 * Load plugin js
		 * @since 1.0.0
		 */
		public function load_plugin_js_files()
		{
			// all js files  
			wp_enqueue_script( 'slick-js', CHARIFUND_CORE_JS . '/slick.min.js', array('jquery'), '5.3.2', true );
			wp_enqueue_script( 'bootstrap-js', CHARIFUND_CORE_JS . '/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true );
			wp_enqueue_script( 'bootstrap-js', CHARIFUND_CORE_JS . '/custom.js', array('jquery'), '1.0.0', true );
			
		}

		/**
		 * Admin assets
		 * @since 1.0.0
		 */
		public function admin_assets()
		{
			self::load_admin_css_files();
			self::load_admin_js_files();
		}

		/**
		 * Load plugin admin css files()
		 * @since 1.0.0
		 */
		public function load_admin_css_files()
		{
			$plugin_version = CHARIFUND_CORE_VERSION;
			$all_css_files = array(
				array(
					'handle' => 'charifund-core-admin-style',
					'src' => CHARIFUND_CORE_ADMIN_ASSETS . '/css/admin.css',
					'deps' => array(),
					'ver' => $plugin_version,
					'media' => 'all'
				),
				array(
					'handle' => 'icomoon',
					'src' => CHARIFUND_CORE_ICONS . '/icomoon.css',
					'deps' => array(),
					'ver' => $plugin_version,
					'media' => 'all'
				),
			);

			$all_css_files = apply_filters('charifund_admin_css', $all_css_files);
			if (is_array($all_css_files) && !empty($all_css_files)) {
				foreach ($all_css_files as $css) {
					call_user_func_array('wp_enqueue_style', $css);
				}
			}
		}

		/**
		 * Load plugin admin js
		 * @since 1.0.0
		 */
		public function load_admin_js_files()
		{
			wp_enqueue_script( 'exgrid-core-widget', CHARIFUND_CORE_ADMIN_ASSETS . '/js/widget.js', array('jquery'), '1.0.2', true );
		}

		/**
		 * Add Custom Icon To Codester Framework
		 * @since 1.0.0
		 */
		public function csf_custom_icon($icons)
		{
			//adding new icon
			$icons[]  = array(
				'title' => esc_html__('Icomoon Icon', 'charifund-core'),
				'icons' => array(
								
				"icon-share",
				"icon-arrow-long",
				"icon-reply",
				"icon-clock",
				"icon-quotation",
				"icon-circle-check",
				"icon-calendar",
				"icon-quotation-two",
				"icon-award",
				"icon-documents",
				"icon-review",
				"icon-support-hand",
				"icon-truck",
				"icon-ship",
				"icon-credit-card",
				"icon-pack",
				"icon-heart",
				"icon-calendar-two",
				"icon-location",
				"icon-email",
				"icon-phone",
				"icon-message",
				"icon-star",
				"icon-make-donation",
				"icon-heart-hand",
				"icon-support",
				"icon-play",
				"icon-user",
				"icon-fund",
				"icon-donation-card",
				"icon-donation",
				"icon-spread-love",
				"icon-support-heart",
				"icon-education",
				"icon-food",
				"icon-health",
				"icon-circle-arrow",
				"icon-message-two",
				"icon-user-two"

				)
			);

			$icons = array_reverse($icons);

			return $icons;
		}
	} //end class
	if (class_exists('Charifund_Core_Init')) {
		Charifund_Core_Init::getInstance();
	}
}
