<?php
if (!defined('ABSPATH')) exit;

// ── Settings page for SMS ────────────────────────────────────────────────────
add_action('admin_menu', function () {
    add_submenu_page('neknav-admin', 'SMS Settings', '⚙ SMS Settings', 'manage_options', 'neknav-sms', 'neknav_sms_settings_page');
});

function neknav_sms_settings_page() {
    if (isset($_POST['neknav_sms_save'])) {
        check_admin_referer('neknav_sms_save');
        update_option('neknav_sms_provider', sanitize_text_field($_POST['provider']));
        update_option('neknav_sms_api_key',  sanitize_text_field($_POST['api_key']));
        update_option('neknav_sms_sender',   sanitize_text_field($_POST['sender_id']));
        update_option('neknav_sms_test_mode', isset($_POST['test_mode']) ? '1' : '0');
        echo '<div class="notice notice-success"><p>✅ Settings saved!</p></div>';
    }
    $provider  = get_option('neknav_sms_provider', 'fast2sms');
    $api_key   = get_option('neknav_sms_api_key', '');
    $sender    = get_option('neknav_sms_sender', 'NEKNAV');
    $test_mode = get_option('neknav_sms_test_mode', '1');
    ?>
    <div class="wrap" style="font-family:Georgia,serif">
        <h1>📱 SMS / OTP Settings</h1>
        <form method="post">
            <?php wp_nonce_field('neknav_sms_save'); ?>
            <table class="form-table">
                <tr><th>SMS Provider</th><td>
                    <select name="provider" style="padding:6px;width:250px">
                        <option value="fast2sms" <?php selected($provider,'fast2sms');?>>Fast2SMS (India — Recommended)</option>
                        <option value="msg91"    <?php selected($provider,'msg91');?>>MSG91</option>
                        <option value="twilio"   <?php selected($provider,'twilio');?>>Twilio</option>
                    </select>
                </td></tr>
                <tr><th>API Key</th><td>
                    <input type="text" name="api_key" value="<?php echo esc_attr($api_key);?>" style="width:350px;padding:6px">
                    <p class="description">Fast2SMS: <a href="https://www.fast2sms.com/dashboard/apikey" target="_blank">Get API Key here</a></p>
                </td></tr>
                <tr><th>Sender ID</th><td>
                    <input type="text" name="sender_id" value="<?php echo esc_attr($sender);?>" style="width:200px;padding:6px">
                </td></tr>
                <tr><th>Test Mode</th><td>
                    <input type="checkbox" name="test_mode" <?php checked($test_mode,'1');?>>
                    <label><strong>OTP screen pe dikhao (SMS mat bhejo)</strong> — Development ke liye</label>
                </td></tr>
            </table>
            <p><input type="submit" name="neknav_sms_save" class="button-primary" value="Save Settings"></p>
        </form>
        <div style="background:#f0faf4;border:1.5px solid #b7e4c7;border-radius:10px;padding:16px;margin-top:20px;max-width:500px">
            <strong>📌 Fast2SMS Setup (Free mein shuru karein):</strong><br>
            1. fast2sms.com pe register karein<br>
            2. Dashboard → API → Copy key<br>
            3. Yahan paste karein → Save<br>
            4. Test Mode OFF kar dein
        </div>
    </div>
    <?php
}

// ── Generate & Send OTP ──────────────────────────────────────────────────────
function neknav_send_otp($user_id, $mobile) {
    global $wpdb;
    $otp   = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
    $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));
    $t = $wpdb->prefix . 'neknav_otp';

    // Delete old OTPs
    $wpdb->delete($t, ['user_id' => $user_id]);

    $wpdb->insert($t, [
        'user_id'    => $user_id,
        'mobile'     => $mobile,
        'otp'        => $otp,
        'expires_at' => $expiry,
    ]);

    $test_mode = get_option('neknav_sms_test_mode', '1');

    if ($test_mode === '1') {
        // Test mode: store OTP in session to show on screen
        if (!session_id()) @session_start();
        $_SESSION['neknav_test_otp_' . $user_id] = $otp;
        return ['success' => true, 'test_otp' => $otp];
    }

    // Real SMS
    $provider = get_option('neknav_sms_provider', 'fast2sms');
    $api_key  = get_option('neknav_sms_api_key', '');
    $message  = "NekNeev: Aapka OTP hai $otp. Yeh 10 minute mein expire hoga. Kisi se share na karein. -NekNeev Charity";

    if ($provider === 'fast2sms') {
        $response = wp_remote_get("https://www.fast2sms.com/dev/bulkV2?authorization=$api_key&route=q&message=" . urlencode($message) . "&flash=0&numbers=$mobile");
        $body = json_decode(wp_remote_retrieve_body($response), true);
        return ['success' => ($body['return'] ?? false) === true];
    }

    if ($provider === 'msg91') {
        $response = wp_remote_post('https://api.msg91.com/api/v5/otp', [
            'headers' => ['authkey' => $api_key, 'Content-Type' => 'application/json'],
            'body'    => json_encode(['template_id' => get_option('neknav_msg91_template', ''), 'mobile' => '91' . $mobile, 'otp' => $otp]),
        ]);
        return ['success' => wp_remote_retrieve_response_code($response) === 200];
    }

    return ['success' => false, 'error' => 'Provider not configured'];
}

