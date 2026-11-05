<?php
/**
 * Post Meta Functions
 * @package charifund
 * @since 1.0.0
 */

$charifund = charifund();
$post_meta = Charifund_Group_Fields_Value::post_meta('blog_post');
?>
<div class="post-meta-wrap">
    <div class="row">
        <div class="col-lg-6 align-self-center">
            <ul class="post-meta">
            <?php
                if ($post_meta['posted_by']) { ?>
                    <li>
                        <span><?php echo esc_html('Written by:', 'charifund'); ?></span>
                        <?php $charifund->posted_by(); ?>
                    </li>
                <?php }
                ?>
                <li>
                    <span class="date-left-dot"></span>
                    <?php echo get_the_date(); ?>
                </li>
            </ul>
        </div>

        <?php
        if ($post_meta['posted_cat']) {

            if (has_category()) : ?>
                <div class="col-lg-6 text-sm-end text-left pt-2 pt-sm-0">
                    <div class="blog-cat-list">
                        <?php the_category(' ', '') ?>
                    </div>
                </div>
            <?php endif;

        }
        ?>
        
    </div>
</div>