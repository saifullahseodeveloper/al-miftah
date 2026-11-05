<?php
/**
 * Template Library Header Template
 */
?>
<label class="imaddons-template-library-filter-label">
	<input type="radio" value="{{ slug }}" <# if ( '' === slug ) { #> checked<# } #> name="imaddons-modal-filter">
	<span>{{ title }}</span>
</label> 