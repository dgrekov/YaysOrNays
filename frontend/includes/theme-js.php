<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
if (!function_exists('woothemes_add_javascript')) {
	function woothemes_add_javascript( ) {
		wp_enqueue_script('jquery');    
		wp_enqueue_script( 'countdown', get_bloginfo('template_directory').'/includes/js/jquery.countdown.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'general', get_bloginfo('template_directory').'/includes/js/general.js', array( 'jquery' ) );
	}
}
?>