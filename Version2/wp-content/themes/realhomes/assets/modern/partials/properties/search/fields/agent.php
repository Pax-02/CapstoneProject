<?php
/**
 * Field: Agent
 *
 * Agent field for advance property search.
 *
 * @since 	3.5.0
 * @package RH/modern
 */
?>
<div class="rh_prop_search__option rh_prop_search__select rh_agent_field_wrapper">
	<label for="select-agent">
		<?php
			$inspiry_search_field_label = get_option( 'inspiry_agent_field_label' );
			echo !empty( $inspiry_search_field_label ) ? esc_html( $inspiry_search_field_label ) : esc_html__( 'Agent', 'framework' );
		?>
	</label>
	<span class="rh_prop_search__selectwrap">
		<select name="agents" id="select-agent" class="rh_select2">
			<?php inspiry_agents_in_search(); ?>
		</select>
	</span>
</div>
