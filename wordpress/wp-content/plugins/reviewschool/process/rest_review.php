<?php


/**
 * Register new route to rest api
 */
function rankmath_test_rest_review() { 
    // route url: domain.com/wp-json/$namespace/$route
    
    $namespace = 'api/review';
    $route1     = 'get';
    $route2     = 'insert';
    register_rest_route($namespace, $route1, array(
        'methods'   => WP_REST_Server::ALLMETHODS,
        'callback'  => 'rankmath_test_rest_endpoint',
        'permission_callback' => function () {
            return true;
        },
         'args'      => [ 'postId'=> ['required' => true, 'type' => 'int'],]
    )
    );

    register_rest_route($namespace, $route2, array(
        'methods'   => WP_REST_Server::ALLMETHODS,
        'callback'  => 'rankmath_test_rest_insertion',
        'permission_callback' => function () {
            return true;
        },
        'args'      => [ 'rating'=> ['required' => true, 'type' => 'float'],
                'comment_ID' => ['required' => true, 'type' => 'integer'],]        
    )
    );
}




/**
 * Init Widget function
 */
function rankmath_test_rest_endpoint($request) {    
    global $wpdb;
    $tablerankmath_test = $wpdb->prefix . RANKMATHTEST__TABLE_NAME;
    $tablecomments = $wpdb->prefix . COMMENTS__TABLE_NAME;
    $tableposts = $wpdb->prefix . POSTS__TABLE_NAME;
    $post_id = sanitize_text_field($request->get_param('postId'));

    try {
        $rank_range = $wpdb->get_results("SELECT * FROM   ".$tablecomments."
         INNER JOIN ".$tablerankmath_test." ON ".$tablerankmath_test.".comment_ID = ".$tablecomments.".comment_ID
        WHERE comment_post_ID = ".$post_id."" );


        return  new WP_REST_Response($rank_range);
    } catch (\Throwable $th) {
        return new WP_Error('Wrong rating');
    }
}





/**
 * Init Widget function
 */
function rankmath_test_rest_insertion($request) {
    global $wpdb;
    $tablerankmath_test = $wpdb->prefix . RANKMATHTEST__TABLE_NAME;

    $rating  =  sanitize_text_field($request->get_param('rating'));
    if ($rating > 5) {
        $rating = 5 ;
    }
    $comments  =  sanitize_text_field($request->get_param('comment_ID'));
    try {
        // Add data to the database
            $rankdata = array("rating"=>floatval($rating),"comment_ID"=>intval($comments));
            $wpdb->insert($tablerankmath_test, $rankdata);
            return  new WP_REST_Response('rank_insertion is done');
        }catch (\Throwable $th) {
            return new WP_Error('failed insertion rank');
        }
}