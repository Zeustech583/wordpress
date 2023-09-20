<?php


/**
 * Add a new dashboard widget.
 */
function rankmath_test_dashboard_init() {
	wp_add_dashboard_widget( 'dashboard_widget', 'Rank Math Test', 'rankmath_test_widget_init' );
}




/**
 * Init Widget function
 */
function rankmath_test_widget_init() {
    require_once  RANKMATHTEST__PLUGIN_DIR. 'templates/app.php';


}