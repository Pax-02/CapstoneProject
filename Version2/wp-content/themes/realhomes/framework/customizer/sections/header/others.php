<?php
/**
 * Section:    `Others`
 * Panel:    `Header`
 *
 * @since 2.6.3
 */

if ( ! function_exists( 'inspiry_header_others_customizer' ) ) :

	/**
	 * inspiry_header_others_customizer.
	 *
	 * @param  WP_Customize_Manager $wp_customize
	 *
	 * @since  2.6.3
	 */

	function inspiry_header_others_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Header Others
		 */
		$wp_customize->add_section( 'inspiry_header_others', array(
			'title' => esc_html__( 'Others', 'framework' ),
			'panel' => 'inspiry_header_panel',
		) );

		/* Sticky Header */
		$wp_customize->add_setting( 'theme_sticky_header', array(
			'type'    => 'option',
			'default' => 'false',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'theme_sticky_header', array(
			'label'   => esc_html__( 'Sticky Header', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_header_others',
			'choices' => array(
				'true'  => 'Enable',
				'false' => 'Disable',
			),
		) );

		/* Header Variation */

		if ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$wp_customize->add_setting(
				'inspiry_responsive_header_option', array(
					'type'    => 'option',
					'default' => 'solid',
					'sanitize_callback' => 'inspiry_sanitize_radio',
				)
			);
			$wp_customize->add_control(
				'inspiry_responsive_header_option', array(
					'label'       => esc_html__( 'Select Responsive Header', 'framework' ),
					'type'        => 'radio',
					'section'     => 'inspiry_header_others',
					'description' => esc_html__( 'Enabling responsive header on mobile devices.', 'framework' ),
					'choices'     => array(
						'transparent' => esc_html__( 'Transparent', 'framework' ),
						'solid'       => esc_html__( 'Solid', 'framework' ),
					),
				)
			);
		}
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {

			$wp_customize->add_setting( 'inspiry_header_variation', array(
				'type'    => 'option',
				'default' => 'default',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			) );
			$wp_customize->add_control( 'inspiry_header_variation', array(
				'label'   => esc_html__( 'Choose Header Variation', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_header_others',
				'choices' => array(
					'default' => esc_html__( 'Default', 'framework' ),
					'center'  => esc_html__( 'Center', 'framework' ),
				),
			) );

		}


		$wp_customize->add_setting(
			'inspiry_logo_filter_for_print', array(
				'type'    => 'option',
				'default' => 'none',
				'sanitize_callback' => 'inspiry_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'inspiry_logo_filter_for_print', array(
			'label'       => esc_html__( 'Site Logo Filter for Print', 'framework' ),
			'description' => esc_html__( 'Select filter for site logo to improve its readability in print.', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_header_others',
			'choices'     => array(
				'none' => esc_html__( 'None', 'framework' ),
				'contrast' => esc_html__( 'Contrast', 'framework' ),
				'grayscale' => esc_html__( 'Grayscale', 'framework' ),
				'invert' => esc_html__( 'Invert', 'framework' ),
			),
		) );
	}

	add_action( 'customize_register', 'inspiry_header_others_customizer' );
endif;


if ( ! function_exists( 'inspiry_header_others_defaults' ) ) :

	/**
	 * inspiry_header_others_defaults.
	 *
	 * @since  2.6.3
	 */

	function inspiry_header_others_defaults( WP_Customize_Manager $wp_customize ) {
		$header_others_settings_ids = array(
			'theme_sticky_header',
			'inspiry_header_variation',
			'inspiry_logo_filter_for_print',
		);
		inspiry_initialize_defaults( $wp_customize, $header_others_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_header_others_defaults' );
endif;
