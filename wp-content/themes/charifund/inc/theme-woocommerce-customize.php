<?php

/**
 * Package Charifund
 * @since 1.0.1
 * */

if (!defined('ABSPATH')){
    exit(); //exit if access directly
}
if (!class_exists('Charifund_Woocomerce_Customize')){
    class Charifund_Woocomerce_Customize{
        //$instance variable
        private static $instance;

        public function __construct() {
            //remove woocommerce action
            remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10);
            remove_action('woocommerce_archive_description','woocommerce_product_archive_description',10);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );
            remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


            //add filter for woocomerce page
            add_filter('woocommerce_post_class',array($this,'wc_product_post_class'),20, 3);
            add_filter( 'woocommerce_show_page_title', '__return_false' );
            add_filter( 'woocommerce_enqueue_styles', '__return_false' );

            //add action for woocommerce layout
            add_filter( 'woocommerce_add_to_cart_fragments', array($this,'woocommerce_header_add_to_cart_fragment') );
            add_action('woocommerce_before_shop_loop',array($this,'woocommerce_before_shop_header_wrap_start'),12);
            add_action('woocommerce_before_shop_loop',array($this,'woocommerce_before_shop_header_wrap_end'),32);
            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_thumbnail_wrap_start'),9);

            add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_open',9);
            add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close',10);

            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_ul_start'),11);
            if (defined('YITH_WCQV_VERSION')){
                add_filter('yith_add_quick_view_button_html','__return_false');
                add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_li_quick_view'),11);
            }
            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_li_add_to_cart'),11);
            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_ul_end'),11);
            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_before_shop_loop_item_thumbnail_wrap_end'),12);
            add_action('woocommerce_before_shop_loop_item_title',array($this,'woocommerce_shop_loop_item_content_wrap_start'),14);
            add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_open',15);
            add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_price',6);
            add_action('woocommerce_after_shop_loop_item',array($this,'woocommerce_shop_loop_item_content_wrap_end'),12);
            add_action('woocommerce_before_single_product_summary',array($this,'woocommerce_before_single_product_summary_wrapper_start'),9);
            add_action('woocommerce_before_single_product_summary',array($this,'woocommerce_before_single_product_thumbnail_wrapper_end'),22);
            add_action('woocommerce_after_single_product_summary',array($this,'woocommerce_before_single_product_summary_wrapper_end'),9);
            add_action('woocommerce_before_account_navigation',array($this,'woocommerce_before_account_navigation_wrapper_start'),10);
            add_action('woocommerce_account_content',array($this,'woocommerce_before_account_navigation_wrapper_end'),30);
        }


        /**
         * get Instance
         * @since 1.0.2
         * */
        public static function getInstance(){
            if (null == self::$instance){
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Show cart contents / total Ajax
         * @since 1.0.2
         */
        function woocommerce_header_add_to_cart_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            ?>
            <a class="charifund-header-cart" href="<?php echo wc_get_cart_url(); ?>"
               title="<?php esc_attr_e( 'View your shopping cart','charifund' ); ?>">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                <span class="cart-badge"><?php echo sprintf (  '%d', WC()->cart->get_cart_contents_count() ); ?></span>
            </a>
            <?php
            $fragments['a.charifund-header-cart'] = ob_get_clean();
            return $fragments;
        }

        /**
         * shop header wrap start
         * @since 1.0.2
         * */
        public function woocommerce_before_shop_header_wrap_start(){
            ?>
            <div class="woocommerce-header-area-wrap">
            <?php
        }
        /**
         * shop header wrap end
         * @since 1.0.2
         * */
        public function woocommerce_before_shop_header_wrap_end(){
            ?>
            </div>
            <?php
        }
        /**
         * product class for archive and single page
         * @since 1.0.2
         * */
        public function wc_product_post_class($class){
            $class[] = is_product() ? 'charifund-product-single-page-item' : 'charifund-single-product-item';
            return $class;
        }

        /**
         * add wrapper for thumbnail and sale attribute start
         * @sinsce 1.0.0
         * */
        public function woocommerce_before_shop_loop_item_thumbnail_wrap_start(){
            ?>
            <div class="woocommerce-thumbnail-wrap">
            <?php
        }

        /**
         * add ul after thumbnail wrap start
         * @sinsce 1.0.0
         * */
    public function woocommerce_before_shop_loop_item_ul_start(){
        ?>
        <ul class="charifund-thumb-inner-item-list">
        <?php
    }

        /**
         * add ul after thumbnail wrap start
         * @sinsce 1.0.0
         * */
        public function woocommerce_before_shop_loop_item_li_add_to_cart(){
            ?>
            <li>
                <?php
                $args = ['quantity','class','attributes','icon' =>  '<i class="fas fa-shopping-cart"></i>'];
                global $product;
                echo apply_filters(
                    'charifund_woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
                    sprintf(
                        '<a href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" %s>%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                        $product->get_id(),
                        $product->get_sku(),
                        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button add_to_cart_button ajax_add_to_cart' ),
                        isset( $args['attributes'] ) ? wc_implode_html_attributes($args['attributes']) : '',
                        wp_kses($args['icon'],charifund()->kses_allowed_html('all'))
                    ),
                    $product,
                    $args
                );
                ?>
            </li>
            <?php
        }

        /**
         * add ul after thumbnail wrap start
         * @sinsce 1.0.0
         * */
        public function woocommerce_before_shop_loop_item_li_quick_view(){
            ?>
            <li>
                <?php
                $args = ['quantity','class','attributes','icon' =>  '<i class="far fa-eye"></i>'];
                global $product;
                echo apply_filters(
                    'yith_wcqv_show_quick_view_button', // WPCS: XSS ok.
                    sprintf(
                        '<a href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" %s>%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                        $product->get_id(),
                        $product->get_sku(),
                        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button add_to_cart_button yith-wcqv-button' ),
                        isset( $args['attributes'] ) ? wc_implode_html_attributes($args['attributes']) : '',
                        wp_kses($args['icon'],charifund()->kses_allowed_html('all'))
                    ),
                    $product,
                    $args
                );
                ?>
            </li>
            <?php
        }



        /**
         * add ul after thumbnail wrap end
         * @sinsce 1.0.2
         * */
    public function woocommerce_before_shop_loop_item_ul_end(){
        ?>
        </ul>
        <?php
    }

        /**
         * add wrapper for thumbnail and sale attribute end
         * @sinsce 1.0.2
         * */
        public function woocommerce_before_shop_loop_item_thumbnail_wrap_end(){
            ?>
            </div>
            <?php
        }

        /**
         * add wrapper for title, price and add to cart item
         * @sinsce 1.0.2
         * */
        public function woocommerce_shop_loop_item_content_wrap_start(){
            ?>
            <div class="product-content-wrap">
            <?php
        }

        /**
         * add wrapper for title, price and add to cart item
         * @sinsce 1.0.2
         * */
        public function woocommerce_shop_loop_item_content_wrap_end(){
            ?>
            </div>
            <?php
        }
        /**
         * add wrapper for title, price and add to cart item and product summery for single product page
         * @sinsce 1.0.2
         * */
        public function woocommerce_before_single_product_summary_wrapper_start(){
            ?>
            <div class="woocommmerce-product-single-page-top-content-wrap">
            <div class="woocommerce-thumbnail-wrapper">
            <?php
        }

        /**
         * add wrapper for title, price and add to cart item and product summery for single product page
         * @sinsce 1.0.2
         * */
    public function woocommerce_before_single_product_summary_wrapper_end(){
        ?>
        </div>
        <?php
    }
        /**
         * add wrapper for title, price and add to cart item . single product page thumbnail wrap
         * @sinsce 1.0.2
         * */
        public function woocommerce_before_single_product_thumbnail_wrapper_end(){
            ?>
            </div>
            <?php
        }
        /**
         * add wrapper for my account navigation and content
         * @sinsce 1.0.2
         * */
        public function woocommerce_before_account_navigation_wrapper_start(){
            ?>
            <div class="woocommerce-my-account-page-wrapper">
            <?php
        }
        /**
         * add wrapper for my account navigation and content
         * @sinsce 1.0.2
         * */
        public function woocommerce_before_account_navigation_wrapper_end(){
            ?>
            </div>
            <?php
        }
    }//end class
    if ( class_exists('Charifund_Woocomerce_Customize')){
        Charifund_Woocomerce_Customize::getInstance();
    }
}