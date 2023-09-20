<?php
add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) );
//Create thumbnail(miniature) for every image and video on post and page

add_theme_support( 'custom-background',array(
	'default-image'          => '',
	'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
	'default-position-x'     => 'left',    // 'left', 'center', 'right'
	'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
	'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
	'default-repeat'         => 'no-repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
	'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
	'default-color'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
); );
//This feature enables Custom_Backgrounds support for a theme

add_theme_support( 'custom-header',array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	'video'                  => false,
	'video-active-callback'  => 'is_front_page',
); );
//This feature enables Custom_Headers support for a theme














?>