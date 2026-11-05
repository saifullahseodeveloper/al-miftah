<?php
/**
 * Theme Header Template — AL-MIFTAH (Modified)
 *
 * @package charifund
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>

    <style>
    /* ═══════════════════════════════════════════
       AL-MIFTAH CUSTOM HEADER STYLES
       Colors from logo:
         Green  : #1B6B3A
         Gold   : #C8963E
    ═══════════════════════════════════════════ */

    /* ── 1. TICKER BAR ── */
    .almiftah-ticker-bar {
        background: #121212;
        height: 42px;
        display: flex;
        align-items: center;
        overflow: hidden;
        border-bottom: 3px solid #C8963E;
        position: relative;
        z-index: 9999;
        width: 100%;
    }
    .almiftah-ticker-badge {
        background: #C8963E;
        min-width: 46px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .almiftah-ticker-viewport {
        overflow: hidden;
        flex: 1;
        height: 100%;
        display: flex;
        align-items: center;
        -webkit-mask-image: linear-gradient(to right, transparent, black 30px, black calc(100% - 30px), transparent);
        mask-image: linear-gradient(to right, transparent, black 30px, black calc(100% - 30px), transparent);
    }
    .almiftah-ticker-track {
        display: flex;
        white-space: nowrap;
        animation: almiftahTicker 38s linear infinite;
    }
    .almiftah-ticker-track span {
        color: #C8963E;
        font-size: 13px;
        font-weight: 500;
        padding-right: 60px;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.3px;
    }
    .almiftah-ticker-track span::before {
        content: "• ";
    }
    @keyframes almiftahTicker {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ── 2. LOGO ZONE ── */
    .almiftah-logo-zone {
        background: #1B6B3A;
        padding: 18px 20px 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.04) 0%, transparent 60%),
            radial-gradient(circle at 80% 50%, rgba(200,150,62,0.08) 0%, transparent 60%);
        width: 100%;
    }
    .almiftah-logo-ring {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 3px solid #C8963E;
        box-shadow: 0 0 0 5px rgba(200,150,62,0.18), 0 8px 24px rgba(0,0,0,0.30);
        overflow: hidden;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
    }
    .almiftah-logo-ring:hover {
        transform: scale(1.05);
        box-shadow: 0 0 0 7px rgba(200,150,62,0.30), 0 10px 30px rgba(0,0,0,0.35);
    }
    .almiftah-logo-ring img {
        width: 90%;
        height: 90%;
        object-fit: contain;
    }
    .almiftah-logo-tagline {
        color: #C8963E;
        font-family: 'Amiri', serif;
        font-size: 13px;
        letter-spacing: 2px;
        text-transform: uppercase;
        opacity: 0.9;
        text-align: center;
    }

    /* ── 3. NAV BAR ── */
    .almiftah-nav-bar {
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        height: 60px;
        box-shadow: 0 3px 18px rgba(27,107,58,0.14);
        position: sticky;
        top: 0;
        z-index: 9998;
        border-bottom: 3px solid #1B6B3A;
        width: 100%;
        box-sizing: border-box;
    }

    /* Hamburger */
    .almiftah-hamburger {
        display: flex;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        border: none;
        background: transparent;
        transition: background 0.2s;
    }
    .almiftah-hamburger:hover { background: #f0f7f3; }
    .almiftah-hamburger span {
        display: block;
        width: 24px;
        height: 2.5px;
        background: #1B6B3A;
        border-radius: 3px;
        transition: all 0.3s ease;
    }
    .almiftah-hamburger.active span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
    .almiftah-hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .almiftah-hamburger.active span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

    /* Desktop nav links */
    .almiftah-nav-links {
        display: none;
        gap: 2px;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .almiftah-nav-links a {
        font-size: 13.5px;
        font-weight: 500;
        color: #121212;
        padding: 8px 14px;
        border-radius: 6px;
        transition: background 0.2s, color 0.2s;
        white-space: nowrap;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
    }
    .almiftah-nav-links a:hover {
        background: #1B6B3A;
        color: #fff;
    }

    /* Right side */
    .almiftah-nav-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Social icons */
    .almiftah-social-strip {
        display: flex;
        gap: 7px;
        align-items: center;
    }
    .almiftah-s-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #1B6B3A;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.25s, transform 0.25s;
        cursor: pointer;
        flex-shrink: 0;
        text-decoration: none;
    }
    .almiftah-s-icon:hover {
        background: #C8963E;
        transform: scale(1.13) rotate(-6deg);
    }
    .almiftah-s-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    /* Donate pill — desktop only */
    .almiftah-donate-pill {
        display: none;
        background: #C8963E;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 22px;
        border-radius: 30px;
        white-space: nowrap;
        transition: background 0.2s, transform 0.2s;
        margin-left: 4px;
        letter-spacing: 0.3px;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
    }
    .almiftah-donate-pill:hover {
        background: #A67830;
        transform: translateY(-1px);
        color: #fff;
    }

    /* ── 4. MOBILE DROPDOWN ── */
    .almiftah-mobile-nav {
        background: #fff;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.42s cubic-bezier(0.4, 0, 0.2, 1);
        position: sticky;
        top: 60px;
        z-index: 9997;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        border-left: 4px solid #1B6B3A;
        width: 100%;
    }
    .almiftah-mobile-nav.open { max-height: 520px; }
    .almiftah-mobile-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 24px;
        font-size: 14.5px;
        font-weight: 500;
        color: #121212;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s, color 0.2s, padding-left 0.22s;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
    }
    .almiftah-mobile-nav a:hover {
        background: #f0faf4;
        color: #1B6B3A;
        padding-left: 32px;
    }
    .almiftah-mobile-nav .m-donate {
        background: #C8963E;
        color: #fff !important;
        font-weight: 700;
        justify-content: center;
        margin: 12px 20px 16px;
        border-radius: 8px;
        border-bottom: none !important;
        padding: 13px 24px !important;
        letter-spacing: 0.3px;
    }
    .almiftah-mobile-nav .m-donate:hover {
        background: #A67830;
        padding-left: 24px !important;
    }

    /* ── RESPONSIVE ── */
    @media (min-width: 640px) {
        .almiftah-ticker-bar { height: 44px; }
        .almiftah-ticker-track span { font-size: 14px; }
        .almiftah-logo-zone { padding: 22px 20px 16px; }
        .almiftah-logo-ring { width: 124px; height: 124px; }
        .almiftah-logo-tagline { font-size: 14px; }
        .almiftah-nav-bar { padding: 0 32px; height: 64px; }
    }
    @media (min-width: 1024px) {
        .almiftah-hamburger   { display: none !important; }
        .almiftah-nav-links   { display: flex !important; }
        .almiftah-donate-pill { display: block !important; }
        .almiftah-s-icon      { width: 38px; height: 38px; }
        .almiftah-nav-bar     { padding: 0 48px; height: 68px; }
        .almiftah-logo-zone   { padding: 24px 20px 18px; }
        .almiftah-logo-ring   { width: 132px; height: 132px; }
    }
    @media (min-width: 1280px) {
        .almiftah-nav-bar   { padding: 0 80px; }
        .almiftah-nav-links a { font-size: 14.5px; }
    }
    @media (min-width: 1440px) {
        .almiftah-nav-bar { padding: 0 120px; }
    }
    </style>
