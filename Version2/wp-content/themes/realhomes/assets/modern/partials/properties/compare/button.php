<?php
/**
 * Compare: Compare Button
 *
 * Add to compare button for properties.
 *
 * @since 	3.0.0
 * @package RH/modern
 */

?>

<span class="add-to-compare-span"
      data-button-id = "<?php the_ID(); ?>"
      data-button-title = "<?php echo esc_attr( get_the_title(get_the_ID()) ); ?>"
      data-button-url = "<?php echo get_the_permalink(get_the_ID()); ?>"
>
	<?php
	$property_id = get_the_ID();
	if ( inspiry_is_added_to_compare( $property_id ) ) {
		?>
		<span class="compare-placeholder highlight" data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
			<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
		</span>
		<a class="rh_trigger_compare add-to-compare hide" data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
		</a>
		<?php
	} else {
		?>
		<span class="compare-placeholder highlight hide" data-tooltip="<?php esc_attr_e( 'Added to compare', 'framework' ); ?>">
			<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
		</span>
		<a class="rh_trigger_compare add-to-compare" data-tooltip="<?php esc_attr_e( 'Add to compare', 'framework' ); ?>" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
			<?php inspiry_safe_include_svg( '/images/icons/icon-compare.svg' ); ?>
		</a>
		<?php
	}
	?>
</span>
