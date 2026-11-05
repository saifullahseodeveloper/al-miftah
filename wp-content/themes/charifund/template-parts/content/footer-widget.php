<?php
/**
 * Theme Footer Widget Template
 * @package charifund
 * @since 1.0.0
 */

if (!is_active_sidebar('footer-widget')){
	return;
}
?>

<?php dynamic_sidebar('footer-widget');?>