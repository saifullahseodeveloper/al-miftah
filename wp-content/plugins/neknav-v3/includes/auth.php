<?php
if (!defined('ABSPATH')) exit;

/* ═══════════════════════════════════════════════════════════════════════════
   REGISTER SHORTCODE  [nk_register]
═══════════════════════════════════════════════════════════════════════════ */
add_shortcode('nk_register', function () {
    if (is_user_logged_in()) {
        return '<div class="nk-box"><p>Aap pehle se logged in hain.</p><a href="' . home_url('/dashboard') . '" class="nk-btn">Dashboard →</a></div>';
    }
    $err = $msg = '';

    if (isset($_POST['nk_reg_submit'])) {
        if (!wp_verify_nonce($_POST['_nk_nonce'] ?? '', 'nk_register')) { $err = 'Security error'; }
        else {
            $name    = sanitize_text_field($_POST['full_name'] ?? '');
            $email   = sanitize_email($_POST['email'] ?? '');
            $mobile  = preg_replace('/\D/', '', $_POST['mobile'] ?? '');
            $addr    = sanitize_textarea_field($_POST['address'] ?? '');
            $city    = sanitize_text_field($_POST['city'] ?? '');
            $state   = sanitize_text_field($_POST['state'] ?? '');
            $pin     = preg_replace('/\D/', '', $_POST['pincode'] ?? '');
            $pass    = $_POST['password'] ?? '';
            $ref     = sanitize_text_field($_POST['ref_code'] ?? '');

            if (!$name||!$email||!$mobile||!$addr||!$pin||!$pass) $err='Saari fields fill karein!';
            elseif (strlen($mobile)!==10)   $err='Mobile number 10 digits ka hona chahiye!';
            elseif (strlen($pass)<8)        $err='Password kam se kam 8 characters ka hona chahiye!';
            elseif (email_exists($email))   $err='Yeh email pehle se registered hai!';
            else {
                $uid = wp_create_user($email, $pass, $email);
                if (is_wp_error($uid)) { $err = $uid->get_error_message(); }
                else {
                    wp_update_user(['ID'=>$uid,'display_name'=>$name,'first_name'=>$name]);

                    // Find referrer
                    global $wpdb; $t = $wpdb->prefix . 'nk_profiles';
                    $ref_uid = null;
                    $ref_code_to_check = $ref ?: ($_COOKIE['nk_ref'] ?? '');
                    if ($ref_code_to_check) {
                        $ref_uid = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $t WHERE referral_code=%s", $ref_code_to_check));
                    }

                    $new_code = 'NK' . strtoupper(substr(md5($uid . time()), 0, 7));
                    $wpdb->insert($t, [
                        'user_id'      => $uid,
                        'full_name'    => $name,
                        'mobile'       => $mobile,
                        'address'      => $addr,
                        'city'         => $city,
                        'state'        => $state,
                        'pincode'      => $pin,
                        'referral_code'=> $new_code,
                        'referred_by'  => $ref_uid ?: null,
                        'profile_step' => 1,
                    ]);

                    wp_set_current_user($uid);
                    wp_set_auth_cookie($uid, true);
                    setcookie('nk_ref', '', time()-3600, COOKIEPATH, COOKIE_DOMAIN);
                    wp_redirect(home_url('/dashboard')); exit;
                }
            }
        }
    }

    $url_ref = sanitize_text_field($_GET['ref'] ?? '');
    ob_start(); ?>
    <div class="nk-auth-page">
        <div class="nk-auth-card">
            <div class="nk-brand">🌱 <span>NekNeev</span></div>
            <h2>Join Karein</h2>
            <p class="nk-auth-sub">Charity movement ka hissa banein — bilkul free</p>
            <?php if ($err): ?><div class="nk-alert nk-err">⚠ <?= esc_html($err) ?></div><?php endif; ?>

            <form method="post" class="nk-form">
                <?php wp_nonce_field('nk_register','_nk_nonce'); ?>
                <div class="nk-row-2">
                    <div class="nk-field">
                        <label>👤 Poora Naam *</label>
                        <input type="text" name="full_name" class="nk-input" placeholder="Jaise: Arjun Sharma" required value="<?= esc_attr($_POST['full_name']??'') ?>">
                    </div>
                    <div class="nk-field">
                        <label>📱 Mobile Number *</label>
                        <div class="nk-mobile-wrap"><span class="nk-code">+91</span><input type="tel" name="mobile" class="nk-input" maxlength="10" placeholder="10 digit" required value="<?= esc_attr($_POST['mobile']??'') ?>"></div>
                    </div>
                </div>
                <div class="nk-field">
                    <label>📧 Email Address *</label>
                    <input type="email" name="email" class="nk-input" placeholder="aapka@email.com" required value="<?= esc_attr($_POST['email']??'') ?>">
                </div>
                <div class="nk-field">
                    <label>🏠 Ghar ka Pata (Address) *</label>
                    <textarea name="address" class="nk-input" rows="2" placeholder="Gali, Mohalla, Society..." required><?= esc_textarea($_POST['address']??'') ?></textarea>
                </div>
                <div class="nk-row-3">
                    <div class="nk-field">
                        <label>🏙 Sheher *</label>
                        <input type="text" name="city" class="nk-input" placeholder="City" value="<?= esc_attr($_POST['city']??'') ?>">
                    </div>
                    <div class="nk-field">
                        <label>🗺 Rajya</label>
                        <input type="text" name="state" class="nk-input" placeholder="State" value="<?= esc_attr($_POST['state']??'') ?>">
                    </div>
                    <div class="nk-field">
                        <label>📮 PIN Code *</label>
                        <input type="text" name="pincode" class="nk-input" maxlength="6" placeholder="6 digit PIN" required value="<?= esc_attr($_POST['pincode']??'') ?>">
                    </div>
                </div>
                <div class="nk-field">
                    <label>🔒 Password * <small>(kam se kam 8 characters)</small></label>
                    <div class="nk-pass-wrap">
                        <input type="password" name="password" id="nk-pass" class="nk-input" placeholder="Strong password" required>
                        <button type="button" class="nk-eye" onclick="nkEye()">👁</button>
                    </div>
                    <div class="nk-strength-bar"><div id="nk-strength-fill"></div></div>
                </div>
                <div class="nk-field">
                    <label>🎫 Referral Code <small>(optional)</small></label>
                    <input type="text" name="ref_code" class="nk-input" placeholder="Jaise: NK1A2B3C" value="<?= esc_attr($url_ref ?: ($_POST['ref_code']??'')) ?>">
                </div>
                <button type="submit" name="nk_reg_submit" class="nk-btn nk-btn-full nk-btn-lg">🌱 Account Banao</button>
            </form>
            <p class="nk-switch">Pehle se account hai? <a href="<?= home_url('/login') ?>">Login karein →</a></p>
        </div>
    </div>
    <?php return ob_get_clean();
});

