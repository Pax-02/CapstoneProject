<?php
/**
 * Property Types Field
 */
?>
<div class="option-bar rh-search-field rh_classic_type_field small">
    <label for="select-property-type">
		<?php
        $inspiry_property_type_label = get_option( 'inspiry_property_type_label' );
        if ( ! empty( $inspiry_property_type_label ) ) {
            echo esc_html( $inspiry_property_type_label );
        } else {
	        esc_html_e( 'Property Type', 'framework' );
        }
        ?>
    </label>
    <span class="selectwrap">
        <select name="type" id="select-property-type" class="search-select">
	        <?php advance_hierarchical_options( 'property-type' ); ?>
        </select>
    </span>
</div>