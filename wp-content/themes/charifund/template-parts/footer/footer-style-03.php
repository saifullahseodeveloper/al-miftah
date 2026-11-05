<?php
/**
 * Footer Style 03
 * @package charifund
 * @since 1.0.0
 */

$copyright_text = !empty(cs_get_option('copyright_text')) ? cs_get_option('copyright_text'): esc_html__('Copyright © 2025 charifund All Rights Reserved.','charifund');
$copyright_text = str_replace('{copy}','&copy;',$copyright_text);
$copyright_text = str_replace('{year}',date('Y'),$copyright_text);


$footer_3_text = cs_get_option( 'footer_3_text' );
$footer_3_right_btn_enabled = cs_get_option( 'footer_3_right_btn_enabled' );
$footer_3_right_btn_url = cs_get_option( 'footer_3_right_btn_url' );
$footer_3_right_btn_text = cs_get_option( 'footer_3_right_btn_text' );

$footer_3_newsletter_check_text = cs_get_option('footer_3_newsletter_check_text');
$footer_3_menu_title = cs_get_option('footer_3_menu_title');



$footer_3_logo = cs_get_option('footer_3_logo');
$footer_terms = cs_get_option('footer_3_terms_repeater');
$footer_3_socials_repeater = cs_get_option('footer_3_socials_repeater');
$footer_3_about_title = cs_get_option('footer_3_about_title');
$footer_3_about_text = cs_get_option('footer_3_about_text');
$footer_3_about_mail = cs_get_option('footer_3_about_mail');
$footer_3_opening_title = cs_get_option('footer_3_opening_title');
$footer_3_opening_text = cs_get_option('footer_3_opening_text');
$footer_3_blog_title = cs_get_option('footer_3_blog_title');
$footer_3_contact_info_title = cs_get_option('footer_3_contact_info_title');
$footer_contacts = cs_get_option('footer_3_contacts_repeater');
$footer_3_newsletter_title = cs_get_option('footer_3_newsletter_title');
$footer_3_newsletter_text = cs_get_option('footer_3_newsletter_text');
$footer_3_newsletter_shortcodes = cs_get_option( 'footer_3_newsletter_shortcodes' );

