<?php
/**
 * Blog Single Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package charifund
 */

get_header();
$charifund = charifund();
$page_layout_meta = Charifund_Group_Fields_Value::page_layout_options('blog_single');
$full_width_class = $page_layout_meta['content_column_class'] === 'col-lg-12' ? ' full-width-content ' : '';
if ($charifund->is_charifund_core_active()){
    charifund_core()->setPostViews(get_the_ID());
}
?>
    <div id="primary" class="content-area blog-content-page padding-120 <?php echo esc_attr($full_width_class);?>">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($page_layout_meta['content_column_class']);?>">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', 'single' );
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() || get_option( 'thread_comments' )) :
                                comments_template();
                            endif;
                        endwhile; // End of the loop.
                        ?>
                    </div>
                    <?php if ($page_layout_meta['sidebar_enable']): ?>
                        <div class="<?php echo esc_attr($page_layout_meta['sidebar_column_class']);?>">
                            <?php get_sidebar();?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
