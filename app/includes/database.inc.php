<?php

// Development Connection
// Server name or IP Address
//$host = "localhost:3307";
$host = "db";

// MySQL Username
//$user = "root";
$user = "docker";

// MySQL Password
//$pass = "";
$pass = "root";

// Default Database name
$db = "db_news";

// Creating a connection to the DataBase
$con = mysqli_connect($host,$user,$pass,$db);

/* Deployment Connection

$host = "SERVER_URL";
$user = "USERNAME";
$pass = "PASSWORD";
$db = "DATABASE_NAME";
$port = 'PORT_NO';

$con = mysqli_connect($host, $user, $pass, $db, $port);
*/

// Checking If the connection is obtained
if (!$con) {
  die("Database Connection Error");
}