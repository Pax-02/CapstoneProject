<?php

/* Property Policies */
$property_policies = get_post_meta( get_the_ID(), 'rvr_policies', true );
if ( ! empty( $property_policies ) ) {
	?>
    <div class="rvr-property-policies">
        <h4 class="additional-title"><?php
	        $rvr_settings = get_option( 'rvr_settings' );
	        echo ! empty( $rvr_settings['rvr_property_policies_label'] ) ? esc_html( $rvr_settings['rvr_property_policies_label'] ) : esc_html__( 'Property Policies', 'framework' );
            ?></h4>
        <ul class="additional-details clearfix">
			<?php
			foreach ( $property_policies as $property_policy ) {
				echo '<li>' . esc_html( $property_policy ) . '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}