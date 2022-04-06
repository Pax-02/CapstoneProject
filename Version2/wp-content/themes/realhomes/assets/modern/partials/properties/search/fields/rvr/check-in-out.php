<?php
/**
 * Field: Check-In & Check-Out
 *
 * Check-In & Check-Out field for advance property search.
 * @package RH/modern
 */
?>
<div class="rh_prop_search__option rh_mod_text_field">
    <label for="rvr-check-in-search"><?php echo esc_html__( 'Check In', 'framework' ); ?></label>
    <input type="text" name="check-in" id="rvr-check-in-search" value="<?php echo ! empty( $_GET['check-in'] ) ? $_GET['check-in'] : ''; ?>" placeholder="<?php echo esc_html__( 'Any', 'framework' ); ?>" autocomplete="off" />
</div>

<div class="rh_prop_search__option rh_mod_text_field">
    <label for="rvr-check-out-search"><?php echo esc_html__( 'Check Out', 'framework' ); ?></label>
    <input type="text" name="check-out" id="rvr-check-out-search" value="<?php echo ! empty( $_GET['check-out'] ) ? $_GET['check-out'] : ''; ?>" placeholder="<?php echo esc_html__( 'Any', 'framework' ); ?>" autocomplete="off" />
</div>