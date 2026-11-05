<?php
if (!defined('ABSPATH')) exit;

register_activation_hook(NK_DIR . 'neknav-v3.php', 'nk_install');

function nk_install() {
    global $wpdb; $c = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // Profiles
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}nk_profiles (
        id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id     BIGINT UNSIGNED NOT NULL UNIQUE,
        full_name   VARCHAR(120) DEFAULT '',
        mobile      VARCHAR(15)  DEFAULT '',
        address     TEXT         DEFAULT '',
        city        VARCHAR(80)  DEFAULT '',
        state       VARCHAR(80)  DEFAULT '',
        pincode     VARCHAR(10)  DEFAULT '',
        referral_code VARCHAR(20) DEFAULT '',
        referred_by BIGINT UNSIGNED DEFAULT NULL,
        mobile_verified TINYINT(1) DEFAULT 0,
        doc_status  ENUM('none','pending','approved') DEFAULT 'none',
        profile_step TINYINT(1) DEFAULT 1,
        total_donated DECIMAL(12,2) DEFAULT 0.00,
        joined_at   DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX(user_id), INDEX(referral_code), INDEX(referred_by)
    ) $c;");

    // OTP
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}nk_otp (
        id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        mobile     VARCHAR(15) NOT NULL,
        otp        VARCHAR(6)  NOT NULL,
        expires_at DATETIME    NOT NULL,
        used       TINYINT(1)  DEFAULT 0,
        created_at DATETIME    DEFAULT CURRENT_TIMESTAMP
    ) $c;");

    // Documents
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}nk_docs (
        id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id    BIGINT UNSIGNED NOT NULL,
        doc_type   ENUM('aadhaar','pan') NOT NULL,
        doc_number VARCHAR(20) DEFAULT '',
        file_url   VARCHAR(600) DEFAULT '',
        status     ENUM('pending','approved') DEFAULT 'approved',
        uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX(user_id)
    ) $c;");

    // Transactions / Donations
    dbDelta("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}nk_transactions (
        id           BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id      BIGINT UNSIGNED NOT NULL,
        txn_id       VARCHAR(80)  DEFAULT '',
        amount       DECIMAL(12,2) NOT NULL DEFAULT 0,
        method       ENUM('gpay','phonepe','upi','bank','other') DEFAULT 'other',
        upi_ref      VARCHAR(100) DEFAULT '',
        screenshot_url VARCHAR(600) DEFAULT '',
        note         TEXT         DEFAULT '',
        status       ENUM('pending','confirmed','rejected') DEFAULT 'pending',
        created_at   DATETIME     DEFAULT CURRENT_TIMESTAMP,
        confirmed_at DATETIME     DEFAULT NULL,
        INDEX(user_id), INDEX(status)
    ) $c;");

    nk_create_pages();
}

function nk_create_pages() {
    $pages = [
        'register'  => ['Register',       '[nk_register]'],
        'login'     => ['Login',          '[nk_login]'],
        'dashboard' => ['My Dashboard',   '[nk_dashboard]'],
        'donate'    => ['Donate',         '[nk_donate]'],
    ];
    foreach ($pages as $slug => $d) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(['post_title'=>$d[0],'post_name'=>$slug,'post_content'=>$d[1],'post_status'=>'publish','post_type'=>'page']);
        }
    }
}

/* ─── Helpers ─────────────────────────────────────────────────────────────── */
function nk_profile($uid) {
    global $wpdb;
    $p = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}nk_profiles WHERE user_id=%d", $uid));
    if (!$p) {
        $code = 'NK' . strtoupper(substr(md5($uid . wp_rand()), 0, 7));
        $wpdb->insert("{$wpdb->prefix}nk_profiles", ['user_id'=>$uid,'referral_code'=>$code]);
        $p = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}nk_profiles WHERE user_id=%d", $uid));
    }
    return $p;
}

function nk_completion($uid) {
    $p = nk_profile($uid);
    $steps = [
        !empty($p->full_name) && !empty($p->mobile) && !empty($p->address),
        $p->doc_status === 'approved',
    ];
    return ['pct' => (int)(array_sum($steps)/count($steps)*100), 'steps' => $steps];
}

function nk_transactions($uid, $limit = 50) {
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}nk_transactions WHERE user_id=%d ORDER BY created_at DESC LIMIT %d", $uid, $limit
    ));
}

function nk_total_donated($uid) {
    global $wpdb;
    return (float)$wpdb->get_var($wpdb->prepare(
        "SELECT COALESCE(SUM(amount),0) FROM {$wpdb->prefix}nk_transactions WHERE user_id=%d AND status='confirmed'", $uid
    ));
}
