<?php
/**
 * Section:    `Availability Calendar`
 * Panel:    `Property Detail Page`
 *
 * @since 3.8.4
 * @package RH/classic
 */

if ( ! function_exists( 'inspiry_availability_calendar_customizer' ) ) :

	/**
	 * inspiry_availability_calendar_customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @since  3.8.4
	 */
	function inspiry_availability_calendar_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Availability Calendar Section
		 */
		$wp_customize->add_section( 'inspiry_availability_calendar', array(
			'title' => esc_html__( 'Availability Calendar', 'framework' ),
			'panel' => 'inspiry_property_panel',
		) );

		/* Show/Hide Availability Calendar */
		$wp_customize->add_setting( 'inspiry_display_availability_calendar', array(
			'type'    => 'option',
			'default' => 'true',
			'sanitize_callback' => 'inspiry_sanitize_radio',
		) );
		$wp_customize->add_control( 'inspiry_display_availability_calendar', array(
			'label'   => esc_html__( 'Availability Calendar', 'framework' ),
			'type'    => 'radio',
			'section' => 'inspiry_availability_calendar',
			'choices' => array(
				'true'  => esc_html__( 'Show', 'framework' ),
				'false' => esc_html__( 'Hide', 'framework' ),
			),
		) );

		/* Property Availability Calendar Title */
		$wp_customize->add_setting( 'inspiry_availability_calendar_title', array(
			'type'              => 'option',
			'transport'         => 'postMessage',
			'default'           => esc_html__( 'Property Availability', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_availability_calendar_title', array(
			'label'   => esc_html__( 'Property Availability Title', 'framework' ),
			'type'    => 'text',
			'section' => 'inspiry_availability_calendar',
		) );

		/* Availability Calendar Title Selective Refresh */
		if ( 'classic' === INSPIRY_DESIGN_VARIATION ) {
			$availability_calendar_selector = '.availability-calendar-wrap h4';
		} elseif ( 'modern' === INSPIRY_DESIGN_VARIATION ) {
			$availability_calendar_selector = '.rh_property__ava_calendar_wrap .rh_property__heading';
		}
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'inspiry_availability_calendar_title', array(
				'selector'            => $availability_calendar_selector,
				'container_inclusive' => false,
				'render_callback'     => 'inspiry_availability_calendar_title_render',
			) );
		}
	}

	add_action( 'customize_register', 'inspiry_availability_calendar_customizer' );
endif;


if ( ! function_exists( 'inspiry_availability_calendar_title_render' ) ) {
	function inspiry_availability_calendar_title_render() {
		if ( get_option( 'inspiry_availability_calendar_title' ) ) {
			echo esc_html( get_option( 'inspiry_availability_calendar_title' ) );
		}
	}
}