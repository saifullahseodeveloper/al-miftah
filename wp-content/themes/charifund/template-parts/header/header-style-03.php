<?php
/**
 * Header Style 3
 * @package charifund
 * @since 1.0.0
 */
?>

<?php
 $header_3_top_bar_enabled = cs_get_option('header_3_top_bar_enabled'); 
 $header_3_top_bar_contacts_repeater = cs_get_option('header_3_top_bar_contacts_repeater');
 $header_3_top_bar_socials_repeater = cs_get_option('header_3_top_bar_socials_repeater');

 $header_3_top_bar_phone_icon = cs_get_option('header_3_top_bar_phone_icon');
 $header_3_top_bar_phone_text = cs_get_option('header_3_top_bar_phone_text');
 $header_3_top_bar_phone_url = cs_get_option('header_3_top_bar_phone_url');

 $header_3_logo = cs_get_option('header_3_logo'); 
 $header_3_search_enabled = cs_get_option('header_3_search_enabled'); 
 $header_3_right_btn_text = cs_get_option('header_3_right_btn_text');
 $header_3_right_btn_url = cs_get_option('header_3_right_btn_url'); 
 $header_3_right_btn_enabled = cs_get_option('header_3_right_btn_enabled'); 
 $header_3_cart_btn_enabled = cs_get_option('header_3_cart_btn_enabled'); 
