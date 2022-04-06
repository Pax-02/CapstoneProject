<?php
/**
 * Agents Field
 */
?>
<div class="option-bar rh-search-field rh_classic_agent_field small">
	<label for="select-agent">
		<?php
			$inspiry_search_field_label = get_option( 'inspiry_agent_field_label' );
			echo !empty( $inspiry_search_field_label ) ? esc_html( $inspiry_search_field_label ) : esc_html__( 'Agent', 'framework' );
		?>
	</label>
	<span class="selectwrap">
    <select name="agents" id="select-agent" class="search-select">
        <?php inspiry_agents_in_search(); ?>
    </select>
</span>
</div>