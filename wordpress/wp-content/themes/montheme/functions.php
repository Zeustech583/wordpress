<?php
add_theme_support('post-thumbnails');
add_theme_support('custom-thumbnails');
add_theme_support('custom-logo');
function enregistre_mon_menu() {
    register_nav_menu( 'menu_principal', __( 'Menu principal' ) );
}
add_action( 'init', 'enregistre_mon_menu' );