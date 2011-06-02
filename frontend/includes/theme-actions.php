<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Add custom styling to HEAD
- Add custom typograhpy to HEAD
- Add layout to body_class output

-----------------------------------------------------------------------------------*/


add_action('woo_head','woo_custom_styling');			// Add custom styling to HEAD
add_action('woo_head','woo_custom_typography');			// Add custom typography to HEAD


/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_styling')) {
	function woo_custom_styling() {
	
		global $woo_options;
		
		$output = '';
		// Get options
		$body_color = $woo_options['woo_body_color'];
		$body_img = $woo_options['woo_body_img'];
		$body_repeat = $woo_options['woo_body_repeat'];
		$body_position = $woo_options['woo_body_pos'];
			
		// Add CSS to output
		if ($body_color)
			$output .= 'body {background:'.$body_color.'}' . "\n";
			
		if ($body_img)
			$output .= 'body {background-image:url('.$body_img.')}' . "\n";

		if ($body_img && $body_repeat && $body_position)
			$output .= 'body {background-repeat:'.$body_repeat.'}' . "\n";

		if ($body_img && $body_position)
			$output .= 'body {background-position:'.$body_position.'}' . "\n";
		
		// Output styles
		if (isset($output) && $output != '') {
			$output = strip_tags($output);
			$output = "<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
			
	}
} 

/*-----------------------------------------------------------------------------------*/
/* Add custom typograhpy to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_typography')) {
	function woo_custom_typography() {
	
		// Get options
		global $woo_options;
				
		// Reset	
		$output = '';
		
		// Add Text title and tagline if text title option is enabled
		if ( $woo_options['woo_texttitle'] == "true" ) {		
			
			if ( $woo_options['woo_font_site_title'] )
				$output .= '#logo .site-title a {'.woo_generate_font_css($woo_options['woo_font_site_title'],'1.2').'}' . "\n";	
			if ( $woo_options['woo_font_tagline'] )
				$output .= '#logo .site-description {'.woo_generate_font_css($woo_options['woo_font_tagline']).'}' . "\n";	
		}
		
		if ( !$woo_options['woo_intro_face'] )
			$woo_options['woo_intro_face'] = array('face' => 'Droid Serif', 'size' => '14', 'unit' => 'px', 'color' => '#555');

		if ( !$woo_options['woo_footer_face'] )
			$woo_options['woo_footer_face'] = array('face' => 'Lobster', 'size' => '14', 'unit' => 'px', 'color' => '#999');
		$output .= '#main #intro p { '.woo_generate_font_css($woo_options['woo_intro_face'],'1.5').' }' . "\n";			
		$output .= '#footer p { '.woo_generate_font_css($woo_options['woo_footer_face']).' }' . "\n";						

		
		// Output styles
		if (isset($output) && $output != '') {

			// Enable Google Fonts stylesheet in HEAD
			if (function_exists('woo_google_webfonts')) woo_google_webfonts();
			
			$output = "\n<!-- Woo Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
			
		}
			
	}
} 

if (!function_exists('woo_generate_font_css')) {
	// Returns proper font css output
	function woo_generate_font_css($option, $em = '1') {
		return 'font:'.$option["style"].' '.$option["size"].$option["unit"].'/'.$em.'em '.stripslashes($option["face"]).';color:'.$option["color"].';';
	}
}

// Output stylesheet and custom.css after custom styling
remove_action('wp_head', 'woothemes_wp_head');
add_action('woo_head', 'woothemes_wp_head');



/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>