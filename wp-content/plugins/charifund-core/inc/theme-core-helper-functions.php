<?php
/**
 * Theme Core Helper Functions
 * @package charifund
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Core_Helper_Functions')) {

    class Charifund_Core_Helper_Functions
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
            add_filter('upload_mimes', array($this, 'theme_mime_types'));
            add_filter( 'wp_check_filetype_and_ext', array($this,'charifund_disable_real_mime_check'), 10, 4);
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
         * Displays an optional post thumbnail.
         *
         * Wraps the post thumbnail in an anchor element on index views, or a div
         * element when on single views.
         */

        function post_thumbnail()
        {
            if (post_pascharifund_required() || is_attachment() || !has_post_thumbnail()) {
                return;
            }

            if (is_singular()) :
                ?>
                <?php the_post_thumbnail('charifund_classic'); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php
                    the_post_thumbnail('charifund_classic', array(
                        'alt' => the_title_attribute(array(
                            'echo' => false,
                        )),
                    ));
                    ?>
                </a>
            <?php
            endif; // End is_singular().
        }

        /**
         * Frontend get post terms
         * @since 1.0.0
         */
        public function get_terms_names($taxonomy_name = '', $output = '', $hide_empty = false)
        {
            $return_val = [];
            $terms = get_terms(
                array(
                    'taxonomy' => $taxonomy_name,
                    'hide_empty' => $hide_empty
                )
            );
            foreach ($terms as $term) {
                if ('id' == $output) {
                    $return_val[$term->term_id] = $term->name;
                } else {
                    $return_val[$term->slug] = $term->name;
                }
            }
            return $return_val;
        }


        /**
         * Sanitize px
         * @since 1.0.0
         */
        public function sanitize_px($value)
        {
            $return_val = $value;
            if (filter_var($value, FILTER_VALIDATE_INT)) {
                $return_val = $value . 'px';
            }
            return $return_val;
        }

        /**
         * Minify CSS Lines
         * @since 1.0.0
         */
        public function minify_css_lines($css)
        {
            // some of the following functions to minimize the css-output are directly taken
            // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
            // all credits to Christian Schaefer: http://twitter.com/derSchepp
            // remove
            // nts
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
            // backup values within single or double quotes
            preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
            for ($i = 0; $i < count($hit[1]); $i++) {
                $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
            }
            // remove traling semicolon of selector's last property
            $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
            // remove any whitespace between semicolon and property-name
            $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
            // remove any whitespace surrounding property-colon
            $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
            // remove any whitespace surrounding selector-comma
            $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
            // remove any whitespace surrounding opening parenthesis
            $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
            // remove any whitespace between numbers and units
            $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
            // shorten zero-values
            $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
            // constrain multiple whitespaces
            $css = preg_replace('/\p{Zs}+/ims', ' ', $css);
            // remove newlines
            $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
            // Restore backupped values within single or double quotes
            for ($i = 0; $i < count($hit[1]); $i++) {
                $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
            }

            return $css;
        }

        /**
         * SVG Support
         * theme_fix_mime_type_svg()
         * @since 1.0.0
         */
        /**
         * charifund_disable_real_mime_check
         * charifund_disable_real_mime_check()
         * @since 1.0.0
         */
        function charifund_disable_real_mime_check( $data, $file, $filename, $mimes ) {
            $wp_filetype = wp_check_filetype( $filename, $mimes );

            $ext = $wp_filetype['ext'];
            $type = $wp_filetype['type'];
            $proper_filename = $data['proper_filename'];

            return compact( 'ext', 'type', 'proper_filename' );
        }

        /**
         * SVG Support
         * charifund_mime_types()
         * @since 1.0.0
         */
        public function theme_mime_types($mimes)
        {
            if ('1' == cs_get_switcher_option('enable_svg_upload', true)) {
                $mimes['svg'] = 'image/svg+xml';
                $mimes['svgz'] = 'image/svg+xml';
            }
            return $mimes;
        }
        /**
         * Check is cs framework activated
         * @since 1.0.0
         */
        public function is_cs_framework_active()
        {
            return (defined('CS_VERSION')) ? true : false;
        }


        /**
         * Page links
         * @since 1.0.0
         */
        public function link_pages()
        {

            $defaults = array(
                'before' => '<div class="wp-link-pages"><span>' . esc_html__('Pages:', 'charifund-core') . '</span>',
                'after' => '</div>',
                'link_before' => '',
                'link_after' => '',
                'next_or_number' => 'number',
                'separator' => ' ',
                'pagelink' => '%',
                'echo' => 1
            );
            wp_link_pages($defaults);
        }

        /**
         * Pagination
         * @since 1.0.0
         */
        public function post_pagination($nav_query = NULL)
        {
            global $wp_query;
            $allowed_html = charifund()->kses_allowed_html('all');
            $big = 12345678;
            if (NULL == $nav_query) {
                $page_format = paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'type' => 'array',
                    'prev_text' => '«',
                    'next_text' => '»',
                ));
                if (is_array($page_format)) {
                    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
                    echo '<div class="blog-pagination margin-top-60"><ul>';
                    echo '<li><span>' . esc_html($paged) . esc_html__(' of ', 'charifund-core') . esc_html($wp_query->max_num_pages) . '</span></li>';
                    foreach ($page_format as $page) {
                        echo "<li>" . wp_kses($page, $allowed_html) . "</li>";
                    }
                    print '</ul></div>';
                }
            } else {

                $page_format = paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $nav_query->max_num_pages,
                    'type' => 'array',
                    'prev_text' => '«',
                    'next_text' => '»',
                ));

                if (is_array($page_format)) {
                    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
                    echo '<div class="blog-pagination margin-top-60"><ul>';
                    echo '<li><span>' . esc_html($paged) . esc_html__(' of ', 'charifund-core') . esc_html($nav_query->max_num_pages) . '</span></li>';
                    foreach ($page_format as $page) {
                        echo "<li>" . wp_kses($page, $allowed_html) . "</li>";
                    }
                    print '</ul></div>';
                }
            }
        }

        /**
         * Prints HTML with meta information for the current post-date/time.
         */
        public function posted_on()
        {

            $time_string = sprintf('<span class="entry-date published updated">%1$s</span>', esc_attr(get_the_date()));
            $time_string = sprintf(
                $time_string,
                esc_attr(get_the_date(DATE_W3C))
            );

            $posted_on = sprintf(
            /* translators: %s: post date. */
                esc_html_x(' %s', 'post date', 'charifund-core'),
                '<a href="' . esc_url(get_permalink()) . '" rel="bookmark"><i class="fas fa-calendar-alt"></i> ' . $time_string . '</a>'
            );

            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

        }

        /**
         * Prints HTML with meta information of posted by or authors.
         */
        public function posted_by()
        {
            $byline = sprintf(
            /* translators: %s: post author. */
                esc_html_x(' %s', 'post author', 'charifund-core'),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><i class="fas fa-user"></i> ' . esc_html__('By ', 'charifund-core') . esc_html(get_the_author()) . '</a></span>'
            );

            echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

        }

        /**
         * Posted Tags
         * @since 1.0.0
         */
        public function posted_tag()
        {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'charifund-core'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<ul class="tags"><li class="title">' . esc_html__('Tags: ', 'charifund-core') . '</li><li>' . ' %1$s' . '</li></ul>', $tags_list); // WPCS: XSS OK.
            }
        }

        /**
         * The post navigation
         * @since 1.0.0
         */
        public function post_navigation()
        {
            the_post_navigation(array(
                'prev_text' => '<i class="fas fa-angle-double-left"></i>&nbsp;' . esc_html__('Prev Post', 'charifund-core'),
                'next_text' => esc_html__('Next Post', 'charifund-core') . '&nbsp;<i class="fas fa-angle-double-right"></i>',
            ));
            echo wp_kses('<div class="clearfix"></div>', charifund()->kses_allowed_html('all'));
        }

        /**
         * Check if is Home page
         */
        public static function is_home_page()
        {
            $check_home_page = true;
            if (is_home() && is_front_page()) {
                $check_home_page = true;
            } elseif (is_front_page() && !is_home()) {
                $check_home_page = true;
            } elseif (is_home() && !is_front_page()) {
                $check_home_page = false;
            }
            $return_val = $check_home_page;

            return $return_val;
        }

        /**
         * Get Terms by post Id
         * @since 1.0.0
         */
        public function get_terms_by_post_id($post_id, $taxonomy)
        {
            $all_terms = array();
            $all_term_list = get_the_terms($post_id, $taxonomy);

            foreach ($all_term_list as $term_item) {
                $term_url = get_term_link($term_item->term_id, $taxonomy);
                $all_terms[$term_url] = $term_item->name;
            }
            return $all_terms;
        }

        /**
         * Sanitize html custom function
         * @since 1.0.0
         */
        public function kses_allowed_html($allowed_tags = 'all')
        {
            $allowed_html = array(
                'div' => array('class' => array(), 'id' => array()),
                'header' => array('class' => array(), 'id' => array()),
                'h1' => array('class' => array(), 'id' => array()),
                'h2' => array('class' => array(), 'id' => array()),
                'h3' => array('class' => array(), 'id' => array()),
                'h4' => array('class' => array(), 'id' => array()),
                'h5' => array('class' => array(), 'id' => array()),
                'h6' => array('class' => array(), 'id' => array()),
                'p' => array('class' => array(), 'id' => array()),
                'span' => array('class' => array(), 'id' => array()),
                'i' => array('class' => array(), 'id' => array()),
                'mark' => array('class' => array(), 'id' => array()),
                'strong' => array('class' => array(), 'id' => array()),
                'br' => array('class' => array(), 'id' => array()),
                'b' => array('class' => array(), 'id' => array()),
                'em' => array('class' => array(), 'id' => array()),
                'del' => array('class' => array(), 'id' => array()),
                'ins' => array('class' => array(), 'id' => array()),
                'u' => array('class' => array(), 'id' => array()),
                's' => array('class' => array(), 'id' => array()),
                'nav' => array('class' => array(), 'id' => array()),
                'ul' => array('class' => array(), 'id' => array()),
                'li' => array('class' => array(), 'id' => array()),
                'form' => array('class' => array(), 'id' => array()),
                'select' => array('class' => array(), 'id' => array()),
                'option' => array('class' => array(), 'id' => array()),
                'img' => array('class' => array(), 'id' => array()),
                'a' => array('class' => array(), 'id' => array(), 'href' => array()),
            );

            if ('all' == $allowed_tags) {
                return $allowed_html;
            } else {
                if (is_array($allowed_tags) && !empty($allowed_tags)) {
                    $specific_tags = array();
                    foreach ($allowed_tags as $allowed_tag) {
                        if (array_key_exists($allowed_tag, $allowed_html)) {
                            $specific_tags[$allowed_tag] = $allowed_html[$allowed_tag];
                        }
                    }
                    return $specific_tags;
                }
            }
        }

        /**
         * Get Theme Global Informations
         * @since 1.0.0
         */
        public static function get_theme_info($type = 'name')
        {

            $theme_information = array();
            if (is_child_theme()) {
                $theme = wp_get_theme();
                $parent = $theme->get('Template');
                $theme_info = wp_get_theme($parent);
            } else {
                $theme_info = wp_get_theme();
            }
            $theme_information['THEME_NAME'] = $theme_info->get('Name');
            $theme_information['THEME_VERSION'] = $theme_info->get('Version');
            $theme_information['THEME_AUTHOR'] = $theme_info->get('Author');
            $theme_information['THEME_AUTHOR_URI'] = $theme_info->get('AuthorURI');

            switch ($type) {
                case ("name"):
                    $return_val = $theme_information['THEME_NAME'];
                    break;
                case ("version"):
                    $return_val = $theme_information['THEME_VERSION'];
                    break;
                case ("author"):
                    $return_val = $theme_information['THEME_AUTHOR'];
                    break;
                case ("author_uri"):
                    $return_val = $theme_information['THEME_AUTHOR_URI'];
                    break;
                default:
                    $return_val = $theme_information;
                    break;
            }
            return $return_val;
        }

        /**
         * Get page Id
         * @since 1.0.0
         */
        public function page_id()
        {
            global $post, $wp_query;
            $page_type_id = (isset($post->ID) && in_array($post->ID, self::get_pages_id())) ? $post->ID : false;

            if (false == $page_type_id) {
                $page_type_id = isset($wp_query->post->ID) ? $wp_query->post->ID : false;
            }
            $page_id = (isset($page_type_id)) ? $page_type_id : false;
            $page_id = is_home() ? get_option('page_for_posts') : $page_id;

            return $page_id;
        }

        /**
         * Get pages id
         * @since 1.0.0
         */
        public function get_pages_id()
        {
            $pages_id = false;
            $pages = get_pages(array(
                'post_type' => 'page',
                'post_status' => 'publish'
            ));

            if (!empty($pages) && is_array($pages)) {
                $pages_id = array();
                foreach ($pages as $page) {
                    $pages_id[] = $page->ID;
                }
            }
            return $pages_id;
        }

        /**
         * Contact form shortcode
         * @since 1.0.0
         */
        public function get_contact_form_shortcode_list_el()
        {

            $forms_list = array();
            $forms_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
            $forms = get_posts($forms_args);

            if ($forms) {
                foreach ($forms as $form) {
                    $forms_list[$form->ID] = $form->post_title;
                }
            } else {
                $forms_list[esc_html__('No contact form found', 'charifund-core')] = 0;
            }
            return $forms_list;
        }

        /**
         * Tutor rating
         * @since 1.0.0
         */
        public function tutor_rating()
        {
            ?>
            <div class="tutor-loop-rating-wrap">
                <?php
                $course_rating = tutor_utils()->get_course_rating();
                tutor_utils()->star_rating_generator($course_rating->rating_avg);
                ?>
                <span class="tutor-rating-count">
                    <?php
                    if ($course_rating->rating_avg > 0) {
                        echo apply_filters('tutor_course_rating_average', $course_rating->rating_avg);
                        echo '<i>(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ')</i>';
                    }
                    ?>
				</span>
            </div>
            <?php
        }

        /**
         * Tutor category
         * @since 1.0.0
         */
        public function tutor_category()
        {
            ?>
            <div class="tutor-course-lising-category">
                <?php

                $course_categories = get_tutor_course_categories();
                if (!empty($course_categories) && is_array($course_categories) && count($course_categories)) {
                    ?>
                    <?php
                    foreach ($course_categories as $course_category) {
                        $category_name = $course_category->name;
                        $category_link = get_term_link($course_category->term_id);
                        echo "<a href='$category_link'>$category_name </a>";
                    }
                }
                ?>
            </div>
            <?php
        }

        /**
         * Tutor price
         * @since 1.0.0
         */
        public function tutor_price()
        {
            ?>
            <div class="tutor-course-loop-price">
                <?php
                $course_id = get_the_ID();
                $default_price = apply_filters('tutor-loop-default-price', __('Free', 'tutor'));
                $price_html = '<div class="price"> ' . $default_price . '</div>';
                if (tutor_utils()->is_course_purchasable()) {

                    $product_id = tutor_utils()->get_course_product_id($course_id);
                    $product = wc_get_product($product_id);

                    if ($product) {
                        $price_html = '<div class="price"> ' . $product->get_price_html() . ' </div>';
                    }
                }
                echo $price_html;
                ?>
            </div>
            <?php
        }

        /**
         * Enroll button
         * @since 1.0.0
         */
        public function tutor_enroll_btn()
        {
            $course_id = get_the_ID();
            $enroll_btn = '<div  class="tutor-loop-cart-btn-wrap">' . apply_filters('tutor_course_restrict_new_entry', '<a href="' . get_the_permalink() . '">' . esc_html__('Get Enrolled', 'charifund-core') . '</a>') . '</div>';
            $add_to_cart = '<div class="add-to-cart">' . $enroll_btn . '</div>';
            $product_id = tutor_utils()->get_course_product_id($course_id);
            $product = wc_get_product($product_id);
            if (tutor_utils()->is_course_purchasable()) {
                $enroll_btn = tutor_course_loop_add_to_cart(false);
                if ($product) {
                    $add_to_cart = '<div>' . apply_filters('tutor_course_restrict_new_entry', $enroll_btn) . '</div>';
                }
                echo $add_to_cart;
            } else {
                printf('<div class="btn-wrap"><a class="boxed-btn blank" href="%1$s">%2$s<i class="flaticon-right-arrow-2 ml-2"></i></a></div>', get_permalink(), esc_html('Enroll Now'));
            }
        }

        /**
         * Is tutor active
         * @since 1.0.0
         */
        public function is_tutor_active()
        {
            return defined('TUTOR_VERSION');
        }

        /**
         * Is woocommerce active
         * @since 1.0.0
         */
        public function is_woocommerce_active()
        {
            return defined('WC_PLUGIN_FILE');
        }

        /**
         * Is charifund active
         * @since 1.0.0
         */
        public function is_charifund_active()
        {
            $theme_name_array = array('Charifund', 'Charifund Child');
            $current_theme = wp_get_theme();
            $current_theme_name = $current_theme->get('Name');
            return in_array($current_theme_name, $theme_name_array) ? true : false;
        }

        /**
         * Is charifund core active
         * @since 1.0.0
         */
        public function is_charifund_core_active()
        {
            return defined('CHARIFUND_CORE_SELF_PATH') ? true : false;
        }

        /**
         * View Post Count
         * @since 1.0.0
         */
        public function getPostViews($postID)
        {
            $count_key = 'post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if ($count == '') {
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
                printf(' 0 %s', esc_html__('Views', 'charifund-core'));
            }
            printf($count . ' %s ', esc_html__('Views', 'charifund-core'));
        }

        // Post views count
        public function setPostViews($postID)
        {
            $count_key = 'post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if ($count == '') {
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            } else {
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }

        /**
         * Render elementor link attributes
         * @since 1.0.0
         */
        public function render_elementor_link_attributes($link, $class = null)
        {
            $return_val = '';

            if (!empty($link['url'])) {
                $return_val .= 'href="' . esc_url($link['url']) . '"';
            }
            if (!empty($link['is_external'])) {
                $return_val .= 'target="_blank"';
            }
            if (!empty($link['nofollow'])) {
                $return_val .= 'rel="nofollow"';
            }
            if (!empty($class)) {
                if (is_array($class)) {
                    $return_val .= 'class="';
                    foreach ($class as $cl) {
                        $return_val .= $cl . ' ';
                    }
                    $return_val .= '"';
                } else {
                    $return_val .= 'class="' . esc_attr($class) . '"';
                }
            }

            return $return_val;
        }

        /**
         * Render elementor icons field value
         * @since 1.0.0
         */
        public function render_elementor_icons($settings, $attr = [])
        {
            $attr['aria-hidden'] = 'true';
            return \Charifund\Charifund_elementor_icon_manager::render_icon($settings, $attr);
        }
    } //end class

    if (class_exists('Charifund_Core_Helper_Functions')) {
        Charifund_Core_Helper_Functions::getInstance();
    }
}
