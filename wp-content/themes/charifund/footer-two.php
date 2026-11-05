<?php
/**
 * Theme Footer Template
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package charifund
 */

 $copyright_text = !empty(cs_get_option('copyright_text')) ? cs_get_option('copyright_text'): esc_html__('Copyright © 2025 charifund All Rights Reserved.','charifund');
 $copyright_text = str_replace('{copy}','&copy;',$copyright_text);
 $copyright_text = str_replace('{year}',date('Y'),$copyright_text);
 
 $footer_default_newsletter_enabled = cs_get_option('footer_default_newsletter_enabled');
 $footer_default_newsletter_title = cs_get_option('footer_default_newsletter_title');
 $footer_default_newsletter_text = cs_get_option('footer_default_newsletter_text');
 $footer_default_newsletter_shortcode = cs_get_option( 'footer_default_newsletter_shortcode' );
 $footer_default_contact_title = cs_get_option( 'footer_default_contact_title' );
 $footer_default_logo = cs_get_option( 'footer_default_logo' );
 $footer_default_text = cs_get_option( 'footer_default_text' );
 
 $footer_default_bg_shape = cs_get_option('footer_default_bg_shape');
 if (isset($footer_default_bg_shape['url']) && !empty($footer_default_bg_shape['url'])) {
     $background_image_url = esc_url($footer_default_bg_shape['url']);
 } else {
     $background_image_url = '';
 }
 
 $footer_default_bg_shape_2 = cs_get_option('footer_default_bg_shape_2');
 if (isset($footer_default_bg_shape_2['url']) && !empty($footer_default_bg_shape_2['url'])) {
     $background_image_url_2 = esc_url($footer_default_bg_shape_2['url']);
 } else {
     $background_image_url_2 = '';
 }
 
 ?>
 
 <footer class="footer-two">
     <?php if ( in_array( 'charifund-core/charifund-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
     <div class="container">
         <?php if ($footer_default_newsletter_enabled) : ?>
         <div class="row align-items-center gutter-30">
             <div class="col-12 col-lg-7 col-xxl-6">
                 <div class="footer-two__newsletter-content">
                 <h3 class="title-animation">
                     <?php echo esc_html($footer_default_newsletter_title); ?>
                 </h3>
                 <p>
                 <?php
                 if (!empty($footer_default_newsletter_text)) {
                     echo wp_kses_post($footer_default_newsletter_text);
                 }                                
                 ?>
                 </p>
                 </div>
             </div>
             <div class="col-12 col-lg-5 col-xxl-5 offset-xxl-1">
                 <div class="footer-two__newsletter-form">
                     <?php                  
                     if (!empty($footer_default_newsletter_shortcode)) : ?>
                         <?php echo do_shortcode(esc_html($footer_default_newsletter_shortcode)); ?>
                     <?php endif; ?>
                 </div>
             </div>
         </div>
         <?php endif; ?>
         <div class="row">
             <div class="col-12">
                 <hr class="divider">
             </div>
         </div>
         <div class="row gutter-60">
             <div class="col-12 col-md-6 col-xl-3">
                 <div class="footer-two__widget" data-aos="fade-up" data-aos-duration="1000">
                 <div class="footer-two__widget-logo">
                     <?php if (!empty($footer_default_logo)) { ?>
                         <a href="<?php echo esc_url(home_url('/')) ?>"><img src="<?php echo esc_url($footer_default_logo['url']); ?>" alt="footer-logo"></a>
                     <?php } ?>
                 </div>
                 <div class="footer-two__widget-content">
                     <p>
                     <?php
                         if (!empty($footer_default_text)) {
                             echo wp_kses_post($footer_default_text);
                         }                                
                     ?>
                     </p>
 
                     <?php
                     $socials = cs_get_option('footer_default_socials_repeater');
                     if (!empty($socials)) {
                         echo '<div class="social">';
                         foreach ($socials as $social) {
                             $icon = isset($social['footer_default_socials_icon']) ? esc_attr($social['footer_default_socials_icon']) : '';
                             $url = isset($social['footer_default_socials_icon_url']) ? esc_url($social['footer_default_socials_icon_url']) : '#';
                             $aria_label = !empty($icon) ? 'share us on ' . str_replace('fa-', '', $icon) : 'social link';
 
                             echo '<a href="' . $url . '" target="_blank" aria-label="' . esc_attr($aria_label) . '" title="' . esc_attr($aria_label) . '">';
                             echo '<i class="' . $icon . '"></i>';
                             echo '</a>';
                         }
                         echo '</div>';
                     }
                     ?>
                 </div>
                 </div>
             </div>
             <div class="col-12 col-md-6 col-xl-2 offset-xl-1">
 
                 <!-- footer menu -->
                 <?php get_template_part('template-parts/content/footer-widget'); ?> 
 
             </div>
             <div class="col-12 col-md-6 col-xl-3">
             
              <!-- footer menu 2 -->
              <?php get_template_part('template-parts/content/footer-widget-two'); ?>
 
             </div>
             <div class="col-12 col-md-6 col-xl-3">
                 <div class="footer-two__widget footer-two__widget--alternate" data-aos="fade-up"
                 data-aos-duration="1000" data-aos-delay="600">
                 <div class="footer-two__widget-intro">
                     <h5><?php echo esc_html($footer_default_contact_title); ?></h5>
                     <div class="line">
                         <span class="large-line"></span>
                         <span class="small-line"></span>
                         <span class="small-line"></span>
                     </div>
                 </div>
                 <div class="footer-two__widget-content footer-two__widget-content--contact">
                     <?php
                     $contacts = cs_get_option('footer_default_contacts_repeater');
 
                     if (!empty($contacts)) {
                         echo '<ul>';
                         foreach ($contacts as $contact) {
                             // Get icon, title, and URL
                             $icon = isset($contact['footer_default_contacts_icon']) ? esc_attr($contact['footer_default_contacts_icon']) : '';
                             $title = isset($contact['footer_default_contacts_title']) ? esc_html($contact['footer_default_contacts_title']) : '';
                             $url = isset($contact['footer_default_contacts_title_url']) ? esc_url($contact['footer_default_contacts_title_url']) : '#';
 
                             // Generate list item
                             echo '<li>';
                             echo '<a href="' . $url . '" target="_blank">';
                             echo '<i class="' . $icon . '"></i>' . $title;
                             echo '</a>';
                             echo '</li>';
                         }
                         echo '</ul>';
                     }
                     ?>
                 </div>
                 </div>
             </div>
         </div>
     </div>
     <?php endif; ?>
     
     <div class="footer-two__copyright">
         <div class="container">
             <div class="row align-items-center gutter-12">
                 <div class="col-12 col-lg-6">
                 <div class="footer-two__copyright-inner text-center text-lg-start">
                     <p>
                     <?php
                         echo wp_kses($copyright_text, charifund()->kses_allowed_html(array('a')));
                     ?>
                     </p>
                 </div>
                 </div>
                 <div class="col-12 col-lg-6">
                 <div class="footer__bottom-left">
                     <?php
                     $terms = cs_get_option('footer_default_terms_repeater');
 
                     if (!empty($terms)) {
                         echo '<ul class="footer__bottom-list justify-content-center justify-content-lg-end">';
                         foreach ($terms as $term) {
                             // Get title and URL
                             $title = isset($term['footer_default_terms_title']) ? esc_html($term['footer_default_terms_title']) : '';
                             $url = isset($term['footer_default_terms_title_url']) ? esc_url($term['footer_default_terms_title_url']) : '#';
 
                             // Generate list item
                             echo '<li>';
                             echo '<a href="' . $url . '">' . $title . '</a>';
                             echo '</li>';
                         }
                         echo '</ul>';
                     }
                     ?>
                 </div>
                 </div>
             </div>
         </div>
     </div>
 
     <div class="sprade" data-aos="zoom-in" data-aos-duration="1000">
         <img src="<?php echo esc_url($background_image_url); ?>" alt="" class="base-img">
     </div>
     <div class="sprade-light" data-aos="zoom-in" data-aos-duration="1000">
         <img src="<?php echo esc_url($background_image_url_2); ?>" alt="">
     </div>
 
     </footer>

<?php wp_footer(); ?>

</body>
</html>
