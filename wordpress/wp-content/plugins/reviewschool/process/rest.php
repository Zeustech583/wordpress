<?php


/**
 * Register new route to rest api
 */
function rankmath_test_rest_init() {
    // route url: domain.com/wp-json/$namespace/$route
    
    $namespace = 'api/v1';
    $route     = 'rankmath';
    
    register_rest_route($namespace, $route, array(
        'methods'   => WP_REST_Server::CREATABLE ,
        'callback'  => 'rankmath_test_rest_endpoint',
        'permission_callback' => function () {
            return true;
          },
        'args'      => ['range' => ['required' => true, 'type' => 'integer',
        ]]
    ));
}




/**
 * Init Widget function
 */
function rankmath_test_rest_endpoint($request) {

    global $wpdb;


    $range  =  sanitize_text_field($request->get_param('range'));

    $tablename = $wpdb->prefix . RANKMATHTEST__TABLE_NAME;


    // quering data

    try {
        $btc_range = $wpdb->get_results("SELECT * FROM ". $tablename." WHERE time <= CURRENT_DATE ORDER BY time DESC LIMIT ". $range);
        return  new WP_REST_Response($btc_range);


    } catch (\Throwable $th) {
        return new WP_Error('Wrong range');

    }

}