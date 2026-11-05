<?php
namespace IMAddons\Admin\Popup;

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

class Init {

	public function __construct() {
		add_action( 'add_meta_boxes', [ __CLASS__, 'add_popup_trigger_meta' ] );
		add_action( 'add_meta_boxes', [ __CLASS__, 'add_popup_action_meta' ] );
		add_action( 'add_meta_boxes', [ __CLASS__, 'add_popup_wrapper_meta' ] );
		add_action( 'save_post', [ __CLASS__, 'save_popup_action_meta' ], 1, 2 );
		add_action( 'save_post', [ __CLASS__, 'save_popup_trigger_meta' ], 1, 2 );
		add_action( 'save_post', [ __CLASS__, 'save_popup_wrapper_meta' ], 1, 2 );
		add_action( 'elementor/editor/after_save', [ __CLASS__, 'save_popup_action_meta' ], 1, 2 );
		add_action( 'elementor/editor/after_save', [ __CLASS__, 'save_popup_trigger_meta' ], 1, 2 );
		add_action( 'elementor/editor/after_save', [ __CLASS__, 'save_popup_wrapper_meta' ], 1, 2 );
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_color_picker' ] );
    }

    public static function enqueue_color_picker( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
        wp_enqueue_script(
            'wp-color-picker-alpha',
            plugins_url( '/js/wp-color-picker-alpha.min.js',  __FILE__ ),
            array( 'wp-color-picker' ),
            '1.0.0',
            true
        );
    }

    public static function add_popup_action_meta() {
        add_meta_box(
            'bp_popup_action',
            'Popup Display Condition',
            [ __CLASS__, 'popup_action_meta' ],
            'bp_popup',
            'side',
            'default'
        );
    }

    public static function popup_action_meta() {
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'bp_popup_action_fields' );
        $meta = get_post_meta( $post->ID );
        ?>

