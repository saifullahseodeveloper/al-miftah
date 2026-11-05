<?php
/**
 * Footer Style 02
 * @package charifund
 * @since 1.0.0
 */

$copyright_text = !empty(cs_get_option('copyright_text')) ? cs_get_option('copyright_text'): esc_html__('Copyright © 2025 charifund All Rights Reserved.','charifund');
$copyright_text = str_replace('{copy}','&copy;',$copyright_text);
$copyright_text = str_replace('{year}',date('Y'),$copyright_text);


$footer_2_text = cs_get_option( 'footer_2_text' );
$footer_2_right_btn_enabled = cs_get_option( 'footer_2_right_btn_enabled' );
$footer_2_right_btn_url = cs_get_option( 'footer_2_right_btn_url' );
$footer_2_right_btn_text = cs_get_option( 'footer_2_right_btn_text' );
$footer_2_newsletter_title = cs_get_option('footer_2_newsletter_title');
$footer_2_newsletter_text = cs_get_option('footer_2_newsletter_text');
$footer_2_newsletter_shortcodes = cs_get_option( 'footer_2_newsletter_shortcodes' );
$footer_2_newsletter_check_text = cs_get_option('footer_2_newsletter_check_text');
$footer_2_menu_title = cs_get_option('footer_2_menu_title');
$footer_2_logo = cs_get_option('footer_2_logo');


?>

    <footer class="footer">
        <div class="footer__inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer__intro">
                            <div class="row align-items-center justify-content-center gutter-30">
                                <div class="col-12 col-sm-8 col-lg-5 col-xl-6">
                                    <div class="footer__content">
                                    <h3 class="title-animation">
                                        <?php
                                            if (!empty($footer_2_text)) {
                                                echo wp_kses_post($footer_2_text);
                                            }                                
                                        ?>
                                    </h3>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7 col-xl-6">
                                    <?php 
                                    if( $footer_2_right_btn_enabled ): ?>
                                    <div class="footer__support" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="300">
                                    <a href="<?php echo esc_url($footer_2_right_btn_url); ?>">
                                        <?php echo wp_kses_post($footer_2_right_btn_text); ?>
                                    </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gutter-60">
                    <div class="col-12 col-xl-6">
                    <div class="footer__newsletter" data-aos="fade-up" data-aos-duration="1000">
                        <div class="footer__newsletter-info">
                            <h4 class="title-animation"><?php echo wp_kses_post($footer_2_newsletter_title); ?></h4>
                            <p><?php echo wp_kses_post($footer_2_newsletter_text); ?> </p>
                        </div>
                        <div class="footer__newsletter-form">                            
                         <?php

                            if (!empty($footer_2_newsletter_shortcodes)) :
                                echo do_shortcode($footer_2_newsletter_shortcodes); // Apply shortcode without escaping it.
                            endif;
                            ?>
                        </div>
                        <div class="footer__newsletter-check">
                            <div class="form-group">
                                <input type="checkbox" id="acceptPolicy">
                                <label for="acceptPolicy"><?php echo wp_kses_post($footer_2_newsletter_check_text); ?></label>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-2 offset-xl-1">
                    <div class="footer__list" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <div class="footer__list-intro">
                            <h5 class="title-animation"><?php echo wp_kses_post($footer_2_menu_title); ?></h5>
                        </div>
                        <div class="footer__list-items">
                        <?php
                        $footer_2_menu_repeater = cs_get_option('footer_2_menu_repeater');
                        if (!empty($footer_2_menu_repeater)) : ?>
                            <ul>
                                <?php foreach ($footer_2_menu_repeater as $menu_item) : 
                                    $menu_title = isset($menu_item['footer_2_menu_title']) ? esc_html($menu_item['footer_2_menu_title']) : '';
                                    $menu_url = isset($menu_item['footer_2_menu_title_url']) ? esc_url($menu_item['footer_2_menu_title_url']) : '#';
                                    if (!empty($menu_title)) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($menu_url); ?>">
                                                <i class="fa-solid fa-angles-right"></i><?php echo esc_html($menu_title); ?>
                                            </a>
                                        </li>
                                    <?php endif; 
                                endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                    <?php
                        $footer_contacts = cs_get_option('footer_2_contacts_repeater');
                        if (!empty($footer_contacts)) :
                        ?>
                            <div class="footer__list" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                                <?php foreach ($footer_contacts as $contact) : ?>
                                    <div class="footer__list-group">
                                        <div class="footer__list-intro">
                                            <?php if (!empty($contact['footer_2_contacts_title'])) : ?>
                                                <h5 class="title-animation"><?php echo esc_html($contact['footer_2_contacts_title']); ?></h5>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <?php if (!empty($contact['footer_2_contacts_subtitle']) && !empty($contact['footer_2_contacts_subtitle_url'])) : ?>
                                                <p>
                                                    <a href="<?php echo esc_url($contact['footer_2_contacts_subtitle_url']); ?>" target="_blank">
                                                        <?php echo esc_html($contact['footer_2_contacts_subtitle']); ?>
                                                    </a>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
                <div class="footer__copyright">
                    <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer__copyright-inner">
                                <div class="row align-items-center gutter-24">
                                <div class="col-12 col-xl-3">
                                    <div class="footer__copyright-logo text-center text-xl-start">
                                    <?php if (!empty($footer_2_logo)) { ?>
                                        <a href="<?php echo esc_url(home_url('/')) ?>"><img src="<?php echo esc_url($footer_2_logo['url']); ?>" alt="footer-logo"></a>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="footer__bottom-right text-center">
                                        <p>
                                        <?php
                                            echo wp_kses($copyright_text, charifund()->kses_allowed_html(array('a')));
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-3">
                                    <div class="footer__bottom-left">
                                    <?php
                                    $footer_terms = cs_get_option('footer_2_terms_repeater');
                                    if (!empty($footer_terms)) :
                                    ?>
                                        <ul class="footer__bottom-list justify-content-center justify-content-xl-end">
                                            <?php foreach ($footer_terms as $term) : ?>
                                                <?php if (!empty($term['footer_2_terms_title']) && !empty($term['footer_2_terms_title_url'])) : ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($term['footer_2_terms_title_url']); ?>">
                                                            <?php echo esc_html($term['footer_2_terms_title']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php
                                    endif;
                                    ?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </footer>