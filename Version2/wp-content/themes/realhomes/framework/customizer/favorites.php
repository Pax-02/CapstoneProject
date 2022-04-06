<?php
/**
 * Section: Favorites
 *
 * Favorites customizer settings.
 *
 * @since 3.3.0
 * @package RH
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'inspiry_favorites_section' ) ) {

	/**
	 * Favorites section of customizer.
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 *
	 * @since 3.3.0
	 */
	function inspiry_favorites_section( WP_Customize_Manager $wp_customize ) {

		/**
		 * Favorites
		 */
		$wp_customize->add_section( 'inspiry_members_favorites', array(
			'title'    => esc_html__( 'Favorites Properties', 'framework' ),
			'priority' => 130,
		) );

		/* Enable/Disable Add to Favorites */
		$wp_customize->add_setting( 'theme_enable_fav_button', array(
			'type'              => 'option',
			'default'           => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_enable_fav_button', array(
			'label'   => esc_html__( 'Add to Favorites Button on Property Detail Page', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* My Favorites Page */
		$wp_customize->add_setting( 'inspiry_favorites_page', array(
			'type'              => 'option',
			'sanitize_callback' => 'inspiry_sanitize_select',
		) );
		$wp_customize->add_control( 'inspiry_favorites_page', array(
			'label'       => esc_html__( 'Select Favorite Properties Page', 'framework' ),
			'description' => esc_html__( 'Selected page should have Favorite Properties Template assigned to it.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_members_favorites',
			'choices'     => inspiry_pages(),
		) );

		/* Require Login to Favorite Properties */
		$wp_customize->add_setting( 'inspiry_login_on_fav', array(
			'type'              => 'option',
			'default'           => 'no',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_login_on_fav', array(
			'label'   => esc_html__( 'Require Login for Add to Favorites.', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'framework' ),
				'no'  => esc_html__( 'No', 'framework' ),
			),
		) );

	}

	add_action( 'customize_register', 'inspiry_favorites_section' );
}


if ( ! function_exists( 'inspiry_favorites_section_defaults' ) ) :
	/**
	 * Set default values for url slugs settings
	 *
	 * @param object $wp_customize — Instance of WP_Customize_Manager.
	 */
	function inspiry_favorites_section_defaults( WP_Customize_Manager $wp_customize ) {
		$news_settings_ids = array(
			'theme_enable_fav_button',
		);
		inspiry_initialize_defaults( $wp_customize, $news_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_favorites_section_defaults' );
endif;