<?php
/**
 * Property property policies of single property.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;

/* Property Property Policies */
$property_policies = get_post_meta( get_the_ID(), 'rvr_policies', true );
if ( ! empty( $property_policies ) ) {
	?>
    <div class="rh_property__features_wrap">
        <h4 class="rh_property__heading"><?php
	        $rvr_settings = get_option( 'rvr_settings' );
	        echo ! empty( $rvr_settings['rvr_property_policies_label'] ) ? esc_html( $rvr_settings['rvr_property_policies_label'] ) : esc_html__( 'Property Policies', 'framework' );
            ?></h4>
        <ul class="rh_property__features arrow-bullet-list no-link-list property-policy">
			<?php
			foreach ( $property_policies as $property_policy ) {
				echo '<li class="rh_property__feature">';
				echo '<span class="rh_done_icon">';
				inspiry_safe_include_svg( '/images/icons/done.svg' );
				echo '</span>';
				echo esc_html( $property_policy );
				echo '</li>';
			}
			?>
        </ul>
    </div>
	<?php
}