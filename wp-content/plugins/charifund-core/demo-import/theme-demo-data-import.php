<?php

/**
 * default page assing
 *
 * @return void
*/


/**
 * One click demo setup
 */

function import_files()
{
    return [
        [
            'import_file_name'           => 'Charifund',
            'categories'                   => 'charifund-core',
            'local_import_file'            => trailingslashit(CHARIFUND_CORE_ROOT_PATH) . 'demo-import/demo-data/content.xml',
            'local_import_customizer_file'     => trailingslashit(CHARIFUND_CORE_ROOT_PATH) . 'demo-import/demo-data/customize.dat',
            'local_import_widget_file'     => trailingslashit(CHARIFUND_CORE_ROOT_PATH) . 'demo-import/demo-data/widgets.wie',
            'local_import_json' => array(
                array(
                    'file_path'     => trailingslashit(CHARIFUND_CORE_ROOT_PATH) . 'demo-import/demo-data/theme-settings.json',
                    'option_name'   => 'charifund_theme_options',
                ),
            ),
            'import_notice' => esc_html__( 'Please Give Some Time To Import Theme Demo Data, It May Take 5-10 Minutes, It Will Download All Theme Data From Server So Be Cool!.', 'appside-master' ),
            'preview_url'   => 'https://gramentheme.com/wp/charifund'
        ],
    ];
}
add_filter('ocdi/import_files', 'import_files');

function ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );



/**
 * Adding local_import_json and import_json param supports.
 */
if (!function_exists('prefix_after_content_import_execution')) {
    function prefix_after_content_import_execution($selected_import_files, $import_files, $selected_index)
    {

        $downloader = new OCDI\Downloader();

        if (!empty($import_files[$selected_index]['import_json'])) {

            foreach ($import_files[$selected_index]['import_json'] as $index => $import) {
                $file_path = $downloader->download_file($import['file_url'], 'demo-import-file-' . $index . '-' . date('Y-m-d__H-i-s') . '.json');
                $file_raw  = OCDI\Helpers::data_from_file($file_path);
                update_option($import['option_name'], json_decode($file_raw, true));
            }
        } else if (!empty($import_files[$selected_index]['local_import_json'])) {

            foreach ($import_files[$selected_index]['local_import_json'] as $index => $import) {
                $file_path = $import['file_path'];
                $file_raw  = OCDI\Helpers::data_from_file($file_path);
                update_option($import['option_name'], json_decode($file_raw, true));
            }
        }
    }
    add_action('ocdi/after_content_import_execution', 'prefix_after_content_import_execution', 3, 99);
}
