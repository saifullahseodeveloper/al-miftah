<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */

$charifund = charifund();
$post_meta = get_post_meta(get_the_ID(), 'charifund_post_gallery_options', true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$post_single_meta = Charifund_Group_Fields_Value::post_meta('blog_single_post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-single-content-wrap'); ?>>
    <?php
    if (has_post_thumbnail() || !empty($post_meta_gallery)):
        $get_post_format = get_post_format();
        if ('video' == $get_post_format || 'gallery' == $get_post_format) {
            get_template_part('template-parts/content/thumbnail', $get_post_format);
        } else {
            get_template_part('template-parts/content/thumbnail');
        }
    endif;
    ?>
    <div class="entry-content">
        <?php if ('post' == get_post_type()): ?>
            <ul class="post-meta">
                <?php if ($post_single_meta['posted_by']): ?>
                    <li>
                    <i class="fa-regular fa-user"></i>
                        <span><?php echo esc_html('Written by:', 'charifund'); ?></span>
                        <?php $charifund->posted_by(); ?>
                    </li>
                <?php endif; ?>
                <li>
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="date-left-dot"></span>
                    <?php echo get_the_date(); ?>
                </li>
            </ul>
        <?php endif;
        the_content();
        $charifund->link_pages();
        ?>
    </div>
    <?php if ('post' == get_post_type() && ((has_tag() && $post_single_meta['posted_tag']) || (shortcode_exists('charifund_post_share') && $post_single_meta['posted_share']))): ?>
        <div class="blog-details-footer">
            <?php if (has_tag() && $post_single_meta['posted_tag']): ?>
                <div class="left">
                    <h5 class="title"><?php echo esc_html__('Tags:', 'charifund') ?></h5>
                    <?php $charifund->posted_tag(); ?>
                </div>
            <?php endif; ?>
            <?php if (shortcode_exists('charifund_post_share') && $post_single_meta['posted_share']) : ?>
                <div class="right">
                    <h5 class="title"><?php echo esc_html__('Share:', 'charifund') ?></h5>
                    <?php
                    if (shortcode_exists('charifund_post_share') && $post_single_meta['posted_share']) {
                        echo do_shortcode('[charifund_post_share]');
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;
    if ($post_single_meta['next_post_nav_btn'] && $charifund->is_charifund_core_active()) {
        echo wp_kses($charifund->post_navigation(), $charifund->kses_allowed_html('all'));
    }
    if ($charifund->is_charifund_core_active()) {
        if ($post_single_meta['get_related_post']) {
            $charifund->get_related_post([
                'post_type' => 'post',
                'taxonomy' => 'category',
                'exclude_id' => get_the_ID(),
                'posts_per_page' => 2
            ]);
        }
    }
    ?>

</article><!-- #post-<?php the_ID(); ?> -->
