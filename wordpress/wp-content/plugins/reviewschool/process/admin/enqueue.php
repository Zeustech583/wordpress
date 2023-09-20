<?php

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function rankmath_test_enqueue_scripts() {
    wp_enqueue_style( 'rankmath-test-style', RANKMATHTEST__PLUGIN_URL . '/build/index.css' );
    wp_enqueue_script( 'rankmath-test-script', RANKMATHTEST__PLUGIN_URL. '/build/index.js', array( 'wp-element' ), '1.0.0', true );
}