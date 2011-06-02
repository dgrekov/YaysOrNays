<?php

//Enable WooSEO on these custom Post types
$seo_post_types = array('post','page');
define("SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action('init','woo_global_options');
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action('admin_head','woo_options');  
if (!function_exists('woo_options')) {
function woo_options(){
	
// VARIABLES
$themename = "Placeholder";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/placeholder/';
$shortname = "woo";

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();     

$options[] = array( "name" => "General Settings",
					"type" => "heading",
					"icon" => "general");
                        
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable text-based Site Title and Tagline. Setup title & tagline in <a href='".home_url()."/wp-admin/options-general.php'>General Settings</a>.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox");

$options[] = array( "name" => "Site Title",
					"desc" => "Change the site title typography.",
					"id" => $shortname."_font_site_title",
					"std" => array('size' => '40','unit' => 'px','face' => 'Lobster','style' => '','color' => '#222222'),
					"class" => "hidden",
					"type" => "typography");  

$options[] = array( "name" => "Site Description",
					"desc" => "Change the site description typography.",
					"id" => $shortname."_font_tagline",
					"std" => array('size' => '14','unit' => 'px','face' => 'Lobster','style' => 'italic','color' => '#999999'),
					"class" => "hidden last",
					"type" => "typography");  
					          
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Styling Options",
					"type" => "heading",
					"icon" => "styling");   
					
$options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a custom color for background color of the theme e.g. #697e09",
					"id" => "woo_body_color",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Body background image",
					"desc" => "Upload an image for the theme's background",
					"id" => $shortname."_body_img",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Background image repeat",
                    "desc" => "Select how you would like to repeat the background-image",
                    "id" => $shortname."_body_repeat",
                    "std" => "no-repeat",
                    "type" => "select",
                    "options" => array("no-repeat","repeat-x","repeat-y","repeat"));

$options[] = array( "name" => "Background image position",
                    "desc" => "Select how you would like to position the background",
                    "id" => $shortname."_body_pos",
                    "std" => "top",
                    "type" => "select",
                    "options" => array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"));
										
//Layout Options
$options[] = array( "name" => "Introduction",
					"type" => "heading",
					"icon" => "layout"); 
					
$options[] = array( "name" => "Enable Intro",
					"desc" => "Enable the intro area.",
					"id" => $shortname."_intro",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Intro Heading",
					"desc" => "Enter the intro heading.",
					"id" => $shortname."_intro_heading",
					"std" => 'An introduction text',
					"type" => "text"); 

$options[] = array( "name" => "Intro Text",
					"desc" => "Enter the intro text.",
					"id" => $shortname."_intro_text",
					"std" => 'We are currently building a new site which will be ready soon. In the mean time you can follow us on Twitter and Facebook to stay updated on our progress.  ',
					"type" => "textarea"); 					
					 					                   
$options[] = array( "name" => "Intro Text Typography",
					"desc" => "Change the intro text font.",
					"id" => $shortname."_intro_face",
					"std" => array('size' => '14','unit' => 'px','face' => 'Droid Serif','style' => '','color' => '#555555'),
					"type" => "typography");  

//Social Options
$options[] = array( "name" => "Social",
					"type" => "heading",
					"icon" => "layout"); 

$options[] = array( "name" => "Enable Social",
					"desc" => "Enable the social area.",
					"id" => $shortname."_social",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Social Heading",
					"desc" => "Enter the heading for the social buttons.",
					"id" => $shortname."_social_heading",
					"std" => 'Follow us',
					"type" => "text"); 					

$options[] = array( "name" => "Twitter URL",
					"desc" => "Enter your Twitter URL e.g. http://www.twitter.com/woothemes",
					"id" => $shortname."_twitter",
					"std" => '',
					"type" => "text"); 

$options[] = array( "name" => "Facebook URL",
					"desc" => "Enter your Facebook URL e.g. http://www.facebook.com/woothemes",
					"id" => $shortname."_facebook",
					"std" => '',
					"type" => "text"); 
					
$options[] = array( "name" => "E-mail address",
					"desc" => "Enter your e-mail address e.g hello@email.com",
					"id" => $shortname."_email",
					"std" => '',
					"type" => "text"); 
					
$options[] = array( "name" => "Enable Subscribe/RSS",
					"desc" => "Enable the subscribe and RSS link.",
					"id" => $shortname."_social_rss",
					"std" => 'true',
					"type" => "checkbox"); 
					

//Newsletter Options
$options[] = array( "name" => "Newsletter",
					"type" => "heading",
					"icon" => "layout"); 

$options[] = array( "name" => "Enable Newsletter",
					"desc" => "Enable the newsletter area.",
					"id" => $shortname."_newsletter",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Newsletter Text",
					"desc" => "Enter the newsletter text.",
					"id" => $shortname."_newsletter_text",
					"std" => 'Sign up for our newsletter',
					"type" => "text"); 					

$options[] = array( "name" => "Submit Button Text",
					"desc" => "Enter the submit button text.",
					"id" => $shortname."_submit_text",
					"std" => 'Submit',
					"type" => "text"); 					

$options[] = array( "name" => "Newsletter Service",
					"desc" => "Select which Newsletter service you are using.",
					"id" => $shortname."_newsletter_type",
					"std" => 'feedburner',
					"options" => array( 'feedburner' => 'Feedburner', 'campaignmonitor' => 'Campaign Monitor'),
					"type" => "select2"); 

$options[] = array( "name" => "Newsletter Service ID",
					"desc" => "Enter the your Newsletter Service ID.",
					"id" => $shortname."_newsletter_ID",
					"std" => '',
					"type" => "text"); 					

$options[] = array( "name" => "Newsletter Service Form Action",
					"desc" => "Enter the the form action if required.",
					"id" => $shortname."_newsletter_action",
					"std" => '',
					"type" => "text"); 					

//Countdown
$options[] = array( "name" => "Countdown",
					"type" => "heading",
					"icon" => "layout");   

$options[] = array( "name" => "Enable Countdown",
					"desc" => "Enable the countdown area.",
					"id" => $shortname."_countdown",
					"std" => 'true',
					"type" => "checkbox"); 

$options[] = array( "name" => "Countdown Heading",
					"desc" => "Enter the countdown heading.",
					"id" => $shortname."_countdown_heading",
					"std" => 'Site will launch in',
					"type" => "text"); 

$options[] = array( "name" => "Launch Date",
					"desc" => "Select a date from the calendar.",
					"id" => $shortname."_countdown_date",
					"std" => '12/31/2012',
					"type" => "calendar"); 

$options[] = array( "name" => "Launch Time",
					"desc" => "Enter the launch time e.g. 20:30",
					"id" => $shortname."_countdown_time",
					"std" => "00:00",
					"type" => "text");	


//Footer
$options[] = array( "name" => "Footer Customization",
					"type" => "heading",
					"icon" => "footer");    
					
$options[] = array( "name" => "Footer Typography",
					"desc" => "Change the footer font.",
					"id" => $shortname."_footer_face",
					"std" => array('size' => '14','unit' => 'px','face' => 'Lobster','style' => '','color' => '#999'),
					"type" => "typography");  

$options[] = array( "name" => "Custom Affiliate Link",
					"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text");	
									
$options[] = array( "name" => "Enable Custom Footer",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text ",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_text",
					"class" => "hidden last",
					"std" => "",
					"type" => "textarea");
						
							
                                              
// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);


// Woo Metabox Options
// Start name with underscore to hide custom key from the user
$woo_metaboxes = array( '' );

global $post;

// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

}
}



?>