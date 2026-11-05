<?php
/**
 * The template for displaying 404 Error page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package charifund
 */

get_header();
$get_404_options_value = Charifund_Group_Fields_Value::get_404_options_value();
$error_bg_switch = cs_get_option('error_bg_switch');
$error_bg = cs_get_option('error_bg');
?>

    <section class="error">
        <div class="container">
            <div class="row justify-content-center">
               <div class="col-12 col-xl-7">
                    <div class="error__content text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <?php
                        if (!empty($error_bg_switch) && !empty($error_bg)) : ?>
                            <div class="thumb">
                                <img src="<?php echo esc_url($error_bg['url']); ?>" alt="<?php echo esc_attr($error_bg['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <h3 class="title-animation">
                            <?php echo esc_html($get_404_options_value['title']); ?>
                        </h2>
                        <p><?php echo esc_html($get_404_options_value['paragraph']); ?></p>
                        <div class="cta">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn--primary" data-wow-delay=".8s">
                                <?php echo esc_html($get_404_options_value['btn_text']); ?>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();
