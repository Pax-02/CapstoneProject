<?php
/**
 * Field: Guests
 *
 * Guests field for advance property search.
 * @package RH/modern
 */

?>
<div class="rh_prop_search__option rh_prop_search__select">
    <label for="rvr-guests">
	    <?php echo esc_html__( 'No of Guests', 'framework' ); ?>
    </label>
    <span class="rh_prop_search__selectwrap">
		<select name="guests" id="rvr-guests" class="rh_select2">
			<?php inspiry_min_guests(); ?>
		</select>
	</span>
</div>