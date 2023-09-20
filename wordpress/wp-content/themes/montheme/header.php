<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ) ?> - <?php bloginfo( 'description' ) ?> </title>
    <link rel="stylesheet" href=" <?php  echo get_stylesheet_uri(); ?>">
</head>
<body style="background-color:#dba154e0;">
    <?php wp_nav_menu(); ?>