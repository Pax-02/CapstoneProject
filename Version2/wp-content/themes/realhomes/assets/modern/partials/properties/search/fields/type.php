<?php
/**
 * Field: Property Type
 *
 * Property type field for advance search.
 *
 * @since    3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__option rh_prop_search__select rh_type_field_wrapper">
    <label for="select-property-type">
		<?php
		$inspiry_property_type_label = get_option( 'inspiry_property_type_label' );
		if ( !empty( $inspiry_property_type_label ) ) {
			echo esc_html( $inspiry_property_type_label );
		} else {
			esc_html_e( 'Property Type', 'framework' );
		}
		?>
    </label>
    <span class="rh_prop_search__selectwrap">
		<select name="type" id="select-property-type" class="rh_select2">
			<?php advance_hierarchical_options( 'property-type' ); ?>
		</select>
	</span>
</div>
