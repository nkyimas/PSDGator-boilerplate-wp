<?php
/**
 * Functions of the theme
 */

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

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

}
endif;
add_action( 'after_setup_theme', 'psdtheme_setup' );
/**********************************************************************/

/**
 * Include scripts and styles
 */
function psdtheme_setup_scripts() {

  $version = time();

	// Load our main stylesheet.
	wp_enqueue_style( 'psdtheme-normalize', get_template_directory_uri() . '/css/normalize.css', array( ) );
	wp_enqueue_style( 'psdtheme-grid', get_template_directory_uri() . '/css/grid.css', array( 'psdtheme-normalize' ) );
	wp_enqueue_style( 'psdtheme-main-style', get_template_directory_uri() . '/css/main.css', array( 'psdtheme-normalize', 'psdtheme-grid' ), $version );
	wp_enqueue_style( 'psdtheme-style', get_stylesheet_uri(), array( 'psdtheme-normalize', 'psdtheme-grid', 'psdtheme-main-style' ), $version );

	//Load our scripts
	wp_enqueue_script( 'psdtheme-modernizr', get_template_directory_uri() . '/js/vendor/modernizr-3.7.1.min.js', array( ), '3.7.1', true );
	wp_enqueue_script( 'psdtheme-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), $version, true );
  wp_enqueue_script( 'psdtheme-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'psdtheme-plugins' ), $version, true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'psdtheme_setup_scripts' );
/**********************************************************************/


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function psdtheme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 1200 );
}
add_action( 'after_setup_theme', 'psdtheme_content_width', 0 );
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
