<?php
/**
 * Zeus functions and definitions
 *
 * @package zeus
 */

// define('USE_ZEUS_ADMIN_NOTICES', true);
// define('USE_ZEUS_CUSTOMIZER', true);
// define('USE_TGMPA', true);
// define('USE_CMB2', true);

/**
 * Load zeus framework.
 */
require_once get_template_directory() . '/zeus-framework/init.php';

if ( ! function_exists( 'zeus_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zeus_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Core, use a find and replace
         * to change 'zeus' to the name of your theme in all the template files
        */
		load_theme_textdomain( 'zeus', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header' );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'zeus-blog-post', 700, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary Menu', 'zeus' ),
			)
		);

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		$cb_args = apply_filters( 'zeus_custom_background_args', array(
			'default-color' => 'E9E9E9',
			'default-image' => '',
		) );
		add_theme_support( 'custom-background', $cb_args );

	}
}
add_action( 'after_setup_theme', 'zeus_setup' );

/**
 * Registers an editor stylesheet for the theme.
 */
function zeus_add_editor_styles() {
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'admin_init', 'zeus_add_editor_styles' );

if ( ! function_exists( 'zeus_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function zeus_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'zeus_content_width', 700 );
	}
	add_action( 'after_setup_theme', 'zeus_content_width', 0 );
}

/**
 * Register the widget areas this theme supports
 */
function zeus_register_sidebars() {

	zeus_register_widget_area(
		array(
			'id'          => 'sidebar-1',
			'name'        => __( 'Primary Sidebar', 'zeus' ),
			'description' => __( 'Widgets added here are shown in the sidebar next to your content.', 'zeus' ),
		)
	);

	zeus_register_widget_area(
		array(
			'id'          => 'footer-1',
			'name'        => __( 'Footer One', 'zeus' ),
			'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'zeus' ),
		)
	);

	zeus_register_widget_area(
		array(
			'id'          => 'footer-2',
			'name'        => __( 'Footer Two', 'zeus' ),
			'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'zeus' ),
		)
	);

	zeus_register_widget_area(
		array(
			'id'          => 'footer-3',
			'name'        => __( 'Footer Three', 'zeus' ),
			'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'zeus' ),
		)
	);

	zeus_register_widget_area(
		array(
			'id'          => 'footer-4',
			'name'        => __( 'Footer Four', 'zeus' ),
			'description' => __( 'The footer is divided into four widget areas, each spanning 25% of the layout\'s width.', 'zeus' ),
		)
	);

}

add_action( 'widgets_init', 'zeus_register_sidebars', 5 );

/**
 * Enqueue scripts and styles.
 */
function zeus_scripts() {
	wp_enqueue_style( 'zeus-stylesheet', get_stylesheet_uri() );

	wp_enqueue_script( 'zeus-scripts', ZEUS_THEME_URI . '/assets/js/scripts.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'zeus_scripts' );


/**
 * Display the admin notice.
 */
function zeus_admin_notice() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( class_exists( 'Olympus_Google_Fonts' ) ) {
		return;
	}
	/* Check that the user hasn't already clicked to ignore the message */
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}
	if ( ! get_user_meta( $user_id, 'zeus_ignore_notice' ) ) {
		?>

		<div class="notice notice-info">
			<p>
				<?php
				printf(
					/* translators: 1: plugin link */
					esc_html__( 'Easily change the font of your website with our new plugin - %1$s', 'zeus' ),
					'<a href="' . esc_url( admin_url( 'plugin-install.php?s=olympus+google+fonts&tab=search&type=term' ) ) . '">Google Fonts for WordPress</a>'
				);
				?>
				<span style="float:right">
					<a href="?zeus_ignore_notice=0"><?php esc_html_e( 'Hide Notice', 'zeus' ); ?></a>
				</span>
			</p>
		</div>

		<?php
	}
}
add_action( 'admin_notices', 'zeus_admin_notice' );
/**
 * Dismiss the admin notice.
 */
function zeus_dismiss_admin_notice() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET['zeus_ignore_notice'] ) && '0' === $_GET['zeus_ignore_notice'] ) {
		add_user_meta( $user_id, 'zeus_ignore_notice', 'true', true );
	}
}
add_action( 'admin_init', 'zeus_dismiss_admin_notice' );
