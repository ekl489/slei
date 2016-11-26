<?php
error_reporting(0);

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'slei');

$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
$dbcon = mysql_select_db(DBNAME);
$title = "ekl";

if ( !$conn ) {
    die("Connection failed : " . mysql_error());
}

if ( !$dbcon ) {
    die("Database Connection failed : " . mysql_error());
}
