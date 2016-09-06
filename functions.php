<?php
/**
	Theme
 **/

if ( ! function_exists( 'psdtheme_setup' ) ) :
function psdtheme_setup() {
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

    //translations
    load_theme_textdomain( 'psdtheme', get_template_directory() . '/languages' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
    //add_image_size( 'blog_thumb', 279, 245, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary menu', 'psdtheme' )
	) );

}
endif;
add_action( 'after_setup_theme', 'psdtheme_setup' );
/**********************************************************************/

/**
 * Include scripts and styles
 */
function psdtheme_setup_scripts() {
	// Load our main stylesheet.
	wp_enqueue_style( 'psdtheme-normalize', get_template_directory_uri() . '/css/normalize.css', array( ) );
	wp_enqueue_style( 'psdtheme-main-style', get_template_directory_uri() . '/css/main.css', array( 'psdtheme-normalize' ) );
	wp_enqueue_style( 'psdtheme-style', get_stylesheet_uri(), array( 'psdtheme-normalize', 'psdtheme-main-style' ) );

	//Load our scripts
	wp_enqueue_script( 'psdtheme-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'psdtheme-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'psdtheme-plugins' ), '1', true );
}
add_action( 'wp_enqueue_scripts', 'psdtheme_setup_scripts' );
/**********************************************************************/


/**
 * Create a nicely formatted and more specific title element text for output
 */
function psdtheme_setup_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'glasses' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'psdtheme_setup_wp_title', 10, 2 );
/**********************************************************************/

/**
 * Options
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}
/**********************************************************************/


/**
 * Remove width/height attrs
 */
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
add_filter('wp_get_attachment_link', 'remove_width_attribute', 10, 1);

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
/**********************************************************************/


/**
 * Register Sidebars
 */
function psdtheme_widgets_init() {

	// Primary Widget area
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'psdtheme_widgets_init' );

/**********************************************************************/