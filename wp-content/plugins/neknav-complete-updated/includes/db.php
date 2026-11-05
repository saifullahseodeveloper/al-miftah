<?php
if (!defined('ABSPATH')) exit;

register_activation_hook(NEKNAV_DIR . 'neknav-complete.php', 'neknav_create_tables');

function neknav_create_tables() {
    global $wpdb;
    $c = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // OTP table
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}neknav_otp (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL,
        mobile VARCHAR(15) NOT NULL,
        otp VARCHAR(6) NOT NULL,
        expires_at DATETIME NOT NULL,
        verified TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id), INDEX (mobile)
    ) $c;");

    // Extended profiles
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}neknav_profiles (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL UNIQUE,
        full_name VARCHAR(100) DEFAULT '',
        mobile VARCHAR(15) DEFAULT '',
        dob DATE DEFAULT NULL,
        address TEXT DEFAULT '',
        city VARCHAR(60) DEFAULT '',
        state VARCHAR(60) DEFAULT '',
        pincode VARCHAR(10) DEFAULT '',
        bank_name VARCHAR(100) DEFAULT '',
        account_number VARCHAR(30) DEFAULT '',
        ifsc VARCHAR(15) DEFAULT '',
        account_holder VARCHAR(100) DEFAULT '',
        referral_code VARCHAR(20) DEFAULT '',
        referred_by BIGINT UNSIGNED DEFAULT NULL,
        mobile_verified TINYINT(1) DEFAULT 0,
        profile_complete TINYINT(1) DEFAULT 0,
        doc_verified TINYINT(1) DEFAULT 0,
        status ENUM('registered','mobile_verified','profile_complete','fully_verified') DEFAULT 'registered',
        joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id), INDEX (referral_code), INDEX (referred_by)
    ) $c;");

    // Documents table
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}neknav_documents (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL,
        doc_type ENUM('pan','aadhaar') NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        file_url VARCHAR(500) NOT NULL,
        doc_number VARCHAR(20) DEFAULT '',
        status ENUM('pending','approved','rejected') DEFAULT 'approved',
        uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id)
    ) $c;");

    // Create pages automatically
    neknav_create_pages();
}

function neknav_create_pages() {
    $pages = [
        'register' => ['title' => 'Register', 'content' => '[neknav_register]'],
        'login'    => ['title' => 'Login',    'content' => '[neknav_login]'],
        'profile'  => ['title' => 'My Profile','content' => '[neknav_profile]'],
        'verify-mobile' => ['title' => 'Verify Mobile', 'content' => '[neknav_verify_mobile]'],
    ];
    foreach ($pages as $slug => $data) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_content' => $data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ]);
        }
    }
}

// Helper: Get or create profile row
function neknav_get_profile($user_id) {
    global $wpdb;
    $t = $wpdb->prefix . 'neknav_profiles';
    $p = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE user_id=%d", $user_id));
    if (!$p) {
        $code = 'NK' . strtoupper(substr(md5($user_id . time()), 0, 7));
        $wpdb->insert($t, ['user_id' => $user_id, 'referral_code' => $code]);
        $p = $wpdb->get_row($wpdb->prepare("SELECT * FROM $t WHERE user_id=%d", $user_id));
    }
    return $p;
}

// Helper: Update profile status
function neknav_update_status($user_id) {
    global $wpdb;
    $t = $wpdb->prefix . 'neknav_profiles';
    $p = neknav_get_profile($user_id);
    if (!$p) return;

    $status = 'registered';
    if ($p->mobile_verified) $status = 'mobile_verified';
    if ($p->mobile_verified && $p->profile_complete) $status = 'profile_complete';
    if ($p->mobile_verified && $p->profile_complete && $p->doc_verified) $status = 'fully_verified';

    $wpdb->update($t, ['status' => $status], ['user_id' => $user_id]);
}

// Helper: Completion percentage
function neknav_completion($user_id) {
    $p = neknav_get_profile($user_id);
    if (!$p) return 0;
    $steps = [
        (bool)$p->mobile_verified,
        !empty($p->full_name) && !empty($p->dob) && !empty($p->address),
        !empty($p->bank_name) && !empty($p->account_number) && !empty($p->ifsc),
        (bool)$p->doc_verified,
    ];
    return round((array_sum($steps) / count($steps)) * 100);
}
