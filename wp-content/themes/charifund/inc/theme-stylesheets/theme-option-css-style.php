<?php
/**
 * Theme Options Style
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}
$charifund = charifund();
global $theme_customize_css;
$theme_customize_css = '';

ob_start();

/*--------------------------------
    Typography
--------------------------------*/

/* body font */
$body_font = cs_get_option('_body_font') ? cs_get_option('_body_font') : false;
$body_font_variant = cs_get_option('body_font_variant') ? cs_get_option('body_font_variant') : false;
$body_font['family'] = (isset($body_font['font-family']) && !empty($body_font['font-family'])) ? $body_font['font-family'] : 'Inter';
$body_font['weight'] = (isset($body_font['font-weight']) && !empty($body_font['font-weight'])) ? $body_font['font-weight'] : '400';
$body_font['size'] = (isset($body_font['font-size']) && !empty($body_font['font-size'])) ? $body_font['font-size'] : '16px';

$typography_css = $charifund->generate_css_code([
    'font-family' => $body_font['family'] . ', sans-serif'
], 'html,body');

$typography_css .= $charifund->generate_css_code([
    'font-size' => $charifund->sanitize_px($body_font['size']),
    'font-weight' => $body_font['weight']
], 'p,body');
$typography_css .= $charifund->generate_css_code([
    '--body-font' => $body_font['family'] . ', sans-serif'
], ':root');

echo <<<CSS
{$typography_css}
CSS;

/* heading font */
$heading_font_enable = false;
if (null == cs_get_option('heading_font_enable')) {
    $heading_font_enable = false;
} elseif ('0' == cs_get_option('heading_font_enable')) {
    $heading_font_enable = true;
} elseif ('1' == cs_get_option('heading_font_enable')) {
    $heading_font_enable = false;
}
$heading_font = cs_get_option('heading_font') ? cs_get_option('heading_font') : false;
$heading_font_variant = cs_get_option('heading_font_variant') ? cs_get_option('heading_font_variant') : false;
$heading_font['family'] = (isset($heading_font['font-family']) && !empty($heading_font['font-family'])) ? $heading_font['font-family'] : 'Inter';
$heading_font['weight'] = (isset($heading_font['font-weight']) && !empty($heading_font['font-weight'])) ? $heading_font['font-weight'] : '500';

$heading_font_css = $charifund->generate_css_code([
    'font-family' => $heading_font['family'] . ', sans-serif',
    'font-weight' => $heading_font['weight']
], [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6'
]);

$heading_font_css .= $charifund->generate_css_code([
    '--heading-font' => $heading_font['family'] . ', sans-serif'
], ':root');

$body_font_css = $charifund->generate_css_code([
    '--heading-font' => $body_font['family'] . ', sans-serif'
], ':root');

if (!$heading_font_enable) {
    echo <<<CSS
  {$heading_font_css}
CSS;

} else {
    echo <<<CSS
    {$body_font_css}
CSS;

}


/*---------------------------------
	Preloader
---------------------------------*/
$preloader_bg_color = cs_get_option('preloader_bg_color');
$preloader_css = $charifund->generate_css_code([
    'background-color' => $preloader_bg_color
], '.preloader.loaded .loader-section .bg');
echo <<<CSS
	{$preloader_css}
CSS;

/*---------------------------------
	Breadcrumb
---------------------------------*/
$breadcrumb_bg = cs_get_option('breadcrumb_bg');
$breadcrumb_bg_image = isset($breadcrumb_bg['background-image']['url']) && !empty($breadcrumb_bg['background-image']['url']) ? $breadcrumb_bg['background-image']['url'] : '';
$breadcrumb_bg_image_size = isset($breadcrumb_bg['background-size']) && !empty($breadcrumb_bg['background-size']) ? $breadcrumb_bg['background-size'] : 'cover';
$breadcrumb_bg_image_position = isset($breadcrumb_bg['background-position']) && !empty($breadcrumb_bg['background-position']) ? $breadcrumb_bg['background-position'] : 'center center';
$breadcrumb_bg_image_repeat = isset($breadcrumb_bg['background-repeat']) && !empty($breadcrumb_bg['background-repeat']) ? $breadcrumb_bg['background-repeat'] : 'no-repeat';
$breadcrumb_bg_image_attachment = isset($breadcrumb_bg['background-attachment']) && !empty($breadcrumb_bg['background-attachment']) ? $breadcrumb_bg['background-attachment'] : 'scroll';
$breadcrumb_bg_color = cs_get_option('breadcrumb_bg_color');