    </label>
        <label for="bp_popup_action_show_on">
            <span id="bp_popup_action_show_on_label"><?php esc_html_e('Where to show?','imaddons');?></span>
            <select name="bp_popup_action_show_on" id="bp_popup_action_show_on">
                <option value="all"
                <?php if ( isset($meta['bp_popup_action_show_on']) &&
                    $meta['bp_popup_action_show_on'][0] == 'all'){ echo 'selected'; };
                    ?>><?php esc_html_e('Enitre Site','imaddons');?></option>
                <option value="group" <?php if ( isset($meta['bp_popup_action_show_on']) &&
                    $meta['bp_popup_action_show_on'][0] == 'group'){ echo 'selected'; };
                    ?>><?php esc_html_e('Select Group','imaddons');?></option>
                <option value="manual" <?php if ( isset($meta['bp_popup_action_show_on']) &&
                    $meta['bp_popup_action_show_on'][0] == 'manual'){ echo 'selected'; };
                    ?>><?php esc_html_e('Select Manually','imaddons');?></option>
            </select>
        </label>
        <label for="bp_popup_action_show_on_group">
            <select name="bp_popup_action_show_on_group" id="bp_popup_action_show_on_group">
                <option value="all_pages"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'all_pages'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Pages','imaddons');?></option>
                <option value="all_posts"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'all_posts'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Posts','imaddons');?></option>
                <option value="search"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'search'){ echo 'selected'; };
                    ?>><?php esc_html_e('Search Page','imaddons');?></option>
                <option value="error"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'error'){ echo 'selected'; };
                    ?>><?php esc_html_e('Error Page','imaddons');?></option>
                <option value="front"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'front'){ echo 'selected'; };
                    ?>><?php esc_html_e('Front Page','imaddons');?></option>
                <option value="archive"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'archive'){ echo 'selected'; };
                    ?>><?php esc_html_e('Archive Pages','imaddons');?></option>
                <option value="all_inner"
                <?php if ( isset($meta['bp_popup_action_show_on_group']) &&
                    $meta['bp_popup_action_show_on_group'][0] == 'all_inner'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Inner Pages','imaddons');?></option>
            </select>
        </label>
        <label for="bp_popup_action_show_on_manual">
            <select name="bp_popup_action_show_on_manual" id="bp_popup_action_show_on_manual">
                <option value="">
                <?php echo esc_attr( __( 'Select page' ) ); ?></option>
                <?php
                $pages = get_pages();
                foreach ( $pages as $page ) {
                    $selected = '';
                    if($meta['bp_popup_action_show_on_manual'][0] == $page->ID){
                        $selected = 'selected';
                    }
                    $option = '<option value="' . $page->ID . '" '.$selected.'>';
                    $option .= $page->post_title;
                    $option .= '</option>';
                    echo $option;
                }
                ?>
            </select>
        </label>
        <?php
    }


    public static function save_popup_action_meta( $post_id, $post ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Checks save status - overcome autosave, etc.
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'bp_popup_action_fields' ] ) && wp_verify_nonce( $_POST[ 'bp_popup_action_fields' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        if( isset( $_POST[ 'bp_popup_action_show_on' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_action_show_on', $_POST[ 'bp_popup_action_show_on' ] );
        }
        if( isset( $_POST[ 'bp_popup_action_show_on_group' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_action_show_on_group', $_POST[ 'bp_popup_action_show_on_group' ] );
        }
        if( isset( $_POST[ 'bp_popup_action_show_on_manual' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_action_show_on_manual', $_POST[ 'bp_popup_action_show_on_manual' ] );
        }
    }



    public static function add_popup_trigger_meta() {
        add_meta_box(
            'bp_popup_trigger',
            'Popup Triggger',
            [ __CLASS__, 'popup_trigger_meta' ],
            'bp_popup',
            'side',
            'default'
        );
    }


    public static function popup_trigger_meta() {
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'bp_popup_trigger_fields' );
        $meta = get_post_meta( $post->ID );

        ?>

        <label for="bp_popup_triger_on_load_within_sec" class="bp-control-title"> On Page Load Within (sec)</label>
        <input type="number" name="bp_popup_triger_on_load_within_sec" id="bp_popup_triger_on_load_within_sec" value="<?php echo $meta['bp_popup_triger_on_load_within_sec'][0]; ?>" />

        <?php
    }

    public static function save_popup_trigger_meta( $post_id, $post ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        // Checks save status - overcome autosave, etc.
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'bp_popup_trigger_fields' ] ) && wp_verify_nonce( $_POST[ 'bp_popup_trigger_fields' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }
        if( isset( $_POST[ 'bp_popup_triger_on_load_within_sec' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_triger_on_load_within_sec', $_POST[ 'bp_popup_triger_on_load_within_sec' ] );
        }

    }



    public static function add_popup_wrapper_meta() {
        add_meta_box(
            'bp_popup_wrapper',
            'Popup Wrapper Settings',
            [ __CLASS__, 'popup_wrapper_meta' ],
            'bp_popup',
            'side',
            'default'
        );
    }

    public static function popup_wrapper_meta() {
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'bp_popup_wrapper_fields' );
        $meta = get_post_meta( $post->ID );

        $bp_popup_wrapper_color = ( isset( $meta['bp_popup_wrapper_color'][0] ) ) ? $meta['bp_popup_wrapper_color'][0] : '#000000';
        $bp_popup_wrapper_opacity = ( isset( $meta['bp_popup_wrapper_opacity'][0] ) ) ? $meta['bp_popup_wrapper_opacity'][0] : '0.2';
        $bp_popup_wrapper_inner_width = ( isset( $meta['bp_popup_wrapper_inner_width'][0] ) ) ? $meta['bp_popup_wrapper_inner_width'][0] : '30';
        $bp_popup_wrapper_inner_position = ( isset( $meta['bp_popup_wrapper_inner_position'][0] ) ) ? $meta['bp_popup_wrapper_inner_position'][0] : 'center';
        $bp_popup_wrapper_close_bg_color = ( isset( $meta['bp_popup_wrapper_close_bg_color'][0] ) ) ? $meta['bp_popup_wrapper_close_bg_color'][0] : '#000000';
        $bp_popup_wrapper_close_color = ( isset( $meta['bp_popup_wrapper_close_color'][0] ) ) ? $meta['bp_popup_wrapper_close_color'][0] : '#ffffff';

		?>
		<script>
		jQuery(document).ready(function($){
		    $('.color_field').each(function(){
        		$(this).wpColorPicker();
    		    });
		});
		</script>
		<div class="bp-popup-wrapper-meta">
            <strong><?php esc_attr_e('Wrapper:', 'imaddons' ); ?></strong>
		    <p><?php esc_attr_e('Wrapper BG Color:', 'imaddons' ); ?></p>
		    <input class="color_field" type="text" name="bp_popup_wrapper_color" data-default-color="#000000" value="<?php esc_attr_e( $bp_popup_wrapper_color ); ?>"/>
            <p><?php esc_attr_e('Wrapper BG Opacity:', 'imaddons' ); ?></p>
            <input type="number" min="0" max="1" step="0.1" name="bp_popup_wrapper_opacity" value="<?php echo esc_attr($bp_popup_wrapper_opacity);?>"/>
            <br /><br />
            <strong><?php esc_attr_e('Inner Box:', 'imaddons' ); ?></strong>
            <p><?php esc_attr_e('Inner width:', 'imaddons' ); ?></p>
            <input type="number" min="10" max="100" step="1" name="bp_popup_wrapper_inner_width" value="<?php echo esc_attr($bp_popup_wrapper_inner_width);?>"/>

            <br><br>
            <p><?php esc_attr_e('Inner position:', 'imaddons' ); ?></p>
            <select name="bp_popup_wrapper_inner_position" id="bp_popup_wrapper_inner_position">
                <option value="center" <?php if ( $bp_popup_wrapper_inner_position == 'center'){ echo 'selected'; };
                    ?>><?php esc_html_e('Center','imaddons');?></option>
                <option value="top_left" <?php if ( $bp_popup_wrapper_inner_position == 'top_left'){ echo 'selected'; };
                    ?>><?php esc_html_e('Top Left','imaddons');?></option>
                <option value="top_right" <?php if ( $bp_popup_wrapper_inner_position == 'top_right'){ echo 'selected'; };
                    ?>><?php esc_html_e('Top Right','imaddons');?></option>
                <option value="bottom_left" <?php if ( $bp_popup_wrapper_inner_position == 'bottom_left'){ echo 'selected'; };
                    ?>><?php esc_html_e('Bottom Left','imaddons');?></option>
                <option value="bottom_right" <?php if ( $bp_popup_wrapper_inner_position == 'bottom_right'){ echo 'selected'; };
                    ?>><?php esc_html_e('Bottom Right','imaddons');?></option>
            </select>

            <br><br>
            <strong><?php esc_attr_e('Close Button:', 'imaddons' ); ?></strong>
		    <p><?php esc_attr_e('Close button BG Color:', 'imaddons' ); ?></p>
		    <input class="color_field" type="text" name="bp_popup_wrapper_close_bg_color" data-default-color="#000000" value="<?php esc_attr_e( $bp_popup_wrapper_close_bg_color ); ?>"/>
		    <br>
            <p><?php esc_attr_e('Close button Color:', 'imaddons' ); ?></p>
		    <input class="color_field" type="text" name="bp_popup_wrapper_close_color" data-default-color="#ffffff" value="<?php esc_attr_e( $bp_popup_wrapper_close_color ); ?>"/>

        </div>


        <?php
    }


    public static function save_popup_wrapper_meta( $post_id, $post ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Checks save status - overcome autosave, etc.
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'bp_popup_wrapper_fields' ] ) && wp_verify_nonce( $_POST[ 'bp_popup_wrapper_fields' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        if( isset( $_POST[ 'bp_popup_wrapper_color' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_color', $_POST[ 'bp_popup_wrapper_color' ] );
        }
        if( isset( $_POST[ 'bp_popup_wrapper_opacity' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_opacity', $_POST[ 'bp_popup_wrapper_opacity' ] );
        }
        if( isset( $_POST[ 'bp_popup_wrapper_inner_width' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_inner_width', $_POST[ 'bp_popup_wrapper_inner_width' ] );
        }
        if( isset( $_POST[ 'bp_popup_wrapper_inner_position' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_inner_position', $_POST[ 'bp_popup_wrapper_inner_position' ] );
        }
        if( isset( $_POST[ 'bp_popup_wrapper_close_bg_color' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_close_bg_color', $_POST[ 'bp_popup_wrapper_close_bg_color' ] );
        }
        if( isset( $_POST[ 'bp_popup_wrapper_close_color' ] ) ) {
            update_post_meta( $post_id, 'bp_popup_wrapper_close_color', $_POST[ 'bp_popup_wrapper_close_color' ] );
        }
        

    }




}