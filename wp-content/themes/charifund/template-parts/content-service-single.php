<?php
/**
 * Template part for displaying single service post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */

 $charifund = charifund();
 $img_id = get_post_thumbnail_id(get_the_ID());
 $img_url_val = $img_id ? wp_get_attachment_image_src($img_id, 'charifund_grid_service_12', false) : '';
 $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
 $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

 $comments_count = get_comments_number(get_the_ID());
 $comment_text = ($comments_count > 1) ? 'Comments (' . $comments_count . ')' : 'Comment (' . $comments_count . ')';

 $service_single_meta_data = get_post_meta(get_the_ID(), 'charifund_service_options', true);
 $service_icon = isset($service_single_meta_data['service_icon']) && !empty($service_single_meta_data['service_icon']) ? $service_single_meta_data['service_icon'] : '';
 $service_content = isset($service_single_meta_data['service_content']) && !empty($service_single_meta_data['service_content']) ? $service_single_meta_data['service_content'] : '';
 
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('service-details-item'); ?>>
    <div class="row">
        <div class="col-lg-8 order-lg-last">
            <div class="entry-content">
                <?php
                    the_content();
                ?>
            </div>
        </div>
        <?php
            if(is_active_sidebar('service-sidebar')){ ?>
                <div class="col-lg-4 order-lg-first">
                    <aside class="td-sidebar service-sidebar">
                        <?php dynamic_sidebar('service-sidebar');?>
                    </aside>
                </div>
            <?php }
        ?>
    </div>
</article>