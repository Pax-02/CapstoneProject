<?php
/**
 * Compare Button.
 *
 * @package    realhomes
 * @subpackage classic
 */

?>
<span class="add-to-compare-span add-to-compare-classic-icon"
      data-button-id="<?php the_ID(); ?>"
      data-button-title="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>"
      data-button-url="<?php echo get_the_permalink( get_the_ID() ); ?>"
>
	<?php
	if ( inspiry_is_added_to_compare( get_the_ID() ) ) {
		?>
        <div title="<?php esc_attr_e('Added To Compare','framework') ?>" class="compare-placeholder highlight">
			<i class="rh_classic_icon_atc fas fa-sync rh_highlight"></i>

		</div>
        <a title="<?php esc_attr_e('Add To Compare','framework') ?>" class="rh_trigger_compare add-to-compare hide" data-property-id="<?php the_ID(); ?>"
           href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
						<i class="rh_classic_icon_atc fas fa-sync"></i>
        </a>
		<?php
	} else {
		?>
        <div title="<?php esc_attr_e('Added To Compare','framework') ?>" class="compare-placeholder highlight hide">
			<i class="rh_classic_icon_atc fas fa-sync rh_highlight"></i>
		</div>
        <a title="<?php esc_attr_e('Add To Compare','framework') ?>" class="rh_trigger_compare add-to-compare" data-property-id="<?php the_ID(); ?>"
           href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
						<i class="rh_classic_icon_atc fas fa-sync"></i>
        </a>
		<?php
	}
	?>
</span>