// ── Verify OTP ───────────────────────────────────────────────────────────────
function neknav_verify_otp($user_id, $otp_input) {
    global $wpdb;
    $t   = $wpdb->prefix . 'neknav_otp';
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $t WHERE user_id=%d AND otp=%s AND verified=0 AND expires_at > NOW()",
        $user_id, $otp_input
    ));
    if (!$row) return false;
    $wpdb->update($t, ['verified' => 1], ['id' => $row->id]);
    return true;
}

// ── AJAX: Send OTP ───────────────────────────────────────────────────────────
add_action('wp_ajax_neknav_send_otp', 'neknav_ajax_send_otp');
function neknav_ajax_send_otp() {
    check_ajax_referer('neknav_nonce', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error('Login required');

    $mobile = preg_replace('/\D/', '', sanitize_text_field($_POST['mobile'] ?? ''));
    if (strlen($mobile) !== 10) wp_send_json_error('Sahi mobile number daalo (10 digits)');

    $uid    = get_current_user_id();
    $result = neknav_send_otp($uid, $mobile);

    // Save mobile number to profile
    global $wpdb;
    $wpdb->update($wpdb->prefix . 'neknav_profiles', ['mobile' => $mobile], ['user_id' => $uid]);

    wp_send_json_success($result);
}

// ── AJAX: Verify OTP ─────────────────────────────────────────────────────────
add_action('wp_ajax_neknav_verify_otp', 'neknav_ajax_verify_otp');
function neknav_ajax_verify_otp() {
    check_ajax_referer('neknav_nonce', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error('Login required');

    $uid = get_current_user_id();
    $otp = sanitize_text_field($_POST['otp'] ?? '');

    if (!neknav_verify_otp($uid, $otp)) {
        wp_send_json_error('OTP galat hai ya expire ho gaya!');
    }

    global $wpdb;
    $wpdb->update($wpdb->prefix . 'neknav_profiles', ['mobile_verified' => 1], ['user_id' => $uid]);
    neknav_update_status($uid);

    wp_send_json_success(['redirect' => home_url('/profile')]);
}

// Shortcode: Mobile verification page
add_shortcode('neknav_verify_mobile', 'neknav_verify_mobile_shortcode');
function neknav_verify_mobile_shortcode() {
    if (!is_user_logged_in()) return '<p>Pehle <a href="' . home_url('/login') . '">login</a> karein.</p>';
    $p = neknav_get_profile(get_current_user_id());
    if ($p && $p->mobile_verified) {
        return '<div class="nk-box"><p>✅ Mobile pehle se verify ho chuka hai!</p><a href="' . home_url('/profile') . '" class="nk-btn">Profile Dekhein</a></div>';
    }
    ob_start(); ?>
    <div class="nk-box nk-verify-box">
        <h2>📱 Mobile Number Verify Karein</h2>
        <p class="nk-sub">OTP aapke mobile pe aayega — Yeh step zaroori hai</p>
        <div id="nk-otp-step1">
            <label>Mobile Number</label>
            <div style="display:flex;gap:8px">
                <span class="nk-prefix">+91</span>
                <input type="tel" id="nk-mobile" maxlength="10" placeholder="10 digit mobile number" class="nk-input">
            </div>
            <button class="nk-btn nk-mt" onclick="nkSendOtp()">📨 OTP Bhejo</button>
            <div id="nk-otp-msg" class="nk-msg"></div>
        </div>
        <div id="nk-otp-step2" style="display:none">
            <label>OTP Daalo (10 min mein expire hoga)</label>
            <input type="text" id="nk-otp" maxlength="6" placeholder="6 digit OTP" class="nk-input nk-otp-input">
            <div id="nk-test-otp" class="nk-test-badge" style="display:none"></div>
            <button class="nk-btn nk-mt" onclick="nkVerifyOtp()">✅ Verify Karein</button>
            <button class="nk-btn nk-btn-ghost nk-mt" onclick="nkResend()">🔄 Dobara Bhejo</button>
            <div id="nk-verify-msg" class="nk-msg"></div>
        </div>
    </div>
    <?php return ob_get_clean();
}
