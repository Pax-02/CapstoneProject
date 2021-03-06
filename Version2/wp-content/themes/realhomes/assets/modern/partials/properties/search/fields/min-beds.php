<?php
/**
 * Field: Beds
 *
 * Beds field for advance property search.
 *
 * @since    3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__option rh_prop_search__select rh_beds_field_wrapper">
    <label for="select-bedrooms">
		<?php
		$inspiry_min_beds_label = get_option( 'inspiry_min_beds_label' );
		if ( $inspiry_min_beds_label ) {
			echo esc_html( $inspiry_min_beds_label );
		} else {
			esc_html_e( 'Min Beds', 'framework' );
		}
		?>
    </label>
    <span class="rh_prop_search__selectwrap">
		<select name="bedrooms" id="select-bedrooms" class="rh_select2">
			<?php inspiry_min_beds(); ?>
		</select>
	</span>
</div>
