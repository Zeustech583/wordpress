<?php 
/*
* function activate plugin and insert dmock data into the database
*
*
*/



function rankmath_test_activate_plugin(){
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die(__('you must  update your wordpress version'));
    }
    
    
   flush_rewrite_rules();
 }    

   // create database 

   global $wpdb;

	$createSQL              =   "
	CREATE TABLE `" . $wpdb->prefix . RANKMATHTEST__TABLE_NAME ."` (
		`ID` INT(200) NOT NULL AUTO_INCREMENT,
		`rating` FLOAT,
		`comment_ID` int(200)  NOT NULL,
		 PRIMARY KEY (`ID`)
	) ENGINE=InnoDB " . $wpdb->get_charset_collate() . " AUTO_INCREMENT=1;";

	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	dbDelta( $createSQL );


    // Add data to the database

     //$btcdata = file_get_contents(RANKMATHTEST__PLUGIN_DIR. '/sample.json');
     
    //  var_dump(RANKMATHTEST__PLUGIN_DIR);
    //  var_dump($btcdata);

    //  wp_die();

     /*$btcjson  = json_decode($btcdata,true );



     $tablename = $wpdb->prefix . RANKMATHTEST__TABLE_NAME;

     foreach($btcjson as $btc){
        
        $btcsingle = array("price"=>floatval($btc["PriceUSD"]),"time"=>$btc["time"]);


        try {
            $wpdb->insert($tablename, $btcsingle);
        } catch (\Throwable $th) {
             
        }

        
       

     }
    

    
  
}*/