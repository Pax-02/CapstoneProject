<?php
/**
 * Field: Garages
 *
 * Garages field for advance property search.
 *
 * @since 	3.0.0
 * @package RH/classic
 */

?>

<div class="option-bar rh-search-field rh_classic_garages_field small">
	<label for="select-garages">
		<?php
		$inspiry_min_garages_label = get_option( 'inspiry_min_garages_label' );
		if ( $inspiry_min_garages_label ) {
			echo esc_html( $inspiry_min_garages_label );
		} else {
			echo esc_html__( 'Min Garages', 'framework' );
		}
		?>
	</label>
	<span class="selectwrap">
		<select name="garages" id="select-garages" class="search-select">
			<?php inspiry_min_garages(); ?>
		</select>
	</span>
</div>
