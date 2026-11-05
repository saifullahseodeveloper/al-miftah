<?php
/**
 * Theme Init Functions
 * @package charifund
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Init')) {

    class Charifund_Init
    {
       /**
        * $instance
        * @since 1.0.0
        */
        protected static $instance;

        public function __construct()
        {
            /*
             * theme setup
             */
            add_action('after_setup_theme', array($this, 'theme_setup'));
            /**
             * Widget Init
             */
            add_action('widgets_init', array($this, 'theme_widgets_init'));
            /**
             * Theme Assets
             */
            add_action('wp_enqueue_scripts', array($this, 'theme_assets'));
            /**
             * Registers an editor stylesheet for the theme.
             */
            add_action('admin_init', array($this, 'add_editor_styles'));
        }

        /**
         * getInstance()
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Theme Setup
         * @since 1.0.0
         */
        public function theme_setup()
        {
            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             */
            load_theme_textdomain('charifund', get_template_directory() . '/languages');

            // Add default posts and comments RSS feed links to head.
            add_theme_support('automatic-feed-links');

            /*
             * Let WordPress manage the document title.
             */
            add_theme_support('title-tag');

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
            add_theme_support('post-thumbnails');

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus(array(
                'main-menu' => esc_html__('Primary Menu', 'charifund'),
                'main-menu-2' => esc_html__('Primary Menu Two', 'charifund'),
                'category-menu' => esc_html__('Category Menu', 'charifund'),
                'footer-menu' => esc_html__('Footer Menu', 'charifund'),
            ));

            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support('html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ));

            // Add theme support for selective wp block styles
            add_theme_support("wp-block-styles");
            // Add theme support for selective align wide
            add_theme_support("align-wide");
            // Add theme support for selective responsive embeds
            add_theme_support("responsive-embeds");

            // Add theme support for selective refresh for widgets.
            add_theme_support('customize-selective-refresh-widgets');
            add_theme_support('woocommerce');

            /**
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */
            add_theme_support('custom-logo', array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            ));

 


            //add theme support for post format
            add_theme_support('post-formats', array('image', 'video', 'gallery', 'link', 'quote'));

            // This variable is intended to be overruled from themes.
            $GLOBALS['content_width'] = apply_filters('charifund_content_width', 740);

            //add image sizes
            add_image_size('charifund_classic', 750, 400, true);
            add_image_size('charifund_grid', 370, 270, true);
            add_image_size('charifund_medium', 550, 380, true);
            add_image_size('charifund-team-slider-one', 450, 460, true);
            add_image_size('charifund-team-classic', 550, 530, true);


            self::load_theme_dependency_files();
        }

        /**
         * Theme Widget Init
         * @since 1.0.0
         * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
         */
        public function theme_widgets_init()
        {
            register_sidebar(array(
                'name' => esc_html__('Sidebar', 'charifund'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'charifund'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-headline style-01">',
                'after_title' => '</h4>',
            ));
            register_sidebar(array(
                'name'          => esc_html__('Footer Menu Widget', 'charifund'),
                'id'            => 'footer-widget',
                'description'   => esc_html__('Add widgets here.', 'charifund'),
                'before_widget' => '<div id="%1$s" class="footer-two__widget %2$s"><div class="footer-two__widget-intro"><div class="widget-content">',
                'after_widget'  => '</div></div></div>',
                'before_title'  => '<h5>',
                'after_title'   => '</h5><div class="line"><span class="large-line"></span><span class="small-line"></span><span class="small-line"></span></div>',
            ));            
            register_sidebar(array(
                'name'          => esc_html__('Footer Menu Widget Two', 'charifund'),
                'id'            => 'footer-widget-two',
                'description'   => esc_html__('Add widgets here.', 'charifund'),
                'before_widget' => '<div id="%1$s" class="footer-two__widget footer-two__widget--alternate %2$s"><div class="footer-two__widget-intro"><div class="widget-content">',
                'after_widget'  => '</div></div></div>',
                'before_title'  => '<h5>',
                'after_title'   => '</h5><div class="line"><span class="large-line"></span><span class="small-line"></span><span class="small-line"></span></div>',
            ));
            
        }

        /**
         * Theme Assets
         * @since 1.0.0
         */
        public function theme_assets()
        {
            self::load_theme_css();
            self::load_theme_js();
        }

      /*
       * Load theme options google fonts css
       * @since 1.0.0
       */

       public static function load_google_fonts() {
        $enqueue_fonts = array();
    
        // Fonts configuration
        $fonts = array(
            '_body_font' => 'body_font_variant',
            'heading_font' => 'heading_font_variant',
            'custom_font' => array(400, 500, 600),
        );
    
        foreach ($fonts as $font_id => $variant_id) {
            $font = cs_get_option($font_id) ?: [];
            $font_variants = is_array($variant_id) ? $variant_id : (cs_get_option($variant_id) ?: array(400, 500, 600, 700));
    
            $font_family = isset($font['font-family']) && !empty($font['font-family']) ? $font['font-family'] : 'Arial';
            $font_type = isset($font['type']) && !empty($font['type']) ? $font['type'] : 'google';
    
            if (!empty($font_variants)) {
                foreach ($font_variants as $variant) {
                    $enqueue_fonts[] = $font_family . ':' . $variant;
                }
            }
        }
    
        // Remove duplicates and return
        return array_unique($enqueue_fonts);
    }
    

        /**
         * Load Theme Css
         * @since 1.0.0
         */
        public function load_theme_css()
        {
            $theme_version = CHARIFUND_DEV ? time() : charifund()->get_theme_info('version');
            $css_ext = '.css';
            // load google fonts
            $enqueue_google_fonts = self::load_google_fonts();
            if (!empty($enqueue_google_fonts)) {
                wp_enqueue_style('charifund-google-fonts', esc_url(add_query_arg('family', urlencode(implode('|', $enqueue_google_fonts)), '//fonts.googleapis.com/css')), array(), null);
            }
            $all_css_files = array(
                array(
                    'handle' => 'bootstrap',
                    'src' => CHARIFUND_CSS . '/bootstrap.min.css',
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),
                array(
                    'handle' => 'font-awesome-1',
                    'src' => CHARIFUND_CSS . '/all.min.css',
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),
                // array(
                //     'handle' => 'aos',
                //     'src' => CHARIFUND_CSS . '/aos.css',
                //     'deps' => array(),
                //     'ver' => $theme_version,
                //     'media' => 'all',
                // ),
                array(
                    'handle' => 'charifund',
                    'src' => CHARIFUND_CSS . '/charifund' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'flag-icons',
                    'src' => CHARIFUND_CSS . '/flag-icons.min' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'magnific-popup',
                    'src' => CHARIFUND_CSS . '/magnific-popup' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                   
                array(
                    'handle' => 'nice-select',
                    'src' => CHARIFUND_CSS . '/nice-select' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'odometer',
                    'src' => CHARIFUND_CSS . '/odometer' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'swiper-bundle',
                    'src' => CHARIFUND_CSS . '/swiper-bundle.min' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'blue-theme',
                    'src' => CHARIFUND_CSS . '/blue-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'brown-theme',
                    'src' => CHARIFUND_CSS . '/brown-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                            
                array(
                    'handle' => 'green-theme',
                    'src' => CHARIFUND_CSS . '/green-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'orange-theme',
                    'src' => CHARIFUND_CSS . '/orange-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'purple-theme',
                    'src' => CHARIFUND_CSS . '/purple-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'teal-theme',
                    'src' => CHARIFUND_CSS . '/teal-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'yellow-theme',
                    'src' => CHARIFUND_CSS . '/yellow-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ), 
                array(
                    'handle' => 'default-theme',
                    'src' => CHARIFUND_CSS . '/default-theme' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'dark-mode',
                    'src' => CHARIFUND_CSS . '/dark-mode' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'box-layout',
                    'src' => CHARIFUND_CSS . '/box-layout' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'sticky-header',
                    'src' => CHARIFUND_CSS . '/sticky-header' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'rtl',
                    'src' => CHARIFUND_CSS . '/rtl' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),                  
                array(
                    'handle' => 'charifund-main-style',
                    'src' => CHARIFUND_CSS . '/main' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),  
                array(
                    'handle' => 'responsive',
                    'src' => CHARIFUND_CSS . '/responsive' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ), 
                array(
                    'handle' => 'wp-fix',
                    'src' => CHARIFUND_CSS . '/wp-fix' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                ),          
            );

            if (class_exists('WooCommerce')) {
                $all_css_files[] = array(
                    'handle' => 'charifund-woocommerce-style',
                    'src' => CHARIFUND_CSS . '/woocommerce-style' . $css_ext,
                    'deps' => array(),
                    'ver' => $theme_version,
                    'media' => 'all',
                );
            }

            // Enqueue RTL CSS
            $rtl_enable = cs_get_option('rtl_enable'); 
            if ( $rtl_enable === true ) {
                wp_enqueue_style( 'charifund-rtl-style', CHARIFUND_CSS . '/rtl.css', array(), $theme_version );
            }
         
            $all_css_files = apply_filters('charifund_theme_enqueue_style', $all_css_files);

            if (is_array($all_css_files) && !empty($all_css_files)) {
                foreach ($all_css_files as $css) {
                    call_user_func_array('wp_enqueue_style', $css);
                }
            }
            wp_enqueue_style('charifund-style', get_stylesheet_uri());

            if (charifund()->is_charifund_core_active()) {
                if (file_exists(CHARIFUND_DYNAMIC_STYLESHEETS . '/theme-inline-css-style.php')) {
                    require_once CHARIFUND_DYNAMIC_STYLESHEETS . '/theme-inline-css-style.php';
                    require_once CHARIFUND_DYNAMIC_STYLESHEETS . '/theme-option-css-style.php';
                    wp_add_inline_style('charifund-style', charifund()->minify_css_lines($GLOBALS['charifund_inline_css']));
                    wp_add_inline_style('charifund-style', charifund()->minify_css_lines($GLOBALS['theme_customize_css']));
                }

            }
        }

        /**
         * Load Theme js
         * @since 1.0.0
         */
        public function load_theme_js()
        {
            // all js files
            wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true );
            wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true );
            wp_enqueue_script( 'swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '8.3.2', true );
            wp_enqueue_script( 'viewport', get_template_directory_uri() . '/assets/js/viewport.jquery.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'odometer', get_template_directory_uri() . '/assets/js/odometer.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'vanilla-tilt', get_template_directory_uri() . '/assets/js/vanilla-tilt.min.js', array('jquery'), '1.0.0', true );
            // wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'SplitText', get_template_directory_uri() . '/assets/js/SplitText.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'ScrollToPlugin', get_template_directory_uri() . '/assets/js/ScrollToPlugin.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'ScrollTrigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'template-settings', get_template_directory_uri() . '/assets/js/template-settings.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'template-settings', get_template_directory_uri() . '/assets/js/template-settings.js', array('jquery'), '1.0.0', true );
            wp_enqueue_script( 'charifund-main-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), time(), true );
         

            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
            
        }

        /**
         * Load THeme Dependency Files
         * @since 1.0.0
         */
        public function load_theme_dependency_files()
        {
            $includes_files = array(
                array(
                    'file-name' => 'activation',
                    'file-path' => CHARIFUND_TGMA
                ),
                array(
                    'file-name' => 'theme-breadcrumb',
                    'file-path' => CHARIFUND_INC
                ),
                array(
                    'file-name' => 'theme-excerpt',
                    'file-path' => CHARIFUND_INC
                ),
                array(
                    'file-name' => 'theme-hook-customize',
                    'file-path' => CHARIFUND_INC
                ),
                array(
                    'file-name' => 'theme-comments-modifications',
                    'file-path' => CHARIFUND_INC
                ),
                array(
                    'file-name' => 'customizer',
                    'file-path' => CHARIFUND_INC
                ),
                array(
                    'file-name' => 'theme-group-fields-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-group-fields-value-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-metabox-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-userprofile-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-shortcode-option-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-customizer-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
                array(
                    'file-name' => 'theme-option-cs',
                    'file-path' => CHARIFUND_THEME_SETTINGS
                ),
            );

            if (class_exists('WooCommerce')) {
                $includes_files[] = array(
                    'file-name' => 'theme-woocommerce-customize',
                    'file-path' => CHARIFUND_INC
                );
            }

            if (is_array($includes_files) && !empty($includes_files)) {
                foreach ($includes_files as $file) {
                    if (file_exists($file['file-path'] . '/' . $file['file-name'] . '.php')) {
                        require_once $file['file-path'] . '/' . $file['file-name'] . '.php';
                    }
                }
            }


        }

        /**
         * Add editor style
         * @since 1.0.0
         */
        public function add_editor_styles()
        {
            add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
        }

    }//end class
    if (class_exists('Charifund_Init')) {
        Charifund_Init::getInstance();
    }
}
