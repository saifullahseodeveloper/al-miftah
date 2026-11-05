<?php
/**
 * Header Style 2
 * @package charifund
 * @since 1.0.0
 */
?>

<?php
 $header_2_top_bar_enabled = cs_get_option('header_2_top_bar_enabled'); 
 $header_2_top_bar_contacts_repeater = cs_get_option('header_2_top_bar_contacts_repeater');
 $header_2_top_bar_socials_repeater = cs_get_option('header_2_top_bar_socials_repeater');

 $header_2_logo = cs_get_option('header_2_logo'); 
 $header_2_callus_enabled = cs_get_option('header_2_callus_enabled'); 
 $header_2_callus_title = cs_get_option('header_2_callus_title'); 
 $header_2_callus_text = cs_get_option('header_2_callus_text'); 
 $header_2_callus_url = cs_get_option('header_2_callus_url'); 
 $header_2_search_enabled = cs_get_option('header_2_search_enabled'); 
 $header_2_right_btn_text = cs_get_option('header_2_right_btn_text');
 $header_2_right_btn_url = cs_get_option('header_2_right_btn_url'); 
 $header_2_right_btn_enabled = cs_get_option('header_2_right_btn_enabled'); 

?> 

     <!-- ==== topbar start ==== -->
     <?php 
    if( $header_2_top_bar_enabled ): ?>
     <div class="topbar d-none d-lg-block">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-12 col-lg-6">
                     <div class="topbar__list-wrapper">
                     <?php
                        if ( ! empty( $header_2_top_bar_contacts_repeater ) && is_array( $header_2_top_bar_contacts_repeater ) ) {
                            echo '<ul class="topbar__list">';
                            
                            foreach ( $header_2_top_bar_contacts_repeater as $item ) {
                                // Check if the icon and contact info are set
                                if ( ! empty( $item['header_2_top_bar_icon'] ) && ! empty( $item['header_2_top_bar_info'] ) ) {
                                    // Define the contact info and URL based on the type
                                    $info = esc_html( $item['header_2_top_bar_info'] );
                                    $url  = ! empty( $item['header_2_top_bar_info_url'] ) 
                                            ? esc_url( $item['header_2_top_bar_info_url'] ) 
                                            : ( filter_var( $info, FILTER_VALIDATE_EMAIL ) 
                                                ? 'mailto:' . $info 
                                                : ( filter_var( $info, FILTER_SANITIZE_NUMBER_INT ) 
                                                    ? 'tel:' . $info 
                                                    : '#' ) );

                                    echo '<li>';
                                    // Render icon if available
                                    if ( ! empty( $item['header_2_top_bar_icon'] ) ) {
                                        echo '<a href="' . $url . '"><i class="' . esc_attr( $item['header_2_top_bar_icon'] ) . '"></i> ' . $info . ' </a>';
                                    }                                            
                                    echo '</li>';
                                }
                            }

                            echo '</ul>';
                        }
                        ?>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6">
                        <?php
                        if ( ! empty( $header_2_top_bar_socials_repeater ) && is_array( $header_2_top_bar_socials_repeater ) ) {
                            echo '<div class="social">';
                            foreach ( $header_2_top_bar_socials_repeater as $item ) {
                                if ( ! empty( $item['header_2_top_bar_socials_icon'] ) && ! empty( $item['header_2_top_bar_socials_url'] ) ) {
                                    $icon = esc_attr( $item['header_2_top_bar_socials_icon'] );
                                    $url = esc_url( $item['header_2_top_bar_socials_url'] );
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
         <?php endif; ?>
         <!-- ==== / topbar end ==== -->
         <!-- ==== header start ==== -->
         <header class="header header-primary">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="main-header__menu-box">
                        <nav class="navbar p-0">
                           <div class="navbar-logo">
                           <?php                               
                            if (has_custom_logo() && empty($header_2_logo['id'])) {
                                the_custom_logo();
                            } elseif (!empty($header_2_logo['id'])) {
                                printf('<a href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $header_2_logo['url'], $header_2_logo['alt']);
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
                                <?php 
                                if( $header_2_callus_enabled ): ?>
                                 <div class="contact-btn d-none d-xxl-flex">
                                    <div class="contact-icon">
                                       <i class="fa-solid fa-phone-volume"></i>
                                    </div>
                                    <div class="contact-content">
                                       <p><?php echo esc_html($header_2_callus_title); ?></p>
                                       <a href="tel:<?php echo esc_url($header_2_callus_text); ?>"><?php echo esc_html($header_2_callus_text); ?> </a>
                                    </div>
                                 </div>
                                 <?php endif; ?>
                                 <?php 
                                if( $header_2_search_enabled ): ?>
                                 <div class="search-box">
                                    <button class="open-search" aria-label="search products"
                                       title="open search box">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                 </div>
                                 <?php endif; ?>
                                 <?php 
                                if( $header_2_right_btn_enabled ): ?>
                                 <a href="<?php echo esc_url($header_2_right_btn_url); ?>" class="btn--primary d-none d-md-flex"><?php echo esc_html($header_2_right_btn_text); ?> <i
                                    class="icon-circle-arrow"></i></a>
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
         <div class="mobile-menu d-block d-xl-none" >
            <nav class="mobile-menu__wrapper">
               <div class="mobile-menu__header nav-fade">
                  <div class="logo">
                  <?php                               
                    if (has_custom_logo() && empty($header_2_logo['id'])) {
                        the_custom_logo();
                    } elseif (!empty($header_2_logo['id'])) {
                        printf('<a href="%1$s"><img src="%2$s" alt="%3$s"/></a>', esc_url(get_home_url()), $header_2_logo['url'], $header_2_logo['alt']);
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
                if( $header_2_right_btn_enabled ): ?>
               <div class="mobile-menu__cta nav-fade d-block d-md-none">
                  <a href="<?php echo esc_url($header_2_right_btn_url); ?>" class="btn--primary btn--primary-alt"><?php echo esc_html($header_2_right_btn_text); ?> <i
                     class="icon-circle-arrow"></i></a>
               </div>
               <?php endif; ?>

               <?php
                if ( ! empty( $header_2_top_bar_socials_repeater ) && is_array( $header_2_top_bar_socials_repeater ) ) {
                    echo '<div class="mobile-menu__social social nav-fade">';
                    foreach ( $header_2_top_bar_socials_repeater as $item ) {
                        if ( ! empty( $item['header_2_top_bar_socials_icon'] ) && ! empty( $item['header_2_top_bar_socials_url'] ) ) {
                            $icon = esc_attr( $item['header_2_top_bar_socials_icon'] );
                            $url = esc_url( $item['header_2_top_bar_socials_url'] );
                            
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