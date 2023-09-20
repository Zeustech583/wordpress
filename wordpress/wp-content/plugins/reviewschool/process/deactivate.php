<?php 
/*
* function clears all the mock data, since the plugin is not activated
*
*
*/



function rankmath_test_deactivate_plugin(){
   


global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . RANKMATHTEST__TABLE_NAME . "`" );




}