<?php
if (!defined('ABSPATH')) exit;

// --- 1. USER REGISTRATION AUR LOGIN KA BACKEND LOGIC ---
add_action('init', function() {
    global $wpdb;

    // A. Registration Logic
    if (isset($_POST['neknav_register_submit'])) {
        $full_name = sanitize_text_field($_POST['full_name']);
        $email     = sanitize_email($_POST['email']);
        $mobile    = sanitize_text_field($_POST['mobile']);
        $address   = sanitize_text_field($_POST['address']);
        $pincode   = sanitize_text_field($_POST['pincode']);
        $password  = $_POST['password'];
        
        // Referral Logic: Form se ya Cookie se code uthana
        $ref_code  = sanitize_text_field($_POST['referred_by'] ?? ($_COOKIE['neknav_referrer'] ?? ''));
        $referrer_id = 0;

        if (!empty($ref_code)) {
            $ref_user = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM {$wpdb->prefix}neknav_profiles WHERE referral_code = %s", $ref_code));
            if ($ref_user) {
                $referrer_id = $ref_user;
            }
        }

        if (email_exists($email)) {
            echo "<script>alert('Yeh Email pehle se registered hai!');</script>";
            return;
        }

        // WordPress User Banayein
        $user_id = wp_create_user($email, $password, $email);

        if (!is_wp_error($user_id)) {
            // NekNeev Profile Table mein data save karein
            $wpdb->insert($wpdb->prefix . 'neknav_profiles', [
                'user_id'       => $user_id,
                'full_name'     => $full_name,
                'mobile'        => $mobile,
                'address'       => $address,
                'pincode'       => $pincode,
                'status'        => 'registered',
                'referred_by'   => $referrer_id,
                'referral_code' => 'NK' . strtoupper(substr(md5($user_id . time()), 0, 6)),
                'joined_at'     => current_time('mysql')
            ]);

            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_redirect(home_url('/profile'));
            exit;
        }
    }

    // B. Login Logic
    if (isset($_POST['neknav_login_submit'])) {
        $creds = array(
            'user_login'    => sanitize_text_field($_POST['login_user']),
            'user_password' => $_POST['login_pass'],
            'remember'      => true
        );
        $user = wp_signon($creds, false);
        if (!is_wp_error($user)) {
            wp_redirect(home_url('/profile'));
            exit;
        } else {
            echo "<script>alert('Ghalat Email ya Password!');</script>";
        }
    }
});

// --- 2. REGISTRATION FORM (SHORTCODE: [neknav_register]) ---
add_shortcode('neknav_register', function() {
    if (is_user_logged_in()) return '<p>Aap login hain. <a href="'.home_url('/profile').'">Dashboard jayein</a></p>';
    
    // PHP level par bhi check rakhte hain
    $php_ref = isset($_GET['ref']) ? sanitize_text_field($_GET['ref']) : (isset($_COOKIE['neknav_referrer']) ? sanitize_text_field($_COOKIE['neknav_referrer']) : '');

    ob_start(); ?>
    <div style="max-width:450px; margin:30px auto; padding:25px; border:1px solid #ddd; border-radius:15px; font-family: sans-serif; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="text-align:center; color:#2d6a4f; margin-bottom:20px;">🌱 Join NekNeev</h2>
        <form method="post" id="neknav-reg-form">
            
            <label style="font-weight:bold; font-size:14px; color:#40916c;">Referral Code</label>
            <input type="text" name="referred_by" id="ref_field" value="<?php echo esc_attr($php_ref); ?>" style="width:100%; padding:12px; margin:8px 0 15px; border:1px solid #b7e4c7; border-radius:5px; background:#f9f9f9;" placeholder="Referral code auto-filled">

            <label style="font-weight:bold; font-size:14px;">Name</label>
            <input type="text" name="full_name" style="width:100%; padding:12px; margin:8px 0 15px; border:1px solid #ccc; border-radius:5px;" required>

            <label style="font-weight:bold; font-size:14px;">Email Address</label>
            <input type="email" name="email" style="width:100%; padding:12px; margin:8px 0 15px; border:1px solid #ccc; border-radius:5px;" required>

            <label style="font-weight:bold; font-size:14px;">Mobile Number</label>
            <input type="text" name="mobile" style="width:100%; padding:12px; margin:8px 0 15px; border:1px solid #ccc; border-radius:5px;" required>

            <label style="font-weight:bold; font-size:14px;">Password</label>
            <div style="position:relative; display:flex; align-items:center; margin-top:8px;">
                <input type="password" name="password" id="reg-pass" style="width:100%; padding:12px; border:1px solid #ccc; border-radius:5px;" required>
                <div style="position:absolute; right:10px; display:flex; gap:12px;">
                    <span onclick="toggleRegPass()" style="cursor:pointer; font-size:18px;">👁️</span>
                    <span onclick="copyRegPass()" style="cursor:pointer; font-size:18px;">📋</span>
                </div>
            </div>

            <button type="submit" name="neknav_register_submit" style="width:100%; padding:14px; background:#40916c; color:white; border:none; border-radius:5px; cursor:pointer; font-weight:bold; font-size:16px; margin-top:20px;">Register Karein</button>
        </form>
    </div>

    <script>
    // --- JS MAGIC TO FETCH FROM URL ---
    window.addEventListener('DOMContentLoaded', (event) => {
        const urlParams = new URLSearchParams(window.location.search);
        const refCode = urlParams.get('ref');
        const refInput = document.getElementById('ref_field');
        
        if (refCode && refInput) {
            refInput.value = refCode;
            refInput.readOnly = true;
            refInput.style.backgroundColor = "#e8f5e9";
        }
    });

    function toggleRegPass() {
        var f = document.getElementById("reg-pass");
        f.type = (f.type === "password") ? "text" : "password";
    }
    function copyRegPass() {
        var f = document.getElementById("reg-pass");
        if(f.value === "") return alert("Kuch type karein!");
        f.select();
        navigator.clipboard.writeText(f.value);
        alert("Password Copy Ho Gaya!");
    }
    </script>
    <?php
    return ob_get_clean();
});

// --- 3. LOGIN FORM (SHORTCODE: [neknav_login]) ---
add_shortcode('neknav_login', function() {
    if (is_user_logged_in()) return '<p>Aap login hain. <a href="'.home_url('/profile').'">Dashboard jayein</a></p>';
    
    ob_start(); ?>
    <div class="nk-auth-box">
        <div class="nk-logo-mini">🔓</div>
        <h2>Login</h2>
        <p class="nk-sub">APNE ACCOUNT MEIN LOGIN KAREIN</p>
        
        <form method="post">
            <div class="nk-field">
                <label>Email Address ya Mobile Number</label> 
                <input type="text" name="login_user" class="nk-input" placeholder="Email ya Mobile likhein" required>
            </div>

            <div class="nk-field">
                <label>Password</label>
                <input type="password" name="login_pass" class="nk-input" placeholder="••••••••" required>
            </div>

            <button type="submit" name="neknav_login_submit" class="nk-btn nk-btn-full">Login Karein</button>
            
            <div style="text-align: center; margin-top: 15px;">
                <a href="<?php echo wp_lostpassword_url(); ?>" style="color: #2d6a4f; font-size: 13px; text-decoration: none; font-weight: 700;">Forgot Password?</a>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
});