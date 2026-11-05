<?php
/**
 * Header Style 4
 * @package charifund
 * @since 1.0.0
 */

$header_4_top_bar_enabled = cs_get_option('header_4_top_bar_enabled'); 
$header_4_top_bar_phone = cs_get_option('header_4_top_bar_phone');
$header_4_top_bar_email = cs_get_option('header_4_top_bar_email');
$header_4_top_bar_location = cs_get_option('header_4_top_bar_location');
$header_4_top_bar_notice_text = cs_get_option('header_4_top_bar_notice_text');

$header_4_logo = cs_get_option('header_4_logo'); 
$header_4_socials_repeater = cs_get_option('header_4_socials_repeater');
$header_4_cart_btn_enabled = cs_get_option('header_4_cart_btn_enabled'); 
$header_4_right_btn_enabled = cs_get_option('header_4_right_btn_enabled'); 
$header_4_right_btn_text = cs_get_option('header_4_right_btn_text');
$header_4_right_btn_url = cs_get_option('header_4_right_btn_url');
$header_4_main_color = cs_get_option('header_4_main_color'); 

?> 

<style>
    :root {
        --base-color: <?php echo $header_4_main_color; ?>
    }
</style>

<!-- ==== topbar start ==== --> 
<?php if( $header_4_top_bar_enabled ): ?> 
    <div class="topbar topbar--secondary topbar--quaternary d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="topbar__inner">
                        <div class="row align-items-center gutter-12">
                            <div class="col-12 col-xxl-7">
                                <div class="topbar__list-wrapper">
                                    <ul class="topbar__list justify-content-center justify-content-xxl-start">
                                        <?php if($header_4_top_bar_phone) : ?>
                                            <li>
                                                <i class="fa-solid fa-comment-dots"></i> 
                                                <?php echo esc_html('Helpline: ', 'charifund'); ?>
                                                <span class="fw-600 text-white"><?php echo esc_html($header_4_top_bar_phone, 'charifund'); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($header_4_top_bar_email) : ?>
                                            <li>
                                                <span class="divider"></span>
                                            </li>
                                            <li>
                                                <span class="fw-600 text-white"><?php echo esc_html($header_4_top_bar_email, 'charifund'); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($header_4_top_bar_location) : ?>
                                            <li>
                                                <span class="divider"></span>
                                            </li>
                                            <li>
                                                <span class="fw-600 text-white"><?php echo esc_html($header_4_top_bar_location, 'charifund'); ?></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php if($header_4_top_bar_notice_text) : ?>
                                <div class="col-12 col-xxl-5">
                                    <div class="topbar__extra text-center justify-content-center justify-content-xxl-end">
                                        <p><?php echo esc_html($header_4_top_bar_notice_text, 'charifund'); ?> </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
<?php endif; ?>
<!-- ==== / topbar end ==== -->

