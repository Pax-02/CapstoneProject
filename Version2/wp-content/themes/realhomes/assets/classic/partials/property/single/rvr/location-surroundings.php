<?php

/* Location Surroundings */
$location_surroundings = get_post_meta( get_the_ID(), 'rvr_surroundings', true );
if ( ! empty( $location_surroundings ) ) {
	?>
    <div class="rvr-location-surrounding">
        <h4 class="additional-title"><?php
	        $rvr_settings = get_option( 'rvr_settings' );
	        echo ! empty( $rvr_settings['rvr_surroundings_label'] ) ? esc_html( $rvr_settings['rvr_surroundings_label'] ) : esc_html__( 'Surroundings', 'framework' );
            ?></h4>
        <ul class="additional-details clearfix">
			<?php
			foreach ( $location_surroundings as $surrounding ) {

				if ( isset( $surrounding['rvr_surrounding_point'] ) && ! empty( $surrounding['rvr_surrounding_point'] ) ) {
					echo '<li><h6>' . $surrounding['rvr_surrounding_point'] . '</h6></li>';
				}

				if ( isset( $surrounding['rvr_surrounding_point_distance'] ) && ! empty( $surrounding['rvr_surrounding_point_distance'] ) ) {
					?>
                    <ul class="additional-details clearfix">
                        <li><?php echo esc_html( $surrounding['rvr_surrounding_point_distance'] ); ?></li>
                    </ul>
					<?php
				}
			}
			?>
        </ul>
    </div>
	<?php
}