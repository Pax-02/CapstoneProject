<?php
/**
 * Field: Energy Performance
 *
 * @since 3.9.5
 * @package RH/classic
 */

if ( inspiry_is_edit_property() ) {
	global $post_meta_data;

	if ( isset( $post_meta_data['REAL_HOMES_energy_class'] ) ) {
		$energy_class = $post_meta_data['REAL_HOMES_energy_class'][0];
	}

	if ( isset( $post_meta_data['REAL_HOMES_energy_performance'] ) ) {
		$energy_performance = $post_meta_data['REAL_HOMES_energy_performance'][0];
	}

	if ( isset( $post_meta_data['REAL_HOMES_epc_current_rating'] ) ) {
		$current_rating = $post_meta_data['REAL_HOMES_epc_current_rating'][0];
	}

	if ( isset( $post_meta_data['REAL_HOMES_epc_potential_rating'] ) ) {
		$potential_rating = $post_meta_data['REAL_HOMES_epc_potential_rating'][0];
	}
}
?>

<div class="form-option energy-class-field-wrapper">
    <label for="energy-class"><?php esc_html_e( 'Energy Class', 'framework' ); ?></label>
    <span class="selectwrap">
        <select name="energy-class" id="energy-class" class="search-select">
	         <?php
	         $selected = '-1';
	         if ( ! empty( $energy_class ) ) {
		         $selected = $energy_class;
	         }
	         ?>
            <option value="-1" <?php echo ( '-1' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'None', 'framework' ); ?></option>
            <option value="A+" <?php echo ( 'A+' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'A+', 'framework' ); ?></option>
            <option value="A" <?php echo ( 'A' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'A', 'framework' ); ?></option>
            <option value="B" <?php echo ( 'B' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'B', 'framework' ); ?></option>
            <option value="C" <?php echo ( 'C' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'C', 'framework' ); ?></option>
            <option value="D" <?php echo ( 'D' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'D', 'framework' ); ?></option>
            <option value="E" <?php echo ( 'E' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'E', 'framework' ); ?></option>
            <option value="F" <?php echo ( 'F' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'F', 'framework' ); ?></option>
            <option value="G" <?php echo ( 'G' == $selected ) ? 'selected' : ''; ?>><?php esc_html_e( 'G', 'framework' ); ?></option>
        </select>
    </span>
</div>

<div class="form-option energy-performance-field-wrapper">
    <label for="energy-performance"><?php esc_html_e( 'Energy Performance', 'framework' ); ?></label>
    <input id="energy-performance" name="energy-performance" type="text" value="<?php echo ( ! empty( $energy_performance ) ) ? esc_attr( $energy_performance ) : false; ?>"
           title="<?php esc_html_e( 'Energy Performance', 'framework' ); ?>"/>
</div>

<div class="clearfix"></div>

<div class="form-option epc-current-rating-field-wrapper">
    <label for="epc-current-rating"><?php esc_html_e( 'EPC Current Rating', 'framework' ); ?></label>
    <input id="epc-current-rating" name="epc-current-rating" type="text" value="<?php echo ( ! empty( $current_rating ) ) ? esc_attr( $current_rating ) : false; ?>"
           title="<?php esc_html_e( 'EPC Current Rating', 'framework' ); ?>"/>
</div>

<div class="form-option epc-potential-rating-field-wrapper">
    <label for="epc-potential-rating"><?php esc_html_e( 'EPC Potential Rating', 'framework' ); ?></label>
    <input id="epc-potential-rating" name="epc-potential-rating" type="text" value="<?php echo ( ! empty( $potential_rating ) ) ? esc_attr( $potential_rating ) : false; ?>"
           title="<?php esc_html_e( 'EPC Potential Rating', 'framework' ); ?>"/>
</div>