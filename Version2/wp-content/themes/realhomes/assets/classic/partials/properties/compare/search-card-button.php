<?php
/**
 * Search Card Button for Compare Properties.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<span class="add-to-compare-span add-to-compare-search"
      data-button-id="<?php the_ID(); ?>"
>
<?php
if ( inspiry_is_added_to_compare( get_the_ID() ) ) {
	?>
	<span class="compare-placeholder compare_output">
		<span class="compare-tooltip" aria-label="<?php esc_html_e( 'Added to Compare', 'framework' ); ?>" tabindex="0">
			<i class="fas fa-plus dim"></i>
		</span>
		<span class="compare_target dim compare-label compare-tooltip"><?php esc_html_e( 'Added to Compare', 'framework' ); ?></span>
	</span>
	<span class="compare-tooltip" data-button-url="<?php echo get_the_permalink( get_the_ID() ); ?>" data-button-title="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" aria-label="<?php esc_html_e( 'Add to Compare', 'framework' ); ?>" tabindex="0">
		<a class="rh_trigger_compare add-to-compare hide" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
			<i class="fas fa-plus"></i><span class="compare-label"><?php esc_html_e( 'Add to Compare', 'framework' ); ?></span>
		</a>
	</span>
	<?php
} else {
	?>
	<span class="compare-placeholder compare_output hide">
		<span class="compare-tooltip" aria-label="<?php esc_html_e( 'Added to Compare', 'framework' ); ?>" tabindex="0">
			<i class="fas fa-plus dim"></i>
		</span>
		<span class="compare_target dim compare-label"></span>
	</span>
	<span class="compare-tooltip" data-button-url="<?php echo get_the_permalink( get_the_ID() ); ?>" data-button-title="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" aria-label="<?php esc_html_e( 'Add to Compare', 'framework' ); ?>" tabindex="0">
		<a class="rh_trigger_compare add-to-compare" data-property-id="<?php the_ID(); ?>" href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
			<i class="fas fa-plus"></i><span class="compare-label"><?php esc_html_e( 'Add to Compare', 'framework' ); ?></span>
		</a>
	</span>
	<?php
}
?>
</span>
