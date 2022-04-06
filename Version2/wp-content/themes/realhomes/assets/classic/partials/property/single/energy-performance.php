<?php
$epc_display  = get_option( 'inspiry_display_energy_performance', true );
$energy_class = get_post_meta( get_the_ID(), 'REAL_HOMES_energy_class', true );

if ( 'none' != $energy_class && '' != $energy_class && 'true' == $epc_display ) {
	$energy_performance = get_post_meta( get_the_ID(), 'REAL_HOMES_energy_performance', true );
	$epc_current        = get_post_meta( get_the_ID(), 'REAL_HOMES_epc_current_rating', true );
	$energy_potential   = get_post_meta( get_the_ID(), 'REAL_HOMES_epc_potential_rating', true );
	$section_title      = get_option( 'inspiry_energy_performance_title', esc_html__( 'Energy Performance', 'framework' ) )
	?>
    <div class="energy-performance-wrap">
		<?php
		if ( ! empty( $section_title ) ) {
			?>
            <h4 class="title"><?php echo esc_html( $section_title ); ?></h4>
			<?php
		}
		?>
        <div class="energy-performance">
            <ul class="epc-details clearfix class-<?php echo esc_attr( strtolower( $energy_class ) ); ?>">
                <li>
                    <strong><?php esc_html_e( 'Energy Class:', 'framework' ) ?></strong>
                    <span><?php echo esc_html( $energy_class ); ?></span>
                </li>
				<?php
				if ( ! empty( $energy_performance ) ) {
					?>
                    <li>
                        <strong><?php esc_html_e( 'Energy Performance:', 'framework' ); ?></strong>
                        <span><?php echo esc_html( $energy_performance ); ?></span>
                    </li>
					<?php
				}

				if ( ! empty( $epc_current ) ) {
					?>
                    <li>
                        <strong><?php echo sprintf( esc_html__( '%s Current Rating:', 'framework' ), '<abbr title="Energy Performance Certificate">EPC</abbr>' ); ?></strong>
                        <span><?php echo esc_html( $epc_current ); ?><br></span>
                    </li>
					<?php
				}

				if ( ! empty( $energy_potential ) ) {
					?>
                    <li>
                        <strong><?php echo sprintf( esc_html__( '%s Potential Rating:', 'framework' ), '<abbr title="Energy Performance Certificate">EPC</abbr>' ); ?></strong>
                        <span><?php echo esc_html( $energy_potential ); ?></span>
                    </li>
					<?php
				}
				?>
            </ul>
            <ul class="energy-class">
				<?php
				$energy_classes = array(
					'A+',
					'A',
					'B',
					'C',
					'D',
					'E',
					'F',
					'G',
				);

				foreach ( $energy_classes as $class ) {

					if ( $class === $energy_class ) {
						$current_class = 'current ' . $class;
					} else {
						$current_class = strtolower( $class );
					}
					echo "<li class='{$current_class}'>{$class}</li>";
				}
				?>
            </ul>
        </div>
    </div>
	<?php
}
?>