<!-- ==== header start ==== -->
<header class="header header-secondary header-four">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-header__menu-box">
                    <nav class="navbar p-0">
                        <div class="navbar-logo"> <?php                               
                     if (has_custom_logo() && empty($header_4_logo['id'])) {
                        the_custom_logo();
                     } elseif (!empty($header_4_logo['id'])) {
                        printf('
							<a href="%1$s">
								<img src="%2$s" alt="%3$s"/>
							</a>', esc_url(get_home_url()), $header_4_logo['url'], $header_4_logo['alt']);
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
                                <div class=" d-none d-xxl-block">
                                    <div class="social">
                                        <?php
                                            if ( ! empty( $header_4_socials_repeater ) && is_array( $header_4_socials_repeater ) ) {
                                                echo '<div class="social">';
                                                foreach ( $header_4_socials_repeater as $item ) {
                                                    if ( ! empty( $item['header_4_socials_icon'] ) && ! empty( $item['header_4_socials_url'] ) ) {
                                                        $icon = esc_attr( $item['header_4_socials_icon'] );
                                                        $url = esc_url( $item['header_4_socials_url'] );
                                                        $platform = ucwords( str_replace( '-', ' ', pathinfo( $url, PATHINFO_FILENAME ) ) );
                                                        
                                                        echo '<a href="' . $url . '" target="_blank" aria-label="Share us on ' . $platform . '" title="' . $platform . '">';
                                                        echo '<i class="' . $icon . '"></i>';
                                                        echo '</a>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php if( $header_4_cart_btn_enabled ): ?> 
                                    <?php if ( class_exists( 'WooCommerce' ) ) : ?> 
                                        <div class="cart-box">
                                            <a href="<?php echo wc_get_cart_url(); ?>" class="open-cart cart" aria-label="cart" title="open cart">
                                                <span><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                                fill="none">
                                                <path
                                                    d="M22.8316 4.54575C22.7002 4.35623 22.4886 4.23909 22.2589 4.22921L8.014 3.61154C7.60529 3.59355 7.26374 3.91097 7.24627 4.3202C7.2289 4.72928 7.54393 5.07492 7.95068 5.0925L21.2312 5.6684L18.6199 13.8641H6.9997L4.90033 2.36513C4.85418 2.1131 4.68218 1.90285 4.44496 1.80923L1.00655 0.450378C0.627594 0.301129 0.199971 0.488375 0.0511428 0.869122C-0.097428 1.25008 0.0886582 1.6805 0.467409 1.83022L3.5247 3.03843L5.66112 14.7392C5.72551 15.091 6.03026 15.3465 6.38594 15.3465H6.74033L5.93108 17.6077C5.86334 17.7971 5.89125 18.0075 6.00652 18.172C6.12163 18.3366 6.30885 18.4345 6.50871 18.4345H7.07632C6.7246 18.8283 6.50871 19.3468 6.50871 19.9169C6.50871 21.1431 7.5005 22.1405 8.71913 22.1405C9.93776 22.1405 10.9296 21.1431 10.9296 19.9169C10.9296 19.3468 10.7137 18.8283 10.362 18.4345H15.1813C14.8294 18.8283 14.6136 19.3468 14.6136 19.9169C14.6136 21.1431 15.6051 22.1405 16.824 22.1405C18.0429 22.1405 19.0344 21.1431 19.0344 19.9169C19.0344 19.3468 18.8186 18.8283 18.4669 18.4345H19.1572C19.4964 18.4345 19.7712 18.158 19.7712 17.8169C19.7712 17.4757 19.4964 17.1992 19.1572 17.1992H7.38235L8.0454 15.3463H19.1572C19.4776 15.3463 19.7611 15.138 19.8587 14.8314L22.9287 5.19574C22.9993 4.97582 22.9631 4.73538 22.8316 4.54575ZM8.71918 20.9054C8.17737 20.9054 7.73674 20.4622 7.73674 19.9172C7.73674 19.3722 8.17737 18.9289 8.71918 18.9289C9.261 18.9289 9.70157 19.3722 9.70157 19.9172C9.70157 20.4622 9.261 20.9054 8.71918 20.9054ZM16.824 20.9054C16.2822 20.9054 15.8416 20.4622 15.8416 19.9172C15.8416 19.3722 16.2822 18.9289 16.824 18.9289C17.3658 18.9289 17.8064 19.3722 17.8064 19.9172C17.8064 20.4622 17.3658 20.9054 16.824 20.9054Z"
                                                    fill="#0A1426" />
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?> 
                                <?php if( $header_4_right_btn_enabled ): ?> <a href="
									<?php echo esc_url($header_4_right_btn_url); ?>" class="btn--secondary d-none d-md-flex"> <?php echo esc_html($header_4_right_btn_text); ?> <i class="fa-solid fa-arrow-right"></i>
                                </a> <?php endif; ?>
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
            if (has_custom_logo() && empty($header_default_logo['id'])) {
               the_custom_logo();
            } elseif (!empty($header_default_logo['id'])) {
               printf('
				<a href="%1$s">
					<img src="%2$s" alt="%3$s"/>
				</a>', esc_url(get_home_url()), $header_default_logo['url'], $header_default_logo['alt']);
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
        <div class="mobile-menu__list"></div> <?php 
         if( $header_default_right_btn_enabled ): ?> <div class="mobile-menu__cta nav-fade d-block d-md-none">
            <a href="
				<?php echo esc_url($header_default_right_btn_url); ?>" class="btn--primary "> <?php echo esc_html($header_default_right_btn_text); ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div> <?php endif; ?> 
        <?php
            if ( ! empty( $header_4_socials_repeater ) && is_array( $header_4_socials_repeater ) ) {
                echo '<div class="social">';
                foreach ( $header_4_socials_repeater as $item ) {
                    if ( ! empty( $item['header_4_socials_icon'] ) && ! empty( $item['header_4_socials_url'] ) ) {
                        $icon = esc_attr( $item['header_4_socials_icon'] );
                        $url = esc_url( $item['header_4_socials_url'] );
                        $platform = ucwords( str_replace( '-', ' ', pathinfo( $url, PATHINFO_FILENAME ) ) );
                        
                        echo '<a href="' . $url . '" target="_blank" aria-label="Share us on ' . $platform . '" title="' . $platform . '">';
                        echo '<i class="' . $icon . '"></i>';
                        echo '</a>';
                    }
                }
                echo '</div>';
            }
        ?>
    </nav>
</div>
<div class="mobile-menu__backdrop"></div>
<!-- ==== / mobile menu end ==== -->