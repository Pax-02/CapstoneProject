<?php
/**
 * User Sync Customizer Settings
 *
 * @package RH/Customizer
 */

if ( ! function_exists( 'inspiry_user_sync_customizer' ) ) :
	/**
	 * Add User Synce related customizer options.
	 *
	 * @param WP_Customize_Manager $wp_customize provides WP_Customize_Manager type object to add sections and settings.
	 */
	function inspiry_user_sync_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Payments Section
		 */
		$wp_customize->add_section(
			'inspiry_members_user_sync',
			array(
				'title' => esc_html__( 'User & Agent/Agency Sync', 'framework' ),
				'panel' => 'inspiry_members_panel',
			)
		);

		/* Enable/Disable User Sync with Agents/Agencies */
		$wp_customize->add_setting(
			'inspiry_user_sync',
			array(
				'type'              => 'option',
				'default'           => 'false',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);

		$wp_customize->add_control(
			'inspiry_user_sync',
			array(
				'label'   => esc_html__( 'Enable User Synchronisation with Agent/Agency', 'framework' ),
				'type'    => 'radio',
				'section' => 'inspiry_members_user_sync',
				'choices' => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
			)
		);

		/* Enable/Disable Avatar support as fallback for Agent/Agency/Profile Image. */
		$wp_customize->add_setting(
			'inspiry_user_sync_avatar_fallback',
			array(
				'type'              => 'option',
				'default'           => 'true',
				'sanitize_callback' => 'inspiry_sanitize_radio',
			)
		);

		$wp_customize->add_control(
			'inspiry_user_sync_avatar_fallback',
			array(
				'label'           => esc_html__( 'Enable Avatar as fallback for Agent/Agency/User-Profile Image', 'framework' ),
				'type'            => 'radio',
				'section'         => 'inspiry_members_user_sync',
				'choices'         => array(
					'true'  => esc_html__( 'Yes', 'framework' ),
					'false' => esc_html__( 'No', 'framework' ),
				),
				'active_callback' => 'inspiry_user_sync',
			)
		);
	}

	add_action( 'customize_register', 'inspiry_user_sync_customizer' );
endif;

if ( ! function_exists( 'inspiry_user_sync' ) ) {
	/**
	 * Check if User Sync function is enabled.
	 *
	 * @param object $control complete setting control.
	 */
	function inspiry_user_sync( $control ) {
		if ( 'true' === $control->manager->get_setting( 'inspiry_user_sync' )->value() ) {
			return true;
		}

		return false;
	}
}