$breadcrumb_css = $charifund->generate_css_code([

    'background-image' => 'url(' . $breadcrumb_bg_image . ')',
    'background-position' => $breadcrumb_bg_image_position,
    'background-repeat' => $breadcrumb_bg_image_repeat,
    'background-size' => $breadcrumb_bg_image_size,
    'background-attachment' => $breadcrumb_bg_image_attachment,

], '.breadcrumb-wrap');
$breadcrumb_css .= $charifund->generate_css_code([
    'background-color' => $breadcrumb_bg_color,
], '.breadcrumb-wrap:before');

echo <<<CSS
{$breadcrumb_css}
CSS;

/*---------------------------------
	Footer Options
---------------------------------*/
$footer_spacing = cs_get_switcher_option('footer_spacing');
$footer_top_spacing = cs_get_option('footer_top_spacing');
$footer_bottom_spacing = cs_get_option('footer_bottom_spacing');
$footer_padding_top = !empty($footer_top_spacing) ? $charifund->sanitize_px($footer_top_spacing) : '';
$footer_padding_bottom = !empty($footer_bottom_spacing) ? $charifund->sanitize_px($footer_bottom_spacing) : '';


$footer_css = $charifund->generate_css_code([
    'padding-top' => $footer_padding_top,
    'padding-bottom' => $footer_padding_bottom
], '.footer-style .footer-wrap .footer-top');

if ($footer_spacing) {
    echo <<<CSS
    {$footer_css}
CSS;
}

/*---------------------------------
	Footer two Options
---------------------------------*/
$footer_bg = cs_get_option('footer_two_bg_image');
$footer_bg_image = isset($footer_bg['background-image']['url']) && !empty($footer_bg['background-image']['url']) ? $footer_bg['background-image']['url'] : '';
$footer_bg_image_size = isset($footer_bg['background-size']) && !empty($footer_bg['background-size']) ? $footer_bg['background-size'] : 'cover';
$footer_bg_image_position = isset($footer_bg['background-position']) && !empty($footer_bg['background-position']) ? $footer_bg['background-position'] : 'center center';
$footer_bg_image_repeat = isset($footer_bg['background-repeat']) && !empty($footer_bg['background-repeat']) ? $footer_bg['background-repeat'] : 'no-repeat';
$footer_bg_image_attachment = isset($footer_bg['background-attachment']) && !empty($footer_bg['background-attachment']) ? $footer_bg['background-attachment'] : 'scroll';
$footer_two_spacing = cs_get_switcher_option('footer_two_spacing');
$footer_two_top_spacing = cs_get_option('footer_two_top_spacing');
$footer_two_bottom_spacing = cs_get_option('footer_two_bottom_spacing');
$footer_two_padding_top = !empty($footer_two_top_spacing) ? $charifund->sanitize_px($footer_two_top_spacing) : '';
$footer_two_padding_bottom = !empty($footer_two_bottom_spacing) ? $charifund->sanitize_px($footer_two_bottom_spacing) : '';

$footer_css_two = $charifund->generate_css_code([
    'background-image' => 'url(' . $footer_bg_image . ')',
    'background-position' => $footer_bg_image_position,
    'background-repeat' => $footer_bg_image_repeat,
    'background-size' => $footer_bg_image_size,
    'background-attachment' => $footer_bg_image_attachment,
], '.footer-style-01 .footer-wrap.bg-image');

$footer_css_two .= $charifund->generate_css_code([
    'padding-top' => $footer_two_padding_top
], '.footer-style-01 .footer-wrap');


$footer_css_two .= $charifund->generate_css_code([
    'padding-bottom' => $footer_two_padding_bottom
], '.footer-style-01 .footer-wrap .footer-top');

if ($footer_spacing) {
    echo <<<CSS
    {$footer_css_two}
CSS;
}
/*---------------------------------
	Footer three Options
---------------------------------*/
$footer_two_bg = cs_get_option('footer_three_bg_image');
$footer_two_bg_image = isset($footer_two_bg['background-image']['url']) && !empty($footer_two_bg['background-image']['url']) ? $footer_two_bg['background-image']['url'] : '';
$footer_two_bg_image_size = isset($footer_two_bg['background-size']) && !empty($footer_two_bg['background-size']) ? $footer_two_bg['background-size'] : 'cover';
$footer_two_bg_image_position = isset($footer_two_bg['background-position']) && !empty($footer_two_bg['background-position']) ? $footer_two_bg['background-position'] : 'center center';
$footer_two_bg_image_repeat = isset($footer_two_bg['background-repeat']) && !empty($footer_two_bg['background-repeat']) ? $footer_two_bg['background-repeat'] : 'no-repeat';
$footer_two_bg_image_attachment = isset($footer_two_bg['background-attachment']) && !empty($footer_two_bg['background-attachment']) ? $footer_two_bg['background-attachment'] : 'scroll';
$footer_three_spacing = cs_get_switcher_option('footer_three_spacing');
$footer_three_top_spacing = cs_get_option('footer_three_top_spacing');
$footer_three_bottom_spacing = cs_get_option('footer_three_bottom_spacing');
$footer_three_padding_top = !empty($footer_three_top_spacing) ? $charifund->sanitize_px($footer_three_top_spacing) : '';
$footer_three_padding_bottom = !empty($footer_three_bottom_spacing) ? $charifund->sanitize_px($footer_three_bottom_spacing) : '';


