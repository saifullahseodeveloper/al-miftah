<?php
/**
 * Keywords template
 */
?>
<#
	if ( ! _.isEmpty( keywords ) ) {
#>
<select class="imaddons-modal-keywords">
	<option value=""><?php esc_html_e( 'Any Topic', 'imaddons' ); ?></option>
	<# _.each( keywords, function( title, slug ) { #>
	<option value="{{ slug }}">{{ title }}</option>
	<# } ); #>
</select>
<#
	}
#>