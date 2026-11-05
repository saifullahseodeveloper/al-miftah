<?php
/**
 * Theme Custom Post Type(CPTs)
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Custom_Post_Type')) {
    class Charifund_Custom_Post_Type
    {

        //$instance variable
        private static $instance;

        public function __construct()
        {
            //register post type
            add_action('init', array($this, 'register_custom_post_type'));
        }

        /**
         * get Instance
         * @since  2.0.0
         */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Register Custom Post Type
         * @since  2.0.0
         */
        public function register_custom_post_type()
        {
            if (!defined('ELEMENTOR_VERSION')) {
                return;
            }
            $all_post_type = array(
                [
                    'post_type' => 'service',
                    'args' => array(
                        'label' => esc_html__('Service', 'charifund-core'),
                        'description' => esc_html__('Service', 'charifund-core'),
                        'labels' => array(
                            'name' => esc_html_x('Service', 'Post Type General Name', 'charifund-core'),
                            'singular_name' => esc_html_x('Service', 'Post Type Singular Name', 'charifund-core'),
                            'menu_name' => esc_html__('Service', 'charifund-core'),
                            'all_items' => esc_html__('Services', 'charifund-core'),
                            'view_item' => esc_html__('View Service', 'charifund-core'),
                            'add_new_item' => esc_html__('Add New Service', 'charifund-core'),
                            'add_new' => esc_html__('Add New Service', 'charifund-core'),
                            'edit_item' => esc_html__('Edit Service', 'charifund-core'),
                            'update_item' => esc_html__('Update Service', 'charifund-core'),
                            'search_items' => esc_html__('Search Service', 'charifund-core'),
                            'not_found' => esc_html__('Not Found', 'charifund-core'),
                            'not_found_in_trash' => esc_html__('Not found in Trash', 'charifund-core'),
                            'featured_image' => esc_html__('Service Image', 'charifund-core'),
                            'remove_featured_image' => esc_html__('Remove Service Image', 'charifund-core'),
                            'set_featured_image' => esc_html__('Set Service Image', 'charifund-core'),
                        ),
                        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
                        'hierarchical' => false,
                        'public' => true,
                        "publicly_queryable" => true,
                        'show_ui' => true,
                        'show_in_menu' => 'charifund_theme_options',
                        "rewrite" => array('slug' => 'all-service', 'with_front' => true),
                        'can_export' => true,
                        'capability_type' => 'post',
                        "show_in_rest" => true,
                        'query_var' => true
                    )
                ],
                [
                    'post_type' => 'project',
                    'args' => array(
                        'label' => esc_html__('Project', 'charifund-core'),
                        'description' => esc_html__('Project', 'charifund-core'),
                        'labels' => array(
                            'name' => esc_html_x('Project', 'Post Type General Name', 'charifund-core'),
                            'singular_name' => esc_html_x('Project', 'Post Type Singular Name', 'charifund-core'),
                            'menu_name' => esc_html__('Project', 'charifund-core'),
                            'all_items' => esc_html__('Projects', 'charifund-core'),
                            'view_item' => esc_html__('View Project', 'charifund-core'),
                            'add_new_item' => esc_html__('Add New Project', 'charifund-core'),
                            'add_new' => esc_html__('Add New Project', 'charifund-core'),
                            'edit_item' => esc_html__('Edit Project', 'charifund-core'),
                            'update_item' => esc_html__('Update Project', 'charifund-core'),
                            'search_items' => esc_html__('Search Project', 'charifund-core'),
                            'not_found' => esc_html__('Not Found', 'charifund-core'),
                            'not_found_in_trash' => esc_html__('Not found in Trash', 'charifund-core'),
                            'featured_image' => esc_html__('Project Image', 'charifund-core'),
                            'remove_featured_image' => esc_html__('Remove Project Image', 'charifund-core'),
                            'set_featured_image' => esc_html__('Set Project Image', 'charifund-core'),
                        ),
                        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
                        'hierarchical' => false,
                        'public' => true,
                        "publicly_queryable" => true,
                        'show_ui' => true,
                        'show_in_menu' => 'charifund_theme_options',
                        "rewrite" => array('slug' => 'all-project', 'with_front' => true),
                        'can_export' => true,
                        'capability_type' => 'post',
                        "show_in_rest" => true,
                        'query_var' => true
                    )
                ],
                [
                    'post_type' => 'team',
                    'args' => array(
                        'label' => esc_html__('team', 'charifund-core'),
                        'description' => esc_html__('team', 'charifund-core'),
                        'labels' => array(
                            'name' => esc_html_x('Team', 'Post Type General Name', 'charifund-core'),
                            'singular_name' => esc_html_x('Team', 'Post Type Singular Name', 'charifund-core'),
                            'menu_name' => esc_html__('Teams', 'charifund-core'),
                            'all_items' => esc_html__('Teams', 'charifund-core'),
                            'view_item' => esc_html__('View Teams', 'charifund-core'),
                            'add_new_item' => esc_html__('Add New Team Member', 'charifund-core'),
                            'add_new' => esc_html__('Add New Team Member', 'charifund-core'),
                            'edit_item' => esc_html__('Edit Team', 'charifund-core'),
                            'update_item' => esc_html__('Update Team', 'charifund-core'),
                            'search_items' => esc_html__('Search Team', 'charifund-core'),
                            'not_found' => esc_html__('Not Found', 'charifund-core'),
                            'not_found_in_trash' => esc_html__('Not found in Trash', 'charifund-core'),
                            'featured_image' => esc_html__('Team Image', 'charifund-core'),
                            'remove_featured_image' => esc_html__('Remove Team Image', 'charifund-core'),
                            'set_featured_image' => esc_html__('Set Team Image', 'charifund-core'),
                        ),
                        'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
                        'hierarchical' => false,
                        'public' => true,
                        "publicly_queryable" => true,
                        'show_ui' => true,
                        'show_in_menu' => 'charifund_theme_options',
                        "rewrite" => array('slug' => 'all-team', 'with_front' => true),
                        'can_export' => true,
                        'capability_type' => 'post',
                        "show_in_rest" => true,
                        'query_var' => true
                    )
                ]
            );

            if (!empty($all_post_type) && is_array($all_post_type)) {

                foreach ($all_post_type as $post_type) {
                    call_user_func_array('register_post_type', $post_type);
                }
            }


            /**
             * Custom Taxonomy Register
             * @since 1.0.0
             */

            $all_custom_taxonmy = array(
                array(
                    'taxonomy' => 'service-cat',
                    'object_type' => 'service',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Service Category", 'charifund-core'),
                            "singular_name" => esc_html__("Service Category", 'charifund-core'),
                            "menu_name" => esc_html__("Service Category", 'charifund-core'),
                            "all_items" => esc_html__("All Service Category", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Service Category", 'charifund-core')
                        ),
                        "public" => true,
                        "hierarchical" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'service-cat', 'with_front' => true),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                    )
                ),
                array(
                    'taxonomy' => 'project-cat',
                    'object_type' => 'project',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Project Category", 'charifund-core'),
                            "singular_name" => esc_html__("Project Category", 'charifund-core'),
                            "menu_name" => esc_html__("Project Category", 'charifund-core'),
                            "all_items" => esc_html__("All Project Category", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Project Category", 'charifund-core')
                        ),
                        "public" => true,
                        "hierarchical" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'project-cat', 'with_front' => true),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                    )
                ),
                array(
                    'taxonomy' => 'team-cat',
                    'object_type' => 'team',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Team Category", 'charifund-core'),
                            "singular_name" => esc_html__("Team Category", 'charifund-core'),
                            "menu_name" => esc_html__("Team Category", 'charifund-core'),
                            "all_items" => esc_html__("All Team Category", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Team Category", 'charifund-core')
                        ),
                        "public" => true,
                        "hierarchical" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'team-cat', 'with_front' => true),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                    )
                )
            );

            if (is_array($all_custom_taxonmy) && !empty($all_custom_taxonmy)) {
                foreach ($all_custom_taxonmy as $taxonomy) {
                    call_user_func_array('register_taxonomy', $taxonomy);
                }
            }


            /**
             * Custom Tags Register
             * @since 1.0.0
             */

            $all_custom_tags = array(
                array(
                    'taxonomy' => 'service-tag',
                    'object_type' => 'service',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Service Tag", 'charifund-core'),
                            "singular_name" => esc_html__("Service Tag", 'charifund-core'),
                            "menu_name" => esc_html__("Service Tag", 'charifund-core'),
                            "all_items" => esc_html__("All Service Tag", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Service Tag", 'charifund-core')
                        ),
                        "public" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'service-tag'),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                        'hierarchical' => false,
                        'update_count_callback' => '_update_post_term_count',
                    )
                ),
                array(
                    'taxonomy' => 'project-tag',
                    'object_type' => 'project',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Project Tag", 'charifund-core'),
                            "singular_name" => esc_html__("Project Tag", 'charifund-core'),
                            "menu_name" => esc_html__("Project Tag", 'charifund-core'),
                            "all_items" => esc_html__("All Project Tag", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Project Tag", 'charifund-core')
                        ),
                        "public" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'project-tag'),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                        'hierarchical' => false,
                        'update_count_callback' => '_update_post_term_count',
                    )
                ),
                array(
                    'taxonomy' => 'team-tag',
                    'object_type' => 'team',
                    'args' => array(
                        "labels" => array(
                            "name" => esc_html__("Team Tag", 'charifund-core'),
                            "singular_name" => esc_html__("Team Tag", 'charifund-core'),
                            "menu_name" => esc_html__("Team Tag", 'charifund-core'),
                            "all_items" => esc_html__("All Team Tag", 'charifund-core'),
                            "add_new_item" => esc_html__("Add New Team Tag", 'charifund-core')
                        ),
                        "public" => true,
                        "show_ui" => true,
                        "show_in_menu" => true,
                        "show_in_nav_menus" => true,
                        "query_var" => true,
                        "rewrite" => array('slug' => 'team-tag'),
                        "show_admin_column" => true,
                        "show_in_rest" => true,
                        "show_in_quick_edit" => true,
                        'hierarchical' => false,
                        'update_count_callback' => '_update_post_term_count',
                    )
                ),
            );

            if (is_array($all_custom_tags) && !empty($all_custom_tags)) {
                foreach ($all_custom_tags as $tags) {
                    call_user_func_array('register_taxonomy', $tags);
                }
            }


            flush_rewrite_rules();
        }

    }//end class

    if (class_exists('Charifund_Custom_Post_Type')) {
        Charifund_Custom_Post_Type::getInstance();
    }
}