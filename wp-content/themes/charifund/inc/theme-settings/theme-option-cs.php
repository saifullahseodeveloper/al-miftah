<?php
/**
 * Theme Options
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); // exit if access directly
}
// Control core classes for avoid errors
if (class_exists('CSF')) {

    $allowed_html = charifund()->kses_allowed_html(array('mark'));
    $prefix = 'charifund';
    // Create options
    CSF::createOptions($prefix . '_theme_options', array(
        'menu_title' => esc_html__('Theme Options', 'charifund'),
        'menu_slug' => 'charifund_theme_options',
        'menu_parent' => 'charifund_theme_options',
        'menu_type' => 'submenu',
        'footer_credit' => ' ',
        'menu_icon' => 'fa fa-filter',
        'show_footer' => false,
        'enqueue_webfont' => false,
        'show_search' => true,
        'show_reset_all' => true,
        'show_reset_section' => true,
        'show_all_options' => false,
        'theme' => 'dark',
        'framework_title' => charifund()->get_theme_info('name')
    ));

    /*-------------------------------------------------------
        ** General  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('General', 'charifund'),
        'id' => 'general_options',
        'icon' => 'fas fa-cogs',
    ));
	
	 /* Preloader */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Global Option', 'charifund'),
        'id' => 'theme_general_global_options',
        'icon' => 'fa fa-spinner',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Global Options', 'charifund') . '</h3>'
            ),
              
            array(
                'id' => 'enable_svg_upload',
                'type' => 'switcher',
                'title' => esc_html__('Enable Svg Upload ?', 'charifund'),
                'desc' => esc_html__('If you want to enable or disable svg upload you can set ( YES / NO )', 'charifund'),
                'default' => true,
            ),
            array(
                'id' => 'rtl_enable',
                'title' => esc_html__('Rtl Support', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to enable/disable rtl', 'charifund'), $allowed_html),
                'default' => false,
            ),
            array(
                'id' => 'normal_mouse_enable',
                'title' => esc_html__('Normal Mouse Enable', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to enable/disable Normal Mouse', 'charifund'), $allowed_html),
                'default' => false,
            ),
        )
    ));
	
    /* Preloader */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Preloader Enable', 'charifund'),
        'id' => 'theme_general_preloader_options',
        'icon' => 'fa fa-spinner',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Preloader Options', 'charifund') . '</h3>'
            ),
            array(
                'id' => 'preloader_enable',
                'title' => esc_html__('Preloader', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to enable/disable preloader', 'charifund'), $allowed_html),
                'default' => false,
            ),
            array(
                'id' => 'preloader_bg_color',
                'title' => esc_html__('Preloader Background Color', 'charifund'),
                'type' => 'color',
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>overlay color</mark> for preloader background image', 'charifund'), $allowed_html),
                'dependency' => array('preloader_enable', '==', 'true')
            ),
			array(
                'id' => 'preloader_icon_bg_color',
                'title' => esc_html__('Preloader Icon Background Color', 'charifund'),
                'type' => 'color',
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>overlay color</mark> for preloader background image', 'charifund'), $allowed_html),
                'dependency' => array('preloader_enable', '==', 'true')
            ),
			array(
				'id' => 'preloader_icon',
				'type' => 'media',
				'title' => esc_html__('preloader icon', 'charifund'),
				'library' => 'image',
				'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded preloader', 'charifund'), $allowed_html),
                'dependency' => array('preloader_enable', '==', 'true')
			),
            array(
                'id'      => 'preloader_title',
                'type'    => 'text',
                'title'   => esc_html__('Preloader Title', 'charifund'),
                'desc'    => esc_html__('Enter the title to display during preloading. If left empty, the site name will be used.', 'charifund'),
                'default' => esc_html__('CHARIFUND', 'charifund'),
                'dependency' => array('preloader_enable', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
           ** Back To Top  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Back To Top', 'charifund'),
        'id' => 'theme_general_back_top_options',
        'icon' => 'fa fa-arrow-up',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Back Top Options', 'charifund') . '</h3>'
            ),
            array(
                'id' => 'back_top_enable',
                'title' => esc_html__('Back Top', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide back to top', 'charifund'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'back_top_icon',
                'title' => esc_html__('Back Top Icon', 'charifund'),
                'type' => 'icon',
                'default' => 'fas fa-arrow-up-long',
                'desc' => wp_kses(__('you can set <mark>icon</mark> for back to top.', 'charifund'), $allowed_html),
                'dependency' => array('back_top_enable', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
        ** Menu Sidebar  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Offcanvas / Menu Sidebar', 'charifund'),
        'id' => 'theme_general_sidebar_options',
        'icon' => 'fas fa-bars',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Offcanvas / Sidebar Option', 'charifund') . '</h3>'
            ),
            array(
                'id' => 'sidebar_logo',
                'type' => 'media',
                'title' => esc_html__('Sidebar Logo', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
            ),          
            array(
                'id'        => 'sidebar_contact_info_repeater',
                'type'      => 'repeater',
                'title'     => 'Contact Info Repeater',
                'fields'    => array(
              
                  array(
                    'id'    => 'sidebar_contact_icon',
                    'type'  => 'icon',
                    'default' => 'fa-solid fa-phone-volume',
                    'title' => 'Info Icon',
                  ),              
                  array(
                    'id'    => 'sidebar_contact_text',
                    'type'  => 'text',
                    'title' => 'Info Text',
                  ),
                  array(
                    'id'    => 'sidebar_contact_text_url',
                    'type'  => 'text',
                    'title' => 'Info Url',
                  ),
              
                )
            ),
            array(
                'id' => 'sidebar_title',
                'type' => 'text',
                'title' => esc_html__('Sidebar Title', 'charifund'),
                'default' => esc_html__('Contact Info', 'charifund'),
            ),
            array(
                'id'        => 'sidebar_socials',
                'type'      => 'repeater',
                'title'     => 'Socials Info Repeater',
                'fields'    => array(
              
                  array(
                    'id'    => 'sidebar_socials_icon',
                    'type'  => 'icon',
                    'default' => 'fa fa-facebook',
                    'title' => 'Socials Info Icon',
                  ),  
                  array(
                    'id'    => 'sidebar_socials_icon_url',
                    'type'  => 'text',
                    'title' => 'Socials Info Url',
                  ),
              
                )
            ),
        )
    ));

    /*-------------------------------------------------------
           ** Typography  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'typography',
        'title' => esc_html__('Typography', 'charifund'),
        'icon' => 'fas fa-text-height',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Body Font Options', 'charifund') . '</h3>',
            ),
            array(
                'type' => 'typography',
                'title' => esc_html__('Typography', 'charifund'),
                'id' => '_body_font',
                'default' => array(
                    'font-family' => 'Nunito',
                    'font-size' => '16',
                    'line-height' => '26',
                    'unit' => 'px',
                    'type' => 'google',
                ),
                'color' => false,
                'subset' => false,
                'text_align' => false,
                'text_transform' => false,
                'letter_spacing' => false,
                'line_height' => false,
                'desc' => wp_kses(__('You can set <mark>font</mark> for all HTML tags (if not using a different heading font)', 'charifund'), $allowed_html),
            ),
            array(
                'id' => 'body_font_variant',
                'type' => 'select',
                'title' => esc_html__('Load Font Variant', 'charifund'),
                'multiple' => true,
                'chosen' => true,
                'options' => array(
                    '300' => esc_html__('Light 300', 'charifund'),
                    '400' => esc_html__('Regular 400', 'charifund'),
                    '500' => esc_html__('Medium 500', 'charifund'),
                    '600' => esc_html__('Semi Bold 600', 'charifund'),
                    '700' => esc_html__('Bold 700', 'charifund'),
                    '800' => esc_html__('Extra Bold 800', 'charifund'),
                ),
                'default' => array('400', '500', '600', '700'),
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading Font Options', 'charifund') . '</h3>',
            ),
            array(
                'type' => 'switcher',
                'id' => 'heading_font_enable',
                'title' => esc_html__('Heading Font', 'charifund'),
                'desc' => wp_kses(__('Set <mark>yes</mark> to select a different heading font', 'charifund'), $allowed_html),
                'default' => true,
            ),
            array(
                'type' => 'typography',
                'title' => esc_html__('Typography', 'charifund'),
                'id' => 'heading_font',
                'default' => array(
                    'font-family' => 'Nunito',
                    'type' => 'google',
                ),
                'color' => false,
                'subset' => false,
                'text_align' => false,
                'text_transform' => false,
                'letter_spacing' => false,
                'font_size' => false,
                'line_height' => false,
                'desc' => wp_kses(__('Set <mark>font</mark> for heading tags (e.g., h1, h2, h3, etc.)', 'charifund'), $allowed_html),
                'dependency' => array('heading_font_enable', '==', 'true'),
            ),
            array(
                'id' => 'heading_font_variant',
                'type' => 'select',
                'title' => esc_html__('Load Font Variant', 'charifund'),
                'multiple' => true,
                'chosen' => true,
                'options' => array(
                    '300' => esc_html__('Light 300', 'charifund'),
                    '400' => esc_html__('Regular 400', 'charifund'),
                    '500' => esc_html__('Medium 500', 'charifund'),
                    '600' => esc_html__('Semi Bold 600', 'charifund'),
                    '700' => esc_html__('Bold 700', 'charifund'),
                    '800' => esc_html__('Extra Bold 800', 'charifund'),
                ),
                'default' => array('400', '500', '600', '700'),
                'dependency' => array('heading_font_enable', '==', 'true'),
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Custom Font Options', 'charifund') . '</h3>',
            ),
            array(
                'type' => 'typography',
                'title' => esc_html__('Custom Font', 'charifund'),
                'id' => 'custom_font',
                'default' => array(
                    'font-family' => 'Caveat',
                    'type' => 'google',
                ),
                'color' => false,
                'subset' => false,
                'text_align' => false,
                'text_transform' => false,
                'letter_spacing' => false,
                'font_size' => false,
                'line_height' => false,
                'desc' => wp_kses(__('Use this <mark>font</mark> for custom sections', 'charifund'), $allowed_html),
            ),
        ),

    ));

    /*-------------------------------------------------------
           ** Theme Color  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Theme Colors', 'charifund'),
        'id' => 'theme_color',
        'icon' => 'fa fa-palette',
        'parent' => 'general_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Theme Color Option', 'charifund') . '</h3>'
            ),
            array(
                'id'      => 'base_color',
                'type'    => 'color',
                'title'   => 'Base Color',
                'default' => '#ffc107'
            ),
            array(
                'id'      => 'template_bg',
                'type'    => 'color',
                'title'   => 'template Bg',
                'default' => '#ffffff'
            ),
            array(
                'id'      => 'template_color',
                'type'    => 'color',
                'title'   => 'template Color',
                'default' => '#667471'
            ),
            array(
                'id'      => 'primary_color',
                'type'    => 'color',
                'title'   => 'primary Color',
                'default' => '#046a58'
            ),
            array(
                'id'      => 'secondary_color',
                'type'    => 'color',
                'title'   => 'secondary Color',
                'default' => '#122f2a'
            ),
            array(
                'id'      => 'tertiary_color',
                'type'    => 'color',
                'title'   => 'tertiary Color',
                'default' => '#046a58'
            ),
            array(
                'id'      => 'quaternary_color',
                'type'    => 'color',
                'title'   => 'quaternary Three',
                'default' => '#00715d'
            ),
            array(
                'id'      => 'quinary_color',
                'type'    => 'color',
                'title'   => 'quinary Color',
                'default' => '#061408'
            ),          
            array(
                'id'      => 'septenary_color',
                'type'    => 'color',
                'title'   => 'septenary Color',
                'default' => '#0c141f'
            ),
            array(
                'id'      => 'senary_color',
                'type'    => 'color',
                'title'   => 'senary One',
                'default' => '#d9d9d9'
            ),
            array(
                'id'      => 'hover_color',
                'type'    => 'color',
                'title'   => 'hover Two',
                'default' => '#6b5103'
            ), 
            array(
                'id'      => 'white',
                'type'    => 'color',
                'title'   => 'white',
                'default' => '#ffffff'
            ),
            array(
                'id'      => 'black',
                'type'    => 'color',
                'title'   => 'black',
                'default' => '#000000'
            ), 
        )
    ));

    /*----------------------------------
        Header & Footer Style
    -----------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Set Header & Footer Type', 'charifund'),
        'id' => 'header_footer_style_options',
        'icon' => 'eicon-banner',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => esc_html__('Global Header Style', 'charifund'),
            ),
            array(
                'id' => 'navbar_type',
                'title' => esc_html__('Navbar Type', 'charifund'),
                'type' => 'image_select',
                'options' => array(
                    '' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/00.png',
                    'style-01' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/01.png',
                    'style-02' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/02.png',
                    'style-03' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/03.png',
                    'style-04' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/04.png',
                    'style-05' => CHARIFUND_THEME_SETTINGS_IMAGES . '/header/05.png',
                ),
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>navbar type</mark> it will show in every page except you select specific navbar type form page settings.', 'charifund'), $allowed_html),
            ),
            array(
                'type' => 'subheading',
                'content' => esc_html__('Global Footer Style', 'charifund'),
            ),
            array(
                'id' => 'footer_type',
                'title' => esc_html__('Footer Type', 'charifund'),
                'type' => 'image_select',
                'options' => array(
                    '' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/00.png',
                    'style-01' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/01.png',
                    'style-02' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/02.png',
                    'style-03' => CHARIFUND_THEME_SETTINGS_IMAGES . '/footer/03.png',
                ),
                'default' => '',
                'desc' => wp_kses(__('you can set <mark>footer type</mark> it will show in every page except you select specific navbar type form page settings.', 'charifund'), $allowed_html),
            ),
        )
    ));

    /*-------------------------------------------------------
       ** Entire Site Header Options
   --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'headers_settings',
        'title' => esc_html__('Headers', 'charifund'),
        'icon' => 'fa fa-home'
    ));
    /* Default Header Style */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Default Header', 'charifund'),
        'id' => 'theme_header_default_options',
        'icon' => 'fa fa-image',
        'parent' => 'headers_settings',
       'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Default Header Settings', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_default_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_default_callus_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Call Us', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_default_callus_title',
            'type' => 'text',
            'title' => esc_html__('Call Us Title', 'charifund'),
            'default' => 'Call Us Now',
            'dependency' => array('header_default_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_default_callus_text',
            'type' => 'text',
            'title' => esc_html__('Call Us Text', 'charifund'),
            'default' => '(+01)-793-7938',
            'dependency' => array('header_default_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_default_callus_text_url',
            'type' => 'text',
            'title' => esc_html__('Call Us Url', 'charifund'),
            'default' => esc_html__('tel:01-793-7938', 'charifund'),
            'dependency' => array('header_default_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_default_search_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Search Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar search button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_default_right_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_default_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button Text', 'charifund'),
            'default' => 'Donate Now',
            'dependency' => array('header_default_right_btn_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_default_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'default' => esc_html__('#', 'charifund'),
            'dependency' => array('header_default_right_btn_enabled', '==', 'true'),
        ),

        // header default top bar start

        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Top Bar Options', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_default_top_bar_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Header Top', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> top bar of header one', 'charifund'), $allowed_html),
        ),          
        array(
            'id'        => 'header_default_top_bar_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contact Info Repeater',
            'dependency' => array('header_default_top_bar_enabled', '==', 'true'),
            'fields'    => array(          
              array(
                'id'    => 'header_default_top_bar_icon',
                'type'  => 'icon',
                'default' => 'fa-solid fa-phone-volume',
                'title' => 'Info Icon',
              ),              
              array(
                'id'    => 'header_default_top_bar_info',
                'type'  => 'text',
                'title' => 'Info Text',
              ),
              array(
                'id'    => 'header_default_top_bar_info_url',
                'type'  => 'text',
                'title' => 'Info Url',
              ),
          
            )
        ),
        array(
            'id' => 'header_default_topbar_text',
            'type' => 'text',
            'title' => esc_html__('Welcome Text', 'charifund'),
            'default' => '<i class="icon-heart-hand"></i> Are you ready to help them? Lets become a volunteer!',
            'dependency' => array('header_default_top_bar_enabled', '==', 'true'),
        ),
        array(
            'id'        => 'header_default_top_bar_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'dependency' => array('header_default_top_bar_enabled', '==', 'true'),
            'fields'    => array(
          
              array(
                'id'    => 'header_default_top_bar_socials_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Icon',
              ),   
              array(
                'id'    => 'header_default_top_bar_socials_url',
                'type'  => 'text',
                'title' => 'Socials Url',
              ),
          
            )
        ),
          
        )
    ));

      /* Header Style 01 */
      CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Header One', 'charifund'),
        'id' => 'theme_header_one_options',
        'icon' => 'fa fa-image',
        'parent' => 'headers_settings',
        'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Header 1 Settings', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_1_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_1_callus_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Call Us', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_1_callus_title',
            'type' => 'text',
            'title' => esc_html__('Call Us Title', 'charifund'),
            'default' => 'Call Us Now',
            'dependency' => array('header_1_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_1_callus_text',
            'type' => 'text',
            'title' => esc_html__('Call Us Text', 'charifund'),
            'default' => '(+01)-793-7938',
            'dependency' => array('header_1_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_1_callus_text_url',
            'type' => 'text',
            'title' => esc_html__('Call Us Url', 'charifund'),
            'default' => esc_html__('tel:01-793-7938', 'charifund'),
            'dependency' => array('header_1_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_1_search_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Search Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar search button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_1_right_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_1_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button Text', 'charifund'),
            'default' => 'Donate Now',
            'dependency' => array('header_1_right_btn_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_1_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'default' => esc_html__('#', 'charifund'),
            'dependency' => array('header_1_right_btn_enabled', '==', 'true'),
        ),

        // header 1 top bar start

        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Top Bar Options', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_1_top_bar_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Header Top', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> top bar of header one', 'charifund'), $allowed_html),
        ),          
        array(
            'id'        => 'header_1_top_bar_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contact Info Repeater',
            'dependency' => array('header_1_top_bar_enabled', '==', 'true'),
            'fields'    => array(          
              array(
                'id'    => 'header_1_top_bar_icon',
                'type'  => 'icon',
                'default' => 'fa-solid fa-phone-volume',
                'title' => 'Info Icon',
              ),              
              array(
                'id'    => 'header_1_top_bar_info',
                'type'  => 'text',
                'title' => 'Info Text',
              ),
              array(
                'id'    => 'header_1_top_bar_info_url',
                'type'  => 'text',
                'title' => 'Info Url',
              ),
          
            )
        ),
        array(
            'id' => 'header_1_topbar_text',
            'type' => 'text',
            'title' => esc_html__('Welcome Text', 'charifund'),
            'default' => '<i class="icon-heart-hand"></i> Are you ready to help them? Lets become a volunteer!',
            'dependency' => array('header_1_top_bar_enabled', '==', 'true'),
        ),
        array(
            'id'        => 'header_1_top_bar_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'dependency' => array('header_1_top_bar_enabled', '==', 'true'),
            'fields'    => array(
          
              array(
                'id'    => 'header_1_top_bar_socials_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Icon',
              ),   
              array(
                'id'    => 'header_1_top_bar_socials_url',
                'type'  => 'text',
                'title' => 'Socials Url',
              ),
          
            )
        ),
          
        )
    ));

   /* Header Style 2*/
   CSF::createSection($prefix . '_theme_options', array(
    'title' => esc_html__('Header Two', 'charifund'),
    'id' => 'theme_header_two_options',
    'icon' => 'fa fa-image',
    'parent' => 'headers_settings',
    'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Header 2 Settings', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_2_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_2_callus_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Call Us', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_2_callus_title',
            'type' => 'text',
            'title' => esc_html__('Call Us Title', 'charifund'),
            'default' => 'Call Us Now',
            'dependency' => array('header_2_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_2_callus_text',
            'type' => 'text',
            'title' => esc_html__('Call Us Text', 'charifund'),
            'default' => '(+01)-793-7938',
            'dependency' => array('header_2_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_2_callus_text_url',
            'type' => 'text',
            'title' => esc_html__('Call Us Url', 'charifund'),
            'default' => esc_html__('tel:01-793-7938', 'charifund'),
            'dependency' => array('header_2_callus_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_2_search_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Search Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar search button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_2_right_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header one', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_2_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button Text', 'charifund'),
            'default' => 'Donate Now',
            'dependency' => array('header_2_right_btn_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_2_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'default' => esc_html__('#', 'charifund'),
            'dependency' => array('header_2_right_btn_enabled', '==', 'true'),
        ),

        // header default top bar start

        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Top Bar Options', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_2_top_bar_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Header Top', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> top bar of header one', 'charifund'), $allowed_html),
        ),          
        array(
            'id'        => 'header_2_top_bar_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contact Info Repeater',
            'dependency' => array('header_2_top_bar_enabled', '==', 'true'),
            'fields'    => array(          
              array(
                'id'    => 'header_2_top_bar_icon',
                'type'  => 'icon',
                'default' => 'fa-solid fa-phone-volume',
                'title' => 'Info Icon',
              ),              
              array(
                'id'    => 'header_2_top_bar_info',
                'type'  => 'text',
                'title' => 'Info Text',
              ),
              array(
                'id'    => 'header_2_top_bar_info_url',
                'type'  => 'text',
                'title' => 'Info Url',
              ),
          
            )
        ),
        array(
            'id'        => 'header_2_top_bar_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'dependency' => array('header_2_top_bar_enabled', '==', 'true'),
            'fields'    => array(
          
              array(
                'id'    => 'header_2_top_bar_socials_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Icon',
              ),   
              array(
                'id'    => 'header_2_top_bar_socials_url',
                'type'  => 'text',
                'title' => 'Socials Url',
              ),
          
            )
        ),
          
        )
    ));

    /* Header Style 3*/

   CSF::createSection($prefix . '_theme_options', array(
    'title' => esc_html__('Header Three', 'charifund'),
    'id' => 'theme_header_three_options',
    'icon' => 'fa fa-image',
    'parent' => 'headers_settings',
    'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Header 3 Settings', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_3_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_3_cart_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Cart Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar cart button of header', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_3_search_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Search Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar search button of header', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_3_right_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_3_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button Text', 'charifund'),
            'default' => 'Donate Now',
            'dependency' => array('header_3_right_btn_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_3_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'default' => esc_html__('#', 'charifund'),
            'dependency' => array('header_3_right_btn_enabled', '==', 'true'),
        ),

        // header 3 top bar start

        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Top Bar Options', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_3_top_bar_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Header Top', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> top bar of header one', 'charifund'), $allowed_html),
        ),          
        array(
            'id'        => 'header_3_top_bar_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contact Info Repeater',
            'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
            'fields'    => array(          
              array(
                'id'    => 'header_3_top_bar_icon',
                'type'  => 'icon',
                'default' => 'fa-solid fa-phone-volume',
                'title' => 'Info Icon',
              ),              
              array(
                'id'    => 'header_3_top_bar_info',
                'type'  => 'text',
                'title' => 'Info Text',
              ),
              array(
                'id'    => 'header_3_top_bar_info_url',
                'type'  => 'text',
                'title' => 'Info Url',
              ),
          
            )
        ),
        array(
            'id'    => 'header_3_top_bar_phone_icon',
            'type'  => 'icon',
            'default' => 'fa-solid fa-phone',
            'title' => esc_html__('Phone Icon', 'charifund'),
            'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
        ), 
        array(
            'id' => 'header_3_top_bar_phone_text',
            'type' => 'text',
            'title' => esc_html__('Phone Text', 'charifund'),
            'default' => '+2(305)587-3407',
            'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_3_top_bar_phone_url',
            'type' => 'text',
            'title' => esc_html__('Phone URL', 'charifund'),
            'default' => 'tel:2305-587-3407',
            'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
        ),        
        array(
            'id'        => 'header_3_top_bar_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'dependency' => array('header_3_top_bar_enabled', '==', 'true'),
            'fields'    => array(
          
              array(
                'id'    => 'header_3_top_bar_socials_icon',
                'type'  => 'icon',
                'default' => 'fa fa-facebook-f',
                'title' => 'Socials Icon',
              ),   
              array(
                'id'    => 'header_3_top_bar_socials_url',
                'type'  => 'text',
                'title' => 'Socials Url',
              ),
          
            )
        ),
          
        )
    ));

    /* Header Style 4*/

    CSF::createSection($prefix . '_theme_options', array(
    'title' => esc_html__('Header Four', 'charifund'),
    'id' => 'theme_header_four_options',
    'icon' => 'fa fa-image',
    'parent' => 'headers_settings',
    'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Header 4 Settings', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_4_main_color',
            'title' => esc_html__('Main Color', 'charifund'),
            'type' => 'color',
            'default' => '',
        ),
        array(
            'id' => 'header_4_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),   
        array(
            'id' => 'header_4_socials_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show socials Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header', 'charifund'), $allowed_html),
        ),    
        array(
            'id'        => 'header_4_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'dependency' => array('header_4_socials_enabled', '==', 'true'),
            'fields'    => array(
                array(
                    'id'    => 'header_4_socials_icon',
                    'type'  => 'icon',
                    'default' => 'fa fa-facebook-f',
                    'title' => 'Socials Icon',
                ),   
                array(
                    'id'    => 'header_4_socials_url',
                    'type'  => 'text',
                    'title' => 'Socials Url',
                ),
            )
        ),
        array(
            'id' => 'header_4_cart_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Cart Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar cart button of header', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_4_right_btn_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar button of header', 'charifund'), $allowed_html),
        ),
        array(
            'id' => 'header_4_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button Text', 'charifund'),
            'default' => 'Donate Now',
            'dependency' => array('header_4_right_btn_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_4_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'default' => esc_html__('#', 'charifund'),
            'dependency' => array('header_4_right_btn_enabled', '==', 'true'),
        ),

        // header 3 top bar start
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Top Bar Options', 'charifund') . '</h3>'
        ),
        array(
            'id' => 'header_4_top_bar_enabled',
            'type' => 'switcher',
            'title' => esc_html__('Show Header Top', 'charifund'),
            'default' => true,
            'desc' => wp_kses(__('you can <mark> show/hide</mark> top bar of header one', 'charifund'), $allowed_html),
        ),  
        array(
            'id' => 'header_4_top_bar_phone',
            'type' => 'text',
            'title' => esc_html__('phone', 'charifund'),
            'default' => '+2(305)587-3407',
            'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
        ),  
        array(
            'id' => 'header_4_top_bar_email',
            'type' => 'text',
            'title' => esc_html__('Email', 'charifund'),
            'default' => 'example@info.com',
            'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
        ),  
        array(
            'id' => 'header_4_top_bar_location',
            'type' => 'text',
            'title' => esc_html__('location', 'charifund'),
            'default' => '54 Berrick St Boston MA 02115',
            'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
        ),
        array(
            'id' => 'header_4_top_bar_notice_text',
            'type' => 'text',
            'title' => esc_html__('Phone Text', 'charifund'),
            'default' => 'Updates: Delivers Personal Protective Equipments to North.',
            'dependency' => array('header_4_top_bar_enabled', '==', 'true'),
        ),   
    )
    ));
	
	/* Header Style 5*/
    CSF::createSection($prefix . '_theme_options', array(
    'title' => esc_html__('Header Five', 'charifund'),
    'id' => 'theme_header_five_options',
    'icon' => 'fa fa-image',
    'parent' => 'headers_settings',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Header 4 Settings', 'charifund') . '</h3>'
            ),
            array(
                'id' => 'header_5_logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
            ), 
            array(
                'id' => 'header_5_phone_enabled',
                'type' => 'switcher',
                'title' => esc_html__('Phone', 'charifund'),
                'default' => true,
                'desc' => wp_kses(__('you can <mark> show/hide</mark> navbar Right Phone', 'charifund'), $allowed_html),
            ),
            array(
                'id' => 'header_5_right_phone_title',
                'type' => 'text',
                'title' => esc_html__('Phone Title', 'charifund'),
                'default' => 'Call Us Now',
                'dependency' => array('header_5_phone_enabled', '==', 'true'),
            ),
            array(
                'id' => 'header_5_right_phone_num',
                'type' => 'text',
                'title' => esc_html__('Phone Number', 'charifund'),
                'default' => '(+01)-793-7938',
                'dependency' => array('header_5_phone_enabled', '==', 'true'),
            ),
        )
    ));
  

    /* Breadcrumb */
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Breadcrumb', 'charifund'),
        'id' => 'breadcrumb_options',
        'icon' => ' eicon-product-breadcrumbs',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Breadcrumb Options', 'charifund') . '</h3>'
            ),
            array(
                'id' => 'breadcrumb_enabled',
                'title' => esc_html__('Breadcrumb', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'charifund'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'breadcrumb_subtitle',
                'type' => 'text',
                'title' => esc_html__('Sub-title Text', 'charifund'),
                'dependency' => array('breadcrumb_enabled', '==', 'true'),
                'default' => esc_html__('<i class="icon-donation"></i>Start donating poor people', 'charifund')
            ),
            array(
                'id' => 'breadcrumb_shape_image',
                'type' => 'media',
                'title' => esc_html__('Shape Image', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark>shape image</mark> here.', 'charifund'), $allowed_html),
                'dependency' => array('breadcrumb_enabled', '==', 'true')
            ),
            array(
                'id' => 'breadcrumb_shape_image_2',
                'type' => 'media',
                'title' => esc_html__('Shape Image 2', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark>shape image</mark> here.', 'charifund'), $allowed_html),
                'dependency' => array('breadcrumb_enabled', '==', 'true')
            ),
            array(
                'id' => 'breadcrumb_shape_image_3',
                'type' => 'media',
                'title' => esc_html__('Shape Image 3', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark>shape image</mark> here.', 'charifund'), $allowed_html),
                'dependency' => array('breadcrumb_enabled', '==', 'true')
            ),
        )
    ));

    /*-------------------------------------------------------
           ** Footer  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Footer', 'charifund'),
        'id' => 'footer_options',
        'icon' => ' eicon-footer',
    ));
    // Default Footer  Options
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'id' => 'footer_general_options',
        'title' => esc_html__('Default Footer', 'charifund'),
        'icon' => 'fa fa-list-ul',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Default Footer Settings', 'charifund') . '</h3>'
            ),  
            array(
                'id' => 'footer_default_newsletter_enabled',
                'title' => esc_html__('Show Newsletter Section', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide newsletter', 'charifund'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'footer_default_newsletter_title',
                'type' => 'text',
                'title' => esc_html__('Newsletter', 'charifund'),
                'dependency' => array('footer_default_newsletter_enabled', '==', 'true'),
                'default' => esc_html__('Subscribe to Our Newsletter', 'charifund')
            ),         
            array(
                'id' => 'footer_default_newsletter_text',
                'type' => 'text',
                'title' => esc_html__('Newsletter Text', 'charifund'),
                'dependency' => array('footer_default_newsletter_enabled', '==', 'true'),
                'default' => esc_html__('Regular inspections and feedback mechanisms', 'charifund')
            ), 
            array(
                'id' => 'footer_default_newsletter_shortcode',
                'type' => 'text',
                'title' => esc_html__('Newsletter ShortCode', 'charifund'),
                'dependency' => array('footer_default_newsletter_enabled', '==', 'true'),
                'default' => esc_html__('#', 'charifund')
            ),  
            array(
                'id' => 'footer_default_logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
            ),  
            array(
                'id' => 'footer_default_text',
                'type' => 'textarea',
                'title' => esc_html__('Paragraph Text Here', 'charifund'),
                'default' => esc_html__('Nullam interdum libero vitae pretium aliquam donec nibh purus laoreet in ullamcorper vel malesuada sit amet enim.', 'charifund')
            ),
            array(
                'id'        => 'footer_default_socials_repeater',
                'type'      => 'repeater',
                'title'     => 'Socials Info Repeater',
                'fields'    => array(              
                  array(
                    'id'    => 'footer_default_socials_icon',
                    'type'  => 'icon',
                    'default' => 'fab fa-facebook-f',
                    'title' => 'Socials Info Icon',
                  ),  
                  array(
                    'id'    => 'footer_default_socials_icon_url',
                    'type'  => 'text',
                    'title' => 'Socials Info Url',
                  ),
              
                )
            ),
            array(
                'id' => 'footer_default_contact_title',
                'type' => 'text',
                'title' => esc_html__('Contact Title', 'charifund'),
                'default' => esc_html__('Get In Touch', 'charifund')
            ),
            array(
                'id'        => 'footer_default_contacts_repeater',
                'type'      => 'repeater',
                'title'     => 'Contacts Info Repeater',
                'fields'    => array(              
                  array(
                    'id'    => 'footer_default_contacts_icon',
                    'type'  => 'icon',
                    'default' => 'fab fa-facebook-f',
                    'title' => 'Contact Info Icon',
                  ),  
                  array(
                    'id'    => 'footer_default_contacts_title',
                    'type'  => 'text',
                    'title' => 'Contact Info Title',
                  ),  
                  array(
                    'id'    => 'footer_default_contacts_title_url',
                    'type'  => 'text',
                    'title' => 'Contact Info Url',
                  ),
              
                )
            ),  
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Footer Copyright Area Options', 'charifund') . '</h3>'
            ), 
            array(
                'id'        => 'footer_default_terms_repeater',
                'type'      => 'repeater',
                'title'     => 'Terms Repeater',
                'fields'    => array( 
                  array(
                    'id'    => 'footer_default_terms_title',
                    'type'  => 'text',
                    'title' => 'Title',
                  ),  
                  array(
                    'id'    => 'footer_default_terms_title_url',
                    'type'  => 'text',
                    'title' => 'Url',
                  ),
              
                )
            ),   
            array(
                'id' => 'footer_default_bg_shape',
                'type' => 'media',
                'title' => esc_html__('Shape Image 1', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'charifund'), $allowed_html),
            ),     
            array(
                'id' => 'footer_default_bg_shape_2',
                'type' => 'media',
                'title' => esc_html__('Shape Image 2', 'charifund'),
                'library' => 'image',
                'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'charifund'), $allowed_html),
            ),     
            array(
                'id' => 'copyright_text',
                'title' => esc_html__('Copyright Area Text', 'charifund'),
                'type' => 'text',
                'desc' => wp_kses(__('use  <mark>{copy}</mark> for copyright symbol, use <mark>{year}</mark> for current year, ', 'charifund'), $allowed_html)
            ),
          
        )
    ));

    /*-------------------------------------------------------
           ** Footer Style One
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'id' => 'footer_one_options',
        'title' => esc_html__('Footer One', 'charifund'),
        'icon' => 'fa fa-list-ul',
        'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Footer 1 Settings', 'charifund') . '</h3>'
        ),  
        array(
            'id' => 'footer_1_newsletter_enabled',
            'title' => esc_html__('Show Newsletter Section', 'charifund'),
            'type' => 'switcher',
            'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide newsletter', 'charifund'), $allowed_html),
            'default' => true,
        ),
        array(
            'id' => 'footer_1_newsletter_title',
            'type' => 'text',
            'title' => esc_html__('Newsletter', 'charifund'),
            'dependency' => array('footer_1_newsletter_enabled', '==', 'true'),
            'default' => esc_html__('Subscribe to Our Newsletter', 'charifund')
        ),         
        array(
            'id' => 'footer_1_newsletter_text',
            'type' => 'text',
            'title' => esc_html__('Newsletter Text', 'charifund'),
            'dependency' => array('footer_1_newsletter_enabled', '==', 'true'),
            'default' => esc_html__('Regular inspections and feedback mechanisms', 'charifund')
        ), 
        array(
            'id' => 'footer_1_newsletter_shortcode',
            'type' => 'text',
            'title' => esc_html__('Newsletter ShortCode', 'charifund'),
            'dependency' => array('footer_1_newsletter_enabled', '==', 'true'),
            'default' => esc_html__('#', 'charifund')
        ),  
        array(
            'id' => 'footer_1_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),  
        array(
            'id' => 'footer_1_text',
            'type' => 'textarea',
            'title' => esc_html__('Paragraph Text Here', 'charifund'),
            'default' => esc_html__('Nullam interdum libero vitae pretium aliquam donec nibh purus laoreet in ullamcorper vel malesuada sit amet enim.', 'charifund')
        ),
        array(
            'id'        => 'footer_1_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'fields'    => array(              
                array(
                'id'    => 'footer_1_socials_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Info Icon',
                ),  
                array(
                'id'    => 'footer_1_socials_icon_url',
                'type'  => 'text',
                'title' => 'Socials Info Url',
                ),
            
            )
        ),
        array(
            'id' => 'footer_1_contact_title',
            'type' => 'text',
            'title' => esc_html__('Contact Title', 'charifund'),
            'default' => esc_html__('Get In Touch', 'charifund')
        ),
        array(
            'id'        => 'footer_1_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contacts Info Repeater',
            'fields'    => array(              
                array(
                'id'    => 'footer_1_contacts_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Contact Info Icon',
                ),  
                array(
                'id'    => 'footer_1_contacts_title',
                'type'  => 'text',
                'title' => 'Contact Info Title',
                ),  
                array(
                'id'    => 'footer_1_contacts_title_url',
                'type'  => 'text',
                'title' => 'Contact Info Url',
                ),
            
            )
        ),  
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Footer Copyright Area Options', 'charifund') . '</h3>'
        ), 
        array(
            'id'        => 'footer_1_terms_repeater',
            'type'      => 'repeater',
            'title'     => 'Terms Repeater',
            'fields'    => array( 
                array(
                'id'    => 'footer_1_terms_title',
                'type'  => 'text',
                'title' => 'Title',
                ),  
                array(
                'id'    => 'footer_1_terms_title_url',
                'type'  => 'text',
                'title' => 'Url',
                ),
            
            )
        ),   
        array(
            'id' => 'footer_1_bg_shape',
            'type' => 'media',
            'title' => esc_html__('Shape Image 1', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'charifund'), $allowed_html),
        ),     
        array(
            'id' => 'footer_1_bg_shape_2',
            'type' => 'media',
            'title' => esc_html__('Shape Image 2', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> shape image</mark> here', 'charifund'), $allowed_html),
        ), 

        )
    ));


    /*-------------------------------------------------------
           ** Footer Style Two
    --------------------------------------------------------*/

    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'id' => 'footer_two_options',
        'title' => esc_html__('Footer Two', 'charifund'),
        'icon' => 'fa fa-list-ul',
        'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Footer 2 Settings', 'charifund') . '</h3>'
        ), 
        array(
            'id' => 'footer_2_text',
            'type' => 'text',
            'title' => esc_html__('Text', 'charifund'),
            'default' => esc_html__('children need your help start <span>donating</span> today', 'charifund')
        ), 
        array(
            'id' => 'footer_2_right_btn_enabled',
            'title' => esc_html__('Show Right Button', 'charifund'),
            'type' => 'switcher',
            'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide button', 'charifund'), $allowed_html),
            'default' => true,
        ),
        array(
            'id' => 'footer_2_right_btn_text',
            'type' => 'text',
            'title' => esc_html__('Right Button', 'charifund'),
            'dependency' => array('footer_2_right_btn_enabled', '==', 'true'),
            'default' => esc_html__('for Any Inquiry <span>@WOWtheme.co</span>', 'charifund')
        ), 
        array(
            'id' => 'footer_2_right_btn_url',
            'type' => 'text',
            'title' => esc_html__('Right Button Url', 'charifund'),
            'dependency' => array('footer_2_right_btn_enabled', '==', 'true'),
            'default' => esc_html__('#', 'charifund')
        ), 
        array(
            'id' => 'footer_2_newsletter_title',
            'type' => 'text',
            'title' => esc_html__('Newsletter', 'charifund'),
            'default' => esc_html__('Subscribe Newsletter', 'charifund')
        ),         
        array(
            'id' => 'footer_2_newsletter_text',
            'type' => 'text',
            'title' => esc_html__('Newsletter Text', 'charifund'),
            'default' => esc_html__('We understand that every challenge is an opportunity ', 'charifund')
        ), 
        array(
            'id' => 'footer_2_newsletter_shortcodes',
            'type' => 'text',
            'title' => esc_html__('Newsletter ShortCode', 'charifund'),
            'default' => esc_html__('', 'charifund')
        ), 
        array(
            'id' => 'footer_2_newsletter_check_text',
            'type' => 'text',
            'title' => esc_html__('Newsletter Check Box', 'charifund'),
            'default' => esc_html__('By subscribing, you are accepting our <a href="#">Privacy Policy</a>', 'charifund')
        ),
        array(
            'id' => 'footer_2_menu_title',
            'type' => 'text',
            'title' => esc_html__('Menu Title', 'charifund'),
            'default' => esc_html__('Services', 'charifund')
        ), 
        array(
            'id'        => 'footer_2_menu_repeater',
            'type'      => 'repeater',
            'title'     => 'Menu Repeater',
            'fields'    => array(   
                array(
                'id'    => 'footer_2_menu_title',
                'type'  => 'text',
                'title' => 'Menu Title',
                ),
                array(
                'id'    => 'footer_2_menu_title_url',
                'type'  => 'text',
                'title' => 'Menu Url',
                ),
            
            )
        ), 
        array(
            'id'        => 'footer_2_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contacts Info Repeater',
            'fields'    => array(   
                array(
                'id'    => 'footer_2_contacts_title',
                'type'  => 'text',
                'title' => 'Contact Info Title',
                ),  
                array(
                'id'    => 'footer_2_contacts_subtitle',
                'type'  => 'text',
                'title' => 'Contact Info Sub-Title',
                ),
                array(
                'id'    => 'footer_2_contacts_subtitle_url',
                'type'  => 'text',
                'title' => 'Contact Info Url',
                ),
            
            )
        ),       
         
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Footer Copyright Area Options', 'charifund') . '</h3>'
        ), 
        array(
            'id' => 'footer_2_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id'        => 'footer_2_terms_repeater',
            'type'      => 'repeater',
            'title'     => 'Terms Repeater',
            'fields'    => array( 
                array(
                'id'    => 'footer_2_terms_title',
                'type'  => 'text',
                'title' => 'Title',
                ),  
                array(
                'id'    => 'footer_2_terms_title_url',
                'type'  => 'text',
                'title' => 'Url',
                ),
            
            )
        ),  

        )
    ));


      /*-------------------------------------------------------
           ** Footer Style Three
    --------------------------------------------------------*/

    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'footer_options',
        'id' => 'footer_three_options',
        'title' => esc_html__('Footer Three', 'charifund'),
        'icon' => 'fa fa-list-ul',
        'fields' => array(
        array(
            'type' => 'subheading',
            'content' => '<h3>' . esc_html__('Footer 3 Settings', 'charifund') . '</h3>'
        ), 
        array(
            'id' => 'footer_3_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'charifund'),
            'library' => 'image',
            'desc' => wp_kses(__('you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'charifund'), $allowed_html),
        ),
        array(
            'id'        => 'footer_3_terms_repeater',
            'type'      => 'repeater',
            'title'     => 'Terms Repeater',
            'fields'    => array( 
                array(
                'id'    => 'footer_3_terms_title',
                'type'  => 'text',
                'title' => 'Title',
                ),  
                array(
                'id'    => 'footer_3_terms_title_url',
                'type'  => 'text',
                'title' => 'Url',
                ),
            
            )
        ), 
        array(
            'id'        => 'footer_3_socials_repeater',
            'type'      => 'repeater',
            'title'     => 'Socials Info Repeater',
            'fields'    => array(              
                array(
                'id'    => 'footer_3_socials_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Info Icon',
                ),  
                array(
                'id'    => 'footer_3_socials_icon_url',
                'type'  => 'text',
                'title' => 'Socials Info Url',
                ),
            
            )
        ),
        array(
            'id' => 'footer_3_about_title',
            'type' => 'text',
            'title' => esc_html__('About Title', 'charifund'),
            'default' => esc_html__('About Us', 'charifund')
        ),
        array(
            'id' => 'footer_3_about_text',
            'type' => 'text',
            'title' => esc_html__('About Text', 'charifund'),
            'default' => esc_html__('We believe it has the power to do amazing things together.', 'charifund')
        ),
        array(
            'id' => 'footer_3_about_mail',
            'type' => 'text',
            'title' => esc_html__('About Email', 'charifund'),
            'default' => esc_html__('<a href="mailto:support@example.com">example@email.com</a>', 'charifund')
        ),
        array(
            'id' => 'footer_3_opening_title',
            'type' => 'text',
            'title' => esc_html__('Opening Title', 'charifund'),
            'default' => esc_html__('Opening Hours', 'charifund')
        ),
        array(
            'id' => 'footer_3_opening_text',
            'type' => 'text',
            'title' => esc_html__('Opening Text', 'charifund'),
            'default' => esc_html__('9.30am - 6.30pm<br>Monday to Friday', 'charifund')
        ),
        array(
            'id' => 'footer_3_blog_title',
            'type' => 'text',
            'title' => esc_html__('Blog Title', 'charifund'),
            'default' => esc_html__('Latest Post', 'charifund')
        ),
        array(
            'id' => 'footer_3_contact_info_title',
            'type' => 'text',
            'title' => esc_html__('Contact Info Title', 'charifund'),
            'default' => esc_html__('Get In Touch', 'charifund')
        ),
        array(
            'id'        => 'footer_3_contacts_repeater',
            'type'      => 'repeater',
            'title'     => 'Contacts Info Repeater',
            'fields'    => array(  
                array(
                'id'    => 'footer_3_contacts_icon',
                'type'  => 'icon',
                'default' => 'fab fa-facebook-f',
                'title' => 'Socials Info Icon',
                ), 
                array(
                'id'    => 'footer_3_contacts_title',
                'type'  => 'text',
                'title' => 'Contact Info Title',
                ),  
                array(
                'id'    => 'footer_3_contacts_subtitle',
                'type'  => 'text',
                'title' => 'Contact Info Sub-Title',
                ),
                array(
                'id'    => 'footer_3_contacts_subtitle_url',
                'type'  => 'text',
                'title' => 'Contact Info Url',
                ),
            
            )
        ), 
        array(
            'id' => 'footer_3_newsletter_title',
            'type' => 'text',
            'title' => esc_html__('Newsletter', 'charifund'),
            'default' => esc_html__('Subscribe Newsletter', 'charifund')
        ),         
        array(
            'id' => 'footer_3_newsletter_text',
            'type' => 'text',
            'title' => esc_html__('Newsletter Text', 'charifund'),
            'default' => esc_html__('We understand that every challenge is an opportunity ', 'charifund')
        ), 
        array(
            'id' => 'footer_3_newsletter_shortcodes',
            'type' => 'text',
            'title' => esc_html__('Newsletter ShortCode', 'charifund'),
            'default' => esc_html__('', 'charifund')
        ),       
        

        )
    ));


    /*-------------------------------------------------------
          ** Blog  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_settings',
        'title' => esc_html__('Blog Settings', 'charifund'),
        'icon' => 'fa fa-book'
    ));
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'blog_settings',
        'id' => 'blog_post_options',
        'title' => esc_html__('Blog Post', 'charifund'),
        'icon' => 'fa fa-list-ul',
        'fields' => Charifund_Group_Fields::post_meta('blog_post', esc_html__('Blog Page', 'charifund'))
    ));
    CSF::createSection($prefix . '_theme_options', array(
        'parent' => 'blog_settings',
        'id' => 'blog_single_post_options',
        'title' => esc_html__('Single Post', 'charifund'),
        'icon' => 'fa fa-list-alt',
        'fields' => Charifund_Group_Fields::post_meta('blog_single_post', esc_html__('Blog Single Page', 'charifund'))
    )); 

    /*-------------------------------------------------------
          ** Pages & templates Options
   --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'pages_and_template',
        'title' => esc_html__('Pages Settings', 'charifund'),
        'icon' => 'fa fa-files-o'
    ));
    /*  404 page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => '404_page',
        'title' => esc_html__('404 Page', 'charifund'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-exclamation-triangle',
        'fields' => array(
            array(
                'id' => 'error_bg_switch',
                'title' => esc_html__('404 Image Enable', 'charifund'),
                'type' => 'switcher',
                'desc' => wp_kses(__('you can set <mark>Yes / No</mark> to show/hide breadcrumb', 'charifund'), $allowed_html),
                'default' => true,
            ),
            array(
                'id' => 'error_bg',
                'title' => esc_html__('404 Image', 'charifund'),
                'type' => 'media',
                'desc' => wp_kses(__('you can set <mark>background</mark> for breadcrumb', 'charifund'), $allowed_html),
                'dependency' => array('error_bg_switch', '==', 'true')
            ),
            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('404 Page Options', 'charifund') . '</h3>',
            ),
            array(
                'id' => '404_title',
                'title' => esc_html__('Title', 'charifund'),
                'type' => 'text',
                'info' => wp_kses(__('you can change <mark>title</mark> of 404 page', 'charifund'), $allowed_html),
                'attributes' => array('placeholder' => esc_html__('Sorry! The Page Not Found', 'charifund'))
            ),
            array(
                'id' => '404_paragraph',
                'title' => esc_html__('Paragraph', 'charifund'),
                'type' => 'textarea',
                'info' => wp_kses(__('you can change <mark>paragraph</mark> of 404 page', 'charifund'), $allowed_html),
                'attributes' => array('placeholder' => esc_html__('Oops! The page you are looking for does not exit. it might been moved or deleted.', 'charifund'))
            ),
            array(
                'id' => '404_button_text',
                'title' => esc_html__('Button Text', 'charifund'),
                'type' => 'text',
                'info' => wp_kses(__('you can change <mark>button text</mark> of 404 page', 'charifund'), $allowed_html),
                'attributes' => array('placeholder' => esc_html__('back to home', 'charifund'))
            ),
        )
    ));

    /*  blog page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_page',
        'title' => esc_html__('Blog Page', 'charifund'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-indent',
        'fields' => Charifund_Group_Fields::page_layout_options(esc_html__('Blog', 'charifund'), 'blog')
    ));
    /*  blog single page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'blog_single_page',
        'title' => esc_html__('Blog Single Page', 'charifund'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-indent',
        'fields' => Charifund_Group_Fields::page_layout_options(esc_html__('Blog Single', 'charifund'), 'blog_single')
    ));
    /*  archive page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'archive_page',
        'title' => esc_html__('Archive Page', 'charifund'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-archive',
        'fields' => Charifund_Group_Fields::page_layout_options(esc_html__('Archive', 'charifund'), 'archive')
    ));
    /*  search page options */
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'search_page',
        'title' => esc_html__('Search Page', 'charifund'),
        'parent' => 'pages_and_template',
        'icon' => 'fa fa-search',
        'fields' => Charifund_Group_Fields::page_layout_options(esc_html__('Search', 'charifund'), 'search')
    ));

    /*-------------------------------------------------------
           ** Backup  Options
    --------------------------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'id' => 'backup',
        'title' => esc_html__('Import / Export', 'charifund'),
        'icon' => 'eicon-export-kit',
        'fields' => array(
            array(
                'type' => 'notice',
                'style' => 'warning',
                'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'charifund'),
            ),
            array(
                'type' => 'backup',
                'title' => esc_html__('Backup & Import', 'charifund')
            )
        )
    ));
}
