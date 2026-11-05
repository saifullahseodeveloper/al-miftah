<?php
/**
 * Theme Hooks Customize
 * @package charifund
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Customize')) {

    class Charifund_Customize
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
            //excerpt more
            add_action('excerpt_more', array($this, 'excerpt_more'));
            //search popup
            add_action('charifund_after_body', array($this, 'search_popup'));
            //breadcrumb
            add_action('charifund_before_page_content', array($this, 'breadcrumb'));      
            //order comment form
            add_filter('comment_form_fields', array($this, 'comment_fields_reorder'));
            // contact form 7
            add_filter('wpcf7_autop_or_not', '__return_false');
            //mouse move
            add_action('charifund_after_body', array($this, 'mouse_move'));
            // theme_preloader
            add_action('charifund_after_body', array($this, 'theme_preloader'));
             // sidebar
             add_action('charifund_after_body', array($this, 'menu_sidebar'));
             // back_to_top
             add_action('charifund_after_body', array($this, 'back_to_top'));
            
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
         * Excerpt More
         * @since 1.0.0
         */
        public function excerpt_more($more)
        {
            $more = cs_get_option('blog_post_excerpt_more');
            return $more;
        }

        /**
         * Breadcrumb
         * @since 1.0.0
         */
        public function breadcrumb()
        {
            $page_id = charifund()->page_id();
            $check_page = (!is_home() && !is_front_page() && is_singular()) || is_search() || is_author() || is_404() || is_archive() ? true : false;
            $check_home_page = charifund()->is_home_page();
            $page_header_meta = Charifund_Group_Fields_Value::page_container('charifund', 'header_options');
            $header_variant_class = isset($page_header_meta['navbar_type']) ? 'navbar-' . $page_header_meta['navbar_type'] : 'navbar-default';         
            $header_variant_class .= !empty(cs_get_option('header_two_top_bar_shortcode')) && $page_header_meta['navbar_type'] == 'style-01' ? ' header-style-02-has-topbar ' : '';
         
            $breadcrumb_shape_image = cs_get_option('breadcrumb_shape_image');
            $breadcrumb_shape_image_2 = cs_get_option('breadcrumb_shape_image_2');
            $breadcrumb_shape_image_3 = cs_get_option('breadcrumb_shape_image_3');

            $page_breadcrumb_enable = isset($page_header_meta['page_breadcrumb_enable']) && $page_header_meta['page_breadcrumb_enable'] ? $page_header_meta['page_breadcrumb_enable'] : false;
            $breadcrumb_enable = false;

            
            if (!$check_home_page && !$check_page) {
                $breadcrumb_enable = true;
            } elseif (!$page_breadcrumb_enable && $check_page) {
                $breadcrumb_enable = true;
            }
            $breadcrumb_enable = !cs_get_switcher_option('breadcrumb_enabled') ? false : $breadcrumb_enable;

            if (!$breadcrumb_enable) {
                return;
            }


            $breadcrumb_main_image = cs_get_option('breadcrumb_main_image');
            
            if (isset($breadcrumb_main_image['url']) && !empty($breadcrumb_main_image['url'])) {
                $background_image_url = esc_url($breadcrumb_main_image['url']);
            } else {
                $background_image_url = '';
            }

            $breadcrumb_subtitle = cs_get_option('breadcrumb_subtitle');

            ?>

        <section class="common-banner">
            <div class="container">
               <div class="row">
                  <div class="common-banner__content text-center">
                     <span class="sub-title">
                     <?php
                        if (!empty($breadcrumb_subtitle)) {
                            echo wp_kses_post($breadcrumb_subtitle);
                        }                                
                        ?>
                    </span>              
                        <?php
                            if (is_archive()) {
                                if (class_exists('WooCommerce') && is_shop()) {
                                    printf('<h2 class="title-animation">%1$s </h2>', str_replace("Archives: ", "", get_the_archive_title()));
                                } else {
                                    the_archive_title('<h2 class="title-animation">', '</h2>');
                                }
                            } elseif (is_404()) {
                                printf('<h2 class="title-animation">%1$s</h2>', esc_html__('Error 404', 'charifund'));
                            } elseif (is_search()) {
                                printf('<h2 class="title-animation">%1$s %2$s</h2>', esc_html__('Search Results for:', 'charifund'), get_search_query());
                            } elseif (is_singular('post')) {
                                printf('<h2 class="title-animation">%1$s </h2>', 'Blog Details');
                            } elseif (is_singular('page')) {
                                if ($page_header_meta['page_title']) {
                                    printf('<h2 class="title-animation">%1$s </h2>', get_the_title());
                                }
                            } else {
                                printf('<h2 class="title-animation">%1$s </h2>', get_the_title($page_id));
                            }
                        ?>
                  </div>
               </div>
            </div>
            <?php
            if (!empty($breadcrumb_shape_image['url'])): ?>
            <div class="banner-bg">
               <img src="<?php echo esc_url($breadcrumb_shape_image['url']); ?>" alt="Image" >
            </div>
            <?php endif; ?>
            <?php
            if (!empty($breadcrumb_shape_image_2['url'])): ?>
            <div class="shape">
               <img src="<?php echo esc_url($breadcrumb_shape_image_2['url']); ?>" alt="Image">
            </div>
            <?php endif; ?>
            <?php
            if (!empty($breadcrumb_shape_image_3['url'])): ?>
            <div class="sprade" data-aos="zoom-in" data-aos-duration="1000">
               <img src="<?php echo esc_url($breadcrumb_shape_image_3['url']); ?>" alt="Image" class="base-img">
            </div>
            <?php endif; ?>
         </section>
         

            <?php
        }

           /**
         * Mouse Move
         * @since 1.0.0
         */
        public function mouse_move()
        {
			$normal_mouse_enable = cs_get_option('normal_mouse_enable');
			if ($normal_mouse_enable == !1) { ?>
				<!--<< Mouse Cursor Start >>-->  
				<div class="mouseCursor cursor-outer"></div>
				<div class="mouseCursor cursor-inner"></div>
			<?php }
        }
        
           /**
         * Theme Preloader
         * @since 1.0.0
         */

        public function theme_preloader()
        {
            $preloader_enable = cs_get_option('preloader_enable'); 
            
            if ($preloader_enable == 1) {
                get_template_part('template-parts/preloader');
            }
        }



             /**
         * Menu Sidebar
         * @since 1.0.0
         */
       
         public function menu_sidebar()
        {            
                     
            ?>

            <!-- ==== off canvas start ==== -->
            <div class="off-canvas d-none d-xl-block" >
                <div class="off-canvas__inner">
                    <div class="off-canvas__head">
                        <?php
                         $sidebar_logo = cs_get_option('sidebar_logo');
                        if (has_custom_logo() && empty($sidebar_logo['id'])) {
                            the_custom_logo();
                        } elseif (!empty($sidebar_logo['id'])) {
                            printf('<a class="d-inline-block site-logo" href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $sidebar_logo['url'], $sidebar_logo['alt']);
                        } else {
                            printf('<a class="d-inline-block site-title" href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                        }
                        ?>
                        <button aria-label="close off canvas" class="off-canvas-close">
                        <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="offcanvas__search">
                        <form action="<?php echo esc_url(home_url('/')) ?>">
                            <input type="text" placeholder="<?php echo esc_attr__('What are you searching for?', 'charifund'); ?>" required>
                            <button type="submit">
                            <i class="icon-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="off-canvas__contact">
                        <?php
                        $sidebar_title = cs_get_option('sidebar_title');
                        if (!empty($sidebar_title)) {
                            echo '<h5>' . esc_html($sidebar_title) . '</h5>';
                        }
                        ?>

                        <?php
                        $contact_infos = cs_get_option('sidebar_contact_info_repeater');

                        if (!empty($contact_infos) && is_array($contact_infos)) {
                            foreach ($contact_infos as $contact_info) {
                                $icon = isset($contact_info['sidebar_contact_icon']) ? esc_attr($contact_info['sidebar_contact_icon']) : 'fa-solid fa-phone-volume';
                                $text = isset($contact_info['sidebar_contact_text']) ? esc_html($contact_info['sidebar_contact_text']) : '';
                                $url = isset($contact_info['sidebar_contact_text_url']) ? esc_url($contact_info['sidebar_contact_text_url']) : '#';

                                if (!empty($text)) {
                                    echo '<div class="single">';
                                    echo '<span><i class="' . $icon . '"></i></span>';
                                    echo '<a href="' . $url . '">' . $text . '</a>';
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $sidebar_socials_repeater = cs_get_option('sidebar_socials');

                    if ( ! empty( $sidebar_socials_repeater ) && is_array( $sidebar_socials_repeater ) ) {
                        echo '<div class="social">';
                        foreach ( $sidebar_socials_repeater as $item ) {
                            if ( ! empty( $item['sidebar_socials_icon'] ) && ! empty( $item['sidebar_socials_icon_url'] ) ) {
                                $icon = esc_attr( $item['sidebar_socials_icon'] );
                                // $url = esc_url( $item['sidebar_socials_icon_url'] );
                                $platform = ucwords( str_replace( '-', ' ', pathinfo( parse_url( $url, PHP_URL_PATH ), PATHINFO_FILENAME ) ) );

                                echo '<a href="" target="_blank" aria-label="Share us on ' . $platform . '" title="' . $platform . '">';
                                echo '<i class="' . $icon . '"></i>';
                                echo '</a>';
                            }
                        }
                        echo '</div>';
                    }
                    ?>

                </div>
                </div>
                <div class="off-canvas-backdrop"></div>
                <!-- ==== / off canvas end ==== -->

        <?php
        }
        

        /**
         * Reorder comments form
         * @since 1.0.0
         */
        public function comment_fields_reorder($fileds)
        {
            $comment_filed = $fileds['comment'];
            unset($fileds['comment']);
            $fileds['comment'] = $comment_filed;

            if (isset($fileds['cookies'])) {
                $comment_cookies = $fileds['cookies'];
                unset($fileds['cookies']);
                $fileds['cookies'] = $comment_cookies;
            }

            return $fileds;
        }

        /**
         * @since 1.0.0
         * Search Popup
         */
        public function search_popup()
        {
            ?>

            <div class="search-popup">
                <button class="close-search" aria-label="close search box" title="close search box">
                <i class="fa-solid fa-xmark"></i>
                </button>
                <form action="<?php echo esc_url(home_url('/')) ?>">
                <div class="search-popup__group">
                    <input type="text" name="search-field" id="searchField" placeholder="<?php echo esc_attr__('Search....', 'charifund'); ?>" required>
                    <button type="submit" aria-label="search products" title="search products">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                </form>
            </div>

            
            <?php
        }

        /**
         * @since 1.0.0
         * Back To Top
         */
        
        public function back_to_top() {
            // Retrieve the option values with fallbacks
            $back_top_enable = cs_get_option('back_top_enable') !== null ? cs_get_option('back_top_enable') : true;
            $back_top_icon = cs_get_option('back_top_icon') ?: 'fas fa-arrow-up-long';
        
            if ($back_top_enable) {
                ?>

                <button class="progress-wrap" aria-label="scroll indicator" title="back to top">
                    <span></span>
                    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                    </svg>
                </button>

                <?php
            }
        }
        


    }//end class
    if (class_exists('Charifund_Customize')) {
        Charifund_Customize::getInstance();
    }
}