/* ═══════════════════════════════════════════════════════════════════════════
   LOGIN SHORTCODE  [nk_login]
═══════════════════════════════════════════════════════════════════════════ */
add_shortcode('nk_login', function () {
    if (is_user_logged_in()) {
        return '<div class="nk-box"><a href="' . home_url('/dashboard') . '" class="nk-btn">Dashboard →</a></div>';
    }
    $err = '';
    if (isset($_POST['nk_login_submit'])) {
        if (!wp_verify_nonce($_POST['_nk_nonce'] ?? '', 'nk_login')) { $err = 'Security error'; }
        else {
            $email = sanitize_email($_POST['email'] ?? '');
            $pass  = $_POST['password'] ?? '';
            $user  = wp_authenticate($email, $pass);
            if (is_wp_error($user)) { $err = 'Email ya password galat hai!'; }
            else {
                // Prevent normal users from seeing WP admin
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID, isset($_POST['remember']));
                wp_redirect(home_url('/dashboard')); exit;
            }
        }
    }
    ob_start(); ?>
    <div class="nk-auth-page">
        <div class="nk-auth-card">
            <div class="nk-brand">🌱 <span>NekNeev</span></div>
            <h2>Wapas Aaye!</h2>
            <p class="nk-auth-sub">Apne account mein login karein</p>
            <?php if ($err): ?><div class="nk-alert nk-err">⚠ <?= esc_html($err) ?></div><?php endif; ?>
            <form method="post" class="nk-form">
                <?php wp_nonce_field('nk_login','_nk_nonce'); ?>
                <div class="nk-field">
                    <label>📧 Email Address</label>
                    <input type="email" name="email" class="nk-input" placeholder="aapka@email.com" required>
                </div>
                <div class="nk-field">
                    <label>🔒 Password</label>
                    <div class="nk-pass-wrap">
                        <input type="password" name="password" id="nk-pass" class="nk-input" placeholder="Password" required>
                        <button type="button" class="nk-eye" onclick="nkEye()">👁</button>
                    </div>
                </div>
                <div class="nk-between">
                    <label class="nk-check-label"><input type="checkbox" name="remember"> Mujhe yaad rakho</label>
                    <a href="<?= wp_lostpassword_url() ?>" class="nk-link">Password bhool gaye?</a>
                </div>
                <button type="submit" name="nk_login_submit" class="nk-btn nk-btn-full nk-btn-lg">🔓 Login Karein</button>
            </form>
            <p class="nk-switch">Naya hain? <a href="<?= home_url('/register') ?>">Register karein →</a></p>
        </div>
    </div>
    <?php return ob_get_clean();
});

// Set referral cookie
add_action('init', function () {
    if (isset($_GET['ref']) && !is_user_logged_in()) {
        setcookie('nk_ref', sanitize_text_field($_GET['ref']), time() + 7 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }
});