?>

    
<footer class="footer-three">
    <div class="container">
        <div class="row gutter-30">
            <div class="col-12 col-lg-3">
                <div class="footer-three__logo" data-aos="fade-up" data-aos-duration="1000">
                <?php if (!empty($footer_3_logo)) { ?>
                    <a href="<?php echo esc_url(home_url('/')) ?>"><img src="<?php echo esc_url($footer_3_logo['url']); ?>" alt="footer-logo"></a>
                <?php } ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="footer-three__inner" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="300">
                <div class="footer__bottom-left">
                    <?php                   
                    if (!empty($footer_terms)) :
                    ?>
                        <ul class="footer__bottom-list justify-content-center justify-content-lg-end">
                            <?php foreach ($footer_terms as $term) : ?>
                                <?php if (!empty($term['footer_3_terms_title']) && !empty($term['footer_3_terms_title_url'])) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($term['footer_3_terms_title_url']); ?>">
                                            <?php echo esc_html($term['footer_3_terms_title']); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php
                    endif;
                    ?>
                </div>
                    <?php                   
                    if (!empty($footer_3_socials_repeater)) : ?>
                        <div class="social">
                            <?php foreach ($footer_3_socials_repeater as $social_item) : 
                                // Retrieve the social icon and URL.
                                $icon_class = isset($social_item['footer_3_socials_icon']) ? esc_attr($social_item['footer_3_socials_icon']) : '';
                                $icon_url = isset($social_item['footer_3_socials_icon_url']) ? esc_url($social_item['footer_3_socials_icon_url']) : '#';

                                // Check if the icon class is not empty.
                                if (!empty($icon_class)) : ?>
                                    <a href="<?php echo esc_url($icon_url); ?>" target="_blank" 
                                    aria-label="share us on <?php echo esc_attr($icon_class); ?>" 
                                    title="<?php echo esc_attr($icon_class); ?>">
                                        <i class="<?php echo esc_attr($icon_class); ?>"></i>
                                    </a>
                                <?php endif; 
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="container">
        <div class="row gutter-80">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="footer-three__widget" data-aos="fade-up" data-aos-duration="1000">
                <div class="footer-two__widget-intro">
                    <h5><?php echo wp_kses_post($footer_3_about_title); ?></h5>
                </div>
                <div class="footer-three__widget-single">
                    <p><?php echo wp_kses_post($footer_3_about_text); ?></p>
                    <p><?php echo wp_kses_post($footer_3_about_mail); ?></p>
                </div>
                <div class="footer-three__widget-alt">
                    <div class="footer-two__widget-intro">
                        <h6 class="title-animation"><?php echo wp_kses_post($footer_3_opening_title); ?></h6>
                    </div>
                    <div class="footer-three__widget-single">
                        <?php echo wp_kses_post($footer_3_opening_text); ?>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="footer-three__widget" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="200">
                <div class="footer-two__widget-intro">
                    <h5><?php echo wp_kses_post($footer_3_blog_title); ?></h5>
                </div>
                    <div class="footer-three__widget-content">
                        <?php
                        // WP_Query to fetch the latest 2 posts.
                        $footer_blog_query = new WP_Query(array(
                            'post_type'      => 'post',  // Fetch blog posts.
                            'posts_per_page' => 2,      // Limit the number of posts.
                            'orderby'        => 'date', // Order by latest date.
                            'order'          => 'DESC', // Descending order.
                        ));

                        if ($footer_blog_query->have_posts()) :
                            while ($footer_blog_query->have_posts()) : $footer_blog_query->the_post(); ?>
                                <div class="footer-three__widget-news">
                                    <div class="thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            // Display the featured image or fallback image.
                                            if (has_post_thumbnail()) :
                                                the_post_thumbnail('thumbnail', array('alt' => get_the_title()));
                                            else : ?>
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog/default.png'); ?>" alt="Default Image">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <p><i class="fa-solid fa-calendar"></i> <?php echo get_the_date(); ?></p>
                                        <p>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </p>
                                    </div>
                                </div>
                            <?php endwhile; 
                            wp_reset_postdata(); // Reset query data.
                        else : ?>
                            <p><?php esc_html_e('No recent posts available.', 'charifund'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="footer-three__widget footer-three__widget-alter" data-aos="fade-up"
                data-aos-duration="1000" data-aos-delay="400">
                <div class="footer-two__widget-intro">
                    <h5><?php echo wp_kses_post($footer_3_contact_info_title); ?></h5>
                </div>
                    <div class="footer-three__widget-content">
                        <?php                        
                        if (!empty($footer_contacts)) :
                            foreach ($footer_contacts as $contact) :
                                $icon = isset($contact['footer_3_contacts_icon']) ? esc_attr($contact['footer_3_contacts_icon']) : 'fa-solid fa-question-circle';
                                $title = isset($contact['footer_3_contacts_title']) ? esc_html($contact['footer_3_contacts_title']) : '';
                                $subtitle = isset($contact['footer_3_contacts_subtitle']) ? esc_html($contact['footer_3_contacts_subtitle']) : '';
                                $url = isset($contact['footer_3_contacts_subtitle_url']) ? esc_url($contact['footer_3_contacts_subtitle_url']) : '#';
                                ?>
                                <div class="single-address">
                                    <div class="thumb">
                                        <i class="<?php echo esc_attr($icon); ?>"></i>
                                    </div>
                                    <div class="content">
                                        <p><?php echo esc_html($title); ?></p>
                                        <p>
                                            <a href="<?php echo esc_url($url); ?>" target="_blank"><?php echo esc_html($subtitle); ?></a>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach;
                        else : ?>
                            <p><?php esc_html_e('No contact information available.', 'charifund'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="footer-three__widget footer-three__widget--newsletter" data-aos="fade-up"
                data-aos-duration="1000" data-aos-delay="600">
                <div class="footer-two__widget-intro">
                    <h5><?php echo wp_kses_post($footer_3_newsletter_title); ?></h5>
                </div>
                <div class="footer-three__widget-content">
                    <p><?php echo wp_kses_post($footer_3_newsletter_text); ?></p>
                    
                    <?php
                    if (!empty($footer_3_newsletter_shortcodes)) :
                        echo do_shortcode($footer_3_newsletter_shortcodes);
                    endif;
                    ?>        

                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-two__copyright">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-two__copyright-inner text-center">
                        <p>
                        <?php
                            echo wp_kses($copyright_text, charifund()->kses_allowed_html(array('a')));
                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </footer>