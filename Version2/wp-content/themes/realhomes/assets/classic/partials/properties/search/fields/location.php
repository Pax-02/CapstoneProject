<?php
/**
 * Location Fields
 */

$location_select_count  = inspiry_get_locations_number(); // number of locations chosen from theme options
$location_select_names  = inspiry_get_location_select_names(); // Variable that contains location select boxes names
$location_select_titles = inspiry_get_location_titles(); // Default location select boxes titles
$location_placeholder   = inspiry_location_placeholder(); // Placeholder text for the location fields
$select_class           = 'search-select'; // Default class for the location dropdown fields
$is_location_ajax       = get_option( 'inspiry_ajax_location_field', 'no' ); // Option to check if location field Ajax is enabled

if ( 'yes' === $is_location_ajax ) {
	$select_class = 'ajax-location-field';
}

// Generate required location select boxes
for ( $i = 0; $i < $location_select_count; $i ++ ) {
	?>
    <div class="option-bar rh_classic_location_field rh-search-field small rh_classic_search__select rh_location_prop_search_<?php echo esc_attr( $i ) ?>" data-get-location-placeholder="<?php echo esc_attr( $location_placeholder[ $i ] ); ?>">
        <label for="<?php echo esc_attr( $location_select_names[ $i ] ); ?>">
			<?php echo esc_html( $location_select_titles[ $i ] ); ?>
        </label>
        <span class="selectwrap">
            <select name="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" id="<?php echo esc_attr( $location_select_names[ $i ] ); ?>" class="<?php echo esc_attr( $select_class ); ?>">
                <?php
                if ( 'yes' === $is_location_ajax ) {
	                $location_placeholder = inspiry_location_placeholder();
	                ?>
                    <option value="any"><?php echo esc_html( $location_placeholder[0] ); ?></option>
	                <?php
	                if ( isset( $_GET['location'] ) && ! empty( $_GET['location'] ) ) {
		                $searched_location = get_term_by( 'slug', sanitize_text_field( $_GET['location'] ), 'property-city' );
		                if ( ! empty( $searched_location ) && ! is_wp_error( $searched_location ) ) {
			                echo "<option value='{$searched_location->slug}' selected='selected'>{$searched_location->name}</option>";
		                }
	                }
                }
                ?>
            </select>
        </span>
    </div>
	<?php
}

// important action hook - related JS works based on it
do_action( 'after_location_fields' );