<?php

/**
 * NuxtPress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nuxtpress
 */

if ( ! defined( 'NUXT_PRESS_VERSION' ) ) {
	define( 'NUXT_PRESS_VERSION', time() );
}

if ( ! function_exists( 'nuxtpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nuxtpress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on NuxtPress, use a find and replace
	 * to change 'nuxtpress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'nuxtpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'nuxtpress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	add_post_type_support( 'post', 'comments' );
	add_post_type_support( 'page', 'comments' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nuxtpress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif; // nuxtpress_setup
add_action( 'after_setup_theme', 'nuxtpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nuxtpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nuxtpress_content_width', 730 );
}
add_action( 'after_setup_theme', 'nuxtpress_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function nuxtpress_scripts() {
	/*if ( is_customize_preview() ) {
		wp_enqueue_script( 'nuxtpress-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'jquery', 'customize-preview', 'customize-preview-nav-menus' ), NUXT_PRESS_VERSION, true );
	}*/

	wp_enqueue_style( 'nuxtpress-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'nuxtpress_scripts' );


/**
 * Add theme support for Jetpack Features
 */
function nuxtpress_jetpack_setup() {
	add_theme_support( 'site-logo' );
}
add_action( 'after_setup_theme', 'nuxtpress_jetpack_setup' );

/**
 * Register customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 */
function nuxtpress_customize_register( WP_Customize_Manager $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	add_filter( 'wp_get_nav_menu_items', '_nuxtpress_filter_wp_api_nav_menu_items_workaround', 20  );
}
add_action( 'customize_register', 'nuxtpress_customize_register' );

/**
 * Workaround issue in WP API Menus plugin to force nav menu item classes to be arrays instead of strings.
 *
 * @see \WP_REST_Menus::get_menu_location()
 *
 * @param array $items Nav menu items.
 */
function _nuxtpress_filter_wp_api_nav_menu_items_workaround( $items ) {
	foreach ( $items as &$item ) {
		if ( is_string( $item->classes ) ) {
			$item->classes = explode( ' ', $item->classes );
		}
	}
	return $items;
}

function nuxtpress_get_settings() {
	$settings = wp_load_alloptions();
	$mods = get_theme_mods();

	$return = [];

	if ($settings['blogname']) {
		$return['name'] = $settings['blogname'];
	}

	if ($settings['blogdescription']) {
		$return['description'] = $settings['blogdescription'];
	}

	if ($settings['home']) {
		$return['home'] = $settings['home'];
	}

	if ($mods['custom_logo']) {
		$logo = wp_get_attachment_image_src( $mods['custom_logo'] , 'full' );
		$return['custom_logo'] = $logo[0];
	}

	return $return;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'nuxtpress/v1', '/settings', array(
    'methods' => 'GET',
    'callback' => 'nuxtpress_get_settings',
  ) );
} );

require_once get_template_directory() . '/class-tgm-plugin-activation.php';
function nuxtpress_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'               => 'JWT Authentication for WP REST API', // The plugin name.
			'slug'               => 'jwt-authentication-for-wp-rest-api', // The plugin slug (typically the folder name).
			'required'           => true,
			'force_activation'   => true,
			'force_deactivation' => false
		),
		array(
			'name'               => 'WP Rest API V2 Menus', // The plugin name.
			'slug'               => 'wp-rest-api-v2-menus', // The plugin slug (typically the folder name).
			'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => false
		),


	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
			'id'           => 'nuxtpress',             // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'nuxtpress_register_required_plugins');