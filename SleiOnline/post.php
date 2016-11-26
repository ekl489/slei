<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// select loggedin users detail
error_reporting(0);
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
