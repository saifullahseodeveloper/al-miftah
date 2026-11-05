<?php

function enqueue_custom_color_stylesheet() {

    wp_enqueue_style('charifund-style', get_stylesheet_uri());

    // Retrieve theme color options with fallbacks
    $theme_base_color         = cs_get_option('base_color') ?: '#F55B1F';
    $theme_template_bg        = cs_get_option('template_bg') ?: '#F55B1F';
    $theme_template_color     = cs_get_option('template_color') ?: '#FFFFFF';
    $theme_white              = cs_get_option('white') ?: '#000000';
    $theme_black              = cs_get_option('black') ?: '#FFFFFF';
    $theme_primary_color      = cs_get_option('primary_color') ?: '#121315';
    $theme_secondary_color    = cs_get_option('secondary_color') ?: '#666666';
    $theme_tertiary_color     = cs_get_option('tertiary_color') ?: '#D4DCED';
    $theme_quaternary_color   = cs_get_option('quaternary_color') ?: '#D4DCED';
    $theme_quinary_color      = cs_get_option('quinary_color') ?: '#1E2023';
    $theme_septenary_color    = cs_get_option('septenary_color') ?: '#1E2023';
    $theme_senary_color       = cs_get_option('senary_color') ?: '#1E2023';
    $theme_hover_color        = cs_get_option('hover_color') ?: '#1E2023';

    wp_enqueue_style('custom-color-theme', get_template_directory_uri() . '/inc/theme-stylesheets/theme-color.css');

    // Inline CSS for theme colors
    $custom_css = "
    :root {

        --base-color: " . esc_attr($theme_base_color) . ";
        --template-bg: " . esc_attr($theme_template_bg) . ";
        --template-color: " . esc_attr($theme_template_color) . ";

        // colors
        --white: " . esc_attr($theme_white) . ";
        --black: " . esc_attr($theme_black) . ";
        --primary-color:" . esc_attr($theme_primary_color) . ";
        --secondary-color:" . esc_attr($theme_secondary_color) . ";
        --tertiary-color:" . esc_attr($theme_tertiary_color) . ";
        --quaternary-color:" . esc_attr($theme_quaternary_color) . ";
        --quinary-color: " . esc_attr($theme_quinary_color) . ";
        --septenary-color: " . esc_attr($theme_septenary_color) . ";
        --senary-color: " . esc_attr($theme_senary_color) . ";
        --hover-color: " . esc_attr($theme_hover_color) . ";

        // transitions
        --transition: all 0.5s ease;

        // box shadow
        --shadow: 0px 10px 25px 0px rgba(37, 42, 52, 0.08);
        --shadow-secondary: 0px 10px 30px 0px rgba(0, 0, 0, 0.05);
        --shadow-tertiary: 0px 4px 8px 0px rgba(0, 0, 0, 0.07);
    }";

    wp_add_inline_style('custom-color-theme', $custom_css);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_color_stylesheet');
?>
