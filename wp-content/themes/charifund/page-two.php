<?php
/**
* Template Name: Page Rtl
*
* @package WordPress
* @subpackage Charifund
* @since 1.0
* @version 1.0
*/
get_header('two'); 
?>
<div class="rtl-page-wrap">
	<div class="rtl-page-wrap-inner">
		<?php
			if(have_posts()){
				while(have_posts()) : the_post();
					the_content();
				endwhile;
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
		?>
	</div>
</div>

<?php get_footer('two'); ?>