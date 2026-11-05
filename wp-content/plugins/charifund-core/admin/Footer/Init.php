<?php
namespace IMAddons\Admin\Footer;

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

class Init {

	public function __construct() {
		add_action( 'add_meta_boxes', [ __CLASS__, 'add_footer_action_meta' ] );
		add_action( 'save_post', [ __CLASS__, 'save_footer_action_meta' ], 1, 2 );
		add_action( 'elementor/editor/after_save', [ __CLASS__, 'save_footer_action_meta' ], 1, 2 );
    }

    public static function add_footer_action_meta() {
        add_meta_box(
            'bp_footer_action',
            'Footer Settings',
            [ __CLASS__, 'footer_action_meta' ],
            'bp_footer',
            'side',
            'default'
        );
    }

    public static function footer_action_meta() {
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'bp_footer_action_fields' );
        $meta = get_post_meta( $post->ID );
        ?>

        <label for="bp_footer_action">
        <?php esc_html_e('Active','imaddons');?> <input type="checkbox"
        name="bp_footer_action"
        id="bp_footer_action"
        value="yes"
        <?php echo ( isset ( $meta['bp_footer_action'] ) && $meta['bp_footer_action'][0] == 'yes' ) ? 'checked="checked"' : '' ; ?> />

    </label>
        <label for="bp_footer_action_show_on">
            <span id="bp_footer_action_show_on_label"><?php esc_html_e('Where to show?','imaddons');?></span>
            <select name="bp_footer_action_show_on" id="bp_footer_action_show_on">
                <option value="all"
                <?php if ( isset($meta['bp_footer_action_show_on']) &&
                    $meta['bp_footer_action_show_on'][0] == 'all'){ echo 'selected'; };
                    ?>><?php esc_html_e('Enitre Site','imaddons');?></option>
                <option value="group" <?php if ( isset($meta['bp_footer_action_show_on']) &&
                    $meta['bp_footer_action_show_on'][0] == 'group'){ echo 'selected'; };
                    ?>><?php esc_html_e('Select Group','imaddons');?></option>
                <option value="manual" <?php if ( isset($meta['bp_footer_action_show_on']) &&
                    $meta['bp_footer_action_show_on'][0] == 'manual'){ echo 'selected'; };
                    ?>><?php esc_html_e('Select Manually','imaddons');?></option>
            </select>
        </label>
        <label for="bp_footer_action_show_on_group">
            <select name="bp_footer_action_show_on_group" id="bp_footer_action_show_on_group">
                <option value="all_pages"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'all_pages'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Pages','imaddons');?></option>
                <option value="all_posts"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'all_posts'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Posts','imaddons');?></option>
                <option value="search"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'search'){ echo 'selected'; };
                    ?>><?php esc_html_e('Search Page','imaddons');?></option>
                <option value="error"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'error'){ echo 'selected'; };
                    ?>><?php esc_html_e('Error Page','imaddons');?></option>
                <option value="front"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'front'){ echo 'selected'; };
                    ?>><?php esc_html_e('Front Page','imaddons');?></option>
                <option value="archive"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'archive'){ echo 'selected'; };
                    ?>><?php esc_html_e('Archive Pages','imaddons');?></option>
                <option value="all_inner"
                <?php if ( isset($meta['bp_footer_action_show_on_group']) &&
                    $meta['bp_footer_action_show_on_group'][0] == 'all_inner'){ echo 'selected'; };
                    ?>><?php esc_html_e('All Inner Pages','imaddons');?></option>
            </select>
        </label>
        <label for="bp_footer_action_show_on_manual">
            <select name="bp_footer_action_show_on_manual" id="bp_footer_action_show_on_manual">
                <option value="">
                <?php echo esc_attr( __( 'Select page' ) ); ?></option>
                <?php
                $pages = get_pages();
                foreach ( $pages as $page ) {
                    $selected = '';
                    if($meta['bp_footer_action_show_on_manual'][0] == $page->ID){
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


    public static function save_footer_action_meta( $post_id, $post ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Checks save status - overcome autosave, etc.
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'bp_footer_action_fields' ] ) && wp_verify_nonce( $_POST[ 'bp_footer_action_fields' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        if( isset( $_POST[ 'bp_footer_action' ] ) ) {
            update_post_meta( $post_id, 'bp_footer_action', $_POST[ 'bp_footer_action' ] );
        }else{
            update_post_meta( $post_id, 'bp_footer_action', 'no' );
        }
        if( isset( $_POST[ 'bp_footer_action_show_on' ] ) ) {
            update_post_meta( $post_id, 'bp_footer_action_show_on', $_POST[ 'bp_footer_action_show_on' ] );
        }
        if( isset( $_POST[ 'bp_footer_action_show_on_group' ] ) ) {
            update_post_meta( $post_id, 'bp_footer_action_show_on_group', $_POST[ 'bp_footer_action_show_on_group' ] );
        }
        if( isset( $_POST[ 'bp_footer_action_show_on_manual' ] ) ) {
            update_post_meta( $post_id, 'bp_footer_action_show_on_manual', $_POST[ 'bp_footer_action_show_on_manual' ] );
        }
    }
}