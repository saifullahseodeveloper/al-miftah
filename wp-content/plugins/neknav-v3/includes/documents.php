<?php
if (!defined('ABSPATH')) exit;

// AJAX: upload document
add_action('wp_ajax_nk_upload_doc', function () {
    check_ajax_referer('nk_nonce','nonce');
    if (!is_user_logged_in()) wp_send_json_error('Login required');

    $uid  = get_current_user_id();
    $type = sanitize_text_field($_POST['doc_type'] ?? '');
    $num  = sanitize_text_field($_POST['doc_number'] ?? '');

    if (!in_array($type, ['aadhaar','pan'])) wp_send_json_error('Invalid type');
    if (empty($_FILES['doc_file']['name'])) wp_send_json_error('File select karein');
    if ($_FILES['doc_file']['size'] > 5*1024*1024) wp_send_json_error('File max 5MB honi chahiye');

    $allowed = ['image/jpeg','image/png','image/jpg','application/pdf'];
    if (!in_array($_FILES['doc_file']['type'], $allowed)) wp_send_json_error('JPG, PNG ya PDF allowed hai');

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $_FILES['doc_file']['name'] = $type . '_' . $uid . '_' . time() . '.' . pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
    $att = media_handle_upload('doc_file', 0);
    if (is_wp_error($att)) wp_send_json_error('Upload failed');

    global $wpdb; $dt = $wpdb->prefix . 'nk_docs';
    // Remove old
    $wpdb->delete($dt, ['user_id'=>$uid,'doc_type'=>$type]);

    $wpdb->insert($dt, ['user_id'=>$uid,'doc_type'=>$type,'doc_number'=>$num,'file_url'=>wp_get_attachment_url($att),'status'=>'approved']);
    $wpdb->update("{$wpdb->prefix}nk_profiles", ['doc_status'=>'approved','profile_step'=>2], ['user_id'=>$uid]);

    wp_send_json_success(['msg'=>'Document upload ho gaya!']);
});
