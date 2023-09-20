<?php


/**
 * Register new route to rest api
 */
function user_rest_signup() { 
    // route url: domain.com/wp-json/$namespace/$route
    
    $namespace = 'api/signup';
    $route     = 'insert';

    register_rest_route($namespace, $route, array(
        'methods'   => WP_REST_Server::ALLMETHODS,
        'callback'  => 'creation_user',
        'permission_callback' => function () {
            return true;
        },
        'args'      => [ 'email'=> ['required' => true, 'type' => 'string'],
                'password' => ['required' => true, 'type' => 'string'],
                'user_name' => ['required' => true, 'type' => 'string']]       
    )
    );
}




/**
 * Init Widget function
 */
function creation_user($request) {    
    global $wpdb;
    $email = sanitize_text_field($request->get_param('email'));
    $password = sanitize_text_field($request->get_param('password'));
    $user_name = sanitize_text_field($request->get_param('user_name'));


    if (username_exists($user_name) == false) {
        if (email_exists($email) == false) {
            $user_id = wp_create_user($user_name, $password, $email);
            if (!is_wp_error($user_id)) {
                //creation of new user
                $user = get_user_by('id', $user_id);
                // $user->set_role($role);
                $user->set_role('subscriber');
                $response = "User '" . $user_name . "' Registration was Successful";
            }else{
                return new WP_REST_Response($user_id);
            }
        } else {
            return $response = "Email already exists, please try 'Reset Password'" ;
        }
    } else {
        return $response = "Username already exists, please try 'Reset Password'";
    }
    return new WP_REST_Response($response);
}
