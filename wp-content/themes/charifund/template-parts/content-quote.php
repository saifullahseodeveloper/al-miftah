<?php
/**
 * Template part for displaying quote posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-main-item-01 margin-bottom-30'); ?>>
    <?php
    get_template_part('template-parts/content/thumbnail-classic');
    ?>
    <div class="quote-post-type <?php echo !empty(has_post_thumbnail()) ?: 'style-01' ?>">
        <?php
        the_title('<h2 class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        ?>
        <?php
        get_template_part('template-parts/content/post-meta');
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
