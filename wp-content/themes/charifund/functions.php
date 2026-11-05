<?php
/**
 * Theme functions & definitations
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package charifund
 */

/**
 * Define Theme Folder Path & URL Constant
 * @package charifund
 * @since 1.0.0
 */

define('CHARIFUND_THEME_ROOT', get_template_directory());
define('CHARIFUND_THEME_ROOT_URL', get_template_directory_uri());
define('CHARIFUND_INC', CHARIFUND_THEME_ROOT . '/inc');
define('CHARIFUND_THEME_SETTINGS', CHARIFUND_INC . '/theme-settings');
define('CHARIFUND_THEME_SETTINGS_IMAGES', CHARIFUND_THEME_ROOT_URL . '/inc/theme-settings/images');
define('CHARIFUND_TGMA', CHARIFUND_INC . '/plugins/tgma');
define('CHARIFUND_DYNAMIC_STYLESHEETS', CHARIFUND_INC . '/theme-stylesheets');
define('CHARIFUND_CSS', CHARIFUND_THEME_ROOT_URL . '/assets/css');
define('CHARIFUND_JS', CHARIFUND_THEME_ROOT_URL . '/assets/js');
define('CHARIFUND_ASSETS', CHARIFUND_THEME_ROOT_URL . '/assets');
define('CHARIFUND_DEV', true);


/**
 * Theme Initial File
 * @package charifund
 * @since 1.0.0
 */
if (file_exists(CHARIFUND_INC . '/theme-init.php')) {
    require_once CHARIFUND_INC . '/theme-init.php';
}


/**
 * Codester Framework Functions
 * @package charifund
 * @since 1.0.0
 */
if (file_exists(CHARIFUND_INC . '/theme-cs-function.php')) {
    require_once CHARIFUND_INC . '/theme-cs-function.php';
}


/**
 * Theme Helpers Functions
 * @package charifund
 * @since 1.0.0
 */
if (file_exists(CHARIFUND_INC . '/theme-helper-functions.php')) {

    require_once CHARIFUND_INC . '/theme-helper-functions.php';
    if (!function_exists('charifund')) {
        function charifund()
        {
            return class_exists('Charifund_Helper_Functions') ? new Charifund_Helper_Functions() : false;
        }
    }
}
/**
 * Nav menu fallback function
 * @since 1.0.0
 */
if (is_user_logged_in()) {
    function charifund_theme_fallback_menu()
    {
        get_template_part('template-parts/default', 'menu');
    }
}

// theme-color

if (file_exists(CHARIFUND_INC . '/theme-color.php')) {
    require_once CHARIFUND_INC . '/theme-color.php';
}

// register_block_style

function charifund_register_block_styles() {
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'fancy-paragraph',
            'label' => __( 'Fancy Paragraph', 'charifund' ),
        )
    );
}
add_action( 'init', 'charifund_register_block_styles' );


// register_block_pattern

function charifund_register_block_patterns() {
    register_block_pattern(
        'charifund/hero-section',
        array(
            'title'       => __( 'Hero Section', 'charifund' ),
            'description' => _x( 'A custom hero section with image and text', 'Block pattern description', 'charifund' ),
            'content'     => '<!-- wp:paragraph --><p>Your content here...</p><!-- /wp:paragraph -->',
        )
    );
}
add_action( 'init', 'charifund_register_block_patterns' );


// custom-header

function charifund_custom_header_setup() {
    add_theme_support( 'custom-header', array(
        'default-image' => get_template_directory_uri() . '/inc/theme-settings/images/header/00.png',
        'width'         => 1000,
        'height'        => 250,
        'flex-width'    => true,
        'flex-height'   => true,
    ) );
}
add_action( 'after_setup_theme', 'charifund_custom_header_setup' );


// custom-background

function charifund_custom_background_setup() {
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
}
add_action( 'after_setup_theme', 'charifund_custom_background_setup' );


// header menu walker

class Custom_Menu_Walker extends Walker_Nav_Menu {
    // Start Level (add class to <ul>)
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $classes = $depth === 0 ? 'navbar__sub-menu' : 'navbar__sub-menu navbar__sub-menu__nested';
        $output .= "\n$indent<ul class=\"$classes\">\n";
    }

    // Start Element (add class to <li>)
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        // Add custom classes
        $classes[] = 'navbar__item';
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $classes[] = 'navbar__item--has-children';
        }
        $classes[] = 'nav-fade';

        $class_names = join( ' ', array_filter( $classes ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['href'] = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-label'] = in_array( 'menu-item-has-children', $classes ) ? 'dropdown menu' : '';
        $atts['class'] = in_array( 'menu-item-has-children', $classes ) ? 'navbar__dropdown-label dropdown-label-alter' : '';

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
