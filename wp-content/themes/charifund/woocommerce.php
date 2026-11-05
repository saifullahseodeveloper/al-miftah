<?php
/**
 * The template for displaying WooCommerce products
 * @package charifund
 * @since 1.0.0
 */

get_header();
$page_layout_meta = Charifund_Group_Fields_Value::page_layout_options('product_shop');
$full_width_class = $page_layout_meta['content_column_class'] === 'col-lg-12' ? ' full-width-content ' : '';
$page_class = is_product() ? 'woocommerce-single-product-page-content-area' : 'woocommerce-page-content-area';
?>
    <div id="primary" class="content-area <?php echo esc_attr($page_class); ?> padding-top-120 padding-bottom-120">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($page_layout_meta['content_column_class']); ?>">
                        <div class="wc-page-content-inner">
                            <?php woocommerce_content(); ?>
                        </div>
                    </div>
                    <?php if ($page_layout_meta['sidebar_enable']): ?>
                        <div class="<?php echo esc_attr($page_layout_meta['sidebar_column_class']); ?>">
                            <?php
                            if (is_active_sidebar('product-sidebar')) {
                                dynamic_sidebar('product-sidebar');
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
