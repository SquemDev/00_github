<?php
/* 
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. 
*/
/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
*/

function pew_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'pew_theme_customizer' );
/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         // 
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
	
	// removing plugin dashboard boxes 
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
	
	/* 
	have more plugin widgets you'd like to remove? 
	share them with us so we can get a list of 
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their 
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/



// removing the dashboard widgets
// add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
// add_action('wp_dashboard_setup', 'wp_bootstrap_custom_dashboard_widgets');


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function pew_login_css() {
	wp_enqueue_style( 'pew_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function pew_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function pew_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'pew_login_css', 10 );
add_filter( 'login_headerurl', 'pew_login_url' );
add_filter( 'login_headertitle', 'pew_login_title' );


/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function pew_custom_admin_footer() {
	_e( '<i>Desarrollado por <a href="http://www.squembri.com" target="_blank">Estudio Squembri</a></i>', 'pew' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'pew_custom_admin_footer' );


// --------------------------------------
// Editamos el aspecto visual de la barra
// --------------------------------------
function link_to_stylesheet() {
?>
<style type="text/css">
@media screen and (max-width: 600px) {
  #wpadminbar {position:fixed;}
}
#wpadminbar { background: #000; }
</style>
<?php
}
add_action('wp_head', 'link_to_stylesheet');