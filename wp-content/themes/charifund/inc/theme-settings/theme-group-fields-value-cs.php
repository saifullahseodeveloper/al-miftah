<?php
/**
 * Theme Group Field Values
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}


if (!class_exists('Charifund_Group_Fields_Value')) {

    class Charifund_Group_Fields_Value
    {


        /**
         * $instance
         * @since 1.0.0
         */
        private static $instance;

        /**
         * construct()
         * @since 1.0.0
         */
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
         * Page layout
         * @since 1.0.0
         */
        public static function page_layout($prefix)
        {

            $sidebar_status = is_active_sidebar('sidebar-1') ? true : false;
            $return_var['layout'] = 'default';
            $return_var['sidebar_enable'] = (class_exists('WooCommerce') && is_cart()) || (class_exists('WooCommerce') && is_checkout()) || (class_exists('WooCommerce') && is_account_page()) || (class_exists('WooCommerce') && is_shop()) ? false : $sidebar_status;
            $return_var['content_column_class'] = $return_var['sidebar_enable'] ? 'col-lg-8' : 'col-lg-12';
            $return_var['sidebar_column_class'] = 'col-lg-4';

            $page_id = charifund()->page_id();
            $page_layout_meta = get_post_meta($page_id, $prefix . '_page_container_options', true);

            if (!empty($page_layout_meta)) {
                $return_var['layout'] = isset($page_layout_meta['page_layout']) && $page_layout_meta['page_layout'] ? $page_layout_meta['page_layout'] : 'default';
                $return_var['sidebar_enable'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout']) ? true : false;
                $return_var['content_column_class'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout']) ? 'col-lg-8' : 'col-lg-12';
                $return_var['sidebar_column_class'] = ('left-sidebar' == $return_var['layout'] || 'right-sidebar' == $return_var['layout']) ? 'col-lg-4' : '';
                //if left-sidebar select change the order of column
                $return_var['content_column_class'] = ('left-sidebar' == $return_var['layout']) ? 'col-lg-8 order-lg-2' : $return_var['content_column_class'];
                $return_var['sidebar_column_class'] = ('left-sidebar' == $return_var['layout']) ? 'col-lg-4 order-lg-1' : $return_var['sidebar_column_class'];
            }
            return $return_var;
        }

        /**
         * Page container
         * @since 1.0.0
         */
        public static function page_container($prefix, $type)
        {

            if ('container_options' == $type) {

                $return_var['page_container'] = false;
                $return_var['page_container_class'] = 'container';
                $return_var['page_spacing_top'] = '120px';
                $return_var['page_spacing_bottom'] = '120px';
                $return_var['page_content_spacing'] = false;
                $return_var['page_content_spacing_top'] = '0px';
                $return_var['page_content_spacing_bottom'] = '0px';
                $return_var['page_content_spacing_left'] = '0px';
                $return_var['page_content_spacing_right'] = '0px';

            } elseif ('header_options' == $type) {

                $return_var['page_title'] = true;
                $return_var['page_breadcrumb'] = true;
                $return_var['page_breadcrumb_enable'] = false;
                $return_var['navbar_type'] = !empty(cs_get_option('navbar_type')) ? cs_get_option('navbar_type') : '';
                $return_var['footer_type'] = !empty(cs_get_option('footer_type')) ? cs_get_option('footer_type') : '';
            }

            $page_id = charifund()->page_id();
            $page_container_meta = get_post_meta($page_id, $prefix . '_page_container_options', true);

            if (!empty($page_container_meta)) {

                if ('container_options' == $type) {

                    $return_var['page_container'] = isset($page_container_meta['page_container']) && $page_container_meta['page_container'] ? true : false;
                    $return_var['page_container_class'] = $return_var['page_container'] ? 'container-fluid' : 'container';
                    $return_var['page_spacing_top'] = isset($page_container_meta['page_spacing_top']) && $page_container_meta['page_spacing_top'] ? $page_container_meta['page_spacing_top'] : '100px';
                    $return_var['page_spacing_bottom'] = isset($page_container_meta['page_spacing_bottom']) && $page_container_meta['page_spacing_bottom'] ? $page_container_meta['page_spacing_bottom'] : '100px';

                    $return_var['page_content_spacing'] = isset($page_container_meta['page_content_spacing']) && $page_container_meta['page_content_spacing'] ? true : false;
                    $return_var['page_content_spacing_top'] = isset($page_container_meta['page_content_spacing_top']) && $page_container_meta['page_content_spacing_top'] ? $page_container_meta['page_content_spacing_top'] : '0px';
                    $return_var['page_content_spacing_bottom'] = isset($page_container_meta['page_content_spacing_bottom']) && $page_container_meta['page_content_spacing_bottom'] ? $page_container_meta['page_content_spacing_bottom'] : '0px';
                    $return_var['page_content_spacing_left'] = isset($page_container_meta['page_content_spacing_left']) && $page_container_meta['page_content_spacing_left'] ? $page_container_meta['page_content_spacing_left'] : '0px';
                    $return_var['page_content_spacing_right'] = isset($page_container_meta['page_content_spacing_right']) && $page_container_meta['page_content_spacing_right'] ? $page_container_meta['page_content_spacing_right'] : '0px';

                } elseif ('header_options' == $type) {

                    $return_var['page_title'] = isset($page_container_meta['page_title']) && $page_container_meta['page_title'] ? true : false;
                    $return_var['page_breadcrumb'] = isset($page_container_meta['page_breadcrumb']) && $page_container_meta['page_breadcrumb'] ? true : false;
                    $return_var['page_breadcrumb_enable'] = !$return_var['page_title'] && !$return_var['page_breadcrumb'] ? true : false;
                    $return_var['navbar_type'] = isset($page_container_meta['navbar_type']) && !empty($page_container_meta['navbar_type']) ? $page_container_meta['navbar_type'] : $return_var['navbar_type'];
                    $return_var['footer_type'] = isset($page_container_meta['footer_type']) && !empty($page_container_meta['footer_type']) ? $page_container_meta['footer_type'] : $return_var['footer_type'];
                }
            }

            return $return_var;
        }

        /**
         * Page layout options
         * @since 1.0.0
         */
        public static function page_layout_options($prefix)
        {

	        $return_val = array();
	        $sidebar_status = is_active_sidebar('sidebar-1') ? true : false;
	        $default_sidebar = $sidebar_status ? 'right-sidebar' : '';
	        $return_val['layout'] = cs_get_option($prefix . '_layout') ? cs_get_option($prefix . '_layout') : $default_sidebar;
	        $return_val['sidebar_enable'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) && $sidebar_status ? true : false;
	        $return_val['content_column_class'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) && $sidebar_status ? 'col-lg-8' : 'col-lg-12';
	        $return_val['sidebar_column_class'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) && $sidebar_status ? 'col-lg-4' : 'col-lg-4';
	        $return_val['content_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-8 order-lg-2' : $return_val['content_column_class'];
	        $return_val['sidebar_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-4 order-lg-1' : $return_val['sidebar_column_class'];
	        //styling
	        $return_val['bg_color'] = cs_get_option($prefix . '_bg_color') ? cs_get_option($prefix . '_bg_color') : '#ffffff';
	        $return_val['padding_top'] = cs_get_option($prefix . '_spacing_top') ? cs_get_option($prefix . '_spacing_top') : '120px';
	        $return_val['padding_bottom'] = cs_get_option($prefix . '_spacing_bottom') ? cs_get_option($prefix . '_spacing_bottom') : '120px';


	        if ($prefix == 'product_shop' ) {
                $sidebar_status =  is_active_sidebar('product-sidebar') ? true : false;
                $return_val['sidebar_enable'] = $sidebar_status;
                if (class_exists('WooCommerce') && is_singular('product')) {
    		        $sidebar_status = false;
    		        $return_val['sidebar_enable'] = false;
    		        $return_val['content_column_class'] = 'col-lg-12';
    	        }
		        $return_val['content_column_class'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) && $sidebar_status ? 'col-lg-9' : 'col-lg-12';
		        $return_val['sidebar_column_class'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) && $sidebar_status ? 'col-lg-3' : 'col-lg-3';
		        $return_val['content_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-9 order-lg-2' : $return_val['content_column_class'];
		        $return_val['sidebar_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-3 order-lg-1' : $return_val['sidebar_column_class'];
	        }
	        return $return_val;
        }

        /**
         * Page layout options single
         * @since 1.0.0
         */
	    public static function event_single_page_layout_options($prefix){

		    $return_val = array();
		    $sidebar_status = is_active_sidebar('event-sidebar') ? true : false;
		    $default_sidebar = $sidebar_status ? 'right-sidebar' : '';
		    $return_val['layout'] = cs_get_option($prefix.'_layout') ? cs_get_option($prefix.'_layout')  : $default_sidebar;
		    $return_val['sidebar_enable'] = ( 'left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout']) ? true : false;
		    $return_val['content_column_class'] = ( 'left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout'])  ? 'col-lg-8' : 'col-lg-12';
		    $return_val['sidebar_column_class'] = ('left-sidebar' == $return_val['layout'] || 'right-sidebar' == $return_val['layout'])  ? 'col-lg-4' : 'col-lg-4';
		    $return_val['content_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-8 order-lg-2': $return_val['content_column_class'];
		    $return_val['sidebar_column_class'] = 'left-sidebar' == $return_val['layout'] ? 'col-lg-4 order-lg-1': $return_val['sidebar_column_class'];
		    //styling
		    $return_val['bg_color'] = cs_get_option($prefix.'_bg_color') ? cs_get_option($prefix.'_bg_color') : '#ffffff';
		    $return_val['padding_top'] = cs_get_option($prefix.'_spacing_top') ? cs_get_option($prefix.'_spacing_top') : '100px';
		    $return_val['padding_bottom'] = cs_get_option($prefix.'_spacing_bottom') ? cs_get_option($prefix.'_spacing_bottom') : '100px';

		    return $return_val;
	    }

	    public static function post_meta($prefix)
        {

            $return_val = array();
            //post options
            $_posted_by = cs_get_switcher_option($prefix . '_posted_by');
            $_posted_on = cs_get_switcher_option($prefix . '_posted_on');
            $_posted_category = cs_get_switcher_option($prefix . '_posted_category');
            $_posted_cat = cs_get_switcher_option($prefix . '_posted_cat');

            //return value
            $return_val['posted_by'] = $_posted_by;
            $return_val['posted_on'] = $_posted_on;


            if ('blog_post' == $prefix) {
                //post options
                $_readmore_btn = cs_get_switcher_option($prefix . '_readmore_btn');
                $_readmore_btn_text = cs_get_option($prefix . '_readmore_btn_text');
                $_posted_share = cs_get_switcher_option($prefix . '_posted_share');
                $_excerpt_more = cs_get_option($prefix . '_excerpt_more');
                $_excerpt_length = cs_get_option($prefix . '_excerpt_length');
                $return_val['posted_cat'] = $_posted_cat;

                //return value
                $return_val['readmore_btn'] = $_readmore_btn;
                $return_val['readmore_btn_text'] = $_readmore_btn_text;
                $return_val['posted_share'] = $_posted_share;
                $return_val['excerpt_more'] = $_excerpt_more;
                $return_val['excerpt_length'] = $_excerpt_length;

            } elseif ('blog_single_post' == $prefix) {
                //post options
                $return_val['posted_category'] = $_posted_category;
                $_posted_tag = cs_get_switcher_option($prefix . '_posted_tag');
                $_posted_share = cs_get_switcher_option($prefix . '_posted_share');
                $_post_navigation = cs_get_switcher_option($prefix . '_post_navigation');
                $_next_post_nav_btn = cs_get_switcher_option($prefix . '_next_post_nav_btn');
                $_get_related_post = cs_get_switcher_option($prefix . '_get_related_post');
                $_author_bio = cs_get_switcher_option($prefix . '_author_bio');

                //return value
                $return_val['posted_tag'] = $_posted_tag;
                $return_val['posted_share'] = $_posted_share;
                $return_val['post_navigation'] = $_post_navigation;
                $return_val['next_post_nav_btn'] = $_next_post_nav_btn;
                $return_val['get_related_post'] = $_get_related_post;
                $return_val['author_bio'] = $_author_bio;
            }

            return $return_val;
        }

        /**
         * 404 Page Options
         * @since 1.0.0
         */
        public static function get_404_options_value()
        {
            $return_val = array();

            $return_val['title'] = cs_get_option('404_title') ? cs_get_option('404_title') : esc_html__('Whoops! This Page got Lost 
            in conversion', 'charifund');;
            $return_val['subtitle'] = cs_get_option('404_subtitle') ? cs_get_option('404_subtitle') : esc_html__('Oops! That page can&rsquo;t be found.', 'charifund');;
            $return_val['paragraph'] = cs_get_option('404_paragraph') ? cs_get_option('404_paragraph') : esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'charifund');
            $return_val['btn_text'] = cs_get_option('404_button_text') ? cs_get_option('404_button_text') : esc_html__('Back To Home', 'charifund');

            return $return_val;
        }

    }//end class

}//end if
