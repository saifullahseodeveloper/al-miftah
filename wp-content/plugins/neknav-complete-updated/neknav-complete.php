<?php
/**
 * Plugin Name: NekNeev Complete User System
 * Description: Charity website ke liye complete user system — Registration, OTP, Profile, Documents, Referral Tree
 * Version: 2.1.1
 * Author: NekNeev
 * Text Domain: neknav
 */

if (!defined('ABSPATH')) exit;

define('NEKNAV_DIR',  plugin_dir_path(__FILE__));
define('NEKNAV_URL',  plugin_dir_url(__FILE__));
define('NEKNAV_VER',  '2.1.1');

// --- REFERRAL TRACKING LOGIC (NO CHANGES) ---
add_action('init', function() {
    if (isset($_GET['ref']) && !empty($_GET['ref'])) {
        setcookie('neknav_referrer', sanitize_text_field($_GET['ref']), time() + 86400, COOKIEPATH, COOKIE_DOMAIN);
    }
});

// ── Sub-files load (NO CHANGES) ──────────────────────────────────────────────
require_once NEKNAV_DIR . 'includes/db.php';
require_once NEKNAV_DIR . 'includes/otp.php';
require_once NEKNAV_DIR . 'includes/auth.php';
require_once NEKNAV_DIR . 'includes/profile.php';
require_once NEKNAV_DIR . 'includes/documents.php';
require_once NEKNAV_DIR . 'includes/admin.php';

// ── Assets (NO CHANGES) ──────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('neknav-style', NEKNAV_URL . 'assets/style.css', [], NEKNAV_VER);
    wp_enqueue_script('neknav-script', NEKNAV_URL . 'assets/script.js', ['jquery'], NEKNAV_VER, true);
    wp_localize_script('neknav-script', 'NEKNAV', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('neknav_nonce'),
    ]);
});

// ── Redirect Logic (NO CHANGES) ──────────────────────────────────────────────
add_action('template_redirect', function () {
    if (is_user_logged_in() && is_page(['login', 'register'])) {
        wp_redirect(home_url('/profile'));
        exit;
    }
});

// ── Header Buttons Shortcode (NO CHANGES) ────────────────────────────────────
add_shortcode('neknav_header_btns', function() {
    ob_start();
    if (is_user_logged_in()) { ?>
        <div class="nk-header-auth" style="display:flex; align-items:center; gap:15px;">
            <a href="<?php echo home_url('/profile'); ?>" style="text-decoration:none; color:#1b4332; font-weight:700; font-family:sans-serif;">👤 My Profile</a>
            <a href="<?php echo wp_logout_url(home_url()); ?>" style="text-decoration:none; color:#e56b6f; font-size:13px; font-family:sans-serif;">Logout</a>
        </div>
    <?php } else { ?>
        <div class="nk-header-auth" style="display:flex; align-items:center; gap:12px;">
            <a href="<?php echo home_url('/login'); ?>" style="text-decoration:none; color:#1b4332; font-weight:700; font-family:sans-serif;">Login</a>
            <a href="<?php echo home_url('/register'); ?>" style="text-decoration:none; background:#1b4332; color:#fff; padding:10px 20px; border-radius:8px; font-weight:700; font-family:sans-serif;">Sign Up</a>
        </div>
    <?php }
    return ob_get_clean();
});

// ── COLOR & VISIBILITY FORCE FIX + FORGOT PASSWORD LINK UI ───────────────────
function neknav_force_color_visibility() {
    ?>
    <style type="text/css">
        /* 1. Labels Visibility Fix (Sabhi forms ke liye) */
        body.login label, 
        .nk-field label, 
        .nk-auth-box h2, 
        .nk-section h3, 
        .nk-sub,
        .message, 
        #login_error,
        p.message,
        #login h1 a {
            color: #1b4332 !important; /* Force Solid Dark Green */
            font-weight: 700 !important;
            opacity: 1 !important;
            display: block !important;
            visibility: visible !important;
            text-shadow: none !important;
        }

        /* 2. Input Fields Styling */
        .nk-input, 
        body.login input[type="text"], 
        body.login input[type="email"], 
        body.login input[type="password"] {
            border: 1.5px solid #d0e8da !important;
            color: #1b4332 !important;
            background: #fafffe !important;
            opacity: 1 !important;
            padding: 10px !important;
        }

        /* 3. Global Background & Form Boxes */
        body.login { background-color: #f0faf4 !important; }
        #loginform, #lostpasswordform, #registerform, .nk-auth-box {
            background: #ffffff !important;
            border: 2px solid #d8f3dc !important;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1) !important;
            border-radius: 15px !important;
        }

        /* 4. Primary Buttons */
        body.login .button-primary, .nk-btn {
            background: #1b4332 !important;
            border-color: #1b4332 !important;
            color: #52b788 !important;
            font-weight: 700 !important;
            text-shadow: none !important;
            opacity: 1 !important;
            padding: 10px 20px !important;
            height: auto !important;
        }

        /* 5. Links visibility (Forgot password link included) */
        body.login #nav a, 
        body.login #backtoblog a, 
        .nk-auth-link a,
        .nk-forgot-link {
            color: #2d6a4f !important;
            font-weight: 700 !important;
            text-decoration: none !important;
        }
        /* WooCommerce Lost Password Page Fix */
.woocommerce-ResetPassword, 
.woocommerce-form-row label, 
.woocommerce-privacy-policy-text,
.woocommerce-ResetPassword p {
    color: #1b4332 !important; /* Dark Green */
    font-weight: 700 !important;
    opacity: 1 !important;
}

/* Input Field Styling */
.woocommerce-ResetPassword input.input-text {
    border: 1.5px solid #d0e8da !important;
    background: #fafffe !important;
    color: #1b4332 !important;
    padding: 12px !important;
    border-radius: 8px !important;
}

/* Button Styling */
.woocommerce-ResetPassword button.button {
    background: #1b4332 !important;
    color: #52b788 !important;
    padding: 12px 24px !important;
    border-radius: 8px !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    border: none !important;
}
        
        .nk-forgot-link:hover { text-decoration: underline !important; }
    </style>
    <?php
}
add_action('wp_head', 'neknav_force_color_visibility', 999);
add_action('login_head', 'neknav_force_color_visibility', 999);