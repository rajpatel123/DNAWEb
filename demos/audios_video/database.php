<?php
ob_start();
ini_set('arg_separator.output','&amp;');


	/* Live Server database Info*/
		define('DBSERVER',"localhost");
	define('DBNAME',"gosalon_data");
	define('DBUSER',"gosalon_datauser");
	define('DBPASS',"b8;t7CJkUGxY");
 
	
	/*Local Server Database Info
	define('DBSERVER',"localhost");
	define('DBNAME',"demo");
	define('DBUSER',"root");
	define('DBPASS',"");*/
    

 
	
	// Database Connection Establishment String
	mysql_connect(DBSERVER,DBUSER,DBPASS);

	// Database Selection String
	mysql_select_db(DBNAME);

		date_default_timezone_set('Asia/Kolkata');
		mysql_query("SET time_zone = 'Asia/Calcutta'");
		
		
	
		

	?>

                            
                            
                            
                            