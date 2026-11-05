<?php 
	add_action( 'wp_enqueue_scripts', 'charifund_child_them_enqueue_styles' );
	function charifund_child_them_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
    } 
?>