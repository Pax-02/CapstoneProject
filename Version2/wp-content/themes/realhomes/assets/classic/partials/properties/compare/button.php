<?php
/**
 * Compare Button.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<span class="add-to-compare-span"
     data-button-id = "<?php the_ID(); ?>"
     data-button-title = "<?php echo esc_attr( get_the_title(get_the_ID())); ?>"
     data-button-url = "<?php echo get_the_permalink(get_the_ID()); ?>"
>
	<?php
	$property_id = get_the_ID();
	if ( inspiry_is_added_to_compare( $property_id ) ) {
		?>
        <i class="rh_added_to_compare compare-placeholder highlight">
			<i class="rh_classic_icon_atc fas fa-plus-circle dim"></i>
            <i class="rh_classic_added"><?php esc_html_e( 'Added to Compare', 'framework' ); ?></i>
		</i>
        <a class="rh_trigger_compare add-to-compare hide" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
            <i class="rh_classic_icon_atc fas fa-plus-circle"></i>
            <i class="rh_classic_atc"><?php esc_html_e( 'Add to Compare', 'framework' ); ?></i>
        </a>
		<?php
	} else {
		?>

        <i class="rh_added_to_compare compare-placeholder highlight hide">
			<i class="rh_classic_icon_atc fas fa-plus-circle dim"></i> <i class="rh_classic_added"><?php esc_html_e( 'Added to Compare', 'framework' ); ?></i>
		</i>
        <a class="rh_trigger_compare add-to-compare" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
            <i class="rh_classic_icon_atc fas fa-plus-circle"></i>
            <i class="rh_classic_atc"><?php esc_html_e( 'Add to Compare', 'framework' ); ?></i>
        </a>
		<?php
	}
	?>
</span>

