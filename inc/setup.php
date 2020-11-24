<?php
/**
 * Theme basic setup
 *
 * @package whatheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'whatheme_setup' );

if ( ! function_exists( 'whatheme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function whatheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on whatheme, use a find and replace
		 * to change 'whatheme' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'whatheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'whatheme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);
	}
}


add_filter( 'excerpt_more', 'whatheme_custom_excerpt_more' );

if ( ! function_exists( 'whatheme_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function whatheme_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'whatheme_all_excerpts_get_more_link' );

if ( ! function_exists( 'whatheme_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function whatheme_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary whatheme-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More...',
				'whatheme'
			) . '</a></p>';
		}
		return $post_excerpt;
	}
}

// Enable revisions for all custom post types
add_filter( 'cptui_user_supports_params', function () {
	return array( 'revisions' );
} );

// Limit number of revisions for all post types
function limit_revisions_number() {
	return 10;
}

add_filter( 'wp_revisions_to_keep', 'limit_revisions_number');

// Add ability ro reply to comments
add_filter( 'wpseo_remove_reply_to_com', '__return_false' );

// Enable control over YouTube iframe through API + add unique ID

function add_youtube_iframe_args( $html, $url, $args ) {

	/* Modify video parameters. */
	if ( strstr( $html, 'youtube.com/embed/' ) && ! empty( $args['location'] ) ) {
		preg_match_all( '|embed/(.*)\?|', $html, $matches );
		$html = str_replace( '?feature=oembed', '?feature=oembed&enablejsapi=1&autoplay=1&mute=1&controls=0&loop=1&showinfo=0&rel=0&playlist=' . $matches[1][0], $html );
		$html = str_replace( '<iframe', '<iframe rel="0" enablejsapi="1" id=slide-' . get_the_ID(), $html );
	}

	return $html;
}

add_filter( 'oembed_result', 'add_youtube_iframe_args', 10, 3 );

/**
 * Remove author archive pages
 */
function remove_author_archive_page() {
	global $wp_query;

	if ( is_author() ) {
		$wp_query->set_404();
		status_header(404);
		// Redirect to homepage
		// wp_redirect(get_option('home'));
	}
}
add_action( 'template_redirect', 'remove_author_archive_page' );

/**
 * Remove comments feed links
 */
add_filter( 'post_comments_feed_link', '__return_null' );

// Stick Admin Bar To The Top
if ( ! is_admin() ) {
	add_action( 'get_header', 'remove_topbar_bump' );

	function remove_topbar_bump() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}

	function stick_admin_bar() {
		echo "
			<style type='text/css'>
				body.admin-bar {margin-top:32px !important}
				@media screen and (max-width: 782px) {
					body.admin-bar { margin-top:46px !important }
				}
			</style>
			";
	}

	add_action( 'admin_head', 'stick_admin_bar' );
	add_action( 'wp_head', 'stick_admin_bar' );
}

// Disable Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
