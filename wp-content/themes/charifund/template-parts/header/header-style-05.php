<?php
/**
 * Header Style 05
 * @package charifund
 * @since 1.0.0
 */

$header_5_logo = cs_get_option('header_5_logo'); 
$header_5_right_phone_title = cs_get_option('header_5_right_phone_title');
$header_5_right_phone_num = cs_get_option('header_5_right_phone_num');

?>
<!-- ==== header start ==== -->
<header class="header header-secondary header-five">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-header__menu-box">
                    <nav class="navbar p-0">
                        <div class="navbar-logo"> <?php                               
                     if (has_custom_logo() && empty($header_5_logo['id'])) {
                        the_custom_logo();
                     } elseif (!empty($header_5_logo['id'])) {
                        printf('
							
							<a href="%1$s">
								<img src="%2$s" alt="%3$s"/>
							</a>', esc_url(get_home_url()), $header_5_logo['url'], $header_5_logo['alt']);
                     } else {
                        printf('
							
							<h4>
								<a class="d-inline-block site-title" href="%1$s">%2$s</a>
							</h4>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                     }
                     ?> </div>
                        <div class="navbar__menu">
                            <div class="navbar__menu d-none d-xl-block"> <?php
                            wp_nav_menu(array(
                              'theme_location'  => 'main-menu',
                              'menu_class'      => 'navbar__list',
                              'container'       => 'div',
                              'container_id'    => 'charifund_main_menu',
                              'fallback_cb'     => 'charifund_theme_fallback_menu',
                              'walker'          => new Custom_Menu_Walker(),
                            ));
                        ?> </div>
                        </div>
                        <div class="navbar__options">
                            <div class="navbar__mobile-options ">
                                <?php if($header_5_right_phone_title || $header_5_right_phone_num) : ?>
                                    <div class="contact-btn d-none d-xxl-flex">
                                        <div class="contact-icon">
                                            <i class="fa-solid fa-phone-volume"></i>
                                        </div>
                                        <div class="contact-content">
                                            <?php if($header_5_right_phone_title) : ?>
                                                <p><?php echo esc_html($header_5_right_phone_title, 'charifund'); ?></p>
                                            <?php endif; ?>
                                            <?php if($header_5_right_phone_num) : ?>
                                                <a href="tel:<?php echo esc_html($header_5_right_phone_num, 'charifund'); ?>"><?php echo esc_html($header_5_right_phone_num, 'charifund'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button class="open-offcanvas-nav d-flex d-xl-none" aria-label="toggle mobile menu" title="open offcanvas menu">
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ==== / header end ==== -->
<!-- ==== mobile menu start ==== -->
<div class="mobile-menu mobile-menu--primary d-block d-xxl-none">
    <nav class="mobile-menu__wrapper">
        <div class="mobile-menu__header nav-fade">
            <div class="logo"> <?php                               
            if (has_custom_logo() && empty($header_5_logo['id'])) {
               the_custom_logo();
            } elseif (!empty($header_5_logo['id'])) {
               printf('
				
				<a href="%1$s">
					<img src="%2$s" alt="%3$s"/>
				</a>', esc_url(get_home_url()), $header_5_logo['url'], $header_5_logo['alt']);
            } else {
               printf('
				
				<h4>
					<a class="d-inline-block site-title" href="%1$s">%2$s</a>
				</h4>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
            }
            ?> </div>
            <button aria-label="close mobile menu" class="close-mobile-menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="mobile-menu__list"></div>
    </nav>
</div>
<div class="mobile-menu__backdrop"></div>
<!-- ==== / mobile menu end ==== -->