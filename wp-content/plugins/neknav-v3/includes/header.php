<?php
if (!defined('ABSPATH')) exit;

/**
 * Shortcode: [nk_header_nav]
 * Website ke header mein daalo — Login/Register ya Dashboard button dikhayega
 */
add_shortcode('nk_header_nav', function () {
    ob_start();
    if (is_user_logged_in()) {
        $uid   = get_current_user_id();
        $user  = get_userdata($uid);
        $p     = nk_profile($uid);
        $comp  = nk_completion($uid);
        $photo_id = get_user_meta($uid, 'nk_photo', true);
        $photo    = $photo_id ? wp_get_attachment_image_url($photo_id, 'thumbnail') : '';
        ?>
        <div class="nk-header-user">
            <a href="<?= home_url('/dashboard') ?>" class="nk-header-avatar-link">
                <?php if ($photo): ?>
                    <img src="<?= esc_url($photo) ?>" class="nk-header-avatar">
                <?php else: ?>
                    <div class="nk-header-avatar nk-header-av-fallback"><?= mb_strtoupper(mb_substr($user->display_name??'U',0,1)) ?></div>
                <?php endif; ?>
                <div class="nk-header-info">
                    <span class="nk-header-name"><?= esc_html(explode(' ', $user->display_name)[0]) ?></span>
                    <span class="nk-header-status <?= $comp['pct']===100?'ok':'warn' ?>"><?= $comp['pct']===100?'✅ Verified':'⚠ '.$comp['pct'].'%' ?></span>
                </div>
            </a>
            <div class="nk-header-dropdown">
                <a href="<?= home_url('/dashboard') ?>">🏠 Dashboard</a>
                <a href="<?= home_url('/dashboard?tab=profile') ?>">👤 Profile</a>
                <a href="<?= home_url('/donate') ?>">💚 Donate</a>
                <a href="<?= home_url('/dashboard?tab=referrals') ?>">🌿 Referrals</a>
                <div class="nk-dd-divider"></div>
                <a href="<?= wp_logout_url(home_url()) ?>" style="color:#e56b6f">🚪 Logout</a>
            </div>
        </div>
        <?php
    } else { ?>
        <div class="nk-header-auth">
            <a href="<?= home_url('/login') ?>" class="nk-header-login">Login</a>
            <a href="<?= home_url('/register') ?>" class="nk-header-register">🌱 Register</a>
        </div>
        <?php
    }
    return ob_get_clean();
});

/**
 * Auto-inject header nav into theme
 * Yeh WordPress header ke andar automatically Login/Register link inject karta hai
 */
add_action('wp_body_open', function () {
    echo '<div id="nk-floating-nav">' . do_shortcode('[nk_header_nav]') . '</div>';
});

/**
 * Alternatively, hook into menu — adds Login/Logout to primary nav
 */
add_filter('wp_nav_menu_items', function ($items, $args) {
    if ($args->theme_location === 'primary') {
        if (is_user_logged_in()) {
            $uid  = get_current_user_id();
            $user = get_userdata($uid);
            $name = explode(' ', $user->display_name)[0];
            $items .= '<li class="menu-item nk-menu-user"><a href="' . home_url('/dashboard') . '">👤 ' . esc_html($name) . '</a></li>';
            $items .= '<li class="menu-item nk-menu-donate"><a href="' . home_url('/donate') . '">💚 Donate</a></li>';
        } else {
            $items .= '<li class="menu-item nk-menu-login"><a href="' . home_url('/login') . '">Login</a></li>';
            $items .= '<li class="menu-item nk-menu-reg"><a href="' . home_url('/register') . '">🌱 Register</a></li>';
        }
    }
    return $items;
}, 10, 2);
