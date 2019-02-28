<?php
//ob_start();
//session_start();
//if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) @ob_start("ob_gzhandler"); else @ob_start();
error_reporting(1); 
ini_set('arg_separator.output','&amp;');


	/* Live Server database Info*/
	define('DBSERVER',"localhost");
	define('DBNAME',"ak_education");
	define('DBUSER',"ak_edu_user");
	define('DBPASS',"};S!q&uF8lV_");

	// Database Connection Establishment String
	mysql_connect(DBSERVER,DBUSER,DBPASS);
	mysql_select_db(DBNAME);



	?>

                            
                            
                            
                            