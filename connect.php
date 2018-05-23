<?php
//DATABASE CONFIG
$mysqlHost = "localhost";
$mysqlUser = "root";
$mysqlPass = "";

$mysqlDb = "aust_canteen_management";
$mysqlError = "Failed to connect to database";

//CONNECTION SEQUENCE
if(!mysql_connect($mysqlHost,$mysqlUser,$mysqlPass) || !mysql_select_db($mysqlDb)) {
	die($mysqlError);
}