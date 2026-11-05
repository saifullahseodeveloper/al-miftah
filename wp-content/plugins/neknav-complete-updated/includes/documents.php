<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_neknav_upload_doc', 'neknav_ajax_upload_doc');
function neknav_ajax_upload_doc() {
    check_ajax_referer('neknav_nonce', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error('Login required');

    $uid      = get_current_user_id();
    $doc_type = sanitize_text_field($_POST['doc_type'] ?? '');
    $doc_num  = sanitize_text_field($_POST['doc_number'] ?? '');

    if (!in_array($doc_type, ['pan', 'aadhaar'])) {
        wp_send_json_error('Invalid document type');
    }

    if (empty($_FILES['doc_file']['name'])) {
        wp_send_json_error('File select karein');
    }

    // Validate file size (5MB max)
    if ($_FILES['doc_file']['size'] > 5 * 1024 * 1024) {
        wp_send_json_error('File size 5MB se kam hona chahiye');
    }

    // Validate type
    $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
    if (!in_array($_FILES['doc_file']['type'], $allowed)) {
        wp_send_json_error('Sirf JPG, PNG ya PDF allowed hai');
    }

    // Upload to WordPress media
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $_FILES['doc_file']['name'] = $doc_type . '_' . $uid . '_' . time() . '.' . pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);

    $att_id = media_handle_upload('doc_file', 0);
    if (is_wp_error($att_id)) {
        wp_send_json_error('Upload failed: ' . $att_id->get_error_message());
    }

    $file_url  = wp_get_attachment_url($att_id);
    $file_path = get_attached_file($att_id);

    global $wpdb;
    $dt = $wpdb->prefix . 'neknav_documents';

    // Delete old doc of same type
    $old = $wpdb->get_row($wpdb->prepare("SELECT * FROM $dt WHERE user_id=%d AND doc_type=%s", $uid, $doc_type));
    if ($old) {
        wp_delete_attachment(attachment_url_to_postid($old->file_url), true);
        $wpdb->delete($dt, ['id' => $old->id]);
    }

    $wpdb->insert($dt, [
        'user_id'    => $uid,
        'doc_type'   => $doc_type,
        'file_path'  => $file_path,
        'file_url'   => $file_url,
        'doc_number' => $doc_num,
        'status'     => 'approved', // Auto-approved
    ]);

    // Mark doc_verified = 1 in profile
    $wpdb->update($wpdb->prefix . 'neknav_profiles', ['doc_verified' => 1], ['user_id' => $uid]);
    neknav_update_status($uid);

    wp_send_json_success(['message' => 'Document successfully upload aur verify ho gaya!']);
}
