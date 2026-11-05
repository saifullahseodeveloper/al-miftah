<?php
/**
 * Post Column Customize Custom Function
 * @package Charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')){
    exit(); //exit if access directly
}

if (!class_exists('Charifund_Post_Column_Customize')){
    class Charifund_Post_Column_Customize{
        //$instance variable
        private static $instance;

        public function __construct() {  
            //project category icon
            add_filter("manage_edit-project-cat_columns", array($this, "edit_project_cat_columns") );
            add_filter('manage_project-cat_custom_column', array($this, 'add_project_category_columns'), 23, 4);
            //team category icon
            add_filter("manage_edit-team-cat_columns", array($this, "edit_team_cat_columns") );
            add_filter('manage_team-cat_custom_column', array($this, 'add_team_category_columns'), 23, 4);
        }

        /**
         * get Instance
         * @since 1.0.0
         */
        public static function getInstance(){
            if (null == self::$instance){
                self::$instance = new self();
            }
            return self::$instance;
        }


        /**
         * Edit event
         * @since 1.0.0
         */
        public function edit_event_columns($columns){

            $order = ( 'asc' == $_GET['order'] ) ? 'desc' : 'asc';
            $cat_title = $columns['taxonomy-event-cat'];
            $tag_title = $columns['taxonomy-event-tag'];
            unset($columns);
            $columns['cb'] = '<input type="checkbox" />';
            $columns['title'] = esc_html__('Title','charifund-core');
            $columns['thumbnail'] = '<a href="edit.php?post_type=event&orderby=title&order='.urlencode($order).'">'.esc_html__('Thumbnail','charifund-core').'</a>';
            $columns['taxonomy-event-cat'] = '<a href="edit.php?post_type=event&orderby=taxonomy&order='.urlencode($order).'">'.$cat_title.'<span class="sorting-indicator"></span></a>';
            $columns['taxonomy-event-tag'] = '<a href="edit.php?post_type=service&orderby=taxonomy&order='.urlencode($order).'">'.$tag_title.'<span class="sorting-indicator"></span></a>';
            $columns['icon'] = esc_html__('Icon','charifund-core');
            $columns['date'] = esc_html__('Date','charifund-core');
            return $columns;
        }

        /**
         * Add event thumbnail
         * @since 1.0.0
         */
        public function add_event_thumbnail_columns($column,$post_id) {
            switch ( $column ) {
                case 'thumbnail' :
                    echo '<a class="row-thumbnail" href="' . esc_url( admin_url( 'post.php?post=' . $post_id . '&amp;action=edit' ) ) . '">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</a>';
                    break;
                case 'icon' :
                    $event_meta_option = get_post_meta($post_id ,'charifund_event_options', true);
                    $event_icon = $event_meta_option['event_icon'];
                    printf('<i class="neaterller-font-size50 %s"></i>',esc_attr($event_icon));
                    break;
                default:
                    break;
            }
        }

        /**
         * Event category column customize
         * @since 1.0.0
         */
        public function edit_event_cat_columns($columns){
            $columns['icon'] = esc_html__('Icon','charifund-core');
            return $columns;
        }

        /**
         * Event Category column add
         * @since 1.0.0
         */
        public function add_event_category_columns($string,$columns,$post_id){
            $post_term_meta = get_term_meta($post_id,'charifund_event_category',true);
            $icon = isset($post_term_meta['icon']) ? $post_term_meta['icon'] : '';
            switch ( $columns ) {
                case 'icon' :
                    echo '<i class="neaterller-font-size50 '.$icon.'"></i>';
                    break;
                default:
                    break;
            }
        }

        /**
         * Edit project
         * @since 1.0.0
         */
        public function edit_project_columns($columns){

            $order = ( 'asc' == $_GET['order'] ) ? 'desc' : 'asc';
            $cat_title = $columns['taxonomy-project-cat'];
            $tag_title = $columns['taxonomy-project-tag'];
            unset($columns);
            $columns['cb'] = '<input type="checkbox" />';
            $columns['title'] = esc_html__('Title','charifund-core');
            $columns['thumbnail'] = '<a href="edit.php?post_type=project&orderby=title&order='.urlencode($order).'">'.esc_html__('Thumbnail','charifund-core').'</a>';
            $columns['taxonomy-project-cat'] = '<a href="edit.php?post_type=project&orderby=taxonomy&order='.urlencode($order).'">'.$cat_title.'<span class="sorting-indicator"></span></a>';
            $columns['taxonomy-project-tag'] = '<a href="edit.php?post_type=service&orderby=taxonomy&order='.urlencode($order).'">'.$tag_title.'<span class="sorting-indicator"></span></a>';
            $columns['icon'] = esc_html__('Icon','charifund-core');
            $columns['date'] = esc_html__('Date','charifund-core');
            return $columns;
        }    

        /**
         * Project category column customize
         * @since 1.0.0
         */
        public function edit_project_cat_columns($columns){
            $columns['icon'] = esc_html__('Icon','charifund-core');
            return $columns;
        }

        /**
         * Project Category column add
         * @since 1.0.0
         */
        public function add_project_category_columns($string,$columns,$post_id){
            $post_term_meta = get_term_meta($post_id,'charifund_project_category',true);
            $icon = isset($post_term_meta['icon']) ? $post_term_meta['icon'] : '';
            switch ( $columns ) {
                case 'icon' :
                    echo '<i class="neaterller-font-size50 '.$icon.'"></i>';
                    break;
                default:
                    break;
            }
        }

        /**
         * Edit team
         * @since 1.0.0
         */
        public function edit_team_columns($columns){

            $order = ( 'asc' == $_GET['order'] ) ? 'desc' : 'asc';
            $cat_title = $columns['taxonomy-team-cat'];
            $tag_title = $columns['taxonomy-team-tag'];
            unset($columns);
            $columns['cb'] = '<input type="checkbox" />';
            $columns['title'] = esc_html__('Title','charifund-core');
            $columns['thumbnail'] = '<a href="edit.php?post_type=team&orderby=title&order='.urlencode($order).'">'.esc_html__('Thumbnail','charifund-core').'</a>';
            $columns['taxonomy-team-cat'] = '<a href="edit.php?post_type=team&orderby=taxonomy&order='.urlencode($order).'">'.$cat_title.'<span class="sorting-indicator"></span></a>';
            $columns['taxonomy-team-tag'] = '<a href="edit.php?post_type=service&orderby=taxonomy&order='.urlencode($order).'">'.$tag_title.'<span class="sorting-indicator"></span></a>';
            $columns['date'] = esc_html__('Date','charifund-core');
            return $columns;
        }

        /**
         * Team category column customize
         * @since 1.0.0
         */
        public function edit_team_cat_columns($columns){
            $columns['icon'] = esc_html__('Icon','charifund-core');
            return $columns;
        }

        /**
         * Team Category column add
         * @since 1.0.0
         */
        public function add_team_category_columns($string,$columns,$post_id){
            $post_term_meta = get_term_meta($post_id,'charifund_team_category',true);
            $icon = isset($post_term_meta['icon']) ? $post_term_meta['icon'] : '';
            switch ( $columns ) {
                case 'icon' :
                    echo '<i class="neaterller-font-size50 '.$icon.'"></i>';
                    break;
                default:
                    break;
            }
        }

    }//end class
    if ( class_exists('Charifund_Post_Column_Customize')){
        Charifund_Post_Column_Customize::getInstance();
    }
}