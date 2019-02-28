<?php
session_start();
error_reporting(0);
ini_set('display_errors', TRUE); 
ini_set('display_startup_errors', TRUE);

/* Live Server database Info*/
define('DB_HOST',"localhost");
define('DB_USER',"ak_edu_user");
define('DB_NAME',"ak_education");
define('DB_PASSWORD',"};S!q&uF8lV_");



/*Local Server Database Info
define('DBSERVER',"localhost");
define('DBNAME',"jewellers");
define('DBUSER',"root");
define('DBPASS',"");
*/ 

// SMS Setting
define('SMS_UName', 'AIG123');
define('SMS_UPass', 'aig123');
define('SMS_USenderid', 'AIGGRP'); 
define('SMS_URoute', 'T'); 

define('URL', 'http://kcjewellers.co.in/admin/'); 
// Database Connection Establishment String
//$conn = new mysqli(DB_HOST, DB_USER, DBPASS, DBNAME);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}

?>
