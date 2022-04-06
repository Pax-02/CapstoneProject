<?php
/**
 * Property location surroundings of single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

/* Property Location Surroundings */
$location_surroundings = get_post_meta( get_the_ID(), 'rvr_surroundings', true );
if ( ! empty( $location_surroundings ) ) {
	?>
    <div class="rh_property__features_wrap">
        <h4 class="rh_property__heading"><?php
			$rvr_settings = get_option( 'rvr_settings' );
			echo ! empty( $rvr_settings['rvr_surroundings_label'] ) ? esc_html( $rvr_settings['rvr_surroundings_label'] ) : esc_html__( 'Surroundings', 'framework' );
			?></h4>
		<?php
		foreach ( $location_surroundings as $surrounding ) {

			if ( isset( $surrounding['rvr_surrounding_point'] ) && ! empty( $surrounding['rvr_surrounding_point'] ) ) {
				echo '<h5>' . esc_html( $surrounding['rvr_surrounding_point'] ) . '</h5>';
			}

			if ( isset( $surrounding['rvr_surrounding_point_distance'] ) && ! empty( $surrounding['rvr_surrounding_point_distance'] ) ) {
				?>
                <ul class="rh_property__features arrow-bullet-list no-link-list">
                    <li class="rh_property__feature">
                        <span class="rh_done_icon"><?php inspiry_safe_include_svg( '/images/icons/done.svg' ); ?></span>
						<?php echo esc_html( $surrounding['rvr_surrounding_point_distance'] ); ?>
                    </li>
                </ul>
				<?php
			}
		}
		?>
    </div>
	<?php
}