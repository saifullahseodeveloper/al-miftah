<?php
/**
 * Theme Post excerpt Template
 * @package charifund
 * @since 1.0.0
 */

$charifund = charifund();
$post_meta = Charifund_Group_Fields_Value::post_meta('blog_post');
$excerpt_length = !empty($post_meta['excerpt_length']) ? $post_meta['excerpt_length'] : 55;
$readmore_text = !empty($post_meta['readmore_btn_text']) ? $post_meta['readmore_btn_text'] : esc_html__('Read More','charifund');


Charifund_Excerpt($excerpt_length);
?>
<div class="blog-bottom mt-3">
<?php
    if ($post_meta['readmore_btn']) {
        printf(
            '<div class="btn-wrap"><a href="%1$s" class="theme-btn">%2$s <i class="fa-solid fa-arrow-right p1-clr"></i></a></div>',
            esc_url(get_the_permalink()),
            esc_html($readmore_text)
        );
    }
    ?>
</div>