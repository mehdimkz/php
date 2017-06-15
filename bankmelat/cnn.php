<?php

$servername='localhost';  
$database_username = "your db user name";
$database_password = "your db password";
$database_name = "your db name";



$conect=mysql_connect($servername,$database_username,$database_password)  or  die("Error: " . mysql_error());
mysql_select_db($database_name);
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER_SET utf8");

?>