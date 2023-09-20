<?php
/**
 * Plugin Name:       Rank Math Test
 * Description:       Simple plugin to display graph using Reactjs and WP Rest.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Stanly Medjo
 * License:           MIT
 * License URI:       MIT
 * Text Domain:       rankmathtest
 */


// Security checks

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!function_exists('add_action')){
    die("Hi  there ! I'm just  a  plugin , not  much I can  do  when  called directly. ");
}


// Basic plugin setup

define('RANKMATHTEST__PLUGIN_FILE',__FILE__ );
define('RANKMATHTEST__PLUGIN_DIR',plugin_dir_path( __FILE__ )  );
define('RANKMATHTEST__PLUGIN_URL', plugins_url( '', RANKMATHTEST__PLUGIN_FILE));
define('RANKMATHTEST__TABLE_NAME', 'rankmath_test');
define('COMMENTS__TABLE_NAME', 'comments');
define('POSTS__TABLE_NAME', 'posts');



// Includes

require_once RANKMATHTEST__PLUGIN_DIR. '/process/admin/init.php';
require_once RANKMATHTEST__PLUGIN_DIR. '/process/admin/enqueue.php';
require_once RANKMATHTEST__PLUGIN_DIR. '/process/activate.php';
require_once RANKMATHTEST__PLUGIN_DIR. '/process/deactivate.php';
//require_once RANKMATHTEST__PLUGIN_DIR. '/process/rest.php';
require_once RANKMATHTEST__PLUGIN_DIR. '/process/rest_review.php';
require_once RANKMATHTEST__PLUGIN_DIR. '/process/rest_signup.php';






// Hooks

register_activation_hook( RANKMATHTEST__PLUGIN_FILE, 'rankmath_test_activate_plugin' );
register_deactivation_hook( RANKMATHTEST__PLUGIN_FILE, 'rankmath_test_deactivate_plugin' );


add_action( 'admin_enqueue_scripts', 'rankmath_test_enqueue_scripts' );
add_action( 'wp_dashboard_setup', 'rankmath_test_dashboard_init');
add_action( 'rest_api_init', 'rankmath_test_rest_review');
add_action( 'rest_api_init', 'user_rest_signup');

