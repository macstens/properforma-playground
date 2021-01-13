<?php
/**
 * blank functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blank
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'blank_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blank_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on blank, use a find and replace
		 * to change 'blank' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blank', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'blank' ),
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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'blank_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'blank_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blank_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blank_content_width', 640 );
}
add_action( 'after_setup_theme', 'blank_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blank_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blank' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blank' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blank_widgets_init' );

const RECAPTCHASITEKEY = '6LdT9ygaAAAAAE28WyG7WNI4dvjrogeXgxtrLgz3';
const RECAPTCHASITESECRET = '6LdT9ygaAAAAAImxJr-fwGM7d75-ClbcQ96uGaUW';
/**
 * Enqueue scripts and styles.
 */
function blank_scripts() {

	wp_enqueue_style( 'blank-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'blank-style', 'rtl', 'replace' );

	wp_enqueue_script( 'blank-script', get_template_directory_uri() . '/dist/js-min/home.js', array(), _S_VERSION, true );
	#wp_enqueue_script( 'blank-script-products', get_template_directory_uri() . '/dist/js-min/products.js', array('blank-script'), _S_VERSION, true );

	wp_register_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?render=' . RECAPTCHASITEKEY, array(), _S_VERSION, false );
	wp_enqueue_script('recaptcha');
	wp_localize_script( 'recaptcha', 'recaptcha_options',
	                    array(
		                    'sitekey' =>RECAPTCHASITEKEY,
		                    // 'secret'=> RECAPTCHASITESECRET
	                    )
	);

}
add_action( 'wp_enqueue_scripts', 'blank_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action( 'init', 'create_post_type' );

function create_post_type() {

	// Custom Post Types
	register_post_type('ppp_job',
	                   [
		                   'labels'            => [
			                   'name'          => __('Stellenangebote'),
			                   'singular_name' => __('Stellenangebot')
		                   ],
		                   'public'            => true,
		                   'has_archive'       => true,
		                   'show_in_nav_menus' => false,
		                   'supports'          => [
			                   'title',
			                   'editor'
		                   ],
		                   'taxonomies'        => ['category'],
		                   'rewrite'           => [
			                   'slug'       => 'stellenangebote',
			                   'with_front' => false
		                   ],
	                   ]
	);
}

function ppp_register_widgets() {
	register_sidebar( array(
	      'name' => __( 'Header Widget Area', 'blank' ),
	      'id' => 'header-widget-area',
	      'description' => __( 'A widget area located in the header', 'blank' ),
	      'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	      'after_widget' => '</div>',
	      'before_title' => '<h3 class="widget-title">',
	      'after_title' => '</h3>',
	  ) );
}
add_action( 'widgets_init', 'ppp_register_widgets' );

/**
 * Redefine the sites Locale (site langauge)
 *
 * In this example we try to get the country and the language from the user custom fields,
 * fall back to en and US.
 */
function ppp_redefine_locale($locale) {

	$user = wp_get_current_user();
	$userID = 'user_' . $user->ID;
	$langCode = get_field('sprache', $userID);
	$countryParts = explode('_', $langCode);
	$lang = $countryParts[0];
	$country = $countryParts[1];

	if('default' !== $country) {
		$locale = $lang . '_' . strtoupper($country);
	} else {
		$locale = $lang . '-' . $country;
	}

	return $locale;

}
add_filter('locale', 'ppp_redefine_locale', 10);


/**
 * Load translations for wpdocs_theme
 */
function ppp_theme_setup(){
	load_theme_textdomain('ppp', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'ppp_theme_setup');

/** === AJAX endpoints === */
function filter_posts() {
	$catSlug = $_POST['category'];

	$ajaxposts = new WP_Query([
		                          'post_type' => 'ppp_job',
		                          'posts_per_page' => -1,
		                          'category_name' => $catSlug
	                          ]);
	$response = '';

	if($ajaxposts->have_posts()) {
		while($ajaxposts->have_posts()) : $ajaxposts->the_post();
			ob_start();
			get_template_part('template-parts/content', 'job-list-item');
			$response .= ob_get_clean();
		endwhile;
		wp_send_json_success($response);
	} else {
		wp_send_json_error();
	}
}
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

function filter_posts_acf() {
	$salary = $_POST['salary'];

	$ajaxposts = new WP_Query([
		                          'post_type' => 'ppp_job',
		                          'posts_per_page' => -1,
		                          'meta_query' => [
			                          'relation'		=> 'AND',
			                          [
				                          'key'     => 'salary',
				                          'value'   => $salary,
				                          'type'    => 'NUMERIC',
				                          'compare'	=> '<='
			                          ]
		                          ]
							]);
	$response = '';

	if($ajaxposts->have_posts()) {
		while($ajaxposts->have_posts()) : $ajaxposts->the_post();
			ob_start();
			get_template_part('template-parts/content', 'job-list-item');
			$response .= ob_get_clean();
		endwhile;
		wp_send_json_success($response);
	} else {
		wp_send_json_error();
	}
}
add_action('wp_ajax_filter_posts_acf', 'filter_posts_acf');
add_action('wp_ajax_nopriv_filter_posts_acf', 'filter_posts_acf');

function verify_recaptcha() {
	# Verify captcha
	$post_data = http_build_query(
		array(
			'secret' => RECAPTCHASITESECRET,
			'response' => $_POST['g-recaptcha-response'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		)
	);
	$opts = array('http' =>
		              array(
			              'method'  => 'POST',
			              'header'  => 'Content-type: application/x-www-form-urlencoded',
			              'content' => $post_data
		              )
	);
	$context  = stream_context_create($opts);
	$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	$result = json_decode($response);
	if (!$result->success) {
		throw new Exception('Gah! CAPTCHA verification failed. Please email me directly at: jstark at jonathanstark dot com', 1);
	}
	// return $result;
	wp_send_json($result);
}
add_action('wp_ajax_verify_recaptcha', 'verify_recaptcha');
add_action('wp_ajax_nopriv_verify_recaptcha', 'verify_recaptcha');

// naming convention:
#add_action('wp_ajax_<action>', '<action>');
#add_action('wp_ajax_nopriv_<action>', '<action>');

/** === AJAX endpoints end === */

/**
 * [email]info@domain.com[/email]
 * @param      $atts
 * @param null $content
 *
 * @return string|void
 */
function wpcodex_hide_email_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}

add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );