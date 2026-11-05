<?php

/**
 * Elementor Addons Init
 * @package charifund
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly
}

if ( ! class_exists( 'Charifund_Elementor_Widget_Init' ) ) {

	class Charifund_Elementor_Widget_Init {
	   /**
		* $instance
		* @since 1.0.0
		*/
		private static $instance;

	   /**
		* construct()
		* @since 1.0.0
		*/
		public function __construct() {
			add_action( 'elementor/elements/categories_registered', array( $this, '_widget_categories' ) );
			//elementor widget registered
			add_action( 'elementor/widgets/widgets_registered', array( $this, '_widget_registered' ) );
			// elementor editor css
			add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'load_assets_for_elementor' ) );

			// for icomoon icon
			add_action( 'init', [ $this, 'i18n' ] );
			// for icomoon icon
			add_action( 'plugins_loaded', [ $this, 'init' ] );

		
		}

		public function i18n() {
			load_plugin_textdomain( 'charifund-core' );
		}

		/**
	     * getInstance()
	     * @since 1.0.0
	     */
		public static function getInstance() {
			if ( null == self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * _widget_categories()
		 * @since 1.0.0
		 */
		public function _widget_categories( $elements_manager ) {
			$elements_manager->add_category(
				'charifund_widgets',
				[
					'title' => esc_html__( 'Charifund Widgets', 'charifund-core' ),
					'icon'  => 'fas fa-plug',
				]
			);
		}

		/**
		 * _widget_registered()
		 * @since 1.0.0
		 */
		public function _widget_registered() {
			if ( ! class_exists( 'Elementor\Widget_Base' ) ) {
				return;
			}
			$elementor_widgets = array(
				'banner-slider',
				'cause-slider',
				'theme-image-box',
				'heading-title',
				'heading-title-two',
				'heading-title-three',
				'theme-icon-box',
				'theme-button',
				'theme-button-two',
				'donation-cta',
				'donation-form-two',
				'donation-form-three',
				'donation-form-four',
				'donation-form-five',
				'donation-form-six',
				'donation-form-seven',
				'team-grid',
				'team-grid-four',
				'team-grid-five',
				'team-grid-six',
				'team-grid-seven',
				'service-grid',
				'testimonials',
				'cause-tab',
				'progress-bar',
				'blog-post',
				'blog-post-three',
				'blog-post-four',
				'blog-post-five',
				'blog-post-six',
				'about-help',
				'photo-gallery',
				'theme-accordion',
				'theme-accordion-two',
				'fund-card',
				'donation-video',
				'process',
				'counter-box',
				'contact-form',
				'contact-form-two',
				'donation-list',
				'donation-list-two',
				'donation-slider',
				'donation-slider-two',
				'donation-slider-three',
				'donation-slider-four',
				'donation-form',
				'donation-war',
				'event-box',
				
				//new addons
				'community-count',
				'service-tab',
				'about-image-one',
				'about-content-one',
				'icon-box',
				'icon-box-five',
				'icon-box-six',
				'icon-box-seven',
				'cta',
				'team-grid-two',
				'banner-two',
				'icon-box-two',
				'gallery-section',
				'icon-box-three',
				'icon-box-four',
				'volunteer-two-section',
				'team-grid-three', 
				'testimonial-slider-two',
				'testimonials-three',
				'testimonial-slider-three',
				'testimonial-slider-four',
				'banner-slider-three',
				'video',
				'count-down',
				'mission',
				'mission-two',
				'marque',
				'service-slider',
				'service-slider-two',
				'service-grid-product',
				'hero-slider',
				// 'counter-box-two',

			);

			$elementor_widgets = apply_filters( 'charifund_elementor_widget', $elementor_widgets );
			ksort( $elementor_widgets );
			if ( is_array( $elementor_widgets ) && ! empty( $elementor_widgets ) ) {
				foreach ( $elementor_widgets as $widget ) {
					if ( file_exists( CHARIFUND_CORE_ELEMENTOR . '/addons/elementor-' . $widget . '-widget.php' ) ) {
						require_once CHARIFUND_CORE_ELEMENTOR . '/addons/elementor-' . $widget . '-widget.php';
					}
				}
			}
		}	

		/**
		 * load custom assets for elementor
		 * @since 1.0.0
		*/
		public function load_assets_for_elementor() {
			wp_enqueue_style( 'charifund-core-elementor-style', CHARIFUND_CORE_ADMIN_ASSETS . '/css/elementor-editor.css' );
		}

		/**
		 * load custom icons for elementor
		 * @since 1.0.0
		*/

		public function init() {
			add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		}

		public function init_widgets() {
			require_once plugin_dir_path( __FILE__ ) . '../customicon/icon.php';
		}
	}

	if ( class_exists( 'Charifund_Elementor_Widget_Init' ) ) {
		Charifund_Elementor_Widget_Init::getInstance();
	}
}//end if