</head>

<?php
    // Enqueue RTL CSS
    $rtl_enable = cs_get_option('rtl_enable');
    if ( $rtl_enable == true ) {
        echo '<script>
            jQuery(document).ready(function($) {
                $("body").addClass("rtl");
            });
        </script>';
    }
?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'charifund_after_body' ); ?>

<?php
$page_container_meta = Charifund_Group_Fields_Value::page_container( 'charifund', 'header_options' );
?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'charifund' ); ?></a>

    <!-- ═══════════════════════════════════
         AL-MIFTAH CUSTOM HEADER START
    ═══════════════════════════════════ -->
    <header id="masthead" class="site-header">

        <!-- 1 ▸ ANNOUNCEMENT TICKER -->
        <div class="almiftah-ticker-bar">
            <div class="almiftah-ticker-badge">📢</div>
            <div class="almiftah-ticker-viewport">
                <div class="almiftah-ticker-track">
                    <span>Admissions Open for Classes I–IX — Apply Now</span>
                    <span>Donate to support free Islamic education for underprivileged children</span>
                    <span>Al-Miftah: Ek Charitable School Kholo, Taleem Ka Noor Phelao</span>
                    <span>Zakat, Sadaqah aur koi bhi donation se bachchon ko taleem do</span>
                    <!-- Duplicate for seamless loop -->
                    <span>Admissions Open for Classes I–IX — Apply Now</span>
                    <span>Donate to support free Islamic education for underprivileged children</span>
                    <span>Al-Miftah: Ek Charitable School Kholo, Taleem Ka Noor Phelao</span>
                    <span>Zakat, Sadaqah aur koi bhi donation se bachchon ko taleem do</span>
                </div>
            </div>
        </div>

        <!-- 2 ▸ LOGO ZONE -->
        <div class="almiftah-logo-zone">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="almiftah-logo-ring">
                <img
                    src="wp-content/uploads/2026/04/al-miftah-official-logo.png"
                    alt="<?php bloginfo('name'); ?>"
                    width="110"
                    height="110"
                />
            </a>
