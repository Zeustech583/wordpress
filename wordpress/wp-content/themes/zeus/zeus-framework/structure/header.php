<?php
/**
 * Functions used to build .site-header
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_head' ) ) {
	/**
	 * Out put the website head.
	 */
	function zeus_head() {

		?>

		<!DOCTYPE html>
		<html <?php echo get_language_attributes(); ?>>
		<head>
		<meta charset="<?php echo get_bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php echo get_bloginfo( 'pingback_url' ) ?>">

		<?php

		/**
		 * Fires before wp_head
		 */
		 do_action( 'zeus_head' );

		 wp_head();

		 ?>

		</head>

		<?php

	}
}

if ( ! function_exists( 'zeus_header' ) ) {
	/**
	 * Output the site title.
	 */
	function zeus_header() {

		echo apply_filters( 'zues_site_branding_open', '<div ' . zeus_get_attr( 'branding' ) . '>');

			if ( get_header_image() ) {
				do_action( 'zeus_header_image' );
			} else {
				do_action( 'zeus_header_text' );
			}

		echo apply_filters( 'zues_site_branding_close', '</div><!-- .site-branding -->');

	}
}

if ( ! function_exists( 'zeus_site_description' ) ) {
	/**
	 * Output the site description.
	 */
	function zeus_site_description() {
		echo '<p '. zeus_get_attr( 'site-description' ) . '>' . get_bloginfo( 'description' ) . '</p>';
	}
}

if ( ! function_exists( 'zeus_header_image' ) ) {
	/**
	 * Output the header image.
	 */
	function zeus_header_image() {

		echo '<a href="'. esc_url( home_url( '/' ) ) .'" rel="home">';
			echo '<img src="'.get_header_image().'" width="'.esc_attr( get_custom_header()->width ) .'" height="'.  esc_attr( get_custom_header()->height ) .'" alt="">';
			zeus_site_title();
		echo '</a>';
	}
}

if ( ! function_exists( 'zeus_site_title' ) ) {
	/**
	 * Check whether a h1 or h2 site title should be shown for SEO purposes.
	 */
	function zeus_site_title() {

		$home_url = esc_url( home_url( '/' ) );
		$blog_name = get_bloginfo( 'name' );

		$link = sprintf( '<a href="%1$s">%2$s</a>', $home_url, $blog_name );

		if ( is_home() ) {
			echo '<h1 '. zeus_get_attr( 'site-title' ) . '>'. $link . '</h1>';
		} else {
			echo '<h2 '. zeus_get_attr( 'site-title' ) . '>'. $link . '</h2>';
		}

	}
}

if ( ! function_exists( 'zeus_custom_header_setup' ) ) {
	/**
	 * Set up the WordPress core custom header feature.
	 *
	 * @uses zeus_header_style()
	 * @uses zeus_admin_header_style()
	 * @uses zeus_admin_header_image()
	 */
	function zeus_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'zeus_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'width'                  => 1040,
			'height'                 => 250,
			'flex-height'            => true,
			'wp-head-callback'       => 'zeus_header_style',
		) ) );
	}
}

add_action( 'after_setup_theme', 'zeus_custom_header_setup' );

if ( ! function_exists( 'zeus_header_style' ) ) {
	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @see zeus_custom_header_setup().
	 */
	function zeus_header_style() {
		$header_text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
	}
}

if ( ! function_exists( 'zeus_admin_header_style' ) ) {
	/**
	 * Styles the header image displayed on the Appearance > Header admin panel.
	 *
	 * @see zeus_custom_header_setup().
	 */
	function zeus_admin_header_style() {
	?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
	<?php
	}
}
