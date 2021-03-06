<?php
/**
 * Field: Baths
 *
 * Baths field for advance property search.
 *
 * @since    3.0.0
 * @package RH/modern
 */

?>

<div class="rh_prop_search__option rh_prop_search__select rh_baths_field_wrapper">
    <label for="select-bathrooms">
		<?php
		$inspiry_min_baths_label = get_option( 'inspiry_min_baths_label' );
		if ( $inspiry_min_baths_label ) {
			echo esc_html( $inspiry_min_baths_label );
		} else {
			esc_html_e( 'Min Baths', 'framework' );
		}
		?>
    </label>
    <span class="rh_prop_search__selectwrap">
		<select name="bathrooms" id="select-bathrooms" class="rh_select2">
			<?php inspiry_min_baths(); ?>
		</select>
	</span>
</div>
