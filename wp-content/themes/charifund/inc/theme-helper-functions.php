<?php
/**
 * Theme Helper Functions
 * @package charifund
 * @since 1.0.0
 */

if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Helper_Functions')) {

    class Charifund_Helper_Functions
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
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

        function post_thumbnail($size = 'charifund_classic')
        {
            if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
                return;
            }

            if (is_singular()) :
                ?>
                <?php the_post_thumbnail($size); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php
                    the_post_thumbnail($size, array(
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
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    if ('id' == $output) {
                        if (!empty('id' == $output)) {
                           $return_val[$term->term_id] = $term->name;
                        }
                    } else {
                        $return_val[$term->slug] = $term->name;
                    }
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

        /*
         * Minify CSS Lines
         * @since 1.0.0
         */
        public function minify_css_lines($css)
        {
            // some of the following functions to minimize the css-output are directly taken
            // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
            // all credits to Christian Schaefer: http://twitter.com/derSchepp
            // remove comments
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
         * Check is cs framework activated
         * @since 1.0.0
         */
        public function is_cs_framework_active()
        {
            return defined('CS_VERSION');
        }


        /**
         * Page links
         * @since 1.0.0
         */
        public function link_pages()
        {

            $defaults = array(
                'before' => '<div class="wp-link-pages"><span>' . esc_html__('Pages:', 'charifund') . '</span>',
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
        public function post_pagination($nav_query = null)
        {
            global $wp_query;
            $allowed_html = charifund()->kses_allowed_html('all');
            $big = 12345678;
            if (null == $nav_query) {
                $page_format = paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'type' => 'array',
                    'prev_text' => '<i class="fa fa-arrow-left"></i>',
                    'next_text' => '<i class="fa fa-arrow-right"></i>',
                ));
                if (is_array($page_format)) {
                    if (is_front_page()) {
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                    } else {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    }
                    echo '<div class="blog-pagination margin-top-50"><ul>';
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
                    'prev_text' => '<i class="fa fa-arrow-left"></i>',
                    'next_text' => '<i class="fa fa-arrow-right"></i>',
                ));

                if (is_array($page_format)) {
                    if (is_front_page()) {
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                    } else {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    }
                    echo '<div class="blog-pagination margin-top-30"><ul>';
                    foreach ($page_format as $page) {
                        echo "<li>" . wp_kses($page, $allowed_html) . "</li>";
                    }
                    print '</ul></div>';
                }
            }
        }

        /**
         * Prints HTML with meta information of posted by or authors.
         */
        public function posted_by()
        {
            $byline = sprintf(
            /* translators: %s: post author. */
                esc_html_x(' %s', 'post author', 'charifund'),
                '<a class="post-by url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"> '. esc_html(get_the_author()) . '</a>');

            echo '<span class="user"> ' . $byline . '</span>'; // WPCS: XSS OK.

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
                esc_html_x(' %s', 'post date', 'charifund'),
                '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
            );

            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

        }

        /**
         * Author avatar
         * @since 1.0.0
         */
        public function author_avatar($post_id)
        {
            $post_author_id = get_post_field('post_author', $post_id);
            $user = get_userdata($post_author_id);
            $author_name = $user->display_name;
            $author_image = esc_url(get_avatar_url($user->ID));
            $author_link = esc_url(get_author_posts_url(get_the_author_meta('ID')));
            printf('<div class="post-author"><div class="author-image"><img src="%1$s" class="image-fit rounded-circle" alt="%3$s"></div><a href="%2$s"> ' . esc_html__("By", "charifund") . ' %3$s </a></div>', $author_image, $author_link, $author_name);
        }

        /**
         * Author bio
         * @since 1.0.0
         */
        public function author_biography($post_id)
        {
            $post_author_id = get_post_field('post_author', $post_id);
            $user = get_userdata($post_author_id);
            $author_desc = get_the_author_meta('description', $post_author_id);
            $author_name = $user->display_name;
            $author_image = esc_url(get_avatar_url($user->ID, ['size' => '180']));

            printf('<div class="post-author"><div class="author-image"><img src="%1$s" class="image-fit" alt="%3$s"></div><div class="author-content"><cite class="post-by">' . esc_html__('Written By', 'charifund') . '</cite><h3 class="title">%2$s</h3><p>%4$s</p></div></div>', $author_image, $author_name, $author_name, $author_desc);
        }

        /**
         * Posted Tags
         * @since 1.0.0
         */
        public function posted_tag()
        {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'charifund'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<ul class="tags"><li>' . ' %1$s' . '</li></ul>', $tags_list); // WPCS: XSS OK.
            }
        }

        /**The post navigation with image
         * @since 1.0.0
         */
        function post_navigation()
        {
            global $post;
            $next_post = get_adjacent_post(false, '', false);
            $prev_post = get_adjacent_post(false, '', true);
            ob_start();
            ?>
            <div class="single-post-navigation">

                <?php if (!empty($prev_post)): ?>
                    <div class="prev-post">
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                            <div class="title-with-link">
                                <i class="fa fa-arrow-left"></i>
                                <span class="ms-2"><?php esc_html_e('Prev Post', 'charifund') ?></span>
                                <h3><?php echo esc_html(wp_trim_words($prev_post->post_title, 4, '.')); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="single-post-navigation-center-grid pt-2">
                    <a href="<?php echo esc_url(home_url('/')) ?>"><i class="fa fa-th-large"></i></a>
                </div>

                <?php if (!empty($next_post)): ?>
                    <div class="next-post">
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                            <div class="title-with-link">
                                <span class="me-2"><?php esc_html_e('Next Post', 'charifund') ?></span>
                                <h3><?php echo esc_html(wp_trim_words($next_post->post_title, 4, '.')); ?></h3>
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            <?php
            return ob_get_clean();
        }

        public function post_navigation_with_img()
        {
            $prevPost = get_previous_post();
            $nextPost = get_next_post();
            $output = '<div class="post-navigation-area"><div class="post-navigation-inner">';
            if (!empty(get_previous_post_link())) {
                $output .= sprintf('<div class="content-area %1s">', empty(get_next_post_link()) ? 'no-line' : '');
                $output .= '<div class="content"><span class="prev-post">' . esc_html__('Previous', 'charifund') . '</span>';
                $output .= get_previous_post_link('<h4 class="title">%link<span>.</span></h4>') . '</div></div>';
            }
            if (!empty(get_next_post_link())) {
                $output .= sprintf('<div class="content-area style-01 %1s">', empty(get_previous_post_link()) ? 'no-line' : '');
                $output .= '<div class="content"><span class="next-post">' . esc_html__('Next', 'charifund') . '</span>';
                $output .= get_next_post_link('<h4 class="title">%link<span>.</span></h4>') . ' </div></div>';
            }
            $output .= '</div></div>';

            return $output;
        }


        /**
         * Get list of nav menu
         * @since 1.0.0
         */
        public function get_nav_menu_list($output = 'slug')
        {
            $return_val = [];
            $all_menu_list = wp_get_nav_menus();

            foreach ($all_menu_list as $menu) {
                if ($output == 'slug') {
                    $return_val[$menu->slug] = $menu->name;
                } else {
                    $return_val[$menu->term_id] = $menu->name;
                }
            }

            return $return_val;
        }

        
        /**
         * The related post
         *
         * @param array $post_details
         *
         * @return string
         * @since 1.0.0
         */
        public function get_related_post(array $post_details)
        {

            // check if we're in the product post type
            if (is_singular($post_details['post_type'])) {
                // fetch taxonomy terms for current product
                $productterms = get_the_terms(get_the_ID(), $post_details['taxonomy']);
                if ($productterms) {
                    $producttermnames[] = 0;
                    foreach ($productterms as $productterm) {
                        $producttermnames[] = $productterm->name;
                    }
                    // set up the query arguments
                    $args = array(
                        'post_type' => $post_details['post_type'],
                        'posts_per_page' => $post_details['posts_per_page'],
                        'post_status' => 'publish',
                        'post__not_in' => array($post_details['exclude_id']),
                        'tax_query' => array(
                            array(
                                'taxonomy' => $post_details['taxonomy'],
                                'field' => 'slug',
                                'terms' => $producttermnames,
                            ),
                        ),
                    );

                    // run the query
                    $query = new \WP_Query($args);


                    $post_categories = get_the_terms(get_the_ID(), $post_details['taxonomy']);
                    if ($query->have_posts()) : ?>
                        <!-- product post here -->
                    <?php
                    endif;
                }
            }
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
                'sup' => array('class' => array(), 'id' => array()),
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
                'img' => array('class' => array(), 'id' => array(), 'src' => array()),
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
         * Generate CSS code
         * @since 1.0.0
         */
        public function generate_css_code(array $arg, $selector)
        {
            $output = '';
            foreach ($arg as $property => $value) {
                if (!empty($value)) {
                    $output .= $property . ':' . $value . ';';
                }
            }
            $selectors = is_array($selector) ? implode(',', $selector) : $selector;

            return $selectors . '{' . $output . ';}';
        }


        /**
         * is tutor active
         * @since 1.0.0
         * */
        public function is_tutor_active()
        {
            return defined('TUTOR_VERSION');
        }

        /**
         * Is charifund active
         * @since 1.0.0
         */
        public function is_charifund_active()
        {
            $theme_name_array = array('charifund', 'Charifund Child');
            $current_theme = wp_get_theme();
            $current_theme_name = $current_theme->get('Name');

            return in_array($current_theme_name, $theme_name_array);
        }

        /**
         * is charifund core active
         * @since 1.0.0
         * */
        public function is_charifund_core_active()
        {
            return defined('CHARIFUND_CORE_SELF_PATH');
        }

        /**
         * Comment Count
         * @since 1.0.0
         */

        public function comment_count()
        {
            $comments_count = get_comments_number(get_the_ID());
            $comment_text = ($comments_count > 1) ? esc_html__('Comments', 'charifund') . ' (' . $comments_count . ')' : esc_html__('Comments', 'charifund') . ' (' . $comments_count . ')';

            printf($comment_text);
        }

    } //end class
    if (class_exists('Charifund_Helper_Functions')) {
        Charifund_Helper_Functions::getInstance();
    } 

    add_action('pre_get_posts', 'search_by_cat');
    function search_by_cat($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }
    
        if (is_search()) {
            $cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
            if ($cat > 0) {
                $query->set('cat', $cat);
            }
        }
    }
    


}