?> 


     <!-- ==== topbar start ==== -->
     <?php 
    if( $header_3_top_bar_enabled ): ?>
     <div class="topbar topbar--tertiary d-none d-lg-block">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="topbar__inner">
                        <div class="row align-items-center">
                           <div class="col-12 col-lg-7">
                              <div class="topbar__list-wrapper">
                              <?php
                                if ( ! empty( $header_3_top_bar_contacts_repeater ) && is_array( $header_3_top_bar_contacts_repeater ) ) {
                                    echo '<ul class="topbar__list">';
                                    
                                    foreach ( $header_3_top_bar_contacts_repeater as $item ) {
                                        // Check if the icon and contact info are set
                                        if ( ! empty( $item['header_3_top_bar_icon'] ) && ! empty( $item['header_3_top_bar_info'] ) ) {
                                            // Define the contact info and URL based on the type
                                            $info = esc_html( $item['header_3_top_bar_info'] );
                                            $url  = ! empty( $item['header_3_top_bar_info_url'] ) 
                                                    ? esc_url( $item['header_3_top_bar_info_url'] ) 
                                                    : ( filter_var( $info, FILTER_VALIDATE_EMAIL ) 
                                                        ? 'mailto:' . $info 
                                                        : ( filter_var( $info, FILTER_SANITIZE_NUMBER_INT ) 
                                                            ? 'tel:' . $info 
                                                            : '#' ) );

                                            echo '<li>';
                                            // Render icon if available
                                            if ( ! empty( $item['header_3_top_bar_icon'] ) ) {
                                                echo '<a href="' . $url . '"><i class="' . esc_attr( $item['header_3_top_bar_icon'] ) . '"></i> ' . $info . ' </a>';
                                            }                                            
                                            echo '</li>';
                                        }
                                    }

                                    echo '</ul>';
                                }
                                ?>
                              </div>
                           </div>
                           <div class="col-12 col-lg-5">
                              <div class="topbar__items justify-content-end">

                              <?php
                                if (!empty($header_3_top_bar_phone_icon) && !empty($header_3_top_bar_phone_text) && !empty($header_3_top_bar_phone_url)) {
                                    echo '<p>';
                                    echo '<a href="' . esc_url($header_3_top_bar_phone_url) . '">';
                                    echo '<i class="' . esc_attr($header_3_top_bar_phone_icon) . '"></i> ' . esc_html($header_3_top_bar_phone_text);
                                    echo '</a>';
                                    echo '</p>';
                                }
                                ?>

                                 <?php
                                if ( ! empty( $header_3_top_bar_socials_repeater ) && is_array( $header_3_top_bar_socials_repeater ) ) {
                                    echo '<div class="social">';
                                    foreach ( $header_3_top_bar_socials_repeater as $item ) {
                                        if ( ! empty( $item['header_3_top_bar_socials_icon'] ) && ! empty( $item['header_3_top_bar_socials_url'] ) ) {
                                            $icon = esc_attr( $item['header_3_top_bar_socials_icon'] );
                                            $url = esc_url( $item['header_3_top_bar_socials_url'] );
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
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php endif; ?>
         <!-- ==== / topbar end ==== -->
         <!-- ==== header start ==== -->
         <header class="header header-tertiary position-relative">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="main-header__menu-box">
                        <nav class="navbar p-0">
                           <div class="navbar-logo">
                           <?php                               
                            if (has_custom_logo() && empty($header_3_logo['id'])) {
                                the_custom_logo();
                            } elseif (!empty($header_3_logo['id'])) {
                                printf('<a href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $header_3_logo['url'], $header_3_logo['alt']);
                            } else {
                                printf('<a class="d-inline-block site-title" href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                            }
                            ?>
                           </div>
                           <div class="navbar__menu d-none d-xl-block">
                            <?php
                                wp_nav_menu(array(
                                    'theme_location'  => 'main-menu',
                                    'menu_class'      => 'navbar__list',
                                    'container'       => 'div',
                                    'container_id'    => 'charifund_main_menu',
                                    'fallback_cb'     => 'charifund_theme_fallback_menu',
                                    'walker'          => new Custom_Menu_Walker(),
                                ));
                            ?>
                           </div>
                           <div class="navbar__options">
                              <div class="navbar__mobile-options ">
                                 <div class="sidenav-box d-none d-xl-block">
                                    <button class="open-sidenav" aria-label="sidenav" title="open sidenav">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="28" height="26"
                                          viewBox="0 0 28 26" fill="none">
                                          <ellipse cx="2.39023" cy="2.39022" rx="2.39023" ry="2.39022"
                                             fill="#FFC107" />
                                          <ellipse cx="13.9146" cy="2.39022" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="25.44" cy="2.39022" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="2.39023" cy="12.6334" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="13.9146" cy="12.6344" rx="2.39023" ry="2.39022"
                                             fill="#FFC107" />
                                          <ellipse cx="25.44" cy="12.6344" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="2.39023" cy="23.0484" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="13.9996" cy="23.0484" rx="2.39023" ry="2.39022"
                                             fill="black" />
                                          <ellipse cx="25.61" cy="23.0484" rx="2.39023" ry="2.39022"
                                             fill="#FFC107" />
                                       </svg>
                                    </button>
                                 </div>

                                <?php 
                                if( $header_3_right_btn_enabled ): ?>
                                 <a href="<?php echo esc_url($header_3_right_btn_url); ?>" class="btn--secondary d-none d-md-flex"><?php echo esc_html($header_3_right_btn_text); ?><i class="fa-solid fa-arrow-right"></i></a>
                                <?php endif; ?>

                              </div>
                              <button class="open-offcanvas-nav d-flex d-xl-none" aria-label="toggle mobile menu"
                                 title="open offcanvas menu">
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
         <div class="mobile-menu d-block d-xxl-none" >
            <nav class="mobile-menu__wrapper">
               <div class="mobile-menu__header nav-fade">
                  <div class="logo">
                  <?php                               
                    if (has_custom_logo() && empty($header_3_logo['id'])) {
                        the_custom_logo();
                    } elseif (!empty($header_3_logo['id'])) {
                        printf('<a href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $header_3_logo['url'], $header_3_logo['alt']);
                    } else {
                        printf('<a class="d-inline-block site-title" href="%1$s">%2$s</a>', esc_url(get_home_url()), esc_html(get_bloginfo('title')));
                    }
                    ?>
                  </div>
                  <button aria-label="close mobile menu" class="close-mobile-menu">
                  <i class="fa-solid fa-xmark"></i>
                  </button>
               </div>
               <div class="mobile-menu__list"></div>
               <?php 
                if( $header_3_right_btn_enabled ): ?>
               <div class="mobile-menu__cta nav-fade d-block d-md-none">
                  <a href="<?php echo esc_url($header_3_right_btn_url); ?>" class="btn--primary "><?php echo esc_html($header_3_right_btn_text); ?> <i
                     class="fa-solid fa-arrow-right"></i></a>
               </div>
               <?php endif; ?>

               <?php
                if ( ! empty( $header_default_top_bar_socials_repeater ) && is_array( $header_default_top_bar_socials_repeater ) ) {
                    echo '<div class="mobile-menu__social social nav-fade">';
                    foreach ( $header_default_top_bar_socials_repeater as $item ) {
                        if ( ! empty( $item['header_default_top_bar_socials_icon'] ) && ! empty( $item['header_default_top_bar_socials_url'] ) ) {
                            $icon = esc_attr( $item['header_default_top_bar_socials_icon'] );
                            $url = esc_url( $item['header_default_top_bar_socials_url'] );
                            
                            // Extract platform name for aria-label and title
                            $parsed_url = parse_url( $url );
                            $platform = isset( $parsed_url['host'] ) ? ucwords( str_replace( 'www.', '', parse_url( $url, PHP_URL_HOST ) ) ) : 'Platform';
                            $platform = str_replace( '.com', '', $platform );

                            echo '<a href="' . $url . '" target="_blank" aria-label="Share us on ' . strtolower( $platform ) . '" title="' . strtolower( $platform ) . '">';
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