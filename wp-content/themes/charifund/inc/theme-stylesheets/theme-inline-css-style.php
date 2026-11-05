<?php
/**
 * Theme Inline Style
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access it directly
}

/**
 * Theme Inline CSS
 * @since 1.0.0
 * */
global $charifund_inline_css;
$backend = charifund();
$charifund_inline_css = '';
$prefix = 'charifund';
ob_start();

/*-----------------------------
	Page options
------------------------------*/
$page_id = charifund()->page_id();
$page_meta = Charifund_Group_Fields_Value::page_container('charifund', 'container_options');
$page_layout_meta = get_post_meta($page_id, $prefix . '_page_container_options', true);

$page_bg_color = isset($page_layout_meta['page_bg_color']) && $page_layout_meta['page_bg_color'] ? $page_layout_meta['page_bg_color'] : '';
$page_content_text_color = isset($page_layout_meta['page_content_text_color']) && $page_layout_meta['page_content_text_color'] ? $page_layout_meta['page_content_text_color'] : '#5f5f5f';
$page_content_bg_color = isset($page_layout_meta['page_content_bg_color']) && $page_layout_meta['page_content_bg_color'] ? $page_layout_meta['page_content_bg_color'] : '';


$page_spacing_top = isset($page_meta['page_spacing_top']) && !empty($page_meta['page_spacing_top']) ? $page_meta['page_spacing_top'] : '120';
$page_spacing_bottom = isset($page_meta['page_spacing_bottom']) && !empty($page_meta['page_spacing_bottom']) ? $page_meta['page_spacing_bottom'] : '120';

$page_content_wrap_css = $backend->generate_css_code([
    'padding-top' => $backend->sanitize_px($page_spacing_top),
    'padding-bottom' => $backend->sanitize_px($page_spacing_bottom),
    'background-color' => $page_bg_color
], '.page-content-wrap-' . $page_id);

$page_content_wrap_css .= $backend->generate_css_code([
    'background-color' => $page_content_bg_color
], '.page-content-inner-' . $page_id);

$page_content_wrap_css .= $backend->generate_css_code([
    'color' => $page_content_text_color
], '.page-content-inner-' . $page_id . ' .entry-content');

echo <<<CSS
    {$page_content_wrap_css}
CSS;


$page_content_spacing = $page_meta['page_content_spacing'] ? true : false;
$page_content_spacing_top = isset($page_meta['page_content_spacing_top']) && !empty($page_meta['page_content_spacing_top']) ? $page_meta['page_content_spacing_top'] : '0';
$page_content_spacing_bottom = isset($page_meta['page_content_spacing_bottom']) && !empty($page_meta['page_content_spacing_bottom']) ? $page_meta['page_content_spacing_bottom'] : '0';
$page_content_spacing_left = isset($page_meta['page_content_spacing_left']) && !empty($page_meta['page_content_spacing_left']) ? $page_meta['page_content_spacing_left'] : '0';
$page_content_spacing_right = isset($page_meta['page_content_spacing_right']) && !empty($page_meta['page_content_spacing_right']) ? $page_meta['page_content_spacing_right'] : '0';

$page_content_css = $backend->generate_css_code([
    'padding-top' => $backend->sanitize_px($page_content_spacing_top),
    'padding-bottom' => $backend->sanitize_px($page_content_spacing_bottom),
    'padding-left' => $backend->sanitize_px($page_content_spacing_left),
    'padding-right' => $backend->sanitize_px($page_content_spacing_right),
], '.page-content-inner-' . $page_id);

if ($page_content_spacing) {
    echo <<<CSS
		{$page_content_css}
CSS;

}

$charifund_inline_css = ob_get_clean();