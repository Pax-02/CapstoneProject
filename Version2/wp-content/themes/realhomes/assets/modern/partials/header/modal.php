<?php
/**
 * Header Modal
 *
 * Header modal for login in the header.
 *
 * @package realhomes
 * @subpackage modern
 */

?>

<div class="rh_modal">
	<?php
	if ( is_user_logged_in() ) { ?>
        <div class="rh_modal__corner"></div>
        <!-- /.rh_modal__corner -->

        <div class="rh_modal__wrap">
            <div class="rh_user">
                <div class="rh_user__avatar">
					<?php
					$current_user      = wp_get_current_user();
					$current_user_meta = get_user_meta( $current_user->ID );

					if ( isset( $current_user_meta['profile_image_id'][0] ) ) {
						echo wp_get_attachment_image( $current_user_meta['profile_image_id'][0], array(
							'40',
							'40'
						), "", array( "class" => "rh_modal_profile_img" ) );
					} else {
						$user_email    = $current_user->user_email;
						$user_gravatar = inspiry_get_gravatar( $user_email, '150' );
						?>
                        <img alt="<?php echo esc_attr( $current_user->display_name ); ?>"
                             src="<?php echo esc_url( $user_gravatar ); ?>">
						<?php
					}
					?>

                </div>
                <!-- /.rh_user__avatar -->
                <div class="rh_user__details">
                    <p class="rh_user__msg"><?php esc_html_e( 'Welcome', 'framework' ); ?></p>
                    <!-- /.rh_user__msg -->
                    <h3 class="rh_user__name">
						<?php echo esc_html( $current_user->display_name ); ?>
                    </h3>
                </div>
                <!-- /.rh_user__details -->
            </div>
            <!-- /.rh_user -->

            <div class="rh_modal__dashboard">

				<?php
				$profile_url = inspiry_get_edit_profile_url();
				if ( ! empty( $profile_url ) ) :
					?>
                    <a href="<?php echo esc_url( $profile_url ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/images/icons/icon-dash-profile.svg' ); ?>
                        <span><?php esc_html_e( 'Profile', 'framework' ); ?></span>
                    </a>
				<?php
				endif;

				$my_properties_url = inspiry_get_my_properties_url();
				if ( ! empty( $my_properties_url ) ) :
					?>
                    <a href="<?php echo esc_url( $my_properties_url ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/images/icons/icon-dash-my-properties.svg' ); ?>
                        <span><?php esc_html_e( 'My Properties', 'framework' ); ?></span>
                    </a>
				<?php
				endif;

				$favorites_url = inspiry_get_favorites_url(); // Favorites page.
				if ( ! empty( $favorites_url ) ) :
					?>
                    <a href="<?php echo esc_url( $favorites_url ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/images/icons/icon-dash-favorite.svg' ); ?>
                        <span><?php esc_html_e( 'Favorites', 'framework' ); ?></span>
                    </a>
				<?php
				endif;

				$compare_properties_module = get_option( 'theme_compare_properties_module' );
				$compare_url               = inspiry_get_compare_url(); // Compare page.
				if ( ( 'enable' === $compare_properties_module ) && ! empty( $compare_url ) ) :
					?>
                    <a href="<?php echo esc_url( $compare_url ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
                        <span><?php esc_html_e( 'Compare', 'framework' ); ?></span>
                    </a>
				<?php
				endif;

				if ( function_exists( 'IMS_Functions' ) ) {
					$ims_functions         = IMS_Functions();
					$is_memberships_enable = $ims_functions::is_memberships();
				}
				$membership_url = inspiry_get_membership_url(); // Memberships page.
				if ( ( ! empty( $is_memberships_enable ) ) && ! empty( $membership_url ) ) :
					?>
                    <a href="<?php echo esc_url( $membership_url ); ?>" class="rh_modal__dash_link">
						<?php inspiry_safe_include_svg( '/images/icons/icon-membership.svg' ); ?>
                        <span><?php esc_html_e( 'Membership', 'framework' ); ?></span>
                    </a>
				<?php endif; ?>

                <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="rh_modal__dash_link">
					<?php inspiry_safe_include_svg( '/images/icons/icon-dash-logout.svg' ); ?>
                    <span><?php esc_html_e( 'Log Out', 'framework' ); ?></span>
                </a>

            </div>
            <!-- /.rh_modal__dashboard -->
        </div>
        <!-- /.rh_modal__wrap -->
	<?php } ?>
</div>
<!-- /.rh_menu__modal -->