$footer_three_css = $charifund->generate_css_code([
    'background-image' => 'url(' . $footer_two_bg_image . ')',
    'background-position' => $footer_two_bg_image_position,
    'background-repeat' => $footer_bg_image_repeat,
    'background-size' => $footer_two_bg_image_size,
    'background-attachment' => $footer_two_bg_image_attachment,
], '.footer-style-02 .footer-wrap');

$footer_three_css .= $charifund->generate_css_code([
    'padding-top' => $footer_three_padding_top
], '.footer-style-02 .footer-wrap');


$footer_three_css .= $charifund->generate_css_code([
    'padding-bottom' => $footer_three_padding_bottom
], '.footer-style-02 .footer-wrap .footer-widget-content');


echo <<<CSS
    {$footer_three_css}
CSS;


/*---------------------------------
	Copyright Area Options
---------------------------------*/
$copyright_area_spacing = cs_get_switcher_option('copyright_area_spacing');
$copyright_area_top_spacing = cs_get_option('copyright_area_top_spacing');
$copyright_area_bottom_spacing = cs_get_option('copyright_area_bottom_spacing');
$copyright_padding_top = !empty($copyright_area_top_spacing) ? $charifund->sanitize_px($copyright_area_top_spacing) : '';
$copyright_padding_bottom = !empty($copyright_area_bottom_spacing) ? $charifund->sanitize_px($copyright_area_bottom_spacing) : '';

$copyright_css = $charifund->generate_css_code([
    'padding-top' => $copyright_padding_top,
    'padding-bottom' => $copyright_padding_bottom
], '.footer-wrap .copyright-wrap .copyright-text');

if ($copyright_area_spacing) {
    echo <<<CSS
	{$copyright_css}
CSS;

}

/*---------------------------------
	Copyright Area Options Two
---------------------------------*/
$copyright_two_area_spacing = cs_get_switcher_option('copyright_two_area_spacing');
$copyright_two_area_top_spacing = cs_get_option('copyright_two_area_top_spacing');
$copyright_two_area_bottom_spacing = cs_get_option('copyright_two_area_bottom_spacing');
$copyright_two_padding_top = !empty($copyright_two_area_top_spacing) ? $charifund->sanitize_px($copyright_two_area_top_spacing) : '';
$copyright_two_padding_bottom = !empty($copyright_two_area_bottom_spacing) ? $charifund->sanitize_px($copyright_two_area_bottom_spacing) : '';

$copyright_css_two = $charifund->generate_css_code([
    'padding-top' => $copyright_two_padding_top,
    'padding-bottom' => $copyright_two_padding_bottom
], '.footer-style-01 .footer-wrap .copyright-wrap');

if ($copyright_two_area_spacing) {
    echo <<<CSS
	{$copyright_css_two}
CSS;

}


/*---------------------------------
	Copyright Area Options Two
---------------------------------*/
$copyright_three_area_spacing = cs_get_switcher_option('copyright_three_area_spacing');
$copyright_three_area_top_spacing = cs_get_option('copyright_three_area_top_spacing');
$copyright_three_area_bottom_spacing = cs_get_option('copyright_three_area_bottom_spacing');
$copyright_three_padding_top = !empty($copyright_three_area_top_spacing) ? $charifund->sanitize_px($copyright_three_area_top_spacing) : '';
$copyright_three_padding_bottom = !empty($copyright_three_area_bottom_spacing) ? $charifund->sanitize_px($copyright_three_area_bottom_spacing) : '';

$copyright_css_three = $charifund->generate_css_code([
    'padding-top' => $copyright_three_padding_top,
    'padding-bottom' => $copyright_three_padding_bottom
], '.footer-style-02 .footer-wrap .copyright-wrap');

if ($copyright_three_area_spacing) {
    echo <<<CSS
	{$copyright_css_three}
CSS;

}

/*---------------------------------
	404 Error Page Options
---------------------------------*/
$error_page_bg_color = cs_get_option('404_bg_color');
$err_404_spacing_top = cs_get_option('404_spacing_top');
$err_404_spacing_bottom = cs_get_option('404_spacing_bottom');
$err_padding_top = !empty($err_404_spacing_top) ? $charifund->sanitize_px($err_404_spacing_top) : '';
$err_padding_bottom = !empty($err_404_spacing_bottom) ? $charifund->sanitize_px($err_404_spacing_bottom) : '';

