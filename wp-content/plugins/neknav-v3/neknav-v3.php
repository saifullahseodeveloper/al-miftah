<?php
/**
 * Plugin Name: NekNeev Charity Platform
 * Description: Complete charity platform — Custom Auth, User Dashboard, Donations, Referral Tree
 * Version: 3.0.0
 * Author: NekNeev
 */
if (!defined('ABSPATH')) exit;

define('NK_DIR', plugin_dir_path(__FILE__));
define('NK_URL', plugin_dir_url(__FILE__));
define('NK_VER', '3.0.0');

foreach (['db','auth','profile','documents','donations','dashboard','admin','header'] as $f) {
    require_once NK_DIR . "includes/$f.php";
}

// Enqueue assets on frontend
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('nk-style', NK_URL . 'assets/style.css', [], NK_VER);
    wp_enqueue_script('nk-script', NK_URL . 'assets/script.js', ['jquery'], NK_VER, true);
    wp_localize_script('nk-script', 'NK', [
        'ajax' => admin_url('admin-ajax.php'),
        'nonce'=> wp_create_nonce('nk_nonce'),
        'home' => home_url(),
    ]);
});

// Redirect: logged-in users away from login/register
add_action('template_redirect', function () {
    if (is_user_logged_in()) {
        $slug = get_post_field('post_name', get_the_ID());
        if (in_array($slug, ['login','register','sign-up','sign-in'])) {
            wp_redirect(home_url('/dashboard')); exit;
        }
    } else {
        $slug = get_post_field('post_name', get_the_ID());
        $protected = ['dashboard','profile','my-profile'];
        if (in_array($slug, $protected)) {
            wp_redirect(home_url('/login')); exit;
        }
    }
});

// Keep wp-login.php for admin only — redirect frontend users to custom login
add_action('login_init', function () {
    if (!isset($_GET['action']) || $_GET['action'] === 'login') {
        // Only redirect non-admin normal users trying to access wp-login
        // Admin can still use it freely
    }
});
