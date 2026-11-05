<?php
/**
 * Theme Taxonomy Options
 * @package Charifund
 * @since 1.0.0
 */

if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}

if ( class_exists('CSF') ){

	$allowed_html = charifund_core()->kses_allowed_html(array('mark'));

	$prefix = 'charifund-core';

    /**
     * Service Category Options
     * @package charifund
     * @since 1.0.0
     */

	CSF::createTaxonomyOptions( $prefix .'_service_category', array(
		'taxonomy'  => 'service-cat',
		'data_type' => 'serialize', // The type of the database save options. `serialize` or `unserialize`
	) );

	// Create a section
	CSF::createSection( $prefix .'_service_category', array(
		'fields' => array(
			array(
				'id'    => 'icon',
				'type'  => 'icon',
				'title' => esc_html__('Icon','charifund-core'),
				'default' => 'flaticon-businessman'
			),
		)
	) );


    /**
     * Packages Category Options
     * @package charifund
     * @since 1.0.0
     */
    CSF::createTaxonomyOptions( $prefix .'_packages_category', array(
        'taxonomy'  => 'packages-cat',
        'data_type' => 'serialize', // The type of the database save options. `serialize` or `unserialize`
    ) );

    // Create a section
    CSF::createSection( $prefix .'_packages_category', array(
        'fields' => array(
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => esc_html__('Icon','charifund-core'),
                'default' => 'flaticon-statistics'
            ),
        )
    ) );


    /**
     * project Category Options
     * @package charifund
     * @since 1.0.0
     */
    CSF::createTaxonomyOptions( $prefix .'_project_category', array(
        'taxonomy'  => 'project-cat',
        'data_type' => 'serialize', // The type of the database save options. `serialize` or `unserialize`
    ) );

    // Create a section
    CSF::createSection( $prefix .'_project_category', array(
        'fields' => array(
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => esc_html__('Icon','charifund-core'),
                'default' => 'flaticon-suitcase'
            ),
        )
    ) );

    /**
     * Team Category Options
     * @package charifund
     * @since 1.0.0
     */
    CSF::createTaxonomyOptions( $prefix .'_team_category', array(
        'taxonomy'  => 'team-cat',
        'data_type' => 'serialize', // The type of the database save options. `serialize` or `unserialize`
    ) );

    // Create a section
    CSF::createSection( $prefix .'_team_category', array(
        'fields' => array(
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => esc_html__('Icon','charifund-core'),
                'default' => 'flaticon-suitcase'
            ),
        )
    ) );

}//endif