$error_css = $charifund->generate_css_code([
    'background-color' => $error_page_bg_color,
    'padding-top' => $err_padding_top,
    'padding-bottom' => $err_padding_bottom
], '.error_page_content_area');

echo <<<CSS
  {$error_css}
CSS;
/*---------------------------------
	Blog Page Options
---------------------------------*/
$blog_page_bg_color = cs_get_option('blog_bg_color');
$blog_page_spacing_top = cs_get_option('blog_spacing_top');
$blog_page_spacing_bottom = cs_get_option('blog_spacing_bottom');
$blog_padding_top = !empty($blog_page_spacing_top) ? $charifund->sanitize_px($blog_page_spacing_top) : '';
$blog_padding_bottom = !empty($blog_page_spacing_bottom) ? $charifund->sanitize_px($blog_page_spacing_bottom) : '';

$blog_css = $charifund->generate_css_code([
    'background-color' => $blog_page_bg_color,
    'padding-top' => $blog_padding_top,
    'padding-bottom' => $blog_padding_bottom
], '.blog-page-content-area');

echo <<<CSS
  {$blog_css}
CSS;
/*---------------------------------
	Blog Single Page Options
---------------------------------*/
$blog_single_page_bg_color = cs_get_option('blog_single_bg_color');
$blog_single_page_spacing_top = cs_get_option('blog_single_spacing_top');
$blog_single_page_spacing_bottom = cs_get_option('blog_single_spacing_bottom');
$blog_single_padding_top = !empty($blog_single_page_spacing_top) ? $charifund->sanitize_px($blog_single_page_spacing_top) : '';
$blog_single_padding_bottom = !empty($blog_single_page_spacing_bottom) ? $charifund->sanitize_px($blog_single_page_spacing_bottom) : '';

$blog_single_css = $charifund->generate_css_code([
    'background-color' => $blog_single_page_bg_color,
    'padding-top' => $blog_single_padding_top,
    'padding-bottom' => $blog_single_padding_bottom
], '.blog-content-page');

echo <<<CSS
  {$blog_single_css}
CSS;


/*---------------------------------
	Archive Page Options
---------------------------------*/
$archive_page_bg_color = cs_get_option('archive_bg_color');
$archive_page_spacing_top = cs_get_option('archive_spacing_top');
$archive_page_spacing_bottom = cs_get_option('archive_spacing_bottom');
$archive_single_padding_top = !empty($archive_page_spacing_top) ? $charifund->sanitize_px($archive_page_spacing_top) : '';
$archive_single_padding_bottom = !empty($archive_page_spacing_bottom) ? $charifund->sanitize_px($archive_page_spacing_bottom) : '';

$archive_page_css = $charifund->generate_css_code([
    'background-color' => $archive_page_bg_color,
    'padding-top' => $archive_single_padding_top,
    'padding-bottom' => $archive_single_padding_bottom
], '.archive-page-content-area');

echo <<<CSS
  {$archive_page_css}
CSS;

/*---------------------------------
	Search Page Options
---------------------------------*/
$search_page_bg_color = cs_get_option('search_bg_color');
$search_page_spacing_top = cs_get_option('search_spacing_top');
$search_page_spacing_bottom = cs_get_option('search_spacing_bottom');
$search_single_padding_top = !empty($search_page_spacing_top) ? $charifund->sanitize_px($search_page_spacing_top) : '';
$search_single_padding_bottom = !empty($search_page_spacing_bottom) ? $charifund->sanitize_px($search_page_spacing_bottom) : '';

$search_page_css = $charifund->generate_css_code([
    'background-color' => $search_page_bg_color,
    'padding-top' => $search_single_padding_top,
    'padding-bottom' => $search_single_padding_bottom
], '.search-page-content-area');

echo <<<CSS
  {$search_page_css}
CSS;

/*---------------------------------
	Service Single Page Options
---------------------------------*/
$service_single_page_bg_color = cs_get_option('service_single_bg_color');
$service_single_page_spacing_top = cs_get_option('service_single_spacing_top');
$service_single_page_spacing_bottom = cs_get_option('service_single_spacing_bottom');
$search_single_padding_top = !empty($service_single_page_spacing_top) ? $charifund->sanitize_px($service_single_page_spacing_top) : '';
$search_single_padding_bottom = !empty($service_single_page_spacing_bottom) ? $charifund->sanitize_px($service_single_page_spacing_bottom) : '';

$service_single_page_css = $charifund->generate_css_code([
    'background-color' => $service_single_page_bg_color,
    'padding-top' => $search_single_padding_top,
    'padding-bottom' => $search_single_padding_bottom
], '.service-details-page');

echo <<<CSS
  {$service_single_page_css}
CSS;

$theme_customize_css = ob_get_clean();
