<?php
/**
 * Theme Shortcodes Generator
 * @package charifund
 * @since 1.0.0
 */

if (!defined('ABSPATH')){
	exit(); //exit if access it directly
}

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {
	$prefix = 'charifund';
	CSF::createShortcoder( $prefix.'_shortcodes', array(
		'button_title'   => esc_html__('Add Shortcode','charifund'),
		'select_title'   => esc_html__('Select a shortcode','charifund'),
		'insert_title'   => esc_html__('Insert Shortcode','charifund')
	) );

	/*------------------------------------
		Social Icon Options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Social Icons','charifund'),
		'view'      => 'group',
		'shortcode' => 'charifund_social_icon_wrap',
		'fields' => [
            array(
                'id'      => 'custom_class',
                'type'    => 'text',
                'title'   => esc_html__('Custom Class','charifund'),
            )
        ],
		'group_shortcode' => 'charifund_social_icon',
		'group_fields'    => array(
			array(
				'id'    => 'social_icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','charifund'),
			),
			array(
				'id'      => 'social_link',
				'type'    => 'text',
				'title'   => esc_html__('URL','charifund'),
			)
		)
	) );

	/*------------------------------------
		Top Menu Options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Top Menu','charifund'),
		'view'      => 'group',
		'shortcode' => 'charifund_top_menu_wrap',
		'group_shortcode' => 'charifund_top_menu',
		'group_fields'    => array(
			array(
				'id'    => 'top_menu_text',
				'type'  => 'text',
				'title' => esc_html__('Text','charifund'),
			),
			array(
				'id'      => 'top_menu_link',
				'type'    => 'text',
				'title'   => esc_html__('URL','charifund'),
			)
		)
	) );

    /*------------------------------------
      Info Menu Options
    -------------------------------------*/
    CSF::createSection( $prefix.'_shortcodes', array(
        'title'     => esc_html__('Info Menu','charifund'),
        'view'      => 'group',
        'shortcode' => 'charifund_top_menu_wrap_02',
        'group_shortcode' => 'charifund_top_menu_02',
        'group_fields'    => array(
            array(
                'id'    => 'top_menu_title_text',
                'type'  => 'text',
                'title' => esc_html__('Text','charifund'),
            ),
            array(
                'id'    => 'top_menu_text',
                'type'  => 'text',
                'title' => esc_html__('Text','charifund'),
            ),
            array(
                'id'      => 'top_menu_link',
                'type'    => 'text',
                'title'   => esc_html__('URL','charifund'),
            )
        )
    ) );
    
	/*------------------------------------
		Inline info link options
	-------------------------------------*/
	CSF::createSection( $prefix.'_shortcodes', array(
		'title'     => esc_html__('Inline Info Link','charifund'),
		'view'      => 'group',
		'shortcode' => 'charifund_info_item_wrap',
		'group_shortcode' => 'charifund_info_link',
		'group_fields'    => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','charifund'),
			),
			array(
				'id'      => 'text',
				'type'    => 'text',
				'title'   => esc_html__('Text','charifund'),
			),
			array(
				'id'      => 'url',
				'type'    => 'text',
				'title'   => esc_html__('URL','charifund'),
			)
		)
	) );

}
