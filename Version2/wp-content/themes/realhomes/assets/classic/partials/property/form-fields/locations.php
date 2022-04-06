<?php
/**
 * Location Fields
 *
 * @package RH/Classic
 */

$location_select_count  = inspiry_get_locations_number(); // number of locations chosen from theme options.
$location_select_names  = inspiry_get_location_select_names(); // Variable that contains location select boxes names.
$location_select_titles = inspiry_get_location_titles(); // Default location select boxes titles.
$location_placeholder   = inspiry_location_placeholder(); // Placeholder text for the location fields.
$select_class           = 'search-select'; // Default class for the location dropdown fields.
$is_location_ajax       = get_option( 'inspiry_ajax_location_field', 'no' ); // Option to check if location field Ajax is enabled.

if ( 'yes' === $is_location_ajax ) {
	$select_class = 'ajax-location-field';
}

// Generate required location select boxes.
for ( $i = 0; $i < $location_select_count; $i ++ ) {
	?>
	<div class="option-bar form-option location-field-wrapper">
		<label for="<?php echo esc_attr( $location_select_names[ $i ] ); ?>">
			<?php echo esc_html( $location_select_titles[ $i ] ); ?>
		</label>
		<span class="selectwrap">
			<select name="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" id="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" class="<?php echo esc_attr( $select_class ); ?>">
			<?php
			if ( 'yes' === $is_location_ajax && inspiry_is_edit_property() ) {
				global $target_property;
				$prop_locations = get_the_terms( $target_property->ID, 'property-city' );
				if ( is_array( $prop_locations ) && ! is_wp_error( $prop_locations ) ) {
					$first_location = $prop_locations[0];
					if ( is_object( $first_location ) ) {
						echo '<option value="' . esc_attr( $first_location->slug ) . '" selected="selected">' . esc_html( $first_location->name ) . '</option>';
					}
				} else {
					?>
					<option selected="selected" value=""><?php esc_html_e( 'None', 'framework' ); ?></option>
					<?php
				}
			} else {
				?>
				<option selected="selected" value=""><?php esc_html_e( 'None', 'framework' ); ?></option>
				<?php
			}
			?>
			</select>
		</span>
	</div>
	<?php
}

// important action hook - related JS works based on it.
do_action( 'after_location_fields' );
