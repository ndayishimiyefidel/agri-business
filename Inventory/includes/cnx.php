<?php
session_start();
// error_reporting(1);
ini_set('display_errors', 1);
error_reporting(E_ALL);
//echo "Mysql connection";
// Local database connection
// $server_name = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = "Inventory MIS";
// $connection = mysqli_connect($server_name, $username, $password, $dbname)
//     or die('database connection failed !');

// Remote database connection
$server_name = 'byywvw085lrejkkfpsjy-mysql.services.clever-cloud.com';
$username = 'u35agjgltywq2yvq';
$password = 'SrWOTxZAXBAMdGInScek';
$dbname = "byywvw085lrejkkfpsjy";
$connection = mysqli_connect($server_name, $username, $password, $dbname)
    or die('database connection failed !');