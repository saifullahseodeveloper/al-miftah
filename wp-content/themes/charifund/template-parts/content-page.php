<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package charifund
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content();

		charifund()->link_pages();
		?>
	</div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->
