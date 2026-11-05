<?php
/**
 * Template item
 */
?>
<# var activeTab = window.imaddonsElementsLibreryData.tabs[ type ]; #>
<div class="elementor-template-library-template-body">
	<# if ( 'imaddons-local' !== source ) { #>
	<div class="elementor-template-library-template-screenshot">
		<# if ( 'imaddons-local' !== source ) { #>
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<# } #>
		<img src="{{ thumbnail }}" alt="">
	</div>
	<# } #>
</div>
<div class="elementor-template-library-template-controls">
	<button class="elementor-template-library-template-action imaddons-template-library-template-insert elementor-button elementor-button-success">
		<i class="eicon-file-download"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'imaddons' ); ?></span>
	</button>
</div>
<div class="elementor-template-library-template-name">{{{ title }}}</div>

<# if ( 'imaddons-local' === source ) { #>
<div class="elementor-template-library-template-type">
	<?php esc_html_e( 'Type:', 'imaddons' ); ?> {{{ typeLabel }}}
</div>
<# } #> 