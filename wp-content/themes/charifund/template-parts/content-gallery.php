<?php
/**
 * Template part for displaying gallery posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */

$charifund = charifund();
$post_meta = get_post_meta(get_the_ID(),'charifund_post_gallery_options',true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$gallery_image = explode(',',$post_meta_gallery);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-main-item-01 margin-bottom-30'); ?>>

    <?php
    if ( isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ):
        ?>
        <div id="charifund_post_gallery" class="carousel slide thumbnail" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                for ($i =0; $i < count($gallery_image); $i++){
                    $class = 0 == $i ? 'active' : '';
                    printf('<li data-target="#charifund_post_gallery" data-slide-to="%2$s" class="%1$s"></li>',esc_attr($i),esc_attr($class));
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php

                for ($i=0; $i < count($gallery_image); $i++):
                    $class = 0 == $i ? 'active' : '';
                    $img_src = wp_get_attachment_image_src($gallery_image[$i],'charifund_classic');
                    $img_alt = get_post_meta($gallery_image[$i],'wp_attachment_image_alt',true);
                    ?>
                    <div class="carousel-item <?php echo esc_attr($class);?>">
                        <img class="d-block w-100" src="<?php echo esc_url($img_src[0]);?>" alt="<?php echo esc_attr($img_alt);?>">
                    </div>
                <?php endfor; ?>
            </div>
            <a class="carousel-control-prev" href="#charifund_post_gallery" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#charifund_post_gallery" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    <?php
    else:
        if ( has_post_thumbnail() ):
            ?>
            <div class="thumbnail">
                <?php $charifund->post_thumbnail(); ?>
            </div>
        <?php
        endif;
    endif;
    ?>
    <div class="content">
        <?php
        get_template_part('template-parts/content/post-meta');
        the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        get_template_part('template-parts/content/post-excerpt');
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