<strong><span class="almiftah-logo-tagline" style="color: #c8963e;">Al-Miftah &mdash; Hope for a Better Tomorrow</span></strong>
</div>

        <!-- 3 ▸ STICKY NAV BAR -->
        <nav class="almiftah-nav-bar" role="navigation">

            <!-- Hamburger (mobile) -->
            <button class="almiftah-hamburger" id="almiftahHamburger" aria-label="Toggle menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>

            <!-- Desktop nav links -->
            <ul class="almiftah-nav-links">
                <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( home_url('/about-us') ); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url( home_url('/causes') ); ?>">Causes</a></li>
                <li><a href="<?php echo esc_url( home_url('/event') ); ?>">Events</a></li>
                <li><a href="<?php echo esc_url( home_url('/blog') ); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url( home_url('/gallery/') ); ?>">gallery</a></li>
                <li><a href="<?php echo esc_url( home_url('/contact-us') ); ?>">Contact</a></li>
                <li><a href="<?php echo esc_url( home_url('/register') ); ?>">Register</a></li>
                <li><a href="<?php echo esc_url( home_url('/login/') ); ?>">Login</a></li>

            </ul>

            <!-- Right: Social + Donate -->
            <div class="almiftah-nav-right">
                <div class="almiftah-social-strip">
                    <!-- Facebook -->
                    <a class="almiftah-s-icon" href="#" aria-label="Facebook" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a class="almiftah-s-icon" href="https://www.instagram.com/almiftah_organization?igsh=MWNuM2xmOXFycHV3dQ==" aria-label="Instagram" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4" fill="none" stroke="#fff" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.3" fill="#fff"/></svg>
                    </a>
                    <!-- YouTube -->
                    <a class="almiftah-s-icon" href="https://www.youtube.com/@AL-MiftahOrganization" aria-label="YouTube" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><path d="M22.54 6.42A2.78 2.78 0 0 0 20.6 4.47C18.88 4 12 4 12 4s-6.88 0-8.6.47A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.4 19.53C5.12 20 12 20 12 20s6.88 0 8.6-.47a2.78 2.78 0 0 0 1.94-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75,15.02 15.5,12 9.75,8.98" fill="#C8963E"/></svg>
                    </a>
                    <!-- Twitter/X -->
                    <a class="almiftah-s-icon" href="#" aria-label="Twitter" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                    </a>
                </div>
                <!-- Donate button -->
                <a class="almiftah-donate-pill" href="<?php echo esc_url( home_url('/donate/donate/') ); ?>">Donate Now ›</a>
            </div>

        </nav>

        <!-- 4 ▸ MOBILE DROPDOWN MENU -->
        <div class="almiftah-mobile-nav" id="almiftahMobileNav" role="navigation" aria-label="Mobile menu">
            <a href="<?php echo esc_url( home_url('/') ); ?>">🏠 Home</a>
            <a href="<?php echo esc_url( home_url('/about-us') ); ?>">📖 About Us</a>
            <a href="<?php echo esc_url( home_url('/causes') ); ?>">❤️ Causes</a>
            <a href="<?php echo esc_url( home_url('/event') ); ?>">📅 Events</a>
            <a href="<?php echo esc_url( home_url('/blog') ); ?>">📰 Blog</a>
            <a href="<?php echo esc_url( home_url('/contact-us') ); ?>">📞 Contact Us</a>
            <a href="<?php echo esc_url( home_url('/register') ); ?>">✍️ Register</a>
            <a href="<?php echo esc_url( home_url('/Login') ); ?>">✍️ login</a>
            <a href="<?php echo esc_url( home_url('/donate/donate/') ); ?>" class="m-donate">💛 Donate Now ›</a>
        </div>

        <!-- JavaScript for hamburger toggle -->
        <script>
        (function() {
            var btn  = document.getElementById('almiftahHamburger');
            var menu = document.getElementById('almiftahMobileNav');
            if (!btn || !menu) return;

            btn.addEventListener('click', function() {
                var open = menu.classList.toggle('open');
                btn.classList.toggle('active', open);
                btn.setAttribute('aria-expanded', open);
            });

            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('open');
                    btn.classList.remove('active');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            // Close when a link is clicked
            var links = menu.querySelectorAll('a');
            links.forEach(function(link) {
                link.addEventListener('click', function() {
                    menu.classList.remove('open');
                    btn.classList.remove('active');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();
        </script>

    </header><!-- #masthead -->
    <!-- ═══════════════════════════════════
         AL-MIFTAH CUSTOM HEADER END
    ═══════════════════════════════════ -->

    <?php do_action( 'charifund_before_page_content' ) ?>
    <div id="content" class="site-content">